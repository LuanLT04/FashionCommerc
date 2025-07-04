<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DetailsOrder;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product; 
use Illuminate\Support\Facades\DB;

class DetailsOrderController extends Controller
{
    public function addDetailsOrder(Request $request)
    {
        $data = $request->all();
        $address = $data['address'];
        $total = $data['total'];

        $user_id = session('cart')['user_id'];
        $cart = DB::table('carts')
        ->where('carts.id_user', "=", $user_id)
        ->get();

        $id_order = DB::table('order')
        ->where('id_user', $user_id)
        ->latest()
        ->value('id_order');       

        foreach($cart as $value)
        {
            // Tạo chi tiết đơn hàng
            $product = Product::find($value->id_product);
            $detailOrder = DetailsOrder::create([
                'id_order' => $id_order,
                'id_product' => $value->id_product,
                'quantity_detailsorder' => $value->quantity_product,
                'product_name' => $product->name_product,
                'image' => $product->image_address_product,
            ]);

            // Cập nhật số lượt mua cho sản phẩm
            if ($product) {
                $product->purchased += $value->quantity_product;
                $product->save();
            }
        }

        $order = Order::where('id_order', $id_order)->first();
        $order->address = $address;
        $order->total_order = $total;
        $order->save();

        Cart::where('id_user', $user_id)->delete();

        return redirect()->route('home.index');
    }

    public function detailsOrderIndex(Request $request)
    {
        $id_order = $request->get('id_order');
        $id_user = $request->get('id_user');
        
        // Kiểm tra nếu id_order không phải là số
        if (!is_numeric($id_order)) {
            return redirect()->route('order.orderIndex')->with('error', 'Không tìm thấy trang');
        }
        
        // Kiểm tra xem đơn hàng có tồn tại và thuộc về user không
        $orderExists = Order::where('id_order', $id_order)
                          ->where('id_user', $id_user)
                          ->exists();
                          
        if (!$orderExists) {
            return redirect()->route('order.orderIndex')->with('error', 'Không tìm thấy trang');
        }

        // Lấy thông tin chính của đơn hàng (bao gồm cả thông tin user)
        $order = Order::with(['user', 'paymentMethod'])->where('id_order', $id_order)->first();

        // Lấy danh sách chi tiết sản phẩm trong đơn hàng
        $orderDetails = DB::table('products')
            ->join('detailsorder', 'products.id_product', "=", 'detailsorder.id_product')
            ->where('detailsorder.id_order', "=", $id_order)
            ->get();

        // Thêm cartCount và orderCount
        $cartCount = \App\Models\Cart::where('id_user', $id_user)->count();
        $orderCount = \App\Models\Order::where('id_user', $id_user)->count();

        // Lấy tên phương thức thanh toán từ bảng payment_methods
        $paymentMethodName = $order->paymentMethod ? $order->paymentMethod->name : null;

        return view('user.mydeatilorder', compact('order', 'orderDetails', 'cartCount', 'orderCount', 'paymentMethodName'));
    }
}