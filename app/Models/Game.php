<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'sinopsis',
        'pv_video_link',
        'category_game',
        'type_game',
        'release_status',
        'genre',
        'price_type',
        'price',
        'game_download',
        'web_game_file',
        'description',
        'cover_image',
        'status',
        'user_id',
    ];

    public function screenshots()
    {
        return $this->hasMany(GameScreenshot::class, 'game_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
