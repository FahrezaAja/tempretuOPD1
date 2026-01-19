<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukHukum extends Model
{
    protected $table = 'produk_hukum';
    protected $fillable = ['penulis', 'nomor', 'tahun','nama_file', 'kategori', 'tanggal', 'file'];
}
