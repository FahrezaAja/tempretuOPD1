<?php

namespace App\Http\Controllers;

use App\Models\GaleriVideo;
use Illuminate\Http\Request;

class GaleriVideoController extends Controller
{
    // Tampilkan halaman galeri sekaligus menangani penambahan video
    public function index(Request $request)
    {
        // Jika ada POST, simpan video baru
        if ($request->isMethod('post')) {
            $request->validate([
                'youtube_link' => 'required|url',
            ]);

            GaleriVideo::create([
                'youtube_link' => $request->youtube_link,
            ]);

            return redirect()->back()->with('success', 'Video berhasil ditambahkan');
        }

        $videos = GaleriVideo::latest()->get();
        return view('admin.galeriVideoAdmin', compact('videos'));
    }

    // Hapus video
    public function destroy(GaleriVideo $video)
    {
        $video->delete();
        return redirect()->back()->with('success', 'Video berhasil dihapus');
    }
}
