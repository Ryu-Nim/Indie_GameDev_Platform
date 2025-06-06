<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function toggle(Request $request)
    {
        $bookmark = Bookmark::where('user_id', auth()->id())
            ->where('game_id', $request->game_id)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
            return response()->json(['message' => 'Bookmark dihapus']);
        } else {
            Bookmark::create([
                'user_id' => auth()->id(),
                'game_id' => $request->game_id
            ]);
            return response()->json(['message' => 'Bookmark ditambahkan']);
        }
    }

    public function index()
    {
        $bookmarks = Bookmark::where('user_id', auth()->id())
            ->with('game')
            ->get();

        return view('bookmarks.index', compact('bookmarks'));
    }
}
