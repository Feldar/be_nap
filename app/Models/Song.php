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
        'duration',
        'album_id',
        'file',
        'filename'

    ];

    public function album()
    {
        return $this->belongsToMany(User::class, 'album_id');
    }
}
