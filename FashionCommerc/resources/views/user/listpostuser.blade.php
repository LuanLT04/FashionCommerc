@extends('user.dashboard_user')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 text-center" data-aos="fade-up">
                <h1 class="hero-title">Tin tức & Bài viết</h1>
                <p class="hero-subtitle">Cập nhật những tin tức mới nhất về thời trang và xu hướng</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Posts Carousel -->
@if(isset($posts) && count($posts) > 0)
<section class="section-padding">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Tin nổi bật</h2>
            <p>Những bài viết mới và đáng chú ý</p>
        </div>
        
        <div id="featuredPostsCarousel" class="carousel slide" data-bs-ride="carousel" data-aos="fade-up">
            <div class="carousel-inner rounded-4 overflow-hidden">
                @foreach($posts as $index => $post)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <div class="row g-0 align-items-center bg-light">
                        <div class="col-lg-6">
                            @foreach($post->images as $key => $image)
                                @if($key == 0)
                                <img src="{{ asset('uploads/post/' . $image->file_name) }}" 
                                     alt="{{ $post->title_post }}" 
                                     class="img-fluid w-100" 
                                     style="height: 400px; object-fit: cover;">
                                @endif
                            @endforeach
                        </div>
                        <div class="col-lg-6 p-4 p-lg-5">
                            <div class="p-3">
                                <h3 class="mb-3">
                                    <a href="{{ route('post.detailpost', ['id' => $post->id_post]) }}" class="text-decoration-none text-dark">
                                        {{ $post->title_post }}
                                    </a>
                                </h3>
                                <div class="post-excerpt mb-3">
                                    {{ Str::limit(strip_tags($post->content_post), 200, '...') }}
                                </div>
                                <div class="d-flex align-items-center text-muted">
                                    <i class="far fa-calendar-alt me-2"></i>
                                    <span>{{ $post->created_at ? $post->created_at->format('d/m/Y') : 'N/A' }}</span>
                                    <a href="{{ route('post.detailpost', ['id' => $post->id_post]) }}" 
                                       class="btn btn-outline-primary btn-sm ms-auto">
                                        Đọc thêm
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#featuredPostsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#featuredPostsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
@endif

<!-- All Posts Section -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Tất cả bài viết</h2>
            <p>Các bài viết và tin tức mới nhất từ chúng tôi</p>
        </div>
        
        <div class="row g-4">
            @forelse($postsnew as $item)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="position-relative">
                        @foreach($item->images as $key => $image)
                            @if($key == 0)
                            <img src="{{ asset('uploads/post/' . $image->file_name) }}" 
                                 class="card-img-top" 
                                 alt="{{ $item->title_post }}"
                                 style="height: 200px; object-fit: cover;">
                            @endif
                        @endforeach
                        @if($item->created_at)
                        <div class="card-img-overlay d-flex align-items-end p-0">
                            <span class="badge bg-primary">
                                <i class="far fa-calendar-alt me-1"></i>
                                {{ $item->created_at->format('d/m/Y') }}
                            </span>
                        </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('post.detailpost', ['id' => $item->id_post]) }}" class="text-decoration-none text-dark">
                                {{ Str::limit($item->title_post, 60) }}
                            </a>
                        </h5>
                        <p class="card-text text-muted">
                            {{ Str::limit(strip_tags($item->content_post), 120, '...') }}
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <a href="{{ route('post.detailpost', ['id' => $item->id_post]) }}" 
                           class="btn btn-link text-primary text-decoration-none p-0">
                            Đọc thêm <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5" data-aos="fade-up">
                <div class="text-muted">
                    <i class="far fa-newspaper fa-3x mb-3"></i>
                    <p class="h5">Chưa có bài viết nào</p>
                </div>
            </div>
            @endforelse
        </div>
        
        @if(isset($postsnew) && $postsnew->hasPages())
        <div class="mt-5" data-aos="fade-up">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    @if($postsnew->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $postsnew->previousPageUrl() }}" aria-label="Previous">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>
                    @endif
                    
                    @for($i = 1; $i <= $postsnew->lastPage(); $i++)
                        <li class="page-item {{ $postsnew->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $postsnew->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    
                    @if($postsnew->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $postsnew->nextPageUrl() }}" aria-label="Next">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
        @endif
    </div>
</section>

<style>
/* Hero Section */
.hero-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    margin-bottom: 40px;
}

.hero-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: #2c3e50;
}

.hero-subtitle {
    font-size: 1.25rem;
    color: #6c757d;
    margin-bottom: 2rem;
}

/* Section Styling */
.section-padding {
    padding: 80px 0;
}

.section-title {
    text-align: center;
    margin-bottom: 50px;
}

.section-title h2 {
    font-size: 2rem;
    font-weight: 700;
    position: relative;
    display: inline-block;
    margin-bottom: 15px;
    color: #2c3e50;
}

.section-title h2:after {
    content: '';
    position: absolute;
    width: 60px;
    height: 3px;
    background: #007bff;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
}

.section-title p {
    color: #6c757d;
    font-size: 1.1rem;
    margin-bottom: 0;
}

/* Card Styling */
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: none;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

.card-img-top {
    transition: transform 0.3s ease;
}

.card:hover .card-img-top {
    transform: scale(1.05);
}

.card-body {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.card-title {
    font-weight: 600;
    margin-bottom: 0.75rem;
}

.card-text {
    flex: 1;
}

/* Badge Styling */
.badge {
    font-weight: 500;
    padding: 0.4em 0.8em;
    border-radius: 50px;
    font-size: 0.8rem;
}

/* Button Styling */
.btn-outline-primary {
    border-width: 2px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,123,255,0.3);
}

/* Carousel Controls */
.carousel-control-prev,
.carousel-control-next {
    width: 40px;
    height: 40px;
    background: rgba(0,0,0,0.1);
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
    opacity: 0;
    transition: all 0.3s ease;
}

.carousel:hover .carousel-control-prev,
.carousel:hover .carousel-control-next {
    opacity: 1;
}

/* Responsive Adjustments */
@media (max-width: 991.98px) {
    .hero-section {
        padding: 60px 0;
    }
    
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .section-padding {
        padding: 60px 0;
    }
}

@media (max-width: 767.98px) {
    .hero-section {
        padding: 40px 0;
        text-align: center;
    }
    
    .hero-title {
        font-size: 1.75rem;
    }
    
    .section-padding {
        padding: 40px 0;
    }
    
    .section-title h2 {
        font-size: 1.75rem;
    }
}
</style>

<!-- Initialize AOS -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS (Animate On Scroll)
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    }
    
    // Pause carousel on hover
    const carousel = document.querySelector('#featuredPostsCarousel');
    if (carousel) {
        carousel.addEventListener('mouseenter', function() {
            const carouselInstance = new bootstrap.Carousel(carousel);
            carouselInstance.pause();
        });
        
        carousel.addEventListener('mouseleave', function() {
            const carouselInstance = new bootstrap.Carousel(carousel);
            carouselInstance.cycle();
        });
    }
});
</script>
@endsection