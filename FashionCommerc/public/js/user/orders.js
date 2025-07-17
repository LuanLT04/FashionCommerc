// Simple orders page JavaScript - like cart.js
document.querySelectorAll('.btn-review').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const orderId = this.getAttribute('data-order-id');
        loadOrderProducts(orderId);
    });
});

document.querySelectorAll('.btn-cancel-order').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const orderId = this.getAttribute('data-order-id');
        if (confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')) {
            cancelOrder(orderId);
        }
    });
});

// Status filter tabs
document.querySelectorAll('.order-status-tabs .nav-link').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const status = this.getAttribute('data-status');
        
        // Remove active class from all tabs
        document.querySelectorAll('.order-status-tabs .nav-link').forEach(tab => {
            tab.classList.remove('active');
        });
        // Add active class to clicked tab
        this.classList.add('active');
        
        // Navigate to filtered page
        if (status === 'all') {
            window.location.href = window.location.pathname;
        } else {
            window.location.href = window.location.pathname + '?status=' + status;
        }
    });
});

// Rating stars
document.querySelectorAll('.rating-stars .star').forEach(star => {
    star.addEventListener('click', function() {
        const rating = parseInt(this.getAttribute('data-rating'));
        const ratingContainer = this.parentElement;
        const ratingInput = ratingContainer.parentElement.querySelector('.rating-input');
        
        if (ratingInput) {
            ratingInput.value = rating;
        }
        
        // Update star display
        ratingContainer.querySelectorAll('.star').forEach((s, index) => {
            if (index < rating) {
                s.classList.add('active');
                s.classList.remove('inactive');
            } else {
                s.classList.add('inactive');
                s.classList.remove('active');
            }
        });
    });
});

// Functions that might be called from HTML
function loadOrderProducts(orderId) {
    console.log('Loading products for order:', orderId);
    // Implementation here
}

function cancelOrder(orderId) {
    console.log('Canceling order:', orderId);
    // Implementation here
}

function trackOrder(orderId) {
    console.log('Tracking order:', orderId);
    // Implementation here
}
