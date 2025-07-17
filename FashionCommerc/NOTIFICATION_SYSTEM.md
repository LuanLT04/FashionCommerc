# Hệ Thống Thông Báo Đồng Nhất - Fashion Commerce

## Tổng Quan

Hệ thống thông báo đồng nhất được thiết kế để cung cấp trải nghiệm thông báo nhất quán trên toàn bộ website, với màu sắc và animation đồng nhất với các badge trong navigation.

## Các Loại Thông Báo

### ✨ Màu Sắc Đồng Nhất
Tất cả các thông báo và badge đều sử dụng **màu đỏ/hồng (#ff4d4d)** để tạo sự nhất quán trong thiết kế.

### 1. Thông Báo Giỏ Hàng (Cart)
- **Màu sắc**: Đỏ/hồng (#ff4d4d) - đồng nhất với tất cả badge
- **Icon**: fa-shopping-cart
- **Sử dụng**: Khi thêm/xóa sản phẩm khỏi giỏ hàng

### 2. Thông Báo Đơn Hàng (Order)
- **Màu sắc**: Đỏ/hồng (#ff4d4d) - đồng nhất với tất cả badge
- **Icon**: fa-file-invoice
- **Sử dụng**: Khi tạo/cập nhật đơn hàng

### 3. Thông Báo Yêu Thích (Favorite)
- **Màu sắc**: Đỏ/hồng (#ff4d4d) - đồng nhất với tất cả badge
- **Icon**: fa-heart
- **Sử dụng**: Khi thêm/xóa sản phẩm yêu thích

### 4. Thông Báo Thành Công (Success)
- **Màu sắc**: Đỏ/hồng (#ff4d4d) - đồng nhất với tất cả badge
- **Icon**: fa-check-circle
- **Sử dụng**: Thông báo thành công chung

## Cách Sử Dụng

### 1. Import File JavaScript

```html
<script src="{{ asset('js/user/notifications.js') }}"></script>
```

### 2. Các Hàm Chính

#### showNotification(title, message, type, duration)
```javascript
// Thông báo cơ bản
window.showNotification('Tiêu đề', 'Nội dung thông báo', 'cart', 3000);
```

#### showCartNotification(message, buttonElement)
```javascript
// Thông báo giỏ hàng với flying animation
window.showCartNotification('Đã thêm vào giỏ hàng!', buttonElement);
```

#### showOrderNotification(message, buttonElement)
```javascript
// Thông báo đơn hàng với flying animation
window.showOrderNotification('Đơn hàng đã được tạo!', buttonElement);
```

#### showFavoriteNotification(message, buttonElement)
```javascript
// Thông báo yêu thích với flying animation
window.showFavoriteNotification('Đã thêm vào yêu thích!', buttonElement);
```

#### updateBadgeCount(selector, count)
```javascript
// Cập nhật số lượng badge với animation
window.updateBadgeCount('.cart-badge', newCount);
```

### 3. Ví Dụ Thực Tế

#### Thêm Sản Phẩm Vào Giỏ Hàng
```javascript
$('#addToCartForm').submit(function(e) {
    e.preventDefault();
    var btn = $('#addToCartBtn');
    
    $.ajax({
        url: form.attr('action'),
        method: 'POST',
        data: form.serialize(),
        success: function(res) {
            if(res.success) {
                // Hiển thị thông báo với flying animation
                window.showCartNotification('Đã thêm vào giỏ hàng!', btn[0]);
                
                // Cập nhật badge count
                window.updateBadgeCount('.cart-badge', res.cartCount);
            }
        }
    });
});
```

#### Thêm Vào Yêu Thích
```javascript
$('.favorite-btn').click(function() {
    var btn = this;
    
    $.ajax({
        url: '/favorite/add',
        method: 'POST',
        data: {id_product: btn.dataset.id},
        success: function(res) {
            if(res.success) {
                // Hiển thị thông báo với flying heart
                window.showFavoriteNotification('Đã thêm vào yêu thích!', btn);
                
                // Cập nhật badge count
                window.updateBadgeCount('.favorite-count-badge', res.favoriteCount);
            }
        }
    });
});
```

## Tính Năng

### 1. Flying Animation
- Animation bay từ button đến icon tương ứng trong navigation
- Tự động tìm target icon dựa trên loại thông báo
- Smooth animation với CSS transform

### 2. Badge Animation
- Pulse effect khi cập nhật số lượng
- Đồng nhất với animation của favorite badge

### 3. Responsive Design
- Thích ứng với mọi kích thước màn hình
- Position fixed để luôn hiển thị ở góc phải trên

### 4. Backdrop Filter
- Hiệu ứng blur background cho thông báo hiện đại
- Tăng độ nổi bật của thông báo

## Demo

Mở file `public/demo-notifications.html` để xem demo đầy đủ các loại thông báo.

## Tích Hợp

### Các File Đã Được Tích Hợp:
1. `resources/views/user/dashboard_user.blade.php` - Layout chính
2. `resources/views/user/detailproduct.blade.php` - Trang chi tiết sản phẩm
3. `resources/views/user/cart.blade.php` - Trang giỏ hàng
4. `public/js/user/dashboard_user.js` - JavaScript chính
5. `public/js/user/cart.js` - JavaScript giỏ hàng

### Để Tích Hợp Vào Trang Mới:
1. Thêm file CSS: `css/user/dashboard_user.css`
2. Thêm file JS: `js/user/notifications.js`
3. Sử dụng các hàm global đã được định nghĩa

## Tương Thích

- Tương thích ngược với SweetAlert2
- Fallback tự động nếu hệ thống chưa load
- Hoạt động trên tất cả trình duyệt hiện đại

## Màu Sắc Đồng Nhất

| Loại | Màu Chính | Màu Border | Badge Tương Ứng |
|------|-----------|------------|-----------------|
| Cart | #ff4d4d | #d62828 | .cart-badge |
| Order | #ff4d4d | #d62828 | .order-badge |
| Favorite | #ff4d4d | #d62828 | .favorite-count-badge |
| Success | #ff4d4d | #d62828 | - |

**🎨 Tất cả đều sử dụng màu đỏ/hồng (#ff4d4d) để tạo sự đồng nhất hoàn toàn!**
