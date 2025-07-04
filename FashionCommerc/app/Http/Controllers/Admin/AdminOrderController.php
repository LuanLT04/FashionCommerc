<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\DetailsOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    public function orderindexAdmin(Request $request)
    {
        $query = Order::query();

        // Lọc theo mã đơn hàng
        if ($request->filled('id_order')) {
            $query->where('id_order', $request->id_order);
        }
        // Lọc theo khách hàng
        if ($request->filled('id_user')) {
            $query->where('id_user', $request->id_user);
        }
        // Lọc theo trạng thái đơn hàng
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        // Lọc theo trạng thái thanh toán
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }
        // Lọc theo phương thức thanh toán
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
            }
        // Lọc theo thời gian
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $order = $query->with('paymentMethod')->orderBy('created_at', 'desc')->paginate(10);

        // Lấy danh sách trạng thái, phương thức thanh toán để render filter
        $statusList = [
            'pending' => 'Chờ xác nhận',
            'processing' => 'Đang xử lý',
            'shipping' => 'Đang giao',
            'completed' => 'Đã giao',
            'cancelled' => 'Đã huỷ',
        ];
        $paymentStatusList = [
            'unpaid' => 'Chưa thanh toán',
            'paid' => 'Đã thanh toán',
            'partial' => 'Thanh toán một phần',
        ];
        $paymentMethodList = [
            'cod' => 'COD',
            'bank' => 'Chuyển khoản',
            'wallet' => 'Ví điện tử',
        ];

        return view('admin.order.orderindex', [
            'order' => $order,
            'statusList' => $statusList,
            'paymentStatusList' => $paymentStatusList,
            'paymentMethodList' => $paymentMethodList,
            'request' => $request,
        ]);
    }

    public function adminDetailsOrderIndex(Request $request)
    {
        $id_order = $request->get('id_order');
        if (!is_numeric($id_order)) {
            return redirect()->route('admin.orderindexAdmin')->with('error', 'Không tìm thấy trang');
        }
        $order = Order::where('id_order', $id_order)->first();
        if (!$order) {
            return redirect()->route('admin.orderindexAdmin')->with('error', 'Không tìm thấy trang');
        }
        $user = \App\Models\User::where('id_user', $order->id_user)->first();
        $details = \App\Models\DetailsOrder::where('id_order', $id_order)->get();
        $products = [];
        foreach ($details as $detail) {
            $product = \App\Models\Product::where('id_product', $detail->id_product)->first();
            if ($product) {
                $products[] = [
                    'name' => $product->name_product,
                    'image' => $product->image_address_product,
                    'quantity' => $detail->quantity_detailsorder,
                    'price' => $product->price_product,
                    'total' => $product->price_product * $detail->quantity_detailsorder,
                ];
            }
        }
        // Tính tổng tiền, chiết khấu, phí ship, tổng thanh toán
        $total = $order->total_order;
        $shipping_fee = $order->shipping_fee ?? 0;
        $discount = $order->discount ?? 0;
        $final_total = $total + $shipping_fee - $discount;
        // Lấy tên phương thức thanh toán từ bảng payment_methods
        $paymentMethodName = $order->paymentMethod ? $order->paymentMethod->name : null;
        // Lấy danh sách phương thức thanh toán từ bảng payment_methods
        $paymentMethodList = \App\Models\PaymentMethod::pluck('name', 'id')->toArray();
        // Trạng thái
        $statusList = [
            'pending' => 'Chờ xác nhận',
            'processing' => 'Đang xử lý',
            'shipping' => 'Đang giao',
            'completed' => 'Đã giao',
            'cancelled' => 'Đã huỷ',
        ];
        $paymentStatusList = [
            'unpaid' => 'Chưa thanh toán',
            'paid' => 'Đã thanh toán',
            'partial' => 'Thanh toán một phần',
        ];
        return view('admin.order.detailorder', [
            'order' => $order,
            'user' => $user,
            'products' => $products,
            'total' => $total,
            'shipping_fee' => $shipping_fee,
            'discount' => $discount,
            'final_total' => $final_total,
            'statusList' => $statusList,
            'paymentStatusList' => $paymentStatusList,
            'paymentMethodName' => $paymentMethodName,
            'paymentMethodList' => $paymentMethodList,
        ]);
    }

    public function admindetailsorderdelete(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $id_order = $request->get('id_order');
            
            // Kiểm tra xem đơn hàng có tồn tại không
            $order = Order::where('id_order', $id_order)->first();
            
            if (!$order) {
                DB::rollBack();
                return redirect()->route('admin.orderindexAdmin')->with('error', 'Xóa không hợp lệ vui lòng load lại trang');
            }
            
            // Xóa chi tiết đơn hàng
            DetailsOrder::where('id_order', $id_order)->delete();
            
            // Xóa đơn hàng
            $order->delete();
            
            DB::commit();
            return redirect()->route('admin.orderindexAdmin')->with('success', 'Xóa đơn hàng thành công');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.orderindexAdmin')->with('error', 'Xóa không hợp lệ vui lòng load lại trang');
        }
    }

    public function adminSearchOrder(Request $request)
    {
        $data = $request->all();
        $search = $data['id'];
        $orders = Order::where('id_order', $search)
        ->orWhere('id_user', $search)->get();
        return view('admin.order.findorder', ['orders' => $orders]);
    }

    public function updateOrderStatus(Request $request)
    {
        $request->validate([
            'id_order' => 'required|integer|exists:order,id_order',
            'status' => 'required',
            'payment_status' => 'required',
            'payment_method' => 'required',
        ]);
        $order = Order::where('id_order', $request->id_order)->first();
        if (!$order) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn hàng');
        }
        $current = $order->status;
        $next = $request->status;
        $validTransitions = [
            'pending' => ['processing', 'cancelled'],
            'processing' => ['shipping', 'cancelled'],
            'shipping' => ['completed', 'cancelled'],
            'completed' => [],
            'cancelled' => [],
        ];
        if ($current === $next) {
            // Cho phép cập nhật các trường khác nếu trạng thái không đổi
        } elseif (!in_array($next, $validTransitions[$current] ?? [])) {
            return redirect()->back()->with('error', 'Không thể chuyển trạng thái từ ' . ($current) . ' sang ' . ($next));
        }
        $order->status = $next;
        $order->payment_status = $request->payment_status;
        $order->payment_method = $request->payment_method;
        $order->save();
        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }

    public function cancelOrder(Request $request)
    {
        $id_order = $request->get('id_order');
        $note = $request->get('note');
        $order = Order::where('id_order', $id_order)->first();
        if (!$order) {
            return redirect()->route('admin.orderindexAdmin')->with('error', 'Không tìm thấy đơn hàng');
        }
        $order->status = 'cancelled';
        $order->note = $note;
        $order->save();
        return redirect()->route('admin.orderindexAdmin')->with('success', 'Đã huỷ đơn hàng!');
    }

    public function printInvoice($id_order)
    {
        $order = Order::where('id_order', $id_order)->first();
        if (!$order) {
            return redirect()->route('admin.orderindexAdmin')->with('error', 'Không tìm thấy đơn hàng');
        }
        $user = \App\Models\User::where('id_user', $order->id_user)->first();
        $details = \App\Models\DetailsOrder::where('id_order', $id_order)->get();
        $products = [];
        foreach ($details as $detail) {
            $product = \App\Models\Product::where('id_product', $detail->id_product)->first();
            if ($product) {
                $products[] = [
                    'name' => $product->name_product,
                    'image' => $product->image_address_product,
                    'quantity' => $detail->quantity_detailsorder,
                    'price' => $product->price_product,
                    'total' => $product->price_product * $detail->quantity_detailsorder,
                ];
            }
        }
        $total = $order->total_order;
        $shipping_fee = $order->shipping_fee ?? 0;
        $discount = $order->discount ?? 0;
        $final_total = $total + $shipping_fee - $discount;
        return view('admin.order.invoice', [
            'order' => $order,
            'user' => $user,
            'products' => $products,
            'total' => $total,
            'shipping_fee' => $shipping_fee,
            'discount' => $discount,
            'final_total' => $final_total,
        ]);
    }
}
