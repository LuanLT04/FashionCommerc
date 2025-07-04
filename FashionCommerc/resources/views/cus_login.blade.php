@extends('layout.app')

@section('title', 'Đăng nhập')

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
            <div class="form-head">Đăng nhập</div>
            <div class="form-desc">Chào mừng bạn quay trở lại! Hãy đăng nhập để tiếp tục mua sắm.</div>
            @if (Session::has('message'))
                <div class="error-info text-center mb-4">{{ Session::get('message') }}</div>
                @php Session::put('message', null); @endphp
            @endif
            <form action="{{ route('user.cus_login') }}" method="post" id="frmLogin" onsubmit="return validate();">
                @csrf
                <div class="field-column">
                    <label for="email">Email</label>
                    <input name="email" id="user_name" type="email" class="demo-input-box" 
                        placeholder="Nhập địa chỉ email của bạn">
                    <i class="fa fa-envelope input-icon"></i>
                    <span id="user_info" class="error-info"></span>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="field-column">
                    <label for="password">Mật khẩu</label>
                    <input name="password" id="password" type="password" class="demo-input-box" 
                        placeholder="Nhập mật khẩu của bạn">
                    <i class="fa fa-lock input-icon"></i>
                    <span id="password_info" class="error-info"></span>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="field-column">
                    <button type="submit" class="btnLogin">
                        <i class="fa fa-sign-in"></i>
                        Đăng nhập
                    </button>
                </div>
                <div class="divider">
                    <span>hoặc đăng nhập với</span>
                </div>
                <div class="social-login">
                    <button type="button" class="social-btn google" onclick="alert('Tính năng đang phát triển')">
                        <i class="fa fa-google"></i>
                        Google
                    </button>
                    <button type="button" class="social-btn facebook" onclick="alert('Tính năng đang phát triển')">
                        <i class="fa fa-facebook"></i>
                        Facebook
                    </button>
                </div>
                <div class="form-nav-row">
                    <a href="#" class="form-link" onclick="alert('Chức năng quên mật khẩu đang được phát triển.'); return false;">
                        <i class="fa fa-question-circle"></i>
                        Quên mật khẩu?
                    </a>
                </div>
                <div class="login-row">
                    <p>Bạn chưa có tài khoản?</p>
                    <a href="{{ route('user.cus_register') }}" class="form-link">
                        <i class="fa fa-user-plus"></i>
                        Tạo tài khoản
                    </a>
                </div>
                <div class="login-row">
                    <a href="{{ route('home.index') }}" class="form-link">
                        <i class="fa fa-home"></i>
                        Quay lại trang chủ
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
function validate() {
    var $valid = true;
    document.getElementById("user_info").innerHTML = "";
    document.getElementById("password_info").innerHTML = "";
    var userName = document.getElementById("user_name").value;
    var password = document.getElementById("password").value;
    if (userName.trim() == "") {
        document.getElementById("user_info").innerHTML = "Vui lòng nhập email";
        $valid = false;
    } else if (!validateEmail(userName)) {
        document.getElementById("user_info").innerHTML = "Vui lòng nhập email hợp lệ";
        $valid = false;
    }
    if (password.trim() == "") {
        document.getElementById("password_info").innerHTML = "Vui lòng nhập mật khẩu";
        $valid = false;
    }
    return $valid;
}
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
</script>
@endsection
