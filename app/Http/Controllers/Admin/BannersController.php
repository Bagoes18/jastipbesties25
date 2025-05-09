<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Models\AdminsRole;
use Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;
use Session;

class BannersController extends Controller
{
    public function banners()
    {
        Session::put('page', 'banners');
        $banners = Banner::get()->toArray();
        $bannersModulCount = AdminsRole::where(['subadmin_id' => Auth::guard('admin')->user()->id, 'module' => 'banners'])->count();
        $bannersModul = array();
        if (Auth::guard('admin')->user()->type == "admin") {
            $bannersModul['view_access'] = 1;
            $bannersModul['edit_access'] = 1;
            $bannersModul['full_access'] = 1;
        } else if ($bannersModulCount == 0) {
            $message = 'Fitur ini terbatas untuk Anda!';
            return redirect('admin/dashboard')->with('error_message', $message);
        } else {
            $bannersModul = AdminsRole::where(['subadmin_id' => Auth::guard('admin')->user()->id, 'module' => 'banners'])->first()->toArray();
        }
        return view('admin.banners.banners', compact('banners', 'bannersModul'));
    }
    public function updateBannerStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $status = ($data['status'] == "Active") ? 0 : 1;

            Banner::where("id", $data['banner_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'banner_id' => $data['banner_id']]);
        }
    }
    public function deleteBanner($id)
    {
        $bannerImage = Banner::where('id', $id)->first();
        $banner_image_path = 'front/images/banners/';
        if (file_exists($banner_image_path . $bannerImage->image)) {
            unlink($banner_image_path . $bannerImage->image);
        }
        Banner::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Banner Berhasil Dihapus!');
    }

    public function addEditBanner(Request $request, $id = null)
    {
        // $getBanners = Banner::getBanners();
        if ($id == "") {
            //menambahkan Banner
            $title = "Tambah Banner";
            $banner = new Banner();
            $message = "Berhasil Menambahkan Banner!";

        } else {
            //edit Banner
            $title = "Edit Banner";
            $banner = Banner::find($id);
            $message = "Berhasil Mengedit Banner!";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;

            if ($id == "") {
                $rules = [
                    'type' => 'required',
                    'banner_image' => 'required',

                ];

            }



            $customMessages = [
                'type.required' => 'Tipe Banner harus di isi!',
                'banner_image.required' => 'Gambar Banner harus di isi!',

            ];

            $this->validate($request, $rules, $customMessages);

            //upload gambar Banner
            if ($request->hasFile("banner_image")) {
                $image_tmp = $request->file("banner_image");
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $image_path = 'front/images/banners/' . $imageName;
                    Image::make($image_tmp)->save($image_path);
                    $banner->image = $imageName;

                }
            } else {
                $banner->image = '';
            }

            $banner->title = $data['title'];
            $banner->alt = $data['alt'];
            $banner->link = $data['link'];
            $banner->sort = $data['sort'];
            $banner->type = $data['type'];
            $banner->status = 1;
            $banner->save();

            return redirect('admin/banners')->with('success_message', $message);
        }
        return view("admin.banners.add_edit_banner", compact("title", "banner"));
    }
}
