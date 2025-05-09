<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;
use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\returnValueMap;
use Auth;
use App\Models\AdminsRole;


class BrandController extends Controller
{
    public function brands()
    {
        Session::put('page', 'brands');
        $brands = Brand::get();

        $brandsModulCount = AdminsRole::where(['subadmin_id' => Auth::guard('admin')->user()->id, 'module' => 'brands'])->count();
        $brandsModul = array();
        if (Auth::guard('admin')->user()->type == "admin") {
            $brandsModul['view_access'] = 1;
            $brandsModul['edit_access'] = 1;
            $brandsModul['full_access'] = 1;
        } else if ($brandsModulCount == 0) {
            $message = 'Fitur ini terbatas untuk Anda!';
            return redirect('admin/dashboard')->with('error_message', $message);
        } else {
            $brandsModul = AdminsRole::where(['subadmin_id' => Auth::guard('admin')->user()->id, 'module' => 'brands'])->first()->toArray();
        }
        return view('admin.brands.brands', compact('brands', 'brandsModul'));
    }
    public function updateBrandStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $status = ($data['status'] == "Active") ? 0 : 1;

            Brand::where("id", $data['brand_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'brand_id' => $data['brand_id']]);
        }
    }
    public function deleteBrand($id)
    {
        //Delete CMSPage
        Brand::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Merek Berhasil Dihapus!');
    }

    public function addEditBrand(Request $request, $id = null)
    {
        // $getBrands = Brand::getBrands();
        if ($id == "") {
            //menambahkan Merek
            $title = "Tambah Merek";
            $brand = new Brand();
            $message = "Berhasil Menambahkan Merek!";

        } else {
            //edit Merek
            $title = "Edit Merek";
            $brand = Brand::find($id);
            $message = "Berhasil Mengedit Merek!";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();

            if ($id == "") {
                $rules = [
                    'brand_name' => 'required',
                    'url' => 'required|unique:brands',
                ];

            } else {
                $rules = [
                    'brand_name' => 'required',
                    'url' => 'required',
                ];

            }

            $customMessages = [
                'brand_name.required' => 'Nama Merek harus di isi!',
                'url.required' => 'URL Merek harus di isi!',
                'url.unique' => 'URL Merek sudah ada di database sistem!',
            ];

            $this->validate($request, $rules, $customMessages);

            //upload gambar Merek
            if ($request->hasFile("brand_image")) {
                $image_tmp = $request->file("brand_image");
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $image_path = 'front/images/brands/' . $imageName;
                    Image::make($image_tmp)->save($image_path);
                    $brand->brand_image = $imageName;

                }
            } else {
                $brand->brand_image = '';
            }
            //upload logo Merek
            if ($request->hasFile("brand_logo")) {
                $image_tmp = $request->file("brand_logo");
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $image_path = 'front/images/brands/' . $imageName;
                    Image::make($image_tmp)->save($image_path);
                    $brand->brand_logo = $imageName;

                }
            } else {
                $brand->brand_logo = '';
            }

            //buang diskon dari semua produk untuk spesifik brand
            if (empty($data['brand_discount'])) {
                $data['brand_discount'] = 0;
                if ($id != "") {
                    $brandProducts = Product::where('brand_id', $id)->get()->toArray();
                    foreach ($brandProducts as $key => $product) {
                        if ($product['discount_type'] == "brand") {
                            Product::where('id', $product['id'])->update(['discount_type' => '', 'final_price' => $product['product_price']]);
                        }
                    }
                }
            }


            $brand->brand_name = $data['brand_name'];

            $brand->brand_discount = $data['brand_discount'];
            $brand->description = $data['description'];
            $brand->url = $data['url'];
            $brand->meta_title = $data['meta_title'];
            $brand->meta_description = $data['meta_description'];
            $brand->meta_keywords = $data['meta_keywords'];
            $brand->status = 1;
            $brand->save();

            return redirect('admin/brands')->with('success_message', $message);
        }
        return view("admin.brands.add_edit_brand", compact("title", "brand"));
    }
    public function deleteBrandImage($id)
    {
        //get brand image
        $brandImage = Brand::select('brand_image')->where('id', $id)->first();

        //get brand image path
        $brand_image_path = 'front/images/brands/';
        //delete brand image dari folder public

        if (file_exists($brand_image_path . $brandImage->brand_image)) {
            unlink($brand_image_path . $brandImage->brand_image);
        }
        //delete brand image dari tabel
        Brand::where('id', $id)->update(['brand_image' => '']);

        return redirect()->back()->with('success_message', 'Gambar Merek berhasil terhapus!');

    }
    public function deleteBrandLogo($id)
    {
        //get brand image
        $brandLogo = Brand::select('brand_logo')->where('id', $id)->first();

        //get brand image path
        $brand_logo_path = 'front/images/brands/';
        //delete brand image dari folder public

        if (file_exists($brand_logo_path . $brandLogo->brand_logo)) {
            unlink($brand_logo_path . $brandLogo->brand_logo);
        }
        //delete brand image dari tabel
        Brand::where('id', $id)->update(['brand_logo' => '']);

        return redirect()->back()->with('success_message', 'Logo Merek berhasil terhapus!');

    }
}
