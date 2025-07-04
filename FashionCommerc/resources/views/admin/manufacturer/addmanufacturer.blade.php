@extends('admin.dashboard')

@section('content')
<main class="addmanufacturer-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">Thêm Hãng Sản Xuất</h3>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(
                            $errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="{{ route('manufacturer.addmanufacturer') }}" method="POST"
                            enctype="multipart/form-data" onsubmit="return validateForm()">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-md-3"><span>Tên hãng sản xuất</span></div>
                                    <div class="col-md-9"> <input type="text" id="name_manufacturer"
                                            class="form-control" name="name_manufacturer" required autofocus oninput="validateManufacturerName(this)">
                                        <span class="text-danger" id="name_manufacturer_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-md-3"><span>Ảnh hãng sản xuất</span></div>
                                    <div class="col-md-9"><input type="file" id="fileToUpload" class="form-control"
                                            name="image_manufacturer" required onchange="validateImage(this)">
                                        <span class="text-danger" id="image_manufacturer_error"></span>
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
    function validateManufacturerName(input) {
        const maxLength = 100;
        const regex = /^[a-zA-Z0-9À-ỹ\s\.,\-()]+$/u;
        const errorElement = document.getElementById('name_manufacturer_error');
        if (input.value.length > maxLength) {
            errorElement.textContent = 'Tên hãng không quá 100 ký tự';
            return false;
        }
        if (!regex.test(input.value)) {
            errorElement.textContent = 'Tên hãng chỉ được chứa chữ, số và một số ký tự hợp lệ';
            return false;
        }
        errorElement.textContent = '';
        return true;
    }

    function validateImage(input) {
        const errorElement = document.getElementById('image_manufacturer_error');
        if (!input.value) {
            errorElement.textContent = 'Vui lòng chọn ảnh hãng sản xuất';
            return false;
        }
        errorElement.textContent = '';
        return true;
    }

    function validateForm() {
        const nameValid = validateManufacturerName(document.getElementById('name_manufacturer'));
        const imageValid = validateImage(document.getElementById('fileToUpload'));
        return nameValid && imageValid;
    }
</script>
@endsection