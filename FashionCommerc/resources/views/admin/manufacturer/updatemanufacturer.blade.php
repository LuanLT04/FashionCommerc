@extends('admin.dashboard')

@section('content')
<main class="updatemanufacturer-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">Sửa Hãng Sản Xuất</h3>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="{{ route('manufacturer.updatemanufacturer') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input name="id" type="hidden" value="{{$manufacturer->id_manufacturer}}">
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-md-3"><span>Tên hãng sản xuất</span></div>
                                    <div class="col-md-9"><input type="text" id="name_manufacturer" class="form-control"
                                            name="name_manufacturer" value="{{ $manufacturer->name_manufacturer }}"
                                            required autofocus></div>
                                    @if ($errors->has('name_manufacturer'))
                                    <span class="text-danger">{{ $errors->first('name_manufacturer') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-md-3"><span>Ảnh hãng sản xuất</span></div>
                                    <div class="col-md-9">
                                        <input type="file" id="fileToUpload" class="form-control"
                                        name="image_manufacturer" onchange="previewImage(this)">
                                        @if ($manufacturer->image_manufacturer)
                                        <div class="mt-2">
                                            <small class="text-muted">Ảnh hiện tại:</small>
                                            <img src="{{ asset('uploads/manufacturerimage/' . $manufacturer->image_manufacturer) }}" 
                                                 alt="Ảnh hiện tại" 
                                                 style="max-width: 100px; max-height: 100px; border: 1px solid #ddd; border-radius: 4px; margin-left: 10px;">
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                @if ($errors->has('image_manufacturer'))
                                <span class="text-danger">{{ $errors->first('image_manufacturer') }}</span>
                                @endif
                            </div>

                            <div class="row btn_login">
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6"></div>
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
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                // Tạo preview cho ảnh mới
                const previewDiv = input.parentElement.querySelector('.mt-2');
                if (previewDiv) {
                    previewDiv.innerHTML = `
                        <small class="text-muted">Ảnh mới:</small>
                        <img src="${e.target.result}" alt="Preview" 
                             style="max-width: 100px; max-height: 100px; border: 1px solid #ddd; border-radius: 4px; margin-left: 10px;">
                    `;
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection