<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->insert([
            [
                'title' => 'Khuyến mãi mùa hè',
                'content' => 'Giảm giá lên đến 40% cho bộ sưu tập mùa hè!',
                'image' => 'muahe.jpg',
                'status' => true,
            ],
            [
                'title' => 'Hàng mới về',
                'content' => 'Khám phá xu hướng mới nhất tại cửa hàng.',
                'image' => 'nam.jpg',
                'status' => true,
            ],
            [
                'title' => 'Ưu đãi chớp nhoáng',
                'content' => 'Ưu đãi giới hạn thời gian cho các sản phẩm chọn lọc.',
                'image' => 'uudai.jpg',
                'status' => true,
            ],
            [
                'title' => 'Đặc quyền thành viên',
                'content' => 'Giảm giá đặc biệt dành cho khách hàng thân thiết.',
                'image' => 'nu.jpg',
                'status' => true,
            ],
        ]);
    }
} 