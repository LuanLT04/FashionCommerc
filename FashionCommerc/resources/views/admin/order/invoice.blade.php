@extends('admin.layout')
@section('content')
<style>
.invoice-box {
    max-width: 800px;
    margin: auto;
    padding: 30px;
    border: 1px solid #eee;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    font-size: 16px;
    line-height: 24px;
    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    color: #555;
    background: #fff;
}
.invoice-box table {
    width: 100%;
    line-height: inherit;
    text-align: left;
}
.invoice-box table td {
    padding: 5px;
    vertical-align: top;
}
.invoice-box table tr.top table td {
    padding-bottom: 20px;
}
.invoice-box table tr.information table td {
    padding-bottom: 20px;
}
.invoice-box table tr.heading td {
    background: #eee;
    border-bottom: 1px solid #ddd;
    font-weight: bold;
}
.invoice-box table tr.details td {
    padding-bottom: 10px;
}
.invoice-box table tr.item td{
    border-bottom: 1px solid #eee;
}
.invoice-box table tr.item.last td {
    border-bottom: none;
}
.invoice-box table tr.total td:nth-child(2) {
    border-top: 2px solid #eee;
    font-weight: bold;
}
@media print {
    .no-print { display: none; }
    body { background: #fff !important; }
}
</style>
<div class="invoice-box">
    <div class="no-print mb-3 text-right">
        <button onclick="window.print()" class="btn btn-success"><i class="fa fa-print"></i> In hóa đơn</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Quay lại</a>
    </div>
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="4">
                <table>
                    <tr>
                        <td>
                            <h2>HÓA ĐƠN BÁN HÀNG</h2>
                            <b>Mã đơn:</b> #{{ $order->id_order }}<br>
                            <b>Ngày đặt:</b> {{ $order->created_at->format('d/m/Y H:i') }}<br>
                            <b>Trạng thái:</b> {{ $order->status }}<br>
                        </td>
                        <td style="text-align:right">
                            <b>Shop Thời Trang</b><br>
                            Địa chỉ: ...<br>
                            SĐT: ...<br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="information">
            <td colspan="4">
                <table>
                    <tr>
                        <td>
                            <b>Khách hàng:</b> {{ $user->name ?? 'N/A' }}<br>
                            <b>Điện thoại:</b> {{ $order->phone ?? ($user->phone ?? '') }}<br>
                            <b>Địa chỉ:</b> {{ $order->address_order }}<br>
                        </td>
                        <td style="text-align:right">
                            <b>Phương thức thanh toán:</b> {{ $order->payment_method ?? 'Chưa chọn' }}<br>
                            <b>Trạng thái thanh toán:</b> {{ $order->payment_status ?? 'Chưa thanh toán' }}<br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="heading">
            <td>Sản phẩm</td>
            <td>Đơn giá</td>
            <td>Số lượng</td>
            <td>Thành tiền</td>
        </tr>
        @foreach($products as $item)
        <tr class="item">
            <td>{{ $item['name'] }}</td>
            <td>{{ number_format($item['price']) }}đ</td>
            <td>{{ $item['quantity'] }}</td>
            <td>{{ number_format($item['total']) }}đ</td>
        </tr>
        @endforeach
        <tr class="details">
            <td colspan="3" style="text-align:right">Tạm tính:</td>
            <td>{{ number_format($total) }}đ</td>
        </tr>
        <tr class="details">
            <td colspan="3" style="text-align:right">Phí vận chuyển:</td>
            <td>{{ number_format($shipping_fee) }}đ</td>
        </tr>
        <tr class="details">
            <td colspan="3" style="text-align:right">Chiết khấu:</td>
            <td>-{{ number_format($discount) }}đ</td>
        </tr>
        <tr class="total">
            <td colspan="3" style="text-align:right"><b>Tổng cộng:</b></td>
            <td><b>{{ number_format($final_total) }}đ</b></td>
        </tr>
    </table>
    <div class="mt-4">
        <b>Ghi chú:</b> {{ $order->note ?? '---' }}
    </div>
    <div class="row mt-5">
        <div class="col-6 text-center">
            <b>Khách hàng</b><br><br><br>
            (Ký, ghi rõ họ tên)
        </div>
        <div class="col-6 text-center">
            <b>Nhân viên bán hàng</b><br><br><br>
            (Ký, ghi rõ họ tên)
        </div>
    </div>
</div>
@endsection 