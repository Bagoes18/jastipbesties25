<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BannersController;

Route::get('/', function () {
    return view('welcome');
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
    });
});
