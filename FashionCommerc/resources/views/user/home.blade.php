@extends('user.dashboard_user')

@section('content')
<!-- Hero Section -->
@if(isset($banners) && count($banners))
<div class="banner-slider">
    <div class="container">
        <div class="slide">
            @foreach($banners as $banner)
            <div class="item" style="background-image: url('{{ asset('uploads/banner/' . $banner->image) }}');">
                <div class="content">
                    <div class="name">{{ $banner->title }}</div>
                    <div class="des">{{ $banner->content }}</div>
                    @if(!empty($banner->title))
                    <button>Xem bộ sưu tập</button>
                    @endif
                </div>
            </div>
            @endforeach
            @foreach($banners as $banner)
            <div class="item" style="background-image: url('{{ asset('uploads/banner/' . $banner->image) }}');">
                <div class="content">
                    <div class="name">{{ $banner->title }}</div>
                    <div class="des">{{ $banner->content }}</div>
                    @if(!empty($banner->title))
                    <button>Xem bộ sưu tập</button>
                    @endif
                </div>
            </div>
            @endforeach
            @foreach($banners as $banner)
            <div class="item" style="background-image: url('{{ asset('uploads/banner/' . $banner->image) }}');">
                <div class="content">
                    <div class="name">{{ $banner->title }}</div>
                    <div class="des">{{ $banner->content }}</div>
                    @if(!empty($banner->title))
                    <button>Xem bộ sưu tập</button>
                    @endif
                </div>
            </div>
            @endforeach
            @foreach($banners as $banner)
            <div class="item" style="background-image: url('{{ asset('uploads/banner/' . $banner->image) }}');">
                <div class="content">
                    <div class="name">{{ $banner->title }}</div>
                    <div class="des">{{ $banner->content }}</div>
                    @if(!empty($banner->title))
                    <button>Xem bộ sưu tập</button>
                    @endif
                </div>
            </div>
            @endforeach
            
        </div>
        <div class="button">
            <button id="prev"><i class="fa fa-angle-left"></i></button>
            <button id="next"><i class="fa fa-angle-right"></i></button>
        </div>
    </div>
</div>
@endif
</section>

<!-- Why Choose Viuss Fashion Store? (International Standard Grid Layout) -->
<section class="why-choose-section-intl" style="background: #fff; padding: 64px 0;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-2" style="font-family: 'Montserrat', Arial, sans-serif; color: #232526; font-size:2.2rem; letter-spacing: 0.02em;">Why Choose <span style="color:#36d1c4;">Viuss Fashion Store?</span></h2>
            <div class="mx-auto" style="max-width: 480px;">
                <p class="mb-0" style="color:#555; font-size:1.08rem;">Trải nghiệm mua sắm thời trang đẳng cấp, dịch vụ tận tâm và ưu đãi hấp dẫn!</p>
            </div>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-12 col-sm-6 col-lg-3 d-flex">
                <div class="why-choose-card-intl flex-fill d-flex flex-column align-items-center text-center p-4">
                    <div class="mb-3"><i class="fas fa-gem" style="font-size:2.5rem; color:#ffbe3d;"></i></div>
                    <div class="fw-bold mb-2" style="color:#232526; font-size:1.13rem;">Sản phẩm chính hãng</div>
                    <div class="small" style="color:#666;">Cam kết 100% hàng hiệu, chất lượng cao, cập nhật xu hướng mới nhất.</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 d-flex">
                <div class="why-choose-card-intl flex-fill d-flex flex-column align-items-center text-center p-4">
                    <div class="mb-3"><i class="fas fa-shipping-fast" style="font-size:2.5rem; color:#36d1c4;"></i></div>
                    <div class="fw-bold mb-2" style="color:#232526; font-size:1.13rem;">Giao hàng siêu tốc</div>
                    <div class="small" style="color:#666;">Giao hàng toàn quốc chỉ từ 1-3 ngày, đóng gói cẩn thận, bảo mật thông tin.</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 d-flex">
                <div class="why-choose-card-intl flex-fill d-flex flex-column align-items-center text-center p-4">
                    <div class="mb-3"><i class="fas fa-sync-alt" style="font-size:2.5rem; color:#ff5e62;"></i></div>
                    <div class="fw-bold mb-2" style="color:#232526; font-size:1.13rem;">Đổi trả dễ dàng</div>
                    <div class="small" style="color:#666;">Đổi trả miễn phí trong 7 ngày, hỗ trợ tận tình, thủ tục nhanh chóng.</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 d-flex">
                <div class="why-choose-card-intl flex-fill d-flex flex-column align-items-center text-center p-4">
                    <div class="mb-3"><i class="fas fa-headset" style="font-size:2.5rem; color:#ffbe3d;"></i></div>
                    <div class="fw-bold mb-2" style="color:#232526; font-size:1.13rem;">Hỗ trợ 24/7</div>
                    <div class="small" style="color:#666;">Đội ngũ CSKH chuyên nghiệp, tư vấn tận tâm mọi lúc mọi nơi.</div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .why-choose-card-intl {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(44, 62, 80, 0.07);
            min-height: 240px;
            transition: box-shadow 0.22s, transform 0.22s;
            border: 1px solid #f0f0f0;
        }

        .why-choose-card-intl:hover {
            box-shadow: 0 8px 32px rgba(54, 209, 196, 0.13), 0 2px 8px rgba(255, 94, 98, 0.10);
            transform: translateY(-6px) scale(1.03);
            border-color: #36d1c4;
        }

        @media (max-width: 991px) {
            .why-choose-section-intl {
                padding: 40px 0;
            }

            .why-choose-card-intl {
                min-height: 200px;
            }
        }

        @media (max-width: 767px) {
            .why-choose-section-intl {
                padding: 24px 0;
            }

            .why-choose-card-intl {
                min-height: 160px;
                padding: 1.1rem !important;
            }
        }
    </style>
</section>
<!-- End Why Choose (Intl) -->

<!-- Top Categories Section -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Danh mục nổi bật</h2>
            <p>Khám phá các dòng sản phẩm chính của chúng tôi</p>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($topCategories as $category)
            <div class="col-6 col-md-3">
                <a href="{{ route('user.searchProduct', ['category' => $category->id_category]) }}" class="category-showcase-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="category-showcase-image-wrapper">
                        @if($category->image_category)
                        <img src="{{ asset('uploads/categoryimage/' . $category->image_category) }}" alt="{{ $category->name_category }}" class="category-showcase-image">
                        @else
                        <div class="category-showcase-placeholder">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                        @endif
                    </div>
                    <div class="category-showcase-content">
                        <h5 class="category-showcase-title">{{ $category->name_category }}</h5>
                        <p class="category-showcase-count">{{ $category->products_count }} sản phẩm</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- New Products Section -->
<section class="section-padding">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Sản phẩm mới</h2>
            <p>Những sản phẩm mới nhất từ các thương hiệu hàng đầu</p>
        </div>

        <div class="swiper new-products-swiper" data-aos="fade-up">
            <div class="swiper-wrapper">
                @foreach($newProducts as $product)
                <div class="swiper-slide">
                    <div class="product-card position-relative">
                        <button class="favorite-btn {{ in_array($product->id_product, $favoriteProductIds ?? []) ? 'active' : '' }}"
                            title="Yêu thích"
                            data-id="{{ $product->id_product }}">
                            <i class="fa-{{ in_array($product->id_product, $favoriteProductIds ?? []) ? 'solid' : 'regular' }} fa-heart"></i>
                        </button>
                        <div class="product-img">
                            <img src="{{ asset('uploads/productimage/' . $product->image_address_product) }}"
                                alt="{{ $product->name_product }}"
                                loading="lazy">
                            <div class="product-actions">
                                <a href="{{ route('product.indexDetailproduct', ['id' => $product->id_product]) }}"
                                    class="btn-action">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('cart.indexCart') }}" class="btn-action">
                                    <i class="fas fa-shopping-cart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="product-category">
                                @foreach($productsWithCategorys as $category)
                                @if($product->id_category == $category->id_category)
                                {{ $category->name_category }}
                                @break
                                @endif
                                @endforeach
                            </div>
                            <h4 class="product-name">
                                <a href="{{ route('product.indexDetailproduct', ['id' => $product->id_product]) }}">
                                    {{ $product->name_product }}
                                </a>
                            </h4>
                            <div class="product-manufacturer">
                                {{ $productsWithManufacturers->firstWhere('id_manufacturer', $product->id_manufacturer)->name_manufacturer ?? '' }}
                            </div>
                            <div class="product-price">{{ number_format($product->price_product, 0, ',', '.') }} VNĐ</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<!-- All Products Section -->
<section class="section-padding bg-light" id="products">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Tất cả sản phẩm</h2>
            <p>Khám phá toàn bộ bộ sưu tập đa dạng của chúng tôi</p>
        </div>

        <div class="row g-4" id="products-grid">
            @include('user.partials.product_grid', [
            'products' => $products,
            'productsWithCategorys' => $productsWithCategorys,
            'productsWithManufacturers' => $productsWithManufacturers,
            'favoriteProductIds' => $favoriteProductIds
            ])
        </div>

        <div class="pagination-wrapper mt-5" data-aos="fade-up">
            @include('user.partials.pagination', ['products' => $products])
        </div>
    </div>
</section>

<!-- Top 3 Đánh giá 5 sao nổi bật -->
@if(isset($topReviews) && count($topReviews))
<section class="section-padding bg-light" style="padding-top:40px; padding-bottom:40px;">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Khách hàng nói gì về sản phẩm?</h2>
            <p>3 đánh giá 5 sao nổi bật từ người dùng thực tế</p>
        </div>
        <div class="row justify-content-center g-4">
            @foreach($topReviews as $review)
            <div class="col-md-4">
                <a href="{{ route('product.indexDetailproduct', ['id' => $review->id_product]) }}#review-{{ $review->id }}" class="review-link">
                    <div class="review-3d-card-modern position-relative" tabindex="0">
                        <div class="review-3d-bg-animated"></div>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="reviewer-avatar-modern me-3">
                                    <span class="avatar-glow"></span>
                                    {{ mb_substr($review->user->name ?? 'Ẩn danh',0,1) }}
                                </div>
                                <div>
                                    <div class="fw-bold reviewer-name luxury-font">{{ $review->user->name ?? 'Ẩn danh' }}</div>
                                    <div class="star-shine">
                                        @for($i=1;$i<=5;$i++)
                                            <i class="fa{{ $i <= $review->rating ? 's' : 'r' }} fa-star"></i>
                                            @endfor
                                    </div>
                                    <div class="text-muted small">{{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</div>
                                </div>
                            </div>
                            <div class="review-content mb-2 luxury-font" style="min-height:60px;">{{ $review->content }}</div>
                            @if($review->images)
                            @php $media = is_array($review->images) ? $review->images : json_decode($review->images,true); @endphp
                            <div class="d-flex gap-2 mb-2">
                                @foreach($media as $m)
                                @if(isset($m['type']) && strpos($m['type'],'image')===0)
                                <img src="{{ $m['url'] }}" alt="Ảnh đánh giá" class="review-img-modern floating-img">
                                @elseif(isset($m['type']) && strpos($m['type'],'video')===0)
                                <video src="{{ $m['url'] }}" class="review-img-modern floating-img" controls></video>
                                @endif
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <div class="card-footer bg-transparent border-0 d-flex align-items-center gap-2 pt-0 pb-3">
                            <div class="product-img-modern-wrap floating-img">
                                <img src="{{ asset('uploads/productimage/' . ($review->product->image_address_product ?? '')) }}" alt="{{ $review->product->name_product ?? '' }}" class="product-img-modern">
                            </div>
                            <div>
                                <div class="small text-dark fw-semibold luxury-font">{{ $review->product->name_product ?? '' }}</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Font luxury -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;900&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/user/home.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.2/vanilla-tilt.min.js"></script>
<script src="{{ asset('js/user/home.js') }}"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slide = document.querySelector('.banner-slider .slide');
        const prevBtn = document.getElementById('prev');
        const nextBtn = document.getElementById('next');
        let autoSlideInterval;

        function moveSlide(direction) {
            if (direction === 'next') {
                slide.appendChild(slide.firstElementChild);
            } else {
                slide.insertBefore(slide.lastElementChild, slide.firstElementChild);
            }
        }

        prevBtn.onclick = () => {
            moveSlide('prev');
            resetAutoSlide();
        };
        nextBtn.onclick = () => {
            moveSlide('next');
            resetAutoSlide();
        };

        function autoSlide() {
            moveSlide('next');
        }

        function resetAutoSlide() {
            clearInterval(autoSlideInterval);
            autoSlideInterval = setInterval(autoSlide, 4000);
        }

        // Khởi động auto slide
        autoSlideInterval = setInterval(autoSlide, 4000);
    });
</script>

<!-- Popup Notification Modal
<div id="welcomeModal" style="display:flex; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(44,62,80,0.18); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:#fff; border-radius:18px; box-shadow:0 8px 32px rgba(44,62,80,0.18); max-width:350px; width:90vw; padding:0; overflow:hidden; position:relative; animation:popIn 0.5s cubic-bezier(.68,-0.55,.27,1.55);">
        <button id="closeWelcomeModal" style="position:absolute; top:10px; right:10px; background:rgba(0,0,0,0.06); border:none; border-radius:50%; width:32px; height:32px; font-size:1.2rem; color:#232526; cursor:pointer; z-index:2; transition:background 0.2s;">&times;</button>
        <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=400&q=80" alt="Fashion Welcome" style="width:100%; height:160px; object-fit:cover; border-radius:18px 18px 0 0;">
        <div style="padding:24px 18px 18px 18px; text-align:center;">
            <h4 style="font-family:'Montserrat',Arial,sans-serif; color:#232526; font-weight:700; margin-bottom:10px;">Chào mừng đến với Viuss Fashion Store!</h4>
            <div style="color:#555; font-size:1.05rem; margin-bottom:8px;">Khám phá ưu đãi độc quyền và xu hướng mới nhất chỉ có tại Viuss. Đăng ký nhận tin để không bỏ lỡ bất kỳ deal hot nào!</div>
            <a href="#" style="display:inline-block; margin-top:8px; padding:8px 20px; background:linear-gradient(90deg,#36d1c4,#ff5e62); color:#fff; border-radius:20px; text-decoration:none; font-weight:600; font-size:1rem; transition:background 0.2s;">Xem ưu đãi ngay</a>
        </div>
    </div>
    <style>
        @keyframes popIn {
            0% {
                transform: scale(0.7);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        #welcomeModal button:hover {
            background: rgba(44, 62, 80, 0.12);
        }
    </style>
</div>
<script>
    document.body.style.overflow = 'hidden';
    window._welcomeModalTimeout = setTimeout(function() {
        document.getElementById('welcomeModal').style.display = 'none';
        document.body.style.overflow = '';
    }, 10000);
    document.getElementById('closeWelcomeModal').onclick = function() {
        document.getElementById('welcomeModal').style.display = 'none';
        document.body.style.overflow = '';
        if (window._welcomeModalTimeout) clearTimeout(window._welcomeModalTimeout);
    };
</script> -->
<!-- End Popup Notification Modal -->
@endsection