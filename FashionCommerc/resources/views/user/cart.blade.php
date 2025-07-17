@extends('user.dashboard_user')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<link rel="stylesheet" href="{{ asset('css/user/cart.css') }}">
<main class="cart-form">
    <div class="container py-5">
        <h3 class="mb-4 text-center">🛒 Giỏ hàng của bạn</h3>
        <form action="{{ route('order.addOrder') }}" method="post" id="cart-form">
            @csrf
            <div class="table-responsive mb-4">
                <table class="table cart-table table-bordered align-middle">
                    <thead class="thead-light">
                        <tr>
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Đơn giá</th>
                            <th style="width:120px">Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($product as $item)
                        <tr>
                            <td><img src="{{ asset('uploads/productimage/' . $item->image_address_product) }}" alt=""></td>
                            <td class="text-left">{{ $item->name_product }}</td>
                            <td>{{ number_format($item->price_product) }}đ</td>
                            <td>
                                <div class="input-group justify-content-center">
                                    <a href="{{ route('cart.updateQuantity', ['id' => $item->id_product, 'type' => 'decrease']) }}" class="btn btn-light border px-2 py-1"><i class="fa fa-minus"></i></a>
                                    <input type="text" value="{{ $item->quantity_product }}" readonly class="form-control text-center" style="width:40px;">
                                    <a href="{{ route('cart.updateQuantity', ['id' => $item->id_product, 'type' => 'increase']) }}" class="btn btn-light border px-2 py-1"><i class="fa fa-plus"></i></a>
                                </div>
                            </td>
                            <td>{{ number_format($item->price_product * $item->quantity_product) }}đ</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-delete-product" data-url="{{ route('cart.deleteproductcart', ['id' => $item->id_product]) }}"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center text-muted">Giỏ hàng trống</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="row justify-content-end">
                <div class="col-md-5">
                    <div class="cart-summary mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tạm tính:</span>
                            <span>{{ number_format($totalAll) }}đ</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Phí ship:</span>
                            <span>0đ</span>
                            </div>
                        <hr>
                        <div class="d-flex justify-content-between total mb-3">
                            <span>Tổng cộng:</span>
                            <span>{{ number_format($totalAll) }}đ</span>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label"><b>Địa chỉ nhận hàng</b> <span class="text-danger">*</span></label>
                            <input type="text" name="address" id="address" class="form-control" placeholder="Nhập địa chỉ nhận hàng..." required>
                        </div>
                        <div class="mb-3">
                            <label for="payment_method" class="form-label"><b>Phương thức thanh toán</b> <span class="text-danger">*</span></label>
                            <select name="payment_method_id" id="payment_method" class="form-control" required>
                                <option value="">-- Chọn phương thức thanh toán --</option>
                                @foreach($paymentMethods as $method)
                                    <option value="{{ $method->id }}" data-name="{{ strtolower($method->name) }}">{{ $method->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="wallet-balance-info" style="display:none;" class="mb-2">
                            <span>Số dư ví của bạn: <b id="wallet-balance"></b>đ</span>
                            <span id="wallet-warning" class="text-danger" style="display:none;"></span>
                        </div>
                        <button type="submit" class="btn btn-success btn-checkout" @if(empty($product) || count($product)==0) disabled @endif>Thanh toán</button>
                        <a href="{{ route('home.index') }}" class="btn btn-outline-secondary btn-block mt-2">&larr; Tiếp tục mua hàng</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/user/notifications.js') }}"></script>
<script src="{{ asset('js/user/cart.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentSelect = document.getElementById('payment_method');
        const walletInfo = document.getElementById('wallet-balance-info');
        const walletBalance = document.getElementById('wallet-balance');
        const walletWarning = document.getElementById('wallet-warning');
        const totalAll = @json($totalAll ?? 0);
        const userBalance = @json(Auth::user() ? Auth::user()->balance : 0);
        paymentSelect.addEventListener('change', function() {
            const selected = paymentSelect.options[paymentSelect.selectedIndex];
            if (selected.dataset.name === 'ví') {
                walletInfo.style.display = '';
                walletBalance.textContent = userBalance.toLocaleString();
                if (userBalance < totalAll) {
                    walletWarning.textContent = 'Số dư ví không đủ để thanh toán đơn hàng!';
                    walletWarning.style.display = '';
                } else {
                    walletWarning.textContent = '';
                    walletWarning.style.display = 'none';
                }
            } else {
                walletInfo.style.display = 'none';
            }
        });
    });
</script>
@endsection