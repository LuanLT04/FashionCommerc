@extends('user.dashboard_user')

@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="container py-5">
    <h2 class="mb-4 text-center">Kết quả tìm kiếm cho: <strong>"{{ $keyword }}"</strong></h2>

    <div class="row">
        <!-- Bộ lọc bên trái -->
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Bộ lọc sản phẩm</h5>
                    <form action="{{ route('user.filterProduct') }}" method="GET" id="filterForm">
                        <input type="hidden" name="keyword" value="{{ $keyword ?? '' }}">

                        <!-- Danh mục sản phẩm -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Danh mục</h6>
                            <select name="category" class="form-select" onchange="this.form.submit()">
                                <option value="">Tất cả danh mục</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id_category }}" {{ request('category') == $category->id_category ? 'selected' : '' }}>
                                        {{ $category->name_category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Hãng sản xuất -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Hãng sản xuất</h6>
                            <select name="manufacturer" class="form-select" onchange="this.form.submit()">
                                <option value="">Tất cả hãng</option>
                                @foreach($manufacturers as $manufacturer)
                                    <option value="{{ $manufacturer->id_manufacturer }}" {{ request('manufacturer') == $manufacturer->id_manufacturer ? 'selected' : '' }}>
                                        {{ $manufacturer->name_manufacturer }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Khoảng giá -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Khoảng giá (VNĐ)</h6>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="number" name="price_min" class="form-control form-control-sm" 
                                        placeholder="Từ" value="{{ request('price_min') }}" min="0">
                                </div>
                                <div class="col-6">
                                    <input type="number" name="price_max" class="form-control form-control-sm" 
                                        placeholder="Đến" value="{{ request('price_max') }}" min="0">
                                </div>
                            </div>
                        </div>

                        <!-- Số lượt mua -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Số lượt mua</h6>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="number" name="purchased_min" class="form-control form-control-sm" 
                                        placeholder="Từ" value="{{ request('purchased_min') }}" min="0">
                                </div>
                                <div class="col-6">
                                    <input type="number" name="purchased_max" class="form-control form-control-sm" 
                                        placeholder="Đến" value="{{ request('purchased_max') }}" min="0">
                                </div>
                            </div>
                        </div>

                        <!-- Nút lọc -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Lọc sản phẩm</button>
                            <a href="{{ route('user.searchProduct', ['keyword' => $keyword ?? '']) }}" class="btn btn-outline-secondary">
                                Xóa bộ lọc
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Danh sách sản phẩm bên phải -->
        <div class="col-md-9">
            @if($products->isEmpty())
            <div class="alert alert-warning text-center">
                Không tìm thấy sản phẩm nào phù hợp với tiêu chí lọc.
            </div>
            @else
            <div class="row">
                @foreach($products as $product)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="text-center p-3" style="background-color: #f9f9f9;">
                            <img src="{{ asset('uploads/productimage/' . $product->image_address_product) }}"
                                alt="{{ $product->name_product }}"
                                class="img-fluid" style="max-height: 200px; object-fit: contain;">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title mb-2">{{ $product->name_product }}</h5>
                            <p class="card-text text-danger mb-3">{{ number_format($product->price_product, 0, ',', '.') }} VND</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">Đã bán: {{ $product->purchased }}</small>
                                <a href="{{ route('product.indexDetailproduct', ['id' => $product->id_product]) }}"
                                    class="btn btn-outline-primary btn-sm">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $products->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('css/user/searchProduct.css') }}">
<script src="{{ asset('js/user/searchProduct.js') }}"></script>
@endsection