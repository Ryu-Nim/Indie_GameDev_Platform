<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function index() {
        $categories = Category::withCount('topics')
                        ->with(['topics' => function($query) {
                            $query->latest('last_post_at')->take(1)->with('user');
                        }])
                        ->get();
        
        return view('community.index', compact('categories'));
    }
    
}
