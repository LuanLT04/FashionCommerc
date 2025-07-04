<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\View;

class ShareCartCount
{
    public function handle(Request $request, Closure $next)
    {
        if (session('cart') && isset(session('cart')['user_id'])) {
            $cartCount = Cart::where('id_user', session('cart')['user_id'])->sum('quantity_product');
        } else {
            $cartCount = 0;
        }

        // Chia sẻ biến cartCount với tất cả các view
        View::share('cartCount', $cartCount);

        return $next($request);
    }
} 