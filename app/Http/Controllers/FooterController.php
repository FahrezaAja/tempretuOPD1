<?php

namespace App\Http\Controllers;

use App\Models\Aplikasi;
use App\Models\Kontak;
use App\Models\Logo;
use App\Models\Sampul;
use App\Models\Sosmed;

class FooterController extends Controller
{
    /**
     * Mengambil semua data untuk footer dari berbagai tabel.
     */
    public function index()
    {
        return view('home', [
            'aplikasi' => Aplikasi::all(),
            'kontak' => Kontak::first(),
            'logo' => Logo::first(),
            'sampul' => Sampul::first(),
            'sosmed' => Sosmed::first(),
        ]);
    }

}
