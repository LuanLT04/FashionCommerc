@extends('user.dashboard_user')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/user/myorder.css') }}">
<main class="container py-4">
    <h2 class="mb-4 text-center">Đơn hàng của bạn</h2>
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @forelse($order as $item)
    <div class="order-card mb-4">
        <div class="order-header">
            <div>
                <div><b>Mã đơn:</b> #{{ $item->id_order }}</div>
                <div><b>Ngày đặt:</b> {{ $item->created_at ? date('d/m/Y H:i', strtotime($item->created_at)) : '-' }}</div>
                <div><b>Địa chỉ nhận:</b> {{ $item->address }}</div>
            </div>
            <div class="text-end">
                @php
                    $status = $item->status ?? 'pending';
                    $statusMap = [
                        'pending' => ['Chờ xác nhận', 'secondary'],
                        'processing' => ['Đang xử lý', 'info'],
                        'shipping' => ['Đang giao', 'primary'],
                        'completed' => ['Đã giao', 'success'],
                        'cancelled' => ['Đã huỷ', 'danger'],
                    ];
                    $statusLabel = $statusMap[$status][0] ?? $status;
                    $statusColor = $statusMap[$status][1] ?? 'secondary';
                @endphp
                <span class="order-status-badge badge bg-{{ $statusColor }}">{{ $statusLabel }}</span>
                <div class="mt-2"><b>Tổng tiền:</b> <span class="text-danger">{{ number_format($item->total_order, 0, ',', '.') }}đ</span></div>
            </div>
        </div>
        <div class="px-4 order-progress">
            <div class="progress" style="height: 8px;">
                @php
                    $progress = match($status) {
                        'pending' => 10,
                        'processing' => 40,
                        'shipping' => 70,
                        'completed' => 100,
                        'cancelled' => 100,
                        default => 10
                    };
                    $progressColor = $status === 'cancelled' ? 'bg-danger' : 'bg-success';
                @endphp
                <div class="progress-bar {{ $progressColor }}" role="progressbar" style="width: {{ $progress }}%"></div>
            </div>
                </div>
        <div class="accordion order-products" id="accordion-{{ $item->id_order }}">
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading-{{ $item->id_order }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $item->id_order }}" aria-expanded="false" aria-controls="collapse-{{ $item->id_order }}">
                        <i class="fa fa-list"></i> &nbsp; Xem danh sách sản phẩm
                    </button>
                </h2>
                <div id="collapse-{{ $item->id_order }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $item->id_order }}" data-bs-parent="#accordion-{{ $item->id_order }}">
                    <div class="accordion-body">
                        @php
                        $details = \App\Models\DetailsOrder::where('id_order', $item->id_order)->get();
                        @endphp
                        @foreach($details as $d)
                        @php $product = \App\Models\Product::where('id_product', $d->id_product)->first(); @endphp
                        <div class="product-item">
                            <img src="{{ asset('uploads/productimage/' . ($product->image_address_product ?? '')) }}" class="product-img" alt="">
                            <div>
                                <div><b>{{ $product->name_product ?? 'Sản phẩm đã xoá' }}</b></div>
                                <div>Số lượng: {{ $d->quantity_detailsorder }}</div>
                                <div>Giá: {{ number_format($product->price_product ?? 0, 0, ',', '.') }}đ</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end gap-2 p-3">
            <a href="{{ route('detailsorder.detailsOrderIndex', ['id_order' => $item->id_order, 'id_user' => $item->id_user]) }}" class="btn btn-outline-primary"><i class="fa fa-eye"></i> Xem chi tiết</a>
            @if($status == 'pending' || $status == 'processing')
            <a href="{{ route('order.deleteOrder', ['id_order' => $item->id_order]) }}" class="btn btn-outline-danger" onclick="return confirm('Bạn có chắc chắn muốn huỷ đơn hàng này?')"><i class="fa fa-times"></i> Huỷ đơn</a>
            @endif
            @if($status == 'completed')
            <a href="{{ route('admin.order.invoice', $item->id_order) }}" target="_blank" class="btn btn-outline-success"><i class="fa fa-print"></i> In hóa đơn</a>
            @endif
        </div>
    </div>
    @empty
    <div class="alert alert-info text-center">Bạn chưa có đơn hàng nào.</div>
    @endforelse
</main>
@endsection