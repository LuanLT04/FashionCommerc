@extends('user.dashboard_user')

@section('title', 'Giới thiệu về Viuss Fashion Store - Thương hiệu thời trang hàng đầu Việt Nam 2025')
@section('meta')
    <meta name="description" content="Viuss Fashion Store - Thương hiệu thời trang hàng đầu Việt Nam với hơn 50,000 khách hàng tin tưởng. Sản phẩm chính hãng 100%, xu hướng mới nhất 2025, giao hàng 24h, đổi trả 30 ngày. Khám phá bộ sưu tập thời trang nam nữ đa dạng với giá tốt nhất.">
    <meta name="keywords" content="viuss fashion store, thời trang việt nam, shop thời trang online, quần áo nam nữ, áo thun, váy đầm, phụ kiện thời trang, giày dép, túi xách, thời trang công sở, thời trang casual, xu hướng 2025, fashion trend, mua sắm online">
    <meta name="author" content="Viuss Fashion Store">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="googlebot" content="index, follow">
    <meta name="bingbot" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Giới thiệu về Viuss Fashion Store - Thương hiệu thời trang hàng đầu Việt Nam">
    <meta property="og:description" content="Khám phá câu chuyện thương hiệu, sứ mệnh và giá trị cốt lõi của Viuss Fashion Store. Hơn 50,000 khách hàng tin tưởng, 10,000+ sản phẩm đa dạng, giao hàng 99% đúng hẹn.">
    <meta property="og:image" content="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=1200&q=80">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Viuss Fashion Store">
    <meta property="og:locale" content="vi_VN">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="Giới thiệu về Viuss Fashion Store - Thương hiệu thời trang hàng đầu">
    <meta name="twitter:description" content="Thương hiệu thời trang hàng đầu Việt Nam với sản phẩm chính hãng 100%, xu hướng mới nhất, dịch vụ tận tâm">
    <meta name="twitter:image" content="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=1200&q=80">

    <!-- Additional SEO -->
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="theme-color" content="#667eea">
    <meta name="msapplication-TileColor" content="#667eea">

    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Viuss Fashion Store",
        "alternateName": "Viuss Fashion",
        "url": "{{ url('/') }}",
        "logo": "{{ url('/') }}/img/logo.png",
        "description": "Thương hiệu thời trang hàng đầu Việt Nam với sản phẩm chính hãng, xu hướng mới nhất, dịch vụ tận tâm",
        "foundingDate": "2020",
        "founders": [
            {
                "@type": "Person",
                "name": "Viuss Fashion Team"
            }
        ],
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "123 Nguyễn Văn Linh",
            "addressLocality": "TP. Hồ Chí Minh",
            "addressCountry": "VN"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+84-123-456-789",
            "contactType": "customer service",
            "availableLanguage": "Vietnamese"
        },
        "sameAs": [
            "https://facebook.com/viussfashion",
            "https://instagram.com/viussfashion",
            "https://twitter.com/viussfashion"
        ]
    }
    </script>
@endsection

@section('content')
<!-- Hero Section - Ultra Modern Design -->
<section class="hero-section position-relative overflow-hidden">
    <!-- Background with Parallax -->
    <div class="hero-background">
        <div class="hero-gradient-overlay"></div>
        <div class="hero-pattern"></div>
        <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=1920&q=80"
             alt="Viuss Fashion Store - Thương hiệu thời trang hàng đầu Việt Nam"
             class="hero-bg-image"
             loading="eager">
    </div>

    <!-- Hero Content -->
    <div class="container hero-content position-relative">
        <div class="row align-items-center min-vh-100 py-5">
            <div class="col-lg-6">
                <div class="hero-text-wrapper" data-aos="fade-right" data-aos-duration="1200">
                    <!-- Hero Badge -->
                    <div class="hero-badge-container mb-4">
                        <span class="hero-badge">
                            <i class="fas fa-crown me-2"></i>
                            <span>Thương hiệu #1 Việt Nam</span>
                            <div class="badge-glow"></div>
                        </span>
                        <div class="hero-stats-mini">
                            <span class="stat-item">
                                <i class="fas fa-users"></i>
                                50K+ khách hàng
                            </span>
                            <span class="stat-item">
                                <i class="fas fa-star"></i>
                                4.8/5 đánh giá
                            </span>
                        </div>
                    </div>

                    <!-- Hero Title -->
                    <h1 class="hero-title mb-4">
                        <span class="title-main">Viuss Fashion Store</span>
                        <span class="title-sub">Định nghĩa phong cách của bạn</span>
                        <div class="title-decoration"></div>
                    </h1>

                    <!-- Hero Description -->
                    <p class="hero-description mb-5">
                        Khám phá bộ sưu tập thời trang đa dạng với <strong>hàng nghìn sản phẩm chính hãng 100%</strong>,
                        xu hướng mới nhất từ các thương hiệu uy tín quốc tế. Trải nghiệm mua sắm đẳng cấp
                        với dịch vụ tận tâm và ưu đãi hấp dẫn.
                    </p>

                    <!-- Hero Actions -->
                    <div class="hero-actions">
                        <a href="/" class="btn btn-primary btn-lg hero-btn-primary">
                            <span class="btn-content">
                                <i class="fas fa-shopping-bag me-2"></i>
                                Khám phá ngay
                            </span>
                            <div class="btn-glow"></div>
                        </a>
                        <a href="#about-story" class="btn btn-outline-light btn-lg hero-btn-secondary">
                            <span class="btn-content">
                                <i class="fas fa-play me-2"></i>
                                Câu chuyện của chúng tôi
                            </span>
                        </a>
                    </div>

                    <!-- Trust Indicators -->
                    <div class="hero-trust-indicators mt-5">
                        <div class="trust-item">
                            <i class="fas fa-shield-check"></i>
                            <span>Sản phẩm chính hãng 100%</span>
                        </div>
                        <div class="trust-item">
                            <i class="fas fa-shipping-fast"></i>
                            <span>Giao hàng 24h</span>
                        </div>
                        <div class="trust-item">
                            <i class="fas fa-undo-alt"></i>
                            <span>Đổi trả 30 ngày</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="hero-visual-wrapper" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="300">
                    <!-- 3D Card Stack -->
                    <div class="hero-3d-stack">
                        <div class="hero-3d-card card-1" data-tilt>
                            <div class="card-image">
                                <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&w=500&q=80"
                                     alt="Thời trang nữ cao cấp" loading="lazy">
                                <div class="card-overlay">
                                    <div class="card-badge">Trending</div>
                                </div>
                            </div>
                            <div class="card-content">
                                <h4>Thời trang nữ</h4>
                                <p>Xu hướng mới nhất 2025</p>
                                <div class="card-stats">
                                    <span><i class="fas fa-heart"></i> 2.5K</span>
                                    <span><i class="fas fa-eye"></i> 15K</span>
                                </div>
                            </div>
                        </div>

                        <div class="hero-3d-card card-2" data-tilt>
                            <div class="card-image">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=500&q=80"
                                     alt="Thời trang nam phong cách" loading="lazy">
                                <div class="card-overlay">
                                    <div class="card-badge">Hot</div>
                                </div>
                            </div>
                            <div class="card-content">
                                <h4>Thời trang nam</h4>
                                <p>Phong cách hiện đại</p>
                                <div class="card-stats">
                                    <span><i class="fas fa-heart"></i> 1.8K</span>
                                    <span><i class="fas fa-eye"></i> 12K</span>
                                </div>
                            </div>
                        </div>

                        <div class="hero-3d-card card-3" data-tilt>
                            <div class="card-image">
                                <img src="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?auto=format&fit=crop&w=500&q=80"
                                     alt="Phụ kiện thời trang cao cấp" loading="lazy">
                                <div class="card-overlay">
                                    <div class="card-badge">New</div>
                                </div>
                            </div>
                            <div class="card-content">
                                <h4>Phụ kiện</h4>
                                <p>Hoàn thiện phong cách</p>
                                <div class="card-stats">
                                    <span><i class="fas fa-heart"></i> 3.2K</span>
                                    <span><i class="fas fa-eye"></i> 18K</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Elements -->
                    <div class="hero-floating-elements">
                        <div class="floating-element element-1">
                            <i class="fas fa-heart"></i>
                        </div>
                        <div class="floating-element element-2">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="floating-element element-3">
                            <i class="fas fa-gem"></i>
                        </div>
                        <div class="floating-element element-4">
                            <i class="fas fa-crown"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="scroll-indicator">
        <div class="scroll-text">Cuộn xuống để khám phá</div>
        <div class="scroll-arrow">
            <i class="fas fa-chevron-down"></i>
        </div>
    </div>
</section>

<!-- Story Section - Redesigned -->
<section id="about-story" class="story-section py-5">
    <div class="container">
        <!-- Section Header -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <span class="story-badge-header">
                    <i class="fas fa-heart me-2"></i>
                    Câu chuyện của chúng tôi
                </span>
                <h2 class="story-main-title">
                    Hành trình xây dựng thương hiệu
                    <span class="highlight-text">thời trang hàng đầu</span>
                </h2>
                <p class="story-intro">
                    Từ một ý tưởng nhỏ đến thương hiệu được hàng nghìn khách hàng tin tưởng
                </p>
            </div>
        </div>

        <!-- Story Timeline -->
        <div class="story-timeline">
            <div class="row g-4">
                <!-- Timeline Item 1 -->
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="timeline-card">
                        <div class="timeline-image">
                            <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=500&q=80"
                                 alt="Khởi đầu Viuss Fashion Store" loading="lazy">
                            <div class="timeline-year">2020</div>
                        </div>
                        <div class="timeline-content">
                            <h4>Khởi đầu với đam mê</h4>
                            <p>Viuss Fashion Store ra đời từ niềm đam mê với thời trang và mong muốn mang đến cho khách hàng Việt Nam những sản phẩm chất lượng cao.</p>
                            <div class="timeline-stats">
                                <span><i class="fas fa-store"></i> 1 cửa hàng</span>
                                <span><i class="fas fa-users"></i> 100+ khách hàng</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Timeline Item 2 -->
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="timeline-card">
                        <div class="timeline-image">
                            <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=500&q=80"
                                 alt="Phát triển Viuss Fashion Store" loading="lazy">
                            <div class="timeline-year">2022</div>
                        </div>
                        <div class="timeline-content">
                            <h4>Mở rộng quy mô</h4>
                            <p>Chúng tôi mở rộng sang thương mại điện tử, đa dạng hóa sản phẩm và xây dựng đội ngũ chuyên nghiệp để phục vụ khách hàng tốt hơn.</p>
                            <div class="timeline-stats">
                                <span><i class="fas fa-globe"></i> Online Store</span>
                                <span><i class="fas fa-users"></i> 10K+ khách hàng</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Timeline Item 3 -->
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="timeline-card">
                        <div class="timeline-image">
                            <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?auto=format&fit=crop&w=500&q=80"
                                 alt="Thành công Viuss Fashion Store" loading="lazy">
                            <div class="timeline-year">2024</div>
                        </div>
                        <div class="timeline-content">
                            <h4>Thương hiệu uy tín</h4>
                            <p>Hôm nay, Viuss Fashion Store tự hào là thương hiệu thời trang được yêu thích với hàng nghìn sản phẩm đa dạng và dịch vụ tận tâm.</p>
                            <div class="timeline-stats">
                                <span><i class="fas fa-award"></i> Top Brand</span>
                                <span><i class="fas fa-users"></i> 50K+ khách hàng</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Story Values -->
        <div class="row mt-5 g-4">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="value-card-modern">
                    <div class="value-icon-modern">
                        <i class="fas fa-gem"></i>
                    </div>
                    <h4>Chất lượng đảm bảo</h4>
                    <p>100% sản phẩm chính hãng, được kiểm tra kỹ lưỡng trước khi đến tay khách hàng. Cam kết chất lượng là ưu tiên hàng đầu.</p>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="value-card-modern">
                    <div class="value-icon-modern">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h4>Khách hàng là trung tâm</h4>
                    <p>Đội ngũ tư vấn chuyên nghiệp, hỗ trợ 24/7 để mang đến trải nghiệm mua sắm tuyệt vời nhất cho khách hàng.</p>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="value-card-modern">
                    <div class="value-icon-modern">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h4>Đổi mới không ngừng</h4>
                    <p>Cập nhật xu hướng mới nhất, sáng tạo trong từng bộ sưu tập và không ngừng cải tiến dịch vụ để phục vụ khách hàng.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="stats-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-6 col-md-3">
                <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number" data-count="50000">0</div>
                    <div class="stat-label">Khách hàng tin tưởng</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-icon">
                        <i class="fas fa-tshirt"></i>
                    </div>
                    <div class="stat-number" data-count="10000">0</div>
                    <div class="stat-label">Sản phẩm đa dạng</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <div class="stat-number" data-count="99">0</div>
                    <div class="stat-label">% Giao hàng đúng hẹn</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-number" data-count="4.8">0</div>
                    <div class="stat-label">Đánh giá trung bình</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="values-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-label" data-aos="fade-up">Giá trị cốt lõi</span>
            <h2 class="section-title" data-aos="fade-up" data-aos-delay="100">
                Những giá trị định hướng
                <span class="text-primary">hoạt động của chúng tôi</span>
            </h2>
            <p class="section-description" data-aos="fade-up" data-aos-delay="200">
                Chúng tôi xây dựng thương hiệu dựa trên những giá trị bền vững,
                hướng đến sự phát triển lâu dài và bền vững.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="value-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="value-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h4 class="value-title">Khách hàng là trung tâm</h4>
                    <p class="value-description">
                        Mọi quyết định và hoạt động đều hướng đến việc mang lại
                        giá trị tốt nhất cho khách hàng.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="value-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="value-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h4 class="value-title">Sáng tạo & Đổi mới</h4>
                    <p class="value-description">
                        Không ngừng cập nhật xu hướng mới, sáng tạo trong
                        từng sản phẩm và dịch vụ.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="value-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="value-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4 class="value-title">Minh bạch & Uy tín</h4>
                    <p class="value-description">
                        Cam kết rõ ràng về chất lượng, nguồn gốc sản phẩm
                        và trách nhiệm với xã hội.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="value-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="value-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h4 class="value-title">Phát triển bền vững</h4>
                    <p class="value-description">
                        Hướng đến sự phát triển bền vững, tôn trọng môi trường
                        và cộng đồng xã hội.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="why-choose-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-label" data-aos="fade-up">Tại sao chọn chúng tôi</span>
            <h2 class="section-title" data-aos="fade-up" data-aos-delay="100">
                Những lý do khiến khách hàng
                <span class="text-primary">tin tưởng và lựa chọn</span>
            </h2>
            <p class="section-description" data-aos="fade-up" data-aos-delay="200">
                Chúng tôi cam kết mang đến trải nghiệm mua sắm tuyệt vời nhất
                với những ưu điểm vượt trội.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h4 class="feature-title">Sản phẩm chính hãng</h4>
                    <p class="feature-description">
                        100% sản phẩm chính hãng từ các thương hiệu uy tín,
                        đảm bảo chất lượng và nguồn gốc rõ ràng.
                    </p>
                    <div class="feature-highlight">
                        <span class="highlight-text">Cam kết hoàn tiền nếu hàng giả</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h4 class="feature-title">Giao hàng siêu tốc</h4>
                    <p class="feature-description">
                        Giao hàng nhanh chóng trong 24h tại TP.HCM và Hà Nội,
                        2-3 ngày toàn quốc.
                    </p>
                    <div class="feature-highlight">
                        <span class="highlight-text">Miễn phí ship đơn từ 500k</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-icon">
                        <i class="fas fa-undo-alt"></i>
                    </div>
                    <h4 class="feature-title">Đổi trả linh hoạt</h4>
                    <p class="feature-description">
                        Đổi trả miễn phí trong 30 ngày, không cần lý do,
                        thủ tục đơn giản và nhanh chóng.
                    </p>
                    <div class="feature-highlight">
                        <span class="highlight-text">Đổi size miễn phí</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4 class="feature-title">Hỗ trợ tận tâm</h4>
                    <p class="feature-description">
                        Đội ngũ tư vấn chuyên nghiệp, hỗ trợ 24/7 qua
                        hotline, chat và email.
                    </p>
                    <div class="feature-highlight">
                        <span class="highlight-text">Tư vấn phong cách miễn phí</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section Modern -->
<section class="about-team-section py-5" style="background:#f7f7f9;">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6" data-aos="fade-right">
                <img src="https://images.unsplash.com/photo-1519125323398-675f0ddb6308?auto=format&fit=crop&w=800&q=80" alt="Đội ngũ Viuss Fashion Store" class="img-fluid rounded-4 shadow-lg mb-3 mb-md-0" data-aos="zoom-in">
            </div>
            <div class="col-md-6" data-aos="fade-left">
                <h2 class="fw-bold mb-3 luxury-font" style="color:#232526;" data-aos="fade-up">Đội ngũ của chúng tôi</h2>
                <p style="color:#555;" data-aos="fade-up" data-aos-delay="100">Viuss Fashion Store tự hào sở hữu đội ngũ trẻ trung, sáng tạo, giàu kinh nghiệm trong lĩnh vực thời trang và thương mại điện tử. Chúng tôi luôn nỗ lực không ngừng để mang đến cho khách hàng những trải nghiệm tốt nhất.</p>
                <blockquote class="blockquote mt-4 animated-quote" style="color:#36d1c4; font-size:1.1rem; border-left:4px solid #ffbe3d; padding-left:16px; background:rgba(255,190,61,0.07);" data-aos="fade-in" data-aos-delay="200">"Thời trang là cách bạn kể câu chuyện của chính mình mà không cần nói một lời."</blockquote>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section Gradient Modern -->
<section class="about-cta-section py-5 position-relative overflow-hidden" style="background: linear-gradient(90deg,#36d1c4,#ff5e62);">
    <div class="container text-center position-relative z-2">
        <h2 class="fw-bold mb-3 luxury-font" style="color:#fff;" data-aos="zoom-in">Cùng Viuss Fashion Store tạo nên phong cách của bạn!</h2>
        <p class="mb-4" style="color:#fffbe7;" data-aos="fade-up" data-aos-delay="100">Hãy đồng hành cùng chúng tôi để khám phá những xu hướng mới, nhận ưu đãi hấp dẫn và trải nghiệm dịch vụ tận tâm nhất.</p>
        <a href="/" class="btn btn-lg btn-light cta-btn-anim" style="border-radius:24px; font-weight:600; padding:12px 36px; color:#ff5e62; background:#fffbe7; transition:background 0.2s, color 0.2s;" data-aos="zoom-in" data-aos-delay="200">Khám phá ngay</a>
    </div>
    <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=1200&q=80" alt="Fashion Banner" style="position:absolute;bottom:0;right:0;width:320px;max-width:40vw;opacity:0.13;z-index:1;pointer-events:none;" class="parallax-img">
</section>

<style>
/* Modern CSS Variables */
:root {
    --primary-gradient: linear-gradient(135deg, #f7b42c 0%, #fc575e 100%);
    --secondary-gradient: linear-gradient(135deg, #36d1c4 0%, #ff5e62 100%);
    --accent-gradient: linear-gradient(135deg, #ffbe3d 0%, #36d1c4 100%);
    --primary: #f7b42c;
    --secondary: #36d1c4;
    --accent: #ffbe3d;
    --danger: #ff5e62;
    --text-primary: #232526;
    --text-secondary: #555;
    --text-light: #666;
    --text-muted: #888;
    --bg-light: #f9f9f9;
    --bg-white: #ffffff;
    --border-light: #e8e8e8;
    --shadow-sm: 0 1px 3px rgba(35,37,38,0.12), 0 1px 2px rgba(35,37,38,0.24);
    --shadow-md: 0 4px 6px rgba(35,37,38,0.07), 0 1px 3px rgba(35,37,38,0.06);
    --shadow-lg: 0 10px 15px rgba(35,37,38,0.1), 0 4px 6px rgba(35,37,38,0.05);
    --shadow-xl: 0 20px 25px rgba(35,37,38,0.1), 0 10px 10px rgba(35,37,38,0.04);
    --border-radius: 12px;
    --border-radius-lg: 20px;
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Hero Section Styles */
.hero-section {
    min-height: 100vh;
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.hero-gradient-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.8) 100%);
    z-index: 2;
}

.hero-pattern {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image:
        radial-gradient(circle at 25% 25%, rgba(255,255,255,0.1) 2px, transparent 2px),
        radial-gradient(circle at 75% 75%, rgba(255,255,255,0.1) 2px, transparent 2px);
    background-size: 60px 60px;
    z-index: 3;
    animation: patternMove 20s linear infinite;
}

@keyframes patternMove {
    0% { transform: translate(0, 0); }
    100% { transform: translate(60px, 60px); }
}

.hero-bg-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.3;
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 10;
}

/* Hero Text Styles */
.hero-text-wrapper {
    color: white;
}

.hero-badge-container {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    padding: 12px 24px;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 600;
    position: relative;
    overflow: hidden;
    transition: var(--transition);
}

.hero-badge:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-2px);
}

.badge-glow {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    animation: badgeGlow 2s infinite;
}

@keyframes badgeGlow {
    0% { left: -100%; }
    100% { left: 100%; }
}

.hero-stats-mini {
    display: flex;
    gap: 1.5rem;
    margin-top: 0.5rem;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.85rem;
    opacity: 0.9;
}

.stat-item i {
    color: #ffd700;
}

/* Hero Title */
.hero-title {
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 2rem;
    position: relative;
}

.title-main {
    display: block;
    background: linear-gradient(135deg, #ffffff 0%, #f0f8ff 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: 0 4px 8px rgba(0,0,0,0.3);
}

.title-sub {
    display: block;
    font-size: 0.6em;
    font-weight: 400;
    opacity: 0.9;
    margin-top: 0.5rem;
    color: rgba(255, 255, 255, 0.8);
}

.title-decoration {
    position: absolute;
    bottom: -10px;
    left: 0;
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #ffd700, #ff6b6b);
    border-radius: 2px;
    animation: decorationGlow 2s ease-in-out infinite alternate;
}

@keyframes decorationGlow {
    0% { box-shadow: 0 0 5px rgba(255, 215, 0, 0.5); }
    100% { box-shadow: 0 0 20px rgba(255, 215, 0, 0.8), 0 0 30px rgba(255, 107, 107, 0.5); }
}

/* Hero Description */
.hero-description {
    font-size: 1.1rem;
    line-height: 1.7;
    opacity: 0.95;
    max-width: 600px;
}

.hero-description strong {
    color: #ffd700;
    font-weight: 600;
}

/* Hero Actions */
.hero-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    margin-bottom: 2rem;
}

.hero-btn-primary {
    position: relative;
    padding: 16px 32px;
    background: linear-gradient(135deg, #ff6b6b 0%, #ffd700 100%);
    border: none;
    border-radius: var(--border-radius);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    overflow: hidden;
    transition: var(--transition);
    box-shadow: 0 8px 25px rgba(255, 107, 107, 0.3);
}

.hero-btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(255, 107, 107, 0.4);
}

.hero-btn-primary .btn-content {
    position: relative;
    z-index: 2;
}

.btn-glow {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: var(--transition);
}

.hero-btn-primary:hover .btn-glow {
    left: 100%;
}

.hero-btn-secondary {
    padding: 16px 32px;
    background: transparent;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: var(--border-radius);
    color: white;
    font-weight: 600;
    backdrop-filter: blur(10px);
    transition: var(--transition);
}

.hero-btn-secondary:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-2px);
    color: white;
}

/* Trust Indicators */
.hero-trust-indicators {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
}

.trust-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 0.9rem;
    opacity: 0.9;
}

.trust-item i {
    color: #4ade80;
    font-size: 1.1rem;
}

/* Hero 3D Visual */
.hero-visual-wrapper {
    position: relative;
    height: 600px;
}

.hero-3d-stack {
    position: relative;
    width: 100%;
    height: 100%;
    perspective: 1000px;
}

.hero-3d-card {
    position: absolute;
    width: 280px;
    height: 380px;
    background: white;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-xl);
    overflow: hidden;
    transition: var(--transition);
    cursor: pointer;
    transform-style: preserve-3d;
}

.hero-3d-card.card-1 {
    top: 0;
    left: 0;
    z-index: 3;
    animation: float1 6s ease-in-out infinite;
}

.hero-3d-card.card-2 {
    top: 100px;
    right: 0;
    z-index: 2;
    animation: float2 6s ease-in-out infinite 2s;
}

.hero-3d-card.card-3 {
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1;
    animation: float3 6s ease-in-out infinite 4s;
}

@keyframes float1 {
    0%, 100% { transform: translateY(0px) rotateY(0deg); }
    50% { transform: translateY(-20px) rotateY(5deg); }
}

@keyframes float2 {
    0%, 100% { transform: translateY(0px) rotateY(0deg); }
    50% { transform: translateY(-15px) rotateY(-5deg); }
}

@keyframes float3 {
    0%, 100% { transform: translateX(-50%) translateY(0px) rotateY(0deg); }
    50% { transform: translateX(-50%) translateY(-10px) rotateY(3deg); }
}

.hero-3d-card:hover {
    transform: translateY(-10px) scale(1.05);
    box-shadow: 0 25px 50px rgba(0,0,0,0.2);
}

.card-image {
    position: relative;
    height: 60%;
    overflow: hidden;
}

.card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.hero-3d-card:hover .card-image img {
    transform: scale(1.1);
}

.card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    opacity: 0;
    transition: var(--transition);
}

.hero-3d-card:hover .card-overlay {
    opacity: 1;
}

.card-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    padding: 6px 12px;
    background: linear-gradient(135deg, #ff6b6b, #ffd700);
    color: white;
    font-size: 0.75rem;
    font-weight: 600;
    border-radius: 20px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
}

.card-content {
    padding: 20px;
    height: 40%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.card-content h4 {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.card-content p {
    color: var(--text-secondary);
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.card-stats {
    display: flex;
    gap: 1rem;
}

.card-stats span {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    font-size: 0.8rem;
    color: var(--text-light);
}

.card-stats i {
    color: #ff6b6b;
}

/* Floating Elements */
.hero-floating-elements {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 5;
}

.floating-element {
    position: absolute;
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: rgba(255, 255, 255, 0.8);
    animation: floatRandom 8s ease-in-out infinite;
}

.floating-element.element-1 {
    top: 10%;
    left: 10%;
    animation-delay: 0s;
    color: #ff6b6b;
}

.floating-element.element-2 {
    top: 20%;
    right: 15%;
    animation-delay: 2s;
    color: #ffd700;
}

.floating-element.element-3 {
    bottom: 30%;
    left: 5%;
    animation-delay: 4s;
    color: #4ade80;
}

.floating-element.element-4 {
    bottom: 10%;
    right: 10%;
    animation-delay: 6s;
    color: #60a5fa;
}

@keyframes floatRandom {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
        opacity: 0.6;
    }
    25% {
        transform: translateY(-20px) rotate(90deg);
        opacity: 0.8;
    }
    50% {
        transform: translateY(-10px) rotate(180deg);
        opacity: 1;
    }
    75% {
        transform: translateY(-30px) rotate(270deg);
        opacity: 0.7;
    }
}

/* Scroll Indicator */
.scroll-indicator {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
    color: rgba(255, 255, 255, 0.8);
    z-index: 10;
    animation: scrollBounce 2s ease-in-out infinite;
}

.scroll-text {
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
    opacity: 0.8;
}

.scroll-arrow {
    font-size: 1.2rem;
    animation: arrowBounce 1.5s ease-in-out infinite;
}

@keyframes scrollBounce {
    0%, 100% { transform: translateX(-50%) translateY(0px); }
    50% { transform: translateX(-50%) translateY(-10px); }
}

@keyframes arrowBounce {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(5px); }
}

/* Section Styles */
.section-label {
    display: inline-block;
    padding: 8px 20px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    border-radius: 25px;
    margin-bottom: 1rem;
}

.section-title {
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 800;
    line-height: 1.2;
    color: var(--text-primary);
    margin-bottom: 1.5rem;
}

.section-description {
    font-size: 1.1rem;
    line-height: 1.7;
    color: var(--text-secondary);
    max-width: 600px;
    margin: 0 auto;
}

/* Modern Card Styles */
.value-card, .feature-card {
    background: white;
    border-radius: var(--border-radius-lg);
    padding: 2rem;
    text-align: center;
    box-shadow: var(--shadow-md);
    border: 1px solid rgba(102, 126, 234, 0.1);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.value-card::before, .feature-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: var(--primary-gradient);
    transform: scaleX(0);
    transition: var(--transition);
}

.value-card:hover, .feature-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-xl);
    border-color: rgba(102, 126, 234, 0.3);
}

.value-card:hover::before, .feature-card:hover::before {
    transform: scaleX(1);
}

.value-icon, .feature-icon {
    width: 80px;
    height: 80px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2rem;
    color: white;
    position: relative;
    overflow: hidden;
}

.value-icon::after, .feature-icon::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: var(--transition);
}

.value-card:hover .value-icon::after,
.feature-card:hover .feature-icon::after {
    left: 100%;
}

.value-title, .feature-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1rem;
}

.value-description, .feature-description {
    color: var(--text-secondary);
    line-height: 1.6;
    margin-bottom: 1rem;
}

.feature-highlight {
    padding: 8px 16px;
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
    font-size: 0.85rem;
    font-weight: 600;
    border-radius: 20px;
    display: inline-block;
}

/* Story Section - Modern Design */
.story-section {
    background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
    padding: 6rem 0;
    position: relative;
    overflow: hidden;
}

.story-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23667eea" opacity="0.05"/><circle cx="75" cy="75" r="1" fill="%23764ba2" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    z-index: 1;
}

.story-section .container {
    position: relative;
    z-index: 2;
}

.story-badge-header {
    display: inline-block;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 12px 24px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

.story-main-title {
    font-size: 3rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1.5rem;
    line-height: 1.2;
}

.story-main-title .highlight-text {
    background: linear-gradient(135deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.story-intro {
    font-size: 1.2rem;
    color: var(--text-muted);
    margin-bottom: 0;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

/* Timeline Cards */
.story-timeline {
    margin-top: 4rem;
}

.timeline-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
    border: 1px solid rgba(102, 126, 234, 0.1);
}

.timeline-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 60px rgba(0,0,0,0.15);
}

.timeline-image {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.timeline-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.timeline-card:hover .timeline-image img {
    transform: scale(1.05);
}

.timeline-year {
    position: absolute;
    top: 20px;
    right: 20px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.9rem;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.timeline-content {
    padding: 2rem;
}

.timeline-content h4 {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
}

.timeline-content p {
    color: var(--text-muted);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.timeline-stats {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.timeline-stats span {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: var(--primary);
    font-weight: 600;
    background: rgba(247, 180, 44, 0.1);
    padding: 6px 12px;
    border-radius: 15px;
}

.timeline-stats i {
    font-size: 0.8rem;
}

/* Value Cards */
.value-card-modern {
    background: white;
    padding: 2.5rem 2rem;
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
    border: 1px solid rgba(102, 126, 234, 0.1);
    position: relative;
    overflow: hidden;
}

.value-card-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: var(--primary-gradient);
    transform: scaleX(0);
    transition: transform 0.4s ease;
}

.value-card-modern:hover::before {
    transform: scaleX(1);
}

.value-card-modern:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 50px rgba(0,0,0,0.12);
}

.value-icon-modern {
    width: 80px;
    height: 80px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    box-shadow: 0 8px 25px rgba(247, 180, 44, 0.3);
    transition: all 0.4s ease;
}

.value-card-modern:hover .value-icon-modern {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 12px 35px rgba(247, 180, 44, 0.4);
}

.value-icon-modern i {
    font-size: 2rem;
    color: white;
}

.value-card-modern h4 {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
}

.value-card-modern p {
    color: var(--text-muted);
    line-height: 1.6;
    margin-bottom: 0;
}

/* Statistics Section */
.stats-section {
    background: var(--bg-light);
    padding: 5rem 0;
}

.stat-card {
    background: white;
    border-radius: var(--border-radius-lg);
    padding: 2rem 1rem;
    text-align: center;
    box-shadow: var(--shadow-md);
    transition: var(--transition);
    border: 1px solid rgba(102, 126, 234, 0.1);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.stat-icon {
    width: 60px;
    height: 60px;
    background: var(--accent-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    font-size: 1.5rem;
    color: white;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.stat-label {
    color: var(--text-secondary);
    font-weight: 500;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .hero-3d-card {
        width: 240px;
        height: 320px;
    }
}

@media (max-width: 992px) {
    .hero-visual-wrapper {
        height: 500px;
        margin-top: 3rem;
    }

    .hero-3d-card {
        width: 200px;
        height: 280px;
    }

    .hero-3d-card.card-2 {
        top: 80px;
    }

    .hero-actions {
        justify-content: center;
    }

    .hero-trust-indicators {
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .hero-section {
        min-height: 100vh;
        padding: 2rem 0;
    }

    .hero-visual-wrapper {
        height: 400px;
    }

    .hero-3d-card {
        width: 160px;
        height: 220px;
    }

    .hero-3d-card.card-1 {
        top: 20px;
        left: 10px;
    }

    .hero-3d-card.card-2 {
        top: 60px;
        right: 10px;
    }

    .hero-3d-card.card-3 {
        bottom: 20px;
    }

    .hero-actions {
        flex-direction: column;
        align-items: center;
    }

    .hero-btn-primary, .hero-btn-secondary {
        width: 100%;
        max-width: 300px;
    }

    .hero-trust-indicators {
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }

    .floating-element {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }

    /* Story Section Mobile */
    .story-section {
        padding: 4rem 0;
    }

    .story-main-title {
        font-size: 2rem;
        text-align: center;
    }

    .story-intro {
        font-size: 1rem;
        text-align: center;
    }

    .timeline-image {
        height: 200px;
    }

    .timeline-content {
        padding: 1.5rem;
    }

    .timeline-content h4 {
        font-size: 1.2rem;
    }

    .timeline-stats {
        justify-content: center;
    }

    .value-card-modern {
        padding: 2rem 1.5rem;
        margin-bottom: 2rem;
    }

    .value-icon-modern {
        width: 60px;
        height: 60px;
    }

    .value-icon-modern i {
        font-size: 1.5rem;
    }
}

@media (max-width: 576px) {
    .hero-badge-container {
        text-align: center;
    }

    .hero-stats-mini {
        justify-content: center;
        flex-wrap: wrap;
    }

    .hero-title {
        text-align: center;
    }

    .hero-description {
        text-align: center;
    }

    .hero-visual-wrapper {
        height: 300px;
    }

    .hero-3d-card {
        width: 120px;
        height: 160px;
    }

    .card-content {
        padding: 15px;
    }

    .card-content h4 {
        font-size: 1rem;
    }

    .card-content p {
        font-size: 0.8rem;
    }
}
</style>
<script>
// Modern JavaScript for Enhanced UX
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

    // Counter Animation for Statistics
    function animateCounters() {
        const counters = document.querySelectorAll('.stat-number');
        const speed = 200;

        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-count'));
            const count = +counter.innerText;
            const inc = target / speed;

            if (count < target) {
                counter.innerText = Math.ceil(count + inc);
                setTimeout(() => animateCounters(), 1);
            } else {
                counter.innerText = target;
            }
        });
    }

    // Intersection Observer for Counter Animation
    const statsSection = document.querySelector('.stats-section');
    if (statsSection) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        observer.observe(statsSection);
    }

    // Parallax Effect for Hero Background
    function parallaxEffect() {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll('.hero-bg-image, .hero-pattern');

        parallaxElements.forEach(element => {
            const speed = element.classList.contains('hero-pattern') ? 0.3 : 0.5;
            element.style.transform = `translateY(${scrolled * speed}px)`;
        });
    }

    // Smooth Parallax with RequestAnimationFrame
    let ticking = false;
    function updateParallax() {
        parallaxEffect();
        ticking = false;
    }

    window.addEventListener('scroll', () => {
        if (!ticking) {
            requestAnimationFrame(updateParallax);
            ticking = true;
        }
    });

    // 3D Tilt Effect for Hero Cards
    function initTiltEffect() {
        const cards = document.querySelectorAll('[data-tilt]');

        cards.forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                const centerX = rect.width / 2;
                const centerY = rect.height / 2;

                const rotateX = (y - centerY) / 10;
                const rotateY = (centerX - x) / 10;

                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.05, 1.05, 1.05)`;
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
            });
        });
    }

    initTiltEffect();

    // Smooth Scroll for Anchor Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Dynamic Text Animation
    function typeWriter(element, text, speed = 100) {
        let i = 0;
        element.innerHTML = '';

        function type() {
            if (i < text.length) {
                element.innerHTML += text.charAt(i);
                i++;
                setTimeout(type, speed);
            }
        }

        type();
    }

    // Intersection Observer for Text Animation
    const heroTitle = document.querySelector('.title-main');
    if (heroTitle) {
        const titleObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const originalText = entry.target.textContent;
                    typeWriter(entry.target, originalText, 150);
                    titleObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        titleObserver.observe(heroTitle);
    }

    // Loading Animation for Images
    function handleImageLoading() {
        const images = document.querySelectorAll('img[loading="lazy"]');

        images.forEach(img => {
            img.addEventListener('load', function() {
                this.style.opacity = '0';
                this.style.transform = 'scale(1.1)';

                setTimeout(() => {
                    this.style.transition = 'all 0.6s ease';
                    this.style.opacity = '1';
                    this.style.transform = 'scale(1)';
                }, 100);
            });
        });
    }

    handleImageLoading();

    // Performance Optimization: Debounce Scroll Events
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Optimized Scroll Handler
    const optimizedScrollHandler = debounce(() => {
        // Add any additional scroll-based animations here
        const scrollTop = window.pageYOffset;
        const windowHeight = window.innerHeight;

        // Update scroll indicator opacity
        const scrollIndicator = document.querySelector('.scroll-indicator');
        if (scrollIndicator) {
            const opacity = Math.max(0, 1 - (scrollTop / windowHeight));
            scrollIndicator.style.opacity = opacity;
        }
    }, 10);

    window.addEventListener('scroll', optimizedScrollHandler);

    // Preload Critical Images
    function preloadImages() {
        const criticalImages = [
            'https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=1920&q=80',
            'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&w=500&q=80',
            'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=500&q=80'
        ];

        criticalImages.forEach(src => {
            const img = new Image();
            img.src = src;
        });
    }

    preloadImages();

    // Add loading states for better UX
    function addLoadingStates() {
        const cards = document.querySelectorAll('.hero-3d-card, .value-card, .feature-card');

        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';

            setTimeout(() => {
                card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }

    // Initialize loading animations after a short delay
    setTimeout(addLoadingStates, 500);
});

// Service Worker Registration for Better Performance
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js')
            .then(registration => {
                console.log('SW registered: ', registration);
            })
            .catch(registrationError => {
                console.log('SW registration failed: ', registrationError);
            });
    });
}
</script>
@endsection 