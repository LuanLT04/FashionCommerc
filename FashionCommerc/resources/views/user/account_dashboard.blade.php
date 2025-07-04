@extends('user.dashboard_user')

@section('content')
<title>Quản lý tài khoản | Dashboard khách hàng</title>
<meta name="description" content="Trang quản lý tài khoản khách hàng: thông tin cá nhân, ví tài khoản, đơn hàng, đổi mật khẩu, lịch sử giao dịch.">
<link rel="stylesheet" href="{{ asset('css/user/account_dashboard.css') }}">
<div class="container py-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3 mb-4">
            <div class="account-sidebar text-center">
                <img src="{{ Auth::user()->avatar ? asset('storage/avatars/' . Auth::user()->avatar) : asset('img/default-avatar.png') }}" class="avatar mb-2" alt="Avatar">
                <div class="name">{{ Auth::user()->name }}</div>
                <div class="email">{{ Auth::user()->email }}</div>
                <div class="list-group mt-4">
                    <a href="{{ route('user.account') }}" class="list-group-item {{ request()->routeIs('user.account') ? 'active' : '' }}">
                        <i class="fa-solid fa-user me-2"></i> Thông tin tài khoản
                    </a>
                    <a href="{{ route('user.finance.dashboard') }}" class="list-group-item {{ request()->routeIs('user.finance.dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-wallet me-2"></i> Quản lý ví
                    </a>
                    <a href="{{ route('order.orderIndex') }}" class="list-group-item {{ request()->routeIs('order.orderIndex') ? 'active' : '' }}">
                        <i class="fa-solid fa-file-invoice me-2"></i> Đơn hàng
                    </a>
                    <a href="{{ route('user.showChangePasswordForm') }}" class="list-group-item {{ request()->routeIs('user.showChangePasswordForm') ? 'active' : '' }}">
                        <i class="fa-solid fa-key me-2"></i> Đổi mật khẩu
                    </a>
                    <a href="{{ route('signout') }}" class="list-group-item">
                        <i class="fa-solid fa-right-from-bracket me-2"></i> Đăng xuất
                    </a>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <div class="col-lg-9">
            @yield('account_content')
        </div>
    </div>
</div>
@endsection 