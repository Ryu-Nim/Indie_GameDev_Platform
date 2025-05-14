<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use ZipArchive;
use App\Models\Game;

class GameController extends Controller
{
    public function uploadGame(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'game_file' => 'required|file|mimes:zip|max:51200',
            'type' => 'required|string|in:downloadable,html',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'screenshots.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Bersihkan nama file agar aman
        $fileName = pathinfo($request->file('game_file')->getClientOriginalName(), PATHINFO_FILENAME);
        $cleanFileName = preg_replace('/[^a-zA-Z0-9_-]/', '', $fileName);
        $filePath = $request->file('game_file')->storeAs('games', $cleanFileName . '.zip');

        $coverPath = $request->hasFile('cover') ? $request->file('cover')->store('covers') : null;

        $screenshotPaths = [];
        if ($request->hasFile('screenshots')) {
            foreach ($request->file('screenshots') as $screenshot) {
                $screenshotPaths[] = $screenshot->store('screenshots');
            }
        }

        // Generate Game-ID unik
        $gameNumber = Game::count() + 1;
        do {
            $gameId = str_pad($gameNumber, 3, '0', STR_PAD_LEFT);
            $gameFolder = 'games/Game-ID-' . $gameId;
            $extractBasePath = public_path($gameFolder);
            $gameNumber++;
        } while (File::exists($extractBasePath));

        // Buat folder hasil ekstraksi dengan validasi
        if (!File::exists($extractBasePath)) {
            if (!File::makeDirectory($extractBasePath, 0755, true)) {
                return back()->withErrors(['error' => 'Gagal membuat folder ekstraksi']);
            }
        }

        // Ekstraksi ZIP dengan validasi
        $zip = new ZipArchive;
        $zipPath = storage_path('app/' . $filePath);
        if (!$zip->open($zipPath)) {
            return back()->withErrors(['error' => 'Format ZIP tidak valid atau file rusak']);
        }

        $zip->extractTo($extractBasePath);
        $zip->close();

        // Cek folder utama hasil ekstraksi
        $folders = array_diff(scandir($extractBasePath), array('..', '.'));
        $finalExtractPath = count($folders) > 0 ? $gameFolder . '/' . reset($folders) : $gameFolder;

        // Hapus file ZIP jika game adalah tipe HTML
        if ($request->type === 'html' && Storage::exists($filePath)) {
            Storage::delete($filePath);
        }

        // Simpan game ke database
        Game::create([
            'title' => $request->title,
            'description' => $request->description,
            'game_download' => $request->type === 'downloadable' ? $filePath : null,
            'web_game' => $request->type === 'html' ? $finalExtractPath : null,
            'cover_image' => $coverPath,
            'screenshots' => json_encode($screenshotPaths),
            'type' => $request->type,
            'user_id' => auth()->id(),
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