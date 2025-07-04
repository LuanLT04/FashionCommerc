<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\File;

class AccountController extends Controller
{
    // Hiển thị trang quản lý tài khoản
    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('id_user', $user->id_user)->orderByDesc('created_at')->get();
        $cartCount = \App\Models\Cart::where('id_user', $user->id_user)->count();
        $orderCount = \App\Models\Order::where('id_user', $user->id_user)->count();
        return view('user.account', compact('user', 'orders', 'cartCount', 'orderCount'));
    }

    // Cập nhật thông tin cá nhân
    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::user()->id_user);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Vui lòng nhập họ tên',
            'name.max' => 'Họ tên không được vượt quá 255 ký tự',
            'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự',
            'avatar.image' => 'File phải là hình ảnh',
            'avatar.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif',
            'avatar.max' => 'Kích thước hình ảnh không được vượt quá 2MB',
        ]);

        try {
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->address = $request->address;

            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $filename = 'avatar_' . $user->id_user . '.' . $file->getClientOriginalExtension();
                // Lưu file vào storage/app/public/avatars (disk public)
                $file->storeAs('avatars', $filename, 'public');
                $user->avatar = $filename;
            }

            $user->save();
            return back()->with('success', 'Cập nhật thông tin thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra khi cập nhật thông tin. Vui lòng thử lại!');
        }
    }

    // Hiển thị form đổi mật khẩu
    public function showChangePasswordForm()
    {
        $user = Auth::user();
        $cartCount = \App\Models\Cart::where('id_user', $user->id_user)->count();
        $orderCount = \App\Models\Order::where('id_user', $user->id_user)->count();
        return view('user.change_password', compact('cartCount', 'orderCount'));
    }

    // Đổi mật khẩu
    public function changePassword(Request $request)
    {
        $user = User::find(Auth::user()->id_user);
        
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ], [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự',
            'new_password.confirmed' => 'Xác nhận mật khẩu mới không khớp',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Mật khẩu hiện tại không đúng!');
        }

        try {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return back()->with('success', 'Đổi mật khẩu thành công! Vui lòng sử dụng mật khẩu mới trong lần đăng nhập tới.');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra khi đổi mật khẩu. Vui lòng thử lại!');
        }
    }
} 