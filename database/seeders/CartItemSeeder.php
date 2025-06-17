<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartItemSeeder extends Seeder
{
    public function run(): void
    {
        // Giả sử cart_id 1 có 2 sản phẩm trong giỏ hàng
        DB::table('cart_items')->insert([
            [
                'cart_id' => 1,
                'product_id' => 1,
                'quantity' => 2,
                'price' => 300000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cart_id' => 1,
                'product_id' => 2,
                'quantity' => 1,
                'price' => 400000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
