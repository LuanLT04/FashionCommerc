@extends('admin.layout')
@section('title', 'Quản lý đơn hàng')
@section('page-title', 'Quản lý đơn hàng')

@section('content')
<div class="container-fluid">
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalOrders ?? 0 }}</h3>
                    <p>Tổng đơn hàng</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $completedOrders ?? 0 }}</h3>
                    <p>Đã hoàn thành</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $pendingOrders ?? 0 }}</h3>
                    <p>Chờ xử lý</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ number_format($totalRevenue ?? 0, 0, ',', '.') }}đ</h3>
                    <p>Doanh thu</p>
                </div>
                <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="card shadow-sm">
        <div class="card-header bg-gradient-primary">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title text-white mb-0">
                    <i class="fas fa-list-alt mr-2"></i>Danh sách đơn hàng
                </h3>
                <div class="card-tools">
                    <span class="badge badge-light">
                        {{ method_exists($order, 'total') ? $order->total() : count($order) }} đơn hàng
                    </span>
                </div>
            </div>
        </div>

        <!-- Advanced Search & Filter -->
        <div class="card-body">
            <div class="search-filter-section bg-light p-3 rounded mb-3">
                <form action="{{ route('admin.orderindexAdmin') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label text-muted small">Mã đơn hàng</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                </div>
                                <input type="text" name="id_order" class="form-control" placeholder="Nhập mã đơn hàng" value="{{ request('id_order') }}">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label text-muted small">Mã khách hàng</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="id_user" class="form-control" placeholder="Nhập mã KH" value="{{ request('id_user') }}">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label text-muted small">Trạng thái đơn hàng</label>
                            <select name="status" class="form-control custom-select">
                                <option value="">Tất cả trạng thái</option>
                                @foreach($statusList as $key => $label)
                                    <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label text-muted small">Trạng thái thanh toán</label>
                            <select name="payment_status" class="form-control custom-select">
                                <option value="">Tất cả thanh toán</option>
                                @foreach($paymentStatusList as $key => $label)
                                    <option value="{{ $key }}" {{ request('payment_status') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label text-muted small">Phương thức thanh toán</label>
                            <select name="payment_method" class="form-control custom-select">
                                <option value="">Tất cả phương thức</option>
                                @foreach($paymentMethodList as $key => $label)
                                    <option value="{{ $key }}" {{ request('payment_method') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label text-muted small">Từ ngày</label>
                            <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label text-muted small">Đến ngày</label>
                            <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
                        </div>
                        <div class="col-md-3 mb-3 d-flex align-items-end">
                            <div class="btn-group w-100">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Tìm kiếm
                                </button>
                                <a href="{{ route('admin.orderindexAdmin') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-redo"></i> Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="bg-gradient-dark text-white">
                    <tr>
                        <th class="text-center" style="width: 80px;">
                            <i class="fas fa-hashtag"></i> Mã ĐH
                        </th>
                        <th class="text-center" style="width: 200px;">
                            <i class="fas fa-user"></i> Khách hàng
                        </th>
                        <th class="text-center" style="width: 120px;">
                            <i class="fas fa-money-bill-wave"></i> Tổng tiền
                        </th>
                        <th style="width: 250px;">
                            <i class="fas fa-map-marker-alt"></i> Địa chỉ giao hàng
                        </th>
                        <th class="text-center" style="width: 150px;">
                            <i class="fas fa-info-circle"></i> Trạng thái
                        </th>
                        <th class="text-center" style="width: 120px;">
                            <i class="fas fa-calendar"></i> Ngày đặt
                        </th>
                        <th class="text-center" style="width: 180px;">
                            <i class="fas fa-cogs"></i> Thao tác
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($order as $orders)
                    <tr class="order-row" data-order-id="{{ $orders->id_order }}">
                        <td class="text-center">
                            <div class="order-id-badge">
                                <span class="badge badge-primary badge-lg">#{{ $orders->id_order }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="customer-info">
                                <div class="d-flex align-items-center">
                                    <div class="customer-avatar mr-2">
                                        @if($orders->user && $orders->user->avatar)
                                            <img src="{{ $orders->user->avatar_url }}" alt="Avatar" class="rounded-circle" width="32" height="32">
                                        @else
                                            <div class="avatar-placeholder">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="customer-name font-weight-bold">
                                            {{ $orders->user->name ?? 'Khách hàng #' . $orders->id_user }}
                                        </div>
                                        <small class="text-muted">ID: {{ $orders->id_user }}</small>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="order-total">
                                <span class="amount font-weight-bold text-success">
                                    {{ number_format($orders->total_order, 0, ',', '.') }}đ
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="address-info">
                                <div class="address-text">
                                    <i class="fas fa-map-marker-alt text-primary mr-1"></i>
                                    {{ Str::limit($orders->address, 40) }}
                                    @if(strlen($orders->address) > 40)
                                        <button class="btn btn-link btn-sm p-0 ml-1" onclick="showFullAddress('{{ addslashes($orders->address) }}')">
                                            <i class="fas fa-expand-alt"></i>
                                        </button>
                                    @endif
                                </div>
                                <div class="contact-info mt-1">
                                    <small class="text-muted">
                                        <i class="fas fa-phone mr-1"></i>{{ $orders->phone }}
                                    </small>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="status-badges">
                                <div class="order-status mb-1">
                                    <span class="badge badge-pill badge-{{ $orders->status == 'pending' ? 'warning' : ($orders->status == 'processing' ? 'info' : ($orders->status == 'shipping' ? 'primary' : ($orders->status == 'completed' ? 'success' : 'danger'))) }}">
                                        {{ $statusList[$orders->status] ?? $orders->status }}
                                    </span>
                                </div>
                                <div class="payment-status">
                                    <span class="badge badge-outline-{{ $orders->payment_status == 'paid' ? 'success' : ($orders->payment_status == 'partial' ? 'info' : 'secondary') }}">
                                        {{ $paymentStatusList[$orders->payment_status] ?? $orders->payment_status }}
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="order-date">
                                <div class="date font-weight-bold">
                                    {{ $orders->created_at ? $orders->created_at->format('d/m/Y') : '-' }}
                                </div>
                                <small class="time text-muted">
                                    {{ $orders->created_at ? $orders->created_at->format('H:i') : '' }}
                                </small>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="action-buttons">
                                <div class="btn-group-vertical btn-group-sm">
                                    <a href="{{ route('admin.adminDetailsOrderIndex', ['id_order' => $orders->id_order]) }}"
                                       class="btn btn-info btn-sm mb-1" title="Xem chi tiết">
                                        <i class="fas fa-eye"></i> Chi tiết
                                    </a>

                                    @if($orders->status == 'completed')
                                        <button type="button" class="btn btn-success btn-sm mb-1 btn-review"
                                                data-order-id="{{ $orders->id_order }}" title="Đánh giá sản phẩm">
                                            <i class="fas fa-star"></i> Đánh giá
                                        </button>
                                    @endif

                                    @if($orders->status != 'completed' && $orders->status != 'cancelled')
                                        <button type="button" class="btn btn-warning btn-sm mb-1 btn-update-status"
                                                data-order-id="{{ $orders->id_order }}"
                                                data-current-status="{{ $orders->status }}" title="Cập nhật trạng thái">
                                            <i class="fas fa-edit"></i> Cập nhật
                                        </button>
                                    @endif

                                    @if($orders->status == 'pending')
                                        <button type="button" class="btn btn-danger btn-sm btn-cancel-order"
                                                data-order-id="{{ $orders->id_order }}"
                                                data-order-total="{{ number_format($orders->total_order, 0, ',', '.') }}" title="Hủy đơn hàng">
                                            <i class="fas fa-times"></i> Hủy
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="empty-state">
                                <div class="empty-icon mb-3">
                                    <i class="fas fa-shopping-cart fa-4x text-muted"></i>
                                </div>
                                <h5 class="text-muted mb-2">Không có đơn hàng nào</h5>
                                <p class="text-muted mb-0">
                                    @if(request()->hasAny(['id_order', 'id_user', 'status', 'payment_status']))
                                        Không tìm thấy đơn hàng phù hợp với bộ lọc
                                    @else
                                        Chưa có đơn hàng nào được tạo
                                    @endif
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Phân trang -->
        @if($order->hasPages())
        <div class="card-footer clearfix">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Hiển thị {{ $order->firstItem() ?? 1 }} đến {{ $order->lastItem() ?? count($order) }}
                    trong tổng số {{ $order->total() }} đơn hàng
                </div>
                <div>
                    {{ $order->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Modal xem địa chỉ đầy đủ -->
<div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addressModalLabel">
                    <i class="fas fa-map-marker-alt mr-2"></i>Địa chỉ giao hàng
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="addressModalBody">
                <!-- Địa chỉ sẽ được load bằng JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>Đóng
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal cập nhật trạng thái đơn hàng -->
<div class="modal fade" id="updateStatusModal" tabindex="-1" role="dialog" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="updateStatusModalLabel">
                    <i class="fas fa-edit mr-2"></i>Cập nhật trạng thái đơn hàng
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateStatusForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="newStatus">Trạng thái mới:</label>
                        <select class="form-control" id="newStatus" name="status" required>
                            <option value="">Chọn trạng thái</option>
                            @foreach($statusList as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="statusNote">Ghi chú (tùy chọn):</label>
                        <textarea class="form-control" id="statusNote" name="note" rows="3" placeholder="Nhập ghi chú về việc cập nhật trạng thái..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Hủy
                    </button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save mr-1"></i>Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal đánh giá sản phẩm -->
<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="reviewModalLabel">
                    <i class="fas fa-star mr-2"></i>Đánh giá sản phẩm
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="reviewModalBody">
                <div class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Đang tải...</span>
                    </div>
                    <p class="mt-2">Đang tải danh sách sản phẩm...</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Main Layout */
    .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }

    .card-header.bg-gradient-primary {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        border: none;
    }

    /* Statistics Cards */
    .small-box {
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .small-box:hover {
        transform: translateY(-5px);
    }

    /* Search Filter Section */
    .search-filter-section {
        border: 1px solid #e9ecef;
        border-radius: 10px;
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 5px;
    }

    .input-group-text {
        background: #f8f9fa;
        border-color: #ced4da;
    }

    /* Table Styling */
    .table {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }

    .table thead th {
        border: none;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .table tbody tr {
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
        transform: scale(1.01);
    }

    .table td {
        vertical-align: middle;
        border-color: #f1f3f4;
        padding: 15px 10px;
    }

    /* Order Row Styling */
    .order-row {
        border-left: 4px solid transparent;
    }

    .order-row[data-status="completed"] {
        border-left-color: #28a745;
    }

    .order-row[data-status="pending"] {
        border-left-color: #ffc107;
    }

    .order-row[data-status="processing"] {
        border-left-color: #17a2b8;
    }

    .order-row[data-status="shipping"] {
        border-left-color: #007bff;
    }

    .order-row[data-status="cancelled"] {
        border-left-color: #dc3545;
    }

    /* Customer Info */
    .customer-info .customer-avatar {
        position: relative;
    }

    .avatar-placeholder {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #007bff, #0056b3);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 14px;
    }

    .customer-name {
        color: #2c3e50;
        font-size: 0.9rem;
    }

    /* Order ID Badge */
    .order-id-badge .badge-lg {
        font-size: 0.9rem;
        padding: 8px 12px;
        border-radius: 20px;
    }

    /* Order Total */
    .order-total .amount {
        font-size: 1.1rem;
        color: #28a745 !important;
    }

    /* Address Info */
    .address-info {
        max-width: 250px;
    }

    .address-text {
        font-size: 0.9rem;
        line-height: 1.4;
    }

    .contact-info {
        font-size: 0.8rem;
    }

    /* Status Badges */
    .status-badges .badge-pill {
        padding: 6px 12px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .badge-outline-success {
        color: #28a745;
        border: 1px solid #28a745;
        background: transparent;
    }

    .badge-outline-info {
        color: #17a2b8;
        border: 1px solid #17a2b8;
        background: transparent;
    }

    .badge-outline-secondary {
        color: #6c757d;
        border: 1px solid #6c757d;
        background: transparent;
    }

    /* Order Date */
    .order-date .date {
        color: #2c3e50;
        font-size: 0.9rem;
    }

    .order-date .time {
        font-size: 0.75rem;
    }

    /* Action Buttons */
    .action-buttons .btn-group-vertical .btn {
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 5px 10px;
        min-width: 80px;
        transition: all 0.3s ease;
    }

    .action-buttons .btn:hover {
        transform: translateX(3px);
    }

    /* Empty State */
    .empty-state {
        padding: 40px 20px;
    }

    .empty-icon {
        opacity: 0.5;
    }

    /* Modal Enhancements */
    .modal-content {
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }

    .modal-header {
        border: none;
        padding: 20px 25px 15px;
    }

    .modal-body {
        padding: 20px 25px;
    }

    .modal-footer {
        border: none;
        padding: 15px 25px 20px;
    }

    /* Review Modal Specific */
    .product-review-item {
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }

    .product-review-item:hover {
        border-color: #007bff;
        box-shadow: 0 2px 10px rgba(0,123,255,0.1);
    }

    .product-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
    }

    .rating-stars {
        font-size: 1.2rem;
        color: #ffc107;
    }

    .rating-stars .star {
        cursor: pointer;
        transition: color 0.2s ease;
    }

    .rating-stars .star:hover,
    .rating-stars .star.active {
        color: #ffc107;
    }

    .rating-stars .star.inactive {
        color: #e9ecef;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .table-responsive {
            font-size: 0.85rem;
        }

        .action-buttons .btn-group-vertical .btn {
            font-size: 0.7rem;
            padding: 4px 8px;
            min-width: 70px;
        }

        .customer-info .customer-name {
            font-size: 0.8rem;
        }

        .address-info {
            max-width: 200px;
        }
    }

    /* Loading Animation */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255,255,255,0.8);
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
<script>
    $(document).ready(function() {
        // Auto focus vào ô tìm kiếm
        $('input[name="id_order"]').focus();

        // Set data attributes for order rows
        $('.order-row').each(function() {
            const status = $(this).find('.order-status .badge').text().toLowerCase();
            $(this).attr('data-status', status);
        });

        // Xử lý nút hủy đơn hàng
        $('.btn-cancel-order').on('click', function() {
            const orderId = $(this).data('order-id');
            const orderTotal = $(this).data('order-total');

            Swal.fire({
                title: 'Xác nhận hủy đơn hàng',
                html: `
                    <div class="text-center">
                        <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                        <p>Bạn có chắc chắn muốn hủy đơn hàng <strong class="text-primary">#${orderId}</strong>?</p>
                        <p class="text-muted">Tổng tiền: <strong class="text-success">${orderTotal}đ</strong></p>
                        <p class="text-danger"><i class="fas fa-info-circle"></i> Hành động này không thể hoàn tác!</p>
                    </div>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-times mr-1"></i>Hủy đơn hàng',
                cancelButtonText: '<i class="fas fa-arrow-left mr-1"></i>Quay lại',
                customClass: {
                    popup: 'animated fadeIn'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading('Đang hủy đơn hàng...');
                    window.location.href = `{{ route('admin.adminDetailsOrderDelete', '') }}?id_order=${orderId}`;
                }
            });
        });

        // Xử lý nút cập nhật trạng thái
        $('.btn-update-status').on('click', function() {
            const orderId = $(this).data('order-id');
            const currentStatus = $(this).data('current-status');

            $('#updateStatusForm').attr('action', `/admin/orders/${orderId}/update-status`);
            $('#newStatus').val('').trigger('change');
            $('#statusNote').val('');

            // Remove current status from options
            $('#newStatus option').show();
            $(`#newStatus option[value="${currentStatus}"]`).hide();

            $('#updateStatusModal').modal('show');
        });

        // Xử lý form cập nhật trạng thái
        $('#updateStatusForm').on('submit', function(e) {
            e.preventDefault();

            const formData = $(this).serialize();
            const actionUrl = $(this).attr('action');

            showLoading('Đang cập nhật trạng thái...');

            $.ajax({
                url: actionUrl,
                method: 'POST',
                data: formData,
                success: function(response) {
                    hideLoading();
                    $('#updateStatusModal').modal('hide');

                    Swal.fire({
                        title: 'Thành công!',
                        text: 'Trạng thái đơn hàng đã được cập nhật',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    hideLoading();
                    Swal.fire({
                        title: 'Lỗi!',
                        text: 'Có lỗi xảy ra khi cập nhật trạng thái',
                        icon: 'error'
                    });
                }
            });
        });

        // Xử lý nút đánh giá sản phẩm
        $('.btn-review').on('click', function() {
            const orderId = $(this).data('order-id');
            loadOrderProducts(orderId);
        });

        // Hiệu ứng chuyển trang mượt mà
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var url = $(this).attr('href');
            showLoading('Đang tải trang...');
            setTimeout(function() {
                window.location.href = url;
            }, 300);
        });

        // Hover effects for table rows
        $('.table tbody tr').hover(
            function() {
                $(this).addClass('table-hover-effect');
            },
            function() {
                $(this).removeClass('table-hover-effect');
            }
        );
    });

    // Hàm hiển thị địa chỉ đầy đủ
    function showFullAddress(address) {
        $('#addressModalBody').html(`
            <div class="address-display">
                <div class="d-flex align-items-start">
                    <i class="fas fa-map-marker-alt text-primary mr-3 mt-1"></i>
                    <div>
                        <h6 class="mb-2">Địa chỉ giao hàng:</h6>
                        <p class="mb-0">${address}</p>
                    </div>
                </div>
            </div>
        `);
        $('#addressModal').modal('show');
    }

    // Hàm load danh sách sản phẩm để đánh giá
    function loadOrderProducts(orderId) {
        $('#reviewModalBody').html(`
            <div class="text-center py-4">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Đang tải...</span>
                </div>
                <p class="mt-3">Đang tải danh sách sản phẩm...</p>
            </div>
        `);

        $('#reviewModal').modal('show');

        // AJAX call to get order products
        $.ajax({
            url: `/admin/orders/${orderId}/products`,
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
                    </div>
                `);
            }
        });
    }

    // Hàm render form đánh giá sản phẩm
    function renderProductReviewForm(products, orderId) {
        let html = `
            <form id="reviewForm" data-order-id="${orderId}">
                <div class="products-review-list">
        `;

        products.forEach(function(product, index) {
            html += `
                <div class="product-review-item">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <img src="${product.image || '/img/no-image.png'}" alt="${product.name}" class="product-image">
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-1">${product.name}</h6>
                            <p class="text-muted small mb-0">SKU: ${product.sku || 'N/A'}</p>
                            <p class="text-muted small">Số lượng: ${product.quantity}</p>
                        </div>
                        <div class="col-md-4">
                            <div class="rating-section">
                                <label class="form-label small">Đánh giá:</label>
                                <div class="rating-stars" data-product-id="${product.id}">
                                    ${[1,2,3,4,5].map(star => `<span class="star" data-rating="${star}">★</span>`).join('')}
                                </div>
                                <input type="hidden" name="products[${index}][id]" value="${product.id}">
                                <input type="hidden" name="products[${index}][rating]" value="5" class="rating-input">
                            </div>
                            <div class="mt-2">
                                <textarea name="products[${index}][comment]" class="form-control form-control-sm"
                                         rows="2" placeholder="Nhận xét về sản phẩm..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });

        html += `
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-star mr-2"></i>Gửi đánh giá
                    </button>
                </div>
            </form>
        `;

        $('#reviewModalBody').html(html);

        // Initialize rating stars
        initializeRatingStars();
    }

    // Hàm khởi tạo rating stars
    function initializeRatingStars() {
        $('.rating-stars .star').on('click', function() {
            const rating = $(this).data('rating');
            const $ratingContainer = $(this).parent();
            const $ratingInput = $ratingContainer.siblings('.rating-input');

            $ratingInput.val(rating);

            $ratingContainer.find('.star').each(function(index) {
                if (index < rating) {
                    $(this).addClass('active').removeClass('inactive');
                } else {
                    $(this).addClass('inactive').removeClass('active');
                }
            });
        });

        // Set default 5 stars
        $('.rating-stars').each(function() {
            $(this).find('.star').addClass('active');
        });
    }

    // Xử lý form đánh giá
    $(document).on('submit', '#reviewForm', function(e) {
        e.preventDefault();

        const orderId = $(this).data('order-id');
        const formData = $(this).serialize();

        showLoading('Đang gửi đánh giá...');

        $.ajax({
            url: `/admin/orders/${orderId}/reviews`,
            method: 'POST',
            data: formData + '&_token=' + $('meta[name="csrf-token"]').attr('content'),
            success: function(response) {
                hideLoading();
                $('#reviewModal').modal('hide');

                Swal.fire({
                    title: 'Thành công!',
                    text: 'Đánh giá sản phẩm đã được gửi',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            },
            error: function(xhr) {
                hideLoading();
                Swal.fire({
                    title: 'Lỗi!',
                    text: 'Có lỗi xảy ra khi gửi đánh giá',
                    icon: 'error'
                });
            }
        });
    });

    // Hàm hiển thị loading
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

    // Hàm ẩn loading
    function hideLoading() {
        $('.loading-overlay').remove();
    }
</script>
@endsection