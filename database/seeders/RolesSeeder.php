<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Thêm roles mặc định
        DB::table('roles')->insert([
            [
                'id' => 1,
                'role_name' => 'Admin',
                'deleted' => 0
            ],
            [
                'id' => 2,
                'role_name' => 'User',
                'deleted' => 0
            ],
            [
                'id' => 3,
                'role_name' => 'Customer',
                'deleted' => 0
            ]
        ]);
    }
}
