<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $table = "characters";

    protected $fillable = [
        'id',
        'image',
        'name_rm',
        'name_jp',
        'profile_page',
        'twitter_account',
        'youtube_account',
        'color',
        'join_date',
        'graduation_date',
        'status',
        'artist_id'

    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }
}
