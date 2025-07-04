@extends('admin.layout')
@section('title', 'Thêm danh mục')
@section('page-title', 'Thêm danh mục')
@section('meta_description', 'Trang thêm danh mục mới cho hệ thống bán hàng thời trang.')
@section('meta_keywords', 'thêm danh mục, admin, sản phẩm, thời trang')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-plus-circle mr-2"></i>Thêm Danh Mục Mới
                    </h3>
                </div>

                <form action="{{ route('category.store') }}" method="POST" id="categoryForm" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <!-- Hiển thị lỗi chung -->
                        @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h6><i class="fas fa-exclamation-triangle mr-2"></i>Có lỗi xảy ra:</h6>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="name">
                                <i class="fas fa-tag mr-1"></i>Tên danh mục
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name"
                                   value="{{ old('name') }}"
                                   placeholder="Nhập tên danh mục (ví dụ: Áo thun, Quần jean...)"
                                   required
                                   maxlength="100"
                                   autocomplete="off">
                            @error('name')
                                <span class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </span>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Tên danh mục phải từ 2-100 ký tự
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="image_category">
                                <i class="fas fa-image mr-1"></i>Ảnh danh mục
                                <span class="text-muted">(Tùy chọn)</span>
                            </label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file"
                                           id="image_category"
                                           class="custom-file-input @error('image_category') is-invalid @enderror"
                                           name="image_category"
                                           accept="image/*"
                                           onchange="previewImage(this)">
                                    <label class="custom-file-label" for="image_category">Chọn ảnh</label>
                                </div>
                            </div>
                            @error('image_category')
                                <span class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </span>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Định dạng: JPG, PNG, GIF. Kích thước tối đa: 2MB
                            </small>

                            <!-- Preview ảnh -->
                            <div id="image-preview" class="mt-3" style="display: none;">
                                <img id="preview-img" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                            </div>
                        </div>

                        <!-- Preview -->
                        <div class="form-group">
                            <label>Xem trước:</label>
                            <div class="border rounded p-3 bg-light">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-th text-primary mr-2"></i>
                                    <span id="preview-name" class="font-weight-medium text-muted">
                                        Nhập tên danh mục để xem trước...
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('category.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-1"></i>Quay lại
                            </a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save mr-1"></i>Thêm danh mục
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize custom file input
        bsCustomFileInput.init();

        // Auto focus vào input
        $('#name').focus();

        // Preview tên danh mục
        $('#name').on('input', function() {
            const value = $(this).val().trim();
            const preview = $('#preview-name');

            if (value) {
                preview.text(value).removeClass('text-muted').addClass('text-dark');
            } else {
                preview.text('Nhập tên danh mục để xem trước...').removeClass('text-dark').addClass('text-muted');
            }
        });

        // Validation form
        $('#categoryForm').on('submit', function(e) {
            const name = $('#name').val().trim();

            if (name.length < 2) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: 'Tên danh mục phải có ít nhất 2 ký tự'
                });
                $('#name').focus();
                return false;
            }

            if (name.length > 100) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: 'Tên danh mục không được vượt quá 100 ký tự'
                });
                $('#name').focus();
                return false;
            }

            // Hiển thị loading
            $('#submitBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i>Đang xử lý...');
            showLoading();
        });

        // Xử lý phím tắt
        $(document).on('keydown', function(e) {
            // Ctrl + S để lưu
            if (e.ctrlKey && e.which === 83) {
                e.preventDefault();
                $('#categoryForm').submit();
            }
            // Esc để quay lại
            if (e.which === 27) {
                window.location.href = '{{ route("category.index") }}';
            }
        });
    });

    // Hàm preview ảnh
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                $('#preview-img').attr('src', e.target.result);
                $('#image-preview').show();
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            $('#image-preview').hide();
        }
    }
</script>
@endsection
