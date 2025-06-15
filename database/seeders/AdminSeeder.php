<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'email' => 'superadmin@example.com',
            'username' => 'SuperAdmin',
            'password' => ('password123'),
            'role' => 1, // Super Admin
        ]);

        Admin::create([
            'email' => 'admin@example.com',
            'username' => 'AdminBiasa',
            'password' => ('password123'),
            'role' => 2, // Admin Biasa
        ]);
    }
}