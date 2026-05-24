<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Brand;
use App\Models\RequestProduct;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // public function request(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //     ]);

    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $imageName = time() . '.' . $image->getClientOriginalExtension();
    //         $image->storeAs('storage/RequestProduct', $imageName);

    //     }

    //     $requests = new RequestProduct();
    //     $requests->name = $request->name;
    //     if ($request->hasFile('image')) {
    //         $requests->image = $imageName;
    //     }
    //     $requests->save();
    //     return redirect()->back()->with('success', 'Request sent successfully');
    // }

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
    public function showRequestPage()
    {
        Session::put("page", "request");

        if (auth()->check()) {
            return view("front.products.request");
        }

        return view("front.products.request");
    }

    public function request(Request $request)
    {
        // Jika ada field 'reference', ini adalah pengecekan status
        if ($request->has("reference")) {
            return $this->cekStatus($request);
        }

        // Otherwise, ini adalah pengajuan request produk (harus login)
        if (!auth()->check()) {
            return redirect()->route("login");
        }

        Session::put("page", "request");
        $request->validate([
            "name" => "required",
            "image" => "nullable|image|mimes:jpeg,jpg,png|max:2048",
        ]);

        $imageName = null;

        if ($request->hasFile("image")) {
            $image = $request->file("image");
            $imageName = time() . "." . $image->getClientOriginalExtension();
            $destinationPath = public_path("front/images");

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $img = Image::make($image)->resize(800, null, function (
                $constraint,
            ) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save($destinationPath . "/" . $imageName);
        }

        do {
            $reference =
                "R" . now()->format("YmdHis") . strtoupper(Str::random(5));
        } while (RequestProduct::where("reference", $reference)->exists());

        $requests = new RequestProduct();
        $requests->reference = $reference;
        $requests->user_id = auth()->user()->id;
        $requests->name = $request->name;
        if ($imageName) {
            $requests->image = $imageName;
        }
        $requests->status = "pending";
        $requests->save();

        return redirect()
            ->back()
            ->with("success_message", "Request Berhasil dikirim");
    }
    public function listing()
    {
        Session::put("page", "product");
        $categories = Category::getCategories();
        $brands = Brand::all();

        $url = Route::getFacadeRoot()->current()->uri;
        $categoryCount = Category::where([
            "url" => $url,
            "status" => 1,
        ])->count();

        if ($categoryCount > 0) {
            $categoryDetails = Category::getCategoryDetails($url);

            $categoryProducts = Product::with(["brand", "images"])
                ->whereIn("category_id", $categoryDetails["catIds"])
                ->where("status", 1);

            // Filter by brand
            if (!empty(request()->get("brand"))) {
                $brandUrl = request()->get("brand");
                $brand = Brand::where("url", $brandUrl)->first();
                if ($brand) {
                    $categoryProducts->where("brand_id", $brand->id);
                }
            }

            // Sorting
            $sort = request()->get("sort");
            if ($sort == "product_latest") {
                $categoryProducts->orderBy("id", "Desc");
            } elseif ($sort == "lowest_price") {
                $categoryProducts->orderBy("final_price", "Asc");
            } elseif ($sort == "highest_price") {
                $categoryProducts->orderBy("final_price", "Desc");
            } elseif ($sort == "best_selling") {
                $categoryProducts->where("is_bestseller", "Yes");
            } elseif ($sort == "featured_items") {
                $categoryProducts->where("is_featured", "Yes");
            } elseif ($sort == "discounted_items") {
                $categoryProducts->where("product_discount", ">", 0);
            } else {
                $categoryProducts->orderBy("id", "Desc");
            }

            $categoryProducts = $categoryProducts->paginate(6);

            return view(
                "front.products.listing",
                compact(
                    "categoryDetails",
                    "brands",
                    "categoryProducts",
                    "url",
                    "categories",
                ),
            );
        } elseif (isset($_GET["query"]) && !empty($_GET["query"])) {
            $search = $_GET["query"];

            $categoryDetails = [
                "category_details" => [
                    "category_name" => "Hasil pencarian: " . $search,
                    "description" => "",
                    "image" => "",
                ],
                "breadcrumbs" =>
                    '<li class="active">Pencarian: ' . $search . "</li>",
                "catIds" => [],
            ];

            $categoryProducts = Product::with(["brand", "images"])
                ->where(function ($query) use ($search) {
                    $query
                        ->where("product_name", "like", "%" . $search . "%")
                        ->orWhere("product_code", "like", "%" . $search . "%")
                        ->orWhere("product_color", "like", "%" . $search . "%")
                        ->orWhere("description", "like", "%" . $search . "%");
                })
                ->where("status", 1)
                ->paginate(9);

            $categories = Category::getCategories();
            $brands = Brand::all();

            // $url = Route::getFacadeRoot()->current()->uri;
            // $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();

            $url = url("/search-products") . "?query=" . $search;

            return view(
                "front.products.listing",
                compact(
                    "categoryDetails",
                    "categoryProducts",
                    "categories",
                    "brands",
                    "url",
                ),
            );
        } else {
            abort(404);
        }
    }

    public function detail($id)
    {
        Session::put("page", "product");
        $productDetails = Product::with([
            "category",
            "brand",
            "attributes",
            "images",
        ])->find($id);
        if (!$productDetails) {
            abort(404);
        }
        return view("front.products.detail", compact("productDetails"));
    }

    public function cekStatus(Request $request)
    {
        Session::put("page", "request");
        $request->validate([
            "reference" => "required|string",
        ]);

        $req = RequestProduct::where("reference", $request->reference)->first();

        if (!$req) {
            return redirect()
                ->route("request.page")
                ->with(
                    "error_message",
                    "Referensi tidak ditemukan. Silakan cek kembali.",
                );
        }

        return view("front.products.request", compact("req"));
    }
}
