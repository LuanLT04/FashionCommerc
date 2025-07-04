@extends('layout.app')

@section('title', 'Đăng ký')

@section('content')
<div class="login-page-wrapper">
    <div class="login-illustration">
        <img src="{{ asset('img/hero-image.jpg') }}" alt="Fashion Illustration" class="login-hero-img">
        <div class="login-brand">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="login-logo">
            <div class="brand-title">FASHION STORE</div>
            <div class="brand-desc">Nơi thời trang lên ngôi</div>
        </div>
    </div>
    <div class="login-form-side">
        <div class="login-form-container">
            <div class="form-head">Đăng ký</div>
            <div class="form-desc">Tạo tài khoản để trải nghiệm mua sắm thời trang hiện đại!</div>
            @if (Session::has('message'))
                <div class="alert alert-info text-center mb-3">{{ Session::get('message') }}</div>
                @php Session::put('message', null); @endphp
            @endif
            <form action="{{ route('user.cus_register') }}" method="post">
                @csrf
                <div class="field-column">
                    <label for="name">Họ tên</label>
                    <input type="text" name="name" class="demo-input-box" placeholder="Nhập họ tên" value="{{ old('name') }}">
                    <i class="fa fa-user input-icon"></i>
                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="field-column">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="demo-input-box" placeholder="Nhập email" value="{{ old('email') }}">
                    <i class="fa fa-envelope input-icon"></i>
                    @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="field-column">
                    <label for="password">Mật khẩu</label>
                    <input type="password" name="password" class="demo-input-box" placeholder="Nhập mật khẩu">
                    <i class="fa fa-lock input-icon"></i>
                    @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="field-column">
                    <label for="phone">Số điện thoại</label>
                    <input type="number" name="phone" class="demo-input-box" placeholder="Nhập số điện thoại" value="{{ old('phone') }}">
                    <i class="fa fa-phone input-icon"></i>
                    @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="field-column">
                    <label for="address">Địa chỉ</label>
                    <input type="text" name="address" class="demo-input-box" placeholder="Nhập địa chỉ" value="{{ old('address') }}">
                    <i class="fa fa-map-marker input-icon"></i>
                    @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="field-column">
                    <button type="submit" class="btnLogin">
                        <i class="fa fa-user-plus"></i>
                        Đăng ký
                    </button>
                </div>
                <div class="form-nav-row mt-2">
                    <a href="{{ route('user.cus_login') }}" class="form-link">
                        <i class="fa fa-sign-in"></i>
                        Đã có tài khoản?
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
