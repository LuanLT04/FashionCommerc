@extends('user.dashboard_user')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>

<style>
:root {
    --primary-color: #ff6b35;
    --secondary-color: #2c3e50;
    --accent-color: #e74c3c;
    --text-dark: #2c3e50;
    --text-light: #7f8c8d;
    --bg-light: #f8f9fa;
    --white: #ffffff;
    --shadow: 0 4px 16px rgba(0,0,0,0.08);
    --shadow-hover: 0 8px 24px rgba(0,0,0,0.12);
    }

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

.container.detail-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 1.5rem 0;
}

.product-hero {
    background: var(--white);
    border-radius: 16px;
    box-shadow: var(--shadow);
    overflow: hidden;
    margin-bottom: 1.5rem;
    display: flex;
    flex-wrap: wrap;
    gap: 0;
    }

.product-gallery {
    background: #f7f7f7;
        display: flex;
    align-items: center;
    justify-content: center;
    min-height: 350px;
    max-height: 350px;
    width: 100%;
    max-width: 400px;
    border-radius: 16px 0 0 16px;
    overflow: hidden;
}

.main-image {
    width: 100%;
    height: 350px;
        object-fit: contain;
    background: #f7f7f7;
    display: block;
}

.product-info {
    flex: 1;
    padding: 1.5rem 1.2rem;
    background: var(--white);
    min-width: 260px;
    }

    .product-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.7rem;
    line-height: 1.2;
    }

.brand-badge {
    display: inline-flex;
        align-items: center;
    background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
    color: var(--white);
    padding: 0.3rem 0.8rem;
    border-radius: 18px;
    font-size: 0.85rem;
        font-weight: 600;
    margin-bottom: 1rem;
    }

.price-section {
    margin: 1.2rem 0 1rem 0;
    padding: 1rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 10px;
    color: var(--white);
    }

.price-main {
    font-size: 2rem;
    font-weight: 800;
    margin-bottom: 0.2rem;
    }

.price-label {
    font-size: 0.95rem;
    opacity: 0.9;
}

.stock-badge {
    background: linear-gradient(45deg, #2ecc71, #27ae60);
    color: var(--white);
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    font-size: 0.85rem;
    font-weight: 600;
    display: inline-flex;
        align-items: center;
    gap: 0.5rem;
    margin-bottom: 1rem;
    }

.form-group { margin-bottom: 1rem; }

.form-label {
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.3rem;
        display: flex;
        align-items: center;
    gap: 0.5rem;
    font-size: 0.97rem;
    }

.form-select, .form-control {
    border: 1.5px solid #e9ecef;
    border-radius: 8px;
    padding: 0.5rem 0.8rem;
    font-size: 0.97rem;
    background: var(--white);
    }

.form-select:focus, .form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.1rem rgba(255, 107, 53, 0.15);
        outline: none;
    }

.quantity-control {
        display: flex;
        align-items: center;
    gap: 0.7rem;
    background: var(--bg-light);
    padding: 0.7rem;
    border-radius: 10px;
    width: fit-content;
    }

    .quantity-btn {
    width: 32px;
    height: 32px;
    border: none;
    border-radius: 50%;
    background: var(--primary-color);
    color: var(--white);
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .quantity-btn:hover {
    background: var(--accent-color);
    transform: scale(1.08);
    }

    .quantity-input {
    width: 50px;
        text-align: center;
    border: none;
    background: transparent;
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-dark);
    }

.add-to-cart-btn {
        width: 100%;
    padding: 0.7rem 1.2rem;
    background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
    color: var(--white);
        border: none;
    border-radius: 10px;
    font-size: 1.05rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    gap: 0.5rem;
    margin-top: 1.2rem;
}

.add-to-cart-btn:hover {
    transform: translateY(-1px);
    box-shadow: var(--shadow-hover);
}

.product-details {
    background: var(--white);
    border-radius: 16px;
    box-shadow: var(--shadow);
    padding: 1.2rem 1rem;
    margin-bottom: 1.2rem;
    font-size: 0.98rem;
    }

.details-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.7rem;
        display: flex;
        align-items: center;
    gap: 0.5rem;
    }

.specs-list {
        list-style: none;
        padding: 0;
    font-size: 0.97rem;
    }

.specs-list li {
    padding: 0.7rem 0.2rem;
    border-bottom: 1px solid #e9ecef;
        display: flex;
        align-items: center;
    gap: 0.7rem;
    }

.specs-list li:last-child { border-bottom: none; }

.spec-icon {
    width: 28px;
    height: 28px;
    background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    font-size: 0.9rem;
}

.spec-content { flex: 1; }

.spec-label { font-weight: 600; color: var(--text-dark); margin-bottom: 0.1rem; }

.spec-value { color: var(--text-light); }

/* Reviews Section */
.reviews-section {
    background: var(--white);
    border-radius: 16px;
    box-shadow: var(--shadow);
    padding: 1.2rem 1rem;
    margin-bottom: 1.2rem;
}

.reviews-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.2rem;
    padding-bottom: 0.7rem;
    border-bottom: 1.5px solid #e9ecef;
}

.reviews-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--text-dark);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.rating-summary {
        display: flex;
        align-items: center;
    justify-content: flex-start;
    gap: 1rem;
    background: none;
    border-radius: 0;
    color: #223;
    font-size: 1rem;
    margin: 0.5rem 0 1.2rem 0;
    padding: 0;
}

.average-rating { font-size: 2rem; font-weight: 700; color: #223; }
.rating-stars { font-size: 1.5rem; color: #ffc107; }
#total-reviews { font-size: 1.1rem; color: #555; }

.review-form {
    background: var(--bg-light);
    border-radius: 10px;
    padding: 1rem;
    margin-top: 1.2rem;
    }

.star-rating {
    display: flex;
    gap: 0.3rem;
    margin: 0.7rem 0;
}

.star {
    font-size: 1.3rem;
    color: #ddd;
    cursor: pointer;
    transition: all 0.2s ease;
}

.star:hover, .star.selected {
    color: #ffc107;
    transform: scale(1.08);
}

.review-textarea {
    border: 1.5px solid #e9ecef;
    border-radius: 8px;
    padding: 0.7rem;
    font-size: 0.97rem;
    resize: vertical;
    min-height: 120px;
    width: 100%;
    transition: all 0.2s ease;
    }

.review-textarea:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.1rem rgba(255, 107, 53, 0.15);
    outline: none;
}

.submit-review-btn {
    background: linear-gradient(45deg, #2ecc71, #27ae60);
    color: var(--white);
    border: none;
    border-radius: 8px;
    padding: 0.7rem 1.2rem;
    font-size: 0.97rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.submit-review-btn:hover {
    transform: translateY(-1px);
    box-shadow: var(--shadow-hover);
}

.review-item {
    background: var(--bg-light);
    border-radius: 10px;
    padding: 1rem;
    margin-bottom: 0.7rem;
    font-size: 0.97rem;
}

.review-item:hover {
    transform: translateY(-1px);
    box-shadow: var(--shadow);
}

.review-header {
    display: flex;
    align-items: center;
    gap: 0.7rem;
    margin-bottom: 0.7rem;
}

.reviewer-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    font-weight: 700;
    font-size: 1rem;
}

.reviewer-info { flex: 1; }

.reviewer-name { font-weight: 600; color: var(--text-dark); margin-bottom: 0.1rem; }

.review-date { font-size: 0.85rem; color: var(--text-light); }

.review-rating { color: #ffc107; font-size: 1rem; }

.review-content { color: var(--text-dark); line-height: 1.5; margin-bottom: 0.5rem; }

.review-actions { display: flex; gap: 0.7rem; }

.action-btn {
    background: none;
    border: none;
    color: var(--text-light);
    cursor: pointer;
    padding: 0.3rem 0.7rem;
    border-radius: 15px;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.97rem;
}

.action-btn:hover {
    background: var(--primary-color);
    color: var(--white);
}

.form-row-2 {
    display: flex;
    gap: 1rem;
}
.form-row-2 .form-group {
    flex: 1 1 0;
    min-width: 0;
}
    @media (max-width: 768px) {
    .form-row-2 { flex-direction: column; gap: 0.5rem; }
}

@media (max-width: 900px) {
    .container.detail-container { max-width: 100%; }
    .product-hero { flex-direction: column; }
    .product-gallery { border-radius: 16px 16px 0 0; max-width: 100%; }
    }

@media (max-width: 768px) {
    .container.detail-container { padding: 0.5rem 0; }
    .product-hero { flex-direction: column; }
    .product-gallery { border-radius: 16px 16px 0 0; max-width: 100%; min-height: 220px; max-height: 220px; }
    .main-image { height: 220px; }
    .product-info { padding: 1rem 0.7rem; }
    .product-title { font-size: 1.1rem; }
    .price-main { font-size: 1.3rem; }
}

.comment-media-preview {
    display: flex;
    gap: 12px;
    margin-top: 10px;
    flex-wrap: wrap;
}
.comment-media-preview img,
.comment-media-preview video {
    width: 130px !important;
    height: 130px !important;
    object-fit: cover;
    border-radius: 12px;
    border: 1.5px solid #eee;
    background: #fafafa;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    transition: box-shadow 0.2s, border-color 0.2s;
}
.comment-media-preview img:hover,
.comment-media-preview video:hover {
    box-shadow: 0 4px 16px rgba(0,0,0,0.12);
    border-color: #ff6b35;
}
.comment-media-btn {
    background: none;
    border: none;
    color: #888;
    font-size: 1.3rem;
    cursor: pointer;
    margin-right: 8px;
    transition: color 0.2s;
}
.comment-media-btn:hover { color: var(--primary-color); }

.media-btn-round {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #f3f3f3;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    color: #888;
    font-size: 1.2rem;
    transition: background 0.2s, color 0.2s;
    box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        }
.media-btn-round:hover {
    background: var(--primary-color);
    color: #fff;
}
@media (max-width: 768px) {
    .comment-media-icons { left: 4px !important; bottom: 4px !important; gap: 4px !important; }
    .media-btn-round { width: 28px; height: 28px; font-size: 1rem; }
}

.comment-media-icons {
    position: absolute;
    left: 15px;
    bottom: 15px;
    display: flex;
    z-index: 2;
}
.comment-media-preview {
    display: flex;
            gap: 8px;
    margin-top: 10px;
    flex-wrap: wrap;
}
.comment-media-preview img,
.comment-media-preview video {
    width: 48px;
    height: 48px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #eee;
}

/* Modal xem ảnh lớn */
.image-modal {
  position: fixed;
  z-index: 9999;
  left: 0; top: 0; right: 0; bottom: 0;
  display: flex;
  align-items: center;
  justify-content: center;
}
.image-modal-overlay {
  position: absolute;
  left: 0; top: 0; right: 0; bottom: 0;
  background: rgba(0,0,0,0.6);
}
.image-modal-content {
  position: relative;
  z-index: 2;
  background: transparent;
  border-radius: 10px;
  max-width: 90vw;
  max-height: 90vh;
  display: flex;
  align-items: center;
  justify-content: center;
}
.image-modal-content img {
  max-width: 80vw;
  max-height: 80vh;
  border-radius: 10px;
  box-shadow: 0 4px 24px rgba(0,0,0,0.25);
}
.image-modal-close {
  position: absolute;
  top: -30px;
  right: 0;
  color: #fff;
  font-size: 2.2rem;
  font-weight: bold;
  cursor: pointer;
  z-index: 3;
  text-shadow: 0 2px 8px #000;
        }
@media (max-width: 600px) {
  .image-modal-content img { max-width: 98vw; max-height: 60vh; }
  .image-modal-content { max-width: 98vw; }
}

/* Cải thiện giao diện form trả lời */
.reply-form {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 1rem;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.reply-form:hover {
    border-color: var(--primary-color);
    box-shadow: 0 2px 8px rgba(255, 107, 53, 0.1);
}

.reply-to-comment-form {
    background: #f1f3f4;
    border-radius: 10px;
    padding: 0.8rem;
    border: 1px solid #dee2e6;
    margin-top: 0.5rem;
}

.reply-content {
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 0.7rem 0.7rem 2.5rem 0.7rem;
    font-size: 0.95rem;
    resize: vertical;
    min-height: 80px;
    width: 100%;
    transition: all 0.2s ease;
    background: #fff;
}

.reply-content:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.1rem rgba(255, 107, 53, 0.15);
    outline: none;
}

.reply-media-icons {
    position: absolute;
    left: 15px;
    bottom: 15px;
    display: flex;
    gap: 8px;
    z-index: 2;
}

.replyMediaPreview {
    margin-top: 0.5rem;
}

.replyMediaPreview img,
.replyMediaPreview video {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #dee2e6;
    margin-right: 8px;
    transition: transform 0.2s ease;
}

.replyMediaPreview img:hover,
.replyMediaPreview video:hover {
    transform: scale(1.05);
    border-color: var(--primary-color);
}

/* Animation cho việc hiển thị/ẩn form trả lời */
.reply-form,
.reply-to-comment-form {
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Cải thiện button gửi trả lời */
.submit-review-btn {
    transition: all 0.2s ease;
    position: relative;
    overflow: hidden;
}

.submit-review-btn:before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.submit-review-btn:hover:before {
    left: 100%;
}

/* Cải thiện hiển thị media trong bình luận */
.comment-media-preview {
    margin-top: 0.7rem;
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.comment-media-preview img,
.comment-media-preview video {
    cursor: pointer;
    transition: all 0.2s ease;
}

.comment-media-preview img:hover,
.comment-media-preview video:hover {
    transform: scale(1.02);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* Loading state cho buttons */
.submit-review-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.submit-review-btn:disabled:hover {
    transform: none;
    box-shadow: none;
}
</style>

<main class="container-fluid py-5">
    <div class="container">
        <!-- Product Hero Section -->
        <div class="row product-hero">
            <!-- Product Gallery -->
            <div class="col-lg-6 product-gallery">
                <img src="{{ asset('uploads/productimage/' . $product->image_address_product) }}" 
                     alt="{{ $product->name_product }}" 
                     class="main-image">
            </div>
            
            <!-- Product Info -->
            <div class="col-lg-6 product-info">
                <form id="addToCartForm" action="{{ route('cart.addCard') }}" method="post" class="form-detailproduct">
                    @csrf
                    <input type="hidden" name="id_product" value="{{ $product->id_product }}">
                    
                    <div class="brand-badge">
                        <i class="fa-solid fa-crown"></i>
                        {{ $manufacturer->name_manufacturer }}
                    </div>
                    
                    <h1 class="product-title">{{ $product->name_product }}</h1>
                    
                    <div class="price-section">
                        <div class="price-main">{{ number_format($product->price_product, 0, ',', '.') }} VND</div>
                        <div class="price-label">Giá bán</div>
                    </div>
                    
                    <div class="stock-badge">
                        <i class="fa-solid fa-box"></i>
                        Còn {{ $product->quantity_product }} sản phẩm
                    </div>
                    
                    <div class="form-row-2">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fa-solid fa-ruler"></i>
                                Kích thước
                            </label>
                            <select name="size" class="form-select" required>
                                <option value="" disabled selected>Chọn kích thước</option>
                                @if(isset($sizes) && is_array($sizes))
                                    @foreach($sizes as $size)
                                        <option value="{{ $size }}">{{ $size }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fa-solid fa-palette"></i>
                                Màu sắc
                            </label>
                            <select name="color" class="form-select" required>
                                <option value="" disabled selected>Chọn màu sắc</option>
                                @if(isset($colors) && is_array($colors))
                                    @foreach($colors as $color)
                                        <option value="{{ $color }}">{{ $color }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-solid fa-sort-numeric-up"></i>
                            Số lượng
                        </label>
                        <div class="quantity-control">
                            <button type="button" class="quantity-btn minus">-</button>
                            <input type="text" class="quantity-input" name="quantity_cart" id="quantity_cart" value="1" readonly>
                            <button type="button" class="quantity-btn plus">+</button>
                        </div>
                    </div>
                    
                    <button type="submit" class="add-to-cart-btn" id="addToCartBtn">
                        <i class="fa-solid fa-shopping-cart"></i>
                        Thêm vào giỏ hàng
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Product Details -->
        <div class="row">
            <div class="col-md-6">
                <div class="product-details">
                    <h3 class="details-title">
                        <i class="fa-solid fa-info-circle"></i>
                        Mô tả sản phẩm
                    </h3>
                    <p class="mb-0">{{ $product->describe_product }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-details">
                    <h3 class="details-title">
                        <i class="fa-solid fa-list"></i>
                        Thông số kỹ thuật
                    </h3>
                    <ul class="specs-list">
                        <li>
                            <div class="spec-icon">
                                <i class="fa-solid fa-globe"></i>
                            </div>
                            <div class="spec-content">
                                <div class="spec-label">Xuất xứ</div>
                                <div class="spec-value">{{ $specifications[0] ?? '-' }}</div>
                            </div>
                        </li>
                        <li>
                            <div class="spec-icon">
                                <i class="fa-solid fa-ruler-vertical"></i>
                            </div>
                            <div class="spec-content">
                                <div class="spec-label">Độ dài</div>
                                <div class="spec-value">{{ $specifications[1] ?? '-' }}</div>
                            </div>
                        </li>
                        <li>
                            <div class="spec-icon">
                                <i class="fa-solid fa-palette"></i>
                            </div>
                            <div class="spec-content">
                                <div class="spec-label">Màu sắc</div>
                                <div class="spec-value">{{ $specifications[2] ?? '-' }}</div>
                            </div>
                        </li>
                        <li>
                            <div class="spec-icon">
                                <i class="fa-solid fa-expand"></i>
                            </div>
                            <div class="spec-content">
                                <div class="spec-label">Kích thước</div>
                                <div class="spec-value">{{ $specifications[3] ?? '-' }}</div>
                            </div>
                        </li>
                        <li>
                            <div class="spec-icon">
                                <i class="fa-solid fa-shirt"></i>
                            </div>
                            <div class="spec-content">
                                <div class="spec-label">Phong cách</div>
                                <div class="spec-value">{{ $specifications[4] ?? '-' }}</div>
                            </div>
                        </li>
                        <li>
                            <div class="spec-icon">
                                <i class="fa-solid fa-layer-group"></i>
                            </div>
                            <div class="spec-content">
                                <div class="spec-label">Chất liệu</div>
                                <div class="spec-value">{{ $specifications[5] ?? '-' }}</div>
                            </div>
                        </li>
                        <li>
                            <div class="spec-icon">
                                <i class="fa-solid fa-calendar-alt"></i>
                            </div>
                            <div class="spec-content">
                                <div class="spec-label">Ngày sản xuất</div>
                                <div class="spec-value">{{ $specifications[6] ?? '-' }}</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Reviews Section -->
        <div class="reviews-section">
            <div class="reviews-header">
                <h3 class="reviews-title">
                    <i class="fa-solid fa-star"></i>
                    Đánh giá sản phẩm
                </h3>
            </div>
            <div class="rating-summary" id="rating-summary-box"></div>
            <div class="rating-filter" style="display: flex; gap: 0.7rem; margin-bottom: 1.2rem;">
                <button class="btn btn-outline-danger rating-filter-btn active" data-star="all">Tất Cả</button>
                <button class="btn btn-outline-secondary rating-filter-btn" data-star="5">5 Sao</button>
                <button class="btn btn-outline-secondary rating-filter-btn" data-star="4">4 Sao</button>
                <button class="btn btn-outline-secondary rating-filter-btn" data-star="3">3 Sao</button>
                <button class="btn btn-outline-secondary rating-filter-btn" data-star="2">2 Sao</button>
                <button class="btn btn-outline-secondary rating-filter-btn" data-star="1">1 Sao</button>
            </div>
            <div id="review-list"></div>
            
            <div class="review-form">
                <h4 class="mb-3">Viết đánh giá của bạn</h4>
                <div id="review-error" class="alert alert-danger" style="display:none"></div>
                <form id="review-form" enctype="multipart/form-data">
                    <input type="hidden" name="id_product" value="{{ $product->id_product }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <div class="form-group">
                        <label class="form-label">Số sao:</label>
                        <div class="star-rating" id="star-rating">
                            @for($i=1; $i<=5; $i++)
                                <i class="fa fa-star star" data-value="{{ $i }}"></i>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="rating" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Nội dung:</label>
                        <div style="position: relative;">
                            <textarea name="content" id="content" class="review-textarea" placeholder="Hãy chia sẻ cảm nhận của bạn về sản phẩm..." required style="padding-left: 20px; padding-bottom: 40px;"></textarea>
                            <div class="comment-media-icons" style="position: absolute; left: 15px; bottom: 15px; display: flex; z-index:2;">
                                <button type="button" class="comment-media-btn media-btn-round" id="addImageBtn" title="Thêm ảnh"><i class="fa-regular fa-image"></i></button>
                                <button type="button" class="comment-media-btn media-btn-round" id="addVideoBtn" title="Thêm video"><i class="fa-solid fa-video"></i></button>
                            </div>
                            <input type="file" id="imageInput" name="media[]" accept="image/*" multiple style="display:none">
                            <input type="file" id="videoInput" name="media[]" accept="video/*" multiple style="display:none">
                        </div>
                    </div>
                    
                    <div class="comment-media-preview" id="mediaPreview"></div>
                    
                    <button type="submit" class="submit-review-btn">
                        <i class="fa-solid fa-paper-plane"></i>
                        Gửi đánh giá
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

<!-- Modal xem ảnh lớn -->
<div id="imageModal" class="image-modal" style="display:none;">
  <div class="image-modal-overlay"></div>
  <div class="image-modal-content">
    <span class="image-modal-close">&times;</span>
    <img id="imageModalImg" src="" alt="Ảnh lớn" />
  </div>
</div>

{{-- Script thêm vào giỏ hàng bằng AJAX + SweetAlert2 --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    var productId = {{ $product->id_product }};
    var csrfToken = $('input[name="_token"]').val();
    let selectedRating = 0;
    let hasScrolledToReview = false;
    
    // Quantity controls
    $('.quantity-btn.plus').click(function() {
        var currentVal = parseInt($('#quantity_cart').val());
        $('#quantity_cart').val(currentVal + 1);
    });
    
    $('.quantity-btn.minus').click(function() {
        var currentVal = parseInt($('#quantity_cart').val());
        if (currentVal > 1) {
            $('#quantity_cart').val(currentVal - 1);
        }
    });
    
    // Star rating
    $('#star-rating .star').on('mouseenter', function() {
        let val = $(this).data('value');
        $('#star-rating .star').each(function(idx) {
            $(this).toggleClass('selected', idx < val);
        });
    }).on('mouseleave', function() {
        $('#star-rating .star').each(function(idx) {
            $(this).toggleClass('selected', idx < selectedRating);
        });
    });

    $('#star-rating .star').on('click', function() {
        selectedRating = $(this).data('value');
        $('#rating').val(selectedRating);
        $('#star-rating .star').each(function(idx) {
            $(this).toggleClass('selected', idx < selectedRating);
        });
    });

    function timeAgo(dateStr) {
        let date = new Date(dateStr);
        let now = new Date();
        let diff = Math.floor((now - date) / 1000);
        if (diff < 60) return diff + ' giây trước';
        if (diff < 3600) return Math.floor(diff/60) + ' phút trước';
        if (diff < 86400) return Math.floor(diff/3600) + ' giờ trước';
        return date.toLocaleDateString('vi-VN');
    }
    
    let allReviewsData = [];
    function formatCount(n) {
        if (n >= 1000) return (n/1000).toFixed(1).replace('.0','') + 'k';
        return n;
    }
    function renderRatingFilter(currentStar = 'all') {
        var counts = {1:0,2:0,3:0,4:0,5:0};
        allReviewsData.forEach(function(r) {
            counts[r.rating] = (counts[r.rating]||0)+1;
        });
        var html = '';
        var allClass = currentStar === 'all' ? 'btn-outline-danger active' : 'btn-outline-secondary';
        html += '<button class="btn rating-filter-btn ' + allClass + '" data-star="all">Tất Cả</button>';

        for(var i=5; i>=1; i--) {
            var btnClass = currentStar == i ? 'btn-outline-danger active' : 'btn-outline-secondary';
            html += '<button class="btn rating-filter-btn ' + btnClass + '" data-star="' + i + '">' + i + ' Sao (' + formatCount(counts[i]) + ')</button>';
        }
        $(".rating-filter").html(html);
    }
    function renderCommentTree(comment, level = 0, reviewId = null) {
        var margin = 2 + level * 2;
        var hasChildren = comment.children && comment.children.length > 0;
        var userName = comment.user ? comment.user.name : 'Ẩn danh';
        var userInitial = userName.charAt(0).toUpperCase();
        var userAvatar = comment.user && comment.user.avatar_url ? comment.user.avatar_url : null;
        var mediaHtml = renderMedia(comment.media);
        var likeCount = comment.likes ? comment.likes.length : 0;
        var childrenHtml = '';

        if (comment.children && comment.children.length > 0) {
            // Hiển thị tất cả children nhưng sẽ bị ẩn bởi CSS display:none
            childrenHtml = comment.children.map(function(child) {
                return renderCommentTree(child, level + 1, reviewId || comment.review_id);
            }).join('');
        }

        var toggleBtn = hasChildren ? '<button class="toggle-children-btn btn btn-link btn-sm" data-id="' + comment.id + '" style="padding:0 0.5rem;">Xem trả lời</button>' : '';

        // Tạo avatar HTML
        var avatarHtml = '';
        if (userAvatar) {
            avatarHtml = '<img src="' + userAvatar + '" alt="' + userName + '" style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover;">';
        } else {
            avatarHtml = '<div class="reviewer-avatar" style="width: 30px; height: 30px; font-size: 0.8rem;">' + userInitial + '</div>';
        }

        return '<div class="review-item review-comment-item" style="margin-left: ' + margin + 'rem; border-radius: 8px; background: none; box-shadow: none; padding: 0.7rem 0 0.7rem 0.7rem;" data-comment-id="' + comment.id + '" data-review-id="' + (reviewId || comment.review_id) + '">' +
            '<div class="review-header" style="gap: 0.5rem;">' +
                '<div style="width: 30px; height: 30px;">' + avatarHtml + '</div>' +
                '<div class="reviewer-info">' +
                    '<div class="reviewer-name">' + userName + '</div>' +
                    '<div class="review-date">' + timeAgo(comment.created_at) + '</div>' +
                '</div>' +
            '</div>' +
            '<div class="review-content">' + comment.content + '</div>' +
            mediaHtml +
            '<div class="review-actions" style="margin-top: 0.3rem;">' +
                '<button class="action-btn like-comment-btn" data-id="' + comment.id + '"><i class="fa fa-thumbs-up"></i> <span class="like-count">' + likeCount + '</span></button>' +
                '<button class="action-btn reply-comment-btn" data-id="' + comment.id + '"><i class="fa fa-reply"></i> Trả lời</button>' +
                toggleBtn +
            '</div>' +
            '<div class="reply-form mt-2 reply-to-comment-form" id="reply-to-comment-form-' + comment.id + '" style="display:none; margin-left:2rem;">' +
                '<div style="position: relative;">' +
                    '<textarea class="review-textarea reply-content" rows="2" placeholder="Nhập trả lời..."></textarea>' +
                    '<div class="comment-media-icons reply-media-icons" style="position: absolute; left: 15px; bottom: 15px; display: flex; z-index:2;">' +
                        '<button type="button" class="comment-media-btn media-btn-round addReplyImageBtn" data-id="' + comment.id + '" title="Thêm ảnh"><i class="fa-regular fa-image"></i></button>' +
                        '<button type="button" class="comment-media-btn media-btn-round addReplyVideoBtn" data-id="' + comment.id + '" title="Thêm video"><i class="fa-solid fa-video"></i></button>' +
                    '</div>' +
                    '<input type="file" class="replyImageInput" data-id="' + comment.id + '" accept="image/*" multiple style="display:none">' +
                    '<input type="file" class="replyVideoInput" data-id="' + comment.id + '" accept="video/*" multiple style="display:none">' +
                '</div>' +
                '<div class="comment-media-preview replyMediaPreview" id="replyMediaPreview-' + comment.id + '"></div>' +
                '<button class="submit-review-btn send-reply-to-comment-btn" data-id="' + comment.id + '" style="margin-top: 0.5rem;"><i class="fa fa-paper-plane"></i> Gửi trả lời</button>' +
            '</div>' +
            '<div class="review-children" id="review-children-' + comment.id + '" style="display:none;">' +
                childrenHtml +
            '</div>' +
        '</div>';
    }
    function renderMainReviews(reviews) {
        var html = '';
        var showCount = 5; // Hiển thị 5 review đầu tiên
        var total = reviews.length;
        var toShow = reviews.slice(0, showCount);

        toShow.forEach(function(review) {
            html += renderReviewItem(review);
        });

        if (total > showCount) {
            html += '<div class="show-more-main-reviews-btn" style="margin: 1rem 0; text-align:center;"><a href="#" class="btn btn-link">Xem thêm đánh giá (' + (total - showCount) + ')</a></div>';
        }
        return html;
    }
    function renderReviewItem(review) {
        var userName = review.user ? review.user.name : 'Ẩn danh';
        var userInitial = userName.charAt(0).toUpperCase();
        var userAvatar = review.user && review.user.avatar_url ? review.user.avatar_url : null;
        var stars = '★'.repeat(review.rating) + '☆'.repeat(5-review.rating);
        var mediaHtml = renderMedia(review.media);
        var commentsHtml = renderCommentTreeLimited(review.comments || [], 0, review.id);

        // Tạo avatar HTML
        var avatarHtml = '';
        if (userAvatar) {
            avatarHtml = '<img src="' + userAvatar + '" alt="' + userName + '" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">';
        } else {
            avatarHtml = '<div class="reviewer-avatar">' + userInitial + '</div>';
        }

        return '<div class="review-item" id="review-' + review.id + '" data-review-id="' + review.id + '">' +
            '<div class="review-header">' +
                '<div style="width: 32px; height: 32px;">' + avatarHtml + '</div>' +
                '<div class="reviewer-info">' +
                    '<div class="reviewer-name">' + userName + '</div>' +
                    '<div class="review-rating">' + stars + '</div>' +
                    '<div class="review-date">' + timeAgo(review.created_at) + '</div>' +
                '</div>' +
            '</div>' +
            '<div class="review-content">' + review.content + '</div>' +
            mediaHtml +
            '<div class="review-actions">' +
                '<button class="action-btn like-btn" data-id="' + review.id + '"><i class="fa fa-thumbs-up"></i> <span class="like-count">' + review.likes.length + '</span></button>' +
                '<button class="action-btn reply-btn" data-id="' + review.id + '"><i class="fa fa-reply"></i> Trả lời</button>' +
            '</div>' +
            '<div class="review-comments mt-3">' + commentsHtml + '</div>' +
            '<div class="reply-form mt-3" id="reply-form-' + review.id + '" style="display:none;">' +
                '<div style="position: relative;">' +
                    '<textarea class="review-textarea reply-content" rows="2" placeholder="Nhập trả lời..."></textarea>' +
                    '<div class="comment-media-icons reply-media-icons" style="position: absolute; left: 15px; bottom: 15px; display: flex; z-index:2;">' +
                        '<button type="button" class="comment-media-btn media-btn-round addReplyImageBtn" data-id="' + review.id + '" title="Thêm ảnh"><i class="fa-regular fa-image"></i></button>' +
                        '<button type="button" class="comment-media-btn media-btn-round addReplyVideoBtn" data-id="' + review.id + '" title="Thêm video"><i class="fa-solid fa-video"></i></button>' +
                    '</div>' +
                    '<input type="file" class="replyImageInput" data-id="' + review.id + '" accept="image/*" multiple style="display:none">' +
                    '<input type="file" class="replyVideoInput" data-id="' + review.id + '" accept="video/*" multiple style="display:none">' +
                '</div>' +
                '<div class="comment-media-preview replyMediaPreview" id="replyMediaPreview-' + review.id + '"></div>' +
                '<button class="submit-review-btn send-reply-btn" data-id="' + review.id + '" style="margin-top: 1rem;">' +
                    '<i class="fa fa-paper-plane"></i> Gửi trả lời' +
                '</button>' +
            '</div>' +
        '</div>';
    }
    function renderCommentTreeLimited(comments, level = 0, reviewId = null) {
        if (!comments || comments.length === 0) return '';

        var html = '';
        var showCount = 2; // Hiển thị 2 comment đầu tiên
        var total = comments.length;
        var toShow = comments.slice(0, showCount);

        // Hiển thị comments giới hạn
        toShow.forEach(function(c) {
            html += renderCommentTree(c, level, reviewId);
        });

        // Thêm nút "Xem thêm" nếu có nhiều hơn showCount comments
        if (total > showCount) {
            var marginLeft = 2 + level * 2;
            html += '<div class="show-more-comments-btn" data-review-id="' + reviewId + '" data-level="' + level + '" data-total="' + total + '" data-shown="' + showCount + '" style="margin-left:' + marginLeft + 'rem; color:#007bff; cursor:pointer; font-size:0.95rem; margin-top:0.5rem; padding: 0.3rem 0.5rem; border: 1px solid #007bff; border-radius: 4px; display: inline-block;">📄 Xem thêm bình luận (' + (total - showCount) + ')</div>';
        }

        return html;
    }
    function loadReviews(showAll = false, filterStar = 'all') {
        const hasReviewHash = window.location.hash && window.location.hash.startsWith('#review-');

        $.get('/product/' + productId + '/reviews', function(data) {
            allReviewsData = data;
            renderRatingFilter(filterStar);
            let reviews = data;
            if (filterStar !== 'all') {
                reviews = data.filter(r => r.rating == filterStar);
            }
            let html = renderMainReviews(reviews);
            $('#review-list').html(html);

            if (hasReviewHash && !hasScrolledToReview) {
                const reviewId = window.location.hash;
                const targetReview = $(reviewId);
                if (targetReview.length) {
                    hasScrolledToReview = true; 
                    $('html, body').animate({
                        scrollTop: targetReview.offset().top - 100 
                    }, 800, 'swing', function() {
                        
                        targetReview.css('transition', 'background-color 0.5s, box-shadow 0.5s');
                        targetReview.css('background-color', '#fff9e6');
                        targetReview.css('box-shadow', '0 0 0 4px #ffc107'); 
                        
                        setTimeout(() => {
                            targetReview.css('background-color', ''); 
                            targetReview.css('box-shadow', '');
                        }, 2500);
                    });
                }
            }
            // Luôn hiển thị tổng số sao trung bình và tổng số đánh giá từ allReviewsData
            var allTotal = allReviewsData.length;
            var allSum = 0;
            allReviewsData.forEach(function(r) { allSum += r.rating; });
            var avg = allTotal ? (allSum/allTotal) : 0;
            var summaryHtml = '<span class="average-rating" style="font-size:2rem;font-weight:700;color:#223;">' + avg.toFixed(1) + '</span>' +
                '<span class="rating-stars" style="font-size:1.5rem;vertical-align:middle;">' + renderAverageStars(avg) + '</span>' +
                '<span id="total-reviews" style="font-size:1.1rem;color:#555;">(' + allTotal + ' đánh giá)</span>';
            $('#rating-summary-box').html(summaryHtml);
        });
    }
    
    // Gọi mặc định
    loadReviews();

    // Lắng nghe sự kiện click nút Xem thêm
    $(document).on('click', '#showMoreReviews', function() {
        loadReviews(true);
    });
    
    // Media upload preview
    $('#addImageBtn').on('click', function() {
        $('#imageInput').click();
    });
    $('#addVideoBtn').on('click', function() {
        $('#videoInput').click();
    });
    function handleMediaInput(input) {
        const files = input.files;
        const preview = $('#mediaPreview');
        preview.html('');

        if (files && files.length) {
            // Kiểm tra số lượng file (tối đa 5 file)
            if (files.length > 5) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Quá nhiều file!',
                    text: 'Bạn chỉ có thể tải lên tối đa 5 file.',
                    timer: 3000,
                    showConfirmButton: false
                });
                input.value = '';
                return;
            }

            Array.from(files).forEach(file => {
                // Kiểm tra kích thước file (tối đa 10MB)
                if (file.size > 10 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'File quá lớn!',
                        text: 'File "' + file.name + '" vượt quá 10MB. Vui lòng chọn file nhỏ hơn.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                    input.value = '';
                    return;
                }

                if (file.type.startsWith('image/')) {
                    // Kiểm tra định dạng ảnh hợp lệ
                    const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
                    if (!validImageTypes.includes(file.type)) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Định dạng không hỗ trợ!',
                            text: 'Chỉ hỗ trợ các định dạng ảnh: JPG, JPEG, PNG, GIF, WEBP',
                            timer: 3000,
                            showConfirmButton: false
                        });
                        input.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(ev) {
                        preview.append('<img src="' + ev.target.result + '" alt="img">');
                    };
                    reader.readAsDataURL(file);
                } else if (file.type.startsWith('video/')) {
                    // Kiểm tra định dạng video hợp lệ
                    const validVideoTypes = ['video/mp4', 'video/avi', 'video/mov', 'video/wmv', 'video/webm'];
                    if (!validVideoTypes.includes(file.type)) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Định dạng không hỗ trợ!',
                            text: 'Chỉ hỗ trợ các định dạng video: MP4, AVI, MOV, WMV, WEBM',
                            timer: 3000,
                            showConfirmButton: false
                        });
                        input.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(ev) {
                        preview.append('<video src="' + ev.target.result + '" controls></video>');
                    };
                    reader.readAsDataURL(file);
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Định dạng không hỗ trợ!',
                        text: 'Chỉ hỗ trợ file ảnh và video.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                    input.value = '';
                    return;
                }
            });
        }
    }
    $('#imageInput').on('change', function(e) { handleMediaInput(this); });
    $('#videoInput').on('change', function(e) { handleMediaInput(this); });
    
    // Submit review with media
    $('#review-form').submit(function(e) {
        e.preventDefault();
        $('#review-error').hide();
        if (!$('#rating').val()) {
            $('#review-error').text('Vui lòng chọn số sao!').show();
                return;
            }
        var formData = new FormData(this);
            $.ajax({
            url: '/reviews',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
            xhrFields: { withCredentials: true },
            success: function() {
                $('#content').val('');
                $('#rating').val('');
                $('#imageInput').val('');
                $('#videoInput').val('');
                $('#mediaPreview').html('');
                selectedRating = 0;
                $('#star-rating .star').removeClass('selected');
                loadReviews();
                },
            error: function(xhr) {
                if(xhr.status === 401) {
                    $('#review-error').text('Bạn cần đăng nhập để đánh giá sản phẩm!').show();
                } else if(xhr.status === 419) {
                    $('#review-error').text('Lỗi bảo mật (CSRF). Vui lòng tải lại trang!').show();
                } else {
                    $('#review-error').text('Đã xảy ra lỗi, vui lòng thử lại!').show();
                }
                }
            });
        });

    // Like review
    $(document).on('click', '.like-btn', function() {
        var reviewId = $(this).data('id');
            $.ajax({
            url: '/reviews/like',
            type: 'POST',
            data: {review_id: reviewId, _token: csrfToken},
            xhrFields: { withCredentials: true },
            success: function() {
                loadReviews();
                }
            });
        });

    // Show reply form
    $(document).on('click', '.reply-btn', function() {
        var reviewId = $(this).data('id');
        $('.reply-form').hide();
        $('#reply-form-' + reviewId).show();
    });

    // Send reply to review (main review)
    $(document).on('click', '.send-reply-btn', function() {
        var reviewId = $(this).data('id');
        var replyForm = $('#reply-form-' + reviewId);
        var content = replyForm.find('textarea.reply-content').val();
        var btn = $(this);

        if(content.trim() === '') {
            Swal.fire({
                icon: 'warning',
                title: 'Thông báo',
                text: 'Vui lòng nhập nội dung trả lời!',
                timer: 2000,
                showConfirmButton: false
            });
            return;
        }

        // Hiển thị loading state
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Đang gửi...');

        var formData = new FormData();
        formData.append('review_id', reviewId);
        formData.append('content', content);
        formData.append('_token', csrfToken);
        formData.append('parent_id', null); // Trả lời trực tiếp review, không có parent

        // Thêm file ảnh
        var imgFiles = replyForm.find('.replyImageInput')[0].files;
        for (let i = 0; i < imgFiles.length; i++) {
            formData.append('media[]', imgFiles[i]);
        }
        // Thêm file video
        var vidFiles = replyForm.find('.replyVideoInput')[0].files;
        for (let i = 0; i < vidFiles.length; i++) {
            formData.append('media[]', vidFiles[i]);
        }

        $.ajax({
            url: '/reviews/comment',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhrFields: { withCredentials: true },
            success: function() {
                // Reset form
                replyForm.find('textarea.reply-content').val('');
                replyForm.find('.replyImageInput').val('');
                replyForm.find('.replyVideoInput').val('');
                replyForm.find('.replyMediaPreview').html('');
                replyForm.hide();

                // Hiển thị thông báo thành công
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: 'Trả lời của bạn đã được gửi!',
                    timer: 1500,
                    showConfirmButton: false
                });

                loadReviews();
            },
            error: function(xhr) {
                let errorMsg = 'Đã xảy ra lỗi, vui lòng thử lại!';
                if(xhr.status === 401) {
                    errorMsg = 'Bạn cần đăng nhập để trả lời đánh giá!';
                } else if(xhr.status === 419) {
                    errorMsg = 'Lỗi bảo mật (CSRF). Vui lòng tải lại trang!';
                } else if(xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: errorMsg,
                    timer: 3000,
                    showConfirmButton: false
                });
            },
            complete: function() {
                // Khôi phục trạng thái button
                btn.prop('disabled', false).html('<i class="fa fa-paper-plane"></i> Gửi trả lời');
            }
        });
    });

    // Send reply to comment
    $(document).on('click', '.send-reply-to-comment-btn', function() {
        var commentId = $(this).data('id');
        var replyForm = $('#reply-to-comment-form-' + commentId);
        var content = replyForm.find('textarea.reply-content').val();
        var btn = $(this);

        if(content.trim() === '') {
            Swal.fire({
                icon: 'warning',
                title: 'Thông báo',
                text: 'Vui lòng nhập nội dung trả lời!',
                timer: 2000,
                showConfirmButton: false
            });
            return;
        }

        // Hiển thị loading state
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Đang gửi...');

        var formData = new FormData();
        // Lấy review_id gốc từ thuộc tính data-review-id của comment cha
        var reviewId = replyForm.closest('.review-item').attr('data-review-id');

        // Debug logging
        console.log('Comment ID:', commentId);
        console.log('Review ID:', reviewId);
        console.log('Content:', content);
        console.log('CSRF Token:', csrfToken);

        if (!reviewId) {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: 'Không tìm thấy ID đánh giá. Vui lòng tải lại trang!',
                timer: 3000,
                showConfirmButton: false
            });
            btn.prop('disabled', false).html('<i class="fa fa-paper-plane"></i> Gửi trả lời');
            return;
        }

        formData.append('review_id', reviewId);
        formData.append('content', content);
        formData.append('_token', csrfToken);
        formData.append('parent_id', commentId);

        // Thêm file ảnh
        var imgFiles = replyForm.find('.replyImageInput')[0].files;
        for (let i = 0; i < imgFiles.length; i++) {
            formData.append('media[]', imgFiles[i]);
        }
        // Thêm file video
        var vidFiles = replyForm.find('.replyVideoInput')[0].files;
        for (let i = 0; i < vidFiles.length; i++) {
            formData.append('media[]', vidFiles[i]);
        }

        $.ajax({
            url: '/reviews/comment',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhrFields: { withCredentials: true },
            success: function() {
                // Reset form
                replyForm.find('textarea.reply-content').val('');
                replyForm.find('.replyImageInput').val('');
                replyForm.find('.replyVideoInput').val('');
                replyForm.find('.replyMediaPreview').html('');
                replyForm.hide();

                // Hiển thị thông báo thành công
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: 'Trả lời của bạn đã được gửi!',
                    timer: 1500,
                    showConfirmButton: false
                });

                loadReviews();
            },
            error: function(xhr) {
                console.log('AJAX Error:', xhr);
                console.log('Status:', xhr.status);
                console.log('Response:', xhr.responseText);

                let errorMsg = 'Đã xảy ra lỗi, vui lòng thử lại!';
                if(xhr.status === 401) {
                    errorMsg = 'Bạn cần đăng nhập để trả lời bình luận!';
                } else if(xhr.status === 419) {
                    errorMsg = 'Lỗi bảo mật (CSRF). Vui lòng tải lại trang!';
                } else if(xhr.status === 422) {
                    // Validation errors
                    if(xhr.responseJSON && xhr.responseJSON.errors) {
                        let errors = xhr.responseJSON.errors;
                        errorMsg = Object.values(errors).flat().join(', ');
                    } else {
                        errorMsg = 'Dữ liệu không hợp lệ!';
                    }
                } else if(xhr.responseJSON && xhr.responseJSON.error) {
                    errorMsg = xhr.responseJSON.error;
                } else if(xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: errorMsg,
                    timer: 5000,
                    showConfirmButton: true
                });
            },
            complete: function() {
                // Khôi phục trạng thái button
                btn.prop('disabled', false).html('<i class="fa fa-paper-plane"></i> Gửi trả lời');
            }
        });
    });

    // Toggle ẩn/hiện nhánh trả lời
    $(document).on('click', '.toggle-children-btn', function() {
        var commentId = $(this).data('id');
        var childrenBox = $('#review-children-' + commentId);
        var $btn = $(this);

        if(childrenBox.is(':visible')) {
            childrenBox.slideUp(200);
            $btn.text('Xem trả lời');
        } else {
            childrenBox.slideDown(200);
            $btn.text('Ẩn trả lời');
        }
    });

    // Hiển thị media trong bình luận
    function renderMedia(media) {
        if (!media || !media.length) return '';
        return '<div class="comment-media-preview">' + media.map(function(m) {
            if (m.type && m.type.startsWith('image/')) {
                return '<img src="' + m.url + '" alt="img">';
            } else if (m.type && m.type.startsWith('video/')) {
                return '<video src="' + m.url + '" controls></video>';
            }
            return '';
        }).join('') + '</div>';
    }

    function renderAverageStars(avg) {
        avg = Math.round(avg * 10) / 10;
        let full = Math.floor(avg);
        let half = (avg - full) >= 0.25 && (avg - full) < 0.75 ? 1 : 0;
        let empty = 5 - full - half;
        let html = '';
        for (let i = 0; i < full; i++) html += '<i class="fa-solid fa-star" style="color:#ffc107"></i>';
        if (half) html += '<i class="fa-solid fa-star-half-stroke" style="color:#ffc107"></i>';
        for (let i = 0; i < empty; i++) html += '<i class="fa-regular fa-star" style="color:#ffc107"></i>';
        return html;
    }

    // Preview media cho từng reply-form
    $(document).on('click', '.addReplyImageBtn', function() {
        var id = $(this).data('id');
        $('.replyImageInput[data-id="'+id+'"]').click();
    });
    $(document).on('click', '.addReplyVideoBtn', function() {
        var id = $(this).data('id');
        $('.replyVideoInput[data-id="'+id+'"]').click();
    });
    $(document).on('change', '.replyImageInput', function() {
        var id = $(this).data('id');
        handleReplyMediaInput(this, id);
    });
    $(document).on('change', '.replyVideoInput', function() {
        var id = $(this).data('id');
        handleReplyMediaInput(this, id);
    });
    function handleReplyMediaInput(input, id) {
        const files = input.files;
        const preview = $('#replyMediaPreview-' + id);
        preview.html('');

        if (files && files.length) {
            // Kiểm tra số lượng file (tối đa 5 file)
            if (files.length > 5) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Quá nhiều file!',
                    text: 'Bạn chỉ có thể tải lên tối đa 5 file.',
                    timer: 3000,
                    showConfirmButton: false
                });
                input.value = '';
                return;
            }

            Array.from(files).forEach(file => {
                // Kiểm tra kích thước file (tối đa 10MB)
                if (file.size > 10 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'File quá lớn!',
                        text: 'File "' + file.name + '" vượt quá 10MB. Vui lòng chọn file nhỏ hơn.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                    input.value = '';
                    return;
                }

                if (file.type.startsWith('image/')) {
                    // Kiểm tra định dạng ảnh hợp lệ
                    const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
                    if (!validImageTypes.includes(file.type)) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Định dạng không hỗ trợ!',
                            text: 'Chỉ hỗ trợ các định dạng ảnh: JPG, JPEG, PNG, GIF, WEBP',
                            timer: 3000,
                            showConfirmButton: false
                        });
                        input.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(ev) {
                        preview.append('<img src="' + ev.target.result + '" alt="img">');
                    };
                    reader.readAsDataURL(file);
                } else if (file.type.startsWith('video/')) {
                    // Kiểm tra định dạng video hợp lệ
                    const validVideoTypes = ['video/mp4', 'video/avi', 'video/mov', 'video/wmv', 'video/webm'];
                    if (!validVideoTypes.includes(file.type)) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Định dạng không hỗ trợ!',
                            text: 'Chỉ hỗ trợ các định dạng video: MP4, AVI, MOV, WMV, WEBM',
                            timer: 3000,
                            showConfirmButton: false
                        });
                        input.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(ev) {
                        preview.append('<video src="' + ev.target.result + '" controls></video>');
                    };
                    reader.readAsDataURL(file);
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Định dạng không hỗ trợ!',
                        text: 'Chỉ hỗ trợ file ảnh và video.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                    input.value = '';
                    return;
                }
            });
        }
    }

    // Thêm JS sự kiện:
    $(document).on('click', '.reply-comment-btn', function() {
        var commentId = $(this).data('id');
        $('.reply-to-comment-form').hide();
        $('#reply-to-comment-form-' + commentId).show();
    });
    $(document).on('click', '.like-comment-btn', function() {
        var commentId = $(this).data('id');
            $.ajax({
            url: '/reviews/comment/like',
            type: 'POST',
            data: {comment_id: commentId, _token: csrfToken},
            xhrFields: { withCredentials: true },
            success: function() {
                loadReviews();
            }
        });
    });

    // Thêm JS sự kiện:
    $(document).on('click', '.show-all-comments-btn', function() {
        var reviewId = $(this).data('id');
        // Lấy lại data từ biến data đã load (nếu có), hoặc gọi lại API chỉ lấy reply cho review này
        $.get('/product/' + productId + '/reviews', function(data) {
            var review = data.find(r => r.id == reviewId);
            if (!review) return;
            // Render lại toàn bộ reply cho review này
            var html = '';
            (review.comments || []).forEach(function(c) {
                html += renderCommentTree(c, 0);
            });
            var box = $(".show-all-comments-btn[data-id='"+reviewId+"']").closest('.review-comments');
            box.html(html);
        });
    });
    $(document).on('click', '.show-all-children-btn', function() {
        var commentId = $(this).data('id');
        // Lấy lại data từ API
        $.get('/product/' + productId + '/reviews', function(data) {
            var comment;
            data.forEach(function(r) {
                (r.comments || []).forEach(function(c) {
                    if (c.id == commentId) comment = c;
                });
            });
            if (!comment) return;
            var html = '';
            (comment.children || []).forEach(function(child) {
                html += renderCommentTree(child, 0);
            });
            var box = $(".show-all-children-btn[data-id='"+commentId+"']").closest('.review-children');
            box.html(html);
        });
    });

    // Thêm JS filter review theo số sao
    $(document).on('click', '.rating-filter-btn', function() {
        let star = $(this).data('star');
        loadReviews(false, star);
    });

    // AJAX thêm vào giỏ hàng
    $('#addToCartForm').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var btn = $('#addToCartBtn');
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Đang thêm...');
            $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(res) {
                if(res.success) {
                    // Sử dụng hệ thống thông báo tùy chỉnh thay vì SweetAlert2
                    if (typeof window.showCartNotification === 'function') {
                        window.showCartNotification('Đã thêm sản phẩm vào giỏ hàng!', btn[0]);
                    } else {
                        // Fallback nếu function chưa load
                        Swal.fire({
                            icon: 'success',
                            title: 'Đã thêm vào giỏ hàng!',
                            text: res.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }

                    // Cập nhật số lượng giỏ hàng trên badge
                    if($('.cart-badge').length && res.cartCount !== undefined) {
                        $('.cart-badge').text(res.cartCount);
                        // Thêm animation cho badge
                        $('.cart-badge').css('animation', 'none');
                        $('.cart-badge')[0].offsetHeight; // trigger reflow
                        $('.cart-badge').css('animation', 'badgePulse 0.3s ease-in-out');
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: res.message || 'Không thể thêm vào giỏ hàng!'
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Có lỗi xảy ra khi thêm vào giỏ hàng!'
                });
            },
            complete: function() {
                btn.prop('disabled', false).html('<i class=\'fa-solid fa-shopping-cart\'></i> Thêm vào giỏ hàng');
            }
        });
    });

    // Sự kiện xem thêm/ẩn bớt đánh giá chính
    $(document).on('click', '.show-more-main-reviews-btn', function(e) {
        e.preventDefault();
        var reviews = allReviewsData;
        var html = '';
        reviews.forEach(function(review) {
            html += renderReviewItem(review);
        });
        html += '<div class="hide-main-reviews-btn" style="margin: 1rem 0; text-align:center;"><a href="#" class="btn btn-link">Ẩn bớt đánh giá</a></div>';
        $('#review-list').html(html);
    });
    $(document).on('click', '.hide-main-reviews-btn', function(e) {
        e.preventDefault();
        var html = renderMainReviews(allReviewsData);
        $('#review-list').html(html);
    });



    // Sự kiện xem thêm/ẩn bớt trả lời
    $(document).on('click', '.show-more-replies-btn', function() {
        var reviewId = $(this).data('review-id');
        var level = $(this).data('level');
        var $container = $(this).parent();

        // Tìm review
        var review = allReviewsData.find(function(r) { return r.id == reviewId; });
        if (!review) return;

        var comments = review.comments || [];
        var html = '';

        // Hiển thị tất cả comments
        comments.forEach(function(c) {
            html += renderCommentTree(c, level, reviewId);
        });

        // Thêm nút ẩn bớt
        var marginLeft = 2 + (level+1)*2;
        html += '<div class="hide-replies-btn" data-review-id="' + reviewId + '" data-level="' + level + '" style="margin-left:' + marginLeft + 'rem; color:#007bff; cursor:pointer; font-size:0.97rem; margin-top:0.3rem;">Ẩn bớt trả lời</div>';

        $container.html(html);
    });
    $(document).on('click', '.hide-replies-btn', function() {
        var reviewId = $(this).data('review-id');
        var level = $(this).data('level');
        var $container = $(this).parent();

        var review = allReviewsData.find(function(r) { return r.id == reviewId; });
        if (!review) return;

        var html = renderCommentTreeLimited(review.comments, level, reviewId);
        $container.html(html);
    });

    // Xem thêm bình luận
    $(document).on('click', '.show-more-comments-btn', function() {
        var reviewId = $(this).data('review-id');
        var level = $(this).data('level');
        var total = $(this).data('total');
        var $btn = $(this);

        // Tìm review trong allReviewsData
        var review = allReviewsData.find(function(r) {
            return r.id == reviewId;
        });

        if (!review || !review.comments) return;

        // Render tất cả comments
        var allCommentsHtml = '';
        review.comments.forEach(function(c) {
            allCommentsHtml += renderCommentTree(c, level, reviewId);
        });

        // Thêm nút "Ẩn bớt bình luận"
        var marginLeft = 2 + level * 2;
        allCommentsHtml += '<div class="hide-comments-btn" data-review-id="' + reviewId + '" data-level="' + level + '" style="margin-left:' + marginLeft + 'rem; color:#007bff; cursor:pointer; font-size:0.95rem; margin-top:0.5rem; padding: 0.3rem 0.5rem; border: 1px solid #007bff; border-radius: 4px; display: inline-block;">📁 Ẩn bớt bình luận</div>';

        // Thay thế nội dung comments container
        var $commentsContainer = $btn.closest('.review-item').find('.review-comments');
        $commentsContainer.html(allCommentsHtml);
    });

    // Ẩn bớt bình luận
    $(document).on('click', '.hide-comments-btn', function() {
        var reviewId = $(this).data('review-id');
        var level = $(this).data('level');
        var $btn = $(this);

        // Tìm review trong allReviewsData
        var review = allReviewsData.find(function(r) {
            return r.id == reviewId;
        });

        if (!review || !review.comments) return;

        // Render lại với giới hạn
        var limitedCommentsHtml = renderCommentTreeLimited(review.comments, level, reviewId);

        // Thay thế nội dung comments container
        var $commentsContainer = $btn.closest('.review-item').find('.review-comments');
        $commentsContainer.html(limitedCommentsHtml);
    });

    // Modal xem ảnh lớn
    $(document).on('click', '.comment-media-preview img', function() {
        var src = $(this).attr('src');
        $('#imageModalImg').attr('src', src);
        $('#imageModal').fadeIn(150);
    });
    $(document).on('click', '.image-modal-close, .image-modal-overlay', function() {
        $('#imageModal').fadeOut(150);
    });
});
</script>
@endsection