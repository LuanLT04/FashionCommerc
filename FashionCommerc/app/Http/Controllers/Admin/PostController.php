<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\Image_Post;
use App\Models\ImagePost;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function detailPost(Request $request)
    {
        $id_post = $request->query("id");
        $post = Posts::where("id_post", $id_post)->first();
        $images = Image_Post::join('postimages', 'images_posts.id_image_post', '=', 'postimages.id_image_post')
            ->join('posts', 'posts.id_post', '=', 'postimages.id_post')
            ->where('posts.id_post', '=', $post->id_post)
            ->get();
        $file_name_image_post = [];
        foreach ($images as $item) {
            $file_name_image_post[] = $item->file_name;
        }
        
        // Get cart and order counts for the authenticated user
        $cartCount = 0;
        $orderCount = 0;
        
        if (auth()->check()) {
            $user = auth()->user();
            $cartCount = \App\Models\Cart::where('id_user', $user->id_user)->count();
            $orderCount = \App\Models\Order::where('id_user', $user->id_user)->count();
        }
        
        return view('user.detailpost', [
            'post' => $post,
            'file_name_image_post' => $file_name_image_post,
            'cartCount' => $cartCount,
            'orderCount' => $orderCount
        ]);
    }
    public function listPost()
    {
        $pos = Posts::all();
        $posts = Posts::getPostWithPagination(5);
        $postImages = [];
        foreach ($pos as $post) {
            $images = ImagePost::where('id_post', $post->id_post)->get();
            $imageNames = [];
            foreach ($images as $image) {
                $imageName = Image_Post::where('id_image_post', $image->id_image_post)->value('file_name');
                $imageNames[] = $imageName;
            }
            $postImages[$post->id_post] = $imageNames;
        }
        return view('admin.post.listpost', ['posts' => $posts, 'postImages' => $postImages]);
    }
    public function indexAddPost()
    {
        return view('admin.post.addpost');
    }
    public function addPost(Request $request)
    {

        $data = $request->all();
        $post = Posts::create([
            'title_post' => $data['title_post'],
            'content_post' => $data['content_post'],

        ]);
        $images = $request->file('images_post');
        $filenames = [];
        foreach ($images as $image) {
            $ex = $image->getClientOriginalExtension();
            $filename = time() . '_' . uniqid() . '.' . $ex;
            $image->move('uploads/post/', $filename);
            $filenames[] = $filename;
        }
        $id_post = $post->id_post;
        foreach ($filenames as $filename) {
            $image_post = Image_Post::create(['file_name' => $filename]);
            $id_image_post = $image_post->id_image_post;
            ImagePost::create([
                'id_post' => $id_post,
                'id_image_post' => $id_image_post,
            ]);
        }
        return redirect()->route('post.listpost')->with('success', 'Thêm bài viết thành công!');
    }

    public function deletePost($id)
    {
        try {
            $post = Posts::where('id_post', $id)->first();
            
            if (!$post) {
                return redirect()->route('post.listpost')->with('error', 'Không tìm thấy bài viết cần xóa');
            }

            // Xóa ảnh liên quan
            $image_posts = Image_Post::select('images_posts.*')
                ->leftJoin('postimages', 'images_posts.id_image_post', '=', 'postimages.id_image_post')
                ->leftJoin('posts', 'posts.id_post', '=', 'postimages.id_post')
                ->where('posts.id_post', $post->id_post)
                ->get();

            foreach ($image_posts as $image_post) {
                $image_path = 'uploads/post/' . $image_post->file_name;
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            // Xóa dữ liệu từ database
        Image_Post::select('images_posts.id_image_post')
            ->join('postimages', 'images_posts.id_image_post', '=', 'postimages.id_image_post')
            ->join('posts', 'posts.id_post', '=', 'postimages.id_post')
                ->where('posts.id_post', $id)->delete();
            ImagePost::where('id_post', $id)->delete();
            Posts::where('id_post', $id)->delete();

            return redirect()->route('post.listpost')->with('success', 'Xóa bài viết thành công!');
        } catch (\Exception $e) {
            return redirect()->route('post.listpost')->with('error', 'Có lỗi xảy ra khi xóa bài viết: ' . $e->getMessage());
        }
    }

    public function indexUpdatePost(Request $request)
    {
        $id_post = $request->get('id');
        $post = Posts::where('id_post', $id_post)->first();
        return view('admin.post.updatepost',     ['post' => $post]);
    }

    public function updatePost(Request $request)
    {
        $data = $request->all();
        $id_post = $data['id'];
        $post = Posts::where('id_post', $id_post)->first();
        $post->title_post = $data['title_post'];
        $post->content_post = $data['content_post'];
        $post->save();
        $image_posts = Image_Post::select('images_posts.*')
            ->leftJoin('postimages', 'images_posts.id_image_post', '=', 'postimages.id_image_post')
            ->leftJoin('posts', 'posts.id_post', '=', 'postimages.id_post')
            ->where('posts.id_post', $post->id_post)
            ->get();

        foreach ($image_posts as $image_post) {
            //Xoa ảnh cũ
            $image_cu = 'uploads/post/' . $image_post->file_name;
            if (File::exists($image_cu)) {
                File::delete($image_cu);
            }
        }
        //Xóa ảnh cũ của database
        Image_Post::select('images_posts.*')
            ->leftJoin('postimages', 'images_posts.id_image_post', '=', 'postimages.id_image_post')
            ->leftJoin('posts', 'posts.id_post', '=', 'postimages.id_post')
            ->where('posts.id_post', $post->id_post)
            ->delete();
        ImagePost::where('id_post', $id_post)->delete();
        $files = $request->file('images_post');
        if ($files) {
            foreach ($files as $file) {
                $ex = $file->getClientOriginalExtension(); //Lấy phần mở rộng .jpn,....
                $filename = time() . '_' . uniqid() . '.' . $ex;
                $file->move('uploads/post/', $filename);
                $image_post->file_name = $filename;
                $image_post_new = Image_Post::create(['file_name' => $image_post->file_name]);
                ImagePost::create([
                    'id_post' => $post->id_post,
                    'id_image_post' => $image_post_new->id_image_post,
                ]);
            }
        }
        return redirect()->route('post.listpost')->with('success', 'Cập nhật bài viết thành công!');
    }

    public function indexListPostUser(Request $request)
    {
        $posts = Posts::with('images')->latest()->take(2)->get();
        $postsnew = Posts::with('images')->latest()->paginate(5);
        $user = auth()->user();
        $cartCount = 0;
        $orderCount = 0;
        if ($user) {
            $cartCount = \App\Models\Cart::where('id_user', $user->id_user)->count();
            $orderCount = \App\Models\Order::where('id_user', $user->id_user)->count();
        }
        return view('user.listpostuser', [
            'posts' => $posts,
            'postsnew' => $postsnew,
            'cartCount' => $cartCount,
            'orderCount' => $orderCount
        ]);
    }

    public function searchPost(Request $request){
        $data = $request->input('input-search'); // Lấy dữ liệu tìm kiếm từ request
        $posts = Posts::with('images')
        ->where('title_post', 'like', '%'.$data.'%')
        ->orWhere('content_post', 'like', '%'.$data.'%')
        ->get();// Tìm kiếm trong trường title_post
        return view('user.searchpost', ['posts' => $posts]); 
    }
}