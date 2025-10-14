<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sambutan extends Model
{
    protected $table = "sambutan";
    protected $fillable = [
        'judul',
        'deskripsi',
        'nama_opd',
        'nama_kepala_badan',
        'image',
    ];
}
