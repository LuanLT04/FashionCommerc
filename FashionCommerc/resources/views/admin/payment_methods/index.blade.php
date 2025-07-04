@extends('admin.layout')
@section('title', 'Quản lý phương thức thanh toán')
@section('page-title', 'Quản lý phương thức thanh toán')
@section('content')
<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title"><i class="fas fa-credit-card mr-2"></i>Danh sách phương thức thanh toán</h3>
            <a href="{{ route('admin.payment-methods.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Thêm mới</a>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Tên phương thức</th>
                        <th>Mô tả</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($methods as $method)
                    <tr>
                        <td>{{ $method->id }}</td>
                        <td>{{ $method->name }}</td>
                        <td>{{ $method->description }}</td>
                        <td>
                            @if($method->is_active)
                                <span class="badge badge-success">Hiển thị</span>
                            @else
                                <span class="badge badge-secondary">Đã tắt</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.payment-methods.edit', $method->id) }}" class="btn btn-sm btn-warning" title="Sửa"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.payment-methods.destroy', $method->id) }}" method="POST" class="d-inline delete-method-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger btn-delete-method" title="Xóa"><i class="fas fa-trash"></i></button>
                            </form>
                            <form action="{{ route('admin.payment_methods.toggle', $method->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $method->is_active ? 'btn-secondary' : 'btn-success' }}" title="{{ $method->is_active ? 'Tắt' : 'Bật' }}">
                                    <i class="fas {{ $method->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center">Chưa có phương thức thanh toán nào.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('.btn-delete-method').on('click', function() {
            const form = $(this).closest('form');
            Swal.fire({
                title: 'Xác nhận xóa',
                text: 'Bạn có chắc chắn muốn xóa phương thức này?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Có, xóa!',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection 