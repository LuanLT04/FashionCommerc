@extends('admin.layout')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>150</h3>
                    <p>Đơn hàng mới</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="{{ route('admin.orderindexAdmin') }}" class="small-box-footer">
                    Xem chi tiết <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>53<sup style="font-size: 20px">%</sup></h3>
                    <p>Tỷ lệ tăng trưởng</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Xem chi tiết <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>44</h3>
                    <p>Người dùng đăng ký</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="{{ route('user.listuser') }}" class="small-box-footer">
                    Xem chi tiết <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>65</h3>
                    <p>Sản phẩm mới</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <a href="{{ route('product.listproduct') }}" class="small-box-footer">
                    Xem chi tiết <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- Box doanh thu -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    @php $revenue = isset($totalRevenue) ? number_format($totalRevenue, 0, ',', '.') : '0'; @endphp
                    <h3>{{ $revenue }}đ</h3>
                    <p>Tổng doanh thu</p>
                </div>
                <div class="icon">
                    <i class="fas fa-coins"></i>
                </div>
                <span class="small-box-footer">Tổng doanh thu đã hoàn thành</span>
            </div>
        </div>
    </div>
    <!-- Thêm các bảng, thống kê, ... ở đây nếu muốn -->
    <!-- Biểu đồ doanh thu -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-gradient-info text-white">
                    <h5 class="mb-0">Biểu đồ doanh thu</h5>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" id="revenueTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="day-tab" data-bs-toggle="pill" data-bs-target="#day" type="button" role="tab">Theo ngày</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="month-tab" data-bs-toggle="pill" data-bs-target="#month" type="button" role="tab">Theo tháng</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="year-tab" data-bs-toggle="pill" data-bs-target="#year" type="button" role="tab">Theo năm</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="revenueTabContent">
                        <div class="tab-pane fade show active" id="day" role="tabpanel">
                            <canvas id="revenueDayChart" height="80"></canvas>
                        </div>
                        <div class="tab-pane fade" id="month" role="tabpanel">
                            <canvas id="revenueMonthChart" height="80"></canvas>
                        </div>
                        <div class="tab-pane fade" id="year" role="tabpanel">
                            <canvas id="revenueYearChart" height="80"></canvas>
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
    const dailyLabels = @json($dailyLabels);
    const dailyData = @json($dailyData);
    const monthlyLabels = @json($monthlyLabels);
    const monthlyData = @json($monthlyData);
    const yearlyLabels = @json($yearlyLabels);
    const yearlyData = @json($yearlyData);
    // Chart theo ngày
    new Chart(document.getElementById('revenueDayChart'), {
        type: 'line',
        data: {
            labels: dailyLabels,
            datasets: [{
                label: 'Doanh thu theo ngày',
                data: dailyData,
                borderColor: '#007bff',
                backgroundColor: 'rgba(0,123,255,0.1)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
    // Chart theo tháng
    new Chart(document.getElementById('revenueMonthChart'), {
        type: 'bar',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Doanh thu theo tháng',
                data: monthlyData,
                backgroundColor: '#28a745',
                borderColor: '#218838',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
    // Chart theo năm
    new Chart(document.getElementById('revenueYearChart'), {
        type: 'bar',
        data: {
            labels: yearlyLabels,
            datasets: [{
                label: 'Doanh thu theo năm',
                data: yearlyData,
                backgroundColor: '#ffc107',
                borderColor: '#e0a800',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
@endsection 