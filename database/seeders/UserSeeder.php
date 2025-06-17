<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'fullname' => 'Nguyễn Văn A',
                'email' => 'ductanlang200@gmail.com',
                'phone_number' => '0123456789',
                'address' => 'Hà Nội',
                'password' => Hash::make('12345678g'),
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fullname' => 'Trần Thị B',
                'email' => 'user@example.com',
                'phone_number' => '0987654321',
                'address' => 'TP.HCM',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
