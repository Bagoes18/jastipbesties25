<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProductsAttribute;
use App\Models\ProductsImage;
use Illuminate\Http\Request;
use App\Models\Product;
use Intervention\Image\Facades\Image;
use App\Models\Category;
use App\Models\AdminsRole;
use Session;
use Auth;
use DB;
use App\Models\Brand;

class ProductsController extends Controller
{
    public function products()
    {
        Session::put("page", 'products');
        $products = Product::with('category')->get()->toArray();
        // dd($products);

        //set admin/subadmin permission untuk cms page
        $productsModulCount = AdminsRole::where(['subadmin_id' => Auth::guard('admin')->user()->id, 'module' => 'products'])->count();
        $productsModul = array();
        if (Auth::guard('admin')->user()->type == "admin") {
            $productsModul['view_access'] = 1;
            $productsModul['edit_access'] = 1;
            $productsModul['full_access'] = 1;
        } else if ($productsModulCount == 0) {
            $message = 'Fitur ini terbatas untuk Anda!';
            return redirect('admin/dashboard')->with('error_message', $message);
        } else {
            $productsModul = AdminsRole::where(['subadmin_id' => Auth::guard('admin')->user()->id, 'module' => 'products'])->first()->toArray();
        }

        return view("admin.products.products", compact('products', 'productsModul'));

    }

    public function updateProductStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $status = ($data['status'] == "Active") ? 0 : 1;

            Product::where("id", $data['product_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }

    public function deleteProduct($id)
    {
        //Delete CMSPage
        Product::where('id', $id)->delete();
        Order::where('product_id', $id)->delete();
        return redirect()->back()->with('success_message', 'Produk Berhasil Dihapus!');
    }

    public function addEditProduct(Request $request, $id = null)
    {
        if ($id == "") {
            //ADD PRODUCT
            $title = "Tambah Produk";
            $product = new Product();

            $message = 'Berhasil Menambahkan Produk!';
        } else {
            //edit PRODUCT
            $title = "Edit Produk";
            $product = Product::with(['images', 'attributes'])->find($id);
            $message = 'Berhasil Mengedit Produk!';
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;



            //product Validation
            $rules = [
                'category_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s-]+$/u|max:200',
                'product_code' => 'required|regex:/^[\w-]*$/|max:30',
                'product_price' => 'required|numeric',
                'product_color' => 'required|regex:/^[\pL\s-]+$/u|max:200',
                'family_color' => 'required|regex:/^[\pL\s-]+$/u|max:200',
            ];

            $customMessage = [
                'category_id.required' => 'Kategori Harus Diisi',
                'product_name.required' => 'Nama Produk Harus Diisi',
                'product_name.regex' => 'Nama Produk Harus Valid',
                'product_code.required' => 'Kode Produk Harus Diisi',
                'product_code.regex' => 'Kode Produk Harus Valid',
                'product_price.required' => 'Harga Produk Harus Diisi',
                'product_price.numeric' => 'Harga Produk Harus Valid',
                'product_color.required' => 'Warna Produk Harus Diisi',
                'product_color.regex' => 'Warna Produk Harus Valid',
                'family_color.required' => 'Warna Primer Harus Valid',
                'family_color.regex' => 'Warna Primer Harus Valid',
            ];

            $this->validate($request, $rules, $customMessage);

            //Upload Produk Video
            if ($request->hasFile('product_video')) {
                $video_tmp = $request->file('product_video');
                if ($video_tmp->isValid()) {
                    // $videoName = $video_tmp->getClientOriginalName();
                    $videoExtension = $video_tmp->getClientOriginalExtension();
                    $videoName = rand() . '.' . $videoExtension;
                    $videoPath = "front/videos/products";
                    $video_tmp->move($videoPath, $videoName);

                    $product->product_video = $videoName;


                }
            }

            if (!isset($data['product_discount'])) {
                $data['product_discount'] = 0;
            }
            if (!isset($data['product_weight'])) {
                $data['product_weight'] = 0;
            }

            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->family_color = $data['family_color'];
            $product->group_code = $data['group_code'];
            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];

            if (!empty($data['product_discount']) && $data['product_discount'] > 0) {
                $product->discount_type = 'product';
                $product->final_price = $data['product_price'] - ($data['product_price'] * $data['product_discount']) / 100;
            } else {
                $getCategoryDiscount = Category::select('category_discount')->where('id', $data['category_id'])->first();
                if ($getCategoryDiscount->category_discount == 0) {
                    $product->discount_type = '';
                    $product->final_price = $data['product_price'];
                }
            }

            $product->product_weight = $data['product_weight'];
            $product->description = $data['description'];
            $product->wash_care = $data['wash_care'];
            $product->fabric = $data['fabric'];
            $product->pattern = $data['pattern'];
            $product->sleeve = $data['sleeve'];
            $product->fit = $data['fit'];
            $product->occasion = $data['occasion'];
            $product->search_keywords = $data['search_keywords'];
            $product->meta_title = $data['meta_title'];
            $product->meta_keywords = $data['meta_keywords'];
            $product->meta_description = $data['meta_description'];
            if (!empty($data['is_featured'])) {
                $product->is_featured = $data['is_featured'];
            } else {
                $product->is_featured = 'No';
            }
            if (!empty($data['is_bestseller'])) {
                $product->is_bestseller = $data['is_bestseller'];
            } else {
                $product->is_bestseller = 'No';
            }

            $product->status = 1;
            $product->save();

            if ($id == "") {
                $product_id = DB::getPdo()->lastInsertId();

            } else {
                $product_id = $id;
            }

            //upload gambar produk
            if ($request->hasFile('product_images')) {
                $images = $request->file('product_images');

                // foreach ($images as $key => $image) {
                //     $image_temp = Image::make($image);

                //     $extension = $image->getClientOriginalExtension();

                //     $imageName = 'product-' . rand(111, 99999999) . '.' . $extension;

                //     $largeImagePath = 'front/images/products/large' . $imageName;
                //     $mediumImagePath = 'front/images/products/medium' . $imageName;
                //     $smallImagePath = 'front/images/products/small' . $imageName;
                foreach ($images as $uploadedImage) {
                    $extension = $uploadedImage->getClientOriginalExtension();
                    $imageName = 'product-' . time() . '-' . uniqid() . '.' . $extension;

                    // Buat semua ukuran dan simpan ke folder berbeda
                    $image = Image::make($uploadedImage);
                    $image->resize(1040, 1200)->save(public_path('front/images/products/large/' . $imageName));
                    $image->resize(560, 600)->save(public_path('front/images/products/medium/' . $imageName));
                    $image->resize(260, 300)->save(public_path('front/images/products/small/' . $imageName));

                    // Image::make($image_temp)->resize(1040, 1200)->save($largeImagePath);
                    // Image::make($image_temp)->resize(560, 600)->save($mediumImagePath);
                    // Image::make($image_temp)->resize(260, 300)->save($smallImagePath);

                    $image = new ProductsImage;
                    $image->image = $imageName;
                    $image->product_id = $product_id;
                    $image->status = 1;
                    $image->save();
                }

            }

            //update sortir gambar produk
            if ($id != "") {
                if (isset($data['image'])) {
                    foreach ($data['image'] as $key => $image) {
                        ProductsImage::where(['product_id' => $id, 'image' => $image])->update(['image_short' => $data['image_sort'][$key]]);
                    }
                }
            }

            //menambahkan attr produk

            foreach ($data['sku'] as $key => $value) {
                if (!empty($value)) {
                    //cek value sku sudah ada atau belum
                    $countSKU = ProductsAttribute::where('sku', $value)->count();
                    if ($countSKU > 0) {
                        $message = 'SKU sudah ada di database. Harap ganti SKU!';

                        return redirect()->back()->with('success_message', $message);
                    }

                    //cek ukuran apakah sudah ada atau belum
                    $countSize = ProductsAttribute::where(['product_id' => $product_id, 'size' => $data['size'][$key]])->count();
                    if ($countSize > 0) {
                        $message = 'Ukuran sudah ada. Harap ganti Ukuran!';

                        return redirect()->back()->with('success_message', $message);
                    }

                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $product_id;
                    $attribute->sku = $value;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->status = 1;
                    $attribute->save();
                }
            }

            if (isset($data['attributeId'])) {
                foreach ($data['attributeId'] as $akey => $attribute) {
                    if (!empty($attribute)) {
                        ProductsAttribute::where(['id' => $data['attributeId'][$akey]])->update(['price' => $data['price'][$akey], 'stock' => $data['stock'][$akey]]);
                    }
                }
            }



            return redirect('admin/products')->with('success_message', $message);
        }
        //Get Category & Sub Cat
        $getCategories = Category::getCategories();

        //get brands
        $getBrands = Brand::where('status', 1)->get()->toArray();

        //Get Filters
        $productsFilters = Product::productsFilters();

        return view("admin.products.add_edit_product", compact("title", "getCategories", "productsFilters", "product", "getBrands"));

    }

    public function deleteProductVideo($id)
    {
        $productVideo = Product::select('product_video')->where('id', $id)->first();

        $product_video_path = 'front/videos/products/';

        if (file_exists($product_video_path . $productVideo->product_video)) {
            unlink($product_video_path . $productVideo->product_video);
        }

        Product::where('id', $id)->update(['product_video' => '']);

        $message = 'Produk Video Berhasil dihapus!';

        return redirect()->back()->with('success_message', $message);
    }

    public function deleteProductImage($id)
    {
        $productImage = ProductsImage::select('image')->where('id', $id)->first();

        $small_image_path = 'front/images/products/small/';
        $medium_image_path = 'front/images/products/medium/';
        $large_image_path = 'front/images/products/large/';

        if (file_exists($small_image_path . $productImage->image)) {
            unlink($small_image_path . $productImage->image);
        }
        if (file_exists($medium_image_path . $productImage->image)) {
            unlink($medium_image_path . $productImage->image);
        }
        if (file_exists($large_image_path . $productImage->image)) {
            unlink($large_image_path . $productImage->image);
        }

        ProductsImage::where('id', $id)->delete();
        $message = 'Gambar produk berhasil di hapus!';

        return redirect()->back()->with('success_message', $message);
    }

    public function updateAttributeStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $status = ($data['status'] == "Active") ? 0 : 1;

            ProductsAttribute::where("id", $data['attribute_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'attribute_id' => $data['attribute_id']]);
        }
    }

    public function deleteAttribute($id)
    {
        //Delete CMSPage
        ProductsAttribute::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Atribut Berhasil Dihapus!');
    }
    public function truncateProduct()
    {
        // Nonaktifkan foreign key check jika perlu
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->back()->with('success', 'Semua produk berhasil dihapus!');
    }
    public function truncateOrder()
    {
        // Nonaktifkan foreign key check jika perlu
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Order::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect()->back()->with('success', 'Semua Order berhasil dihapus!');
    }
}
