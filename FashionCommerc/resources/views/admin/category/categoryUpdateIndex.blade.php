@extends('admin.layout')
@section('title', 'Sửa danh mục')
@section('page-title', 'Sửa danh mục')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-edit mr-2"></i>Sửa Danh Mục
                    </h3>
                </div>

                <form id="categoryUpdateForm" method="POST" enctype="multipart/form-data" action="{{ route('category.updateCategory') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $category->id_category }}">

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

                        <!-- Thông tin hiện tại -->
                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle mr-2"></i>Thông tin hiện tại:</h6>
                            <p class="mb-0">
                                <strong>Tên danh mục:</strong> {{ $category->name_category }}<br>
                                <strong>Ngày tạo:</strong> {{ $category->created_at ? $category->created_at->format('d/m/Y H:i') : 'Không có' }}<br>
                                <strong>Cập nhật lần cuối:</strong> {{ $category->updated_at ? $category->updated_at->format('d/m/Y H:i') : 'Không có' }}
                            </p>
                        </div>

                        <div class="form-group">
                            <label for="name">
                                <i class="fas fa-tag mr-1"></i>Tên danh mục
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name"
                                   value="{{ old('name', $category->name_category) }}"
                                   placeholder="Nhập tên danh mục"
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

                        <!-- Ảnh hiện tại -->
                        @if($category->image_category)
                        <div class="form-group">
                            <label>Ảnh hiện tại:</label>
                            <div class="mb-2">
                                <img src="{{ asset('uploads/categoryimage/' . $category->image_category) }}"
                                     alt="{{ $category->name_category }}"
                                     class="img-thumbnail"
                                     style="max-width: 200px;">
                            </div>
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="image_category">
                                <i class="fas fa-image mr-1"></i>{{ $category->image_category ? 'Cập nhật ảnh mới' : 'Thêm ảnh danh mục' }}
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

                            <!-- Preview ảnh mới -->
                            <div id="image-preview" class="mt-3" style="display: none;">
                                <label>Ảnh mới:</label>
                                <img id="preview-img" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                            </div>
                        </div>

                        <!-- Preview -->
                        <div class="form-group">
                            <label>Xem trước:</label>
                            <div class="border rounded p-3 bg-light">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-th text-warning mr-2"></i>
                                    <span id="preview-name" class="font-weight-medium text-dark">
                                        {{ $category->name_category }}
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
                            <button type="submit" class="btn btn-warning" id="submitBtn">
                                <i class="fas fa-save mr-1"></i>Cập nhật danh mục
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
<script>
    $(document).ready(function() {
        // Auto focus và select all text
        $('#name').focus().select();

        // Preview tên danh mục
        $('#name').on('input', function() {
            const value = $(this).val().trim();
            const preview = $('#preview-name');

            if (value) {
                preview.text(value);
            } else {
                preview.text('{{ $category->name_category }}');
            }
        });

        // Validation form
        $('#categoryUpdateForm').on('submit', function(e) {
            const name = $('#name').val().trim();
            const originalName = '{{ $category->name_category }}';

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

            // Kiểm tra xem có thay đổi gì không
            const imageChanged = $('#image_category').get(0).files.length > 0;
            if (name === originalName && !imageChanged) {
                e.preventDefault();
                Swal.fire({
                    icon: 'info',
                    title: 'Thông báo',
                    text: 'Bạn chưa thay đổi gì cả!'
                });
                return false;
            }

            // Hiển thị loading
            $('#submitBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i>Đang cập nhật...');
            showLoading();
        });

        // Xử lý phím tắt
        $(document).on('keydown', function(e) {
            // Ctrl + S để lưu
            if (e.ctrlKey && e.which === 83) {
                e.preventDefault();
                $('#categoryUpdateForm').submit();
            }
            // Esc để quay lại
            if (e.which === 27) {
                window.location.href = '{{ route("category.index") }}';
            }
        });
    });

    // Preview ảnh mới khi chọn file
    function previewImage(input) {
        const previewDiv = document.getElementById('image-preview');
        const previewImg = document.getElementById('preview-img');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewDiv.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            previewDiv.style.display = 'none';
            previewImg.src = '';
        }
    }
</script>
@endsection
