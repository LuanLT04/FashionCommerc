<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    // List user admin
    public function listUser(){
        $users = User::all();
       
        return view ('admin.list.list_user',compact('users'));
    }
    // delete user admin
    public function deleteUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('user.listuser')->withErrors(['error' => 'Người dùng không tồn tại!']);
        }
        $user->delete();
        return redirect()->route('user.listuser')->with('success', 'Đã xóa người dùng thành công!');
    }

    // From Update user admin
    public function updateUser(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::find($user_id);
        return view('admin.list.update_user',['user'=>$user]);
    }
    //Submit form update user admin
    public function postUpdateUser(Request $request)
    {
       $input =$request->all();

       $request->validate([
        'name' => 'required',
        'email'=> 'required|email',
        'password' => 'required|min:6',
        'phone' => 'required|max:10',
        'address' => 'required',
       ]);

       // Kiểm tra user có tồn tại không
       $user = User::find($input['id']);
       
       if (!$user) {
           // Log lỗi chi tiết
           \Log::warning('Attempt to update non-existent user', [
               'user_id' => $input['id'],
               'attempted_by' => session('id_user'),
               'timestamp' => now(),
               'ip_address' => request()->ip()
           ]);
           
           // Lưu thông báo lỗi vào session để hiển thị sau reload
           return redirect('listuser')->withErrors([
               'error' => 'Người dùng ID#' . $input['id'] . ' không tồn tại hoặc đã bị xóa bởi người khác! Danh sách đã được cập nhật.'
           ])->with('reload_needed', true);
       }
       
       // Kiểm tra thêm - user có bị block trong lúc sửa không
       if ($user->is_blocked) {
           \Log::info('Attempt to update blocked user', [
               'user_id' => $input['id'],
               'user_name' => $user->name
           ]);
           
           return redirect('listuser')->withErrors([
               'warning' => 'Người dùng "' . $user->name . '" đã bị chặn trong lúc bạn sửa! Vui lòng kiểm tra lại.'
           ]);
       }

       $user->name = $input['name'];
       $user->email = $input['email'];
       $user->password = Hash::make($input['password']);
       $user->phone = $input['phone'];
       $user->address = $input['address'];
       $user->save();
       
       // Log thành công
       \Log::info('User updated successfully', [
           'user_id' => $user->id_user,
           'updated_by' => session('id_user')
       ]);
       
       return redirect('listuser')->with('success', 'Cập nhật người dùng thành công!');
    }
    //searchhh
    public function searchUser(Request $request)
    {
     $search = $request->input('search'); // lay dữ liệu tìm kiếm từ request
     $users = User::where('name','like','%'.$search.'%')
     ->orWhere('email','like','%'.$search.'%')->get();
     return view('admin.list.list_user',['users'=>$users, 'search'=>$search]);
    }

    public function dashboard()
    {
        // Tổng doanh thu (chỉ tính đơn đã hoàn thành)
        $totalRevenue = Order::where('status', 'completed')->sum('total_order');
        // Doanh thu theo ngày (7 ngày gần nhất)
        $dailyRevenue = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_order) as total'))
            ->where('status', 'completed')
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'desc')
            ->limit(7)
            ->get();
        // Doanh thu theo tháng (12 tháng gần nhất)
        $monthlyRevenue = Order::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('SUM(total_order) as total'))
            ->where('status', 'completed')
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
            ->orderBy('month', 'desc')
            ->limit(12)
            ->get();
        // Doanh thu theo năm (5 năm gần nhất)
        $yearlyRevenue = Order::select(DB::raw('YEAR(created_at) as year'), DB::raw('SUM(total_order) as total'))
            ->where('status', 'completed')
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->orderBy('year', 'desc')
            ->limit(5)
            ->get();
        return view('admin.dashboard', compact('totalRevenue', 'dailyRevenue', 'monthlyRevenue', 'yearlyRevenue'));
    }

    // Chặn người dùng
    public function blockUser($id)
    {
        $user = User::findOrFail($id);
        $user->is_blocked = true;
        $user->save();
        return redirect()->back()->with('success', 'Đã chặn người dùng.');
    }

    // Mở chặn người dùng
    public function unblockUser($id)
    {
        $user = User::findOrFail($id);
        $user->is_blocked = false;
        $user->save();
        return redirect()->back()->with('success', 'Đã mở chặn người dùng.');
    }
}
