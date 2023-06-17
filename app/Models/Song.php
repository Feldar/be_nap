<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $table = "songs";

    protected $fillable = [
        'id',
        'song_number',
        'name_rm',
        'name_jp',
        'duration'

    ];

    public function albums()
    {
        return $this->belongsToMany(User::class, 'album_song', 'song_id', 'album_id');
    }
}
