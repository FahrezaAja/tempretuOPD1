<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BidangPolitik extends Model
{
    protected $table = "bidang_politik";
    protected $fillable = [
        'tugas_pokok',
        'fungsi',
    ];
}
