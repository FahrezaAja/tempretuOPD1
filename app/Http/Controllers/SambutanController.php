<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sambutan;
use Illuminate\Support\Facades\Storage;

class SambutanController extends Controller
{
    /**
     * Tampilkan halaman manajemen sambutan (hanya 1 data).
     */
    public function index()
    {
        // Ambil 1 data pertama, bukan semua
        $katasambutan = Sambutan::first();

        return view('admin.sambutanAdmin', compact('katasambutan'));
    }
    public function show()
    {
        // Ambil 1 data pertama, bukan semua
        $katasambutan = Sambutan::first();

        return view('umum.sambutan', compact('katasambutan'));
    }

    /**
     * Simpan sambutan baru (hapus lama jika ada).
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'nama_opd' => 'required|string|max:255',
            'nama_kepala_badan' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Hapus data lama agar hanya satu sambutan yang tersimpan
        Sambutan::truncate();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('sambutan', 'public');
        }

        Sambutan::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'nama_opd' => $request->nama_opd,
            'nama_kepala_badan' => $request->nama_kepala_badan,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.sambutanAdmin')->with('success', 'Kata Sambutan berhasil ditambahkan.');
    }

    /**
     * Perbarui data sambutan.
     */
    public function update(Request $request, string $id)
    {
        $katasambutan = Sambutan::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'nama_opd' => 'required|string|max:255',
            'nama_kepala_badan' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['judul', 'deskripsi', 'nama_opd', 'nama_kepala_badan']);

        if ($request->hasFile('image')) {
            if ($katasambutan->image) {
                Storage::disk('public')->delete($katasambutan->image);
            }
            $data['image'] = $request->file('image')->store('sambutan', 'public');
        }

        $katasambutan->update($data);

        return redirect()->route('admin.sambutanAdmin')->with('success', 'Kata Sambutan berhasil diperbarui.');
    }

    /**
     * Hapus data sambutan.
     */
    public function destroy(string $id)
    {
        $katasambutan = Sambutan::findOrFail($id);

        if ($katasambutan->image) {
            Storage::disk('public')->delete($katasambutan->image);
        }

        $katasambutan->delete();

        return redirect()->route('admin.sambutanAdmin')->with('success', 'Kata Sambutan berhasil dihapus.');
    }
}
