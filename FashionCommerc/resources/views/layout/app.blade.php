<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Store</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nouislider.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- FontAwesome 5 CDN để đảm bảo icon luôn hiển thị -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #ff4d4d;
            --secondary-color: #333;
            --text-color: #4a4a4a;
            --bg-color: #fff;
            --card-bg: #fff;
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        html, body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        body {
            display: flex;
            flex-direction: column;
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        main {
            flex: 1 0 auto;
        }

        footer {
            flex-shrink: 0;
        }

        .dark-mode {
            --primary-color: #ff6b6b;
            --secondary-color: #f5f5f5;
            --text-color: #e1e1e1;
            --bg-color: #1a1a1a;
            --card-bg: #2d2d2d;
            --shadow-color: rgba(0, 0, 0, 0.2);
        }

        #chatbot-float-btn {
            position: fixed; right: 32px; bottom: 32px; z-index: 99999;
            background: linear-gradient(90deg, #f7b42c 0%, #fc575e 100%);
            color: #fff; width: 60px; height: 60px; border-radius: 50%;
            box-shadow: 0 4px 16px #fc575e55; display: flex; align-items: center; justify-content: center;
            font-size: 2rem; cursor: pointer; transition: box-shadow 0.2s, background 0.2s;
        }
        #chatbot-float-btn:hover {
            box-shadow: 0 8px 32px #fc575e99;
            background: linear-gradient(90deg, #fc575e 0%, #f7b42c 100%);
        }
        #chatbot-popup {
            position: fixed; right: 32px; bottom: 100px; width: 340px; max-width: 95vw;
            background: #fff; border-radius: 16px; box-shadow: 0 8px 32px #0002; z-index: 10000;
            display: none; flex-direction: column; overflow: hidden; border: 1px solid #eee;
        }
        #chatbot-popup.active { display: flex; }
        .chatbot-header {
            background: linear-gradient(90deg, #f7b42c 0%, #fc575e 100%);
            color: #fff; padding: 12px 16px; display: flex; justify-content: space-between; align-items: center; font-weight: 600;
        }
        .chatbot-header button { background: none; border: none; color: #fff; font-size: 1.2rem; cursor: pointer; }
        .chatbot-body {
            padding: 16px; height: 260px; overflow-y: auto; background: #f9f9f9; display: flex; flex-direction: column; gap: 8px;
        }
        .chatbot-message { padding: 8px 12px; border-radius: 12px; max-width: 80%; word-break: break-word; font-size: 1rem; }
        .chatbot-message.admin { background: #f7b42c22; align-self: flex-start; }
        .chatbot-message.user { background: #fc575e22; align-self: flex-end; }
        .chatbot-footer { display: flex; gap: 8px; padding: 12px 16px; background: #fff; border-top: 1px solid #eee; }
        #chatbot-input { flex: 1; border: 1px solid #ddd; border-radius: 8px; padding: 8px 12px; font-size: 1rem; }
        .chatbot-footer button {
            background: linear-gradient(90deg, #f7b42c 0%, #fc575e 100%);
            color: #fff; border: none; border-radius: 8px; padding: 0 16px; font-size: 1.2rem; cursor: pointer;
        }
    </style>
</head>
<script>
    var CHAT_SEND_URL = @json(route('user.chat.send'));
    var CSRF_TOKEN = @json(csrf_token());
</script>
<body>
    <!-- Loading Overlay -->
    <div id="loading-overlay" style="position:fixed;z-index:9999999;top:0;left:0;width:100vw;height:100vh;background:rgba(255,255,255,0.95);display:flex;align-items:center;justify-content:center;transition:opacity 0.3s;">
        <div style="text-align:center;">
            <div class="spinner-border text-danger" style="width:3rem;height:3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div style="margin-top:16px;font-weight:500;color:#ff4d4d;font-size:1.2rem;">Đang tải trang...</div>
        </div>
    </div>

    <!-- Thêm phần hiển thị thông báo -->
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    @yield('content')

    <!-- Chatbot Floating Button -->
    <div id="chatbot-float-btn" onclick="toggleChatbot()" title="Chat với admin">
        <i class="fa fa-comments"></i>
    </div>
    <!-- Chatbot Popup -->
    <div id="chatbot-popup">
        <div class="chatbot-header">
            <span><i class="fa fa-user"></i> Hỗ trợ khách hàng</span>
            <button type="button" onclick="toggleChatbot()"><i class="fa fa-close"></i></button>
        </div>
        <div class="chatbot-body" id="chatbot-messages">
            <div class="chatbot-message admin">Xin chào! Bạn cần hỗ trợ gì?</div>
        </div>
        <div class="chatbot-footer">
            <input type="text" id="chatbot-input" placeholder="Nhập tin nhắn..." onkeydown="if(event.key==='Enter'){sendChatbotMessage();}">
            <button onclick="sendChatbotMessage()"><i class="fa fa-send"></i></button>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/nouislider.min.js') }}"></script>
    <script src="{{ asset('js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

    <!-- Avatar Dropdown Fix -->
    <script src="{{ asset('js/user/avatar-dropdown-fix.js') }}"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        function toggleChatbot() {
            const popup = document.getElementById('chatbot-popup');
            popup.classList.toggle('active');
        }
        function sendChatbotMessage() {
            const input = document.getElementById('chatbot-input');
            const msg = input.value.trim();
            if (!msg) return;
            console.log('Gửi tin nhắn:', msg); // DEBUG kiểm tra hàm có chạy không
            const messages = document.getElementById('chatbot-messages');
            // Hiển thị tin nhắn user
            const userMsg = document.createElement('div');
            userMsg.className = 'chatbot-message user';
            userMsg.innerText = msg;
            messages.appendChild(userMsg);
            input.value = '';
            messages.scrollTop = messages.scrollHeight;
            // Gửi AJAX lên server
            $.ajax({
                url: CHAT_SEND_URL,
                method: 'POST',
                data: {
                    content: msg,
                    _token: CSRF_TOKEN
                },
                success: function(res) {
                    // Không hiển thị phản hồi admin giả lập nữa
                },
                error: function(xhr) {
                    let msg = 'Lỗi gửi tin nhắn!';
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        msg = xhr.responseJSON.error;
                    }
                    const adminMsg = document.createElement('div');
                    adminMsg.className = 'chatbot-message admin';
                    adminMsg.innerText = msg;
                    messages.appendChild(adminMsg);
                    messages.scrollTop = messages.scrollHeight;
                }
            });
        }
        // Hook nhận tin nhắn realtime (Pusher/Echo)
        // window.Echo.private('chat-user')
        //     .listenForWhisper('admin-message', (e) => {
        //         const messages = document.getElementById('chatbot-messages');
        //         const adminMsg = document.createElement('div');
        //         adminMsg.className = 'chatbot-message admin';
        //         adminMsg.innerText = e.message;
        //         messages.appendChild(adminMsg);
        //         messages.scrollTop = messages.scrollHeight;
        //     });

        // Ẩn loading overlay khi trang đã load xong
        window.addEventListener('load', function() {
            const overlay = document.getElementById('loading-overlay');
            if(overlay) overlay.style.display = 'none';
        });
    </script>
</body>
</html>
