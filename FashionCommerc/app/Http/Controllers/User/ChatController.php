<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function send(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Bạn chưa đăng nhập!'], 401);
        }
        $content = $request->input('content');
        if (!$content) {
            return response()->json(['error' => 'Nội dung tin nhắn trống!'], 422);
        }
        $admin = User::where('role', 1)->first();
        if (!$admin) return response()->json(['error' => 'Không tìm thấy admin'], 404);
        try {
            $msg = Message::create([
                'sender_id' => Auth::user()->id_user,
                'receiver_id' => $admin->id_user,
                'content' => $content,
                'is_read' => false
            ]);
            return response()->json($msg);
        } catch (\Exception $e) {
            Log::error('Lỗi lưu tin nhắn: ' . $e->getMessage());
            return response()->json(['error' => 'Lỗi lưu tin nhắn: ' . $e->getMessage()], 500);
        }
    }

    public function history()
    {
        $user = auth()->user();
        $admin = \App\Models\User::where('role', 1)->first();
        if (!$user || !$admin) return response()->json([]);
        $messages = \App\Models\Message::where(function($q) use ($user, $admin) {
            $q->where('sender_id', $user->id_user)->where('receiver_id', $admin->id_user);
        })->orWhere(function($q) use ($user, $admin) {
            $q->where('sender_id', $admin->id_user)->where('receiver_id', $user->id_user);
        })->orderBy('created_at')->get();
        return response()->json($messages);
    }

    public function unreadCount()
    {
        $user = auth()->user();
        $admin = \App\Models\User::where('role', 1)->first();
        if (!$user || !$admin) return response()->json(['count' => 0]);
        $count = \App\Models\Message::where('sender_id', $admin->id_user)
            ->where('receiver_id', $user->id_user)
            ->where('is_read', false)
            ->count();
        return response()->json(['count' => $count]);
    }
} 