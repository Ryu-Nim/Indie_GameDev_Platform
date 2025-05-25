<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use ZipArchive;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function uploadGame(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'trailer' => 'nullable|url',
            'category' => 'required|string',
            'type' => 'required|string|in:downloadable,html',
            'status' => 'required|string|in:released,in_development',
            'price_type' => 'required|integer|in:1,2',
            'price' => 'nullable|numeric',
            'game_file' => 'required|file|mimes:zip|max:51200',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'screenshots.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Bersihkan nama file agar aman
        $fileName = pathinfo($request->file('game_file')->getClientOriginalName(), PATHINFO_FILENAME);
        $cleanFileName = preg_replace('/[^a-zA-Z0-9_-]/', '', $fileName);
        $filePath = $request->file('game_file')->storeAs('games', $cleanFileName . '.zip');

        // Simpan Cover Image jika ada
        $coverPath = $request->hasFile('cover') ? $request->file('cover')->store('covers') : null;

        // Simpan Screenshots jika ada
        $screenshotPaths = $request->hasFile('screenshots')
            ? collect($request->file('screenshots'))->map(fn($file) => $file->store('screenshots'))->toArray()
            : [];

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
        $finalExtractPath = count($folders) > 0 ? $gameFolder . '/' . reset($folders) : $gameFolder;

        // Jika game HTML, hapus file ZIP setelah ekstraksi
        if ($request->type === 'html' && Storage::exists($filePath)) {
            Storage::delete($filePath);
        }

        // Pastikan `status` memiliki nilai default jika tidak terkirim
        $status = $request->status ?? 'in_development';

        // Simpan game ke database
        Game::create([
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
            'screenshots' => !empty($screenshotPaths) ? json_encode($screenshotPaths) : null,
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'Game berhasil diunggah!');
    }

    public function downloadGame($id)
    {
        $game = Game::findOrFail($id);
        if ($game->game_download) {
            return Storage::download($game->game_download);
        }
        return back()->withErrors(['error' => 'Game tidak tersedia untuk diunduh']);
    }
}