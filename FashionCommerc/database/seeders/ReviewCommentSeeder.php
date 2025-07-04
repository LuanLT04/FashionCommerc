<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewCommentSeeder extends Seeder
{
    public function run()
    {
        // Seed 3 review mẫu
        $reviewId1 = DB::table('reviews')->insertGetId([
            'id_product' => 1,
            'id_user' => 1,
            'rating' => 5,
            'content' => 'Sản phẩm rất tốt, chất lượng vượt mong đợi!',
            'images' => json_encode([]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $reviewId2 = DB::table('reviews')->insertGetId([
            'id_product' => 2,
            'id_user' => 2,
            'rating' => 4,
            'content' => 'Sản phẩm ổn, giao hàng nhanh.',
            'images' => json_encode([]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $reviewId3 = DB::table('reviews')->insertGetId([
            'id_product' => 3,
            'id_user' => 2,
            'rating' => 5,
            'content' => 'Rất hài lòng với dịch vụ của shop.',
            'images' => json_encode([]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // 3 bình luận mẫu, mỗi review 1 bình luận
        DB::table('review_comments')->insert([
            [
                'review_id' => $reviewId1,
                'id_user' => 1,
                'parent_id' => null,
                'content' => 'Cảm ơn shop, sản phẩm rất đẹp!',
                'images' => json_encode([]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'review_id' => $reviewId2,
                'id_user' => 2,
                'parent_id' => null,
                'content' => 'Mình cũng vừa nhận hàng, rất hài lòng.',
                'images' => json_encode([]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'review_id' => $reviewId3,
                'id_user' => 3,
                'parent_id' => null,
                'content' => 'Đóng gói cẩn thận, giao hàng nhanh.',
                'images' => json_encode([]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 