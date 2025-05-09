<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Session;
use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;
use App\Models\AdminsRole;
use Auth;

class CategoryController extends Controller
{
    public function categories()
    {
        Session::put("page", 'categories');
        $categories = Category::with('parentcategory')->get()->toArray();

        $categoriesModulCount = AdminsRole::where(['subadmin_id' => Auth::guard('admin')->user()->id, 'module' => 'categories'])->count();
        $categoriesModul = array();
        if (Auth::guard('admin')->user()->type == "admin") {
            $categoriesModul['view_access'] = 1;
            $categoriesModul['edit_access'] = 1;
            $categoriesModul['full_access'] = 1;
        } else if ($categoriesModulCount == 0) {
            $message = 'Fitur ini terbatas untuk Anda!';
            return redirect('admin/dashboard')->with('error_message', $message);
        } else {
            $categoriesModul = AdminsRole::where(['subadmin_id' => Auth::guard('admin')->user()->id, 'module' => 'categories'])->first()->toArray();
        }
        // dd($categories);
        return view("admin.categories.categories", compact("categories", "categoriesModul"));
    }

    public function updateCategoryStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $status = ($data['status'] == "Active") ? 0 : 1;

            Category::where("id", $data['category_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }

    public function deleteCategory($id)
    {
        //Delete CMSPage
        Category::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Kategori Berhasil Dihapus!');
    }

    public function addEditCategory(Request $request, $id = null)
    {
        $getCategories = Category::getCategories();
        if ($id == "") {
            //menambahkan kategori
            $title = "Tambah Kategori";
            $category = new Category();
            $message = "Berhasil Menambahkan Kategori!";

        } else {
            //edit kategori
            $title = "Edit Kategori";
            $category = Category::find($id);
            $message = "Berhasil Mengedit Kategori!";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();

            if ($id == "") {
                $rules = [
                    'category_name' => 'required',
                    'url' => 'required|unique:categories',
                ];

            } else {
                $rules = [
                    'category_name' => 'required',
                    'url' => 'required',
                ];

            }

            $customMessages = [
                'category_name.required' => 'Nama Kategori harus di isi!',
                'url.required' => 'URL Kategori harus di isi!',
                'url.unique' => 'URL Kategori sudah ada di database sistem!',
            ];

            $this->validate($request, $rules, $customMessages);

            //upload gambar kategori
            if ($request->hasFile("category_image")) {
                $image_tmp = $request->file("category_image");
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $image_path = 'front/images/categories/' . $imageName;
                    Image::make($image_tmp)->save($image_path);
                    $category->category_image = $imageName;

                }
            } else {
                $category->category_image = '';
            }

            if (empty($data['category_discount'])) {
                $data['category_discount'] = 0;
                if ($id != "") {
                    $categoryProducts = Product::where('category_id', $id)->get()->toArray();
                    foreach ($categoryProducts as $key => $product) {
                        if ($product['discount_type'] == "category") {
                            Product::where('id', $product['id'])->update(['discount_type' => '', 'final_price' => $product['product_price']]);
                        }
                    }
                }
            }

            $category->category_name = $data['category_name'];
            $category->parent_id = $data['parent_id'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = 1;
            $category->save();

            return redirect('admin/categories')->with('success_message', $message);
        }
        return view("admin.categories.add_edit_categories", compact("title", "getCategories", "category"));
    }

    public function deleteCategoryImage($id)
    {
        //get category image
        $categoryImage = Category::select('category_image')->where('id', $id)->first();

        //get category image path
        $category_image_path = 'front/images/categories/';
        //delete category image dari folder public

        if (file_exists($category_image_path . $categoryImage->category_image)) {
            unlink($category_image_path . $categoryImage->category_image);
        }
        //delete category image dari tabel
        Category::where('id', $id)->update(['category_image' => '']);

        return redirect()->back()->with('success_message', 'Gambar Kategori berhasil terhapus!');

    }
}
