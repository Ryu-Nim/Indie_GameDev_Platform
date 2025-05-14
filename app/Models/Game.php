<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'tagline',
        'trailer',
        'category',
        'type',
        'status',
        'price_type',
        'price',
        'game_download', // File ZIP (downloadable)
        'web_game', // Folder path (HTML)
        'description',
        'cover_image',
        'screenshots',
        'user_id'
    ];

    protected $casts = [
        'screenshots' => 'json', // Konversi screenshots ke array
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}