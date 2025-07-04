<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'id_category' => '1',
            'id_manufacturer' => '1',
            'name_product' => 'Áo dài cách tân',
            'quantity_product' => '960',
            'price_product' => '3090000',
            'image_address_product' => 'aodaicachtan.jpg',
            'describe_product' => 'Áo dài cách tân Bạch Vũ 2025, áo dài 4 tà dáng xuông chất liệu toan tơ thêu họa tiết hoa phối quần phi',
            'specifications' => 'Việt Nam.;Dài áo 120cm lớp lót 1m25cm, quần 100cm;Áo hồng, quần hồng nhạt;XS-S-M-L-XL-XXL;Áo dài cách tân;Áo dài thiết kế;Lớp ngoài+lót lụa habutai, quần chất liệu lụa;',
            'sizes' => 'XS,S,M,L,XL,XXL', // Thêm kích thước
            'colors' => 'Hồng,Đỏ,Xanh,Vàng,Trắng,Đen', // Thêm màu sắc
        ]);

        DB::table('products')->insert([
            'id_category' => '2',
            'id_manufacturer' => '2',
            'name_product' => 'Áo dài cách tân cao cấp',
            'quantity_product' => '500',
            'price_product' => '4090000',
            'image_address_product' => 'aodaicachtancaocap.jpg',
            'describe_product' => 'Áo dài cách tân cao cấp với chất liệu lụa mềm mại, thiết kế tinh tế phù hợp cho các dịp lễ hội',
            'specifications' => 'Việt Nam.;Dài áo 130cm lớp lót 1m30cm, quần 110cm;Áo xanh, quần trắng;S-M-L-XL;Áo dài cách tân;Áo dài thiết kế;Lụa cao cấp;',
            'sizes' => 'S,M,L,XL', // Thêm kích thước
            'colors' => 'Xanh,Trắng,Đen', // Thêm màu sắc
        ]);

        DB::table('products')->insert([
            'id_category' => '3',
            'id_manufacturer' => '3',
            'name_product' => 'Áo dài thiết kế đặc biệt',
            'quantity_product' => '300',
            'price_product' => '5090000',
            'image_address_product' => 'aodaithietkedatbiet.jpg',
            'describe_product' => 'Áo dài thiết kế đặc biệt với họa tiết thêu tay, chất liệu cao cấp, phù hợp cho các sự kiện quan trọng',
            'specifications' => 'Việt Nam.;Dài áo 140cm lớp lót 1m40cm, quần 120cm;Áo đỏ, quần đen;M-L-XL-XXL;Áo dài thiết kế;Áo dài cao cấp;Lụa thêu tay;',
            'sizes' => 'M,L,XL,XXL', // Thêm kích thước
            'colors' => 'Đỏ,Đen,Vàng', // Thêm màu sắc
        ]);

        DB::table('products')->insert([
            'id_category' => '1',
            'id_manufacturer' => '2',
            'name_product' => 'Áo thun cotton nam',
            'quantity_product' => '1200',
            'price_product' => '199000',
            'image_address_product' => 'aothun1.jpg',
            'describe_product' => 'Áo thun cotton nam co giãn 4 chiều, thấm hút mồ hôi tốt, phù hợp mặc hàng ngày.',
            'specifications' => 'Việt Nam.;Dài áo 70cm;Trắng, Đen, Xám;S-M-L-XL;Áo thun;Cotton 100%;',
            'sizes' => 'S,M,L,XL',
            'colors' => 'Trắng,Đen,Xám',
        ]);
        
        DB::table('products')->insert([
            'id_category' => '2',
            'id_manufacturer' => '1',
            'name_product' => 'Đầm nữ dáng xòe',
            'quantity_product' => '800',
            'price_product' => '459000',
            'image_address_product' => 'dam1.jpg',
            'describe_product' => 'Đầm nữ dáng xòe chất liệu voan cao cấp, thiết kế trẻ trung, phù hợp đi tiệc.',
            'specifications' => 'Việt Nam.;Dài váy 95cm;Hồng, Xanh, Đen;S-M-L;Đầm nữ;Voan cao cấp;',
            'sizes' => 'S,M,L',
            'colors' => 'Hồng,Xanh,Đen',
        ]);
        
        DB::table('products')->insert([
            'id_category' => '3',
            'id_manufacturer' => '2',
            'name_product' => 'Quần dài kaki nam',
            'quantity_product' => '950',
            'price_product' => '299000',
            'image_address_product' => 'quandai1.jpg',
            'describe_product' => 'Quần dài kaki nam form slimfit, chất liệu dày dặn, bền màu.',
            'specifications' => 'Việt Nam.;Dài quần 100cm;Đen, Xám, Nâu;M-L-XL-XXL;Quần dài;Kaki;',
            'sizes' => 'M,L,XL,XXL',
            'colors' => 'Đen,Xám,Nâu',
        ]);
        
        DB::table('products')->insert([
            'id_category' => '4',
            'id_manufacturer' => '3',
            'name_product' => 'Quần short jean nữ',
            'quantity_product' => '700',
            'price_product' => '259000',
            'image_address_product' => 'short1.jpg',
            'describe_product' => 'Quần short jean nữ năng động, phối tua rua cá tính, phù hợp đi chơi.',
            'specifications' => 'Việt Nam.;Dài quần 35cm;Xanh nhạt, Xanh đậm;S-M-L;Quần short;Jean;',
            'sizes' => 'S,M,L',
            'colors' => 'Xanh nhạt,Xanh đậm',
        ]);
        
        DB::table('products')->insert([
            'id_category' => '5',
            'id_manufacturer' => '1',
            'name_product' => 'Áo chống nắng nữ UV',
            'quantity_product' => '1100',
            'price_product' => '189000',
            'image_address_product' => 'chongnang1.jpg',
            'describe_product' => 'Áo chống nắng nữ chất liệu thun lạnh, chống tia UV, nhẹ và thoáng mát.',
            'specifications' => 'Việt Nam.;Dài áo 65cm;Hồng, Xanh, Trắng, Đen;M-L-XL;Áo chống nắng;Thun lạnh;',
            'sizes' => 'M,L,XL',
            'colors' => 'Hồng,Xanh,Trắng,Đen',
        ]);
        
        DB::table('products')->insert([
            'id_category' => '1',
            'id_manufacturer' => '2',
            'name_product' => 'Áo thun nữ cổ tròn',
            'quantity_product' => '1300',
            'price_product' => '179000',
            'image_address_product' => 'aothun2.jpg',
            'describe_product' => 'Áo thun nữ cổ tròn, chất liệu cotton mềm mại, nhiều màu sắc trẻ trung.',
            'specifications' => 'Việt Nam.;Dài áo 68cm;Trắng, Hồng, Vàng;S-M-L-XL;Áo thun;Cotton;',
            'sizes' => 'S,M,L,XL',
            'colors' => 'Trắng,Hồng,Vàng',
        ]);
        
        DB::table('products')->insert([
            'id_category' => '2',
            'id_manufacturer' => '3',
            'name_product' => 'Đầm maxi đi biển',
            'quantity_product' => '600',
            'price_product' => '399000',
            'image_address_product' => 'dam2.jpg',
            'describe_product' => 'Đầm maxi đi biển họa tiết hoa, chất liệu voan mỏng nhẹ, thoáng mát.',
            'specifications' => 'Việt Nam.;Dài váy 120cm;Xanh, Vàng, Trắng;M-L-XL;Đầm maxi;Voan;',
            'sizes' => 'M,L,XL',
            'colors' => 'Xanh,Vàng,Trắng',
        ]);
        
        DB::table('products')->insert([
            'id_category' => '3',
            'id_manufacturer' => '1',
            'name_product' => 'Quần dài nữ công sở',
            'quantity_product' => '850',
            'price_product' => '349000',
            'image_address_product' => 'quandai2.jpg',
            'describe_product' => 'Quần dài nữ công sở chất liệu tuyết mưa, form đứng, dễ phối đồ.',
            'specifications' => 'Việt Nam.;Dài quần 98cm;Đen, Be, Xám;S-M-L-XL;Quần dài;Tuyết mưa;',
            'sizes' => 'S,M,L,XL',
            'colors' => 'Đen,Be,Xám',
        ]);
        
        DB::table('products')->insert([
            'id_category' => '4',
            'id_manufacturer' => '2',
            'name_product' => 'Quần short thể thao nam',
            'quantity_product' => '900',
            'price_product' => '159000',
            'image_address_product' => 'short2.jpg',
            'describe_product' => 'Quần short thể thao nam, chất liệu thun lạnh, co giãn tốt, thoải mái vận động.',
            'specifications' => 'Việt Nam.;Dài quần 40cm;Đen, Xám, Xanh;M-L-XL;Quần short;Thun lạnh;',
            'sizes' => 'M,L,XL',
            'colors' => 'Đen,Xám,Xanh',
        ]);
        
        DB::table('products')->insert([
            'id_category' => '5',
            'id_manufacturer' => '3',
            'name_product' => 'Áo chống nắng nam UV',
            'quantity_product' => '1000',
            'price_product' => '199000',
            'image_address_product' => 'chongnang2.jpg',
            'describe_product' => 'Áo chống nắng nam chất liệu thun lạnh, chống tia UV, thiết kế thể thao.',
            'specifications' => 'Việt Nam.;Dài áo 70cm;Xanh, Đen, Xám;M-L-XL;Áo chống nắng;Thun lạnh;',
            'sizes' => 'M,L,XL',
            'colors' => 'Xanh,Đen,Xám',
        ]);

        // Sản phẩm mới 1 - Áo hoodie nam thời trang
        DB::table('products')->insert([
            'id_category' => '1',
            'id_manufacturer' => '1',
            'name_product' => 'Áo hoodie nam thời trang',
            'quantity_product' => '900',
            'price_product' => '329000',
            'image_address_product' => 'product_new1.jpg',
            'describe_product' => 'Áo hoodie nam chất nỉ bông, form rộng, phong cách trẻ trung, cá tính.',
            'specifications' => 'Việt Nam.;Dài áo 72cm;Đen, Xám, Xanh navy;M-L-XL;Áo hoodie;Nỉ bông;',
            'sizes' => 'M,L,XL',
            'colors' => 'Đen,Xám,Xanh navy',
        ]);
        // Sản phẩm mới 2 - Váy dạ hội nữ sang trọng
        DB::table('products')->insert([
            'id_category' => '2',
            'id_manufacturer' => '2',
            'name_product' => 'Váy dạ hội nữ sang trọng',
            'quantity_product' => '300',
            'price_product' => '1299000',
            'image_address_product' => 'product_new2.jpg',
            'describe_product' => 'Váy dạ hội nữ chất liệu voan phối ren, dáng dài, phù hợp dự tiệc.',
            'specifications' => 'Việt Nam.;Dài váy 135cm;Đỏ, Xanh, Đen;S-M-L;Váy dạ hội;Voan, Ren;',
            'sizes' => 'S,M,L',
            'colors' => 'Đỏ,Xanh,Đen',
        ]);
        // Sản phẩm mới 3 - Quần jogger nam thể thao
        DB::table('products')->insert([
            'id_category' => '3',
            'id_manufacturer' => '3',
            'name_product' => 'Quần jogger nam thể thao',
            'quantity_product' => '1000',
            'price_product' => '249000',
            'image_address_product' => 'product_new3.jpg',
            'describe_product' => 'Quần jogger nam chất liệu thun lạnh, bo gấu, thích hợp tập gym, đi chơi.',
            'specifications' => 'Việt Nam.;Dài quần 98cm;Đen, Xám, Xanh rêu;M-L-XL;Quần jogger;Thun lạnh;',
            'sizes' => 'M,L,XL',
            'colors' => 'Đen,Xám,Xanh rêu',
        ]);
        // Sản phẩm mới 4 - Áo len nữ cổ lọ
        DB::table('products')->insert([
            'id_category' => '1',
            'id_manufacturer' => '2',
            'name_product' => 'Áo len nữ cổ lọ',
            'quantity_product' => '700',
            'price_product' => '279000',
            'image_address_product' => 'product_new4.jpg',
            'describe_product' => 'Áo len nữ cổ lọ chất liệu len tăm, giữ ấm tốt, nhiều màu pastel.',
            'specifications' => 'Việt Nam.;Dài áo 60cm;Hồng, Be, Xám, Trắng;S-M-L;Áo len;Len tăm;',
            'sizes' => 'S,M,L',
            'colors' => 'Hồng,Be,Xám,Trắng',
        ]);
        // Sản phẩm mới 5 - Chân váy jean nữ chữ A
        DB::table('products')->insert([
            'id_category' => '2',
            'id_manufacturer' => '1',
            'name_product' => 'Chân váy jean nữ chữ A',
            'quantity_product' => '800',
            'price_product' => '219000',
            'image_address_product' => 'product_new5.jpg',
            'describe_product' => 'Chân váy jean nữ dáng chữ A, trẻ trung, năng động, dễ phối đồ.',
            'specifications' => 'Việt Nam.;Dài váy 45cm;Xanh nhạt, Xanh đậm;S-M-L;Chân váy;Jean;',
            'sizes' => 'S,M,L',
            'colors' => 'Xanh nhạt,Xanh đậm',
        ]);
        // Sản phẩm mới 6 - Áo vest nam công sở
        DB::table('products')->insert([
            'id_category' => '1',
            'id_manufacturer' => '3',
            'name_product' => 'Áo vest nam công sở',
            'quantity_product' => '400',
            'price_product' => '799000',
            'image_address_product' => 'product_new6.jpg',
            'describe_product' => 'Áo vest nam form slimfit, chất liệu tuyết mưa cao cấp, lịch lãm.',
            'specifications' => 'Việt Nam.;Dài áo 75cm;Đen, Xám, Xanh navy;M-L-XL;Áo vest;Tuyết mưa;',
            'sizes' => 'M,L,XL',
            'colors' => 'Đen,Xám,Xanh navy',
        ]);
        // Sản phẩm mới 7 - Đầm babydoll nữ dễ thương
        DB::table('products')->insert([
            'id_category' => '2',
            'id_manufacturer' => '2',
            'name_product' => 'Đầm babydoll nữ dễ thương',
            'quantity_product' => '600',
            'price_product' => '259000',
            'image_address_product' => 'product_new7.jpg',
            'describe_product' => 'Đầm babydoll nữ dáng suông, chất liệu cotton, họa tiết hoa nhí.',
            'specifications' => 'Việt Nam.;Dài váy 90cm;Hồng, Vàng, Xanh;S-M-L;Đầm babydoll;Cotton;',
            'sizes' => 'S,M,L',
            'colors' => 'Hồng,Vàng,Xanh',
        ]);
        // Sản phẩm mới 8 - Quần baggy nữ công sở
        DB::table('products')->insert([
            'id_category' => '3',
            'id_manufacturer' => '1',
            'name_product' => ' ',
            'quantity_product' => '900',
            'price_product' => '299000',
            'image_address_product' => 'product_new8.jpg',
            'describe_product' => 'Quần baggy nữ chất liệu tuyết mưa, form rộng, thoải mái, dễ phối áo sơ mi.',
            'specifications' => 'Việt Nam.;Dài quần 92cm;Đen, Be, Xám;S-M-L-XL;Quần baggy;Tuyết mưa;',
            'sizes' => 'S,M,L,XL',
            'colors' => 'Đen,Be,Xám',
        ]);
        // Sản phẩm mới 9 - Áo khoác cardigan nữ dáng dài
        DB::table('products')->insert([
            'id_category' => '1',
            'id_manufacturer' => '2',
            'name_product' => 'Áo khoác cardigan nữ dáng dài',
            'quantity_product' => '500',
            'price_product' => '349000',
            'image_address_product' => 'product_new9.jpg',
            'describe_product' => 'Áo khoác cardigan nữ dáng dài, chất len mềm, phối cùng váy hoặc quần.',
            'specifications' => 'Việt Nam.;Dài áo 90cm;Be, Xám, Hồng;S-M-L;Cardigan;Len mềm;',
            'sizes' => 'S,M,L',
            'colors' => 'Be,Xám,Hồng',
        ]);
        // Sản phẩm mới 10 - Quần short kaki nam năng động
        DB::table('products')->insert([
            'id_category' => '4',
            'id_manufacturer' => '3',
            'name_product' => 'Quần short kaki nam năng động',
            'quantity_product' => '1100',
            'price_product' => '179000',
            'image_address_product' => 'product_new10.jpg',
            'describe_product' => 'Quần short kaki nam, chất liệu kaki dày dặn, form trẻ trung, thoải mái.',
            'specifications' => 'Việt Nam.;Dài quần 48cm;Đen, Xám, Xanh rêu;M-L-XL;Quần short;Kaki;',
            'sizes' => 'M,L,XL',
            'colors' => 'Đen,Xám,Xanh rêu',
        ]);
    }
}