<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'category_id' => 1,
                'title' => 'Áo sơ mi nam',
                'price' => 300000,
                'quantity' => 10,
                'thumbnail' => 'uploads/aosomi.jpg',
                'description' => 'Áo sơ mi cotton thoáng mát.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'title' => 'Váy công sở nữ',
                'price' => 400000,
                'quantity' => 5,
                'thumbnail' => 'uploads/vaynu.jpg',
                'description' => 'Phong cách hiện đại, lịch sự.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
