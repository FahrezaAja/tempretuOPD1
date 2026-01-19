<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::with('kategori')->latest()->get();
        $kategori = Kategori::all();
        return view('admin.beritaAdmin', compact('berita', 'kategori'));
    }

    public function show(Request $request)
    {
        // Ambil parameter kategori (jika user klik kategori tertentu)
        $kategoriFilter = $request->query('kategori');

        // Ambil data kategori
        $kategori = Kategori::withCount('berita')->get();

        // Ambil data berita (unggulan di atas)
        $berita = Berita::with('kategori')
            ->when($kategoriFilter, function ($query) use ($kategoriFilter) {
                $query->whereHas('kategori', function ($q) use ($kategoriFilter) {
                    $q->where('nama', $kategoriFilter);
                });
            })
            ->orderByDesc('unggulan') // berita unggulan di atas
            ->orderByDesc('tanggal')
            ->get();

        return view('umum.berita-terbaru', compact('berita', 'kategori', 'kategoriFilter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto_sampul' => 'nullable|image|max:2048',
            'foto_berita.*' => 'nullable|image|max:2048',
            'tanggal' => 'required|date',
            'kategori_id' => 'required|exists:kategori,id',
            'unggulan' => 'sometimes', // perbaikan untuk checkbox
        ]);

        $fotoSampulPath = $request->hasFile('foto_sampul')
            ? $request->file('foto_sampul')->store('berita', 'public')
            : null;

        $fotoBeritaPath = [];
        if ($request->hasFile('foto_berita')) {
            foreach ($request->file('foto_berita') as $foto) {
                $fotoBeritaPath[] = $foto->store('berita', 'public');
            }
        }

        Berita::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto_sampul' => $fotoSampulPath,
            'foto_berita' => $fotoBeritaPath,
            'tanggal' => $request->tanggal,
            'unggulan' => $request->has('unggulan'), // true jika dicentang
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->back()->with('success', 'Berita berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto_sampul' => 'nullable|image|max:2048',
            'foto_berita.*' => 'nullable|image|max:2048',
            'tanggal' => 'required|date',
            'kategori_id' => 'required|exists:kategori,id',
            'unggulan' => 'sometimes', // perbaikan untuk checkbox
        ]);

        // Update Foto Sampul
        if ($request->hasFile('foto_sampul')) {
            if ($berita->foto_sampul && Storage::disk('public')->exists($berita->foto_sampul)) {
                Storage::disk('public')->delete($berita->foto_sampul);
            }
            $berita->foto_sampul = $request->file('foto_sampul')->store('berita', 'public');
        }

        // Update Foto Berita
        if ($request->hasFile('foto_berita')) {
            if ($berita->foto_berita) {
                foreach ($berita->foto_berita as $foto) {
                    if (Storage::disk('public')->exists($foto)) {
                        Storage::disk('public')->delete($foto);
                    }
                }
            }
            $paths = [];
            foreach ($request->file('foto_berita') as $foto) {
                $paths[] = $foto->store('berita', 'public');
            }
            $berita->foto_berita = $paths;
        }

        // Update data berita
        $berita->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'unggulan' => $request->has('unggulan'), // true jika dicentang
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->back()->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->foto_sampul && Storage::disk('public')->exists($berita->foto_sampul)) {
            Storage::disk('public')->delete($berita->foto_sampul);
        }

        if ($berita->foto_berita) {
            foreach ($berita->foto_berita as $foto) {
                if (Storage::disk('public')->exists($foto)) {
                    Storage::disk('public')->delete($foto);
                }
            }
        }

        $berita->delete();

        return redirect()->back()->with('success', 'Berita berhasil dihapus.');
    }
}
