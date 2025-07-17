@extends('user.dashboard_user')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/user/myorder.css') }}">

<style>
.orders-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.page-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 40px 0;
    margin-bottom: 30px;
    margin-top: 10px;
    border-radius: 15px;
    text-align: center;
}

.page-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 10px;
}

.page-header p {
    font-size: 1.1rem;
    opacity: 0.9;
}

.order-filters {
    background: white;
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 30px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.filter-tabs {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.filter-tab {
    padding: 12px 24px;
    border: 2px solid #e9ecef;
    border-radius: 25px;
    background: white;
    color: #6c757d;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.filter-tab:hover, .filter-tab.active {
    background:rgb(231, 0, 0);
    color: white;
    border-color: #667eea;
    text-decoration: none;
    transform: translateY(-2px);
}

.modern-order-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    margin-bottom: 25px;
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
}

.modern-order-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.order-card-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 25px;
    border-bottom: 1px solid #dee2e6;
}

.order-meta {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 20px;
}

.order-info h3 {
    color: #2c3e50;
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 8px;
}

.order-details {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.order-detail-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #6c757d;
    font-size: 0.95rem;
}

.order-detail-item i {
    width: 16px;
    color: #667eea;
}

.order-status-section {
    text-align: right;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 15px;
}

.status-pending { background: #fff3cd; color: #856404; }
.status-processing { background: #d1ecf1; color: #0c5460; }
.status-shipping { background: #cce5ff; color: #004085; }
.status-completed { background: #d4edda; color: #155724; }
.status-cancelled { background: #f8d7da; color: #721c24; }

.total-amount {
    font-size: 1.3rem;
    font-weight: 700;
    color: #e74c3c;
}

.progress-section {
    padding: 0 25px 20px;
}

.order-progress {
    background: #f8f9fa;
    height: 8px;
    border-radius: 4px;
    overflow: hidden;
    margin-bottom: 15px;
}

.progress-fill {
    height: 100%;
    border-radius: 4px;
    transition: width 0.5s ease;
}

.progress-steps {
    display: flex;
    justify-content: space-between;
    font-size: 0.8rem;
    color: #6c757d;
}

.step {
    display: flex;
    align-items: center;
    gap: 5px;
}

.step.active {
    color: #667eea;
    font-weight: 600;
}

.products-section {
    padding: 25px;
}

.products-toggle {
    background: none;
    border: none;
    width: 100%;
    text-align: left;
    padding: 15px 0;
    font-weight: 600;
    color: #2c3e50;
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: pointer;
    transition: color 0.3s ease;
}

.products-toggle:hover {
    color: #667eea;
}

.products-toggle .fas.fa-chevron-down {
    transition: transform 0.3s ease;
    transform: rotate(0deg);
}

.products-toggle:not(.collapsed) .fas.fa-chevron-down {
    transform: rotate(180deg);
}

.products-collapse {
    overflow: hidden;
    transition: all 0.3s ease;
    max-height: 0;
    opacity: 0;
}

.products-collapse.show {
    max-height: 1000px;
    opacity: 1;
    display: block !important;
}

.products-list {
    margin-top: 20px;
}

.product-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 12px;
    margin-bottom: 15px;
    transition: all 0.3s ease;
}

.product-item:hover {
    background: #e9ecef;
    transform: translateX(5px);
}

.product-image {
    width: 80px;
    height: 80px;
    border-radius: 10px;
    object-fit: cover;
    border: 2px solid #dee2e6;
}

.product-info {
    flex: 1;
}

.product-name {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 5px;
    font-size: 1.1rem;
}

.product-details {
    display: flex;
    gap: 20px;
    color: #6c757d;
    font-size: 0.9rem;
}

.product-actions {
    display: flex;
    flex-direction: column;
    gap: 10px;
    align-items: flex-end;
}

.review-section {
    margin-top: 10px;
    padding-top: 10px;
    border-top: 1px solid #dee2e6;
}

.order-actions {
    padding: 25px;
    background: #f8f9fa;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}

.action-buttons {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

/* Using Bootstrap buttons instead */

.btn-primary-modern {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.btn-primary-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    color: white;
}

.btn-success-modern {
    background: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%);
    color: white;
}

.btn-success-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(86, 171, 47, 0.4);
    color: white;
}

.btn-danger-modern {
    background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
    color: white;
}

.btn-danger-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 65, 108, 0.4);
    color: white;
}

.btn-outline-modern {
    background: white;
    border: 2px solid #667eea;
    color: #667eea;
}

.btn-outline-modern:hover {
    background: #667eea;
    color: white;
    transform: translateY(-2px);
}

.empty-state {
    text-align: center;
    padding: 80px 20px;
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.empty-icon {
    font-size: 4rem;
    color: #dee2e6;
    margin-bottom: 20px;
}

.empty-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #6c757d;
    margin-bottom: 10px;
}

.empty-text {
    color: #adb5bd;
    margin-bottom: 30px;
}

/* Using Bootstrap buttons instead */

.reviewed-badge {
    background: #d4edda;
    color: #155724;
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
}

@media (max-width: 768px) {
    .order-meta {
        flex-direction: column;
        gap: 15px;
    }

    .order-status-section {
        text-align: left;
    }

    .product-item {
        flex-direction: column;
        text-align: center;
    }

    .product-actions {
        align-items: center;
    }

    .order-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .action-buttons {
        justify-content: center;
    }
}
</style>

<div class="orders-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1><i class="fas fa-shopping-bag me-3"></i>Đơn hàng của bạn</h1>
        <p>Quản lý và theo dõi tất cả đơn hàng của bạn</p>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Order Filters -->
    <div class="order-filters">
        <div class="filter-tabs">
            <a href="?status=all" class="filter-tab {{ request('status', 'all') == 'all' ? 'active' : '' }}">
                <i class="fas fa-list"></i>
                Tất cả
            </a>
            <a href="?status=pending" class="filter-tab {{ request('status') == 'pending' ? 'active' : '' }}">
                <i class="fas fa-clock"></i>
                Chờ xác nhận
            </a>
            <a href="?status=processing" class="filter-tab {{ request('status') == 'processing' ? 'active' : '' }}">
                <i class="fas fa-cog"></i>
                Đang xử lý
            </a>
            <a href="?status=shipping" class="filter-tab {{ request('status') == 'shipping' ? 'active' : '' }}">
                <i class="fas fa-truck"></i>
                Đang giao
            </a>
            <a href="?status=completed" class="filter-tab {{ request('status') == 'completed' ? 'active' : '' }}">
                <i class="fas fa-check-circle"></i>
                Đã giao
            </a>
            <a href="?status=cancelled" class="filter-tab {{ request('status') == 'cancelled' ? 'active' : '' }}">
                <i class="fas fa-times-circle"></i>
                Đã hủy
            </a>
        </div>
    </div>
    <!-- Orders List -->
    @forelse($order as $item)
        @php
            $status = $item->status ?? 'pending';
            $statusMap = [
                'pending' => ['Chờ xác nhận', 'status-pending', 'fas fa-clock'],
                'processing' => ['Đang xử lý', 'status-processing', 'fas fa-cog'],
                'shipping' => ['Đang giao', 'status-shipping', 'fas fa-truck'],
                'completed' => ['Đã giao', 'status-completed', 'fas fa-check-circle'],
                'cancelled' => ['Đã hủy', 'status-cancelled', 'fas fa-times-circle'],
            ];
            $statusLabel = $statusMap[$status][0] ?? $status;
            $statusClass = $statusMap[$status][1] ?? 'status-pending';
            $statusIcon = $statusMap[$status][2] ?? 'fas fa-clock';

            $progress = match($status) {
                'pending' => 25,
                'processing' => 50,
                'shipping' => 75,
                'completed' => 100,
                'cancelled' => 100,
                default => 25
            };
            $progressColor = $status === 'cancelled' ? '#e74c3c' : '#27ae60';
        @endphp

        <div class="modern-order-card">
            <!-- Order Header -->
            <div class="order-card-header">
                <div class="order-meta">
                    <div class="order-info">
                        <h3><i class="fas fa-receipt me-2"></i>Đơn hàng #{{ $item->id_order }}</h3>
                        <div class="order-details">
                            <div class="order-detail-item">
                                <i class="far fa-calendar-alt"></i>
                                <span>{{ $item->created_at ? date('d/m/Y H:i', strtotime($item->created_at)) : '-' }}</span>
                            </div>
                            <div class="order-detail-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $item->address ?: 'Chưa có địa chỉ' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="order-status-section">
                        <div class="status-badge {{ $statusClass }}">
                            <i class="{{ $statusIcon }}"></i>
                            {{ $statusLabel }}
                        </div>
                        <div class="total-amount">
                            {{ number_format($item->total_order, 0, ',', '.') }}đ
                        </div>
                    </div>
                </div>
            </div>

            <!-- Progress Section -->
            <div class="progress-section">
                <div class="order-progress">
                    <div class="progress-fill" style="width: {{ $progress }}%; background-color: {{ $progressColor }};"></div>
                </div>
                <div class="progress-steps">
                    <div class="step {{ in_array($status, ['pending', 'processing', 'shipping', 'completed']) ? 'active' : '' }}">
                        <i class="fas fa-clock"></i>
                        <span>Chờ xác nhận</span>
                    </div>
                    <div class="step {{ in_array($status, ['processing', 'shipping', 'completed']) ? 'active' : '' }}">
                        <i class="fas fa-cog"></i>
                        <span>Đang xử lý</span>
                    </div>
                    <div class="step {{ in_array($status, ['shipping', 'completed']) ? 'active' : '' }}">
                        <i class="fas fa-truck"></i>
                        <span>Đang giao</span>
                    </div>
                    <div class="step {{ $status === 'completed' ? 'active' : '' }}">
                        <i class="fas fa-check-circle"></i>
                        <span>Đã giao</span>
                    </div>
                </div>
            </div>
            <!-- Products Section -->
            <div class="products-section">
                <button class="products-toggle collapsed" type="button" onclick="toggleProducts('{{ $item->id_order }}')">
                    <span><i class="fas fa-box me-2"></i>Danh sách sản phẩm</span>
                    <i class="fas fa-chevron-down"></i>
                </button>

                <div id="products-{{ $item->id_order }}" class="products-collapse" style="display: none;">
                    <div class="products-list">
                        @php
                            $details = \App\Models\DetailsOrder::where('id_order', $item->id_order)->get();
                        @endphp
                        @foreach($details as $d)
                            @php
                                $product = \App\Models\Product::where('id_product', $d->id_product)->first();
                                // Kiểm tra xem sản phẩm đã được đánh giá chưa
                                $hasReview = false;
                                if ($product && $status === 'completed') {
                                    $hasReview = \App\Models\Review::where('id_product', $product->id_product)
                                        ->where('id_user', $item->id_user)
                                        ->exists();
                                }
                            @endphp
                            <div class="product-item">
                                <img src="{{ asset('uploads/productimage/' . ($product->image_address_product ?? 'default.jpg')) }}"
                                     class="product-image"
                                     alt="{{ $product->name_product ?? 'Sản phẩm' }}"
                                     onerror="this.src='{{ asset('img/default-product.png') }}'">

                                <div class="product-info">
                                    <div class="product-name">{{ $product->name_product ?? 'Sản phẩm đã xóa' }}</div>
                                    <div class="product-details">
                                        <span><i class="fas fa-cubes me-1"></i>Số lượng: {{ $d->quantity_detailsorder }}</span>
                                        <span><i class="fas fa-tag me-1"></i>Giá: {{ number_format($product->price_product ?? 0, 0, ',', '.') }}đ</span>
                                        <span><i class="fas fa-calculator me-1"></i>Tổng: {{ number_format(($product->price_product ?? 0) * $d->quantity_detailsorder, 0, ',', '.') }}đ</span>
                                    </div>
                                </div>

                                <div class="product-actions">
                                    @if($product)
                                        <a href="{{ route('product.indexDetailproduct', ['id' => $product->id_product]) }}"
                                           class="btn btn-outline-modern btn-sm">
                                            <i class="fas fa-eye"></i> Xem sản phẩm
                                        </a>

                                        @if($status === 'completed')
                                            <div class="review-section">
                                                @if($hasReview)
                                                    <span class="reviewed-badge">
                                                        <i class="fas fa-star"></i> Đã đánh giá
                                                    </span>
                                                @else
                                                    <button class="btn btn-warning btn-sm" onclick="openReviewModal({{ $product->id_product }}, '{{ addslashes($product->name_product) }}', '{{ $item->id_order }}', '{{ asset('uploads/productimage/' . $product->image_address_product) }}')">
                                                        <i class="fas fa-star"></i> Đánh giá
                                                    </button>
                                                @endif
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Order Actions -->
            <div class="order-actions">
                <div class="order-summary">
                    <span class="text-muted">Tổng cộng: </span>
                    <span class="total-amount">{{ number_format($item->total_order, 0, ',', '.') }}đ</span>
                </div>

                <div class="action-buttons">
                    <a href="{{ route('detailsorder.detailsOrderIndex', ['id_order' => $item->id_order, 'id_user' => $item->id_user]) }}"
                       class="btn btn-primary btn-sm">
                        <i class="fas fa-eye"></i> Xem chi tiết
                    </a>

                    @if($status == 'pending' || $status == 'processing')
                        <a href="{{ route('order.deleteOrder', ['id_order' => $item->id_order]) }}"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
                            <i class="fas fa-times"></i> Hủy đơn
                        </a>
                    @endif

                    @if($status == 'completed')
                        <a href="{{ route('admin.order.invoice', $item->id_order) }}"
                           target="_blank"
                           class="btn btn-success btn-sm">
                            <i class="fas fa-print"></i> In hóa đơn
                        </a>
                    @endif

                    @if($status == 'shipping')
                        <button class="btn btn-info btn-sm" onclick="trackOrder({{ $item->id_order }})">
                            <i class="fas fa-map-marked-alt"></i> Theo dõi đơn hàng
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <h3 class="empty-title">Chưa có đơn hàng nào</h3>
            <p class="empty-text">Bạn chưa có đơn hàng nào. Hãy khám phá các sản phẩm tuyệt vời của chúng tôi!</p>
            <a href="{{ route('user.index') }}" class="btn btn-primary">
                <i class="fas fa-shopping-cart"></i> Mua sắm ngay
            </a>
        </div>
    @endforelse
</div>

<!-- Review Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">
                    <i class="fas fa-star text-warning me-2"></i>Đánh giá sản phẩm
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="reviewForm">
                    <input type="hidden" id="productId" name="product_id">
                    <input type="hidden" id="orderId" name="order_id">

                    <div class="product-review-info mb-4">
                        <div class="d-flex align-items-center">
                            <img id="productImage" src="" alt="" class="rounded me-3" style="width: 80px; height: 80px; object-fit: cover;">
                            <div>
                                <h6 id="productName" class="mb-1"></h6>
                                <small class="text-muted">Đánh giá của bạn sẽ giúp khách hàng khác</small>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Đánh giá chất lượng sản phẩm</label>
                        <div class="rating-stars d-flex align-items-center gap-2">
                            <div class="stars-container">
                                <i class="fas fa-star star" data-rating="1"></i>
                                <i class="fas fa-star star" data-rating="2"></i>
                                <i class="fas fa-star star" data-rating="3"></i>
                                <i class="fas fa-star star" data-rating="4"></i>
                                <i class="fas fa-star star" data-rating="5"></i>
                            </div>
                            <span id="ratingText" class="text-muted">Chọn số sao</span>
                        </div>
                        <input type="hidden" id="rating" name="rating" required>
                    </div>

                    <div class="mb-4">
                        <label for="reviewContent" class="form-label fw-bold">Chia sẻ trải nghiệm của bạn</label>
                        <textarea class="form-control" id="reviewContent" name="content" rows="4"
                                  placeholder="Hãy chia sẻ cảm nhận của bạn về sản phẩm này..."></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Thêm hình ảnh (tùy chọn)</label>
                        <div class="upload-area border-2 border-dashed rounded p-4 text-center">
                            <input type="file" id="reviewImages" multiple accept="image/*" class="d-none">
                            <div class="upload-content">
                                <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                                <p class="mb-2">Kéo thả hoặc click để chọn ảnh</p>
                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="document.getElementById('reviewImages').click()">
                                    Chọn ảnh
                                </button>
                            </div>
                            <div id="imagePreview" class="mt-3"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" onclick="submitReview()">
                    <i class="fas fa-paper-plane me-1"></i>Gửi đánh giá
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notification Container -->
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
    <div id="reviewToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <div class="toast-icon me-2">
                <i class="fas fa-star text-warning"></i>
            </div>
            <strong class="me-auto toast-title">Đánh giá sản phẩm</strong>
            <small class="toast-time">Vừa xong</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <div class="toast-message"></div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-body text-center p-5">
                <div class="success-animation mb-4">
                    <div class="success-checkmark">
                        <div class="check-icon">
                            <span class="icon-line line-tip"></span>
                            <span class="icon-line line-long"></span>
                            <div class="icon-circle"></div>
                            <div class="icon-fix"></div>
                        </div>
                    </div>
                </div>
                <h4 class="text-success mb-3">Đánh giá thành công!</h4>
                <p class="text-muted mb-4">Cảm ơn bạn đã chia sẻ trải nghiệm về sản phẩm. Đánh giá của bạn sẽ giúp khách hàng khác có thêm thông tin hữu ích.</p>
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Đóng
                    </button>
                    <button type="button" class="btn btn-primary" onclick="location.reload()">
                        <i class="fas fa-sync-alt me-1"></i>Tải lại trang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Notification Functions
function showNotification(type, title, message, duration = 5000) {
    const toast = document.getElementById('reviewToast');
    const toastTitle = toast.querySelector('.toast-title');
    const toastMessage = toast.querySelector('.toast-message');
    const toastIcon = toast.querySelector('.toast-icon i');
    const toastTime = toast.querySelector('.toast-time');

    // Reset classes
    toast.className = 'toast';
    toast.classList.add(type);

    // Set content
    toastTitle.textContent = title;
    toastMessage.innerHTML = message;
    toastTime.textContent = 'Vừa xong';

    // Set icon based on type
    const icons = {
        success: 'fas fa-check-circle',
        error: 'fas fa-exclamation-circle',
        warning: 'fas fa-exclamation-triangle',
        info: 'fas fa-info-circle'
    };

    toastIcon.className = icons[type] || icons.info;

    // Show toast
    const bsToast = new bootstrap.Toast(toast, {
        delay: duration,
        autohide: true
    });
    bsToast.show();

    return bsToast;
}

function showSuccessModal(title, message) {
    const modal = document.getElementById('successModal');
    const modalTitle = modal.querySelector('h4');
    const modalMessage = modal.querySelector('p');

    modalTitle.textContent = title;
    modalMessage.textContent = message;

    const bsModal = new bootstrap.Modal(modal);
    bsModal.show();

    return bsModal;
}

function showLoadingNotification(message = 'Đang xử lý...') {
    return showNotification('info', 'Đang xử lý', `<i class="fas fa-spinner fa-spin me-2"></i>${message}`, 0);
}

// Toggle Products Function
function toggleProducts(orderId) {
    const productsDiv = document.getElementById('products-' + orderId);
    const toggleButton = productsDiv.previousElementSibling;
    const chevronIcon = toggleButton.querySelector('.fas.fa-chevron-down');

    if (productsDiv.classList.contains('show')) {
        // Hide products
        productsDiv.classList.remove('show');
        toggleButton.classList.add('collapsed');
        toggleButton.setAttribute('aria-expanded', 'false');
        if (chevronIcon) {
            chevronIcon.style.transform = 'rotate(0deg)';
        }
    } else {
        // Show products
        productsDiv.classList.add('show');
        toggleButton.classList.remove('collapsed');
        toggleButton.setAttribute('aria-expanded', 'true');
        if (chevronIcon) {
            chevronIcon.style.transform = 'rotate(180deg)';
        }
    }
}

// Review Modal Functions
function openReviewModal(productId, productName, orderId, productImageUrl) {
    document.getElementById('productId').value = productId;
    document.getElementById('orderId').value = orderId;
    document.getElementById('productName').textContent = productName;

    // Set product image
    const productImage = document.getElementById('productImage');
    productImage.src = productImageUrl || '/img/default-product.png';
    productImage.onerror = function() {
        this.src = '/img/default-product.png';
    };

    // Reset form
    document.getElementById('reviewForm').reset();
    document.getElementById('rating').value = '';
    document.getElementById('ratingText').textContent = 'Chọn số sao';
    document.getElementById('imagePreview').innerHTML = '';

    // Reset file input
    document.getElementById('reviewImages').value = '';

    // Reset stars
    document.querySelectorAll('.star').forEach(star => {
        star.classList.remove('active');
        star.style.color = '#dee2e6';
    });

    // Show modal
    new bootstrap.Modal(document.getElementById('reviewModal')).show();
}

// Star rating functionality
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('rating');
    const ratingText = document.getElementById('ratingText');

    const ratingTexts = {
        1: 'Rất không hài lòng',
        2: 'Không hài lòng',
        3: 'Bình thường',
        4: 'Hài lòng',
        5: 'Rất hài lòng'
    };

    stars.forEach(star => {
        star.addEventListener('click', function() {
            const rating = parseInt(this.dataset.rating);
            ratingInput.value = rating;
            ratingText.textContent = ratingTexts[rating];

            // Update star display
            stars.forEach((s, index) => {
                if (index < rating) {
                    s.classList.add('active');
                } else {
                    s.classList.remove('active');
                }
            });
        });

        star.addEventListener('mouseover', function() {
            const rating = parseInt(this.dataset.rating);
            stars.forEach((s, index) => {
                if (index < rating) {
                    s.style.color = '#ffc107';
                } else {
                    s.style.color = '#dee2e6';
                }
            });
        });
    });

    document.querySelector('.stars-container').addEventListener('mouseleave', function() {
        const currentRating = parseInt(ratingInput.value) || 0;
        stars.forEach((s, index) => {
            if (index < currentRating) {
                s.style.color = '#ffc107';
            } else {
                s.style.color = '#dee2e6';
            }
        });
    });
});

// Image preview functionality
document.getElementById('reviewImages').addEventListener('change', function(e) {
    const files = e.target.files;
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';

    // Limit to 5 images
    const maxFiles = Math.min(files.length, 5);

    for (let i = 0; i < maxFiles; i++) {
        const file = files[i];
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgContainer = document.createElement('div');
                imgContainer.className = 'position-relative d-inline-block me-2 mb-2';

                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'img-thumbnail';
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.objectFit = 'cover';

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'btn btn-danger btn-sm position-absolute top-0 end-0';
                removeBtn.style.transform = 'translate(50%, -50%)';
                removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                removeBtn.onclick = function() {
                    imgContainer.remove();
                    // Update file input
                    updateFileInput();
                };

                imgContainer.appendChild(img);
                imgContainer.appendChild(removeBtn);
                preview.appendChild(imgContainer);
            };
            reader.readAsDataURL(file);
        }
    }

    if (files.length > 5) {
        showNotification(
            'warning',
            'Quá nhiều ảnh!',
            'Bạn chỉ có thể chọn tối đa 5 ảnh. Vui lòng chọn lại!',
            5000
        );
    }
});

function updateFileInput() {
    // This is a simplified approach - in a real app you'd want to maintain the file list properly
    const preview = document.getElementById('imagePreview');
    if (preview.children.length === 0) {
        document.getElementById('reviewImages').value = '';
    }
}

// Submit review
function submitReview() {
    // Validate rating
    if (!document.getElementById('rating').value) {
        showNotification('warning', 'Thiếu thông tin', 'Vui lòng chọn số sao đánh giá!');
        return;
    }

    // Create FormData manually to avoid duplicates
    const formData = new FormData();

    // Add form fields
    formData.append('product_id', document.getElementById('productId').value);
    formData.append('order_id', document.getElementById('orderId').value);
    formData.append('rating', document.getElementById('rating').value);
    formData.append('content', document.getElementById('reviewContent').value);

    // Add images (only once)
    const images = document.getElementById('reviewImages').files;
    console.log('Number of images selected:', images.length);
    for (let i = 0; i < images.length; i++) {
        console.log('Adding image:', images[i].name);
        formData.append('images[]', images[i]);
    }

    // Show loading
    const submitBtn = event.target;
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Đang gửi...';
    submitBtn.disabled = true;

    // Show loading notification
    const loadingToast = showLoadingNotification('Đang gửi đánh giá của bạn...');

    // Submit via AJAX
    fetch('/reviews', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        // Hide loading toast
        loadingToast.hide();

        if (data.success) {
            // Close review modal
            bootstrap.Modal.getInstance(document.getElementById('reviewModal')).hide();

            // Show success modal with animation
            setTimeout(() => {
                showSuccessModal(
                    'Cảm ơn bạn đã đánh giá!',
                    'Đánh giá của bạn đã được gửi thành công và sẽ giúp khách hàng khác có thêm thông tin hữu ích khi mua sắm.'
                );
            }, 300);

            // Also show success toast
            setTimeout(() => {
                showNotification(
                    'success',
                    'Đánh giá thành công!',
                    '<i class="fas fa-star text-warning me-1"></i>Cảm ơn bạn đã chia sẻ trải nghiệm về sản phẩm!',
                    6000
                );
            }, 800);

        } else {
            showNotification(
                'error',
                'Gửi đánh giá thất bại',
                data.message || data.error || 'Có lỗi xảy ra, vui lòng thử lại!',
                8000
            );
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Hide loading toast
        loadingToast.hide();

        showNotification(
            'error',
            'Lỗi kết nối',
            'Có lỗi xảy ra khi gửi đánh giá. Vui lòng kiểm tra kết nối mạng và thử lại!',
            8000
        );
    })
    .finally(() => {
        // Restore button
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
}

// Track order function
function trackOrder(orderId) {
    showNotification(
        'info',
        'Theo dõi đơn hàng',
        'Chức năng theo dõi đơn hàng đang được phát triển. Bạn có thể liên hệ với chúng tôi để biết thêm thông tin!',
        5000
    );
}

// Simple animations like other pages
document.addEventListener('DOMContentLoaded', function() {
    // Animate order cards on load
    const orderCards = document.querySelectorAll('.modern-order-card');
    orderCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';

        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });


});
</script>

<style>
.star {
    font-size: 1.5rem;
    color: #dee2e6;
    cursor: pointer;
    transition: color 0.2s ease;
}

.star:hover,
.star.active {
    color: #ffc107;
}

.upload-area {
    cursor: pointer;
    transition: all 0.3s ease;
}

.upload-area:hover {
    border-color: #667eea !important;
    background-color: #f8f9ff;
}

.rating-stars {
    padding: 10px 0;
}

.product-review-info {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
}

/* Toast Notifications */
.toast {
    min-width: 350px;
    border: none;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    border-radius: 12px;
    overflow: hidden;
}

.toast-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 15px 20px;
}

.toast-header .btn-close {
    filter: invert(1);
    opacity: 0.8;
}

.toast-header .btn-close:hover {
    opacity: 1;
}

.toast-body {
    padding: 20px;
    background: white;
}

.toast-icon {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
}

.toast-title {
    font-weight: 600;
    font-size: 1rem;
}

.toast-time {
    opacity: 0.8;
    font-size: 0.85rem;
}

.toast-message {
    font-size: 0.95rem;
    line-height: 1.5;
}

/* Success Modal Animation */
.success-animation {
    position: relative;
    margin: 0 auto;
    width: 80px;
    height: 80px;
}

.success-checkmark {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: block;
    stroke-width: 2;
    stroke: #4CAF50;
    stroke-miterlimit: 10;
    box-shadow: inset 0px 0px 0px #4CAF50;
    animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
    position: relative;
}

.success-checkmark .icon-circle {
    width: 80px;
    height: 80px;
    position: absolute;
    border-radius: 50%;
    border: 2px solid #4CAF50;
    top: -2px;
    left: -2px;
    z-index: 10;
    animation: checkmark-circle 0.6s ease-in-out forwards;
}

.success-checkmark .icon-line {
    height: 2px;
    background-color: #4CAF50;
    display: block;
    border-radius: 2px;
    position: absolute;
    z-index: 10;
}

.success-checkmark .icon-line.line-tip {
    top: 46px;
    left: 14px;
    width: 25px;
    transform: rotate(45deg);
    animation: checkmark-tip 0.7s ease-in-out 0.6s forwards;
}

.success-checkmark .icon-line.line-long {
    top: 38px;
    right: 8px;
    width: 47px;
    transform: rotate(-45deg);
    animation: checkmark-long 0.7s ease-in-out 0.6s forwards;
}

.success-checkmark .icon-fix {
    top: 8px;
    width: 5px;
    left: 26px;
    z-index: 1;
    height: 85px;
    position: absolute;
    transform: rotate(-45deg);
}

@keyframes checkmark-circle {
    0% {
        stroke-dasharray: 0 166;
        stroke-dashoffset: 0;
    }
    100% {
        stroke-dasharray: 166 166;
        stroke-dashoffset: 0;
    }
}

@keyframes checkmark-tip {
    0% {
        width: 0;
        left: 1px;
        top: 19px;
    }
    54% {
        width: 0;
        left: 1px;
        top: 19px;
    }
    70% {
        width: 50px;
        left: -8px;
        top: 37px;
    }
    84% {
        width: 17px;
        left: 21px;
        top: 48px;
    }
    100% {
        width: 25px;
        left: 14px;
        top: 45px;
    }
}

@keyframes checkmark-long {
    0% {
        width: 0;
        right: 46px;
        top: 54px;
    }
    65% {
        width: 0;
        right: 46px;
        top: 54px;
    }
    84% {
        width: 55px;
        right: 0px;
        top: 35px;
    }
    100% {
        width: 47px;
        right: 8px;
        top: 38px;
    }
}

@keyframes fill {
    100% {
        box-shadow: inset 0px 0px 0px 30px #4CAF50;
    }
}

@keyframes scale {
    0%, 100% {
        transform: none;
    }
    50% {
        transform: scale3d(1.1, 1.1, 1);
    }
}

/* Error Toast */
.toast.error .toast-header {
    background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
}

.toast.error .toast-icon {
    background: rgba(255,255,255,0.2);
}

/* Warning Toast */
.toast.warning .toast-header {
    background: linear-gradient(135deg, #ffeaa7 0%, #fab1a0 100%);
    color: #2d3436;
}

.toast.warning .toast-icon {
    background: rgba(45,52,54,0.1);
}

.toast.warning .btn-close {
    filter: none;
    opacity: 0.6;
}

/* Info Toast */
.toast.info .toast-header {
    background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
}

/* Toast slide-in animation */
.toast.show {
    animation: slideInRight 0.5s ease-out;
}

@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

/* Custom SweetAlert2 styles */
.swal2-popup {
    border-radius: 15px !important;
    font-family: 'Poppins', sans-serif !important;
}

.swal2-title {
    font-weight: 600 !important;
    color: #2c3e50 !important;
}

.swal2-content {
    color: #6c757d !important;
}

.swal2-confirm {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    border: none !important;
    border-radius: 25px !important;
    padding: 10px 30px !important;
    font-weight: 600 !important;
}

.swal2-confirm:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4) !important;
}

/* Success animation */
@keyframes successPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.swal2-success-circular-line-right,
.swal2-success-circular-line-left {
    background-color: #27ae60 !important;
}

.swal2-success-fix {
    background-color: #27ae60 !important;
}

.swal2-success .swal2-success-ring {
    border-color: #27ae60 !important;
}

/* Toast positioning */
.swal2-toast {
    border-radius: 15px !important;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2) !important;
}

/* Animated popup */
.animated-popup {
    animation: bounceIn 0.6s ease-out !important;
}

@keyframes bounceIn {
    0% {
        opacity: 0;
        transform: scale(0.3) translateY(-50px);
    }
    50% {
        opacity: 1;
        transform: scale(1.05) translateY(0);
    }
    70% {
        transform: scale(0.95);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

.success-btn {
    background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%) !important;
    border: none !important;
    border-radius: 25px !important;
    padding: 12px 30px !important;
    font-weight: 600 !important;
    font-size: 14px !important;
    transition: all 0.3s ease !important;
}

.success-btn:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 25px rgba(39, 174, 96, 0.3) !important;
}

/* Loading animation */
.swal2-loading {
    border-radius: 15px !important;
}

.swal2-loading .swal2-title {
    color: #667eea !important;
}

/* Warning styles */
.swal2-warning .swal2-icon {
    border-color: #f39c12 !important;
    color: #f39c12 !important;
}

/* Error styles */
.swal2-error .swal2-icon {
    border-color: #e74c3c !important;
}

.swal2-error .swal2-x-mark {
    background-color: #e74c3c !important;
}


</style>

@endsection