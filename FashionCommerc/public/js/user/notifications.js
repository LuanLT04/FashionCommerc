/**
 * Unified Notification System for Fashion Commerce
 * Provides consistent notifications across all pages
 */

// Global notification functions
(function() {
    'use strict';

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

    // Function to update badge count with animation
    function updateBadgeCount(selector, count) {
        const badge = document.querySelector(selector);
        if (badge) {
            badge.textContent = count;
            badge.style.animation = 'none';
            badge.offsetHeight; // trigger reflow
            badge.style.animation = 'badgePulse 0.3s ease-in-out';
        }
    }

    // Cart notification with flying animation
    function showCartNotification(message, buttonElement) {
        showNotification('Giỏ hàng', message, 'cart');
        
        // Create flying cart animation if button element is provided
        if (buttonElement) {
            const rect = buttonElement.getBoundingClientRect();
            const cartIcon = document.querySelector('.nav-link[href*="cart"] i, a[href*="cart"] i');
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
    }
    
    // Order notification with flying animation
    function showOrderNotification(message, buttonElement) {
        showNotification('Đơn hàng', message, 'order');
        
        // Create flying order animation if button element is provided
        if (buttonElement) {
            const rect = buttonElement.getBoundingClientRect();
            const orderIcon = document.querySelector('.nav-link[href*="order"] i, a[href*="order"] i');
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
    }
    
    // Favorite notification with flying animation
    function showFavoriteNotification(message, buttonElement) {
        showNotification('Yêu thích', message, 'favorite');
        
        // Create flying heart animation if button element is provided
        if (buttonElement) {
            const rect = buttonElement.getBoundingClientRect();
            const favoriteIcon = document.querySelector('#dashboardFavoriteIcon, .favorite-icon');
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
    }

    // Make functions globally available
    window.showNotification = showNotification;
    window.createFlyingAnimation = createFlyingAnimation;
    window.updateBadgeCount = updateBadgeCount;
    window.showCartNotification = showCartNotification;
    window.showOrderNotification = showOrderNotification;
    window.showFavoriteNotification = showFavoriteNotification;

    // Legacy compatibility
    window.showToast = function(message) {
        showNotification('Thành công!', message, 'success');
    };

})();
