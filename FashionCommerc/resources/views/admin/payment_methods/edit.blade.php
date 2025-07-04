@extends('admin.layout')
@section('title', 'Sửa phương thức thanh toán')
@section('page-title', 'Sửa phương thức thanh toán')
@section('content')
<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Sửa phương thức thanh toán</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.payment-methods.update', $method->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Tên phương thức</label>
                    <input type="text" name="name" id="name" class="form-control" required value="{{ old('name', $method->name) }}">
                </div>
                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea name="description" id="description" class="form-control">{{ old('description', $method->description) }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('admin.payment-methods.index') }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
</div>
@endsection 