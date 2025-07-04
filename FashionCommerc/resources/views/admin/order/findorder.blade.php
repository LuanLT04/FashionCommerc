@extends('admin.layout')
@section('title', 'Tìm kiếm đơn hàng')
@section('page-title', 'Tìm kiếm đơn hàng')

@section('content')
<div class="container-fluid">
    <!-- Card chính -->
    <div class="card card-info card-outline">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    <i class="fas fa-search mr-2"></i>Kết quả tìm kiếm đơn hàng
                </h3>
                <div class="card-tools">
                    <a href="{{ route('admin.orderindexAdmin') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i>Quay lại danh sách
                    </a>
                </div>
            </div>
        </div>

        <!-- Thanh tìm kiếm -->
        <div class="card-body pb-0">
            <form action="{{ route('admin.adminSearchOrder') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="id" class="form-control"
                           placeholder="Tìm kiếm theo mã đơn hàng hoặc mã người dùng..."
                           value="{{ request('id') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                        <a href="{{ route('admin.orderindexAdmin') }}" class="btn btn-secondary no-loading">
                            <i class="fas fa-times"></i> Xóa
                        </a>
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
                        <th style="width: 150px;" class="text-center">Ngày đặt</th>
                        <th style="width: 140px;" class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @if($orders && count($orders) > 0)
                        @foreach($orders as $order)
                        <tr>
                            <td class="text-center">
                                <span class="badge badge-primary">#{{ $order->id_order }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-secondary">{{ $order->id_user }}</span>
                            </td>
                            <td class="text-right font-weight-bold text-success">
                                {{ number_format($order->total_order, 0, ',', '.') }}đ
                            </td>
                            <td>
                                <div class="address-info">
                                    <i class="fas fa-map-marker-alt text-muted mr-1"></i>
                                    {{ Str::limit($order->address, 50) }}
                                    @if(strlen($order->address) > 50)
                                        <button class="btn btn-link btn-sm p-0 ml-1"
                                                onclick="showFullAddress('{{ addslashes($order->address) }}')">
                                            <i class="fas fa-expand-alt"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center text-muted">
                                <div>{{ $order->created_at->format('d/m/Y') }}</div>
                                <small>{{ $order->created_at->format('H:i') }}</small>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('admin.adminDetailsOrderIndex', ['id_order' => $order->id_order]) }}"
                                       class="btn btn-sm btn-info"
                                       title="Xem chi tiết">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-danger btn-cancel-order"
                                            data-order-id="{{ $order->id_order }}"
                                            data-order-total="{{ number_format($order->total_order, 0, ',', '.') }}"
                                            title="Hủy đơn hàng">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-search fa-3x mb-3"></i>
                                    <p class="mb-0">Không tìm thấy đơn hàng nào</p>
                                    @if(request('id'))
                                        <small>Không có kết quả cho "{{ request('id') }}"</small>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Thông tin kết quả -->
        @if($orders && count($orders) > 0)
        <div class="card-footer">
            <div class="text-muted">
                <i class="fas fa-info-circle mr-1"></i>
                Tìm thấy {{ count($orders) }} đơn hàng cho từ khóa "{{ request('id') }}"
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
    });

    // Hàm hiển thị địa chỉ đầy đủ
    function showFullAddress(address) {
        $('#addressModalBody').html(`<p class="mb-0"><i class="fas fa-map-marker-alt text-primary mr-2"></i>${address}</p>`);
        $('#addressModal').modal('show');
    }
</script>
@endsection