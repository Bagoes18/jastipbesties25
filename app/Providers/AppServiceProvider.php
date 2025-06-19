<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    // public function boot(): void
    // {
    //     //
    // }


    public function boot()
    {
        Paginator::useBootstrap(); // tambahkan ini
        View::composer('*', function ($view) {
            $cartCount = 0;

            if (Auth::check()) {
                $cartCount = Order::where('user_id', Auth::id())
                    ->whereNull('checkout_id')
                    ->whereNull('payment_id')
                    ->whereNull('status')
                    ->sum('qty');
            }

            $view->with('cartCount', $cartCount);
        });
    }

}
