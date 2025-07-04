@extends('admin.layout')
@section('title', 'Quản lý sản phẩm')
@section('page-title', 'Quản lý sản phẩm')

@section('content')
<div class="container-fluid">
   

   

    <!-- Card chính -->
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    <i class="fas fa-shopping-bag mr-2"></i>Danh sách sản phẩm
                    @if(isset($search) && $search)
                        <small class="text-muted">- Kết quả tìm kiếm cho "{{ $search }}"</small>
                    @endif
                </h3>
                <div class="card-tools">
                    <a href="{{ route('product.indexaddproduct') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus mr-1"></i>Thêm sản phẩm
                    </a>
                </div>
            </div>

            <!-- Thanh tìm kiếm -->
            <div class="mt-3">
                <form method="GET" action="{{ route('product.listproduct') }}" class="form-inline">
                    <div class="input-group input-group-sm" style="width: 300px;">
                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="Tìm kiếm sản phẩm..."
                               value="{{ request('search') }}"
                               autocomplete="off">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            @if(request('search'))
                                <a href="{{ route('product.listproduct') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bảng dữ liệu -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 80px;" class="text-center">Mã SP</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Hãng SX</th>
                        <th style="width: 100px;" class="text-center">Số lượng</th>
                        <th style="width: 120px;" class="text-right">Giá</th>
                        <th style="width: 100px;" class="text-center">Ảnh</th>
                        <th style="width: 100px;">Size</th>
                        <th style="width: 100px;">Màu sắc</th>
                        <th style="width: 140px;" class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td class="text-center">
                            <span class="badge badge-primary">{{ $product->id_product }}</span>
                        </td>
                        <td class="font-weight-medium">{{ $product->name_product }}</td>
                        <td>
                            @foreach($categorys as $category)
                                @if($product->id_category == $category->id_category)
                                    <span class="badge badge-info">{{ $category->name_category }}</span>
                                    @break
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($manufacturers as $manufacturer)
                                @if($product->id_manufacturer == $manufacturer->id_manufacturer)
                                    <span class="badge badge-secondary">{{ $manufacturer->name_manufacturer }}</span>
                                    @break
                                @endif
                            @endforeach
                        </td>
                        <td class="text-center">
                            <span class="badge badge-primary badge-pill">{{ $product->quantity_product }}</span>
                        </td>
                        <td class="text-right font-weight-bold text-success">
                            {{ number_format($product->price_product, 0, ',', '.') }}đ
                        </td>
                        <td class="text-center">
                            <img src="{{ asset('uploads/productimage/' . $product->image_address_product) }}"
                                 alt="{{ $product->name_product }}"
                                 class="img-thumbnail product-img"
                                 style="width: 60px; height: 60px; object-fit: cover;">
                        </td>
                        <td>
                            @if($product->sizes)
                                @foreach(explode(',', $product->sizes) as $size)
                                    <span class="badge badge-dark mr-1">{{ trim($size) }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($product->colors)
                                @foreach(explode(',', $product->colors) as $color)
                                    <span class="badge badge-light border mr-1">{{ trim($color) }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('product.indexUpdateproduct', ['id' => $product->id_product]) }}"
                                   class="btn btn-sm btn-warning"
                                   title="Chỉnh sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('product.deleteproduct', ['id' => $product->id_product]) }}"
                                   class="btn btn-sm btn-danger btn-delete no-loading"
                                   title="Xóa">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center py-4">
                            <div class="text-muted">
                                <i class="fas fa-inbox fa-3x mb-3"></i>
                                @if(isset($search) && $search)
                                    <p class="mb-0">Không tìm thấy sản phẩm nào</p>
                                    <small>Không có kết quả cho "{{ $search }}"</small>
                                @else
                                    <p class="mb-0">Không có sản phẩm nào</p>
                                    <small>Hãy thêm sản phẩm đầu tiên</small>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Phân trang -->
        @if($products->hasPages())
        <div class="card-footer clearfix">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Hiển thị {{ $products->firstItem() ?? 0 }} đến {{ $products->lastItem() ?? 0 }}
                    trong tổng số {{ $products->total() }} sản phẩm
                </div>
                <div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('styles')
<style>
    .product-img {
        transition: transform 0.3s ease;
        cursor: pointer;
    }

    .product-img:hover {
        transform: scale(2);
        z-index: 1000;
        position: relative;
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    }

    .badge {
        font-size: 0.75em;
    }

    .table td {
        vertical-align: middle;
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Auto focus vào ô tìm kiếm
        $('input[name="search"]').focus();

        // Hiệu ứng chuyển trang mượt mà
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var url = $(this).attr('href');
            showLoading();
            setTimeout(function() {
                window.location.href = url;
            }, 300);
        });

        // Xử lý form tìm kiếm
        $('form').on('submit', function() {
            const searchValue = $('input[name="search"]').val().trim();
            if (searchValue === '') {
                window.location.href = '{{ route("product.listproduct") }}';
                return false;
            }
            showLoading();
        });

        // Xử lý nút xóa sản phẩm
        $('.btn-delete').on('click', function(e) {
            e.preventDefault();
            const url = $(this).attr('href');

            Swal.fire({
                title: 'Xác nhận xóa',
                text: 'Bạn có chắc chắn muốn xóa sản phẩm này?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Có, xóa!',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading();
                    window.location.href = url;
                }
            });
        });
    });
</script>
@endsection