<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // User biasa
        User::create([
            'username' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('user123'), // Password terenkripsi
            'role' => User::ROLE_USER, // Role 1 = User
        ]);

        // Developer
        User::create([
            'username' => 'developer',
            'email' => 'developer@example.com',
            'password' => Hash::make('developer123'), // Password terenkripsi
            'role' => User::ROLE_DEVELOPER, // Role 2 = Developer
        ]);
    }
}