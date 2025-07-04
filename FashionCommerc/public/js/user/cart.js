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
        Swal.fire('Vui lòng nhập địa chỉ nhận hàng!');
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
            e.target.submit();
        }
    });
}); 