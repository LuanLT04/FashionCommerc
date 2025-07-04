<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\DetailsOrder;
use App\Models\Product;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [
                'id_user' => 1,
                'total_order' => 1500000,
                'address' => '123 Nguyễn Huệ, Quận 1, TP.HCM',
                'created_at' => Carbon::now()->subDays(10),
                'details' => [
                    [
                        'id_product' => 1,
                        'quantity' => 2,
                        'product_name' => 'Áo thun nam',
                        'image' => 'aothun.jpg'
                    ],
                    [
                        'id_product' => 2,
                        'quantity' => 1,
                        'product_name' => 'Quần jean nam',
                        'image' => 'quanjean.jpg'
                    ]
                ]
            ],
            [
                'id_user' => 1,
                'total_order' => 2500000,
                'address' => '456 Lê Lợi, Quận 1, TP.HCM',
                'created_at' => Carbon::now()->subDays(8),
                'details' => [
                    [
                        'id_product' => 3,
                        'quantity' => 1,
                        'product_name' => 'Áo sơ mi nữ',
                        'image' => 'aosomi.jpg'
                    ],
                    [
                        'id_product' => 4,
                        'quantity' => 2,
                        'product_name' => 'Váy liền thân',
                        'image' => 'vay.jpg'
                    ]
                ]
            ],
            [
                'id_user' => 2,
                'total_order' => 1800000,
                'address' => '789 Đồng Khởi, Quận 1, TP.HCM',
                'created_at' => Carbon::now()->subDays(7),
                'details' => [
                    [
                        'id_product' => 5,
                        'quantity' => 1,
                        'product_name' => 'Áo khoác nam',
                        'image' => 'aokhoac.jpg'
                    ]
                ]
            ],
            [
                'id_user' => 2,
                'total_order' => 3200000,
                'address' => '321 Nguyễn Du, Quận 1, TP.HCM',
                'created_at' => Carbon::now()->subDays(6),
                'details' => [
                    [
                        'id_product' => 6,
                        'quantity' => 2,
                        'product_name' => 'Quần tây nam',
                        'image' => 'quantay.jpg'
                    ],
                    [
                        'id_product' => 7,
                        'quantity' => 1,
                        'product_name' => 'Giày da nam',
                        'image' => 'giay.jpg'
                    ]
                ]
            ],
            [
                'id_user' => 2,
                'total_order' => 2100000,
                'address' => '654 Lê Duẩn, Quận 1, TP.HCM',
                'created_at' => Carbon::now()->subDays(5),
                'details' => [
                    [
                        'id_product' => 8,
                        'quantity' => 1,
                        'product_name' => 'Áo len nữ',
                        'image' => 'aolen.jpg'
                    ],
                    [
                        'id_product' => 9,
                        'quantity' => 1,
                        'product_name' => 'Quần jean nữ',
                        'image' => 'quanjeannu.jpg'
                    ]
                ]
            ],
            [
                'id_user' => 4,
                'total_order' => 2800000,
                'address' => '987 Điện Biên Phủ, Quận 1, TP.HCM',
                'created_at' => Carbon::now()->subDays(4),
                'details' => [
                    [
                        'id_product' => 10,
                        'quantity' => 2,
                        'product_name' => 'Áo dạ nữ',
                        'image' => 'aoda.jpg'
                    ]
                ]
            ],
            [
                'id_user' => 4,
                'total_order' => 1900000,
                'address' => '147 Võ Văn Tần, Quận 3, TP.HCM',
                'created_at' => Carbon::now()->subDays(3),
                'details' => [
                    [
                        'id_product' => 11,
                        'quantity' => 1,
                        'product_name' => 'Áo thun nữ',
                        'image' => 'aothunnu.jpg'
                    ],
                    [
                        'id_product' => 12,
                        'quantity' => 1,
                        'product_name' => 'Quần short nữ',
                        'image' => 'quanshort.jpg'
                    ]
                ]
            ],
            [
                'id_user' => 4,
                'total_order' => 3500000,
                'address' => '258 Trần Hưng Đạo, Quận 1, TP.HCM',
                'created_at' => Carbon::now()->subDays(2),
                'details' => [
                    [
                        'id_product' => 13,
                        'quantity' => 1,
                        'product_name' => 'Áo vest nam',
                        'image' => 'aovest.jpg'
                    ],
                    [
                        'id_product' => 14,
                        'quantity' => 1,
                        'product_name' => 'Quần tây nữ',
                        'image' => 'quantaynu.jpg'
                    ]
                ]
            ],
            [
                'id_user' => 5,
                'total_order' => 2200000,
                'address' => '369 Lý Tự Trọng, Quận 1, TP.HCM',
                'created_at' => Carbon::now()->subDays(1),
                'details' => [
                    [
                        'id_product' => 15,
                        'quantity' => 2,
                        'product_name' => 'Áo sơ mi nam',
                        'image' => 'aosominam.jpg'
                    ]
                ]
            ],
            [
                'id_user' => 5,
                'total_order' => 2900000,
                'address' => '741 Nguyễn Trãi, Quận 1, TP.HCM',
                'created_at' => Carbon::now(),
                'details' => [
                    [
                        'id_product' => 16,
                        'quantity' => 1,
                        'product_name' => 'Áo khoác nữ',
                        'image' => 'aokhoacnu.jpg'
                    ],
                    [
                        'id_product' => 17,
                        'quantity' => 1,
                        'product_name' => 'Quần jean nam',
                        'image' => 'quanjean.jpg'
                    ]
                ]
            ],
        ];

        foreach ($orders as $orderData) {
            // Tạo đơn hàng
            $order = Order::create([
                'id_user' => $orderData['id_user'],
                'total_order' => $orderData['total_order'],
                'address' => $orderData['address'],
                'created_at' => $orderData['created_at']
            ]);

            // Tạo chi tiết đơn hàng
            foreach ($orderData['details'] as $detail) {
                DetailsOrder::create([
                    'id_order' => $order->id_order,
                    'id_product' => $detail['id_product'],
                    'quantity_detailsorder' => $detail['quantity'],
                    'product_name' => $detail['product_name'],
                    'image' => $detail['image']
                ]);
            }
        }
    }
} 