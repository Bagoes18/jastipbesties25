<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminsRole;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;


class AdminController extends Controller
{
    public function dashboard()
    {
        Session::put("page", 'dashboard');
        $categoryCount = Category::get()->count();
        $productsCount = Product::get()->count();
        $brandsCount = Brand::get()->count();
        $usersCount = User::get()->count();
        return view('admin.dashboard', compact('categoryCount', 'productsCount', 'brandsCount', 'usersCount'));
    }
    public function updatePassword(Request $request)
    {
        Session::put("page", 'update-password');
        if ($request->isMethod('post')) {
            $data = $request->all();
            //cek jika password benar
            if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
                //cek jika password baru dan konfrimasi password cocok
                if ($data['new_pwd'] == $data['confirm_pwd']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update([
                        'password' =>
                            bcrypt($data['new_pwd'])
                    ]);
                    return back()->with('success_message', 'Berhasil memperbarui Password!');
                } else {
                    return back()->with('error_message', 'Password Baru & Password Lama Harus Berbeda!');
                }
            } else {
                return back()->with('error_message', 'Password saat ini Salah!');
            }
            ;
        }
        return view('admin.update_password');
    }
    public function login(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            return redirect('admin/dashboard');
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required|max:30',
            ];

            $customMessage = [
                'email.required' => "Email Wajib diisi!",
                'email.email' => "Email harus valid!",
                'password.required' => "Password Wajib diisi!",
            ];

            $this->validate($request, $rules, $customMessage);
            // echo "<pre>"; print_r($data); die;
            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                //remember me
                if (isset($data['remember']) && !empty($data['remember'])) {
                    setcookie("email", $data['email'], time() + 3600);
                    setcookie("password", $data['password'], time() + 3600);
                } else {
                    setcookie('email', "");
                    setcookie('password', "");
                }


                return redirect("admin/dashboard");

            } else {
                return redirect()->back()->with("error_message", "Salah Email atau Password");
            }
        }

        return view('admin.login');
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
    public function checkCurrentPassword(Request $request)
    {
        $data = $request->all();
        if (Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }

    public function updateDetails(Request $request)
    {
        Session::put("page", 'update-details');

        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'admin_mobile' => 'required|numeric|digits:12',
                'admin_image' => 'image',
            ];

            $customMessage = [
                'admin_name.required' => "Nama wajib diisi!",
                'admin_name.regex' => "Nama Harus Valid!",
                'admin_name.max' => "Nama Harus Valid!",
                'admin_mobile.required' => "Nomer HP wajib diisi!",
                'admin_mobile.numeric' => "Nomer HP Harus Valid!",
                'admin_mobile.digits' => "Nomer HP Harus Valid!",
                'admin_image.image' => "Format FOTO Harus Valid!",
            ];

            $this->validate($request, $rules, $customMessage);
            //upload admin image
            if ($request->hasFile("admin_image")) {
                $image_tmp = $request->file("admin_image");
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $image_path = 'admin/images/photos/' . $imageName;
                    Image::make($image_tmp)->save($image_path);

                }
            } else if (!empty($data['current_image'])) {
                $imageName = $data['current_image'];
            } else {
                $imageName = '';
            }


            //update admin details
            Admin::where("email", Auth::guard('admin')->user()->email)->update([
                'name' => $data['admin_name'],
                'mobile' => $data['admin_mobile'],
                'image' => $imageName,
            ]);

            return redirect()->back()->with('success_message', 'Detail Admin Berhasil diperbarui!');
        }
        return view('admin.update_details');
    }

    public function subadmins()
    {
        Session::put("page", 'subadmins');
        $subadmins = Admin::where('type', 'subadmin')->get();
        return view('admin.subadmins.subadmins', compact('subadmins'));

    }

    public function updateSubadminStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $status = ($data['status'] == "Active") ? 0 : 1;

            Admin::where("id", $data['subadmin_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'subadmin_id' => $data['subadmin_id']]);
        }
    }

    public function deleteSubadmin($id)
    {
        //Delete Subadmin
        Admin::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Sub Admin Berhasil Dihapus!');
    }

    public function addEditSubadmin(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Tambahkan Sub Admin";
            $subadmindata = new Admin;
            $message = "Berhasil menambahkan Sub Admin!";

        } else {
            $title = "Edit Subadmin";
            $subadmindata = Admin::find($id);
            $message = "Berhasil mengedit Sub Admin!";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            if ($id == "") {
                $subadminCount = Admin::where("email", $data['email'])->count();
                if ($subadminCount > 0) {
                    return redirect()->back()->with('error_message', 'Subadmin already exists!');

                }
            }

            //Subadmin Validations
            $rules = [
                'name' => 'required',
                'mobile' => 'required|numeric',
                'image' => 'image',

            ];
            $customMessages = [
                'name.required' => 'Name is Required',
                'mobile.required' => 'Mobile is Required',
                'mobile.numeric' => 'Valid Mobile is Required',
                'image.image' => 'Valid Images is Required',
            ];
            $this->validate($request, $rules, $customMessages);
            //upload admin image
            if ($request->hasFile("image")) {
                $image_tmp = $request->file("image");
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $image_path = 'admin/images/photos/' . $imageName;
                    Image::make($image_tmp)->save($image_path);

                }
            } else if (!empty($data['current_image'])) {
                $imageName = $data['current_image'];
            } else {
                $imageName = '';
            }

            $subadmindata->image = $imageName;
            $subadmindata->name = $data['name'];
            $subadmindata->mobile = $data['mobile'];
            if ($id == "") {
                $subadmindata->email = $data['email'];
                $subadmindata->type = 'subadmin';
            }
            if ($data['password'] != "") {
                $subadmindata->password = bcrypt($data["password"]);
            }
            $subadmindata->save();
            return redirect('admin/subadmins')->with('success_message', $message);

        }

        return view('admin.subadmins.add_edit_subadmin')->with(compact('title', 'subadmindata'));
    }

    public function updateRole($id, Request $request)
    {

        if ($request->isMethod("post")) {
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;
            //menghapus semua role sebelumnya
            AdminsRole::where("subadmin_id", $id)->delete();

            //menambahkan role baru
            // foreach ($data as $key => $value) {
            //     if (isset($value['view'])) {
            //         $view = $value['view'];
            //     } else {
            //         $view = 0;
            //     }
            //     if (isset($value['edit'])) {
            //         $edit = $value['edit'];
            //     } else {
            //         $edit = 0;
            //     }
            //     if (isset($value['full'])) {
            //         $full = $value['full'];
            //     } else {
            //         $full = 0;
            //     }
            // }

            // $role = new AdminsRole;
            // $role->subadmin_id = $id;
            // $role->module = $key;
            // $role->view_access = $view;
            // $role->edit_access = $edit;
            // $role->full_access = $full;
            // $role->save();

            foreach ($data as $key => $value) {
                // Lewati token CSRF atau input lain yang bukan modul
                if (in_array($key, ['_token', 'subadmin_id'])) {
                    continue;
                }

                $view = isset($value['view']) ? 1 : 0;
                $edit = isset($value['edit']) ? 1 : 0;
                $full = isset($value['full']) ? 1 : 0;

                $role = new AdminsRole;
                $role->subadmin_id = $id;
                $role->module = $key;
                $role->view_access = $view;
                $role->edit_access = $edit;
                $role->full_access = $full;
                $role->save();
            }


            $message = "Peran Sub Admin Berhasil diedit!";
            return redirect()->back()->with('success_message', $message);
            // AdminsRole::where('subadmin_id', $id)->insert(['subadmin']);

        }
        $subadminRoles = AdminsRole::where('subadmin_id', $id)->get()->toArray();
        $subadminDetails = Admin::where('id', $id)->first()->toArray();
        $title = "Perbarui " . $subadminDetails['name'] . " ( Peran/Izin Akses )";
        // dd($subadminRoles);
        return view("admin.subadmins.update_roles")->with(compact("title", "id", "subadminRoles"));
    }

    public function users()
    {
        Session::put("page", 'user');
        $user = User::all();
        return view('admin.user', compact('user'));
    }

    public function deleteUser($id)
    {
        User::where("id", $id)->delete();
        return redirect()->back()->with('success_message', 'User Berhasil Dihapus!');
    }

    public function updateUser(Request $request, $id)
    {
        $data = $request->all();
        unset($data['_token']);
        unset($data['user_id']);
        if ($data['password'] != "") {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        User::where('id', $id)->update($data);
        return redirect()->back()->with('success_message', 'User Berhasil Diperbarui!');
    }
}
