<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Danh sách user đã chat
    public function index() {
        $adminId = Auth::user()->id_user;
        $userIds = Message::select('sender_id')
            ->where('receiver_id', $adminId)
            ->distinct()->pluck('sender_id');
        $users = User::whereIn('id_user', $userIds)->get()->map(function($u) use ($adminId) {
            $lastMsg = Message::where(function($q) use ($u, $adminId) {
                $q->where('sender_id', $u->id_user)->where('receiver_id', $adminId);
            })->orWhere(function($q) use ($u, $adminId) {
                $q->where('sender_id', $adminId)->where('receiver_id', $u->id_user);
            })->orderByDesc('created_at')->first();
            $unread = Message::where('sender_id', $u->id_user)->where('receiver_id', $adminId)->where('is_read', false)->count();
            return (object) [
                'id_user' => $u->id_user,
                'name_user' => $u->name,
                'avatar_url' => $u->avatar_url,
                'last_message_time' => $lastMsg ? $lastMsg->created_at->diffForHumans() : '',
                'unread_count' => $unread
            ];
        });
        return view('admin.chat.index', ['users' => $users]);
    }

    // Lấy lịch sử chat với user (AJAX)
    public function history($userId) {
        $adminId = auth()->user()->id_user;
        $messages = \App\Models\Message::where(function($q) use ($userId, $adminId) {
            $q->where('sender_id', $userId)->where('receiver_id', $adminId);
        })->orWhere(function($q) use ($userId, $adminId) {
            $q->where('sender_id', $adminId)->where('receiver_id', $userId);
        })->orderBy('created_at')->get();
        return response()->json($messages);
    }

    // Gửi tin nhắn tới user (AJAX)
    public function send(Request $request, $userId) {
        $msg = Message::create([
            'sender_id' => Auth::user()->id_user,
            'receiver_id' => $userId,
            'content' => $request->input('content'),
            'is_read' => false
        ]);
        return response()->json($msg);
    }
} 