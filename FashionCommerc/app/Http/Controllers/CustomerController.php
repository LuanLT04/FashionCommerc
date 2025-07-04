<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{

    //Registes client
    public function indexRegister()
    {
        return view('cus_register');
    }
    
    public function authRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required|regex:/^[0-9]{10}$/',
            'address' => 'required',
        ], [
            'name.required' => 'Vui lòng nhập họ tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email này đã được sử dụng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.regex' => 'Số điện thoại phải có đúng 10 chữ số',
            'address.required' => 'Vui lòng nhập địa chỉ'
        ]);

        $data = $request->all();
        User::create([
            'name' => trim($data['name']),
            'email' => trim($data['email']),
            'password' => Hash::make($data['password']),
            'phone' => trim($data['phone']),
            'address' => trim($data['address']),
            'role' => 0,
        ]);
        return redirect()->route('user.cus_login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }

    // login client
    public function indexLogin()
    {
        return view('cus_login');
    }

    public function authLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'password.required' => 'Vui lòng nhập mật khẩu'
        ]);

        $user = User::where('email', trim($request->email))->first();

        if (!$user) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => ['email' => ['Email không tồn tại trong hệ thống']]
                ], 422);
            }
            return back()->withErrors(['email' => 'Email không tồn tại trong hệ thống']);
        }

        if ($user->is_blocked) {
            // Log lịch sử chặn (chỉ thông báo trong session)
            session(['block_attempt' => [
                'user_id' => $user->id_user,
                'time' => now()->format('d/m/Y H:i:s'),
                'message' => 'Người dùng ' . $user->name . ' đã cố gắng đăng nhập khi bị khóa'
            ]]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => ['email' => ['Tài khoản của bạn đã bị khóa. Vui lòng liên hệ admin để được hỗ trợ.']]
                ], 422);
            }
            return back()->withErrors(['email' => 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ admin để được hỗ trợ.']);
        }

        if (Hash::check($request->password, $user->password)) {
            // Xử lý remember token (chỉ thông báo)
            if ($request->has('remember')) {
                session(['remember_info' => 'Thông tin đăng nhập đã được ghi nhớ']);
            }

            // Đăng nhập chuẩn Laravel
            Auth::login($user);

            if ($user->role == 1) {
                session(['id_user' => $user->id_user]);

                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Đăng nhập thành công! Chào mừng Admin.',
                        'redirect' => route('admin.dashboard')
                    ]);
                }
                return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công! Chào mừng Admin.');
            } else {
                session(['id_user' => $user->id_user]);
                session(['cart' => ['user_id' => $user->id_user]]);
                session(['name_user' => $user->name]);
                session(['email_user' => $user->email]);

                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Đăng nhập thành công! Chào mừng ' . $user->name,
                        'user' => [
                            'id' => $user->id_user,
                            'name' => $user->name,
                            'email' => $user->email
                        ]
                    ]);
                }
                return redirect()->route('home.index')->with('success', 'Đăng nhập thành công! Chào mừng ' . $user->name);
            }
        } else {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => ['password' => ['Mật khẩu không chính xác']]
                ], 422);
            }
            return back()->withErrors(['password' => 'Mật khẩu không chính xác']);
        }
    }

    public function signOut(Request $request)
    {
        // Thông báo confirm dialog trong session
        session(['logout_confirm' => 'Bạn có chắc chắn muốn đăng xuất?']);
        
        $request->session()->forget('cart');
        $request->session()->forget('remember_info');
        $request->session()->forget('block_attempt');
        Session::flush();
        Auth::logout();
        
        return redirect('login')->with('success', 'Đăng xuất thành công!');
    }
}