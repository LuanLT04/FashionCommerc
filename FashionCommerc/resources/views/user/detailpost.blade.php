@extends('user.dashboard_user')

@section('content')
<!-- Modern Blog Detail Hero -->
<section class="blog-detail-hero">
    <div class="hero-background">
        @if(!empty($file_name_image_post[0] ?? ''))
        <img src="{{ asset('uploads/post/' . $file_name_image_post[0]) }}"
             alt="{{ $post->title_post }}"
             class="hero-bg-image">
        @endif
        <div class="hero-overlay"></div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Breadcrumb -->
                <nav class="blog-breadcrumb" data-aos="fade-up">
                    <ol class="breadcrumb-list">
                        <li><a href="{{ url('/') }}">Trang chủ</a></li>
                        <li><a href="{{ route('post.indexListPostUser') }}">Tin tức</a></li>
                        <li>{{ Str::limit($post->title_post, 30) }}</li>
                    </ol>
                </nav>

                <!-- Post Header -->
                <div class="post-header" data-aos="fade-up" data-aos-delay="200">
                    <div class="post-category-badge">
                        <i class="fas fa-tag me-2"></i>
                        Thời trang
                    </div>

                    <h1 class="post-hero-title">{{ $post->title_post }}</h1>

                    <div class="post-hero-meta">
                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="far fa-calendar-alt"></i>
                            </div>
                            <div class="meta-content">
                                <span class="meta-label">Ngày đăng</span>
                                <span class="meta-value">{{ $post->created_at ? $post->created_at->format('d/m/Y') : 'N/A' }}</span>
                            </div>
                        </div>

                        <div class="meta-divider"></div>

                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="far fa-clock"></i>
                            </div>
                            <div class="meta-content">
                                <span class="meta-label">Thời gian đọc</span>
                                <span class="meta-value">{{ ceil(str_word_count(strip_tags($post->content_post)) / 200) }} phút</span>
                            </div>
                        </div>

                        <div class="meta-divider"></div>

                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="far fa-eye"></i>
                            </div>
                            <div class="meta-content">
                                <span class="meta-label">Lượt xem</span>
                                <span class="meta-value">{{ rand(500, 2000) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="post-hero-actions">
                        <button class="hero-action-btn" title="Yêu thích">
                            <i class="far fa-heart"></i>
                            <span>{{ rand(10, 99) }}</span>
                        </button>
                        <button class="hero-action-btn" title="Chia sẻ">
                            <i class="fas fa-share-alt"></i>
                            <span>Chia sẻ</span>
                        </button>
                        <button class="hero-action-btn" title="Lưu">
                            <i class="far fa-bookmark"></i>
                            <span>Lưu</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="scroll-indicator">
        <div class="scroll-arrow">
            <i class="fas fa-chevron-down"></i>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="blog-content-section">
    <div class="container">
        <div class="row g-5">
            <!-- Article Content -->
            <div class="col-lg-8">
                <article class="blog-article" data-aos="fade-up">
                    <!-- Article Body -->
                    <div class="article-content">
                        {!! nl2br(e($post->content_post)) !!}
                    </div>

                    <!-- Additional Images Gallery -->
                    @if(count($file_name_image_post) > 1)
                    <div class="article-gallery">
                        <h3 class="gallery-title">Hình ảnh liên quan</h3>
                        <div class="gallery-grid">
                            @foreach($file_name_image_post as $index => $image)
                                @if($index > 0)
                                <div class="gallery-item" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                                    <img src="{{ asset('uploads/post/' . $image) }}"
                                         alt="Hình ảnh {{ $index }}"
                                         class="gallery-image"
                                         onclick="openImageModal(this.src)">
                                    <div class="gallery-overlay">
                                        <i class="fas fa-expand-alt"></i>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Article Footer -->
                    <div class="article-footer">
                        <!-- Tags -->
                        <div class="article-tags">
                            <h4 class="tags-title">Thẻ bài viết</h4>
                            <div class="tags-list">
                                <span class="article-tag">
                                    <i class="fas fa-tag me-1"></i>
                                    Thời trang
                                </span>
                                <span class="article-tag">
                                    <i class="fas fa-tag me-1"></i>
                                    Xu hướng
                                </span>
                                <span class="article-tag">
                                    <i class="fas fa-tag me-1"></i>
                                    Style
                                </span>
                                <span class="article-tag">
                                    <i class="fas fa-tag me-1"></i>
                                    Fashion
                                </span>
                            </div>
                        </div>

                        <!-- Social Share -->
                        <div class="social-share">
                            <h4 class="share-title">Chia sẻ bài viết</h4>
                            <div class="share-buttons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                   target="_blank"
                                   class="share-btn facebook">
                                    <i class="fab fa-facebook-f"></i>
                                    <span>Facebook</span>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title_post) }}"
                                   target="_blank"
                                   class="share-btn twitter">
                                    <i class="fab fa-twitter"></i>
                                    <span>Twitter</span>
                                </a>
                                <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}&media={{ urlencode(asset('uploads/post/' . ($file_name_image_post[0] ?? ''))) }}&description={{ urlencode($post->title_post) }}"
                                   target="_blank"
                                   class="share-btn pinterest">
                                    <i class="fab fa-pinterest-p"></i>
                                    <span>Pinterest</span>
                                </a>
                                <button class="share-btn copy-link" onclick="copyToClipboard('{{ url()->current() }}')">
                                    <i class="fas fa-link"></i>
                                    <span>Copy Link</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Modern Sidebar -->
            <div class="col-lg-4">
                <div class="blog-sidebar" data-aos="fade-left" data-aos-delay="300">
                    <!-- Recent Posts -->
                    <div class="sidebar-widget">
                        <div class="widget-header">
                            <h3 class="widget-title">
                                <i class="fas fa-clock me-2"></i>
                                Bài viết gần đây
                            </h3>
                        </div>
                        <div class="widget-content">
                            @php
                                $recentPosts = \App\Models\Posts::orderBy('created_at', 'desc')
                                    ->where('id_post', '!=', $post->id_post)
                                    ->take(5)
                                    ->get();
                            @endphp

                            @forelse($recentPosts as $recentPost)
                            <div class="recent-post-item">
                                <div class="recent-post-image">
                                    @php
                                        $recentImage = DB::table('postimages')
                                            ->join('images_posts', 'postimages.id_image_post', '=', 'images_posts.id_image_post')
                                            ->where('postimages.id_post', $recentPost->id_post)
                                            ->first();
                                    @endphp
                                    @if($recentImage ?? false)
                                    <img src="{{ asset('uploads/post/' . $recentImage->file_name) }}"
                                         alt="{{ $recentPost->title_post }}">
                                    @else
                                    <div class="image-placeholder">
                                        <i class="fas fa-image"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="recent-post-content">
                                    <h4 class="recent-post-title">
                                        <a href="{{ route('post.detailpost', ['id' => $recentPost->id_post]) }}">
                                            {{ Str::limit($recentPost->title_post, 50) }}
                                        </a>
                                    </h4>
                                    <div class="recent-post-meta">
                                        <span class="post-date">
                                            <i class="far fa-calendar-alt me-1"></i>
                                            {{ $recentPost->created_at ? $recentPost->created_at->format('d/m/Y') : 'N/A' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="empty-widget">
                                <i class="fas fa-newspaper"></i>
                                <p>Không có bài viết nào khác</p>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Popular Tags -->
                    <div class="sidebar-widget">
                        <div class="widget-header">
                            <h3 class="widget-title">
                                <i class="fas fa-tags me-2"></i>
                                Tags phổ biến
                            </h3>
                        </div>
                        <div class="widget-content">
                            <div class="popular-tags">
                                <a href="#" class="popular-tag">
                                    <i class="fas fa-tag me-1"></i>
                                    Thời trang
                                    <span class="tag-count">24</span>
                                </a>
                                <a href="#" class="popular-tag">
                                    <i class="fas fa-tag me-1"></i>
                                    Xu hướng
                                    <span class="tag-count">18</span>
                                </a>
                                <a href="#" class="popular-tag">
                                    <i class="fas fa-tag me-1"></i>
                                    Style
                                    <span class="tag-count">15</span>
                                </a>
                                <a href="#" class="popular-tag">
                                    <i class="fas fa-tag me-1"></i>
                                    Fashion
                                    <span class="tag-count">12</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Newsletter -->
                    <div class="sidebar-widget newsletter-widget">
                        <div class="widget-header">
                            <h3 class="widget-title">
                                <i class="fas fa-envelope me-2"></i>
                                Đăng ký nhận tin
                            </h3>
                        </div>
                        <div class="widget-content">
                            <p class="newsletter-desc">
                                Nhận thông báo về những bài viết mới nhất và xu hướng thời trang
                            </p>
                            <form class="newsletter-form">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email của bạn...">
                                </div>
                                <button type="submit" class="btn-subscribe">
                                    <i class="fas fa-paper-plane me-2"></i>
                                    Đăng ký
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Image Modal -->
<div id="imageModal" class="image-modal" onclick="closeImageModal()">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <img id="modalImage" src="" alt="">
    </div>
</div>

<style>
/* Modern Blog Detail Design - Viuss Fashion Colors */
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
.blog-detail-hero {
    position: relative;
    min-height: 70vh;
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
    z-index: 1;
}

.hero-bg-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(247, 180, 44, 0.85) 0%, rgba(252, 87, 94, 0.85) 100%);
    z-index: 2;
}

.blog-detail-hero .container {
    position: relative;
    z-index: 3;
}

/* Breadcrumb */
.blog-breadcrumb {
    margin-bottom: 2rem;
}

.breadcrumb-list {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 1rem;
    align-items: center;
}

.breadcrumb-list li {
    color: rgba(255,255,255,0.8);
    font-size: 0.9rem;
}

.breadcrumb-list li:not(:last-child)::after {
    content: '›';
    margin-left: 1rem;
    color: rgba(255,255,255,0.6);
}

.breadcrumb-list a {
    color: white;
    text-decoration: none;
    transition: color 0.3s ease;
}

.breadcrumb-list a:hover {
    color: rgba(255,255,255,0.8);
}

/* Post Header */
.post-header {
    text-align: center;
    color: white;
}

.post-category-badge {
    display: inline-block;
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    border: 1px solid rgba(255,255,255,0.3);
}

.post-hero-title {
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 2rem;
    line-height: 1.2;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}

.post-hero-meta {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 2rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.meta-icon {
    width: 40px;
    height: 40px;
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid rgba(255,255,255,0.3);
}

.meta-content {
    display: flex;
    flex-direction: column;
}

.meta-label {
    font-size: 0.8rem;
    opacity: 0.8;
    margin-bottom: 2px;
}

.meta-value {
    font-weight: 600;
    font-size: 0.9rem;
}

.meta-divider {
    width: 1px;
    height: 30px;
    background: rgba(255,255,255,0.3);
}

.post-hero-actions {
    display: flex;
    justify-content: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.hero-action-btn {
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.3);
    color: white;
    padding: 12px 20px;
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.hero-action-btn:hover {
    background: rgba(255,255,255,0.3);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.scroll-indicator {
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

/* Content Section */
.blog-content-section {
    padding: 6rem 0;
    background: var(--bg-light);
}

.blog-article {
    background: white;
    border-radius: 20px;
    padding: 3rem;
    box-shadow: var(--shadow-lg);
    margin-bottom: 2rem;
}

.article-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: var(--text-dark);
}

.article-content p {
    margin-bottom: 1.5rem;
}

.article-content h1,
.article-content h2,
.article-content h3,
.article-content h4,
.article-content h5,
.article-content h6 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: var(--text-dark);
    font-weight: 700;
}

.article-content h2 {
    font-size: 2rem;
    border-bottom: 2px solid var(--border-light);
    padding-bottom: 0.5rem;
}

.article-content h3 {
    font-size: 1.5rem;
}

/* Gallery */
.article-gallery {
    margin: 3rem 0;
}

.gallery-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1.5rem;
    text-align: center;
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
}

.gallery-item {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.3s ease;
}

.gallery-item:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.gallery-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-item:hover .gallery-image {
    transform: scale(1.05);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-overlay i {
    color: white;
    font-size: 2rem;
}

/* Article Footer */
.article-footer {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 2px solid var(--border-light);
}

.article-tags {
    margin-bottom: 2rem;
}

.tags-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
}

.tags-list {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.article-tag {
    background: var(--primary-gradient);
    color: white;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.article-tag:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    color: white;
}

.social-share {
    margin-top: 2rem;
}

.share-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
}

.share-buttons {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.share-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 12px 20px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.share-btn.facebook {
    background: #1877f2;
    color: white;
}

.share-btn.twitter {
    background: #1da1f2;
    color: white;
}

.share-btn.pinterest {
    background: #bd081c;
    color: white;
}

.share-btn.copy-link {
    background: var(--text-light);
    color: white;
}

.share-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    color: white;
}

/* Sidebar */
.blog-sidebar {
    position: sticky;
    top: 2rem;
}

.sidebar-widget {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-light);
}

.widget-header {
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--border-light);
}

.widget-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--text-dark);
    margin: 0;
    display: flex;
    align-items: center;
}

.widget-title i {
    color: #f7b42c;
}

/* Recent Posts */
.recent-post-item {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid var(--border-light);
}

.recent-post-item:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.recent-post-image {
    flex-shrink: 0;
    width: 80px;
    height: 60px;
    border-radius: 10px;
    overflow: hidden;
}

.recent-post-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.recent-post-item:hover .recent-post-image img {
    transform: scale(1.1);
}

.image-placeholder {
    width: 100%;
    height: 100%;
    background: var(--bg-light);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-light);
}

.recent-post-content {
    flex: 1;
}

.recent-post-title {
    font-size: 0.95rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    line-height: 1.3;
}

.recent-post-title a {
    color: var(--text-dark);
    text-decoration: none;
    transition: color 0.3s ease;
}

.recent-post-title a:hover {
    color: #f7b42c;
}

.recent-post-meta {
    font-size: 0.8rem;
    color: var(--text-light);
}

.empty-widget {
    text-align: center;
    padding: 2rem 0;
    color: var(--text-light);
}

.empty-widget i {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

/* Popular Tags */
.popular-tags {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.popular-tag {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 15px;
    background: var(--bg-light);
    border-radius: 10px;
    text-decoration: none;
    color: var(--text-dark);
    font-weight: 500;
    transition: all 0.3s ease;
}

.popular-tag:hover {
    background: var(--primary-gradient);
    color: white;
    transform: translateX(5px);
}

.tag-count {
    background: white;
    color: var(--text-dark);
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
}

.popular-tag:hover .tag-count {
    background: rgba(255,255,255,0.2);
    color: white;
}

/* Newsletter Widget */
.newsletter-widget {
    background: var(--primary-gradient);
    color: white;
}

.newsletter-widget .widget-title {
    color: white;
    border-bottom-color: rgba(255,255,255,0.3);
}

.newsletter-widget .widget-title i {
    color: white;
}

.newsletter-desc {
    margin-bottom: 1.5rem;
    opacity: 0.9;
}

.newsletter-form .form-control {
    background: rgba(255,255,255,0.2);
    border: 1px solid rgba(255,255,255,0.3);
    color: white;
    border-radius: 10px;
    padding: 12px 15px;
    margin-bottom: 1rem;
}

.newsletter-form .form-control::placeholder {
    color: rgba(255,255,255,0.7);
}

.newsletter-form .form-control:focus {
    background: rgba(255,255,255,0.3);
    border-color: rgba(255,255,255,0.5);
    box-shadow: none;
    color: white;
}

.btn-subscribe {
    width: 100%;
    background: white;
    color: #f7b42c;
    border: none;
    padding: 12px 20px;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-subscribe:hover {
    background: rgba(255,255,255,0.9);
    transform: translateY(-2px);
}

/* Image Modal */
.image-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.9);
    backdrop-filter: blur(5px);
}

.modal-content {
    position: relative;
    margin: auto;
    padding: 20px;
    width: 90%;
    max-width: 800px;
    top: 50%;
    transform: translateY(-50%);
}

.modal-close {
    position: absolute;
    top: 10px;
    right: 25px;
    color: white;
    font-size: 35px;
    font-weight: bold;
    cursor: pointer;
    z-index: 10000;
}

.modal-close:hover {
    opacity: 0.7;
}

#modalImage {
    width: 100%;
    height: auto;
    border-radius: 10px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .blog-detail-hero {
        min-height: 60vh;
    }

    .post-hero-title {
        font-size: 2rem;
    }

    .post-hero-meta {
        flex-direction: column;
        gap: 1rem;
    }

    .meta-divider {
        width: 40px;
        height: 1px;
    }

    .post-hero-actions {
        flex-direction: column;
        align-items: center;
    }

    .hero-action-btn {
        width: 100%;
        max-width: 200px;
        justify-content: center;
    }

    .blog-content-section {
        padding: 4rem 0;
    }

    .blog-article {
        padding: 2rem 1.5rem;
    }

    .article-content {
        font-size: 1rem;
    }

    .gallery-grid {
        grid-template-columns: 1fr;
    }

    .share-buttons {
        flex-direction: column;
    }

    .share-btn {
        justify-content: center;
    }

    .blog-sidebar {
        position: static;
        margin-top: 3rem;
    }

    .sidebar-widget {
        padding: 1.5rem;
    }

    .recent-post-item {
        flex-direction: column;
        text-align: center;
    }

    .recent-post-image {
        width: 100%;
        height: 150px;
        align-self: center;
    }
}

@media (max-width: 480px) {
    .post-hero-title {
        font-size: 1.5rem;
    }

    .blog-article {
        padding: 1.5rem 1rem;
    }

    .post-category-badge {
        padding: 6px 12px;
        font-size: 0.8rem;
    }

    .meta-item {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }

    .meta-icon {
        width: 35px;
        height: 35px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 1000,
            easing: 'ease-out-cubic',
            once: true,
            offset: 100
        });
    }

    // Smooth scroll for scroll indicator
    const scrollIndicator = document.querySelector('.scroll-indicator');
    if (scrollIndicator) {
        scrollIndicator.addEventListener('click', function() {
            const contentSection = document.querySelector('.blog-content-section');
            if (contentSection) {
                contentSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    }

    // Like button functionality
    const actionBtns = document.querySelectorAll('.hero-action-btn');
    actionBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();

            if (this.querySelector('.fa-heart')) {
                const icon = this.querySelector('.fa-heart');
                if (icon.classList.contains('far')) {
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    this.style.background = 'rgba(255,255,255,0.3)';
                } else {
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    this.style.background = '';
                }
            }

            // Add ripple effect
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });

    // Newsletter form
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            if (email) {
                alert('Cảm ơn bạn đã đăng ký! Chúng tôi sẽ gửi tin tức mới nhất đến email của bạn.');
                this.reset();
            }
        });
    }
});

// Image modal functions
function openImageModal(src) {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    modal.style.display = 'block';
    modalImg.src = src;
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.style.display = 'none';
}

// Copy to clipboard function
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Link đã được sao chép!');
    }, function(err) {
        console.error('Không thể sao chép: ', err);
    });
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('imageModal');
    if (event.target == modal) {
        closeImageModal();
    }
}
</script>
@endsection