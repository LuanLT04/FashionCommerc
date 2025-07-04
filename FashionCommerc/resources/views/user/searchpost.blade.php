@extends('user.dashboard_user')


<!-- Product section-->
@section('content')
<div class="content">
    <div class="container">
        <h2><span>Kết quả tìm kiếm</span></h2>
        @foreach ($posts as $post)
        <div class="card">
            <div class="body-card">
                <div class="row">
                    <div class="col-md-2">
                        @foreach($post->images as $key => $image)
                        @if ($key == 0)
                            <img src="{{ asset('uploads/post/' . $image->file_name) }}" alt="" width="100%" height="auto"
                                style="border-radius:5px;">
                        @endif
                        @endforeach
                    </div>
                    <div class="col-md-10">
                        <h4><a
                                href="{{ route('post.detailpost', ['id' => $post->id_post]) }}">{{ $post->title_post }}</a>
                        </h4>
                        <?php
                $maxLength = 300;
                $content = $post->content_post;
                if (strlen($content) > $maxLength) {
                    $trimmedContent = substr($content, 0, $maxLength) . '...';
                    echo '<p id="postContent_' . $post->id . '" class="content_text">' . $trimmedContent . '</p>';
                } else {
                    echo '<p id="postContent_' . $post->id . '" class="content_text">' . $content . '</p>';
                }
            ?>
                        <p><i class="fa fa-calendar"></i> Ngày đăng: {{ $post->created_at }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<link rel="stylesheet" href="{{ asset('css/user/searchpost.css') }}">
@endsection