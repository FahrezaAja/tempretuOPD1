<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramKegiatan extends Model
{
    protected $table = 'program_kegiatan';
    protected $fillable = [
        'penulis',
        'nama_file',
        'kategori',
        'tanggal',
        'file',
    ];

}
