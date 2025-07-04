@extends('user.account_dashboard')

@section('account_content')
<!-- SEO Meta Tags -->
<title>Đổi mật khẩu | Fashion Store</title>
<meta name="description" content="Thay đổi mật khẩu tài khoản của bạn một cách an toàn và bảo mật.">

<div class="card shadow-lg">
    <div class="card-header bg-warning text-white d-flex align-items-center">
        <i class="fa fa-key fa-2x me-2"></i>
        <h4 class="mb-0">Đổi mật khẩu</h4>
    </div>
    <div class="card-body">
        @include('user.partials.alerts')
        
        <form action="{{ route('user.changePassword') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                <input type="password" name="current_password" id="current_password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">Mật khẩu mới</label>
                <input type="password" name="new_password" id="new_password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="new_password_confirmation" class="form-label">Nhập lại mật khẩu mới</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning">Đổi mật khẩu</button>
        </form>
    </div>
</div>
@endsection 