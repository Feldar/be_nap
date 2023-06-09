<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tvshow extends Model
{
    use HasFactory;

    protected $table = "tvshows";

    protected $fillable = [
        'id',
        'name_rm',
        'name_jp',
        'name_en',
        'image',
        'imagename',
        'file',
        'filename',
        'start_date',
        'end_date',
        'episodes',
        'status'

    ];
    public function episodes()
    {
        return $this->hasMany(Episode::class, 'tvshow_id');
    }
}
