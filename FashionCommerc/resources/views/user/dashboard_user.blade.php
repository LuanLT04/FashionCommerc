<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Fashion Store - Modern Shopping Experience</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Custom CSS -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        #chatbot-popup .chatbot-message {
            padding: 10px 16px;
            border-radius: 18px;
            margin-bottom: 8px;
            max-width: 75%;
            display: inline-block;
            position: relative;
            font-size: 1rem;
            word-break: break-word;
        }
        #chatbot-popup .chatbot-message.user {
            background: #fc575e22;
            color: #333;
            align-self: flex-end;
            border-bottom-right-radius: 4px;
            margin-left: auto;
        }
        #chatbot-popup .chatbot-message.admin {
            background: #f7b42c22;
            color: #333;
            align-self: flex-start;
            border-bottom-left-radius: 4px;
            margin-right: auto;
        }
        #chatbot-popup .chatbot-meta {
            font-size: 0.85rem;
            color: #888;
            margin-top: 2px;
            margin-bottom: 4px;
        }
        #chatbot-popup .chatbot-row {
            display: flex;
            align-items: flex-end;
            gap: 8px;
        }
        #chatbot-popup .chatbot-row.user { justify-content: flex-end; }
        #chatbot-popup .chatbot-row.admin { justify-content: flex-start; }
        #chatbot-popup .chatbot-avatar {
            width: 28px; height: 28px; border-radius: 50%; object-fit: cover;
        }
        #chatbot-popup .chatbot-footer button {
            background: linear-gradient(90deg, #f7b42c 0%, #fc575e 100%);
            color: #fff; border: none; border-radius: 8px; padding: 0 16px; font-size: 1.2rem; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
        }
    </style>

    <!-- Dashboard User CSS riêng -->
    <link rel="stylesheet" href="{{ asset('css/user/dashboard_user.css') }}">

</head>

<body class="light-mode">
    <!-- Loading Overlay -->
    <div id="loading-overlay" style="position:fixed;z-index:9999999;top:0;left:0;width:100vw;height:100vh;background:rgba(255,255,255,0.95);display:flex;align-items:center;justify-content:center;transition:opacity 0.3s;">
        <div style="text-align:center;">
            <div class="spinner-border text-danger" style="width:3rem;height:3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div style="margin-top:16px;font-weight:500;color:#ff4d4d;font-size:1.2rem;">Đang tải trang...</div>
        </div>
    </div>
    <script>
        window.addEventListener('load', function() {
            const overlay = document.getElementById('loading-overlay');
            if(overlay) overlay.style.display = 'none';
        });
    </script>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top py-3" id="mainNav">
            <div class="container">
            <a class="navbar-brand" href="{{ route('home.index') }}">
                <img src="{{ asset('./img/logo.png')}}" alt="Fashion Store Logo" class="logo-img">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Clean Minimalist Search Bar -->
                <form action="{{ route('user.searchProduct') }}" method="GET" class="nav-search" role="search" aria-label="Tìm kiếm sản phẩm">
                    <label for="dashboardSearchInput" class="visually-hidden">Tìm kiếm sản phẩm</label>
                    <div class="search-container">
                        <input type="search" name="keyword" id="dashboardSearchInput" class="search-input" 
                               placeholder="Tìm kiếm sản phẩm..." required autocomplete="off" aria-label="Tìm kiếm sản phẩm">
                        <button type="submit" class="search-button" aria-label="Tìm kiếm">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

                <!-- Navigation Links -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('post.indexListPostUser') }}" class="nav-link">
                                <i class="fa fa-newspaper-o"></i>
                                <span>Bài viết</span>
                            </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/about') }}" class="nav-link">
                            <i class="fa fa-info-circle"></i>
                            <span>Giới thiệu</span>
                        </a>
                    </li>
                    
                            @if(Session::get('id_user'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-industry"></i>
                                        <span>Hãng</span>
                                    </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                        @foreach ($manufacturers as $manufacturer)
                                        <li>
                                            <a class="dropdown-item" href="{{ route('manufacturer.products', $manufacturer->id_manufacturer) }}">
                                                {{ $manufacturer->name_manufacturer }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('cart.indexCart') }}" class="nav-link position-relative">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Giỏ hàng</span>
                                <span class="badge bg-danger rounded-pill cart-badge">{{ $cartCount }}</span>
                                </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('order.orderIndex') }}" class="nav-link position-relative">
                                    <i class="fa-solid fa-file-invoice"></i>
                                    <span>Đơn hàng</span>
                                <span class="badge bg-primary rounded-pill order-badge">{{ $orderCount }}</span>
                                </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="#" class="nav-link favorite-icon" id="dashboardFavoriteIcon" title="Sản phẩm yêu thích" style="position: relative;">
                                <i class="fa-solid fa-heart "></i>
                                <span class="favorite-count-badge" id="favoriteCountBadge">0</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center avatar-dropdown-toggle" href="#" id="avatarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="avatar-circle">
                                    @if(Auth::check() && Auth::user()->avatar)
                                        <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" alt="Avatar" style="width:30px;height:30px;border-radius:50%;object-fit:cover;">
                                    @elseif(Session::get('name_user'))
                                        <span class="avatar-text">{{ mb_substr(Session::get('name_user'), 0, 1) }}</span>
                                    @else
                                        <i class="fa-solid fa-user"></i>
                                    @endif
                                </div>
                                @if(Auth::check())
                                    <span class="user-balance ms-2 d-inline-flex align-items-center">
                                        <i class="fa-solid fa-wallet text-primary"></i>
                                        <span class="fw-semibold balance-amount">{{ number_format(Auth::user()->balance ?? 0, 0, ',', '.') }}đ</span>
                                    </span>
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="avatarDropdown">
                                <li>
                                    <span class="dropdown-item-text">
                                        <strong>{{ Session::get('name_user') }}</strong><br>
                                        <small style="color: #888;">{{ Session::get('email_user') }}</small>
                                    </span>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('user.account') }}">
                                        <i class="fa-solid fa-user-gear me-2"></i>
                                        Quản lý tài khoản
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('signout') }}">
                                        <i class="fa-solid fa-right-from-bracket me-2"></i>
                                        Đăng xuất
                                    </a>
                                </li>
                            </ul>
                        </li>
                            @else
                        <li class="nav-item">
                            <a href="{{ route('user.indexlogin') }}" class="nav-link">
                                    <i class="fa-solid fa-right-to-bracket"></i>
                                    <span>Đăng nhập</span>
                                </a>
                        </li>
                            @endif
                    
                    <li class="nav-item">
                        <button class="nav-link theme-toggle" id="themeToggle">
                            <i class="fas fa-moon"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Alert Messages -->
    <div class="container alert-container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-down">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" data-aos="fade-down">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert" data-aos="fade-down">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="main-content">
    @yield('content')
    </main>

    <!-- Footer -->
    @include('user.partials.footer')

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });

        // Theme Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('themeToggle');
            const body = document.body;
            const icon = themeToggle.querySelector('i');

            // Check saved theme
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                body.classList.add(savedTheme);
                icon.classList.toggle('fa-sun', savedTheme === 'dark-mode');
                icon.classList.toggle('fa-moon', savedTheme === 'light-mode');
    }

            themeToggle.addEventListener('click', () => {
                body.classList.toggle('dark-mode');
                const isDark = body.classList.contains('dark-mode');
                
                icon.classList.toggle('fa-sun', isDark);
                icon.classList.toggle('fa-moon', !isDark);
                
                localStorage.setItem('theme', isDark ? 'dark-mode' : 'light-mode');
            });
        });

        // Navbar Scroll Effect
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('mainNav');
            if (window.scrollY > 50) {
                nav.classList.add('navbar-scrolled');
            } else {
                nav.classList.remove('navbar-scrolled');
            }
        });

        // Initialize Swiper
        const newProductsSwiper = new Swiper('.new-products-swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            speed: 800,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 25,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
            },
            effect: 'slide',
            grabCursor: true,
            preloadImages: true,
            lazy: true,
            watchSlidesProgress: true,
            on: {
                init: function() {
                    setTimeout(() => {
                        this.update();
                    }, 100);
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.querySelector('.search-animated-form');
            const searchInput = searchForm.querySelector('.search-animated-input');
            const searchBtn = searchForm.querySelector('.search-animated-btn');
            // Khi click vào icon hoặc input, mở rộng form
            searchBtn.addEventListener('click', function() {
                searchForm.classList.add('active');
                searchInput.focus();
            });
            searchInput.addEventListener('focus', function() {
                searchForm.classList.add('active');
            });
            // Khi blur nếu input rỗng, thu nhỏ lại
            searchInput.addEventListener('blur', function() {
                if (!searchInput.value) {
                    searchForm.classList.remove('active');
                }
            });
            // Nếu có giá trị, giữ form mở rộng
            if (searchInput.value) {
                searchForm.classList.add('active');
            }
        });
    </script>

    <!-- Modal danh sách sản phẩm yêu thích -->
    <div class="modal fade" id="favoriteModal" tabindex="-1" aria-labelledby="favoriteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="favoriteModalLabel"><i class="fa-solid fa-heart text-danger"></i> Sản phẩm yêu thích</h5>      
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="favoriteListBody">
                    <div class="text-center text-muted">Chưa có sản phẩm yêu thích nào.</div>
                </div>
            </div>
        </div>
    </div>
    <script>
    
    </script>

    <!-- Dashboard User JS riêng -->
    <script src="{{ asset('js/user/dashboard_user.js') }}"></script>

    <!-- Chatbot Floating Button -->
    <div id="chatbot-float-btn" onclick="toggleChatbot()" title="Chat với admin" style="position: fixed; right: 32px; bottom: 32px; z-index: 99999; background: linear-gradient(90deg, #f7b42c 0%, #fc575e 100%); color: #fff; width: 60px; height: 60px; border-radius: 50%; box-shadow: 0 4px 16px #fc575e55; display: flex; align-items: center; justify-content: center; font-size: 2rem; cursor: pointer; transition: box-shadow 0.2s, background 0.2s;">
        <i class="fa fa-comments"></i>
        <span id="chatbot-unread-badge" style="display:none; position:absolute; top:6px; right:6px; background:#f44336; color:#fff; border-radius:50%; min-width:22px; height:22px; font-size:1rem; font-weight:bold; display:flex; align-items:center; justify-content:center; border:2px solid #fff; z-index:10001;"></span>
    </div>
    <!-- Chatbot Popup -->
    <div id="chatbot-popup" style="position: fixed; right: 32px; bottom: 100px; width: 340px; max-width: 95vw; background: #fff; border-radius: 16px; box-shadow: 0 8px 32px #0002; z-index: 10000; display: none; flex-direction: column; overflow: hidden; border: 1px solid #eee;">
        <div class="chatbot-header" style="background: linear-gradient(90deg, #f7b42c 0%, #fc575e 100%); color: #fff; padding: 12px 16px; display: flex; justify-content: space-between; align-items: center; font-weight: 600;">
            <span><i class="fa fa-user"></i> Hỗ trợ khách hàng</span>
            <button type="button" onclick="toggleChatbot()" style="background: none; border: none; color: #fff; font-size: 1.2rem; cursor: pointer;"><i class="fa fa-close"></i></button>
        </div>
        <div class="chatbot-body" id="chatbot-messages" style="padding: 16px; height: 260px; overflow-y: auto; background: #f9f9f9; display: flex; flex-direction: column; gap: 8px;">
            <div class="chatbot-message admin" style="padding: 8px 12px; border-radius: 12px; max-width: 80%; word-break: break-word; font-size: 1rem; background: #f7b42c22; align-self: flex-start;">Xin chào! Bạn cần hỗ trợ gì?</div>
        </div>
        <div class="chatbot-footer" style="display: flex; gap: 8px; padding: 12px 16px; background: #fff; border-top: 1px solid #eee;">
            <input type="text" id="chatbot-input" placeholder="Nhập tin nhắn..." onkeydown="if(event.key==='Enter'){sendChatbotMessage();}" style="flex: 1; border: 1px solid #ddd; border-radius: 8px; padding: 8px 12px; font-size: 1rem;">
            <button onclick="sendChatbotMessage()" id="chatbot-send-btn"><i class="fa fa-paper-plane"></i></button>
        </div>
    </div>
    @php
        $currentUserId = auth()->check() ? auth()->user()->id_user : null;
    @endphp
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        var CHAT_SEND_URL = @json(route('user.chat.send'));
        var CHAT_HISTORY_URL = @json(route('user.chat.history'));
        var CHAT_UNREAD_URL = @json(route('user.chat.unreadCount'));
        var CSRF_TOKEN = @json(csrf_token());
        const CURRENT_USER_ID = @json($currentUserId);
        function updateChatbotUnreadBadge() {
            fetch(CHAT_UNREAD_URL)
                .then(res => res.json())
                .then(data => {
                    const badge = document.getElementById('chatbot-unread-badge');
                    if (data.count > 0) {
                        badge.innerText = data.count;
                        badge.style.display = 'flex';
                    } else {
                        badge.style.display = 'none';
                    }
                });
        }
        // Gọi khi load trang và sau khi gửi/nhận tin nhắn
        document.addEventListener('DOMContentLoaded', updateChatbotUnreadBadge);
        function toggleChatbot() {
            const popup = document.getElementById('chatbot-popup');
            popup.classList.toggle('active');
            if (popup.classList.contains('active')) {
                popup.style.display = 'flex';
                loadChatHistoryUser();
            } else {
                popup.style.display = 'none';
            }
        }
        function loadChatHistoryUser() {
            const messages = document.getElementById('chatbot-messages');
            messages.innerHTML = '<div class="text-center text-muted py-2"><i class="fa fa-spinner fa-spin"></i> Đang tải...</div>';
            fetch(CHAT_HISTORY_URL)
                .then(res => res.json())
                .then(data => {
                    messages.innerHTML = '';
                    if (!data.length) {
                        const hello = document.createElement('div');
                        hello.className = 'chatbot-message admin';
                        hello.innerText = 'Xin chào! Bạn cần hỗ trợ gì?';
                        messages.appendChild(hello);
                        return;
                    }
                    data.forEach(msg => {
                        const isUser = msg.sender_id == CURRENT_USER_ID;
                        const row = document.createElement('div');
                        row.className = 'chatbot-row ' + (isUser ? 'user' : 'admin');
                        // Avatar
                        const avatar = document.createElement('img');
                        avatar.className = 'chatbot-avatar';
                        avatar.src = isUser ? '{{ Auth::user() && Auth::user()->avatar ? asset('storage/avatars/' . Auth::user()->avatar) : asset('img/default-avatar.png') }}' : '{{ asset('img/logo.png') }}';
                        // Bubble
                        const bubble = document.createElement('div');
                        bubble.className = 'chatbot-message ' + (isUser ? 'user' : 'admin');
                        bubble.innerText = msg.content;
                        // Meta dưới bóng chat
                        const meta = document.createElement('div');
                        meta.className = 'chatbot-meta';
                        meta.style.textAlign = 'center';
                        meta.innerText = (isUser ? 'Bạn' : 'Admin') + ' • ' + (new Date(msg.created_at)).toLocaleString('vi-VN');
                        // Render
                        if (isUser) {
                            row.appendChild(bubble);
                            row.appendChild(avatar);
                        } else {
                            row.appendChild(avatar);
                            row.appendChild(bubble);
                        }
                        messages.appendChild(row);
                        messages.appendChild(meta);
                    });
                    messages.scrollTop = messages.scrollHeight;
                    updateChatbotUnreadBadge();
                });
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
            userMsg.style.background = '#fc575e22';
            userMsg.style.alignSelf = 'flex-end';
            userMsg.style.padding = '8px 12px';
            userMsg.style.borderRadius = '12px';
            userMsg.style.maxWidth = '80%';
            userMsg.style.wordBreak = 'break-word';
            userMsg.style.fontSize = '1rem';
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
                    // Sau khi gửi, reload lại lịch sử chat
                    loadChatHistoryUser();
                    updateChatbotUnreadBadge();
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
    </script>
</body>
</html>