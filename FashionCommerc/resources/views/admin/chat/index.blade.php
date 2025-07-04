@extends('admin.layout')
@section('title', 'Quản lý tin nhắn khách hàng')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Quản lý tin nhắn khách hàng</h2>
    <div class="row g-4">
        <!-- Sidebar user -->
        <div class="col-lg-4">
            <div class="list-group shadow-sm rounded-4" id="user-list">
                @php
                if (!isset($users)) {
                    $users = [
                        (object) array('id'=>1, 'name'=>'Nguyễn Văn A', 'avatar_url'=>null, 'last_message_time'=>'2 phút trước', 'unread_count'=>2),
                        (object) array('id'=>2, 'name'=>'Trần Thị B', 'avatar_url'=>null, 'last_message_time'=>'10 phút trước', 'unread_count'=>0),
                        (object) array('id'=>3, 'name'=>'Lê Văn C', 'avatar_url'=>null, 'last_message_time'=>'1 giờ trước', 'unread_count'=>1),
                    ];
                }
                @endphp
                @foreach($users as $user)
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center py-3 px-2 gap-3 user-item" onclick="selectUser(event, {{ $user->id_user }}, '{{ $user->name_user }}', '{{ $user->avatar_url ?? asset('img/default-avatar.png') }}')">
                    <img src="{{ $user->avatar_url ?? asset('img/default-avatar.png') }}" class="rounded-circle" style="width:52px;height:52px;object-fit:cover;">
                    <div class="flex-grow-1">
                        <div class="fw-semibold fs-5">{{ $user->name_user }}</div>
                        <div class="text-muted small">{{ $user->last_message_time ?? '' }}</div>
                    </div>
                    @if($user->unread_count > 0)
                    <span class="badge bg-danger rounded-pill ms-2" style="font-size:1rem;min-width:28px;">{{ $user->unread_count }}</span>
                    @endif
                </a>
                @endforeach
            </div>
        </div>
        <!-- Khung chat -->
        <div class="col-lg-8">
            <div class="card shadow rounded-4 h-100 d-flex flex-column messenger-card">
                <div class="card-header bg-white d-flex align-items-center gap-3 border-0 border-bottom rounded-top-4" style="min-height:70px;">
                    <img id="chat-user-avatar" src="{{ asset('img/default-avatar.png') }}" class="rounded-circle border" style="width:48px;height:48px;object-fit:cover;">
                    <div>
                        <div id="chat-with-user" class="fw-bold fs-5">Chọn khách hàng để xem tin nhắn</div>
                        <div id="chat-user-status" class="text-success small"></div>
                    </div>
                </div>
                <div class="card-body p-4 d-flex flex-column gap-2 overflow-auto" id="chat-messages" style="height:420px; background:#f7f7fa;">
                    <!-- Lịch sử chat sẽ được load ở đây -->
                </div>
                <div class="card-footer bg-white border-0 rounded-bottom-4">
                    <form id="chat-form" class="d-flex gap-2 align-items-center" onsubmit="sendAdminMessage(event)">
                        <input type="text" id="admin-message" class="form-control rounded-pill px-4" placeholder="Nhập tin nhắn..." autocomplete="off" style="height:48px;">
                        <button class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center" type="submit" style="width:48px;height:48px;font-size:1.5rem;"><i class="fa fa-paper-plane  no-loading"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.messenger-card { box-shadow: 0 4px 24px #0001; border-radius: 24px; }
.user-item.active, .user-item:active, .user-item:focus { background: #eaf1fb !important; }
#chat-messages::-webkit-scrollbar { width: 8px; background: #eee; border-radius: 8px; }
#chat-messages::-webkit-scrollbar-thumb { background: #d0d7e2; border-radius: 8px; }
.messenger-row { display: flex; align-items: flex-end; gap: 8px; margin-bottom: 2px; }
.messenger-row.user { justify-content: flex-end; }
.messenger-row.admin { justify-content: flex-start; }
.messenger-bubble {
    max-width: 70%; padding: 12px 18px; border-radius: 18px; font-size: 1.08rem;
    display: inline-block; position: relative; word-break: break-word; box-shadow: 0 2px 8px #0001;
}
.messenger-bubble.user { background: #4f8cff; color: #fff; border-bottom-right-radius: 4px; margin-left: auto; }
.messenger-bubble.admin { background: #fff; color: #333; border-bottom-left-radius: 4px; margin-right: auto; border: 1px solid #e3eaf2; }
.messenger-meta { font-size: 0.85rem; color: #888; margin-top: 2px; text-align: center; }
.messenger-avatar { width: 32px; height: 32px; border-radius: 50%; object-fit: cover; border: 1.5px solid #e3eaf2; }
</style>
<script>
let currentUserId = null;
let currentUserName = '';
let currentUserAvatar = '';
function selectUser(e, userId, userName, avatarUrl) {
    e.preventDefault();
    currentUserId = userId;
    currentUserName = userName;
    currentUserAvatar = avatarUrl;
    document.querySelectorAll('#user-list .user-item').forEach(item => item.classList.remove('active'));
    e.currentTarget.classList.add('active');
    document.getElementById('chat-with-user').innerText = userName;
    document.getElementById('chat-user-avatar').src = avatarUrl;
    loadChatHistory();
}
function loadChatHistory() {
    const chatBox = document.getElementById('chat-messages');
    chatBox.innerHTML = '<div class="text-center text-muted py-4"><i class="fa fa-spinner fa-spin"></i> Đang tải...</div>';
    fetch(`/admin/chat/history/${currentUserId}`)
        .then(res => res.json())
        .then(messages => {
            chatBox.innerHTML = '';
            messages.forEach(msg => {
                const isAdmin = msg.sender_id == {{ auth()->user()->id_user }};
                const row = document.createElement('div');
                row.className = 'messenger-row ' + (isAdmin ? 'user' : 'admin');
                // Avatar nhỏ
                const avatar = document.createElement('img');
                avatar.className = 'messenger-avatar';
                avatar.src = isAdmin ? '{{ asset('img/logo.png') }}' : currentUserAvatar;
                // Bubble
                const bubble = document.createElement('div');
                bubble.className = 'messenger-bubble ' + (isAdmin ? 'user' : 'admin');
                bubble.innerText = msg.content;
                // Meta dưới bóng chat
                const meta = document.createElement('div');
                meta.className = 'messenger-meta';
                meta.innerText = (isAdmin ? 'Admin' : currentUserName) + ' • ' + (new Date(msg.created_at)).toLocaleString('vi-VN');
                // Render: admin bên phải, user bên trái
                if (isAdmin) {
                    row.appendChild(bubble);
                    row.appendChild(avatar);
                } else {
                    row.appendChild(avatar);
                    row.appendChild(bubble);
                }
                chatBox.appendChild(row);
                chatBox.appendChild(meta);
            });
            chatBox.scrollTop = chatBox.scrollHeight;
        });
}
function sendAdminMessage(e) {
    e.preventDefault();
    const input = document.getElementById('admin-message');
    const msg = input.value.trim();
    if (!msg || !currentUserId) return;
    fetch(`/admin/chat/send/${currentUserId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ content: msg })
    })
    .then(res => res.json())
    .then(data => {
        input.value = '';
        loadChatHistory();
    });
}
</script>
@endsection 