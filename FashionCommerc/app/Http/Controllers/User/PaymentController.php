<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function paymentIndex()
    {
        $user_id = session('cart')['user_id'];
        $product = DB::table('products')
        ->join('carts', 'products.id_product', '=', 'carts.id_product')
        ->where('carts.id_user', "=", $user_id)
        ->get();

        $totalAll = 0;
        
        foreach ($product as $item) {
            $totalAll += $item->total_cart;
        }
        
        return view('user.payment', ['product' => $product, 'totalAll' => $totalAll]);
    }
}
