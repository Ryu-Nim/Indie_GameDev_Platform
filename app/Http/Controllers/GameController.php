<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\Game;
use App\Models\GameScreenshot;
use ZipArchive;

class GameController extends Controller
{
    /**
     * Handle game upload request
     */
    public function uploadGame(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'sinopsis' => 'nullable|string|max:80',
            'pv_video_link' => 'nullable|url',
            'category_game' => 'required|string|max:25',
            'type_game' => 'required|string|max:20|in:downloadable,html',
            'release_status' => 'nullable|integer|in:1,2',
            'genre' => 'required|string|max:50',
            'price_type' => 'required|integer|in:1,2',
            'price' => 'nullable|numeric',
            'game_file' => 'required|file|mimes:zip|max:51200',
            'description' => 'nullable|string|max:10000',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'screenshots.*' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        try {
            $filePath = $this->storeGameFile($request);
            $coverPath = $request->hasFile('cover') ? $request->file('cover')->store('covers', 'public') : null;
            $finalExtractPath = $this->extractGameZip($request, $filePath);

            $game = Game::create([
                'title' => $validated['title'],
                'sinopsis' => $validated['sinopsis'] ?? null,
                'pv_video_link' => $validated['pv_video_link'] ?? null,
                'category_game' => $validated['category_game'],
                'type_game' => $validated['type_game'],
                'release_status' => $validated['release_status'] ?? 1,
                'genre' => $validated['genre'],
                'price_type' => (int) $validated['price_type'],
                'price' => $validated['price_type'] == 2 ? $validated['price'] : 0,
                'game_download' => $validated['type_game'] === 'downloadable' ? $filePath : null,
                'web_game_file' => $validated['type_game'] === 'html' ? $finalExtractPath : null,
                'cover_image' => $coverPath,
                'description' => $validated['description'] ?? null,
                'status' => 'ditinjau',
                'user_id' => Auth::id(),
            ]);

            if ($request->hasFile('screenshots')) {
                foreach ($request->file('screenshots') as $file) {
                    $path = $file->store('screenshots', 'public');
                    $game->screenshots()->create(['screenshot_path' => $path]);
                }
            }
            return response()->json(['message' => 'Game berhasil diunggah!']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Upload gagal: ' . $e->getMessage()]);
        }
    }

    /**
     * Store uploaded game file and return its path
     */
    private function storeGameFile(Request $request)
    {
        $fileName = pathinfo($request->file('game_file')->getClientOriginalName(), PATHINFO_FILENAME);
        $cleanFileName = preg_replace('/[^a-zA-Z0-9_-]/', '', $fileName);
        return $request->file('game_file')->storeAs('games', $cleanFileName . '.zip');
    }

    /**
     * Extract uploaded zip and return the extracted path
     */
    private function extractGameZip(Request $request, $filePath)
    {
        $gameNumber = Game::count() + 1;
        do {
            $gameId = str_pad($gameNumber, 3, '0', STR_PAD_LEFT);
            $gameFolder = 'games/Game-ID-' . $gameId;
            $extractBasePath = public_path($gameFolder);
            $gameNumber++;
        } while (File::exists($extractBasePath));

        if (!File::exists($extractBasePath) && !File::makeDirectory($extractBasePath, 0755, true)) {
            throw new \Exception('Gagal membuat folder ekstraksi.');
        }

        $zip = new ZipArchive;
        $zipPath = storage_path('app/' . $filePath);
        if ($zip->open($zipPath) !== true) {
            throw new \Exception('File ZIP tidak bisa dibuka.');
        }
        if (!$zip->extractTo($extractBasePath)) {
            $zip->close();
            throw new \Exception('Ekstraksi gagal.');
        }
        $zip->close();

        $folders = array_diff(scandir($extractBasePath), array('..', '.'));
        if (count($folders) > 0) {
            $originalFolder = reset($folders);
            $sanitizedFolder = str_replace(' ', '-', $originalFolder);
            if ($originalFolder !== $sanitizedFolder) {
                rename($extractBasePath . '/' . $originalFolder, $extractBasePath . '/' . $sanitizedFolder);
            }
            $finalExtractPath = $gameFolder . '/' . $sanitizedFolder;
        } else {
            $finalExtractPath = $gameFolder;
        }

        if ($request->type_game === 'html' && Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
        return $finalExtractPath;
    }

    /**
     * Download game file
     */
    public function downloadGame($id)
    {
        $game = Game::findOrFail($id);
        if ($game->game_download && Storage::exists($game->game_download)) {
            return Storage::download($game->game_download);
        }
        return back()->withErrors(['error' => 'Game tidak tersedia untuk diunduh.']);
    }

    /**
     * Show home page with games
     */
    public function showHome()
    {
        $games = Game::where('status', 'aktif')->latest()->get();
        return view('home', compact('games'));
    }

    /**
     * Show game detail by title
     */
    public function showGameDetail($title)
    {
        $game = Game::with('screenshots', 'user')->get()->first(function ($g) use ($title) {
            return \Illuminate\Support\Str::slug($g->title) === $title;
        });
        if (!$game) {
            abort(404);
        }
        // Cek status game
        if ($game->status !== 'aktif') {
            $isAdmin = \Auth::guard('admin')->check();
            $isDeveloper = \Auth::check() && \Auth::user()->role == 2;
            if (!$isAdmin && !$isDeveloper) {
                abort(403, 'Game belum aktif. Hanya admin atau developer yang bisa mengakses.');
            }
        }
        return view('game-detail', compact('game'));
    }

    /**
     * Live search for games by title
     */
    public function liveSearch(Request $request)
    {
        $query = $request->query('q');
        $games = Game::select('id', 'title', 'cover_image', 'category_game')
            ->where('title', 'like', '%' . $query . '%')
            ->get();
        return response()->json($games);
    }
}