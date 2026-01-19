<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sekretariat extends Model
{
    protected $table = "sekretariat";
    protected $fillable = [
        'tugas_pokok',
        'fungsi',
    ];
}
