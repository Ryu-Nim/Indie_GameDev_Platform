<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Support\Facades\File;

class GamePlayController extends Controller
{
    public function show($slug)
    {
        $game = Game::where('slug', $slug)->firstOrFail();
        return view('game.play', compact('game'));
    }

    public function play($slug)
    {
        $game = Game::where('slug', $slug)->firstOrFail();
        $decodedSlug = urldecode($slug);
        $filePath = public_path("games/{$game->id}/{$decodedSlug}/index.html");

        if (File::exists($filePath)) {
            return response()->file($filePath);
        }

        abort(404, "Game tidak ditemukan!");
    }
}