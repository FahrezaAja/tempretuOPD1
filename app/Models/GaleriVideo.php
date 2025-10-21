<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriVideo extends Model
{
    use HasFactory;

    protected $table = 'galeri_video';

    protected $fillable = [
        'youtube_link',
    ];
}
