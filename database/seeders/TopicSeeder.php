<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Topic::insert([
            ['category_id' => 1, 'user_id' => 1, 'title' => 'First topic on general', 'last_post_at' => now()],
            ['category_id' => 2, 'user_id' => 1, 'title' => 'New game launch today!', 'last_post_at' => now()],
        ]);
        
    }
}
