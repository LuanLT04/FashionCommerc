@extends('admin.layout')
@section('title', 'Quản lý danh mục')
@section('page-title', 'Quản lý danh mục')
@section('meta_description', 'Trang quản lý danh mục sản phẩm, thêm, sửa, xóa danh mục cho hệ thống bán hàng thời trang.')
@section('meta_keywords', 'danh mục, quản lý danh mục, admin, sản phẩm, thời trang')

@section('content')
<div class="container-fluid">
    <!-- Card chính -->
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    <i class="fas fa-th mr-2"></i>Danh sách danh mục
                </h3>
                <div class="card-tools">
                    <a href="{{ route('category.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus mr-1"></i>Thêm danh mục
                    </a>
                </div>
            </div>
        </div>

        <!-- Thanh tìm kiếm -->
        <div class="card-body pb-0">
            <form action="{{ route('category.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                           placeholder="Tìm kiếm danh mục..."
                           value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('search'))
                        <a href="{{ route('category.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i>
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
                        <th>Tên danh mục</th>
                        <th style="width: 120px;" class="text-center">Ảnh</th>
                        <th style="width: 150px;" class="text-center">Ngày tạo</th>
                        <th style="width: 150px;" class="text-center">Ngày cập nhật</th>
                        <th style="width: 120px;" class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td class="text-center">
                                <span class="badge badge-primary">{{ $category->id_category }}</span>
                            </td>
                            <td class="font-weight-medium">{{ $category->name_category }}</td>
                            <td class="text-center">
                                @if($category->image_category)
                                    <img src="{{ asset('uploads/categoryimage/' . $category->image_category) }}"
                                         alt="{{ $category->name_category }}"
                                         class="img-thumbnail category-img"
                                         style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <span class="text-muted">
                                        <i class="fas fa-image"></i> Không có ảnh
                                    </span>
                                @endif
                            </td>
                            <td class="text-center text-muted">
                                {{ $category->created_at ? $category->created_at->format('d/m/Y') : '-' }}
                            </td>
                            <td class="text-center text-muted">
                                {{ $category->updated_at ? $category->updated_at->format('d/m/Y') : '-' }}
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('category.edit', $category->id_category) }}"
                                       class="btn btn-sm btn-warning"
                                       title="Chỉnh sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('category.deleteCategoryGet', $category->id_category) }}" class="btn btn-sm btn-danger btn-delete-swal-unique no-loading">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <p class="mb-0">Không có dữ liệu danh mục</p>
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
        @if($categories->hasPages())
        <div class="card-footer clearfix">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Hiển thị {{ $categories->firstItem() ?? 0 }} đến {{ $categories->lastItem() ?? 0 }}
                    trong tổng số {{ $categories->total() }} kết quả
                </div>
                <div>
                    {{ $categories->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
@section('styles')
<style>
    .category-img {
        transition: transform 0.3s ease;
        cursor: pointer;
    }

    .category-img:hover {
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
// ... existing code ...
@endsection