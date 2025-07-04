@extends('admin.dashboard')

@section('content')
<main class="addpost-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">Thêm Bài Viết</h3>
                    <div class="card-body">
                        <form action="{{ route('post.addpost') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-md-3"><span>Tên bài viết</span></div>
                                    <div class="col-md-9"> <input type="text" id="title_post" class="form-control"
                                            name="title_post" required autofocus></div>
                                </div>
                                @if ($errors->has('title_post'))
                                <span class="text-danger">{{ $errors->first('title_post') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-md-3"><span>Nội dung bài viết:</span></div>
                                    <div class="col-md-9"> <input type="text" id="content_post" class="form-control"
                                            name="content_post" required autofocus></div>
                                </div>
                                @if ($errors->has('content_post'))
                                <span class="text-danger">{{ $errors->first('content_post') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-md-3"><span>Ảnh của bài viết:</span></div>
                                    <div class="col-md-9"><input type="file" id="images_post" name="images_post[]"
                                            multiple></div>
                                </div>
                                @if ($errors->has('images_post'))
                                <span class="text-danger">{{ $errors->first('images_post') }}</span>
                                @endif
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
@endsection