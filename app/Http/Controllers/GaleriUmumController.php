<?php

namespace App\Http\Controllers;

use App\Models\GaleriFoto;
use App\Models\GaleriVideo;

class GaleriUmumController extends Controller
{
    public function index()
    {
        // Ambil 6 video dan 6 foto per halaman, urut terbaru
        $videos = GaleriVideo::latest()->paginate(6);
        $fotos = GaleriFoto::latest()->paginate(6);

        return view('umum.galeri', compact('videos', 'fotos'));
    }
}
