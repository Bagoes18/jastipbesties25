<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Banner;

class IndexController extends Controller
{
    public function index()
    {

        $homeSlideBanners = Banner::where('type', 'Slider')->where('status', 1)->orderBy('sort', 'ASC')->get()->toArray();
        $homeFixBanners = Banner::where('type', 'Fix')->where('status', 1)->orderBy('sort', 'ASC')->get()->toArray();

        $newProducts = Product::with(['brand', 'images'])->where('status', 1)->orderBy('id', 'Desc')->limit(4)->get()->toArray();
        $bestSellers = Product::with(['brand', 'images'])->where(['is_bestseller' => 'Yes', 'status' => 1])->inRandomOrder()->limit(4)->get()->toArray();
        $discountedProducts = Product::with(['brand', 'images'])->where('product_discount', '>', 0)->where('status', 1)->inRandomOrder()->limit(4)->get()->toArray();
        $featuredProducts = Product::with(['brand', 'images'])->where(['is_featured' => 'Yes', 'status' => 1])->inRandomOrder()->limit(4)->get()->toArray();
        // dd($newProducts);
        return view('front.index', compact('homeSlideBanners', 'homeFixBanners', 'newProducts', 'bestSellers', 'discountedProducts', 'featuredProducts'));
    }
}
