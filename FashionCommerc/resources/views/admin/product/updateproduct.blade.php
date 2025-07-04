@extends('admin.dashboard')

@section('content')
<main class="addproduct-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <h3 class="card-header text-center">Cập Nhật Sản Phẩm</h3>
                    <div class="card-body">
                        @if(isset($notfound) && $notfound)
                            <div class="alert alert-danger">Không tìm thấy sản phẩm để cập nhật. Có thể sản phẩm đã bị xóa ở nơi khác.</div>
                        @elseif(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <form action="{{ route('product.updateproduct') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $products?->id_product ?? '' }}">
                            <input type="hidden" name="updated_at" value="{{ $products?->updated_at ?? '' }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-3"><span>Danh mục</span></div>
                                            <div class="col-md-9">
                                                <select id="id_category" name="id_category" class="form-control"
                                                    required autofocus onchange="handleCategoryChange()">
                                                    <option value="" disabled selected hidden>--Chọn danh mục--</option>
                                                    @foreach($categorys as $category)
                                                    <option value="{{ $category->id_category }}" {{ (isset($products) && $products && $products->id_category == $category->id_category) ? 'selected' : '' }}>
                                                        {{ $category->name_category }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" id="selected_category" name="selected_category" value="{{ $products?->id_category ?? '' }}">
                                            </div>
                                        </div>
                                        @if ($errors->has('id_category'))
                                        <span class="text-danger">{{ $errors->first('id_category') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-3"><span>Hãng sản xuất</span></div>
                                            <div class="col-md-9">
                                                <select id="id_manufacturer" name="id_manufacturer"
                                                    class="form-control" required autofocus onchange="handleManufacturerChange()">
                                                    <option value="" disabled selected hidden>--Chọn hãng sản xuất--</option>
                                                    @foreach($manufacturers as $manufacturer)
                                                    <option value="{{ $manufacturer->id_manufacturer }}" {{ (isset($products) && $products && $products->id_manufacturer == $manufacturer->id_manufacturer) ? 'selected' : '' }}>
                                                        {{ $manufacturer->name_manufacturer }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" id="selected_manufacturer" name="selected_manufacturer" value="{{ $products?->id_manufacturer ?? '' }}">
                                            </div>
                                        </div>
                                        @if ($errors->has('id_manufacturer'))
                                        <span class="text-danger">{{ $errors->first('id_manufacturer') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-3"><span>Tên sản phẩm</span></div>
                                            <div class="col-md-9"> <input type="text" id="name_product"
                                                    class="form-control" name="name_product" value="{{ $products?->name_product ?? '' }}" required autofocus></div>
                                        </div>
                                        @if ($errors->has('name_product'))
                                        <span class="text-danger">{{ $errors->first('name_product') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-3"><span>Số lượng</span></div>
                                            <div class="col-md-9"> <input type="text" id="quantity_product"
                                                    class="form-control" name="quantity_product" value="{{ $products?->quantity_product ?? '' }}" required autofocus>
                                            </div>
                                        </div>
                                        @if ($errors->has('quantity_product'))
                                        <span class="text-danger">{{ $errors->first('quantity_product') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-3"><span>Kích thước</span></div>
                                            <div class="col-md-9"> <input type="text" id="sizes"
                                                    class="form-control" name="sizes" value="{{ $products?->sizes ?? '' }}" placeholder="VD: S,M,L,XL">
                                            </div>
                                        </div>
                                        @if ($errors->has('sizes'))
                                        <span class="text-danger">{{ $errors->first('sizes') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-3"><span>Giá</span></div>
                                            <div class="col-md-9"> <input type="text" id="price_product"
                                                    class="form-control" name="price_product" value="{{ $products?->price_product ?? '' }}" required autofocus></div>
                                        </div>
                                        @if ($errors->has('price_product'))
                                        <span class="text-danger">{{ $errors->first('price_product') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-3"><span>Màu sắc</span></div>
                                            <div class="col-md-9"> <input type="text" id="colors"
                                                    class="form-control" name="colors" value="{{ $products?->colors ?? '' }}" placeholder="VD: Đỏ,Xanh,Đen">
                                            </div>
                                        </div>
                                        @if ($errors->has('colors'))
                                        <span class="text-danger">{{ $errors->first('colors') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-3"><span>Ảnh sản phẩm</span></div>
                                            <div class="col-md-9 d-flex align-items-center">
                                                @if(isset($products) && $products && $products->image_address_product)
                                                    <div id="old-image" style="margin-right: 20px;">
                                                        <img src="{{ asset('uploads/productimage/' . $products->image_address_product) }}" width="100px" alt="Product Image" style="border:1px solid #ddd;border-radius:8px;box-shadow:0 2px 8px #ccc;">
                                                        <div class="text-muted small text-center">Ảnh hiện tại</div>
                                                    </div>
                                                @endif
                                                <div style="flex:1;">
                                                    <div class="custom-file">
                                                        <input type="file" id="image_address_product" class="custom-file-input" name="image_address_product" accept="image/png, image/jpeg, image/jpg, image/gif" onchange="previewProductImage(this)">
                                                        <label class="custom-file-label" for="image_address_product">Chọn ảnh mới...</label>
                                                    </div>
                                                    <div id="image-preview" style="margin-top:10px;"></div>
                                                    <span class="text-danger" id="image_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('image_address_product'))
                                        <span class="text-danger">{{ $errors->first('image_address_product') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-3"><span>Mô tả</span></div>
                                            <div class="col-md-9"> <textarea id="describe_product"
                                                    class="form-control" name="describe_product" required autofocus rows="4" style="font-size: 1.1rem;">{{ $products?->describe_product ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        @if ($errors->has('describe_product'))
                                        <span class="text-danger">{{ $errors->first('describe_product') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-3"><span>Thông số</span></div>
                                            <div class="col-md-9"> <textarea id="specifications"
                                                    class="form-control" name="specifications" required autofocus rows="4" style="font-size: 1.1rem;">{{ $products?->specifications ?? '' }}</textarea></div>
                                        </div>
                                        @if ($errors->has('specifications'))
                                        <span class="text-danger">{{ $errors->first('specifications') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row btn_login">
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6"><a href="{{ route('product.listproduct') }}" class="btn btn-secondary">Quay lại</a>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-grid mx-auto">
                                                <button type="submit" class="btn btn-primary btn-block">Cập nhật</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    function handleCategoryChange() {
        var selectedCategory = document.getElementById('id_category').value;
        document.getElementById('selected_category').value = selectedCategory;
    }

    function handleManufacturerChange() {
        var selectedManufacturer = document.getElementById('id_manufacturer').value;
        document.getElementById('selected_manufacturer').value = selectedManufacturer;
    }

    // Hiển thị tên file đã chọn
    $(document).on('change', '.custom-file-input', function (event) {
        var inputFile = event.currentTarget;
        $(inputFile).parent().find('.custom-file-label').html(inputFile.files[0]?.name || 'Chọn ảnh mới...');
    });

    // Preview ảnh sản phẩm mới bên cạnh ảnh cũ
    function previewProductImage(input) {
        const preview = document.getElementById('image-preview');
        preview.innerHTML = '';
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.innerHTML = `<img src="${e.target.result}" alt="Preview" style="max-width:100px;max-height:100px;border:1px solid #ddd;border-radius:8px;box-shadow:0 2px 8px #ccc; margin-left:10px;">`;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection