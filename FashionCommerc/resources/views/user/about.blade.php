@extends('user.dashboard_user')

@section('title', 'Giới thiệu về Viuss Fashion Store')
@section('meta')
    <meta name="description" content="Viuss Fashion Store - Thương hiệu thời trang hiện đại, uy tín, mang đến trải nghiệm mua sắm đẳng cấp, sản phẩm chính hãng, dịch vụ tận tâm và ưu đãi hấp dẫn.">
    <meta property="og:title" content="Giới thiệu về Viuss Fashion Store">
    <meta property="og:description" content="Khám phá sứ mệnh, giá trị và lý do nên chọn Viuss Fashion Store - nơi cập nhật xu hướng thời trang mới nhất.">
    <meta property="og:image" content="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=800&q=80">
@endsection

@section('content')
<!-- Hero Section Modern with Parallax -->
<section class="about-hero-section position-relative overflow-hidden" style="background: linear-gradient(120deg, #ff9966 0%, #ff5e62 50%, #36d1c4 100%); min-height: 380px; display: flex; align-items: center;">
    <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=1200&q=80" alt="Viuss Fashion Store" class="parallax-img" style="position:absolute;top:0;left:0;width:100%;height:100%;object-fit:cover;opacity:0.25;z-index:1;will-change:transform;">
    <div class="container position-relative z-2 text-center" style="z-index:2;">
        <h1 class="fw-bold mb-3 luxury-font" style="font-size:2.8rem; letter-spacing:0.03em; color:#fff; text-shadow:0 4px 24px rgba(44,62,80,0.18);" data-aos="zoom-in">Khám phá <span style="color:#ffe066;">Viuss Fashion Store</span></h1>
        <p class="lead mb-4" style="max-width:600px; margin:auto; color:#fffbe7;" data-aos="fade-up" data-aos-delay="200">Nơi hội tụ phong cách, chất lượng và trải nghiệm mua sắm thời trang đẳng cấp cho mọi khách hàng Việt Nam.</p>
        <a href="/" class="btn btn-lg btn-primary hero-cta-btn" style="background:linear-gradient(90deg,#36d1c4,#ff5e62); border:none; border-radius:24px; font-weight:600; padding:12px 36px; box-shadow:0 4px 16px rgba(44,62,80,0.13);" data-aos="zoom-in" data-aos-delay="400">Khám phá ngay</a>
    </div>
</section>

<!-- Mission Section Zigzag -->
<section class="about-mission-section py-5 bg-white">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6" data-aos="fade-right">
                <img src="https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=800&q=80" alt="Sứ mệnh Viuss" class="img-fluid rounded-4 shadow-lg mb-3 mb-md-0" data-aos="zoom-in" data-aos-delay="100">
            </div>
            <div class="col-md-6" data-aos="fade-left">
                <h2 class="fw-bold mb-3 luxury-font" style="color:#232526;" data-aos="fade-up">Sứ mệnh của chúng tôi</h2>
                <p style="color:#555;" data-aos="fade-up" data-aos-delay="100">Viuss Fashion Store ra đời với sứ mệnh mang đến cho khách hàng những sản phẩm thời trang chính hãng, cập nhật xu hướng mới nhất trên thế giới với giá cả hợp lý. Chúng tôi tin rằng mỗi người đều xứng đáng được thể hiện cá tính và phong cách riêng qua trang phục.</p>
                <ul class="list-unstyled mt-3" style="color:#232526;">
                    <li class="mb-2" data-aos="fade-right" data-aos-delay="200"><i class="fas fa-check-circle me-2 fa-bounce" style="color:#36d1c4;"></i> Sản phẩm đa dạng, chính hãng, chất lượng cao</li>
                    <li class="mb-2" data-aos="fade-right" data-aos-delay="300"><i class="fas fa-check-circle me-2 fa-beat" style="color:#ff5e62;"></i> Dịch vụ khách hàng tận tâm, chuyên nghiệp</li>
                    <li data-aos="fade-right" data-aos-delay="400"><i class="fas fa-check-circle me-2 fa-shake" style="color:#ffbe3d;"></i> Ưu đãi hấp dẫn, giao hàng nhanh chóng</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Values Section Zigzag -->
<section class="about-values-section py-5" style="background:#f7f7f9;">
    <div class="container">
        <div class="row align-items-center g-5 flex-md-row-reverse">
            <div class="col-md-6" data-aos="fade-left">
                <img src="https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?auto=format&fit=crop&w=800&q=80" alt="Giá trị cốt lõi Viuss" class="img-fluid rounded-4 shadow-lg mb-3 mb-md-0" data-aos="zoom-in" data-aos-delay="100">
            </div>
            <div class="col-md-6" data-aos="fade-right">
                <h2 class="fw-bold mb-3 luxury-font" style="color:#232526;" data-aos="fade-up">Giá trị cốt lõi</h2>
                <div class="row g-3">
                    <div class="col-12 col-sm-6">
                        <div class="card h-100 border-0 shadow-sm rounded-4 p-3 text-center value-card-anim" data-aos="zoom-in" data-aos-delay="100">
                            <i class="fas fa-star fa-2x mb-2 fa-beat" style="color:#ffbe3d;"></i>
                            <div class="fw-semibold mb-1">Khách hàng là trung tâm</div>
                            <div class="small text-muted">Mọi hoạt động đều hướng đến sự hài lòng của khách hàng.</div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="card h-100 border-0 shadow-sm rounded-4 p-3 text-center value-card-anim" data-aos="zoom-in" data-aos-delay="200">
                            <i class="fas fa-tshirt fa-2x mb-2 fa-bounce" style="color:#36d1c4;"></i>
                            <div class="fw-semibold mb-1">Sáng tạo, đổi mới</div>
                            <div class="small text-muted">Không ngừng cập nhật xu hướng, sáng tạo trong từng sản phẩm.</div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="card h-100 border-0 shadow-sm rounded-4 p-3 text-center value-card-anim" data-aos="zoom-in" data-aos-delay="300">
                            <i class="fas fa-hand-holding-heart fa-2x mb-2 fa-shake" style="color:#ff5e62;"></i>
                            <div class="fw-semibold mb-1">Minh bạch, uy tín</div>
                            <div class="small text-muted">Cam kết rõ ràng về chất lượng, nguồn gốc, trách nhiệm xã hội.</div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="card h-100 border-0 shadow-sm rounded-4 p-3 text-center value-card-anim" data-aos="zoom-in" data-aos-delay="400">
                            <i class="fas fa-globe-asia fa-2x mb-2 fa-spin" style="color:#36d1c4;"></i>
                            <div class="fw-semibold mb-1">Lan tỏa tích cực</div>
                            <div class="small text-muted">Truyền cảm hứng sống đẹp, hiện đại, tích cực đến cộng đồng.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Section Modern -->
<section class="about-why-section py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold luxury-font" style="color:#232526;" data-aos="fade-up">Tại sao nên chọn Viuss Fashion Store?</h2>
            <p class="mb-0" style="color:#555;" data-aos="fade-up" data-aos-delay="100">Chúng tôi không chỉ bán sản phẩm, mà còn mang đến trải nghiệm mua sắm tuyệt vời và giá trị bền vững cho khách hàng.</p>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-12 col-sm-6 col-lg-3 d-flex">
                <div class="why-choose-card-intl flex-fill d-flex flex-column align-items-center text-center p-4 shadow-lg rounded-4 why-card-anim" data-aos="flip-left" data-aos-delay="0">
                    <div class="mb-3"><i class="fas fa-gem fa-bounce" style="font-size:2.2rem; color:#ffbe3d;"></i></div>
                    <div class="fw-bold mb-2" style="color:#232526; font-size:1.08rem;">Sản phẩm chính hãng</div>
                    <div class="small" style="color:#666;">Đảm bảo chất lượng, nguồn gốc rõ ràng, cập nhật xu hướng mới nhất.</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 d-flex">
                <div class="why-choose-card-intl flex-fill d-flex flex-column align-items-center text-center p-4 shadow-lg rounded-4 why-card-anim" data-aos="flip-left" data-aos-delay="100">
                    <div class="mb-3"><i class="fas fa-shipping-fast fa-shake" style="font-size:2.2rem; color:#36d1c4;"></i></div>
                    <div class="fw-bold mb-2" style="color:#232526; font-size:1.08rem;">Giao hàng nhanh chóng</div>
                    <div class="small" style="color:#666;">Giao hàng toàn quốc, đóng gói cẩn thận, bảo mật thông tin.</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 d-flex">
                <div class="why-choose-card-intl flex-fill d-flex flex-column align-items-center text-center p-4 shadow-lg rounded-4 why-card-anim" data-aos="flip-left" data-aos-delay="200">
                    <div class="mb-3"><i class="fas fa-sync-alt fa-spin" style="font-size:2.2rem; color:#ff5e62;"></i></div>
                    <div class="fw-bold mb-2" style="color:#232526; font-size:1.08rem;">Đổi trả dễ dàng</div>
                    <div class="small" style="color:#666;">Đổi trả miễn phí trong 7 ngày, hỗ trợ tận tình, thủ tục nhanh chóng.</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 d-flex">
                <div class="why-choose-card-intl flex-fill d-flex flex-column align-items-center text-center p-4 shadow-lg rounded-4 why-card-anim" data-aos="flip-left" data-aos-delay="300">
                    <div class="mb-3"><i class="fas fa-headset fa-beat" style="font-size:2.2rem; color:#ffbe3d;"></i></div>
                    <div class="fw-bold mb-2" style="color:#232526; font-size:1.08rem;">Hỗ trợ 24/7</div>
                    <div class="small" style="color:#666;">Đội ngũ CSKH chuyên nghiệp, tư vấn tận tâm mọi lúc mọi nơi.</div>
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
.luxury-font { font-family: 'Montserrat', Arial, sans-serif; letter-spacing: 0.03em; }
.value-card-anim, .why-card-anim {
    transition: box-shadow 0.22s, transform 0.22s, border 0.22s;
    border: 1.5px solid #f0f0f0;
}
.value-card-anim:hover, .why-card-anim:hover {
    box-shadow: 0 8px 32px rgba(54,209,196,0.18), 0 2px 8px rgba(255,94,98,0.13);
    transform: translateY(-8px) scale(1.04);
    border-color: #36d1c4;
    background: #fffbe7;
}
.hero-cta-btn, .cta-btn-anim {
    transition: background 0.22s, color 0.22s, box-shadow 0.22s;
}
.hero-cta-btn:hover, .cta-btn-anim:hover {
    background: linear-gradient(90deg,#ff5e62,#36d1c4) !important;
    color: #fff !important;
    box-shadow: 0 4px 24px rgba(255,94,98,0.18);
}
.animated-quote {
    animation: quoteFadeIn 1.2s both;
}
@keyframes quoteFadeIn {
    0% { opacity: 0; transform: translateY(30px) scale(0.95); }
    100% { opacity: 1; transform: translateY(0) scale(1); }
}
.parallax-img {
    will-change: transform;
    transition: transform 0.3s cubic-bezier(.4,0,.2,1);
}
@media (max-width: 767px) {
    .about-hero-section { min-height: 220px; padding: 32px 0 !important; }
    .about-cta-section { padding: 32px 0 !important; }
}
</style>
<script>
// Parallax effect for hero/banner images
window.addEventListener('scroll', function() {
    var imgs = document.querySelectorAll('.parallax-img');
    var scrolled = window.scrollY;
    imgs.forEach(function(img) {
        img.style.transform = 'translateY(' + (scrolled * 0.15) + 'px)';
    });
});
</script>
@endsection 