<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use App\Models\PaymentMethod;

class CartController extends Controller
{
    public function indexCard(Request $request)
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

        $paymentMethods = PaymentMethod::where('is_active', true)->get();

        // Thêm cartCount và orderCount
        $cartCount = \App\Models\Cart::where('id_user', $user_id)->count();
        $orderCount = \App\Models\Order::where('id_user', $user_id)->count();
        
        return view('user.cart', [
            'product' => $product,
            'totalAll' => $totalAll,
            'cartCount' => $cartCount,
            'orderCount' => $orderCount,
            'paymentMethods' => $paymentMethods
        ]);
    }

    public function addCart(Request $request)
    {
        $data = $request->all();
        $product = Product::where('id_product', $data['id_product'])->first();
        $total_cart = $data['quantity_cart'] * $product->price_product;
        
        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $carts = Cart::where('id_user', session('cart')['user_id'])
            ->where('id_product', $product->id_product)
            ->first();
            
        if ($carts) {
            // Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng và tổng giá
            $carts->quantity_product += $data['quantity_cart'];
            $carts->total_cart += $total_cart;
            $carts->save();
        } else {
            // Nếu sản phẩm chưa có trong giỏ hàng, tạo một mục giỏ hàng mới
            Cart::create([
                'id_user' => session('cart')['user_id'],
                'id_product' => $product->id_product,
                'quantity_product' => $data['quantity_cart'],
                'total_cart' => $total_cart,
            ]);
        }

        // Lấy tổng số lượng sản phẩm trong giỏ hàng
        $cartCount = Cart::where('id_user', session('cart')['user_id'])->sum('quantity_product');
        
        // Cập nhật session cart count
        session(['cart_count' => $cartCount]);
        
        return response()->json([
            'success' => true,
            'message' => 'Thêm vào giỏ hàng thành công',
            'cartCount' => $cartCount,
            'redirect' => route('cart.indexCart')
        ]);
    }

    public function getCount()
    {
        if (!session('cart') || !isset(session('cart')['user_id'])) {
            return response()->json(['count' => 0]);
        }

        $cartCount = Cart::where('id_user', session('cart')['user_id'])->sum('quantity_product');
        return response()->json(['count' => $cartCount]);
    }

    public function deleteProductCart(Request $request)
    {
        $productId = $request->get('id');
        $user_id = session('cart')['user_id'];
        Cart::where('id_user', $user_id)
            ->where('id_product', $productId)
            ->delete();
            
        // Cập nhật lại số lượng giỏ hàng
        $cartCount = Cart::where('id_user', $user_id)->sum('quantity_product');
        session(['cart_count' => $cartCount]);
        
        return redirect()->back();
    }

    public function indexCheckout(){
        return view('user.');
    }

    public function updateQuantity(Request $request)
    {
        $user_id = session('cart')['user_id'];
        $id = $request->get('id');
        $type = $request->get('type');
        $cart = Cart::where('id_user', $user_id)->where('id_product', $id)->first();
        if (!$cart) {
            return redirect()->route('cart.indexCart')->with('error', 'Không tìm thấy sản phẩm trong giỏ hàng');
        }
        if ($type === 'increase') {
            $cart->quantity_product += 1;
        } elseif ($type === 'decrease') {
            if ($cart->quantity_product > 1) {
                $cart->quantity_product -= 1;
            }
        }
        $product = Product::where('id_product', $id)->first();
        $cart->total_cart = $cart->quantity_product * ($product ? $product->price_product : 0);
        $cart->save();
        return redirect()->route('cart.indexCart');
    }
}