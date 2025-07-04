<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\Manufacturer;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
    public function boot(): void
    {
        Paginator::useBootstrap();
        View::composer('user.*', function ($view) {
            $manufacturers = Manufacturer::all();
            $cartCount = 0;
            $orderCount = 0;
            if (Session::get('id_user')) {
                $cartCount = Cart::where('id_user', Session::get('id_user'))->count();
                $orderCount = Order::where('id_user', Session::get('id_user'))->count();
            }
            $view->with(compact('manufacturers', 'cartCount', 'orderCount'));
        });
    }
}
