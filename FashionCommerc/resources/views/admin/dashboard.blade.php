@extends('admin.layout')
@section('title', 'Dashboard')
@section('meta_description', 'Fashion Commerce Admin Dashboard - Quản lý toàn diện hệ thống bán hàng thời trang với giao diện hiện đại')
@section('meta_keywords', 'dashboard admin, quản lý bán hàng, thống kê doanh thu, quản lý đơn hàng, analytics')
@section('page-title', 'Dashboard')

@section('content')
<!-- Skip Links for Accessibility -->
<a href="#main-content" class="sr-only sr-only-focusable">Chuyển đến nội dung chính</a>
<a href="#analytics-section" class="sr-only sr-only-focusable">Chuyển đến phần thống kê</a>

<div class="container-fluid fade-in" id="main-content" role="main">
    <!-- Stats Cards Row -->
    <div class="row mb-4" role="region" aria-label="Thống kê tổng quan">
        <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3 id="new-orders-count">150</h3>
                    <p>Đơn hàng mới</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart" aria-hidden="true"></i>
                </div>
                <a href="{{ route('admin.orderindexAdmin') }}" class="small-box-footer"
                   aria-label="Xem chi tiết đơn hàng mới">
                    Xem chi tiết <i class="fas fa-arrow-circle-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3 id="growth-rate">53<sup style="font-size: 20px">%</sup></h3>
                    <p>Tỷ lệ tăng trưởng</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-line" aria-hidden="true"></i>
                </div>
                <a href="#analytics-section" class="small-box-footer"
                   aria-label="Xem chi tiết tỷ lệ tăng trưởng">
                    Xem chi tiết <i class="fas fa-arrow-circle-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3 id="new-users-count">44</h3>
                    <p>Người dùng đăng ký</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus" aria-hidden="true"></i>
                </div>
                <a href="{{ route('user.listuser') }}" class="small-box-footer"
                   aria-label="Xem chi tiết người dùng đăng ký">
                    Xem chi tiết <i class="fas fa-arrow-circle-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3 id="new-products-count">65</h3>
                    <p>Sản phẩm mới</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-bag" aria-hidden="true"></i>
                </div>
                <a href="{{ route('product.listproduct') }}" class="small-box-footer"
                   aria-label="Xem chi tiết sản phẩm mới">
                    Xem chi tiết <i class="fas fa-arrow-circle-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Revenue and Quick Actions Row -->
    <div class="row mb-4">
        <!-- Revenue Card -->
        <div class="col-lg-6 col-md-12 mb-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    @php $revenue = isset($totalRevenue) ? number_format($totalRevenue, 0, ',', '.') : '0'; @endphp
                    <h3 id="total-revenue">{{ $revenue }}đ</h3>
                    <p>Tổng doanh thu</p>
                </div>
                <div class="icon">
                    <i class="fas fa-coins" aria-hidden="true"></i>
                </div>
                <span class="small-box-footer">Tổng doanh thu đã hoàn thành</span>
            </div>
        </div>

        <!-- Quick Actions Card -->
        <div class="col-lg-6 col-md-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-bolt mr-2" aria-hidden="true"></i>
                        Thao tác nhanh
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 mb-2">
                            <a href="{{ route('product.addproduct') }}" class="btn btn-outline-primary btn-sm btn-block">
                                <i class="fas fa-plus mr-1" aria-hidden="true"></i>
                                Thêm sản phẩm
                            </a>
                        </div>
                        <div class="col-6 mb-2">
                            <a href="{{ route('admin.orderindexAdmin') }}" class="btn btn-outline-success btn-sm btn-block">
                                <i class="fas fa-list mr-1" aria-hidden="true"></i>
                                Quản lý đơn hàng
                            </a>
                        </div>
                        <div class="col-6 mb-2">
                            <a href="{{ route('user.listuser') }}" class="btn btn-outline-info btn-sm btn-block">
                                <i class="fas fa-users mr-1" aria-hidden="true"></i>
                                Quản lý người dùng
                            </a>
                        </div>
                        <div class="col-6 mb-2">
                            <a href="{{ route('category.index') }}" class="btn btn-outline-warning btn-sm btn-block">
                                <i class="fas fa-th mr-1" aria-hidden="true"></i>
                                Quản lý danh mục
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Analytics Section -->
    <div class="row" id="analytics-section">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-area mr-2" aria-hidden="true"></i>
                        Biểu đồ doanh thu
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Filter Controls -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <ul class="nav nav-pills" id="revenueTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="day-tab" data-bs-toggle="pill"
                                        data-bs-target="#day" type="button" role="tab"
                                        aria-controls="day" aria-selected="true">
                                    <i class="fas fa-calendar-day mr-1" aria-hidden="true"></i>
                                    Theo ngày
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="month-tab" data-bs-toggle="pill"
                                        data-bs-target="#month" type="button" role="tab"
                                        aria-controls="month" aria-selected="false">
                                    <i class="fas fa-calendar-alt mr-1" aria-hidden="true"></i>
                                    Theo tháng
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="year-tab" data-bs-toggle="pill"
                                        data-bs-target="#year" type="button" role="tab"
                                        aria-controls="year" aria-selected="false">
                                    <i class="fas fa-calendar mr-1" aria-hidden="true"></i>
                                    Theo năm
                                </button>
                            </li>
                        </ul>

                        <!-- Chart Type Toggle -->
                        <div class="btn-group" role="group" aria-label="Chart type toggle">
                            <button type="button" class="btn btn-outline-secondary btn-sm active" id="barChartBtn">
                                <i class="fas fa-chart-bar mr-1" aria-hidden="true"></i>
                                Cột
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" id="lineChartBtn">
                                <i class="fas fa-chart-line mr-1" aria-hidden="true"></i>
                                Đường
                            </button>
                        </div>
                    </div>
                    <div class="tab-content" id="revenueTabContent">
                        <div class="tab-pane fade show active" id="day" role="tabpanel"
                             aria-labelledby="day-tab">
                            <canvas id="revenueDayChart" height="80"
                                    aria-label="Biểu đồ doanh thu theo ngày"></canvas>
                        </div>
                        <div class="tab-pane fade" id="month" role="tabpanel"
                             aria-labelledby="month-tab">
                            <canvas id="revenueMonthChart" height="80"
                                    aria-label="Biểu đồ doanh thu theo tháng"></canvas>
                        </div>
                        <div class="tab-pane fade" id="year" role="tabpanel"
                             aria-labelledby="year-tab">
                            <canvas id="revenueYearChart" height="80"
                                    aria-label="Biểu đồ doanh thu theo năm"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities Section -->
    <div class="row mt-4">
        <div class="col-lg-8 col-md-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-clock mr-2" aria-hidden="true"></i>
                        Hoạt động gần đây
                    </h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Đơn hàng mới #12345</h6>
                                <p class="timeline-text">Khách hàng Nguyễn Văn A đã đặt đơn hàng trị giá 1.500.000đ</p>
                                <small class="text-muted">5 phút trước</small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-info"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Sản phẩm mới</h6>
                                <p class="timeline-text">Đã thêm sản phẩm "Áo sơ mi nam cao cấp" vào danh mục</p>
                                <small class="text-muted">15 phút trước</small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-warning"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Người dùng mới</h6>
                                <p class="timeline-text">Trần Thị B đã đăng ký tài khoản mới</p>
                                <small class="text-muted">30 phút trước</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-bell mr-2" aria-hidden="true"></i>
                        Thông báo
                    </h5>
                </div>
                <div class="card-body">
                    <div class="notification-item">
                        <div class="notification-icon bg-danger">
                            <i class="fas fa-exclamation-triangle" aria-hidden="true"></i>
                        </div>
                        <div class="notification-content">
                            <h6>Sản phẩm sắp hết hàng</h6>
                            <p>5 sản phẩm có số lượng dưới 10</p>
                        </div>
                    </div>
                    <div class="notification-item">
                        <div class="notification-icon bg-success">
                            <i class="fas fa-check-circle" aria-hidden="true"></i>
                        </div>
                        <div class="notification-content">
                            <h6>Backup hoàn thành</h6>
                            <p>Sao lưu dữ liệu thành công</p>
                        </div>
                    </div>
                    <div class="notification-item">
                        <div class="notification-icon bg-info">
                            <i class="fas fa-info-circle" aria-hidden="true"></i>
                        </div>
                        <div class="notification-content">
                            <h6>Cập nhật hệ thống</h6>
                            <p>Phiên bản mới có sẵn</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    @php
        $dailyLabels = isset($dailyRevenue) ? $dailyRevenue->pluck('date')->reverse()->values() : collect([]);
        $dailyData = isset($dailyRevenue) ? $dailyRevenue->pluck('total')->reverse()->values() : collect([]);
        $monthlyLabels = isset($monthlyRevenue) ? $monthlyRevenue->pluck('month')->reverse()->values() : collect([]);
        $monthlyData = isset($monthlyRevenue) ? $monthlyRevenue->pluck('total')->reverse()->values() : collect([]);
        $yearlyLabels = isset($yearlyRevenue) ? $yearlyRevenue->pluck('year')->reverse()->values() : collect([]);
        $yearlyData = isset($yearlyRevenue) ? $yearlyRevenue->pluck('total')->reverse()->values() : collect([]);
    @endphp

    // Dữ liệu doanh thu từ backend
    const revenueData = {
        daily: {
            labels: @json($dailyLabels),
            data: @json($dailyData)
        },
        monthly: {
            labels: @json($monthlyLabels),
            data: @json($monthlyData)
        },
        yearly: {
            labels: @json($yearlyLabels),
            data: @json($yearlyData)
        }
    };

    // Cấu hình màu sắc gradient
    const chartColors = {
        daily: {
            gradient: ['#667eea', '#764ba2'],
            border: '#667eea',
            background: 'rgba(102, 126, 234, 0.1)'
        },
        monthly: {
            gradient: ['#48bb78', '#38a169'],
            border: '#48bb78',
            background: 'rgba(72, 187, 120, 0.1)'
        },
        yearly: {
            gradient: ['#ed8936', '#dd6b20'],
            border: '#ed8936',
            background: 'rgba(237, 137, 54, 0.1)'
        }
    };

    // Biến lưu trữ chart instances
    let charts = {};
    // Hàm tạo gradient cho biểu đồ
    function createGradient(ctx, colors) {
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, colors[0]);
        gradient.addColorStop(1, colors[1]);
        return gradient;
    }

    // Hàm tạo biểu đồ hiện đại (cột hoặc đường)
    function createModernChart(canvasId, chartType, type, data, colors) {
        const ctx = document.getElementById(canvasId).getContext('2d');
        const gradient = createGradient(ctx, colors.gradient);

        // Destroy existing chart if exists
        if (charts[canvasId]) {
            charts[canvasId].destroy();
        }

        const isBarChart = chartType === 'bar';

        charts[canvasId] = new Chart(ctx, {
            type: chartType,
            data: {
                labels: data.labels,
                datasets: [{
                    label: `Doanh thu ${type}`,
                    data: data.data,
                    backgroundColor: isBarChart ? gradient : colors.background,
                    borderColor: colors.border,
                    borderWidth: isBarChart ? 2 : 3,
                    borderRadius: isBarChart ? 8 : 0,
                    borderSkipped: isBarChart ? false : undefined,
                    fill: !isBarChart,
                    tension: !isBarChart ? 0.4 : undefined,
                    pointBackgroundColor: !isBarChart ? colors.border : undefined,
                    pointBorderColor: !isBarChart ? '#fff' : undefined,
                    pointBorderWidth: !isBarChart ? 2 : undefined,
                    pointRadius: !isBarChart ? 6 : undefined,
                    pointHoverRadius: !isBarChart ? 8 : undefined,
                    hoverBackgroundColor: colors.border,
                    hoverBorderColor: colors.border,
                    hoverBorderWidth: isBarChart ? 3 : 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: {
                                family: 'Inter',
                                size: 12,
                                weight: '500'
                            },
                            color: '#4a5568',
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: colors.border,
                        borderWidth: 1,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return `Doanh thu: ${new Intl.NumberFormat('vi-VN', {
                                    style: 'currency',
                                    currency: 'VND'
                                }).format(context.parsed.y)}`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                family: 'Inter',
                                size: 11
                            },
                            color: '#718096'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                family: 'Inter',
                                size: 11
                            },
                            color: '#718096',
                            callback: function(value) {
                                return new Intl.NumberFormat('vi-VN', {
                                    style: 'currency',
                                    currency: 'VND',
                                    notation: 'compact'
                                }).format(value);
                            }
                        }
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeInOutQuart'
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    }

    // Biến lưu trữ loại biểu đồ hiện tại
    let currentChartType = 'bar';

    // Hàm tạo tất cả biểu đồ
    function createAllCharts(chartType = 'bar') {
        createModernChart('revenueDayChart', chartType, 'theo ngày', revenueData.daily, chartColors.daily);
        createModernChart('revenueMonthChart', chartType, 'theo tháng', revenueData.monthly, chartColors.monthly);
        createModernChart('revenueYearChart', chartType, 'theo năm', revenueData.yearly, chartColors.yearly);
    }

    // Tạo các biểu đồ ban đầu
    createAllCharts('bar');

    // Xử lý sự kiện chuyển đổi tab và chart type
    document.addEventListener('DOMContentLoaded', function() {
        const tabButtons = document.querySelectorAll('#revenueTab .nav-link');
        const tabPanes = document.querySelectorAll('#revenueTabContent .tab-pane');
        const barChartBtn = document.getElementById('barChartBtn');
        const lineChartBtn = document.getElementById('lineChartBtn');

        tabButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                // Remove active class from all buttons and panes
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabPanes.forEach(pane => {
                    pane.classList.remove('show', 'active');
                });

                // Add active class to clicked button
                this.classList.add('active');

                // Show corresponding pane with animation
                const targetId = this.getAttribute('data-bs-target');
                const targetPane = document.querySelector(targetId);
                if (targetPane) {
                    setTimeout(() => {
                        targetPane.classList.add('show', 'active');

                        // Trigger chart animation
                        const canvasId = targetPane.querySelector('canvas').id;
                        if (charts[canvasId]) {
                            charts[canvasId].update('active');
                        }
                    }, 150);
                }
            });
        });

        // Xử lý chuyển đổi loại biểu đồ
        barChartBtn.addEventListener('click', function() {
            if (currentChartType !== 'bar') {
                currentChartType = 'bar';
                this.classList.add('active');
                lineChartBtn.classList.remove('active');
                createAllCharts('bar');
            }
        });

        lineChartBtn.addEventListener('click', function() {
            if (currentChartType !== 'line') {
                currentChartType = 'line';
                this.classList.add('active');
                barChartBtn.classList.remove('active');
                createAllCharts('line');
            }
        });

        // Thêm hiệu ứng hover cho stats cards
        const statsCards = document.querySelectorAll('.small-box');
        statsCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Animation cho timeline items
        const timelineItems = document.querySelectorAll('.timeline-item');
        timelineItems.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateX(-20px)';

            setTimeout(() => {
                item.style.transition = 'all 0.6s ease';
                item.style.opacity = '1';
                item.style.transform = 'translateX(0)';
            }, index * 200);
        });

        // Animation cho notification items
        const notificationItems = document.querySelectorAll('.notification-item');
        notificationItems.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(20px)';

            setTimeout(() => {
                item.style.transition = 'all 0.6s ease';
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, (index * 150) + 500);
        });

        // Cập nhật số liệu thống kê với animation
        function animateCounter(element, target) {
            let current = 0;
            const increment = target / 100;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                element.textContent = Math.floor(current);
            }, 20);
        }

        // Animate stats numbers
        setTimeout(() => {
            const newOrdersEl = document.getElementById('new-orders-count');
            const newUsersEl = document.getElementById('new-users-count');
            const newProductsEl = document.getElementById('new-products-count');

            if (newOrdersEl) animateCounter(newOrdersEl, 150);
            if (newUsersEl) animateCounter(newUsersEl, 44);
            if (newProductsEl) animateCounter(newProductsEl, 65);
        }, 1000);
    });
</script>
@endsection