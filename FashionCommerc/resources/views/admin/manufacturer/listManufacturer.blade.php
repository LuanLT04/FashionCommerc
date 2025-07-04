@extends('admin.layout')
@section('title', 'Quản lý hãng sản xuất')
@section('page-title', 'Quản lý hãng sản xuất')

@section('content')
<div class="container-fluid">
    <!-- Card chính -->
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    <i class="fas fa-industry mr-2"></i>Danh sách hãng sản xuất
                </h3>
                <div class="card-tools">
                    <a href="{{ route('manufacturer.addmanufacturer') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus mr-1"></i>Thêm hãng sản xuất
                    </a>
                </div>
            </div>
        </div>

        <!-- Bảng dữ liệu -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 80px;" class="text-center">Mã hãng</th>
                        <th>Tên hãng</th>
                        <th style="width: 200px;" class="text-center">Ảnh hãng</th>
                        <th style="width: 140px;" class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($manufacturers as $manufacturer)
                    <tr>
                        <td class="text-center">
                            <span class="badge badge-primary">{{ $manufacturer->id_manufacturer }}</span>
                        </td>
                        <td class="font-weight-medium">{{ $manufacturer->name_manufacturer }}</td>
                        <td class="text-center">
                            <img src="{{ asset('uploads/manufacturerimage/' . $manufacturer->image_manufacturer) }}"
                                 alt="{{ $manufacturer->name_manufacturer }}"
                                 class="img-thumbnail manufacturer-img"
                                 style="width: 80px; height: 80px; object-fit: cover;">
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('manufacturer.indexupdatemanufacturer', ['id' => $manufacturer->id_manufacturer]) }}"
                                   class="btn btn-sm btn-warning"
                                   title="Chỉnh sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('manufacturer.deletemanufacturer', ['id' => $manufacturer->id_manufacturer]) }}"
                                   class="btn btn-sm btn-danger btn-delete no-loading"
                                   title="Xóa">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4">
                            <div class="text-muted">
                                <i class="fas fa-inbox fa-3x mb-3"></i>
                                <p class="mb-0">Không có hãng sản xuất nào</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Phân trang -->
        @if($manufacturers->hasPages())
        <div class="card-footer clearfix">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Hiển thị {{ $manufacturers->firstItem() ?? 0 }} đến {{ $manufacturers->lastItem() ?? 0 }}
                    trong tổng số {{ $manufacturers->total() }} hãng sản xuất
                </div>
                <div>
                    {{ $manufacturers->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('styles')
<style>
    .manufacturer-img {
        transition: transform 0.3s ease;
        cursor: pointer;
    }

    .manufacturer-img:hover {
        transform: scale(1.5);
        z-index: 1000;
        position: relative;
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    }

    .table td {
        vertical-align: middle;
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
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