<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'user_id' => 2,
                'fullname' => 'Trần Thị B',
                'email' => 'user@example.com',
                'phone_number' => '0987654321',
                'address' => 'TP.HCM',
                'note' => 'Giao trong giờ hành chính',
                'order_date' => now(),
                'status' => 0,
                'total_money' => 380000,
            ],
        ]);
    }
}
