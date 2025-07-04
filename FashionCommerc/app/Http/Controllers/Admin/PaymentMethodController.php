<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    // Hiển thị danh sách phương thức thanh toán
    public function index()
    {
        $methods = PaymentMethod::all();
        return view('admin.payment_methods.index', compact('methods'));
    }

    // Hiển thị form thêm mới
    public function create()
    {
        return view('admin.payment_methods.create');
    }

    // Lưu phương thức mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        PaymentMethod::create($request->only('name', 'description'));
        return redirect()->route('admin.payment-methods.index')->with('success', 'Thêm phương thức thanh toán thành công!');
    }

    // Hiển thị form sửa
    public function edit($id)
    {
        $method = PaymentMethod::findOrFail($id);
        return view('admin.payment_methods.edit', compact('method'));
    }

    // Cập nhật phương thức
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $method = PaymentMethod::findOrFail($id);
        $method->update($request->only('name', 'description'));
        return redirect()->route('admin.payment-methods.index')->with('success', 'Cập nhật thành công!');
    }

    // Xóa phương thức
    public function destroy($id)
    {
        $method = PaymentMethod::findOrFail($id);
        $method->delete();
        return redirect()->route('admin.payment-methods.index')->with('success', 'Đã xóa phương thức thanh toán!');
    }

    // Bật/tắt phương thức
    public function toggleActive($id)
    {
        $method = PaymentMethod::findOrFail($id);
        $method->is_active = !$method->is_active;
        $method->save();
        return redirect()->route('admin.payment-methods.index')->with('success', 'Đã cập nhật trạng thái hiển thị!');
    }
} 