<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'deskripsi',
        'foto_sampul',
        'foto_berita',
        'tanggal',
        'unggulan',
        'kategori_id',
    ];

    protected $casts = [
        'foto_berita' => 'array',
        'unggulan' => 'boolean',
        'tanggal' => 'date',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function getFotoSampulUrlAttribute()
    {
        return $this->foto_sampul ? asset('storage/' . $this->foto_sampul) : null;
    }

    public function getFotoBeritaUrlAttribute()
    {
        if (!$this->foto_berita)
            return [];
        return collect($this->foto_berita)->map(fn($foto) => asset('storage/' . $foto));
    }
}
