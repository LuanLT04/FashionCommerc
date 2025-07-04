@extends('admin.dashboard')

@section('content')
<main class="addproduct-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <h3 class="card-header text-center">Thêm Sản Phẩm</h3>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('product.addproduct') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                            @csrf
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
                                                    <option value="{{ $category->id_category }}" {{ old('id_category') == $category->id_category ? 'selected' : '' }}>
                                                        {{ $category->name_category }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" id="selected_category" name="selected_category" value="{{ old('id_category') }}">
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
                                                    <option value="{{ $manufacturer->id_manufacturer }}" {{ old('id_manufacturer') == $manufacturer->id_manufacturer ? 'selected' : '' }}>
                                                        {{ $manufacturer->name_manufacturer }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" id="selected_manufacturer" name="selected_manufacturer" value="{{ old('id_manufacturer') }}">
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
                                                    class="form-control" name="name_product" required autofocus oninput="validateProductName(this)" value="{{ old('name_product') }}">
                                                <small class="text-muted">Không quá 100 ký tự</small>
                                                <span class="text-danger" id="name_product_error"></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('name_product'))
                                        <span class="text-danger">{{ $errors->first('name_product') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-3"><span>Số lượng</span></div>
                                            <div class="col-md-9"> <input type="text" id="quantity_product"
                                                    class="form-control" name="quantity_product" required autofocus oninput="validateQuantity(this)" value="{{ old('quantity_product') }}">
                                                <small class="text-muted">Chỉ nhập số nguyên</small>
                                                <span class="text-danger" id="quantity_product_error"></span>
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
                                                    class="form-control" name="sizes" placeholder="VD: S,M,L,XL" oninput="validateSizes(this)" value="{{ old('sizes') }}">
                                                <small class="text-muted">Chỉ nhập số và chữ, không quá 10 ký tự</small>
                                                <span class="text-danger" id="sizes_error"></span>
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
                                                    class="form-control" name="price_product" required autofocus oninput="validatePrice(this)" value="{{ old('price_product') }}">
                                                <small class="text-muted">Chỉ nhập ký tự số</small>
                                                <span class="text-danger" id="price_product_error"></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('price_product'))
                                        <span class="text-danger">{{ $errors->first('price_product') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-3"><span>Màu sắc</span></div>
                                            <div class="col-md-9"> <input type="text" id="colors"
                                                    class="form-control" name="colors" placeholder="VD: Đỏ,Xanh,Đen" value="{{ old('colors') }}">
                                            </div>
                                        </div>
                                        @if ($errors->has('colors'))
                                        <span class="text-danger">{{ $errors->first('colors') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-3"><span>Ảnh sản phẩm</span></div>
                                            <div class="col-md-9">
                                                <div class="custom-file">
                                                    <input type="file" id="image_address_product" class="custom-file-input" name="image_address_product" required accept="image/png, image/jpeg, image/jpg, image/gif" onchange="previewProductImage(this)">
                                                    <label class="custom-file-label" for="image_address_product">Chọn ảnh sản phẩm...</label>
                                                </div>
                                                <div id="image-preview" style="margin-top:10px;"></div>
                                                <span class="text-danger" id="image_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-3"><span>Mô tả</span></div>
                                            <div class="col-md-9">
                                                <textarea id="describe_product" class="form-control" name="describe_product" required autofocus oninput="validateDescription(this)" rows="4" style="font-size: 1.1rem;">{{ old('describe_product') }}</textarea>
                                                <small class="text-muted">Không quá 500 ký tự</small>
                                                <span class="text-danger" id="describe_product_error"></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('describe_product'))
                                        <span class="text-danger">{{ $errors->first('describe_product') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-3"><span>Thông số</span></div>
                                            <div class="col-md-9">
                                                <textarea id="specifications" class="form-control" name="specifications" required autofocus oninput="validateSpecifications(this)" rows="4" style="font-size: 1.1rem;">{{ old('specifications') }}</textarea>
                                                <small class="text-muted">Không quá 500 ký tự</small>
                                                <span class="text-danger" id="specifications_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row btn_login">
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6"><a href="#"></a>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-grid mx-auto">
                                                <button type="submit" class="btn btn-primary btn-block">Lưu</button>
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
    // Disable submit button after click
    document.querySelector('.addproduct-form form').addEventListener('submit', function() {
        this.querySelector('button[type="submit"]').setAttribute('disabled', 'disabled');
    });

    function handleCategoryChange() {
        var selectedCategory = document.getElementById('id_category').value;
        document.getElementById('selected_category').value = selectedCategory;
    }

    function handleManufacturerChange() {
        var selectedManufacturer = document.getElementById('id_manufacturer').value;
        document.getElementById('selected_manufacturer').value = selectedManufacturer;
    }

    function validateProductName(input) {
        const maxLength = 100;
        const errorElement = document.getElementById('name_product_error');
        if (input.value.length > maxLength) {
            errorElement.textContent = 'Bạn đã nhập quá 100 ký tự';
            return false;
        }
        errorElement.textContent = '';
        return true;
    }

    function validateQuantity(input) {
        const errorElement = document.getElementById('quantity_product_error');
        if (!/^\d+$/.test(input.value.trim())) {
            errorElement.textContent = 'Yêu cầu nhập trường chỉ nhập ký tự số nguyên';
            return false;
        }
        errorElement.textContent = '';
        return true;
    }

    function validatePrice(input) {
        const errorElement = document.getElementById('price_product_error');
        if (!/^\d+(\.\d+)?$/.test(input.value.trim())) {
            errorElement.textContent = 'Trường chữ nhập ký tự số yêu cầu nhập lại';
            return false;
        }
        errorElement.textContent = '';
        return true;
    }

    function validateSizes(input) {
        const errorElement = document.getElementById('sizes_error');
        const regex = /^[a-zA-Z0-9,]{1,10}$/;
        if (!regex.test(input.value)) {
            errorElement.textContent = 'Bạn đã nhập sai ký tự ngoài số và chữ yêu cầu nhập lại';
            return false;
        }
        errorElement.textContent = '';
        return true;
    }

    function validateDescription(input) {
        const maxLength = 500;
        const errorElement = document.getElementById('describe_product_error');
        if (input.value.length > maxLength) {
            errorElement.textContent = 'Bạn đã nhập quá ký tự yêu cầu chỉ nhập không quá 500 ký tự';
            return false;
        }
        errorElement.textContent = '';
        return true;
    }

    function validateImage(input) {
        const errorElement = document.getElementById('image_error');
        if (!input.value) {
            errorElement.textContent = 'Vui lòng chọn ảnh sản phẩm';
            return false;
        }
        const allowedExtensions = /\.(jpg|jpeg|png|gif)$/i;
        if (!allowedExtensions.exec(input.value)) {
            errorElement.textContent = 'Chỉ cho phép file ảnh jpg, jpeg, png, gif';
            input.value = '';
            return false;
        }
        errorElement.textContent = '';
        return true;
    }

    function validateSpecifications(input) {
        const errorElement = document.getElementById('specifications_error');
        const maxLength = 500;
        if (input.value.length > maxLength) {
            errorElement.textContent = 'Bạn đã nhập quá 500 ký tự, yêu cầu chỉ nhập không quá 500 ký tự';
            return false;
        }
        errorElement.textContent = '';
        return true;
    }

    function validateForm() {
        // Prevent HTML injection
        const textFields = ['name_product', 'describe_product', 'specifications'];
        for (const field of textFields) {
            const value = document.getElementById(field).value;
            if (value.includes('<') || value.includes('>')) {
                alert('Không được phép nhập các ký tự HTML (<, >)');
                return false;
            }
        }

        // Check text length
        const nameProduct = document.getElementById('name_product').value;
        if (nameProduct.length > 100) {
            alert('Tên sản phẩm không được vượt quá 100 ký tự');
            return false;
        }

        const describeProduct = document.getElementById('describe_product').value;
        if (describeProduct.length > 500) {
            alert('Mô tả không được vượt quá 500 ký tự');
            return false;
        }

        const specifications = document.getElementById('specifications').value;
        if (specifications && specifications.length > 500) {
            alert('Thông số kỹ thuật không được vượt quá 500 ký tự');
            return false;
        }

        // Check for whitespace-only input
        const inputs = document.querySelectorAll('input[type="text"], textarea');
        for (const input of inputs) {
            if (input.value.trim() === '') {
                alert('Không được phép nhập toàn khoảng trắng');
                return false;
            }
        }

        // Validate numeric input
        const quantityProduct = document.getElementById('quantity_product').value;
        if (!/^\d+$/.test(quantityProduct)) {
            alert('Số lượng phải là số nguyên');
            return false;
        }

        const priceProduct = document.getElementById('price_product').value;
        if (!/^\d+(\.\d+)?$/.test(priceProduct)) {
            alert('Giá phải là số');
            return false;
        }

        // Check for full-width numbers
        const fullWidthNumbers = /[０-９]/;
        if (fullWidthNumbers.test(quantityProduct) || fullWidthNumbers.test(priceProduct)) {
            alert('Không được phép nhập số dạng full-width');
            return false;
        }

        // Validate select options
        const categorySelect = document.getElementById('id_category');
        if (categorySelect.value === '') {
            alert('Vui lòng chọn danh mục');
            return false;
        }

        const manufacturerSelect = document.getElementById('id_manufacturer');
        if (manufacturerSelect.value === '') {
            alert('Vui lòng chọn hãng sản xuất');
            return false;
        }

        return true;
    }

    // Prevent form submission if no option is selected
    document.querySelector('form').addEventListener('submit', function(e) {
        const categorySelect = document.getElementById('id_category');
        const manufacturerSelect = document.getElementById('id_manufacturer');

        if (categorySelect.value === '' || manufacturerSelect.value === '') {
            e.preventDefault();
            alert('Vui lòng chọn đầy đủ danh mục và hãng sản xuất');
        }
    });

    // Prevent paste of HTML content
    document.addEventListener('paste', function(e) {
        const target = e.target;
        if (target.tagName === 'INPUT' || target.tagName === 'TEXTAREA') {
            const pastedText = (e.clipboardData || window.clipboardData).getData('text');
            if (pastedText.includes('<') || pastedText.includes('>')) {
                e.preventDefault();
                alert('Không được phép dán nội dung HTML');
            }
        }
    });

    // Prevent paste of non-numeric characters in numeric fields
    document.addEventListener('paste', function(e) {
        const target = e.target;
        if (target.id === 'quantity_product' || target.id === 'price_product') {
            const pastedText = (e.clipboardData || window.clipboardData).getData('text');
            if (!/^\d+(\.\d+)?$/.test(pastedText)) {
                e.preventDefault();
                alert('Chỉ được phép dán số');
            }
        }
    });

    // Prevent input of non-numeric characters in numeric fields
    document.getElementById('quantity_product').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^\d]/g, '');
    });

    document.getElementById('price_product').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^\d.]/g, '');
    });

    // Hiển thị tên file đã chọn
    $(document).on('change', '.custom-file-input', function (event) {
        var inputFile = event.currentTarget;
        $(inputFile).parent().find('.custom-file-label').html(inputFile.files[0]?.name || 'Chọn ảnh sản phẩm...');
    });

    // Preview ảnh sản phẩm
    function previewProductImage(input) {
        const preview = document.getElementById('image-preview');
        preview.innerHTML = '';
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.innerHTML = `<img src="${e.target.result}" alt="Preview" style="max-width:150px;max-height:150px;border:1px solid #ddd;border-radius:8px;box-shadow:0 2px 8px #ccc;">`;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection