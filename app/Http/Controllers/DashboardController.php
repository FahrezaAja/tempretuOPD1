<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik Berita
        $totalBerita = Berita::count();
        $beritaBiasa = Berita::where('unggulan', false)->count();
        $beritaUnggulan = Berita::where('unggulan', true)->count();

        return view('admin.dashboard', compact('totalBerita', 'beritaBiasa', 'beritaUnggulan'));
    }
}
