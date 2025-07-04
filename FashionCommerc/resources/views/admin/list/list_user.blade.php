@extends('admin.layout')
@section('title', 'Quản lý người dùng')
@section('page-title', 'Quản lý người dùng')

@section('content')
<div class="container-fluid">
    <!-- Card chính -->
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    <i class="fas fa-users mr-2"></i>Danh sách người dùng
                </h3>
                <div class="card-tools">
                    <span class="badge badge-info">
                        Tổng: {{ method_exists($users, 'total') ? $users->total() : count($users) }} người dùng
                    </span>
                </div>
            </div>
        </div>

        <!-- Thanh tìm kiếm -->
        <div class="card-body pb-0">
            <form action="{{ route('user.searchUser') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                           placeholder="Tìm kiếm theo tên, email, số điện thoại..."
                           value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                        @if(request('search'))
                        <a href="{{ route('user.listuser') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Xóa
                        </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- Bảng dữ liệu -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 80px;" class="text-center">ID</th>
                        <th>Tên người dùng</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th style="width: 120px;" class="text-center">Trạng thái</th>
                        <th style="width: 200px;" class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td class="text-center">
                            <span class="badge badge-primary">{{ $user->id_user ?? $user->id }}</span>
                        </td>
                        <td class="font-weight-medium">
                            <div class="d-flex align-items-center">
                                <div class="user-avatar mr-2">
                                    <i class="fas fa-user-circle fa-2x text-secondary"></i>
                                </div>
                                <div>
                                    <div>{{ $user->name }}</div>
                                    <small class="text-muted">ID: {{ $user->id_user ?? $user->id }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <i class="fas fa-envelope text-muted mr-1"></i>
                            {{ $user->email }}
                        </td>
                        <td>
                            <i class="fas fa-phone text-muted mr-1"></i>
                            {{ $user->phone ?? 'Chưa cập nhật' }}
                        </td>
                        <td>
                            <i class="fas fa-map-marker-alt text-muted mr-1"></i>
                            {{ Str::limit($user->address ?? 'Chưa cập nhật', 30) }}
                        </td>
                        <td class="text-center">
                            @if($user->is_blocked ?? false)
                                <span class="badge badge-danger">
                                    <i class="fas fa-ban mr-1"></i>Đã chặn
                                </span>
                            @else
                                <span class="badge badge-success">
                                    <i class="fas fa-check-circle mr-1"></i>Hoạt động
                                </span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('user.updateUser', ['id' => $user->id_user ?? $user->id]) }}"
                                   class="btn btn-sm btn-warning"
                                   title="Chỉnh sửa">
                                    <i class="fas fa-edit"></i>
                                </a>

                                @if(!($user->is_blocked ?? false))
                                    <form class="d-inline block-user-form" method="POST" action="{{ route('user.block', ['id' => $user->id_user ?? $user->id]) }}">
                                        @csrf
                                        <button type="button" class="btn btn-sm btn-secondary btn-block-user" data-user-name="{{ $user->name }}" title="Chặn người dùng">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </form>
                                @else
                                    <form class="d-inline unblock-user-form" method="POST" action="{{ route('user.unblock', ['id' => $user->id_user ?? $user->id]) }}">
                                        @csrf
                                        <button type="button" class="btn btn-sm btn-success btn-unblock-user" data-user-name="{{ $user->name }}" title="Bỏ chặn người dùng">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                @endif

                                <form class="d-inline delete-user-form" method="POST" action="{{ route('user.deleteUser', ['id' => $user->id_user ?? $user->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger btn-delete-user" data-user-name="{{ $user->name }}" title="Xóa người dùng">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <div class="text-muted">
                                <i class="fas fa-users fa-3x mb-3"></i>
                                <p class="mb-0">Không có người dùng nào</p>
                                @if(request('search'))
                                    <small>Không tìm thấy kết quả cho "{{ request('search') }}"</small>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Phân trang -->
        @if(method_exists($users, 'hasPages') && $users->hasPages())
        <div class="card-footer clearfix">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Hiển thị {{ $users->firstItem() ?? 1 }} đến {{ $users->lastItem() ?? count($users) }}
                    trong tổng số {{ method_exists($users, 'total') ? $users->total() : count($users) }} người dùng
                </div>
                <div>
                    {{ $users->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('styles')
<style>
    .user-avatar {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .table td {
        vertical-align: middle;
    }

    .btn-group .btn {
        margin-right: 2px;
    }

    .badge {
        font-size: 0.75em;
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Auto focus vào ô tìm kiếm
        $('input[name="search"]').focus();

        // Xử lý nút xóa người dùng
        $('.btn-delete-user').on('click', function() {
            const form = $(this).closest('form');
            const userName = $(this).data('user-name');
            Swal.fire({
                title: 'Xác nhận xóa người dùng',
                text: `Bạn có chắc chắn muốn xóa người dùng "${userName}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Có, xóa!',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading();
                    form.submit();
                }
            });
        });

        // Xử lý nút chặn người dùng
        $('.btn-block-user').on('click', function() {
            const form = $(this).closest('form');
            const userName = $(this).data('user-name');
            Swal.fire({
                title: 'Xác nhận chặn người dùng',
                text: `Bạn có chắc chắn muốn chặn người dùng "${userName}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ffc107',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Có, chặn!',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading();
                    form.submit();
                }
            });
        });

        // Xử lý nút bỏ chặn người dùng
        $('.btn-unblock-user').on('click', function() {
            const form = $(this).closest('form');
            const userName = $(this).data('user-name');
            Swal.fire({
                title: 'Xác nhận bỏ chặn người dùng',
                text: `Bạn có chắc chắn muốn bỏ chặn người dùng "${userName}"?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Có, bỏ chặn!',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading();
                    form.submit();
                }
            });
        });

        // Hiệu ứng chuyển trang mượt mà
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var url = $(this).attr('href');
            showLoading();
            setTimeout(function() {
                window.location.href = url;
            }, 300);
        });
    });
</script>
@endsection