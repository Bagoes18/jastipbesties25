<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Brand;

class ProductController extends Controller
{
    // public function listing()
    // {
    //     $categories = Category::getCategories();
    //     $brands = Brand::all();
    //     // dd($brand);

    //     $url = Route::getFacadeRoot()->current()->uri;
    //     $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
    //     if ($categoryCount > 0) {
    //         $categoryDetails = Category::getCategoryDetails($url);
    //         // dd($categoryDetails);
    //         // $categoryProducts = Product::with(['brand', 'images'])->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1)->orderBy('id', 'Desc')->get()->toArray();
    //         $categoryProducts = Product::with(['brand', 'images'])->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);
    //         // dd($categoryProducts);

    //         // sorting Query
    //         if (isset($_GET['sort']) && !empty($_GET['sort'])) {
    //             $sort = $_GET['sort'];
    //             if ($sort == "product_latest") {
    //                 $categoryProducts->orderBy('id', 'Desc');
    //                 // dd($categoryProducts);
    //             } elseif ($sort == "lowest_price") {
    //                 $categoryProducts->orderBy('final_price', 'Asc');
    //             } elseif ($sort == "highest_price") {
    //                 $categoryProducts->orderBy('final_price', 'Desc');
    //             } elseif ($sort == "best_selling") {
    //                 $categoryProducts->where('is_bestseller', 'Yes');
    //             } elseif ($sort == "featured_items") {
    //                 $categoryProducts->where('is_featured', 'Yes');
    //             } elseif ($sort == "discounted_items") {
    //                 $categoryProducts->where('product_discount', '>', 0);
    //             } else {
    //                 $categoryProducts->orderBy('id', 'Desc');
    //             }
    //         }
    //         $categoryProducts = $categoryProducts->paginate(6);

    //         return view('front.products.listing', compact('categoryDetails', 'brands', 'categoryProducts', 'url', 'categories'));

    //     } else {
    //         abort(404);
    //     }

    // }
    public function listing()
    {
        $categories = Category::getCategories();
        $brands = Brand::all();

        $url = Route::getFacadeRoot()->current()->uri;
        $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();

        if ($categoryCount > 0) {
            $categoryDetails = Category::getCategoryDetails($url);

            $categoryProducts = Product::with(['brand', 'images'])
                ->whereIn('category_id', $categoryDetails['catIds'])
                ->where('status', 1);

            // Filter by brand
            if (!empty(request()->get('brand'))) {
                $brandUrl = request()->get('brand');
                $brand = Brand::where('url', $brandUrl)->first();
                if ($brand) {
                    $categoryProducts->where('brand_id', $brand->id);
                }
            }

            // Sorting
            $sort = request()->get('sort');
            if ($sort == "product_latest") {
                $categoryProducts->orderBy('id', 'Desc');
            } elseif ($sort == "lowest_price") {
                $categoryProducts->orderBy('final_price', 'Asc');
            } elseif ($sort == "highest_price") {
                $categoryProducts->orderBy('final_price', 'Desc');
            } elseif ($sort == "best_selling") {
                $categoryProducts->where('is_bestseller', 'Yes');
            } elseif ($sort == "featured_items") {
                $categoryProducts->where('is_featured', 'Yes');
            } elseif ($sort == "discounted_items") {
                $categoryProducts->where('product_discount', '>', 0);
            } else {
                $categoryProducts->orderBy('id', 'Desc');
            }

            $categoryProducts = $categoryProducts->paginate(6);

            return view('front.products.listing', compact('categoryDetails', 'brands', 'categoryProducts', 'url', 'categories'));
        } else {
            abort(404);
        }
    }

    public function detail($id)
    {
        $productDetails = Product::with(['category', 'brand', 'attributes', 'images'])->find($id);
        if (!$productDetails) {
            abort(404);
        }
        // dd($productDetails);
        // Produk yang sama berdasarkan kategori
        // $relatedProducts = Product::with(['brand', 'images'])
        //     ->where('category_id', $productDetails->category_id)
        //     ->where('id', '!=', $productDetails->id) // exclude current product
        //     ->where('status', 1)
        //     ->inRandomOrder()
        //     ->take(4)
        //     ->get();
        // dd($relatedProducts);
        return view('front.products.detail', compact('productDetails'));
    }


}
