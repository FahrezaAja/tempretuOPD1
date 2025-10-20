<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Kategori extends Model
{
    use HasFactory;

    protected $table = "kategori";

    protected $fillable = ['nama', 'slug', 'icon'];

    protected static function booted()
    {
        static::creating(function ($kategori) {
            $kategori->slug = Str::slug($kategori->nama);
        });

        static::updating(function ($kategori) {
            $kategori->slug = Str::slug($kategori->nama);
        });
    }

    // ✅ Tambahkan ini:
    public function berita()
    {
        return $this->hasMany(Berita::class, 'kategori_id');
    }
}
