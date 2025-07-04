@extends('admin.layout')

@section('title', 'Quản lý Banner')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Quản lý Banner</h2>
        <a href="{{ route('banner.create') }}" class="btn btn-primary">
            <i class="fa fa-plus me-1"></i> Thêm Banner mới
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle table-hover bg-white shadow-sm">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col" class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($banners as $index => $banner)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <img src="{{ asset('uploads/banner/' . $banner->image) }}" alt="Banner" style="width: 120px; height: 60px; object-fit:cover; border-radius:8px;">
                    </td>
                    <td>{{ $banner->title }}</td>
                    <td style="max-width: 300px;">{{ $banner->content }}</td>
                    <td>
                        @if($banner->status)
                            <span class="badge bg-success">Hiển thị</span>
                        @else
                            <span class="badge bg-secondary">Ẩn</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('banner.edit', $banner->id_banner) }}" class="btn btn-sm btn-warning me-1"><i class="fa fa-edit"></i></a>
                        <form action="{{ route('banner.destroy', $banner->id_banner) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa banner này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Chưa có banner nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection 