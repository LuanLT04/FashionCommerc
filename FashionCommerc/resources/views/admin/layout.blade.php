<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- SEO Meta Tags -->
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="@yield('meta_description', 'Professional admin dashboard for Fashion Commerce - Manage products, orders, customers and analytics with modern interface')">
    <meta name="keywords" content="@yield('meta_keywords', 'admin dashboard, fashion commerce, ecommerce management, admin panel, analytics, inventory management, order management, customer management')">
    <meta name="author" content="Fashion Commerce">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="canonical" href="{{ url()->current() }}" />

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('title', 'Dashboard') | Fashion Commerce Admin" />
    <meta property="og:description" content="@yield('meta_description', 'Professional admin dashboard for Fashion Commerce - Manage products, orders, customers and analytics with modern interface')" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset('img/logo.png') }}" />
    <meta property="og:site_name" content="Fashion Commerce Admin" />
    <meta property="og:locale" content="vi_VN" />

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Dashboard') | Fashion Commerce Admin">
    <meta name="twitter:description" content="@yield('meta_description', 'Professional admin dashboard for Fashion Commerce management')">
    <meta name="twitter:image" content="{{ asset('img/logo.png') }}">

    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebApplication",
        "name": "Fashion Commerce Admin Dashboard",
        "description": "Professional admin dashboard for Fashion Commerce management",
        "url": "{{ url('/admin') }}",
        "applicationCategory": "BusinessApplication",
        "operatingSystem": "Web Browser",
        "author": {
            "@type": "Organization",
            "name": "Fashion Commerce"
        }
    }
    </script>
    <title>@yield('title', 'Dashboard') | Fashion Commerce Admin Panel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Preconnect for Performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">

    <!-- Modern Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Custom Admin Dashboard CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/logo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/logo.png') }}">

    <style>
        /* Màn hình loading với logo - Căn giữa hoàn hảo */
        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(15px);
            display: none;
            z-index: 9999;
            overflow: hidden;
            margin: 0;
            padding: 0;
        }

        #loading-overlay.show {
            display: flex !important;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .loading-content {
            text-align: center;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .loading-logo {
            width: 120px;
            height: 120px;
            margin-bottom: 25px;
            border-radius: 50%;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            animation: logoFloat 3s ease-in-out infinite;
            border: 4px solid #f8f9fa;
            object-fit: cover;
            display: block;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 3px solid #e3e3e3;
            border-top: 3px solid #007bff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }

        .loading-text {
            font-size: 16px;
            font-weight: 600;
            margin-top: 15px;
            color: #6c757d;
            animation: textPulse 2s ease-in-out infinite;
            white-space: nowrap;
        }

        .loading-dots {
            display: inline-block;
            animation: dots 1.5s infinite;
        }

        .loading-progress {
            width: 200px;
            height: 4px;
            background: #e9ecef;
            border-radius: 2px;
            margin: 20px auto 10px;
            overflow: hidden;
        }

        .loading-progress-bar {
            width: 0%;
            height: 100%;
            background: linear-gradient(90deg, #007bff, #0056b3);
            border-radius: 2px;
            animation: progressBar 2s ease-in-out infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes logoFloat {
            0%, 100% {
                transform: translateY(0px) scale(1);
                box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            }
            50% {
                transform: translateY(-10px) scale(1.05);
                box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            }
        }

        @keyframes textPulse {
            0%, 100% { opacity: 0.7; }
            50% { opacity: 1; }
        }

        @keyframes dots {
            0%, 20% { content: ''; }
            40% { content: '.'; }
            60% { content: '..'; }
            80%, 100% { content: '...'; }
        }

        @keyframes progressBar {
            0% { width: 0%; }
            50% { width: 70%; }
            100% { width: 100%; }
        }

        /* Custom AdminLTE styles */
        .main-sidebar {
            background: linear-gradient(180deg, #343a40 0%, #495057 100%);
        }

        .nav-sidebar .nav-link.active {
            background-color: #007bff;
            color: #fff;
        }

        .content-wrapper {
            background-color: #f8f9fa;
        }

        .card {
            box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
            border: none;
        }

        .btn {
            border-radius: 0.375rem;
        }

        .table th {
            border-top: none;
            font-weight: 600;
            background-color: #f8f9fa;
        }

        /* Đảm bảo loading luôn ở giữa màn hình */
        body.loading {
            overflow: hidden;
        }

        #loading-overlay {
            margin: 0;
            padding: 0;
        }

        /* Fallback cho trường hợp flexbox không hoạt động */
        .loading-content-fallback {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
    </style>
    @yield('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed admin-dashboard">
<!-- Màn hình loading -->
<div id="loading-overlay">
    <div class="loading-content">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="loading-logo">
        <div class="loading-spinner"></div>
        <div class="loading-progress">
            <div class="loading-progress-bar"></div>
        </div>
        <div class="loading-text">Đang tải<span class="loading-dots"></span></div>
    </div>
</div>

<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">Trang chủ</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('signout') }}">
                    <i class="fas fa-sign-out-alt"></i> Đăng xuất
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Admin Panel</span>
        </a>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">Quản trị viên</a>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('category.index') }}" class="nav-link {{ request()->routeIs('category.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Quản lý danh mục</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('product.listproduct') }}" class="nav-link {{ request()->routeIs('product.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-shopping-bag"></i>
                            <p>Quản lý sản phẩm</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.orderindexAdmin') }}" class="nav-link {{ request()->routeIs('admin.order*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Quản lý đơn hàng</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('manufacturer.listmanufacturer') }}" class="nav-link {{ request()->routeIs('manufacturer.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-industry"></i>
                            <p>Quản lý hãng sản xuất</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.listuser') }}" class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Quản lý người dùng</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.payment-methods.index') }}" class="nav-link {{ request()->routeIs('admin.payment-methods.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-credit-card"></i>
                            <p>Quản lý phương thức thanh toán</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('post.listpost') }}" class="nav-link {{ request()->routeIs('post.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>Quản lý bài viết</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('banner.index') }}" class="nav-link {{ request()->routeIs('banner.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-image"></i>
                            <p>Quản lý banner</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.chat.index') }}" class="nav-link">
                            <i class="fa fa-comments"></i>
                            <p>Quản lý tin nhắn</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('page-title', 'Dashboard')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
                            <li class="breadcrumb-item active">@yield('page-title', 'Dashboard')</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            @yield('content')
        </section>
    </div>
    <footer class="main-footer">
        <strong>Copyright &copy; 2025 <a href="#">Admin Panel</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>
</div>
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        // Ẩn loading khi trang đã tải xong
        $('body').removeClass('loading');
        $('#loading-overlay').removeClass('show').fadeOut(500);

        // Hiển thị loading khi click vào link (trừ các link đặc biệt)
        $('a:not([href^="#"]):not([target="_blank"]):not([download]):not(.no-loading)').on('click', function(e) {
            const href = $(this).attr('href');
            if (href && href !== 'javascript:void(0)' && href !== '#') {
                $('body').addClass('loading');
                $('#loading-overlay').addClass('show').fadeIn(300);
            }
        });

        // Hiển thị loading khi submit form
        $('form:not(.no-loading)').on('submit', function() {
            $('body').addClass('loading');
            $('#loading-overlay').addClass('show').fadeIn(300);
        });

        // Ẩn loading nếu có lỗi hoặc trang không chuyển
        setTimeout(function() {
            $('body').removeClass('loading');
            $('#loading-overlay').removeClass('show').fadeOut(500);
        }, 10000); // Timeout sau 10 giây

        // Xử lý thông báo với SweetAlert2
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session("success") }}',
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: '{{ session("error") }}',
                timer: 5000,
                showConfirmButton: true
            });
        @endif

        @if(session('warning'))
            Swal.fire({
                icon: 'warning',
                title: 'Cảnh báo!',
                text: '{{ session("warning") }}',
                timer: 4000,
                showConfirmButton: true
            });
        @endif

        // Xác nhận xóa
        $('.btn-delete, .delete-btn, .btn-delete-swal-unique, .btn-delete-post').on('click', function(e) {
            e.preventDefault();
            const form = $(this).closest('form');
            const href = $(this).attr('href');
            const postTitle = $(this).data('post-title');

            let confirmText = 'Bạn có chắc chắn?';
            if (postTitle) {
                confirmText = `Bạn có chắc chắn muốn xóa bài viết "${postTitle}"?`;
            }

            Swal.fire({
                title: 'Xác nhận xóa',
                text: confirmText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Có, xóa!',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (form.length) {
                        form.submit();
                    } else if (href) {
                        window.location.href = href;
                    }
                }
            });
        });
    });

    // Hiển thị loading khi chuyển trang bằng JavaScript
    function showLoading() {
        $('body').addClass('loading');
        $('#loading-overlay').addClass('show').fadeIn(300);
    }

    // Ẩn loading
    function hideLoading() {
        $('body').removeClass('loading');
        $('#loading-overlay').removeClass('show').fadeOut(300);
    }
</script>

@yield('scripts')
</body>
</html> 