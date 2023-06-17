<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $table = "artists";

    protected $fillable = [
        'id',
        'image',
        'name_rm',
        'name_jp',
        'profile_page',
        'twitter_account',
        'blog',
        'tiktok_account',
        'instagram_account',
        'youtube_account',
        'join_date',
        'graduation_date',
        'status'

    ];

    public function character()
    {
        return $this->hasOne(Character::class, 'artist_id');
    }
}
