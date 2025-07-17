@extends('user.dashboard_user')
@section('title', 'Đơn hàng của tôi')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="orders-header mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="page-title">
                    <i class="fas fa-shopping-bag me-2"></i>
                    Đơn hàng của tôi
                </h2>
                <p class="text-muted mb-0">Quản lý và theo dõi tất cả đơn hàng của bạn</p>
            </div>
            <div class="col-md-4 text-end">
                <div class="order-stats">
                    <span class="badge bg-primary fs-6 px-3 py-2">
                        {{ $orders->total() ?? count($orders) }} đơn hàng
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="order-filters mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <ul class="nav nav-pills order-status-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ request('status') == '' ? 'active' : '' }}" 
                                   href="{{ route('user.orders.index') }}">
                                    <i class="fas fa-list me-1"></i>Tất cả
                                    <span class="badge bg-secondary ms-1">{{ $totalOrders ?? 0 }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request('status') == 'pending' ? 'active' : '' }}" 
                                   href="{{ route('user.orders.index', ['status' => 'pending']) }}">
                                    <i class="fas fa-clock me-1"></i>Chờ xử lý
                                    <span class="badge bg-warning ms-1">{{ $pendingOrders ?? 0 }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request('status') == 'processing' ? 'active' : '' }}" 
                                   href="{{ route('user.orders.index', ['status' => 'processing']) }}">
                                    <i class="fas fa-cog me-1"></i>Đang xử lý
                                    <span class="badge bg-info ms-1">{{ $processingOrders ?? 0 }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request('status') == 'shipping' ? 'active' : '' }}" 
                                   href="{{ route('user.orders.index', ['status' => 'shipping']) }}">
                                    <i class="fas fa-truck me-1"></i>Đang giao
                                    <span class="badge bg-primary ms-1">{{ $shippingOrders ?? 0 }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request('status') == 'completed' ? 'active' : '' }}" 
                                   href="{{ route('user.orders.index', ['status' => 'completed']) }}">
                                    <i class="fas fa-check-circle me-1"></i>Hoàn thành
                                    <span class="badge bg-success ms-1">{{ $completedOrders ?? 0 }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request('status') == 'cancelled' ? 'active' : '' }}" 
                                   href="{{ route('user.orders.index', ['status' => 'cancelled']) }}">
                                    <i class="fas fa-times-circle me-1"></i>Đã hủy
                                    <span class="badge bg-danger ms-1">{{ $cancelledOrders ?? 0 }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <div class="search-box">
                            <form action="{{ route('user.orders.index') }}" method="GET" class="d-flex">
                                <input type="hidden" name="status" value="{{ request('status') }}">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" 
                                           placeholder="Tìm kiếm đơn hàng..." 
                                           value="{{ request('search') }}">
                                    <button class="btn btn-outline-primary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders List -->
    <div class="orders-list">
        @forelse($orders as $order)
        <div class="order-card mb-4" data-order-id="{{ $order->id_order }}">
            <div class="card border-0 shadow-sm">
                <!-- Order Header -->
                <div class="card-header bg-white border-bottom">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="order-info">
                                <h5 class="order-id mb-1">
                                    <i class="fas fa-receipt me-2 text-primary"></i>
                                    Đơn hàng #{{ $order->id_order }}
                                </h5>
                                <p class="order-date text-muted mb-0">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    {{ $order->created_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <div class="order-status-badges">
                                <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'processing' ? 'info' : ($order->status == 'shipping' ? 'primary' : ($order->status == 'completed' ? 'success' : 'danger'))) }} fs-6 px-3 py-2 me-2">
                                    {{ $statusLabels[$order->status] ?? $order->status }}
                                </span>
                                <span class="badge bg-outline-{{ $order->payment_status == 'paid' ? 'success' : 'secondary' }} fs-6 px-3 py-2">
                                    {{ $paymentStatusLabels[$order->payment_status] ?? $order->payment_status }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Body -->
                <div class="card-body">
                    <!-- Order Items -->
                    <div class="order-items mb-3">
                        @foreach($order->orderDetails->take(3) as $detail)
                        <div class="order-item d-flex align-items-center mb-2">
                            <div class="product-image me-3">
                                <img src="{{ $detail->product->image ?? '/img/no-image.png' }}" 
                                     alt="{{ $detail->product->name }}" 
                                     class="rounded" width="60" height="60" style="object-fit: cover;">
                            </div>
                            <div class="product-info flex-grow-1">
                                <h6 class="product-name mb-1">{{ $detail->product->name }}</h6>
                                <p class="product-details text-muted mb-0">
                                    Số lượng: {{ $detail->quantity }} × {{ number_format($detail->price, 0, ',', '.') }}đ
                                </p>
                            </div>
                            <div class="product-total">
                                <span class="fw-bold text-primary">
                                    {{ number_format($detail->quantity * $detail->price, 0, ',', '.') }}đ
                                </span>
                            </div>
                        </div>
                        @endforeach
                        
                        @if($order->orderDetails->count() > 3)
                        <div class="more-items text-center">
                            <button class="btn btn-link btn-sm text-primary" onclick="toggleOrderItems({{ $order->id_order }})">
                                <i class="fas fa-chevron-down me-1"></i>
                                Xem thêm {{ $order->orderDetails->count() - 3 }} sản phẩm
                            </button>
                        </div>
                        @endif
                    </div>

                    <!-- Order Summary -->
                    <div class="order-summary">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="delivery-info">
                                    <h6 class="mb-2">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        Địa chỉ giao hàng
                                    </h6>
                                    <p class="text-muted mb-1">{{ $order->address }}</p>
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-phone me-1"></i>{{ $order->phone }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="order-total">
                                    <h6 class="mb-2">Tổng tiền</h6>
                                    <h4 class="text-primary fw-bold mb-0">
                                        {{ number_format($order->total_order, 0, ',', '.') }}đ
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Actions -->
                <div class="card-footer bg-light border-top">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="order-actions">
                                <a href="{{ route('user.orders.show', $order->id_order) }}" 
                                   class="btn btn-outline-primary btn-sm me-2">
                                    <i class="fas fa-eye me-1"></i>Chi tiết
                                </a>
                                
                                @if($order->status == 'completed')
                                <button class="btn btn-success btn-sm me-2 btn-review" 
                                        data-order-id="{{ $order->id_order }}">
                                    <i class="fas fa-star me-1"></i>Đánh giá
                                </button>
                                @endif
                                
                                @if($order->status == 'pending')
                                <button class="btn btn-danger btn-sm btn-cancel-order" 
                                        data-order-id="{{ $order->id_order }}">
                                    <i class="fas fa-times me-1"></i>Hủy đơn
                                </button>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <div class="order-tracking">
                                @if($order->status == 'shipping')
                                <button class="btn btn-info btn-sm" onclick="trackOrder({{ $order->id_order }})">
                                    <i class="fas fa-map-marked-alt me-1"></i>Theo dõi đơn hàng
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="empty-orders text-center py-5">
            <div class="empty-icon mb-4">
                <i class="fas fa-shopping-bag fa-5x text-muted opacity-50"></i>
            </div>
            <h4 class="text-muted mb-3">Chưa có đơn hàng nào</h4>
            <p class="text-muted mb-4">
                @if(request('status'))
                    Không có đơn hàng nào với trạng thái này
                @else
                    Bạn chưa có đơn hàng nào. Hãy bắt đầu mua sắm ngay!
                @endif
            </p>
            <a href="{{ route('user.home') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-shopping-cart me-2"></i>Tiếp tục mua sắm
            </a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($orders->hasPages())
    <div class="pagination-wrapper d-flex justify-content-center mt-4">
        {{ $orders->links() }}
    </div>
    @endif
</div>

<!-- Modal đánh giá sản phẩm -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="reviewModalLabel">
                    <i class="fas fa-star me-2"></i>Đánh giá sản phẩm
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="reviewModalBody">
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Đang tải...</span>
                    </div>
                    <p class="mt-3">Đang tải danh sách sản phẩm...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal theo dõi đơn hàng -->
<div class="modal fade" id="trackingModal" tabindex="-1" aria-labelledby="trackingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="trackingModalLabel">
                    <i class="fas fa-map-marked-alt me-2"></i>Theo dõi đơn hàng
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="trackingModalBody">
                <!-- Tracking content will be loaded here -->
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
/* Main Layout */
.page-title {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

/* Order Filters */
.order-filters .card {
    border-radius: 15px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.order-status-tabs {
    border: none;
}

.order-status-tabs .nav-link {
    border: none;
    border-radius: 25px;
    padding: 10px 20px;
    margin-right: 10px;
    background: transparent;
    color: #6c757d;
    font-weight: 600;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.order-status-tabs .nav-link:hover {
    background: rgba(0, 123, 255, 0.1);
    color: #007bff;
    transform: translateY(-2px);
}

.order-status-tabs .nav-link.active {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
}

.order-status-tabs .nav-link .badge {
    font-size: 0.7rem;
    padding: 2px 6px;
}

/* Search Box */
.search-box .input-group {
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.search-box .form-control {
    border: none;
    padding: 12px 20px;
}

.search-box .btn {
    border: none;
    padding: 12px 20px;
}

/* Order Cards */
.order-card {
    transition: all 0.3s ease;
}

.order-card:hover {
    transform: translateY(-5px);
}

.order-card .card {
    border-radius: 20px;
    overflow: hidden;
    border: 1px solid #e9ecef;
}

.order-card .card-header {
    padding: 20px 25px;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
}

.order-id {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 5px;
}

.order-date {
    font-size: 0.9rem;
}

/* Status Badges */
.order-status-badges .badge {
    border-radius: 20px;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.bg-outline-success {
    color: #28a745;
    border: 2px solid #28a745;
    background: transparent;
}

.bg-outline-secondary {
    color: #6c757d;
    border: 2px solid #6c757d;
    background: transparent;
}

/* Order Items */
.order-items {
    background: #f8f9fa;
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 20px;
}

.order-item {
    padding: 10px 0;
    border-bottom: 1px solid #e9ecef;
}

.order-item:last-child {
    border-bottom: none;
}

.product-image img {
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.product-image img:hover {
    border-color: #007bff;
    transform: scale(1.05);
}

.product-name {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 5px;
}

.product-details {
    font-size: 0.9rem;
}

.product-total {
    font-size: 1.1rem;
    font-weight: 700;
}

/* Order Summary */
.order-summary {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border-radius: 15px;
    padding: 20px;
    border: 1px solid #e9ecef;
}

.delivery-info h6 {
    color: #2c3e50;
    font-weight: 600;
}

.order-total h4 {
    font-size: 1.8rem;
    font-weight: 800;
}

/* Action Buttons - Simple styling like other pages */
.card-footer {
    padding: 20px 25px;
    border-radius: 0 0 20px 20px;
}

.order-actions .btn {
    border-radius: 5px;
    padding: 8px 16px;
    font-weight: 500;
    margin-right: 5px;
}

/* Empty State */
.empty-orders {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 20px;
    padding: 60px 40px;
    margin: 40px 0;
}

.empty-icon {
    opacity: 0.6;
}

/* Modal Enhancements */
.modal-content {
    border: none;
    border-radius: 20px;
    overflow: hidden;
}

.modal-header {
    border: none;
    padding: 25px 30px 20px;
}

.modal-body {
    padding: 20px 30px 30px;
}

/* Product Review Form */
.product-review-item {
    background: #f8f9fa;
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 20px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.product-review-item:hover {
    border-color: #007bff;
    box-shadow: 0 5px 20px rgba(0, 123, 255, 0.1);
}

.rating-stars {
    font-size: 1.5rem;
    margin: 10px 0;
}

.rating-stars .star {
    color: #e9ecef;
    cursor: pointer;
    transition: all 0.2s ease;
    margin-right: 5px;
}

.rating-stars .star:hover,
.rating-stars .star.active {
    color: #ffc107;
}

.rating-stars .star.inactive {
    color: #e9ecef;
}

/* Tracking Timeline */
.tracking-timeline {
    position: relative;
    padding: 20px 0;
}

.tracking-step {
    display: flex;
    align-items: center;
    margin-bottom: 30px;
    position: relative;
}

.tracking-step:last-child {
    margin-bottom: 0;
}

.tracking-step::before {
    content: '';
    position: absolute;
    left: 20px;
    top: 40px;
    width: 2px;
    height: calc(100% + 10px);
    background: #e9ecef;
    z-index: 1;
}

.tracking-step:last-child::before {
    display: none;
}

.tracking-step.completed::before {
    background: #28a745;
}

.tracking-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 20px;
    position: relative;
    z-index: 2;
}

.tracking-step.completed .tracking-icon {
    background: #28a745;
    color: white;
}

.tracking-step.current .tracking-icon {
    background: #007bff;
    color: white;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(0, 123, 255, 0.7); }
    70% { box-shadow: 0 0 0 10px rgba(0, 123, 255, 0); }
    100% { box-shadow: 0 0 0 0 rgba(0, 123, 255, 0); }
}



/* Responsive Design */
@media (max-width: 768px) {
    .order-status-tabs {
        flex-wrap: wrap;
    }

    .order-status-tabs .nav-link {
        margin-bottom: 10px;
        font-size: 0.9rem;
        padding: 8px 15px;
    }

    .order-card .card-header,
    .order-card .card-body,
    .order-card .card-footer {
        padding: 15px;
    }

    .order-summary {
        padding: 15px;
    }

    .order-total h4 {
        font-size: 1.5rem;
    }

    .product-review-item {
        padding: 15px;
    }

    .rating-stars {
        font-size: 1.3rem;
    }
}

/* Loading Animation */
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.9);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.loading-spinner {
    width: 50px;
    height: 50px;
    border: 5px solid #f3f3f3;
    border-top: 5px solid #007bff;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
@endsection

@section('scripts')
<script src="{{ asset('js/user/orders.js') }}"></script>
<script>

// Toggle order items visibility
function toggleOrderItems(orderId) {
    const $orderCard = $(`.order-card[data-order-id="${orderId}"]`);
    const $moreItems = $orderCard.find('.more-items');
    const $hiddenItems = $orderCard.find('.order-item.d-none');

    if ($hiddenItems.length > 0) {
        $hiddenItems.removeClass('d-none');
        $moreItems.find('button').html('<i class="fas fa-chevron-up me-1"></i>Ẩn bớt');
    } else {
        $orderCard.find('.order-item:gt(2)').addClass('d-none');
        $moreItems.find('button').html('<i class="fas fa-chevron-down me-1"></i>Xem thêm');
    }
}

// Load order products for review
function loadOrderProducts(orderId) {
    $('#reviewModalBody').html(`
        <div class="text-center py-4">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Đang tải...</span>
            </div>
            <p class="mt-3">Đang tải danh sách sản phẩm...</p>
        </div>
    `);

    $('#reviewModal').modal('show');

    // AJAX call to get order products
    $.ajax({
        url: `/user/orders/${orderId}/products`,
        method: 'GET',
        success: function(response) {
            renderProductReviewForm(response.products, orderId);
        },
        error: function(xhr) {
            $('#reviewModalBody').html(`
                <div class="text-center py-4">
                    <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                    <h5>Không thể tải danh sách sản phẩm</h5>
                    <p class="text-muted">Vui lòng thử lại sau</p>
                    <button class="btn btn-primary" onclick="loadOrderProducts(${orderId})">
                        <i class="fas fa-redo me-1"></i>Thử lại
                    </button>
                </div>
            `);
        }
    });
}

// Render product review form
function renderProductReviewForm(products, orderId) {
    let html = `
        <form id="reviewForm" data-order-id="${orderId}">
            <div class="products-review-list">
    `;

    products.forEach(function(product, index) {
        html += `
            <div class="product-review-item">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <img src="${product.image || '/img/no-image.png'}"
                             alt="${product.name}"
                             class="img-fluid rounded"
                             style="max-height: 80px; object-fit: cover;">
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-8">
                                <h6 class="mb-2">${product.name}</h6>
                                <p class="text-muted small mb-2">
                                    Số lượng: ${product.quantity} × ${formatCurrency(product.price)}
                                </p>
                                <div class="rating-section mb-3">
                                    <label class="form-label small fw-bold">Đánh giá sản phẩm:</label>
                                    <div class="rating-stars" data-product-id="${product.id}">
                                        ${[1,2,3,4,5].map(star =>
                                            `<span class="star active" data-rating="${star}">★</span>`
                                        ).join('')}
                                    </div>
                                    <input type="hidden" name="products[${index}][id]" value="${product.id}">
                                    <input type="hidden" name="products[${index}][rating]" value="5" class="rating-input">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="review-text">
                                    <label class="form-label small fw-bold">Nhận xét:</label>
                                    <textarea name="products[${index}][comment]"
                                             class="form-control form-control-sm"
                                             rows="4"
                                             placeholder="Chia sẻ trải nghiệm của bạn về sản phẩm này..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    });

    html += `
            </div>
            <div class="text-center mt-4">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Hủy
                </button>
                <button type="submit" class="btn btn-success btn-lg">
                    <i class="fas fa-star me-2"></i>Gửi đánh giá
                </button>
            </div>
        </form>
    `;

    $('#reviewModalBody').html(html);
    initializeRatingStars();
}

// Initialize rating stars functionality
function initializeRatingStars() {
    // Remove any existing event handlers to prevent duplicates
    $('.rating-stars .star').off('click hover mouseenter mouseleave');

    // Ensure stars are clickable
    $('.rating-stars .star').css({
        'pointer-events': 'auto',
        'cursor': 'pointer',
        'user-select': 'none'
    });

    // Handle star clicks with event delegation
    $(document).on('click', '.rating-stars .star', function(e) {
        e.preventDefault();
        e.stopPropagation();

        const rating = $(this).data('rating');
        const $ratingContainer = $(this).parent();
        const $ratingInput = $ratingContainer.siblings('.rating-input');

        console.log('Star clicked, rating:', rating);

        $ratingInput.val(rating);

        $ratingContainer.find('.star').each(function(index) {
            if (index < rating) {
                $(this).addClass('active').removeClass('inactive');
            } else {
                $(this).addClass('inactive').removeClass('active');
            }
        });
    });

    // Hover effects with event delegation
    $(document).on('mouseenter', '.rating-stars .star', function() {
        const rating = $(this).data('rating');
        const $ratingContainer = $(this).parent();

        $ratingContainer.find('.star').each(function(index) {
            if (index < rating) {
                $(this).addClass('active').removeClass('inactive');
            } else {
                $(this).addClass('inactive').removeClass('active');
            }
        });
    });

    $(document).on('mouseleave', '.rating-stars', function() {
        const $ratingContainer = $(this);
        const currentRating = $ratingContainer.siblings('.rating-input').val();

        $ratingContainer.find('.star').each(function(index) {
            if (index < currentRating) {
                $(this).addClass('active').removeClass('inactive');
            } else {
                $(this).addClass('inactive').removeClass('active');
            }
        });
    });

    console.log('Rating stars initialized');
}

// Handle review form submission
$(document).on('submit', '#reviewForm', function(e) {
    e.preventDefault();

    const orderId = $(this).data('order-id');
    const formData = $(this).serialize();

    showLoading('Đang gửi đánh giá...');

    $.ajax({
        url: `/user/orders/${orderId}/reviews`,
        method: 'POST',
        data: formData + '&_token=' + $('meta[name="csrf-token"]').attr('content'),
        success: function(response) {
            hideLoading();
            $('#reviewModal').modal('hide');

            Swal.fire({
                title: 'Thành công!',
                text: 'Cảm ơn bạn đã đánh giá sản phẩm',
                icon: 'success',
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });

            // Update review button to show reviewed state
            $(`.btn-review[data-order-id="${orderId}"]`)
                .removeClass('btn-success')
                .addClass('btn-outline-success')
                .html('<i class="fas fa-check me-1"></i>Đã đánh giá')
                .prop('disabled', true);
        },
        error: function(xhr) {
            hideLoading();
            let errorMessage = 'Có lỗi xảy ra khi gửi đánh giá';

            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            }

            Swal.fire({
                title: 'Lỗi!',
                text: errorMessage,
                icon: 'error',
                toast: true,
                position: 'top-end',
                timer: 5000,
                showConfirmButton: false
            });
        }
    });
});

// Cancel order function
function cancelOrder(orderId) {
    Swal.fire({
        title: 'Xác nhận hủy đơn hàng',
        html: `
            <div class="text-center">
                <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                <p>Bạn có chắc chắn muốn hủy đơn hàng <strong class="text-primary">#${orderId}</strong>?</p>
                <p class="text-danger small">
                    <i class="fas fa-info-circle me-1"></i>
                    Hành động này không thể hoàn tác!
                </p>
            </div>
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fas fa-times me-1"></i>Hủy đơn hàng',
        cancelButtonText: '<i class="fas fa-arrow-left me-1"></i>Quay lại',
        customClass: {
            popup: 'swal-custom-popup'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            showLoading('Đang hủy đơn hàng...');

            $.ajax({
                url: `/user/orders/${orderId}/cancel`,
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    hideLoading();

                    Swal.fire({
                        title: 'Đã hủy!',
                        text: 'Đơn hàng đã được hủy thành công',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    hideLoading();

                    let errorMessage = 'Không thể hủy đơn hàng';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }

                    Swal.fire({
                        title: 'Lỗi!',
                        text: errorMessage,
                        icon: 'error'
                    });
                }
            });
        }
    });
}

// Track order function
function trackOrder(orderId) {
    $('#trackingModalBody').html(`
        <div class="text-center py-4">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Đang tải...</span>
            </div>
            <p class="mt-3">Đang tải thông tin theo dõi...</p>
        </div>
    `);

    $('#trackingModal').modal('show');

    // AJAX call to get tracking info
    $.ajax({
        url: `/user/orders/${orderId}/tracking`,
        method: 'GET',
        success: function(response) {
            renderTrackingInfo(response.tracking);
        },
        error: function(xhr) {
            $('#trackingModalBody').html(`
                <div class="text-center py-4">
                    <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                    <h5>Không thể tải thông tin theo dõi</h5>
                    <p class="text-muted">Vui lòng thử lại sau</p>
                </div>
            `);
        }
    });
}

// Render tracking information
function renderTrackingInfo(tracking) {
    let html = `
        <div class="tracking-timeline">
    `;

    const steps = [
        { key: 'pending', label: 'Đơn hàng đã được tạo', icon: 'fas fa-receipt' },
        { key: 'processing', label: 'Đang chuẩn bị hàng', icon: 'fas fa-box' },
        { key: 'shipping', label: 'Đang giao hàng', icon: 'fas fa-truck' },
        { key: 'completed', label: 'Đã giao thành công', icon: 'fas fa-check-circle' }
    ];

    steps.forEach((step, index) => {
        const isCompleted = tracking.status_history.includes(step.key);
        const isCurrent = tracking.current_status === step.key;

        html += `
            <div class="tracking-step ${isCompleted ? 'completed' : ''} ${isCurrent ? 'current' : ''}">
                <div class="tracking-icon">
                    <i class="${step.icon}"></i>
                </div>
                <div class="tracking-content">
                    <h6 class="mb-1">${step.label}</h6>
                    <p class="text-muted small mb-0">
                        ${tracking.timestamps[step.key] || 'Chưa cập nhật'}
                    </p>
                </div>
            </div>
        `;
    });

    html += `
        </div>
        <div class="tracking-info mt-4">
            <div class="row">
                <div class="col-md-6">
                    <h6>Thông tin vận chuyển</h6>
                    <p class="mb-1"><strong>Mã vận đơn:</strong> ${tracking.tracking_number || 'Chưa có'}</p>
                    <p class="mb-1"><strong>Đơn vị vận chuyển:</strong> ${tracking.shipping_company || 'Chưa xác định'}</p>
                </div>
                <div class="col-md-6">
                    <h6>Thời gian dự kiến</h6>
                    <p class="mb-1"><strong>Giao hàng:</strong> ${tracking.estimated_delivery || 'Chưa xác định'}</p>
                    <p class="mb-1"><strong>Cập nhật lần cuối:</strong> ${tracking.last_updated || 'Chưa có'}</p>
                </div>
            </div>
        </div>
    `;

    $('#trackingModalBody').html(html);
}

// Utility functions
function formatCurrency(amount) {
    return new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND'
    }).format(amount);
}

function showLoading(message = 'Đang xử lý...') {
    if ($('.loading-overlay').length === 0) {
        $('body').append(`
            <div class="loading-overlay">
                <div class="text-center">
                    <div class="loading-spinner"></div>
                    <p class="mt-3">${message}</p>
                </div>
            </div>
        `);
    }
}

function hideLoading() {
    $('.loading-overlay').remove();
}

// Initialize page
$(document).ready(function() {
    // Add smooth animations
    $('.order-card').each(function(index) {
        $(this).css('animation-delay', (index * 0.1) + 's');
        $(this).addClass('animate__animated animate__fadeInUp');
    });

    // Initialize search functionality
    let searchTimeout;
    $('input[name="search"]').on('input', function() {
        clearTimeout(searchTimeout);
        const searchTerm = $(this).val();

        searchTimeout = setTimeout(() => {
            if (searchTerm.length >= 3 || searchTerm.length === 0) {
                $(this).closest('form').submit();
            }
        }, 500);
    });
});
</script>
@endsection
