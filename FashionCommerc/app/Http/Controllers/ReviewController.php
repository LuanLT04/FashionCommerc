<?php
namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\ReviewComment;
use App\Models\ReviewLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Lấy danh sách đánh giá của sản phẩm
    public function index($id_product)
    {
        $reviews = Review::with(['user', 'comments.user', 'comments.likes', 'comments.children.user', 'comments.children.likes', 'likes'])
            ->where('id_product', $id_product)
            ->orderByDesc('created_at')
            ->get();
        // Bổ sung media cho review và comment, luôn đảm bảo là mảng
        $reviews->transform(function($review) {
            $media = [];
            if ($review->images) {
                try {
                    $media = json_decode($review->images, true);
                    if (!is_array($media)) $media = [];
                } catch (\Exception $e) { $media = []; }
            }
            $review->media = $media;
            $review->comments->transform(function($c) {
                $media = [];
                if ($c->images) {
                    try {
                        $media = json_decode($c->images, true);
                        if (!is_array($media)) $media = [];
                    } catch (\Exception $e) { $media = []; }
                }
                $c->media = $media;
                // Bổ sung media cho children
                if ($c->children) {
                    $c->children->transform(function($child) {
                        $media = [];
                        if ($child->images) {
                            try {
                                $media = json_decode($child->images, true);
                                if (!is_array($media)) $media = [];
                            } catch (\Exception $e) { $media = []; }
                        }
                        $child->media = $media;
                        return $child;
                    });
                }
                return $c;
            });
            return $review;
        });
        return response()->json($reviews);
    }

    // Thêm đánh giá mới
    public function store(Request $request)
    {
        $id_user = session('id_user');
        if (!$id_user) {
            return response()->json(['error' => 'Bạn cần đăng nhập để đánh giá sản phẩm!'], 401);
        }
        try {
            $mediaArr = [];
            if ($request->hasFile('media')) {
                foreach ($request->file('media') as $file) {
                    $path = $file->store('review_media', 'public');
                    $mediaArr[] = [
                        'url' => asset('storage/' . $path),
                        'type' => $file->getMimeType(),
                        'name' => $file->getClientOriginalName(),
                    ];
                }
            }
            $review = Review::create([
                'id_product' => $request->id_product,
                'id_user' => $id_user,
                'rating' => $request->rating,
                'content' => $request->content,
                'images' => $mediaArr ? json_encode($mediaArr) : null,
            ]);
            return response()->json($review, 201);
        } catch (\Exception $e) {
            \Log::error('Review store error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Thêm bình luận trả lời cho đánh giá
    public function comment(Request $request)
    {
        $id_user = session('id_user');
        if (!$id_user) {
            return response()->json(['error' => 'Bạn cần đăng nhập để trả lời!'], 401);
        }
        $mediaArr = [];
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $path = $file->store('review_media', 'public');
                $mediaArr[] = [
                    'url' => asset('storage/' . $path),
                    'type' => $file->getMimeType(),
                    'name' => $file->getClientOriginalName(),
                ];
            }
        }
        $parentId = $request->parent_id;
        if ($parentId === '' || $parentId === null) $parentId = null;
        $comment = ReviewComment::create([
            'review_id' => $request->review_id,
            'id_user' => $id_user,
            'parent_id' => $parentId,
            'content' => $request->content,
            'images' => $mediaArr ? json_encode($mediaArr) : null,
        ]);
        return response()->json($comment, 201);
    }

    // Like hoặc Unlike đánh giá
    public function like(Request $request)
    {
        $id_user = session('id_user');
        if (!$id_user) {
            return response()->json(['error' => 'Bạn cần đăng nhập để thích đánh giá!'], 401);
        }
        $reviewId = $request->review_id;
        $like = ReviewLike::where('review_id', $reviewId)->where('id_user', $id_user)->first();
        if ($like) {
            $like->delete();
            return response()->json(['liked' => false]);
        } else {
            ReviewLike::create([
                'review_id' => $reviewId,
                'id_user' => $id_user,
            ]);
            return response()->json(['liked' => true]);
        }
    }

    public function likeComment(Request $request)
    {
        $id_user = session('id_user');
        if (!$id_user) {
            return response()->json(['error' => 'Bạn cần đăng nhập để thích bình luận!'], 401);
        }
        $commentId = $request->comment_id;
        // Like chỉ cho comment (review comment), không phải review chính
        $like = \App\Models\ReviewLike::where('review_id', $commentId)
            ->where('id_user', $id_user)
            ->first();
        if ($like) {
            $like->delete();
            return response()->json(['liked' => false]);
        } else {
            \App\Models\ReviewLike::create([
                'review_id' => $commentId,
                'id_user' => $id_user,
            ]);
            return response()->json(['liked' => true]);
        }
    }
} 