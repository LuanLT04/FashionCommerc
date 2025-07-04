<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name_category' => 'Áo thun',
            'image_category' => 'aothun1.jpg',
        ]);

        DB::table('categories')->insert([
            'name_category' => 'Đầm nữ',
            'image_category' => 'dam1.jpg',
        ]);

        DB::table('categories')->insert([
            'name_category' => 'Quần dài',
            'image_category' => 'quandai1.jpg',
        ]);

        DB::table('categories')->insert([
            'name_category' => 'Quần short',
            'image_category' => 'short1.jpg',
        ]);

        DB::table('categories')->insert([
            'name_category' => 'Áo chống nắng',
            'image_category' => 'chongnang1.jpg',
        ]);
        
        DB::table('categories')->insert([
            'name_category' => 'Áo dài tay',
            'image_category' => 'aodaitay.jpg',
        ]);
        
        DB::table('categories')->insert([
            'name_category' => 'Váy dài',
            'image_category' => 'vaydai.jpg',
        ]);
    }
}
