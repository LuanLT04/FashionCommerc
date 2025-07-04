<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function addOrder(Request $request)
    {
        $user_id = session('cart')['user_id'];
        $address = $request->input('address', '');
        $payment_method_id = $request->input('payment_method_id');

        $cartItems = \App\Models\Cart::where('id_user', $user_id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.indexCart')->with('error', 'Giỏ hàng trống, không thể đặt hàng!');
        }

        // Tính tổng tiền
        $total = $cartItems->sum('total_cart');

        // Lấy thông tin phương thức thanh toán
        $paymentMethod = \App\Models\PaymentMethod::find($payment_method_id);
        $user = \App\Models\User::find($user_id);

        if ($paymentMethod && strtolower($paymentMethod->name) === 'ví') {
            // Thanh toán bằng ví
            if ($user->balance < $total) {
                return redirect()->route('cart.indexCard')->with('error', 'Số dư ví không đủ để thanh toán!');
            }
            // Trừ tiền trong ví
            $user->balance -= $total;
            $user->save();
            $payment_status = 'paid';
        } else {
            $payment_status = 'unpaid';
        }

        // Tạo đơn hàng mới
        $order = Order::create([
            'id_user' => $user_id,
            'total_order' => $total,
            'address' => $address,
            'payment_method_id' => $payment_method_id,
            'payment_status' => $payment_status,
        ]);

        // Nếu thanh toán bằng ví, ghi nhận transaction sau khi đã có order
        if ($paymentMethod && strtolower($paymentMethod->name) === 'ví' && isset($order->id_order)) {
            \App\Models\Transaction::create([
                'user_id' => $user_id,
                'type' => 'withdraw',
                'amount' => $total,
                'status' => 'success',
                'description' => 'Thanh toán đơn hàng #' . $order->id_order,
            ]);
            // Cập nhật trạng thái đơn hàng thành completed
            $order->status = 'completed';
            $order->save();
        }

        // Tạo chi tiết đơn hàng cho từng sản phẩm
        foreach ($cartItems as $item) {
            $product = $item->product;
            \App\Models\DetailsOrder::create([
                'id_order' => $order->id_order,
                'id_product' => $item->id_product,
                'quantity_detailsorder' => $item->quantity_product,
                'product_name' => $product->name_product ?? '',
                'image' => $product->image_address_product ?? '',
            ]);
        }

        // Xóa giỏ hàng
        \App\Models\Cart::where('id_user', $user_id)->delete();
        // Cập nhật số lượng đơn hàng
        $orderCount = Order::where('id_user', $user_id)->count();
        session(['order_count' => $orderCount]);

        return redirect()->route('order.orderIndex')->with('success', 'Đặt hàng thành công!');
    }

    public function orderIndex()
    {
        $user_id = session('cart')['user_id'];

        $order = DB::table('order')
        ->where('id_user', "=", $user_id)
        ->get();

        // Thêm cartCount và orderCount
        $cartCount = \App\Models\Cart::where('id_user', $user_id)->count();
        $orderCount = \App\Models\Order::where('id_user', $user_id)->count();

        return view('user.myorder', [
            'order' => $order,
            'cartCount' => $cartCount,
            'orderCount' => $orderCount
        ]);
    }
    
    public function showOrder()
    {
        $order = Order::where('id_user', auth()->id())->orderBy('created_at', 'desc')->get();
    
        return view('user.myorder', compact('order')); 
    }

    public function getCount()
    {
        if (!session('cart') || !isset(session('cart')['user_id'])) {
            return response()->json(['count' => 0]);
        }

        $orderCount = Order::where('id_user', session('cart')['user_id'])->count();
        return response()->json(['count' => $orderCount]);
    }
    public function deleteOrder($id_order)
    {
        try {
            DB::beginTransaction();
            
            $user_id = session('cart')['user_id'];
            
            // Check if order exists and belongs to user
            $order = Order::where('id_order', $id_order)
                         ->where('id_user', $user_id)
                         ->first();
                         
            if (!$order) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Xóa không hợp lệ vui lòng load lại trang');
            }
            
            // Delete the order
            $order->delete();
            
            // Update order count
            $orderCount = Order::where('id_user', $user_id)->count();
            session(['order_count' => $orderCount]);
            
            DB::commit();
            return redirect()->back()->with('success', 'Xóa đơn hàng thành công');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Xóa không hợp lệ vui lòng load lại trang');
        }
    }


}
