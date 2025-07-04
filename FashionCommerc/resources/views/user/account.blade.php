@extends('user.account_dashboard')

@section('account_content')
<!-- SEO Meta Tags -->
<title>Quản lý tài khoản khách hàng | Fashion Store</title>
<meta name="description" content="Trang quản lý tài khoản khách hàng: cập nhật thông tin cá nhân, đổi mật khẩu, xem lịch sử đơn hàng. Bảo mật, hiện đại, chuẩn SEO.">
<meta name="robots" content="index, follow">
<link rel="canonical" href="{{ url()->current() }}" />

<div class="card shadow-lg">
    <div class="card-header bg-primary text-white d-flex align-items-center">
        <i class="fa fa-user-circle fa-2x me-2"></i>
        <h4 class="mb-0">Quản lý tài khoản</h4>
    </div>
    <div class="card-body">
        @include('user.partials.alerts')
        
        <!-- Thông tin cá nhân -->
        <form action="{{ route('user.updateProfile') }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
            <div class="row mb-3 align-items-center">
                <div class="col-auto">
                    <img src="{{ Auth::user()->avatar ? asset('storage/avatars/' . Auth::user()->avatar) : asset('img/default-avatar.png') }}" class="rounded-circle" width="80" height="80" alt="Avatar">
                </div>
                <div class="col">
                    <label for="avatar" class="form-label">Đổi ảnh đại diện</label>
                    <input type="file" name="avatar" id="avatar" class="form-control">
                </div>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Họ tên</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ Auth::user()->name }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}" required readonly>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ Auth::user()->phone }}">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ Auth::user()->address }}">
            </div>
            <button type="submit" class="btn btn-success">Cập nhật thông tin</button>
        </form>

    </div>
</div>
@endsection 