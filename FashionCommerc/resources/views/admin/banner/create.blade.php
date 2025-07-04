@extends('admin.layout')

@section('title', 'Thêm Banner mới')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Thêm Banner mới</h2>
    <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Nội dung <span class="text-danger">*</span></label>
            <textarea name="content" id="content" rows="3" class="form-control @error('content') is-invalid @enderror" required>{{ old('content') }}</textarea>
            @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label for="image">
                <i class="fas fa-image mr-1"></i>Ảnh banner
                <span class="text-danger">*</span>
            </label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file"
                           id="image"
                           class="custom-file-input @error('image') is-invalid @enderror"
                           name="image"
                           accept="image/*"
                           required
                           onchange="previewImage(this)">
                    <label class="custom-file-label" for="image">Chọn ảnh</label>
                </div>
            </div>
            @error('image')
                <span class="invalid-feedback d-block">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                </span>
            @enderror
            <small class="form-text text-muted">
                <i class="fas fa-info-circle mr-1"></i>Định dạng: JPG, PNG, GIF. Kích thước tối đa: 2MB
            </small>
            <div id="image-preview" class="mt-3" style="display: none;">
                <img id="preview-img" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
            </div>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select name="status" id="status" class="form-select">
                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Hiển thị</option>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Ẩn</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save me-1"></i> Lưu banner</button>
        <a href="{{ route('banner.index') }}" class="btn btn-secondary ms-2">Quay lại</a>
    </form>
</div>
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script>
    $(document).ready(function() {
        bsCustomFileInput.init();
    });
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-img').attr('src', e.target.result);
                $('#image-preview').show();
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            $('#preview-img').attr('src', '');
            $('#image-preview').hide();
        }
    }
</script>
@endsection
<style>
.gradient-btn {
    background: linear-gradient(90deg, #f7b42c 0%, #fc575e 100%);
    color: #fff !important;
    border-radius: 8px;
    font-weight: 600;
    border: none;
    transition: background 0.2s, box-shadow 0.2s;
    box-shadow: 0 2px 8px #f7b42c33;
}
.gradient-btn:hover, .gradient-btn:focus {
    background: linear-gradient(90deg, #fc575e 0%, #f7b42c 100%);
    color: #fff !important;
    box-shadow: 0 4px 16px #fc575e33;
}
.custom-file-input ~ .custom-file-label {
    cursor: pointer;
}
</style>
@endsection 