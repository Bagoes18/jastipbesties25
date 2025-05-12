<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Category;

class ProductController extends Controller
{
    public function listing()
    {
        $url = Route::getFacadeRoot()->current()->uri;
        $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
        if ($categoryCount > 0) {
            $categoryDetails = Category::getCategoryDetails($url);
            // dd($categoryDetails);
            // $categoryProducts = Product::with(['brand', 'images'])->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1)->orderBy('id', 'Desc')->get()->toArray();
            $categoryProducts = Product::with(['brand', 'images'])->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);
            // dd($categoryProducts);

            // sorting Query
            if (isset($_GET['sort']) && !empty($_GET['sort'])) {
                $sort = $_GET['sort'];
                if ($sort == "product_latest") {
                    $categoryProducts->orderBy('id', 'Desc');
                    // dd($categoryProducts);
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
            }
            $categoryProducts = $categoryProducts->paginate(6);

            return view('front.products.listing', compact('categoryDetails', 'categoryProducts', 'url'));

        } else {
            abort(404);
        }

    }
}
