@extends('user.dashboard_user')

@section('content')
<!-- Modern Hero Section -->
<section class="blog-hero-section">
    <div class="hero-background">
        <div class="hero-overlay"></div>
        <div class="hero-particles"></div>
    </div>
    <div class="container">
        <div class="row align-items-center min-vh-75">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                <div class="hero-badge">
                    <i class="fas fa-newspaper me-2"></i>
                    Tin tức & Bài viết
                </div>
                <h1 class="hero-title">
                    Khám phá thế giới
                    <span class="gradient-text">thời trang</span>
                </h1>
                <p class="hero-subtitle">
                    Cập nhật những xu hướng mới nhất, bí quyết phối đồ và những câu chuyện
                    thú vị từ thế giới thời trang
                </p>
                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-number">{{ $postsnew->total() ?? 0 }}</div>
                        <div class="stat-label">Bài viết</div>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <div class="stat-number">50K+</div>
                        <div class="stat-label">Lượt đọc</div>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <div class="stat-number">1K+</div>
                        <div class="stat-label">Chia sẻ</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-scroll-indicator">
        <div class="scroll-arrow">
            <i class="fas fa-chevron-down"></i>
        </div>
    </div>
</section>

<!-- Featured Posts Section -->
@if(isset($posts) && count($posts) > 0)
<section class="featured-posts-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <div class="section-badge">
                <i class="fas fa-star me-2"></i>
                Nổi bật
            </div>
            <h2 class="section-title">Bài viết được quan tâm nhất</h2>
            <p class="section-subtitle">Những câu chuyện thời trang đang được yêu thích</p>
        </div>

        <div class="featured-posts-grid">
            @foreach($posts as $index => $post)
            <article class="featured-post-card {{ $index === 0 ? 'featured-main' : 'featured-secondary' }}" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="post-image-wrapper">
                    @foreach($post->images as $key => $image)
                        @if($key == 0)
                        <img src="{{ asset('uploads/post/' . $image->file_name) }}"
                             alt="{{ $post->title_post }}"
                             class="post-image"
                             loading="lazy">
                        @endif
                    @endforeach
                    <div class="post-overlay">
                        <div class="post-category">
                            <i class="fas fa-tag me-1"></i>
                            Thời trang
                        </div>
                    </div>
                </div>
                <div class="post-content">
                    <div class="post-meta">
                        <span class="post-date">
                            <i class="far fa-calendar-alt me-1"></i>
                            {{ $post->created_at ? $post->created_at->format('d/m/Y') : 'N/A' }}
                        </span>
                        <span class="post-read-time">
                            <i class="far fa-clock me-1"></i>
                            {{ ceil(str_word_count(strip_tags($post->content_post)) / 200) }} phút đọc
                        </span>
                    </div>
                    <h3 class="post-title">
                        <a href="{{ route('post.detailpost', ['id' => $post->id_post]) }}">
                            {{ $post->title_post }}
                        </a>
                    </h3>
                    <p class="post-excerpt">
                        {{ Str::limit(strip_tags($post->content_post), $index === 0 ? 150 : 100, '...') }}
                    </p>
                    <div class="post-footer">
                        <a href="{{ route('post.detailpost', ['id' => $post->id_post]) }}" class="read-more-btn">
                            <span>Đọc thêm</span>
                            <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                        <div class="post-actions">
                            <button class="action-btn" title="Yêu thích">
                                <i class="far fa-heart"></i>
                            </button>
                            <button class="action-btn" title="Chia sẻ">
                                <i class="fas fa-share-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- All Posts Section -->
<section class="all-posts-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <div class="section-badge">
                <i class="fas fa-list me-2"></i>
                Tất cả bài viết
            </div>
            <h2 class="section-title">Khám phá thêm nhiều bài viết</h2>
            <p class="section-subtitle">Cập nhật liên tục những tin tức và xu hướng mới nhất</p>
        </div>

        <!-- Filter Tabs -->
        <div class="filter-tabs" data-aos="fade-up" data-aos-delay="100">
            <button class="filter-tab active" data-filter="all">
                <i class="fas fa-th-large me-2"></i>
                Tất cả
            </button>
            <button class="filter-tab" data-filter="fashion">
                <i class="fas fa-tshirt me-2"></i>
                Thời trang
            </button>
            <button class="filter-tab" data-filter="trend">
                <i class="fas fa-chart-line me-2"></i>
                Xu hướng
            </button>
            <button class="filter-tab" data-filter="style">
                <i class="fas fa-palette me-2"></i>
                Phong cách
            </button>
        </div>

        <div class="posts-grid">
            @forelse($postsnew as $item)
            <article class="post-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <div class="post-image-container">
                    @foreach($item->images as $key => $image)
                        @if($key == 0)
                        <img src="{{ asset('uploads/post/' . $image->file_name) }}"
                             class="post-thumbnail"
                             alt="{{ $item->title_post }}"
                             loading="lazy">
                        @endif
                    @endforeach
                    <div class="post-image-overlay">
                        <div class="post-badges">
                            @if($item->created_at && $item->created_at->diffInDays(now()) <= 7)
                            <span class="post-badge new">
                                <i class="fas fa-star me-1"></i>
                                Mới
                            </span>
                            @endif
                            <span class="post-badge category">
                                <i class="fas fa-tag me-1"></i>
                                Thời trang
                            </span>
                        </div>
                        <div class="post-quick-actions">
                            <button class="quick-action-btn" title="Yêu thích">
                                <i class="far fa-heart"></i>
                            </button>
                            <button class="quick-action-btn" title="Chia sẻ">
                                <i class="fas fa-share-alt"></i>
                            </button>
                            <button class="quick-action-btn" title="Lưu">
                                <i class="far fa-bookmark"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="post-card-content">
                    <div class="post-meta-info">
                        <span class="post-date">
                            <i class="far fa-calendar-alt me-1"></i>
                            {{ $item->created_at ? $item->created_at->format('d/m/Y') : 'N/A' }}
                        </span>
                        <span class="post-read-time">
                            <i class="far fa-clock me-1"></i>
                            {{ ceil(str_word_count(strip_tags($item->content_post)) / 200) }} phút
                        </span>
                    </div>

                    <h3 class="post-card-title">
                        <a href="{{ route('post.detailpost', ['id' => $item->id_post]) }}">
                            {{ $item->title_post }}
                        </a>
                    </h3>

                    <p class="post-card-excerpt">
                        {{ Str::limit(strip_tags($item->content_post), 120, '...') }}
                    </p>

                    <div class="post-card-footer">
                        <a href="{{ route('post.detailpost', ['id' => $item->id_post]) }}" class="read-more-link">
                            <span>Đọc thêm</span>
                            <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                        <div class="post-stats">
                            <span class="stat-item">
                                <i class="far fa-eye me-1"></i>
                                {{ rand(100, 999) }}
                            </span>
                            <span class="stat-item">
                                <i class="far fa-heart me-1"></i>
                                {{ rand(10, 99) }}
                            </span>
                        </div>
                    </div>
                </div>
            </article>
            @empty
            <div class="empty-state" data-aos="fade-up">
                <div class="empty-icon">
                    <i class="far fa-newspaper"></i>
                </div>
                <h3>Chưa có bài viết nào</h3>
                <p>Hãy quay lại sau để xem những bài viết mới nhất</p>
            </div>
            @endforelse
        </div>

        @if(isset($postsnew) && $postsnew->hasPages())
        <div class="pagination-wrapper" data-aos="fade-up">
            <nav class="custom-pagination">
                <div class="pagination-info">
                    Hiển thị {{ $postsnew->firstItem() }} - {{ $postsnew->lastItem() }}
                    trong tổng số {{ $postsnew->total() }} bài viết
                </div>
                <ul class="pagination-list">
                    @if($postsnew->onFirstPage())
                        <li class="pagination-item disabled">
                            <span class="pagination-link">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        </li>
                    @else
                        <li class="pagination-item">
                            <a class="pagination-link" href="{{ $postsnew->previousPageUrl() }}">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>
                    @endif

                    @php
                        $start = max(1, $postsnew->currentPage() - 2);
                        $end = min($postsnew->lastPage(), $postsnew->currentPage() + 2);
                    @endphp

                    @if($start > 1)
                        <li class="pagination-item">
                            <a class="pagination-link" href="{{ $postsnew->url(1) }}">1</a>
                        </li>
                        @if($start > 2)
                            <li class="pagination-item disabled">
                                <span class="pagination-link">...</span>
                            </li>
                        @endif
                    @endif

                    @for($i = $start; $i <= $end; $i++)
                        <li class="pagination-item {{ $postsnew->currentPage() == $i ? 'active' : '' }}">
                            <a class="pagination-link" href="{{ $postsnew->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    @if($end < $postsnew->lastPage())
                        @if($end < $postsnew->lastPage() - 1)
                            <li class="pagination-item disabled">
                                <span class="pagination-link">...</span>
                            </li>
                        @endif
                        <li class="pagination-item">
                            <a class="pagination-link" href="{{ $postsnew->url($postsnew->lastPage()) }}">{{ $postsnew->lastPage() }}</a>
                        </li>
                    @endif

                    @if($postsnew->hasMorePages())
                        <li class="pagination-item">
                            <a class="pagination-link" href="{{ $postsnew->nextPageUrl() }}">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="pagination-item disabled">
                            <span class="pagination-link">
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
/* Modern Blog Design - Viuss Fashion Colors */
:root {
    --primary-gradient: linear-gradient(135deg, #f7b42c 0%, #fc575e 100%);
    --secondary-gradient: linear-gradient(135deg, #36d1c4 0%, #ff5e62 100%);
    --accent-gradient: linear-gradient(135deg, #ffbe3d 0%, #36d1c4 100%);
    --text-dark: #232526;
    --text-light: #666;
    --text-muted: #888;
    --bg-light: #f9f9f9;
    --bg-white: #ffffff;
    --border-light: #e8e8e8;
    --shadow-sm: 0 1px 3px rgba(35,37,38,0.12), 0 1px 2px rgba(35,37,38,0.24);
    --shadow-md: 0 4px 6px rgba(35,37,38,0.07), 0 2px 4px rgba(35,37,38,0.06);
    --shadow-lg: 0 10px 15px rgba(35,37,38,0.1), 0 4px 6px rgba(35,37,38,0.05);
    --shadow-xl: 0 20px 25px rgba(35,37,38,0.1), 0 10px 10px rgba(35,37,38,0.04);
}

/* Hero Section */
.blog-hero-section {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    overflow: hidden;
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: var(--primary-gradient);
    z-index: 1;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.3);
    z-index: 2;
}

.hero-particles {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image:
        radial-gradient(circle at 20% 80%, rgba(255,255,255,0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255,255,255,0.1) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(255,255,255,0.05) 0%, transparent 50%);
    z-index: 2;
}

.blog-hero-section .container {
    position: relative;
    z-index: 3;
}

.min-vh-75 {
    min-height: 75vh;
}

.hero-badge {
    display: inline-block;
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    color: white;
    padding: 12px 24px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 2rem;
    border: 1px solid rgba(255,255,255,0.3);
}

.hero-title {
    font-size: 4rem;
    font-weight: 800;
    color: white;
    margin-bottom: 1.5rem;
    line-height: 1.1;
}

.gradient-text {
    background: linear-gradient(135deg, #ffbe3d 0%, #36d1c4 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-subtitle {
    font-size: 1.3rem;
    color: rgba(255,255,255,0.9);
    margin-bottom: 3rem;
    line-height: 1.6;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.hero-stats {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 2rem;
    margin-top: 2rem;
}

.stat-item {
    text-align: center;
    color: white;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
}

.stat-divider {
    width: 1px;
    height: 40px;
    background: rgba(255,255,255,0.3);
}

.hero-scroll-indicator {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 3;
}

.scroll-arrow {
    width: 40px;
    height: 40px;
    border: 2px solid rgba(255,255,255,0.5);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    animation: bounce 2s infinite;
    cursor: pointer;
    transition: all 0.3s ease;
}

.scroll-arrow:hover {
    border-color: white;
    background: rgba(255,255,255,0.1);
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    60% {
        transform: translateY(-5px);
    }
}

/* Section Headers */
.section-header {
    text-align: center;
    margin-bottom: 4rem;
}

.section-badge {
    display: inline-block;
    background: var(--primary-gradient);
    color: white;
    padding: 8px 20px;
    border-radius: 25px;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 1rem;
    box-shadow: var(--shadow-md);
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
    line-height: 1.2;
}

.section-subtitle {
    font-size: 1.1rem;
    color: var(--text-light);
    max-width: 600px;
    margin: 0 auto;
}

/* Featured Posts Section */
.featured-posts-section {
    padding: 6rem 0;
    background: var(--bg-light);
}

.featured-posts-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
    margin-top: 3rem;
}

.featured-post-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow-lg);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
}

.featured-post-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-xl);
}

.featured-main {
    grid-row: span 2;
}

.post-image-wrapper {
    position: relative;
    overflow: hidden;
}

.featured-main .post-image-wrapper {
    height: 400px;
}

.featured-secondary .post-image-wrapper {
    height: 200px;
}

.post-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.featured-post-card:hover .post-image {
    transform: scale(1.05);
}

.post-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, transparent 50%, rgba(0,0,0,0.7) 100%);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 1.5rem;
}

.post-category {
    align-self: flex-start;
    background: var(--secondary-gradient);
    color: white;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
}

.post-content {
    padding: 2rem;
}

.post-meta {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
    font-size: 0.85rem;
    color: var(--text-light);
}

.post-date, .post-read-time {
    display: flex;
    align-items: center;
}

.post-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    line-height: 1.3;
}

.featured-main .post-title {
    font-size: 1.8rem;
}

.post-title a {
    color: var(--text-dark);
    text-decoration: none;
    transition: color 0.3s ease;
}

.post-title a:hover {
    color: #f7b42c;
}

.post-excerpt {
    color: var(--text-light);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.post-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.read-more-btn {
    display: inline-flex;
    align-items: center;
    color: #667eea;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.read-more-btn:hover {
    color: #fc575e;
    transform: translateX(5px);
}

.post-actions {
    display: flex;
    gap: 0.5rem;
}

.action-btn {
    width: 35px;
    height: 35px;
    border: none;
    background: var(--bg-light);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-light);
    transition: all 0.3s ease;
    cursor: pointer;
}

.action-btn:hover {
    background: #f7b42c;
    color: white;
    transform: scale(1.1);
}

/* All Posts Section */
.all-posts-section {
    padding: 6rem 0;
    background: white;
}

.filter-tabs {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-bottom: 3rem;
    flex-wrap: wrap;
}

.filter-tab {
    background: transparent;
    border: 2px solid var(--border-light);
    color: var(--text-light);
    padding: 12px 24px;
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
    cursor: pointer;
    display: flex;
    align-items: center;
}

.filter-tab:hover,
.filter-tab.active {
    background: var(--primary-gradient);
    border-color: transparent;
    color: white;
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.posts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
}

.post-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow-md);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid var(--border-light);
}

.post-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-xl);
    border-color: rgba(102, 126, 234, 0.2);
}

.post-image-container {
    position: relative;
    height: 220px;
    overflow: hidden;
}

.post-thumbnail {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.post-card:hover .post-thumbnail {
    transform: scale(1.05);
}

.post-image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(0,0,0,0.4) 0%, transparent 50%, rgba(0,0,0,0.6) 100%);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 1rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.post-card:hover .post-image-overlay {
    opacity: 1;
}

.post-badges {
    display: flex;
    gap: 0.5rem;
    align-self: flex-start;
}

.post-badge {
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    color: white;
}

.post-badge.new {
    background: var(--secondary-gradient);
}

.post-badge.category {
    background: var(--accent-gradient);
}

.post-quick-actions {
    display: flex;
    gap: 0.5rem;
    align-self: flex-end;
}

.quick-action-btn {
    width: 32px;
    height: 32px;
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    border: none;
    border-radius: 50%;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    cursor: pointer;
}

.quick-action-btn:hover {
    background: rgba(255,255,255,0.3);
    transform: scale(1.1);
}

.post-card-content {
    padding: 1.5rem;
}

.post-meta-info {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
    font-size: 0.8rem;
    color: var(--text-light);
}

.post-card-title {
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 1rem;
    line-height: 1.3;
}

.post-card-title a {
    color: var(--text-dark);
    text-decoration: none;
    transition: color 0.3s ease;
}

.post-card-title a:hover {
    color: #f7b42c;
}

.post-card-excerpt {
    color: var(--text-light);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.post-card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.read-more-link {
    display: inline-flex;
    align-items: center;
    color: #667eea;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.read-more-link:hover {
    color: #fc575e;
    transform: translateX(5px);
}

.post-stats {
    display: flex;
    gap: 1rem;
    font-size: 0.8rem;
    color: var(--text-light);
}

.stat-item {
    display: flex;
    align-items: center;
}

.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 4rem 2rem;
}

.empty-icon {
    font-size: 4rem;
    color: var(--text-light);
    margin-bottom: 1rem;
}

.empty-state h3 {
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: var(--text-light);
}

/* Pagination */
.pagination-wrapper {
    margin-top: 4rem;
    text-align: center;
}

.pagination-info {
    color: var(--text-light);
    margin-bottom: 1rem;
    font-size: 0.9rem;
}

.custom-pagination {
    display: inline-block;
}

.pagination-list {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 0.5rem;
    align-items: center;
}

.pagination-item {
    margin: 0;
}

.pagination-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border: 2px solid var(--border-light);
    border-radius: 10px;
    color: var(--text-light);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.pagination-item:hover .pagination-link:not(.disabled) {
    border-color: #f7b42c;
    color: #f7b42c;
    transform: translateY(-2px);
}

.pagination-item.active .pagination-link {
    background: var(--primary-gradient);
    border-color: transparent;
    color: white;
    box-shadow: var(--shadow-md);
}

.pagination-item.disabled .pagination-link {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .featured-posts-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .featured-main {
        grid-row: span 1;
    }

    .posts-grid {
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }
}

@media (max-width: 768px) {
    .blog-hero-section {
        min-height: 80vh;
        padding: 2rem 0;
    }

    .hero-title {
        font-size: 2.5rem;
    }

    .hero-subtitle {
        font-size: 1.1rem;
    }

    .hero-stats {
        flex-direction: column;
        gap: 1rem;
    }

    .stat-divider {
        width: 40px;
        height: 1px;
    }

    .section-title {
        font-size: 2rem;
    }

    .featured-posts-section,
    .all-posts-section {
        padding: 4rem 0;
    }

    .section-header {
        margin-bottom: 3rem;
    }

    .filter-tabs {
        gap: 0.5rem;
    }

    .filter-tab {
        padding: 10px 16px;
        font-size: 0.9rem;
    }

    .posts-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .post-card-content {
        padding: 1.25rem;
    }

    .pagination-list {
        flex-wrap: wrap;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 2rem;
    }

    .section-title {
        font-size: 1.75rem;
    }

    .post-image-container {
        height: 180px;
    }

    .post-card-content {
        padding: 1rem;
    }

    .post-card-title {
        font-size: 1.1rem;
    }

    .filter-tabs {
        flex-direction: column;
        align-items: center;
    }

    .filter-tab {
        width: 100%;
        max-width: 200px;
        justify-content: center;
    }
}
</style>

<!-- Enhanced JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS (Animate On Scroll)
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 1000,
            easing: 'ease-out-cubic',
            once: true,
            offset: 100
        });
    }

    // Filter functionality
    const filterTabs = document.querySelectorAll('.filter-tab');
    const postCards = document.querySelectorAll('.post-card');

    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            filterTabs.forEach(t => t.classList.remove('active'));
            // Add active class to clicked tab
            this.classList.add('active');

            const filter = this.getAttribute('data-filter');

            // Filter posts (for demo purposes, all posts are shown)
            postCards.forEach(card => {
                card.style.display = 'block';
                card.style.animation = 'fadeInUp 0.5s ease forwards';
            });
        });
    });

    // Smooth scroll for hero scroll indicator
    const scrollIndicator = document.querySelector('.hero-scroll-indicator');
    if (scrollIndicator) {
        scrollIndicator.addEventListener('click', function() {
            const featuredSection = document.querySelector('.featured-posts-section');
            if (featuredSection) {
                featuredSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    }

    // Like button functionality
    const actionBtns = document.querySelectorAll('.action-btn, .quick-action-btn');
    actionBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();

            if (this.querySelector('.fa-heart')) {
                const icon = this.querySelector('.fa-heart');
                if (icon.classList.contains('far')) {
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    this.style.color = '#e53e3e';
                } else {
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    this.style.color = '';
                }
            }

            // Add ripple effect
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });

    // Parallax effect for hero section
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const heroParticles = document.querySelector('.hero-particles');

        if (heroParticles) {
            heroParticles.style.transform = `translateY(${scrolled * 0.5}px)`;
        }
    });

    // Loading animation for images
    const images = document.querySelectorAll('img[loading="lazy"]');
    images.forEach(img => {
        img.addEventListener('load', function() {
            this.style.opacity = '0';
            this.style.transition = 'opacity 0.3s ease';
            setTimeout(() => {
                this.style.opacity = '1';
            }, 100);
        });
    });
});

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
        }
    }

    .post-card:hover .post-image {
        animation: pulse 0.6s ease-in-out;
    }
`;
document.head.appendChild(style);
</script>
@endsection