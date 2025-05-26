<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'General Discussion', 'description' => "Talk about things that don't quite fit into the other categories"],
            ['name' => 'Release Announcements', 'description' => "Announce and promote your own projects here"],
            ['name' => 'Recommend a Game', 'description' => "Share cool things you like that you've found on itch.io"],
            ['name' => 'Game Jams', 'description' => "Share, organize, and discuss game jams on itch.io"],
        ]);
        
    }
}
