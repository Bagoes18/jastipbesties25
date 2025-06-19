<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\CmsPage;
use Session;

class IndexController extends Controller
{
    public function index()
    {
        Session::put("page", 'home');
        $homeSlideBanners = Banner::where('type', 'Slider')->where('status', 1)->orderBy('sort', 'ASC')->get()->toArray();
        $homeFixBanners = Banner::where('type', 'Fix')->where('status', 1)->orderBy('sort', 'ASC')->get()->toArray();

        $cmspages = CmsPage::where('status', 1)->get()->toArray();

        $newProducts = Product::with(['brand', 'images'])->where('status', 1)->orderBy('id', 'Desc')->limit(4)->get()->toArray();
        $bestSellers = Product::with(['brand', 'images'])->where(['is_bestseller' => 'Yes', 'status' => 1])->inRandomOrder()->limit(4)->get()->toArray();
        $discountedProducts = Product::with(['brand', 'images'])->where('product_discount', '>', 0)->where('status', 1)->inRandomOrder()->limit(4)->get()->toArray();
        $featuredProducts = Product::with(['brand', 'images'])->where(['is_featured' => 'Yes', 'status' => 1])->inRandomOrder()->limit(4)->get()->toArray();
        // dd($cmspages);
        return view('front.index', compact('homeSlideBanners', 'homeFixBanners', 'newProducts', 'bestSellers', 'discountedProducts', 'featuredProducts', 'cmspages'));
    }

    public function cmspage($url)
    {
        $detailcontent = CmsPage::where('url', $url)->where('status', 1)->firstOrFail();
        return view('front.sop', compact('detailcontent'));
    }

}
