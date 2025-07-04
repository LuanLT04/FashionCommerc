<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('manufacturers')->insert([
            'name_manufacturer' => 'Chanel',
            'image_manufacturer' => '1746634690.jpg',
        ]);

        DB::table('manufacturers')->insert([
            'name_manufacturer' => 'Evisu',
            'image_manufacturer' => '1746634699.jpg',
        ]);
        
        DB::table('manufacturers')->insert([
            'name_manufacturer' => 'Gucci',
            'image_manufacturer' => '1746684014.jpg',
        ]);
    }
}
