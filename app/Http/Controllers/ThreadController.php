<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function show($slug)
    {
        // Data dummy sementara
        $threads = [
            'favorite-game-engine' => [
                'title' => "What's your favorite game engine?",
                'content' => "Let's talk about game engines! Unity? Unreal? Godot? Share your thoughts!",
                'author' => 'chooon',
                'created_at' => now(),
            ],
            'first-game-dev-experience' => [
                'title' => "Share your first game dev experience",
                'content' => "Tell us how you started with game development.",
                'author' => 'devkid',
                'created_at' => now()->subDays(1),
            ],
            'unity-vs-unreal' => [
                'title' => "Unity vs Unreal: Discussion",
                'content' => "Which engine do you prefer and why?",
                'author' => 'gameguru',
                'created_at' => now()->subDays(2),
            ],
        ];

        if (!array_key_exists($slug, $threads)) {
            abort(404);
        }

        $thread = (object) $threads[$slug]; // Convert array to object for Blade compatibility
        return view('thread.show', compact('thread'));
    }
}
