<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class postimagesSeederr extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('postimages')->insert([
            'id_image_post' => '1',
            'id_post' => '1',
        ]);

         DB::table('postimages')->insert([
            'id_image_post' => '2',
            'id_post' => '2',
        ]);

         DB::table('postimages')->insert([
            'id_image_post' => '3',
            'id_post' => '3',
        ]);

         DB::table('postimages')->insert([
            'id_image_post' => '4',
            'id_post' => '4',
        ]);

         DB::table('postimages')->insert([
            'id_image_post' => '5',
            'id_post' => '5',
        ]);

         DB::table('postimages')->insert([
            'id_image_post' => '6',
            'id_post' => '6',
        ]);

         DB::table('postimages')->insert([
            'id_image_post' => '7',
            'id_post' => '7',
        ]);

         DB::table('postimages')->insert([
            'id_image_post' => '8',
            'id_post' => '8',
        ]);

         DB::table('postimages')->insert([
            'id_image_post' => '9',
            'id_post' => '9',
        ]);
    }
}
