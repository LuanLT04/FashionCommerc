document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.review-3d-card-modern').forEach(function(card) {
        VanillaTilt.init(card, {
            max: 18,
            speed: 600,
            glare: true,
            'max-glare': 0.18,
            scale: 1.04,
            perspective: 900,
        });
    });
    document.querySelectorAll('.user-balance').forEach(function(el) {
        el.addEventListener('mouseenter', function() {
            el.style.transform = 'scale(1.06)';
        });
        el.addEventListener('mouseleave', function() {
            el.style.transform = '';
        });
    });

    // AJAX Pagination
    document.addEventListener('click', function(e) {
        if (e.target.closest('.ajax-pagination')) {
            e.preventDefault();
            var link = e.target.closest('.ajax-pagination');
            var url = link.getAttribute('href');
            if (!url || url === '#') return;
            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Cập nhật grid sản phẩm
                var grid = document.getElementById('products-grid');
                if (grid) grid.innerHTML = data.html;
                // Cập nhật lại phân trang
                var pagWrapper = document.querySelector('.pagination-wrapper');
                if (pagWrapper) pagWrapper.innerHTML = data.pagination;
                // Đổi URL trên trình duyệt
                window.history.pushState({}, '', url);
            });
        }
    });
}); 


/*banner */
// Đặt đoạn này sau khi HTML banner đã render
const slide = document.querySelector('.banner-slider .slide');
const prevBtn = document.getElementById('prev');
const nextBtn = document.getElementById('next');

function moveSlide(direction) {
    if (direction === 'next') {
        slide.appendChild(slide.firstElementChild);
    } else {
        slide.insertBefore(slide.lastElementChild, slide.firstElementChild);
    }
}
prevBtn.onclick = () => moveSlide('prev');
nextBtn.onclick = () => moveSlide('next');