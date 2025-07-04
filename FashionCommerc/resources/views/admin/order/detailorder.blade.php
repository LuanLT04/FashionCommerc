@extends('admin.dashboard')


<!-- Product section-->
@section('content')
<link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<main class="order-detail-form">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Thông tin đơn hàng #{{ $order->id_order }}</h5>
                </div>
                            <div class="card-body">
                        <a href="{{ route('admin.order.invoice', $order->id_order) }}" target="_blank" class="btn btn-primary mb-3"><i class="fa fa-print"></i> In hóa đơn</a>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Khách hàng:</strong> {{ $user->name ?? '-' }}<br>
                                <strong>SĐT:</strong> {{ $order->phone ?? $user->phone ?? '-' }}<br>
                                <strong>Địa chỉ:</strong> {{ $order->address }}
                                        </div>
                                        <div class="col-md-6">
                                <strong>Ngày đặt:</strong> {{ $order->created_at ? $order->created_at->format('d/m/Y H:i') : '-' }}<br>
                                <strong>Phương thức thanh toán:</strong> 
                                @if(!empty($paymentMethodName))
                                    <span class="badge badge-success">{{ $paymentMethodName }}</span>
                                @else
                                    <span class="badge badge-light border">{{ $paymentMethodList[$order->payment_method] ?? '-' }}</span>
                                @endif<br>
                                <strong>Trạng thái thanh toán:</strong> <span class="badge badge-{{ $order->payment_status == 'paid' ? 'success' : ($order->payment_status == 'partial' ? 'info' : 'secondary') }}">{{ $paymentStatusList[$order->payment_status] ?? '-' }}</span><br>
                                <strong>Trạng thái đơn hàng:</strong> <span class="badge badge-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'processing' ? 'info' : ($order->status == 'shipping' ? 'primary' : ($order->status == 'completed' ? 'success' : 'danger'))) }}">{{ $statusList[$order->status] ?? '-' }}</span>
                            </div>
                        </div>
                        @if($order->note)
                        <div class="alert alert-info py-2 px-3 mb-2"><strong>Ghi chú:</strong> {{ $order->note }}</div>
                        @endif
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0">Sản phẩm đã đặt</h6>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-bordered mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-right">Đơn giá</th>
                                    <th class="text-right">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $p)
                                <tr>
                                    <td class="text-center"><img src="{{ asset('uploads/productimage/' . $p['image']) }}" width="60" style="border-radius:6px;"></td>
                                    <td>{{ $p['name'] }}</td>
                                    <td class="text-center">{{ $p['quantity'] }}</td>
                                    <td class="text-right">{{ number_format($p['price'], 0, ',', '.') }}đ</td>
                                    <td class="text-right">{{ number_format($p['total'], 0, ',', '.') }}đ</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header bg-success text-white">
                        <h6 class="mb-0">Tổng kết đơn hàng</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2"><span>Tạm tính:</span><span>{{ number_format($total, 0, ',', '.') }}đ</span></div>
                        <div class="d-flex justify-content-between mb-2"><span>Phí ship:</span><span>{{ number_format($shipping_fee, 0, ',', '.') }}đ</span></div>
                        <div class="d-flex justify-content-between mb-2"><span>Chiết khấu:</span><span>-{{ number_format($discount, 0, ',', '.') }}đ</span></div>
                        <hr>
                        <div class="d-flex justify-content-between mb-2 font-weight-bold"><span>Tổng thanh toán:</span><span class="text-danger">{{ number_format($final_total, 0, ',', '.') }}đ</span></div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header bg-warning text-dark">
                        <h6 class="mb-0">Cập nhật trạng thái</h6>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        @php
                            $validTransitions = [
                                'pending' => ['processing', 'cancelled'],
                                'processing' => ['shipping', 'cancelled'],
                                'shipping' => ['completed', 'cancelled'],
                                'completed' => [],
                                'cancelled' => [],
                            ];
                            $current = $order->status;
                            $nexts = $validTransitions[$current] ?? [];
                        @endphp
                        <form action="{{ route('admin.order.updateStatus') }}" method="POST" id="update-status-form">
                            @csrf
                            <input type="hidden" name="id_order" value="{{ $order->id_order }}">
                            <div class="form-group mb-2">
                                <label for="status">Trạng thái đơn hàng</label>
                                <select name="status" id="status" class="form-control" @if($current=='completed'||$current=='cancelled') disabled @endif>
                                    <option value="{{ $current }}">{{ $statusList[$current] }}</option>
                                    @foreach($nexts as $key)
                                        <option value="{{ $key }}">{{ $statusList[$key] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="payment_status">Trạng thái thanh toán</label>
                                <select name="payment_status" id="payment_status" class="form-control">
                                    @foreach($paymentStatusList as $key => $label)
                                        <option value="{{ $key }}" {{ $order->payment_status == $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="payment_method">Phương thức thanh toán</label>
                                <select name="payment_method" id="payment_method" class="form-control">
                                    @foreach($paymentMethodList as $key => $label)
                                        <option value="{{ $key }}" {{ $order->payment_method == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach  
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success btn-block" @if($current=='completed'||$current=='cancelled') disabled @endif>Cập nhật trạng thái</button>
                    </form>                             
                        <button class="btn btn-danger btn-block mt-2" id="btn-cancel-order">Huỷ đơn hàng</button>
                    </div>
                </div>
            </div>
            </div>
        </div>
</main>

<style>
.product-info {
    margin-bottom: 20px;
    margin-top: 20px;
}

.quantity{
    margin-top: 50px;
}

.form-cart .product-item {
    width: 100%;
}

.form-cart .product-item img {
    margin-right: 25%;
    margin-left: 25%;
    width: 50%;
    height: 200px;
}

.product-info a {
    text-decoration: none;
}

.product-info a h3 {
    color: gray;
}

.product-info .price {
    font-weight: 600;
    color: red;
}

#total {
    background-color: #fff;
    border: 1px solid rgba(145, 158, 171, .239);
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    bottom: 0;
    box-shadow: 0 -4px 20px -1px rgba(40, 124, 234, .15);
    display: flex;
    justify-content: space-between;
    left: 50%;
    margin: auto;
    max-width: 1000px;
    padding: 10px 10px 15px;
    position: fixed;
    transform: translateX(-50%);
    width: 100%;
    z-index: 11;
}

.total-card {
    color: red;
    font-weight: 600;
}

#product-item {
    max-width: 100%;
    margin-top: 20px
}
</style>

<script>
const plus = document.querySelector(".plus"),
    minus = document.querySelector(".minus"),
    num = document.querySelector(".num");
let a = 1;
plus.addEventListener("click", () => {
    a++;
    a = (a < 10) ? "0" + a : a;
    num.innerText = a;
});
minus.addEventListener("click", () => {
    if (a > 1) {
        a--;
        a = (a < 10) ? "0" + a : a;
        num.innerText = a;
    }

});

// Popup xác nhận huỷ đơn
document.getElementById('btn-cancel-order').onclick = function() {
    Swal.fire({
        title: 'Huỷ đơn hàng',
        input: 'text',
        inputLabel: 'Lý do huỷ',
        inputPlaceholder: 'Nhập lý do huỷ đơn...',
        showCancelButton: true,
        confirmButtonText: 'Huỷ đơn',
        cancelButtonText: 'Đóng',
        icon: 'warning',
    }).then((result) => {
        if (result.isConfirmed && result.value) {
            // Gửi request huỷ đơn (cần bổ sung route xử lý)
            window.location.href = `/admin/order/cancel?id_order={{ $order->id_order }}&note=${encodeURIComponent(result.value)}`;
        }
    });
};
</script>
@endsection