<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\User;

class AccountFinanceController extends Controller
{
    // Dashboard tài chính
    public function dashboard()
    {
        $user = Auth::user();
        $transactions = Transaction::where('user_id', $user->id_user)
                                 ->orderByDesc('created_at')
                                 ->limit(5)
                                 ->get();
        
        $totalDeposit = Transaction::where('user_id', $user->id_user)
                                  ->where('type', 'deposit')
                                  ->where('status', 'success')
                                  ->sum('amount');
                                  
        $totalWithdraw = Transaction::where('user_id', $user->id_user)
                                   ->where('type', 'withdraw')
                                   ->where('status', 'success')
                                   ->sum('amount');
        // Thêm cartCount và orderCount
        $cartCount = \App\Models\Cart::where('id_user', $user->id_user)->count();
        $orderCount = \App\Models\Order::where('id_user', $user->id_user)->count();
        return view('user.finance_dashboard', compact('user', 'transactions', 'totalDeposit', 'totalWithdraw', 'cartCount', 'orderCount'));
    }

    // Nạp tiền
    public function deposit(Request $request)
    {
        $user = User::find(Auth::user()->id_user);
        
        $request->validate([
            'amount' => 'required|numeric|min:10000',
        ], [
            'amount.required' => 'Vui lòng nhập số tiền cần nạp',
            'amount.numeric' => 'Số tiền phải là số',
            'amount.min' => 'Số tiền nạp tối thiểu là 10,000đ',
        ]);

        try {
            $transaction = Transaction::create([
                'user_id' => $user->id_user,
                'type' => 'deposit',
                'amount' => $request->amount,
                'status' => 'success',
                'description' => 'Nạp tiền vào tài khoản',
            ]);

            $user->balance += $request->amount;
            $user->save();

            return back()->with('success', 'Nạp tiền thành công! Số dư hiện tại: ' . number_format($user->balance, 0, ',', '.') . 'đ');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra khi nạp tiền. Vui lòng thử lại sau!');
        }
    }

    // Rút tiền
    public function withdraw(Request $request)
    {
        $user = User::find(Auth::user()->id_user);
        
        $request->validate([
            'amount' => 'required|numeric|min:10000',
        ], [
            'amount.required' => 'Vui lòng nhập số tiền cần rút',
            'amount.numeric' => 'Số tiền phải là số',
            'amount.min' => 'Số tiền rút tối thiểu là 10,000đ',
        ]);

        if ($user->balance < $request->amount) {
            return back()->with('error', 'Số dư không đủ để thực hiện giao dịch! Số dư hiện tại: ' . number_format($user->balance, 0, ',', '.') . 'đ');
        }

        try {
            $transaction = Transaction::create([
                'user_id' => $user->id_user,
                'type' => 'withdraw',
                'amount' => $request->amount,
                'status' => 'success',
                'description' => 'Rút tiền từ tài khoản',
            ]);

            $user->balance -= $request->amount;
            $user->save();

            return back()->with('success', 'Rút tiền thành công! Số dư còn lại: ' . number_format($user->balance, 0, ',', '.') . 'đ');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra khi rút tiền. Vui lòng thử lại sau!');
        }
    }

    // Lịch sử giao dịch
    public function history()
    {
        $user = Auth::user();
        $transactions = Transaction::where('user_id', $user->id_user)
                                 ->orderByDesc('created_at')
                                 ->paginate(10);
                                 
        return view('user.finance_history', compact('transactions'));
    }
} 