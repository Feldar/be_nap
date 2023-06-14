<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $table = "episodes";

    protected $fillable = [
        'id',
        'episode_number',
        'name_rm',
        'name_jp',
        'name_en',
        'format',
        'resolution',
        'release_date',
        'type',
        'duration',
        'image',
        'imagename',
        'file',
        'filename',
        'tvshows_id'

    ];
    public function tvshow()
    {
        return $this->belongsTo(Tvshow::class, 'tvshow_id');
    }
}
