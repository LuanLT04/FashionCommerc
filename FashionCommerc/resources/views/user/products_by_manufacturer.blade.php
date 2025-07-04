@extends('user.dashboard_user')  

@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!-- Manufacturer Header -->
<div class="manufacturer-header">
    <div class="container">
        <div class="manufacturer-info">
            <div class="manufacturer-logo">
                @if(isset($manufacturer->image_manufacturer))
                    <img src="{{ asset('uploads/manufacturerimage/' . $manufacturer->image_manufacturer) }}" 
                         alt="{{ $manufacturer->name_manufacturer }}" 
                         class="logo-image">
                @else
                    <div class="logo-placeholder">
                        <i class="fa-solid fa-industry"></i>
                    </div>
                @endif
            </div>
            <div class="manufacturer-details">
                <h1>{{ $manufacturer->name_manufacturer }}</h1>
                @if(isset($manufacturer->description_manufacturer))
                    <p>{{ $manufacturer->description_manufacturer }}</p>
                @endif
                <div class="manufacturer-badges">
                    <span class="badge">Chính hãng</span>
                    @if(isset($manufacturer->founding_year))
                        <span class="badge">Thành lập {{ $manufacturer->founding_year }}</span>
                    @endif
                    @if(isset($manufacturer->country))
                        <span class="badge">{{ $manufacturer->country }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Products Section -->
<div class="products-section">
    <div class="container">
        <!-- Filters and Sorting -->
        <div class="products-header">
            <div class="products-count">
                <span>{{ $products->count() }} sản phẩm</span>
            </div>
            <div class="products-controls">
                <div class="view-options">
                    <button class="view-btn active" data-view="grid">
                        <i class="fas fa-th-large"></i>
                    </button>
                    <button class="view-btn" data-view="list">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        @if($products->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-box-open"></i>
                </div>
                <h3>Không có sản phẩm nào</h3>
                <p>Hiện tại không có sản phẩm nào từ nhà sản xuất này.</p>
                <a href="{{ route('home.index') }}" class="btn-back">
                    <i class="fas fa-home"></i>
                    Quay lại trang chủ
                </a>
            </div>
        @else
            <div class="products-grid">
                @foreach($products as $product)
                    <div class="product-card">
                        <div class="product-image">
                            <a href="{{ route('product.indexDetailproduct', ['id' => $product->id_product]) }}">
                                <img src="{{ asset('uploads/productimage/' . $product->image_address_product) }}"
                                     alt="{{ $product->name_product }}">
                            </a>
                            @if(isset($product->discount) && $product->discount > 0)
                                <div class="discount-badge">
                                    -{{ $product->discount }}%
                                </div>
                            @endif
                        </div>
                        <div class="product-info">
                            <div class="product-brand">
                                {{ $manufacturer->name_manufacturer }}
                            </div>
                            <h3 class="product-name">
                                <a href="{{ route('product.indexDetailproduct', ['id' => $product->id_product]) }}">
                                    {{ $product->name_product }}
                                </a>
                            </h3>
                            <div class="product-price">
                                <span class="current-price">{{ number_format($product->price_product, 0, ',', '.') }} ₫</span>
                                @if(isset($product->old_price) && $product->old_price > $product->price_product)
                                    <span class="old-price">{{ number_format($product->old_price, 0, ',', '.') }} ₫</span>
                                @endif
                            </div>
                            <a href="{{ route('product.indexDetailproduct', ['id' => $product->id_product]) }}" 
                               class="view-details-btn">
                                <i class="fas fa-eye"></i>
                                Chi tiết
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>

<link rel="stylesheet" href="{{ asset('css/user/products_by_manufacturer.css') }}">
<script src="{{ asset('js/user/products_by_manufacturer.js') }}"></script>
@endsection