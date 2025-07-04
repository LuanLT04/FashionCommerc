<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'luong',
            'email' => 'luong@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '0123456789',
            'address' => 'Đ.Võ Văn Ngân, Phường Linh Chiểu, Quận Thủ Đức, Thành phố Hồ Chí Minh',
            'role' => 0 // hoặc 1, tuỳ ý bạn
        ]);

        DB::table('users')->insert([
            'name' => 'thanh',
            'email' => 'thanh@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '0123456789',
            'address' => 'Đ.Võ Văn Ngân, Phường Linh Chiểu, Quận Thủ Đức, Thành phố Hồ Chí Minh',
            'role' => 0 // hoặc 1, tuỳ ý bạn
        ]);
        
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'phone' => '1278912321',
            'address' => 'Thành phố Hồ Chí Minh',
            'role' => 1 // hoặc 1, tuỳ ý bạn
        ]);

        DB::table('users')->insert([
            'name' => 'Luan',
            'email' => 'luanluong@gmail.com',
            'password' => Hash::make('111111'),
            'phone' => '0909090909',
            'address' => 'Đ.Võ Văn Ngân, Phường Linh Chiểu, Quận Thủ Đức, Thành phố Hồ Chí Minh',
            'role' => 0 // hoặc 1, tuỳ ý bạn
        ]);
    }
}
