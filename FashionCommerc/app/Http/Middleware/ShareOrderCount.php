<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\View;

class ShareOrderCount
{
    public function handle(Request $request, Closure $next)
    {
        if (session('cart') && isset(session('cart')['user_id'])) {
            $orderCount = Order::where('id_user', session('cart')['user_id'])->count();
        } else {
            $orderCount = 0;
        }

        // Chia sẻ biến orderCount với tất cả các view
        View::share('orderCount', $orderCount);

        return $next($request);
    }
} 