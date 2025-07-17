document.querySelectorAll('.btn-delete-product').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        let url = this.getAttribute('data-url');
        Swal.fire({
            title: 'Xóa sản phẩm?',
            text: 'Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
});

document.getElementById('cart-form').addEventListener('submit', function(e) {
    e.preventDefault();
    let address = document.getElementById('address').value;
    if (!address) {
        // Sử dụng thông báo tùy chỉnh thay vì SweetAlert2
        if (typeof window.showNotification === 'function') {
            window.showNotification('Lỗi', 'Vui lòng nhập địa chỉ nhận hàng!', 'cart');
        } else {
            Swal.fire('Vui lòng nhập địa chỉ nhận hàng!');
        }
        return;
    }

    Swal.fire({
        title: 'Xác nhận đặt hàng?',
        html: `<b>Địa chỉ nhận hàng:</b> ${address}<br><b>Tổng tiền:</b> {{ number_format($totalAll) }}đ`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Đặt hàng',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            // Hiển thị thông báo đặt hàng thành công
            if (typeof window.showOrderNotification === 'function') {
                window.showOrderNotification('Đang xử lý đơn hàng...', document.querySelector('.btn-checkout'));
            }
            e.target.submit();
        }
    });
});