@extends('admin.layout')

@section('title', 'Sửa Banner')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Sửa Banner</h2>
    <form action="{{ route('banner.update', $banner->id_banner) }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $banner->title) }}" required>
            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Nội dung <span class="text-danger">*</span></label>
            <textarea name="content" id="content" rows="3" class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $banner->content) }}</textarea>
            @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header py-2"><strong>Ảnh hiện tại</strong></div>
                    <div class="card-body text-center">
                        @if($banner->image)
                            <img src="{{ asset('uploads/banner/' . $banner->image) }}" alt="Banner hiện tại" class="img-thumbnail" style="max-width:200px;">
                        @else
                            <span class="text-muted">Chưa có hình ảnh</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header py-2"><strong>Chọn ảnh mới (nếu muốn thay đổi)</strong></div>
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="image" id="image" class="custom-file-input @error('image') is-invalid @enderror" accept="image/*" onchange="previewImage(this)">
                                    <label class="custom-file-label" for="image" id="imageLabel">Chọn ảnh mới...</label>
                                </div>
                            </div>
                            @error('image')<span class="invalid-feedback d-block"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span>@enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Định dạng: JPG, PNG, GIF. Kích thước tối đa: 2MB
                            </small>
                        </div>
                        <div id="image-preview" class="mt-3" style="display: none;">
                            <img id="preview-img" src="" alt="Preview ảnh mới" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select name="status" id="status" class="form-select">
                <option value="1" {{ old('status', $banner->status) == '1' ? 'selected' : '' }}>Hiển thị</option>
                <option value="0" {{ old('status', $banner->status) == '0' ? 'selected' : '' }}>Ẩn</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save me-1"></i> Cập nhật banner</button>
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
.custom-image-upload { display: flex; align-items: center; gap: 10px; justify-content: center; }
.custom-file-input { display: none; }
.custom-file-label {
    background: linear-gradient(90deg, #f7b42c 0%, #fc575e 100%);
    color: #fff; padding: 8px 18px; border-radius: 6px; cursor: pointer;
    font-weight: 500; transition: background 0.2s;
}
.custom-file-label:hover { background: linear-gradient(90deg, #fc575e 0%, #f7b42c 100%); }
</style>
@endsection 