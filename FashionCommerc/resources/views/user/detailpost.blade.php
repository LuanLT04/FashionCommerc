@extends('user.dashboard_user')

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('post.indexListPostUser') }}">Tin tức</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($post->title_post, 50) }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <article class="blog-post-detail bg-white rounded shadow-sm p-4 mb-4">
                <!-- Post Title -->
                <h1 class="mb-3 fw-bold">{{ $post->title_post }}</h1>
                
                <!-- Post Meta -->
                <div class="post-meta mb-4 text-muted">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="me-4">
                            <i class="far fa-calendar-alt me-1"></i>
                            <span>Ngày đăng: {{ $post->created_at ? $post->created_at->format('d/m/Y H:i') : 'N/A' }}</span>
                        </div>
                        <div>
                            <i class="fas fa-sync-alt me-1"></i>
                            <span>Cập nhật: {{ $post->updated_at ? $post->updated_at->format('d/m/Y H:i') : 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Featured Image -->
                @if(!empty($file_name_image_post[0] ?? ''))
                <div class="post-featured-image mb-4">
                    <img src="{{ asset('uploads/post/' . $file_name_image_post[0]) }}" 
                         alt="{{ $post->title_post }}" 
                         class="img-fluid rounded w-100">
                </div>
                @endif

                <!-- Post Content -->
                <div class="post-content">
                    {!! nl2br(e($post->content_post)) !!}
                </div>

                <!-- Gallery Images -->
                @if(count($file_name_image_post) > 1)
                <div class="post-gallery mt-5">
                    <h5 class="mb-3">Hình ảnh liên quan</h5>
                    <div class="row g-3">
                        @foreach($file_name_image_post as $index => $image)
                            @if($index > 0)
                            <div class="col-md-4 col-6">
                                <a href="{{ asset('uploads/post/' . $image) }}" data-fancybox="gallery" class="d-block">
                                    <img src="{{ asset('uploads/post/' . $image) }}" 
                                         alt="Hình ảnh {{ $index }}" 
                                         class="img-fluid rounded shadow-sm">
                                </a>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Social Share -->
                <div class="post-share mt-5 pt-4 border-top">
                    <h6 class="mb-3">Chia sẻ bài viết:</h6>
                    <div class="social-share">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                           target="_blank" 
                           class="btn btn-outline-primary btn-sm me-2 mb-2">
                            <i class="fab fa-facebook-f me-1"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title_post) }}" 
                           target="_blank" 
                           class="btn btn-outline-info btn-sm me-2 mb-2">
                            <i class="fab fa-twitter me-1"></i> Twitter
                        </a>
                        <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}&media={{ urlencode(asset('uploads/post/' . ($file_name_image_post[0] ?? ''))) }}&description={{ urlencode($post->title_post) }}" 
                           target="_blank" 
                           class="btn btn-outline-danger btn-sm me-2 mb-2">
                            <i class="fab fa-pinterest-p me-1"></i> Pinterest
                        </a>
                    </div>
                </div>
            </article>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Recent Posts -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Bài viết gần đây</h5>
                </div>
                <div class="card-body">
                    @php
                        $recentPosts = \App\Models\Posts::orderBy('created_at', 'desc')
                            ->where('id_post', '!=', $post->id_post)
                            ->take(5)
                            ->get();
                    @endphp
                    
                    @forelse($recentPosts as $recentPost)
                    <div class="d-flex mb-3">
                        @php
                            $recentImage = DB::table('postimages')
                                ->join('images_posts', 'postimages.id_image_post', '=', 'images_posts.id_image_post')
                                ->where('postimages.id_post', $recentPost->id_post)
                                ->first();
                        @endphp
                        @if($recentImage ?? false)
                        <img src="{{ asset('uploads/post/' . $recentImage->file_name) }}" 
                             alt="{{ $recentPost->title_post }}" 
                             class="flex-shrink-0 me-3" 
                             width="80" 
                             style="object-fit: cover; height: 60px;">
                        @else
                        <div class="bg-light d-flex align-items-center justify-content-center me-3" style="width: 80px; height: 60px;">
                            <i class="fas fa-image text-muted"></i>
                        </div>
                        @endif
                        <div>
                            <h6 class="mb-1">
                                <a href="{{ route('post.detailpost', ['id' => $recentPost->id_post]) }}" 
                                   class="text-dark text-decoration-none">
                                    {{ Str::limit($recentPost->title_post, 50) }}
                                </a>
                            </h6>
                            <small class="text-muted">
                                <i class="far fa-calendar-alt me-1"></i>
                                {{ $recentPost->created_at ? $recentPost->created_at->format('d/m/Y') : 'N/A' }}
                            </small>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted mb-0">Chưa có bài viết nào khác.</p>
                    @endforelse
                </div>
            </div>

            <!-- Categories -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Danh mục</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @php
                            $categories = \App\Models\Category::all();
                        @endphp
                        @foreach($categories as $category)
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            {{ $category->name_category }}
                            <span class="badge bg-primary rounded-pill">{{ $category->products->count() }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .blog-post-detail {
        line-height: 1.8;
    }
    .blog-post-detail h1,
    .blog-post-detail h2,
    .blog-post-detail h3,
    .blog-post-detail h4,
    .blog-post-detail h5,
    .blog-post-detail h6 {
        margin-top: 1.5rem;
        margin-bottom: 1rem;
        color: #2c3e50;
    }
    .blog-post-detail img {
        max-width: 100%;
        height: auto;
        margin: 1.5rem 0;
        border-radius: 0.5rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    .post-featured-image {
        position: relative;
        overflow: hidden;
        border-radius: 0.5rem;
    }
    .post-featured-image img {
        transition: transform 0.3s ease;
    }
    .post-featured-image:hover img {
        transform: scale(1.02);
    }
    .post-meta {
        font-size: 0.9rem;
    }
    .post-content {
        font-size: 1.05rem;
        color: #495057;
    }
    .post-content p {
        margin-bottom: 1.2rem;
    }
    .post-gallery img {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .post-gallery img:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    .social-share .btn {
        transition: all 0.3s ease;
    }
    .social-share .btn:hover {
        transform: translateY(-2px);
    }
    .breadcrumb {
        background-color: transparent;
        padding: 0.75rem 0;
        margin-bottom: 1rem;
    }
    .breadcrumb-item a {
        color: #6c757d;
        text-decoration: none;
    }
    .breadcrumb-item a:hover {
        color: #0d6efd;
        text-decoration: underline;
    }
    .breadcrumb-item.active {
        color: #0d6efd;
    }
</style>
@endpush

@push('scripts')
<!-- Fancybox for image gallery -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Fancybox.bind("[data-fancybox]", {
            // Your custom options
        });
    });
</script>
@endpush
@endsection