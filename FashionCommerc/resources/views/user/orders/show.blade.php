@extends('user.dashboard_user')
@section('title', 'Chi tiết đơn hàng #' . $order->id_order)

@section('content')
<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.orders.index') }}">Đơn hàng của tôi</a></li>
            <li class="breadcrumb-item active">Chi tiết đơn hàng #{{ $order->id_order }}</li>
        </ol>
    </nav>

    <!-- Order Header -->
    <div class="order-header mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="order-title mb-2">
                            <i class="fas fa-receipt me-2 text-primary"></i>
                            Đơn hàng #{{ $order->id_order }}
                        </h2>
                        <div class="order-meta">
                            <span class="text-muted me-3">
                                <i class="far fa-calendar-alt me-1"></i>
                                {{ $order->created_at->format('d/m/Y H:i') }}
                            </span>
                            <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'processing' ? 'info' : ($order->status == 'shipping' ? 'primary' : ($order->status == 'completed' ? 'success' : 'danger'))) }} fs-6 px-3 py-2">
                                {{ $statusLabels[$order->status] ?? $order->status }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="order-actions">
                            @if($order->status == 'completed')
                            <button class="btn btn-success me-2 btn-review" data-order-id="{{ $order->id_order }}">
                                <i class="fas fa-star me-1"></i>Đánh giá
                            </button>
                            @endif
                            
                            @if($order->status == 'pending')
                            <button class="btn btn-danger btn-cancel-order" data-order-id="{{ $order->id_order }}">
                                <i class="fas fa-times me-1"></i>Hủy đơn
                            </button>
                            @endif
                            
                            @if($order->status == 'shipping')
                            <button class="btn btn-info" onclick="trackOrder({{ $order->id_order }})">
                                <i class="fas fa-map-marked-alt me-1"></i>Theo dõi
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Order Details -->
        <div class="col-lg-8">
            <!-- Order Items -->
            <div class="order-items-section mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0">
                            <i class="fas fa-box me-2 text-primary"></i>
                            Sản phẩm đã đặt ({{ $order->orderDetails->count() }} sản phẩm)
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="order-items-list">
                            @foreach($order->orderDetails as $detail)
                            <div class="order-item border-bottom">
                                <div class="row align-items-center p-3">
                                    <div class="col-md-2">
                                        <div class="product-image">
                                            <img src="{{ $detail->product->image ?? '/img/no-image.png' }}" 
                                                 alt="{{ $detail->product->name }}" 
                                                 class="img-fluid rounded" 
                                                 style="max-height: 80px; object-fit: cover;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="product-info">
                                            <h6 class="product-name mb-2">{{ $detail->product->name }}</h6>
                                            <p class="product-sku text-muted mb-1">
                                                SKU: {{ $detail->product->sku ?? 'N/A' }}
                                            </p>
                                            <div class="product-attributes">
                                                @if($detail->size)
                                                <span class="badge bg-light text-dark me-1">Size: {{ $detail->size }}</span>
                                                @endif
                                                @if($detail->color)
                                                <span class="badge bg-light text-dark">Màu: {{ $detail->color }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="product-quantity">
                                            <span class="quantity-label text-muted small">Số lượng</span>
                                            <div class="quantity-value fw-bold">{{ $detail->quantity }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <div class="product-pricing">
                                            <div class="unit-price text-muted small">
                                                {{ number_format($detail->price, 0, ',', '.') }}đ/sp
                                            </div>
                                            <div class="total-price fw-bold text-primary">
                                                {{ number_format($detail->quantity * $detail->price, 0, ',', '.') }}đ
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Timeline -->
            <div class="order-timeline-section mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0">
                            <i class="fas fa-history me-2 text-primary"></i>
                            Lịch sử đơn hàng
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            @php
                            $statusHistory = [
                                'pending' => ['label' => 'Đơn hàng đã được tạo', 'icon' => 'fas fa-receipt', 'time' => $order->created_at],
                                'processing' => ['label' => 'Đang chuẩn bị hàng', 'icon' => 'fas fa-box', 'time' => null],
                                'shipping' => ['label' => 'Đang giao hàng', 'icon' => 'fas fa-truck', 'time' => null],
                                'completed' => ['label' => 'Đã giao thành công', 'icon' => 'fas fa-check-circle', 'time' => null]
                            ];
                            @endphp
                            
                            @foreach($statusHistory as $status => $info)
                            @php
                            $isCompleted = in_array($status, ['pending']) || ($order->status == $status) || 
                                          ($status == 'processing' && in_array($order->status, ['processing', 'shipping', 'completed'])) ||
                                          ($status == 'shipping' && in_array($order->status, ['shipping', 'completed'])) ||
                                          ($status == 'completed' && $order->status == 'completed');
                            $isCurrent = $order->status == $status;
                            @endphp
                            
                            <div class="timeline-item {{ $isCompleted ? 'completed' : '' }} {{ $isCurrent ? 'current' : '' }}">
                                <div class="timeline-marker">
                                    <i class="{{ $info['icon'] }}"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6 class="timeline-title">{{ $info['label'] }}</h6>
                                    <p class="timeline-time text-muted">
                                        @if($info['time'])
                                            {{ $info['time']->format('d/m/Y H:i') }}
                                        @elseif($isCompleted)
                                            Đã hoàn thành
                                        @else
                                            Chưa thực hiện
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-4">
            <!-- Payment & Shipping Info -->
            <div class="order-summary-section mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2 text-primary"></i>
                            Thông tin đơn hàng
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- Shipping Address -->
                        <div class="shipping-info mb-4">
                            <h6 class="section-title">
                                <i class="fas fa-map-marker-alt me-2 text-success"></i>
                                Địa chỉ giao hàng
                            </h6>
                            <div class="address-details">
                                <p class="mb-1 fw-bold">{{ $order->recipient_name ?? $order->user->name }}</p>
                                <p class="mb-1">{{ $order->address }}</p>
                                <p class="mb-0 text-muted">
                                    <i class="fas fa-phone me-1"></i>{{ $order->phone }}
                                </p>
                            </div>
                        </div>

                        <!-- Payment Info -->
                        <div class="payment-info mb-4">
                            <h6 class="section-title">
                                <i class="fas fa-credit-card me-2 text-info"></i>
                                Thông tin thanh toán
                            </h6>
                            <div class="payment-details">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Phương thức:</span>
                                    <span class="fw-bold">{{ $paymentMethodLabels[$order->payment_method] ?? $order->payment_method }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Trạng thái:</span>
                                    <span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }}">
                                        {{ $paymentStatusLabels[$order->payment_status] ?? $order->payment_status }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Order Total -->
                        <div class="order-total">
                            <h6 class="section-title">
                                <i class="fas fa-calculator me-2 text-warning"></i>
                                Tổng cộng
                            </h6>
                            <div class="total-breakdown">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Tạm tính:</span>
                                    <span>{{ number_format($order->orderDetails->sum(function($detail) { return $detail->quantity * $detail->price; }), 0, ',', '.') }}đ</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Phí vận chuyển:</span>
                                    <span>{{ number_format($order->shipping_fee ?? 0, 0, ',', '.') }}đ</span>
                                </div>
                                @if($order->discount_amount > 0)
                                <div class="d-flex justify-content-between mb-2 text-success">
                                    <span>Giảm giá:</span>
                                    <span>-{{ number_format($order->discount_amount, 0, ',', '.') }}đ</span>
                                </div>
                                @endif
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold fs-5">Tổng tiền:</span>
                                    <span class="fw-bold fs-4 text-primary">{{ number_format($order->total_order, 0, ',', '.') }}đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions-section">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0">
                            <i class="fas fa-bolt me-2 text-primary"></i>
                            Hành động nhanh
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('user.orders.index') }}" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách
                            </a>
                            
                            @if($order->status == 'completed')
                            <button class="btn btn-success btn-review" data-order-id="{{ $order->id_order }}">
                                <i class="fas fa-star me-2"></i>Đánh giá sản phẩm
                            </button>
                            @endif
                            
                            <button class="btn btn-info" onclick="printOrder()">
                                <i class="fas fa-print me-2"></i>In đơn hàng
                            </button>
                            
                            @if($order->status != 'cancelled')
                            <a href="mailto:support@fashioncommerce.com?subject=Hỗ trợ đơn hàng #{{ $order->id_order }}" class="btn btn-outline-secondary">
                                <i class="fas fa-headset me-2"></i>Liên hệ hỗ trợ
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include modals from orders index -->
@include('user.orders.partials.review-modal')
@include('user.orders.partials.tracking-modal')

@endsection

@section('styles')
<style>
/* Page Layout */
.order-title {
    color: #2c3e50;
    font-weight: 700;
}

.order-meta {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

/* Cards */
.card {
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}

.card-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-bottom: 1px solid #dee2e6;
    padding: 1.25rem 1.5rem;
}

.card-header h5 {
    color: #2c3e50;
    font-weight: 600;
}

/* Order Items */
.order-items-list .order-item {
    transition: all 0.3s ease;
}

.order-items-list .order-item:hover {
    background-color: #f8f9fa;
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
    margin-bottom: 0.5rem;
}

.product-sku {
    font-size: 0.85rem;
}

.product-attributes .badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
}

.product-quantity {
    text-align: center;
}

.quantity-label {
    display: block;
    font-size: 0.8rem;
    margin-bottom: 0.25rem;
}

.quantity-value {
    font-size: 1.2rem;
    color: #007bff;
}

.product-pricing {
    text-align: right;
}

.unit-price {
    font-size: 0.85rem;
    margin-bottom: 0.25rem;
}

.total-price {
    font-size: 1.1rem;
}

/* Timeline */
.timeline {
    position: relative;
    padding: 1rem 0;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 20px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    padding-left: 60px;
    margin-bottom: 2rem;
}

.timeline-item:last-child {
    margin-bottom: 0;
}

.timeline-marker {
    position: absolute;
    left: 0;
    top: 0;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    font-size: 0.9rem;
    z-index: 2;
    transition: all 0.3s ease;
}

.timeline-item.completed .timeline-marker {
    background: #28a745;
    color: white;
}

.timeline-item.current .timeline-marker {
    background: #007bff;
    color: white;
    animation: pulse 2s infinite;
}

.timeline-content {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 1rem;
    border-left: 3px solid #e9ecef;
    transition: all 0.3s ease;
}

.timeline-item.completed .timeline-content {
    border-left-color: #28a745;
    background: #f8fff9;
}

.timeline-item.current .timeline-content {
    border-left-color: #007bff;
    background: #f0f8ff;
}

.timeline-title {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.timeline-time {
    font-size: 0.85rem;
    margin-bottom: 0;
}

/* Order Summary */
.section-title {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #e9ecef;
}

.address-details,
.payment-details {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 1rem;
}

.total-breakdown {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 1rem;
}

.total-breakdown .d-flex {
    font-size: 0.95rem;
}

.total-breakdown hr {
    margin: 1rem 0;
    border-color: #dee2e6;
}

/* Action Buttons */
.order-actions .btn,
.quick-actions-section .btn {
    border-radius: 25px;
    font-weight: 600;
    padding: 0.5rem 1.5rem;
    transition: all 0.3s ease;
}

.order-actions .btn:hover,
.quick-actions-section .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

/* Breadcrumb */
.breadcrumb {
    background: transparent;
    padding: 0;
}

.breadcrumb-item a {
    color: #007bff;
    text-decoration: none;
}

.breadcrumb-item a:hover {
    text-decoration: underline;
}

.breadcrumb-item.active {
    color: #6c757d;
}

/* Responsive Design */
@media (max-width: 768px) {
    .order-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }

    .order-actions {
        margin-top: 1rem;
    }

    .order-actions .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }

    .timeline-item {
        padding-left: 50px;
    }

    .timeline-marker {
        width: 35px;
        height: 35px;
        font-size: 0.8rem;
    }

    .product-pricing,
    .product-quantity {
        text-align: left;
        margin-top: 1rem;
    }
}

/* Print Styles */
@media print {
    .order-actions,
    .quick-actions-section,
    .breadcrumb,
    .btn {
        display: none !important;
    }

    .card {
        box-shadow: none !important;
        border: 1px solid #dee2e6 !important;
    }

    .timeline-marker {
        background: #000 !important;
        color: #fff !important;
    }
}

/* Animation */
@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(0, 123, 255, 0.7); }
    70% { box-shadow: 0 0 0 10px rgba(0, 123, 255, 0); }
    100% { box-shadow: 0 0 0 0 rgba(0, 123, 255, 0); }
}

/* Loading States */
.loading-skeleton {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
}

@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}
</style>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Initialize page animations
    initializeAnimations();

    // Handle review button
    $('.btn-review').on('click', function() {
        const orderId = $(this).data('order-id');
        loadOrderProducts(orderId);
    });

    // Handle cancel order button
    $('.btn-cancel-order').on('click', function() {
        const orderId = $(this).data('order-id');
        cancelOrder(orderId);
    });
});

// Initialize page animations
function initializeAnimations() {
    // Animate cards on load
    $('.card').each(function(index) {
        $(this).css({
            'opacity': '0',
            'transform': 'translateY(20px)'
        });

        setTimeout(() => {
            $(this).css({
                'opacity': '1',
                'transform': 'translateY(0)',
                'transition': 'all 0.6s ease'
            });
        }, index * 100);
    });

    // Animate timeline items
    $('.timeline-item').each(function(index) {
        $(this).css({
            'opacity': '0',
            'transform': 'translateX(-20px)'
        });

        setTimeout(() => {
            $(this).css({
                'opacity': '1',
                'transform': 'translateX(0)',
                'transition': 'all 0.6s ease'
            });
        }, (index * 200) + 500);
    });
}

// Print order function
function printOrder() {
    // Hide elements that shouldn't be printed
    $('.order-actions, .quick-actions-section, .breadcrumb').hide();

    // Print the page
    window.print();

    // Show elements back after printing
    setTimeout(() => {
        $('.order-actions, .quick-actions-section, .breadcrumb').show();
    }, 1000);
}

// Track order function (reuse from orders index)
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

// Load order products for review (reuse from orders index)
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

// Cancel order function (reuse from orders index)
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
        cancelButtonText: '<i class="fas fa-arrow-left me-1"></i>Quay lại'
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

// Utility functions
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

// Include other functions from orders index if needed
// (renderProductReviewForm, renderTrackingInfo, etc.)
</script>
@endsection
