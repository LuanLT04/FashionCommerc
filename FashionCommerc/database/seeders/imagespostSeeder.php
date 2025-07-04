<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class imagespostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images_posts')->insert([
            'file_name' => '1745336578_6807b90220183.jpg',
        ]);

         DB::table('images_posts')->insert([
            'file_name' => '1745336649_6807b94907e35.jpg',
        ]);

          DB::table('images_posts')->insert([
            'file_name' => '1745336955_6807ba7bad3f4.jpg',
        ]);

          DB::table('images_posts')->insert([
            'file_name' => '1747761152_682cb800d2603.jpg',
        ]);

          DB::table('images_posts')->insert([
            'file_name' => '1745337881_6807be19897a9.jpg',
        ]);

          DB::table('images_posts')->insert([
            'file_name' => '1747761141_682cb7f53ad95.jpg',
        ]);

          DB::table('images_posts')->insert([
            'file_name' => '1745336649_6807b94907e35.jpg',
        ]);

          DB::table('images_posts')->insert([
            'file_name' => '1747761176_682cb818e6ea8.png',
        ]);

          DB::table('images_posts')->insert([
            'file_name' => '1745337881_6807be198a417.jpg',
        ]);

          DB::table('images_posts')->insert([
            'file_name' => '1745336649_6807b94907e35.jpg',
        ]);

          DB::table('images_posts')->insert([
            'file_name' => '1747761176_682cb818e6ea8.png',
        ]);
    }
}
