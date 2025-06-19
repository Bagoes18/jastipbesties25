<?php


use App\Http\Controllers\Front\IndexController;
use App\Models\CmsPage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BannersController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\front\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;


Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest');

Route::get('/register', function () {
    return view('auth.register');
})->middleware('guest');

Route::get('/request', function () {
    Session::put("page", 'request');
    return view('front.products.request');
});

Route::get('/home', function () {
    return redirect('/');
});

Route::get('/keranjang', [OrderController::class, 'index'])->name('index.order')->middleware('auth');
Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout.order')->middleware('auth');
Route::post('/orderstore', [OrderController::class, 'store'])->name('store.order')->middleware('auth');
Route::get('/deleteorder/{id}', [OrderController::class, 'delete'])->name('delete.order');
Route::get('/riwayat', [OrderController::class, 'riwayat'])->name('riwayat.order')->middleware('auth');

Route::get('/payment/{id}', [PaymentController::class, 'index'])->name('payment.order')->middleware('auth');
Route::post('/payment/{id}', [PaymentController::class, 'store'])->name('payment.store')->middleware('auth');

Route::post('/request', [ProductController::class, 'request'])->name('send.request')->middleware('auth');

Route::post('login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

Route::get('/invoice/{checkout_id}/{user_id}', [OrderController::class, 'printInvoice'])->name('orders.invoice');
Route::get('/page/{url}', [IndexController::class, 'cmspage'])->name('cms.page');




Route::
        namespace('App\Http\Controllers\Front')->group(function () {
            Route::get('/', [IndexController::class, 'index'])->name('index');

            $catUrls = Category::select('url')->where('status', 1)->get()->pluck('url');
            foreach ($catUrls as $key => $url) {
                Route::get($url, 'ProductController@listing');
            }

            // $cmsUrls = CmsPage::select('url')->where('status', 1)->get()->pluck('url');
            // foreach ($cmsUrls as $key => $url) {
            //     Route::get($url, 'IndexController@cmspages');
            // }
        
            Route::get('product/{id}', 'ProductController@detail');
            //search
            Route::get('search-products', 'ProductController@listing');
        });

Route::prefix('admin')->group(function () {
    // Login routes
    Route::match(['get', 'post'], 'login', [AdminController::class, 'login'])->middleware(['guest:admin', 'prevent-back-history']);

    Route::middleware(['admin'])->group(function () {
        // Admin account
        Route::get('dashboard', [AdminController::class, 'dashboard']);
        Route::match(['get', 'post'], 'update-details', [AdminController::class, 'updateDetails']);
        Route::match(['get', 'post'], 'update-password', [AdminController::class, 'updatePassword']);
        Route::post('check-current-password', [AdminController::class, 'checkCurrentPassword']);
        Route::get('logout', [AdminController::class, 'logout']);
        // CMS Pages
        Route::get('cms-pages', [CmsController::class, 'index']);
        Route::post('update-cms-page-status', [CmsController::class, 'update']);
        Route::match(['get', 'post'], 'add-edit-cms-page/{id?}', [CmsController::class, 'edit']);
        Route::get('delete-cms-page/{id?}', [CmsController::class, 'destroy']);
        // Subadmin
        Route::get('subadmins', [AdminController::class, 'subadmins']);
        Route::post('update-subadmin-status', [AdminController::class, 'updateSubadminStatus']);
        Route::match(['get', 'post'], 'add-edit-subadmin/{id?}', [AdminController::class, 'addEditSubadmin']);
        Route::get('delete-subadmin/{id?}', [AdminController::class, 'deleteSubadmin']);
        Route::match(['get', 'post'], 'update-role/{id}', [AdminController::class, 'updateRole']);
        // Categories
        Route::get('categories', [CategoryController::class, 'categories']);
        Route::post('update-category-status', [CategoryController::class, 'updateCategoryStatus']);
        Route::get('delete-category/{id?}', [CategoryController::class, 'deleteCategory']);
        Route::match(['get', 'post'], 'add-edit-category/{id?}', [CategoryController::class, 'addEditCategory']);
        Route::get('delete-category-image/{id?}', [CategoryController::class, 'deleteCategoryImage']);
        // Products
        Route::get('products', [ProductsController::class, 'products']);
        Route::post('update-product-status', [ProductsController::class, 'updateProductStatus']);
        Route::get('delete-product/{id?}', [ProductsController::class, 'deleteProduct']);
        Route::match(['get', 'post'], 'add-edit-product/{id?}', [ProductsController::class, 'addEditProduct']);
        Route::get('delete-product-video/{id?}', [ProductsController::class, 'deleteProductVideo']);
        Route::get('delete-product-image/{id?}', [ProductsController::class, 'deleteProductImage']);
        Route::post('update-attribute-status', [ProductsController::class, 'updateAttributeStatus']);
        Route::get('delete-attribute/{id?}', [ProductsController::class, 'deleteAttribute']);
        // Brands
        Route::get('brands', [BrandController::class, 'brands']);
        Route::post('update-brand-status', [BrandController::class, 'updateBrandStatus']);
        Route::get('delete-brand/{id?}', [BrandController::class, 'deleteBrand']);
        Route::match(['get', 'post'], 'add-edit-brand/{id?}', [BrandController::class, 'addEditBrand']);
        Route::get('delete-brand-image/{id?}', [BrandController::class, 'deleteBrandImage']);
        Route::get('delete-brand-logo/{id?}', [BrandController::class, 'deleteBrandLogo']);
        // Banners
        Route::get('banners', [BannersController::class, 'banners']);
        Route::post('update-banner-status', [BannersController::class, 'updateBannerStatus']);
        Route::get('delete-banner/{id?}', [BannersController::class, 'deleteBanner']);
        Route::match(['get', 'post'], 'add-edit-banner/{id?}', [BannersController::class, 'addEditBanner']);
        // Pesanan
        Route::get('pesanan', [PesananController::class, 'pesanan']);
        Route::get('payment/accept/{id}', [PesananController::class, 'acceptPayment'])->name('payment.accept');
        Route::get('payment/reject/{id}', [PesananController::class, 'rejectPayment'])->name('payment.reject');
        // Request
        Route::get('request', [PesananController::class, 'request']);
        //laporan
        Route::get('laporan', [PesananController::class, 'laporan']);
        Route::get('export', [PesananController::class, 'export'])->name('export');
        // User
        Route::get('user', [AdminController::class, 'users']);
        Route::get('delete-user/{id?}', [AdminController::class, 'deleteUser'])->name('delete.user');
        Route::post('update-user/{id?}', [AdminController::class, 'updateUser']);
        Route::post('add-user', [AdminController::class, 'addUser']);
    });
});
