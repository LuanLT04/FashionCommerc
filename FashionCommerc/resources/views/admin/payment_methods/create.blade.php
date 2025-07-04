@extends('admin.layout')
@section('title', 'Thêm phương thức thanh toán')
@section('page-title', 'Thêm phương thức thanh toán')
@section('content')
<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Thêm phương thức thanh toán mới</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.payment-methods.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Tên phương thức</label>
                    <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                </div>
                <button type="submit" class="btn btn-success">Thêm mới</button>
                <a href="{{ route('admin.payment-methods.index') }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
</div>
@endsection 