// Dashboard User JS
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.user-balance').forEach(function(el) {
        el.addEventListener('mouseenter', function() {
            el.style.transform = 'scale(1.06)';
        });
        el.addEventListener('mouseleave', function() {
            el.style.transform = '';
        });
    });
}); 

document.addEventListener('DOMContentLoaded', function() {
    let favoriteCount = 0;

    // Function to show custom notification
    function showNotification(title, message, type = 'success', duration = 3000) {
        // Remove existing notification if any
        const existingNotification = document.getElementById('custom-notification');
        if (existingNotification) {
            existingNotification.remove();
        }

        // Create notification element
        const notification = document.createElement('div');
        notification.id = 'custom-notification';
        notification.className = `custom-notification ${type}`;

        // Set icon based on type
        let icon = '';
        switch(type) {
            case 'cart':
                icon = 'fa-shopping-cart';
                break;
            case 'order':
                icon = 'fa-file-invoice';
                break;
            case 'favorite':
                icon = 'fa-heart';
                break;
            case 'success':
            default:
                icon = 'fa-check-circle';
                break;
        }

        notification.innerHTML = `
            <div class="notification-icon">
                <i class="fas ${icon}"></i>
            </div>
            <div class="notification-content">
                <div class="notification-title">${title}</div>
                <div class="notification-message">${message}</div>
            </div>
        `;

        document.body.appendChild(notification);

        // Show notification with animation
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);

        // Hide notification after duration
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                if (document.body.contains(notification)) {
                    document.body.removeChild(notification);
                }
            }, 400);
        }, duration);
    }

    // Legacy function for backward compatibility
    function showToast(message) {
        showNotification('Thành công!', message, 'success');
    }

    // Function to create flying animations
    function createFlyingAnimation(startX, startY, endX, endY, type = 'heart') {
        const element = document.createElement('div');
        let icon = '';
        let className = '';

        switch(type) {
            case 'cart':
                icon = '<i class="fa-solid fa-shopping-cart"></i>';
                className = 'flying-cart';
                break;
            case 'order':
                icon = '<i class="fa-solid fa-file-invoice"></i>';
                className = 'flying-order';
                break;
            case 'heart':
            default:
                icon = '<i class="fa-solid fa-heart"></i>';
                className = 'flying-heart';
                break;
        }

        element.className = className;
        element.innerHTML = icon;
        element.style.left = startX + 'px';
        element.style.top = startY + 'px';
        element.style.setProperty('--fly-x', (endX - startX) + 'px');
        element.style.setProperty('--fly-y', (endY - startY) + 'px');

        document.body.appendChild(element);

        setTimeout(() => {
            if (document.body.contains(element)) {
                document.body.removeChild(element);
            }
        }, 1000);
    }

    // Legacy function for backward compatibility
    function createFlyingHeart(startX, startY, endX, endY) {
        createFlyingAnimation(startX, startY, endX, endY, 'heart');
    }

    // Function to update favorite count badge
    function updateFavoriteCount(count) {
        const badge = document.getElementById('favoriteCountBadge');
        if (badge) {
            badge.textContent = count;
            badge.style.animation = 'none';
            badge.offsetHeight; // trigger reflow
            badge.style.animation = 'badgePulse 0.3s ease-in-out';
        }
    }

    // Initialize favorite count
    function initializeFavoriteCount() {
        fetch('/favorite/list')
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    favoriteCount = data.favorites.length;
                    updateFavoriteCount(favoriteCount);
                }
            })
            .catch(error => {
                console.error('Error loading favorite count:', error);
            });
    }

    // Initialize favorite count on page load
    initializeFavoriteCount();

    // Xử lý trạng thái heart ban đầu
    fetch('/favorite/list')
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const favIds = data.favorites.map(f => f.id_product);
                document.querySelectorAll('.favorite-btn').forEach(btn => {
                    if (favIds.includes(parseInt(btn.dataset.id))) {
                        btn.classList.add('active');
                        btn.querySelector('i').classList.remove('fa-regular');
                        btn.querySelector('i').classList.add('fa-solid');
                    } else {
                        btn.classList.remove('active');
                        btn.querySelector('i').classList.remove('fa-solid');
                        btn.querySelector('i').classList.add('fa-regular');
                    }
                });
            }
        });

    // Xử lý click heart với animation
    document.querySelectorAll('.favorite-btn').forEach(btn => {
        btn.onclick = function(e) {
            e.preventDefault();
            const id = btn.dataset.id;
            if (!id || btn.classList.contains('loading')) return;
            
            btn.classList.add('loading');
            
            if (btn.classList.contains('active')) {
                // Remove from favorites
                fetch('/favorite/remove', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({id_product: id})
                }).then(res => res.json()).then(data => {
                    if (data.success) {
                        btn.classList.remove('active');
                        btn.querySelector('i').classList.remove('fa-solid');
                        btn.querySelector('i').classList.add('fa-regular');
                        favoriteCount = Math.max(0, favoriteCount - 1);
                        updateFavoriteCount(favoriteCount);
                        showNotification('Yêu thích', 'Đã xóa khỏi danh sách yêu thích!', 'favorite');
                        loadFavoriteList();
                    }
                }).catch(error => {
                    console.error('Error removing favorite:', error);
                    showToast('Có lỗi xảy ra!');
                }).finally(() => {
                    btn.classList.remove('loading');
                });
            } else {
                // Add to favorites
                fetch('/favorite/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({id_product: id})
                }).then(res => res.json()).then(data => {
                    if (data.success) {
                        btn.classList.add('active');
                        btn.querySelector('i').classList.remove('fa-regular');
                        btn.querySelector('i').classList.add('fa-solid');
                        favoriteCount++;
                        updateFavoriteCount(favoriteCount);
                        showFavoriteNotification('Đã thêm vào danh sách yêu thích!', btn);
                        
                        loadFavoriteList();
                    }
                }).catch(error => {
                    console.error('Error adding favorite:', error);
                    showToast('Có lỗi xảy ra!');
                }).finally(() => {
                    btn.classList.remove('loading');
                });
            }
        }
    });

    // Hiển thị modal danh sách yêu thích
    const openFavoriteModal = document.getElementById('dashboardFavoriteIcon');
    if (openFavoriteModal) {
        openFavoriteModal.onclick = function(e) {
            e.preventDefault();
            var modal = new bootstrap.Modal(document.getElementById('favoriteModal'));
            modal.show();
            loadFavoriteList();
        }
    }

    // Hàm load danh sách yêu thích
    function loadFavoriteList() {
        fetch('/favorite/list')
            .then(res => res.json())
            .then(data => {
                const body = document.getElementById('favoriteListBody');
                if (!data.success || !data.favorites.length) {
                    body.innerHTML = '<div class="text-center text-muted">Chưa có sản phẩm yêu thích nào.</div>';
                    return;
                }
                let html = '<div class="row g-3">';
                data.favorites.forEach(fav => {
                    html += `<div class='col-md-4'>
                        <div class='card h-100 shadow-sm position-relative'>
                            <img src='/uploads/productimage/${fav.product.image_address_product}' class='card-img-top' alt='${fav.product.name_product}'>
                            <div class='card-body'>
                                <h6 class='card-title mb-2'>${fav.product.name_product}</h6>
                                <div class='text-danger fw-bold mb-2'>${fav.product.price_product} VNĐ</div>
                                <div class='d-flex gap-2'>
                                    <a href='/detailproduct?id=${fav.id_product}' class='btn btn-outline-primary btn-sm' title='Xem chi tiết' target='_blank'>
                                        <i class='fa-solid fa-eye'></i>
                                    </a>
                                    <button class='btn btn-outline-danger btn-sm remove-fav-btn' data-id='${fav.id_product}' title='Xóa khỏi yêu thích'>
                                        <i class='fa-solid fa-trash'></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>`;
                });
                html += '</div>';
                body.innerHTML = html;
                
                // Xóa khỏi yêu thích trong modal
                document.querySelectorAll('.remove-fav-btn').forEach(btn => {
                    btn.onclick = function() {
                        fetch('/favorite/remove', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({id_product: btn.dataset.id})
                        }).then(res => res.json()).then(data => {
                            if (data.success) {
                                favoriteCount = Math.max(0, favoriteCount - 1);
                                updateFavoriteCount(favoriteCount);
                                showNotification('Yêu thích', 'Đã xóa khỏi danh sách yêu thích!', 'favorite');
                                loadFavoriteList();
                                
                                // Cập nhật icon heart trên grid
                                document.querySelectorAll('.favorite-btn').forEach(favBtn => {
                                    if (favBtn.dataset.id == btn.dataset.id) {
                                        favBtn.classList.remove('active');
                                        favBtn.querySelector('i').classList.remove('fa-solid');
                                        favBtn.querySelector('i').classList.add('fa-regular');
                                    }
                                });
                            }
                        });
                    }
                });
            });
    }

    // Make functions globally available
    window.showNotification = showNotification;
    window.createFlyingAnimation = createFlyingAnimation;
    window.showCartNotification = function(message, buttonElement) {
        showNotification('Giỏ hàng', message, 'cart');

        // Create flying cart animation if button element is provided
        if (buttonElement) {
            const rect = buttonElement.getBoundingClientRect();
            const cartIcon = document.querySelector('.nav-link[href*="cart"] i');
            if (cartIcon) {
                const iconRect = cartIcon.getBoundingClientRect();
                createFlyingAnimation(
                    rect.left + rect.width / 2,
                    rect.top + rect.height / 2,
                    iconRect.left + iconRect.width / 2,
                    iconRect.top + iconRect.height / 2,
                    'cart'
                );
            }
        }
    };

    window.showOrderNotification = function(message, buttonElement) {
        showNotification('Đơn hàng', message, 'order');

        // Create flying order animation if button element is provided
        if (buttonElement) {
            const rect = buttonElement.getBoundingClientRect();
            const orderIcon = document.querySelector('.nav-link[href*="order"] i');
            if (orderIcon) {
                const iconRect = orderIcon.getBoundingClientRect();
                createFlyingAnimation(
                    rect.left + rect.width / 2,
                    rect.top + rect.height / 2,
                    iconRect.left + iconRect.width / 2,
                    iconRect.top + iconRect.height / 2,
                    'order'
                );
            }
        }
    };

    window.showFavoriteNotification = function(message, buttonElement) {
        showNotification('Yêu thích', message, 'favorite');

        // Create flying heart animation if button element is provided
        if (buttonElement) {
            const rect = buttonElement.getBoundingClientRect();
            const favoriteIcon = document.getElementById('dashboardFavoriteIcon');
            if (favoriteIcon) {
                const iconRect = favoriteIcon.getBoundingClientRect();
                createFlyingAnimation(
                    rect.left + rect.width / 2,
                    rect.top + rect.height / 2,
                    iconRect.left + iconRect.width / 2,
                    iconRect.top + iconRect.height / 2,
                    'heart'
                );
            }
        }
    };
});