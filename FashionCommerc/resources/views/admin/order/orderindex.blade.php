@extends('admin.layout')
@section('title', 'Quản lý đơn hàng')
@section('page-title', 'Quản lý đơn hàng')

@section('content')
<div class="container-fluid">
    <!-- Card chính -->
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    <i class="fas fa-shopping-cart mr-2"></i>Danh sách đơn hàng
                </h3>
                <div class="card-tools">
                    <span class="badge badge-info">
                        Tổng: {{ method_exists($order, 'total') ? $order->total() : count($order) }} đơn hàng
                    </span>
                </div>
            </div>
        </div>

        <!-- Thanh tìm kiếm và bộ lọc -->
        <div class="card-body pb-0">
            <form action="{{ route('admin.orderindexAdmin') }}" method="GET" class="mb-3">
                <div class="row">
                    <div class="col-md-2 mb-2">
                        <input type="text" name="id_order" class="form-control" placeholder="Mã đơn hàng" value="{{ request('id_order') }}">
                    </div>
                    <div class="col-md-2 mb-2">
                        <input type="text" name="id_user" class="form-control" placeholder="Mã khách hàng" value="{{ request('id_user') }}">
                    </div>
                    <div class="col-md-2 mb-2">
                        <select name="status" class="form-control">
                            <option value="">--Trạng thái đơn--</option>
                            @foreach($statusList as $key => $label)
                                <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 mb-2">
                        <select name="payment_status" class="form-control">
                            <option value="">--Trạng thái thanh toán--</option>
                            @foreach($paymentStatusList as $key => $label)
                                <option value="{{ $key }}" {{ request('payment_status') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 mb-2">
                        <select name="payment_method" class="form-control">
                            <option value="">--Phương thức TT--</option>
                            @foreach($paymentMethodList as $key => $label)
                                <option value="{{ $key }}" {{ request('payment_method') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 mb-2">
                        <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}" placeholder="Từ ngày">
                    </div>
                    <div class="col-md-2 mb-2">
                        <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}" placeholder="Đến ngày">
                    </div>
                    <div class="col-md-2 mb-2">
                        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i> Lọc</button>
                    </div>
                    <div class="col-md-2 mb-2">
                        <a href="{{ route('admin.orderindexAdmin') }}" class="btn btn-secondary w-100"><i class="fas fa-times"></i> Xóa lọc</a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Bảng dữ liệu -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 100px;" class="text-center">Mã đơn hàng</th>
                        <th style="width: 100px;" class="text-center">Mã khách hàng</th>
                        <th style="width: 150px;" class="text-right">Tổng tiền</th>
                        <th>Địa chỉ giao hàng</th>
                        <th style="width: 120px;" class="text-center">Trạng thái</th>
                        <th style="width: 150px;" class="text-center">Ngày đặt</th>
                        <th style="width: 140px;" class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($order as $orders)
                    <tr>
                        <td class="text-center">
                            <span class="badge badge-primary">#{{ $orders->id_order }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge badge-secondary">{{ $orders->id_user }}</span>
                        </td>
                        <td class="text-right font-weight-bold text-success">
                            {{ number_format($orders->total_order, 0, ',', '.') }}đ
                        </td>
                        <td>
                            <div class="address-info">
                                <i class="fas fa-map-marker-alt text-muted mr-1"></i>
                                {{ Str::limit($orders->address, 50) }}
                                @if(strlen($orders->address) > 50)
                                    <button class="btn btn-link btn-sm p-0 ml-1"
                                            onclick="showFullAddress('{{ addslashes($orders->address) }}')">
                                        <i class="fas fa-expand-alt"></i>
                                    </button>
                                @endif
                                <br>
                                <span class="text-muted small">SĐT: {{ $orders->phone }}</span>
                            </div>
                        </td>
                        <td class="text-center">
                            <span class="badge badge-{{ $orders->status == 'pending' ? 'warning' : ($orders->status == 'processing' ? 'info' : ($orders->status == 'shipping' ? 'primary' : ($orders->status == 'completed' ? 'success' : 'danger'))) }}">
                                {{ $statusList[$orders->status] ?? $orders->status }}
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="badge badge-{{ $orders->payment_status == 'paid' ? 'success' : ($orders->payment_status == 'partial' ? 'info' : 'secondary') }}">
                                {{ $paymentStatusList[$orders->payment_status] ?? $orders->payment_status }}
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="badge badge-light border">
                                @if($orders->paymentMethod)
                                    {{ $orders->paymentMethod->name }}
                                @else
                                    {{ $paymentMethodList[$orders->payment_method] ?? $orders->payment_method ?? '-' }}
                                @endif
                            </span>
                        </td>
                        <td class="text-center text-muted">
                            <div>{{ $orders->created_at ? $orders->created_at->format('d/m/Y') : '-' }}</div>
                            <small>{{ $orders->created_at ? $orders->created_at->format('H:i') : '' }}</small>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('admin.adminDetailsOrderIndex', ['id_order' => $orders->id_order]) }}"
                                   class="btn btn-sm btn-info"
                                   title="Xem chi tiết">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button type="button"
                                        class="btn btn-sm btn-danger btn-cancel-order"
                                        data-order-id="{{ $orders->id_order }}"
                                        data-order-total="{{ number_format($orders->total_order, 0, ',', '.') }}"
                                        title="Hủy đơn hàng">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <div class="text-muted">
                                <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                                <p class="mb-0">Không có đơn hàng nào</p>
                                @if(request('id'))
                                    <small>Không tìm thấy kết quả cho "{{ request('id') }}"</small>
                                @endif
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
            <div class="modal-header">
                <h5 class="modal-title" id="addressModalLabel">Địa chỉ giao hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="addressModalBody">
                <!-- Địa chỉ sẽ được load bằng JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .address-info {
        max-width: 300px;
        word-wrap: break-word;
    }

    .table td {
        vertical-align: middle;
    }

    .btn-link {
        color: #007bff;
        text-decoration: none;
    }

    .btn-link:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    .badge {
        font-size: 0.75em;
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Auto focus vào ô tìm kiếm
        $('input[name="id"]').focus();

        // Xử lý nút hủy đơn hàng
        $('.btn-cancel-order').on('click', function() {
            const orderId = $(this).data('order-id');
            const orderTotal = $(this).data('order-total');

            Swal.fire({
                title: 'Xác nhận hủy đơn hàng',
                html: `
                    <p>Bạn có chắc chắn muốn hủy đơn hàng <strong>#${orderId}</strong>?</p>
                    <p class="text-muted">Tổng tiền: <strong>${orderTotal}đ</strong></p>
                    <p class="text-warning"><i class="fas fa-exclamation-triangle"></i> Hành động này không thể hoàn tác!</p>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Có, hủy đơn!',
                cancelButtonText: 'Không, giữ lại'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading();
                    window.location.href = `{{ route('admin.adminDetailsOrderDelete', '') }}?id_order=${orderId}`;
                }
            });
        });

        // Hiệu ứng chuyển trang mượt mà
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var url = $(this).attr('href');
            showLoading();
            setTimeout(function() {
                window.location.href = url;
            }, 300);
        });
    });

    // Hàm hiển thị địa chỉ đầy đủ
    function showFullAddress(address) {
        $('#addressModalBody').html(`<p class="mb-0"><i class="fas fa-map-marker-alt text-primary mr-2"></i>${address}</p>`);
        $('#addressModal').modal('show');
    }
</script>
@endsection