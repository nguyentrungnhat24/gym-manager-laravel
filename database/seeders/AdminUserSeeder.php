<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Thêm admin user mặc định
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'password_hash' => Hash::make('admin123'),
                'full_name' => 'Administrator',
                'image_path' => 'uploaded/avatar.png',
                'address' => 'Hà Nội',
                'phone_number' => '0123456789',
                'email' => 'admin@gym.com',
                'role_id' => 1, // Admin role
                'deleted' => 0
            ]
        ]);
    }
}
