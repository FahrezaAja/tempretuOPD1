<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sampul;
use App\Models\Sambutan;
use App\Models\Berita;
use App\Models\GaleriFoto;

class HomeController extends Controller
{
    public function index()
    {
        $sampul = Sampul::latest()->first();
        $sambutan = Sambutan::latest()->first();

        $berita = Berita::latest()->take(5)->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->judul,
                'image' => $item->foto_sampul ? asset('storage/' . $item->foto_sampul) : asset('images/default-berita.jpg'),
                'tanggal' => \Carbon\Carbon::parse($item->tanggal)->format('d M Y'),
                'kategori' => $item->kategori->nama ?? '',
                'content' => \Illuminate\Support\Str::limit($item->deskripsi, 150, '...'),
                'deskripsi' => $item->deskripsi,
                'foto_berita' => $item->foto_berita ? array_map(fn($f) => asset('storage/' . $f), $item->foto_berita) : [],
            ];
        });

        $galeri = GaleriFoto::latest()->take(6)->get()->map(function ($item) {
            return [
                'image' => $item->image ? asset('storage/' . $item->image) : asset('images/default-image.jpg'),
                'deskripsi' => $item->deskripsi ?? '',
                'tanggal' => $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') : '-',
            ];
        });

        return view('umum.home', compact('sampul', 'sambutan', 'berita', 'galeri'));
    }
}
