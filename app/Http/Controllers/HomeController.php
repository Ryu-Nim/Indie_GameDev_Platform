<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
    $games = [
        [
            'name' => 'Broken Relic',
            'genre' => 'Adventure',
            'image' => 'https://via.placeholder.com/100?text=Game+1',
        ],
        [
            'name' => 'Cave of Cards',
            'genre' => 'Puzzle',
            'image' => 'https://via.placeholder.com/100?text=Game+2',
        ],
        [
            'name' => 'Stealth Crossword',
            'genre' => 'Word Game',
            'image' => 'https://via.placeholder.com/100?text=Game+3',
        ],
    ];

    return view('home', compact('games'));
}

}
