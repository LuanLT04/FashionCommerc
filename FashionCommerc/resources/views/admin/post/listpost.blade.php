@extends('admin.layout')
@section('title', 'Quản lý bài viết')
@section('page-title', 'Quản lý bài viết')

@section('content')
<div class="container-fluid">
    <!-- Card chính -->
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    <i class="fas fa-newspaper mr-2"></i>Danh sách bài viết
                </h3>
                <div class="card-tools">
                    <a href="{{ route('post.indexaddpost') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus mr-1"></i>Thêm bài viết
                    </a>
                </div>
            </div>
        </div>

        <!-- Bảng dữ liệu -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 80px;" class="text-center">Mã bài viết</th>
                        <th>Tiêu đề bài viết</th>
                        <th>Nội dung</th>
                        <th style="width: 200px;" class="text-center">Hình ảnh</th>
                        <th style="width: 150px;" class="text-center">Ngày tạo</th>
                        <th style="width: 140px;" class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                    <tr>
                        <td class="text-center">
                            <span class="badge badge-primary">{{ $post->id_post }}</span>
                        </td>
                        <td class="font-weight-medium">
                            <div>
                                <h6 class="mb-1">{{ Str::limit($post->title_post, 50) }}</h6>
                                @if(strlen($post->title_post) > 50)
                                    <small class="text-muted" title="{{ $post->title_post }}">
                                        <i class="fas fa-info-circle"></i> Hover để xem đầy đủ
                                    </small>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="post-content">
                                {{ Str::limit(strip_tags($post->content_post), 100) }}
                                @if(strlen(strip_tags($post->content_post)) > 100)
                                    <button class="btn btn-link btn-sm p-0 ml-1"
                                            onclick="showFullContent('{{ addslashes($post->content_post) }}', '{{ addslashes($post->title_post) }}')">
                                        <i class="fas fa-expand-alt"></i> Xem thêm
                                    </button>
                                @endif
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="post-images">
                                @if(isset($postImages[$post->id_post]) && count($postImages[$post->id_post]) > 0)
                                    <div class="image-gallery">
                                        @foreach($postImages[$post->id_post] as $index => $imageName)
                                            @if($index < 2)
                                                <img src="{{ asset('uploads/post/' . $imageName) }}"
                                                     alt="Post image"
                                                     class="img-thumbnail post-img mr-1 mb-1"
                                                     style="width: 60px; height: 60px; object-fit: cover;">
                                            @endif
                                        @endforeach
                                        @if(count($postImages[$post->id_post]) > 2)
                                            <span class="badge badge-info">
                                                +{{ count($postImages[$post->id_post]) - 2 }} ảnh
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-muted">
                                        <i class="fas fa-image"></i> Không có ảnh
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td class="text-center text-muted">
                            @if($post->created_at)
                                <div>{{ $post->created_at->format('d/m/Y') }}</div>
                                <small>{{ $post->created_at->format('H:i') }}</small>
                            @else
                                <span class="text-muted">Không có</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('post.indexupdatepost', ['id' => $post->id_post]) }}"
                                   class="btn btn-sm btn-warning"
                                   title="Chỉnh sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('post.deletePostGet', $post->id_post) }}"
                                   class="btn btn-sm btn-danger btn-delete-post no-loading"
                                        data-post-id="{{ $post->id_post }}"
                                        data-post-title="{{ $post->title_post }}"
                                        title="Xóa bài viết">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <div class="text-muted">
                                <i class="fas fa-newspaper fa-3x mb-3"></i>
                                <p class="mb-0">Không có bài viết nào</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Phân trang -->
        @if($posts->hasPages())
        <div class="card-footer clearfix">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Hiển thị {{ $posts->firstItem() ?? 0 }} đến {{ $posts->lastItem() ?? 0 }}
                    trong tổng số {{ $posts->total() }} bài viết
                </div>
                <div>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Modal xem nội dung đầy đủ -->
<div class="modal fade" id="contentModal" tabindex="-1" role="dialog" aria-labelledby="contentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contentModalLabel">Nội dung bài viết</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="contentModalBody">
                <!-- Nội dung sẽ được load bằng JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .post-img {
        transition: transform 0.3s ease;
        cursor: pointer;
    }

    .post-img:hover {
        transform: scale(1.5);
        z-index: 1000;
        position: relative;
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    }

    .post-content {
        max-width: 300px;
        word-wrap: break-word;
    }

    .image-gallery {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }

    .table td {
        vertical-align: middle;
    }

    .btn-link {
        color: #007bff;
        text-decoration: none;
    }

    .btn-link:hover {
        color: #0056b3;
        text-decoration: underline;
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

    // Hàm hiển thị nội dung đầy đủ
    function showFullContent(content, title) {
        $('#contentModalLabel').text(title);
        $('#contentModalBody').html(content);
        $('#contentModal').modal('show');
    }
</script>
@endsection