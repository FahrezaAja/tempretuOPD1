<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilOPD extends Model
{
    protected $table = "profil_opd";
    protected $fillable = [
        'nama_opd',
        'deskripsi',
        'visi',
        'misi',
        'image',
    ];
}
