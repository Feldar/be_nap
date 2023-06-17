<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $table = "albums";

    protected $fillable = [
        'id',
        'image',
        'name_rm',
        'name_jp',
        'total_songs',
        'release_price',
        'media_format',
        'release_date',
        'duration'

    ];

    public function songs()
    {
        return $this->hasMany(User::class, 'album_id');
    }
}
