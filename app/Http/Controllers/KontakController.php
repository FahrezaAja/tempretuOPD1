<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    /**
     * Halaman admin untuk kelola kontak
     */
    public function index()
    {
        $kontak = Kontak::first();
        return view('admin.kontakAdmin', compact('kontak'));
    }

    /**
     * Simpan kontak baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'maps_iframe' => 'required',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        Kontak::create($request->only('maps_iframe', 'alamat', 'telepon', 'email'));

        return redirect()->route('admin.kontakAdmin')->with('success', 'Kontak berhasil disimpan.');
    }

    /**
     * Update data kontak
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'maps_iframe' => 'required',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        $kontak = Kontak::findOrFail($id);
        $kontak->update($request->only('maps_iframe', 'alamat', 'telepon', 'email'));

        return redirect()->route('admin.kontakAdmin')->with('success', 'Kontak berhasil diperbarui.');
    }

    /**
     * Halaman user (umum)
     */
    public function show()
    {
        $kontak = Kontak::first();
        return view('umum.kontak', compact('kontak'));
    }

    /**
     * Hapus kontak (opsional)
     */
    public function destroy($id)
    {
        $kontak = Kontak::findOrFail($id);
        $kontak->delete();

        return redirect()->route('admin.kontakAdmin')->with('success', 'Kontak berhasil dihapus.');
    }
}
