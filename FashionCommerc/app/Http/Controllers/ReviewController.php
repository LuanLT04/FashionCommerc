<?php
namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\ReviewComment;
use App\Models\ReviewLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    // Lấy danh sách đánh giá của sản phẩm
    public function index($id_product)
    {
        // Load reviews với user và likes
        $reviews = Review::with(['user', 'likes'])
            ->where('id_product', $id_product)
            ->orderByDesc('created_at')
            ->get();

        // Load tất cả comments cho các reviews này
        $reviewIds = $reviews->pluck('id');
        $allComments = ReviewComment::with(['user', 'likes'])
            ->whereIn('review_id', $reviewIds)
            ->orderBy('created_at')
            ->get();

        // Build comment tree cho mỗi review
        foreach ($reviews as $review) {
            $reviewComments = $allComments->where('review_id', $review->id);
            $review->comments = $this->buildCommentTree($reviewComments);
        }
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

            // Thêm avatar_url cho user
            if ($review->user) {
                $review->user->avatar_url = $review->user->avatar_url;
            }
            $review->comments->transform(function($c) {
                $media = [];
                if ($c->images) {
                    try {
                        $media = json_decode($c->images, true);
                        if (!is_array($media)) $media = [];
                    } catch (\Exception $e) { $media = []; }
                }
                $c->media = $media;

                // Thêm avatar_url cho user của comment
                if ($c->user) {
                    $c->user->avatar_url = $c->user->avatar_url;
                }
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

                        // Thêm avatar_url cho user của child comment
                        if ($child->user) {
                            $child->user->avatar_url = $child->user->avatar_url;
                        }

                        return $child;
                    });
                }
                return $c;
            });
            return $review;
        });
        return response()->json($reviews);
    }

    // Build comment tree structure
    private function buildCommentTree($comments)
    {
        $commentMap = [];
        $rootComments = [];

        // First pass: create map and identify root comments
        foreach ($comments as $comment) {
            $commentMap[$comment->id] = $comment;
            $comment->children = collect();

            // Thêm avatar_url cho user của comment
            if ($comment->user) {
                $comment->user->avatar_url = $comment->user->avatar_url;
            }

            if ($comment->parent_id === null) {
                $rootComments[] = $comment;
            }
        }

        // Second pass: build parent-child relationships
        foreach ($comments as $comment) {
            if ($comment->parent_id !== null && isset($commentMap[$comment->parent_id])) {
                $commentMap[$comment->parent_id]->children->push($comment);
            }
        }

        return collect($rootComments);
    }

    // Thêm đánh giá mới
    public function store(Request $request)
    {
        // Hỗ trợ cả session id_user và cart user_id
        $id_user = session('id_user') ?? session('cart')['user_id'] ?? auth()->id();
        if (!$id_user) {
            return response()->json(['error' => 'Bạn cần đăng nhập để đánh giá sản phẩm!'], 401);
        }

        // Validation - hỗ trợ cả id_product và product_id
        $productIdField = $request->has('product_id') ? 'product_id' : 'id_product';
        $request->validate([
            $productIdField => 'required|exists:products,id_product',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'nullable|string|max:1000',
            'order_id' => 'nullable|exists:order,id_order',
            'media.*' => 'nullable|file|max:10240|mimes:jpeg,jpg,png,gif,webp,mp4,avi,mov,wmv,webm',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $productId = $request->input($productIdField);

        // Nếu có order_id, kiểm tra quyền đánh giá
        if ($request->order_id) {
            $order = \App\Models\Order::where('id_order', $request->order_id)
                ->where('id_user', $id_user)
                ->where('status', 'completed')
                ->first();

            if (!$order) {
                return response()->json(['error' => 'Bạn chỉ có thể đánh giá sản phẩm đã mua!'], 403);
            }

            // Kiểm tra xem đã đánh giá chưa
            $existingReview = Review::where('id_product', $productId)
                ->where('id_user', $id_user)
                ->first();

            if ($existingReview) {
                return response()->json(['error' => 'Bạn đã đánh giá sản phẩm này rồi!'], 400);
            }
        }

        try {
            $mediaArr = [];

            // Xử lý file media (từ product detail page)
            if ($request->hasFile('media') && !$request->order_id) {
                // Kiểm tra số lượng file (tối đa 5)
                if (count($request->file('media')) > 5) {
                    return response()->json(['error' => 'Bạn chỉ có thể tải lên tối đa 5 file.'], 400);
                }

                foreach ($request->file('media') as $file) {
                    // Kiểm tra kích thước file (10MB)
                    if ($file->getSize() > 10 * 1024 * 1024) {
                        return response()->json(['error' => 'File "' . $file->getClientOriginalName() . '" vượt quá 10MB.'], 400);
                    }

                    $path = $file->store('review_media', 'public');
                    $mediaArr[] = [
                        'url' => asset('storage/' . $path),
                        'type' => $file->getMimeType(),
                        'name' => $file->getClientOriginalName(),
                    ];
                }
            }

            // Xử lý file images (từ order review modal)
            if ($request->hasFile('images') && $request->order_id) {
                $imageFiles = $request->file('images');
                \Log::info('Number of images received: ' . count($imageFiles));

                // Kiểm tra số lượng file (tối đa 5)
                if (count($imageFiles) > 5) {
                    return response()->json(['error' => 'Bạn chỉ có thể tải lên tối đa 5 ảnh.'], 400);
                }

                foreach ($imageFiles as $index => $image) {
                    \Log::info('Processing image ' . ($index + 1) . ': ' . $image->getClientOriginalName());

                    // Kiểm tra kích thước file (2MB cho ảnh)
                    if ($image->getSize() > 2 * 1024 * 1024) {
                        return response()->json(['error' => 'Ảnh "' . $image->getClientOriginalName() . '" vượt quá 2MB.'], 400);
                    }

                    // Tạo tên file unique để tránh trùng lặp
                    $imageName = time() . '_' . $index . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/reviews'), $imageName);
                    $mediaArr[] = [
                        'type' => 'image/' . $image->getClientOriginalExtension(),
                        'url' => 'uploads/reviews/' . $imageName,
                        'name' => $image->getClientOriginalName()
                    ];
                    \Log::info('Saved image as: ' . $imageName);
                }
            }

            $review = Review::create([
                'id_product' => $productId,
                'id_user' => $id_user,
                'rating' => $request->rating,
                'content' => $request->content,
                'images' => $mediaArr ? json_encode($mediaArr) : null,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Đánh giá đã được gửi thành công!',
                'review' => $review
            ], 201);

        } catch (\Exception $e) {
            \Log::error('Review store error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Đã xảy ra lỗi khi gửi đánh giá. Vui lòng thử lại!'
            ], 500);
        }
    }

    // Thêm bình luận trả lời cho đánh giá
    public function comment(Request $request)
    {
        // Log all request data for debugging
        Log::info('Comment request received:', [
            'all_data' => $request->all(),
            'session_id_user' => session('id_user'),
            'headers' => $request->headers->all()
        ]);

        $id_user = session('id_user');
        if (!$id_user) {
            Log::warning('User not logged in for comment');
            return response()->json(['error' => 'Bạn cần đăng nhập để trả lời!'], 401);
        }

        // Basic validation
        if (!$request->review_id) {
            Log::warning('Missing review_id in comment request');
            return response()->json(['error' => 'Review ID là bắt buộc!'], 400);
        }

        if (!$request->content || trim($request->content) === '') {
            Log::warning('Missing content in comment request');
            return response()->json(['error' => 'Nội dung bình luận là bắt buộc!'], 400);
        }

        // Kiểm tra review có tồn tại không
        $review = Review::find($request->review_id);
        if (!$review) {
            Log::warning('Review not found:', ['review_id' => $request->review_id]);
            return response()->json(['error' => 'Đánh giá không tồn tại!'], 404);
        }

        Log::info('Review found:', ['review_id' => $review->id, 'product_id' => $review->id_product]);

        try {
            $mediaArr = [];
            if ($request->hasFile('media')) {
                // Kiểm tra số lượng file (tối đa 5)
                if (count($request->file('media')) > 5) {
                    return response()->json(['error' => 'Bạn chỉ có thể tải lên tối đa 5 file.'], 400);
                }

                foreach ($request->file('media') as $file) {
                    // Kiểm tra kích thước file (10MB)
                    if ($file->getSize() > 10 * 1024 * 1024) {
                        return response()->json(['error' => 'File "' . $file->getClientOriginalName() . '" vượt quá 10MB.'], 400);
                    }

                    $path = $file->store('review_media', 'public');
                    $mediaArr[] = [
                        'url' => asset('storage/' . $path),
                        'type' => $file->getMimeType(),
                        'name' => $file->getClientOriginalName(),
                    ];
                }
            }

            $parentId = $request->parent_id;
            if ($parentId === '' || $parentId === null || $parentId === 'null') {
                $parentId = null;
            }

            // Log data before creating comment
            Log::info('Creating comment with data:', [
                'review_id' => $request->review_id,
                'id_user' => $id_user,
                'parent_id' => $parentId,
                'content' => $request->content,
                'media_count' => count($mediaArr)
            ]);

            $comment = ReviewComment::create([
                'review_id' => $request->review_id,
                'id_user' => $id_user,
                'parent_id' => $parentId,
                'content' => trim($request->content),
                'images' => $mediaArr ? json_encode($mediaArr) : null,
            ]);

            Log::info('Comment created successfully:', ['comment_id' => $comment->id]);

            return response()->json([
                'success' => true,
                'message' => 'Trả lời đã được gửi thành công!',
                'comment' => $comment
            ], 201);

        } catch (\Exception $e) {
            Log::error('Comment store error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json(['error' => 'Đã xảy ra lỗi khi gửi trả lời: ' . $e->getMessage()], 500);
        }
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