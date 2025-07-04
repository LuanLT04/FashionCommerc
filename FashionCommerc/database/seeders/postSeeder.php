<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class postSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'title_post' => 'Áo choàng băng giá',
            'content_post' => 'đây là áo choàng',
        ]);
        DB::table('posts')->insert([
            'title_post' => 'Áo khoác lông cừu',
            'content_post' => 'Chiếc áo lông ấm áp',
        ]);
        DB::table('posts')->insert([
            'title_post' => 'Giày kiên cường',
            'content_post' => 'Giúp kháng hiệu ứng',
        ]);
        DB::table('posts')->insert([
            'title_post' => 'Áo khoác bomber mỹ',
            'content_post' => 'Kiểu dáng cực đẹp',
        ]);
        DB::table('posts')->insert([
            'title_post' => 'Quần dài ',
            'content_post' => 'đây là quần đến từ Thái Lan',
        ]);
        DB::table('posts')->insert([
            'title_post' => 'Chiếc áo giá rét',
            'content_post' => 'Chống lạnh siêu đỉnhđỉnh',
        ]);

    DB::table('posts')->insert([
            'title_post' => 'Chiếc áo sơ mi kẻ sọc',
            'content_post' => 'Chiếc áo mang lại cảm giác trẻ trung ',
        ]);
        DB::table('posts')->insert([
            'title_post' => 'Quần dành cho nam phố đi bụi',
            'content_post' => 'Toát lên vẻ bảnh bao ',
        ]);
    }
}
