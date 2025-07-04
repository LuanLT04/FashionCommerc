@extends('user.account_dashboard')

@section('account_content')
<!-- SEO Meta Tags -->
<title>Chi tiết đơn hàng #{{ $order->id_order }} | Fashion Store</title>
<meta name="description" content="Xem chi tiết đơn hàng #{{ $order->id_order }}, bao gồm danh sách sản phẩm, thông tin giao hàng và tổng thanh toán.">

<div class="card shadow-lg">
    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="fa-solid fa-file-invoice me-2"></i>Chi tiết đơn hàng #{{ $order->id_order }}</h4>
        <a href="{{ route('order.orderIndex') }}" class="btn btn-light btn-sm"><i class="fa-solid fa-arrow-left me-2"></i>Quay lại</a>
    </div>

    <div class="card-body">
        <!-- Order Summary -->
        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <h5 class="mb-3">Thông tin người nhận</h5>
                <p class="mb-1"><strong>Tên:</strong> {{ $order->user->name ?? 'Không có' }}</p>
                <p class="mb-1"><strong>Email:</strong> {{ $order->user->email ?? 'Không có' }}</p>
                <p class="mb-1"><strong>Điện thoại:</strong> {{ $order->phone_order ?? 'Không có' }}</p>
                <p class="mb-0"><strong>Địa chỉ giao hàng:</strong> {{ $order->address_order ?? 'Không có' }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <h5 class="mb-3">Thông tin đơn hàng</h5>
                <p class="mb-1"><strong>Ngày đặt hàng:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                <p class="mb-1"><strong>Phương thức thanh toán:</strong> 
                    @if(!empty($paymentMethodName))
                        <span class="badge bg-success">{{ $paymentMethodName }}</span>
                    @else
                        <span class="badge bg-success">{{ $order->payment_method == 'cash' ? 'Thanh toán khi nhận hàng' : 'Thanh toán Online' }}</span>
                    @endif
                </p>
                <p class="mb-0"><strong>Trạng thái:</strong> 
                    @php
                        $statusMap = [
                            'pending' => ['Chờ xác nhận', 'secondary'],
                            'processing' => ['Đang xử lý', 'info'],
                            'shipping' => ['Đang giao', 'primary'],
                            'completed' => ['Đã giao', 'success'],
                            'cancelled' => ['Đã huỷ', 'danger'],
                        ];
                        $status = $order->status ?? 'pending';
                        $statusLabel = $statusMap[$status][0] ?? 'Đang cập nhật';
                        $statusColor = $statusMap[$status][1] ?? 'dark';
                    @endphp
                    <span class="badge bg-{{ $statusColor }}">{{ $statusLabel }}</span>
                </p>
            </div>
        </div>

        <!-- Product List -->
        <h5 class="mb-3">Danh sách sản phẩm</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th colspan="2">Sản phẩm</th>
                        <th class="text-center">Đơn giá</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-end">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @php $subtotal = 0; @endphp
                    @foreach($orderDetails as $item)
                    @php 
                        $itemTotal = $item->price_product * $item->quantity_detailsorder;
                        $subtotal += $itemTotal;
                    @endphp
                    <tr>
                        <td style="width: 80px;">
                            <img src="{{ asset('uploads/productimage/' . $item->image_address_product) }}" alt="{{ $item->name_product }}" class="img-fluid rounded" style="width: 70px; height: 70px; object-fit: cover;">
                        </td>
                        <td>
                            <a href="#" class="text-decoration-none text-dark fw-bold">{{ $item->name_product }}</a>
                        </td>
                        <td class="text-center">{{ number_format($item->price_product, 0, ',', '.') }}đ</td>
                        <td class="text-center">{{ $item->quantity_detailsorder }}</td>
                        <td class="text-end fw-bold">{{ number_format($itemTotal, 0, ',', '.') }}đ</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end"><strong>Tổng phụ</strong></td>
                        <td class="text-end">{{ number_format($subtotal, 0, ',', '.') }}đ</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-end"><strong>Phí vận chuyển</strong></td>
                        <td class="text-end">0đ</td>
                    </tr>
                    <tr class="table-primary">
                        <td colspan="4" class="text-end fw-bold"><h4>Tổng cộng</h4></td>
                        <td class="text-end fw-bold"><h4>{{ number_format($order->total_order, 0, ',', '.') }}đ</h4></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection