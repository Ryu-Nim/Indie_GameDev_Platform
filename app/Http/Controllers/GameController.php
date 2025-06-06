<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use ZipArchive;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use App\Models\GameScreenshot; // Tambahkan model screenshots


class GameController extends Controller
{
    public function uploadGame(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'tagline' => 'nullable|string|max:100',
            'trailer' => 'nullable|url',
            'category' => 'required|string',
            'type' => 'required|string|in:downloadable,html',
            'status' => 'required|string|in:released,in_development',
            'price_type' => 'required|integer|in:1,2',
            'price' => 'nullable|numeric',
            'game_file' => 'required|file|mimes:zip|max:51200',
            'description' => 'nullable|string|max:10000',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'screenshots.*' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);


        // Bersihkan nama file agar aman
        $fileName = pathinfo($request->file('game_file')->getClientOriginalName(), PATHINFO_FILENAME);
        $cleanFileName = preg_replace('/[^a-zA-Z0-9_-]/', '', $fileName);
        $filePath = $request->file('game_file')->storeAs('games', $cleanFileName . '.zip');

        // Simpan Cover Image jika ada
        $coverPath = $request->hasFile('cover') ? $request->file('cover')->store('covers', 'public') : null;

        // Generate Game-ID unik
        $gameNumber = Game::count() + 1;
        do {
            $gameId = str_pad($gameNumber, 3, '0', STR_PAD_LEFT);
            $gameFolder = 'games/Game-ID-' . $gameId;
            $extractBasePath = public_path($gameFolder);
            $gameNumber++;
        } while (File::exists($extractBasePath));

        // Buat folder ekstraksi jika belum ada
        if (!File::exists($extractBasePath) && !File::makeDirectory($extractBasePath, 0755, true)) {
            return back()->withErrors(['error' => 'Gagal membuat folder ekstraksi.']);
        }

        // Ekstraksi ZIP dengan validasi tambahan
        $zip = new ZipArchive;
        $zipPath = storage_path('app/' . $filePath);
        if ($zip->open($zipPath) !== true) {
            return back()->withErrors(['error' => 'File ZIP tidak bisa dibuka. Pastikan format benar.']);
        }

        if (!$zip->extractTo($extractBasePath)) {
            return back()->withErrors(['error' => 'Ekstraksi gagal. File mungkin rusak.']);
        }
        $zip->close();

        // Cek folder utama hasil ekstraksi
        $folders = array_diff(scandir($extractBasePath), array('..', '.'));
        if (count($folders) > 0) {
            $originalFolder = reset($folders);
            $sanitizedFolder = str_replace(' ', '-', $originalFolder); // Ganti spasi jadi strip
            if ($originalFolder !== $sanitizedFolder) {
                rename($extractBasePath . '/' . $originalFolder, $extractBasePath . '/' . $sanitizedFolder);
            }
            $finalExtractPath = $gameFolder . '/' . $sanitizedFolder;
        } else {
            $finalExtractPath = $gameFolder;
        }

        // Jika game HTML, hapus file ZIP setelah ekstraksi
        if ($request->type === 'html' && Storage::exists($filePath)) {
            Storage::delete($filePath);
        }

        // Pastikan `status` memiliki nilai default jika tidak terkirim
        $status = $request->status ?? 'in_development';

        // Simpan game ke database
        $game = Game::create([
            'title' => $request->title,
            'tagline' => $request->tagline,
            'trailer' => $request->trailer,
            'category' => $request->category,
            'type' => $request->type,
            'status' => $status,
            'price_type' => (int) $request->price_type, // Pastikan angka tersimpan
            'price' => $request->price_type === 2 ? $request->price : 0, // Harga hanya diperlukan jika berbayar
            'game_download' => $request->type === 'downloadable' ? $filePath : null,
            'web_game' => $request->type === 'html' ? $finalExtractPath : null,
            'cover_image' => $coverPath,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        // Simpan screenshot (kalau ada)
        if ($request->hasFile('screenshots')) {
            foreach ($request->file('screenshots') as $file) {
                $path = $file->store('screenshots', 'public');

                // Simpan ke database pakai relasi
                $game->screenshots()->create([
                    'screenshot_path' => $path,
                ]);
            }
        }
        // Setelah simpan semua data dan file
        return response()->json(['message' => 'Game berhasil diunggah!']);
    }

    public function downloadGame($id)
    {
        $game = Game::findOrFail($id);
        if ($game->game_download && Storage::exists($game->game_download)) {
            return Storage::download($game->game_download);
        }
        return back()->withErrors(['error' => 'Game tidak tersedia untuk diunduh.']);
    }

    public function showHome()
    {
        $games = Game::latest()->get();
        return view('home', compact('games'));
    }

    public function showGameDetail($title)
    {
        //$game = Game::with('screenshots')->findOrFail($title);
        $game = Game::with('screenshots')->where('title', $title)->firstOrFail();
        if (!$game) {
            return redirect()->route('home')->withErrors(['error' => 'Game tidak ditemukan.']);
        }
        return view('game-detail', compact('game'));
    }
    public function liveSearch(Request $request)
    {
        $query = $request->query('q');
        // Contoh pencarian berdasarkan judul game. Kalau ada kolom creator, kamu bisa tambahkan `orWhere`
        $games = Game::where('title', 'like', '%' . $query . '%')->get();

        return response()->json($games);
    }


}