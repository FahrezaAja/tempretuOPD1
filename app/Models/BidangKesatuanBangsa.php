<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BidangKesatuanBangsa extends Model
{
    protected $table = "bidang_kesatuan_bangsa";
    protected $fillable = [
        'tugas_pokok',
        'fungsi',
    ];
}
