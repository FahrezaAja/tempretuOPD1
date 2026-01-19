<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aplikasi;

class AplikasiController extends Controller
{
    public function index()
    {
        $aplikasi = Aplikasi::latest()->get();
        return view('admin.aplikasiAdmin', compact('aplikasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'link' => 'required|url',
        ]);

        Aplikasi::create($request->only(['nama', 'link']));

        return redirect()->back()->with('success', 'Aplikasi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'link' => 'required|url',
        ]);

        $aplikasi = Aplikasi::findOrFail($id);
        $aplikasi->update($request->only(['nama', 'link']));

        return redirect()->back()->with('success', 'Aplikasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $aplikasi = Aplikasi::findOrFail($id);
        $aplikasi->delete();

        return redirect()->back()->with('success', 'Aplikasi berhasil dihapus.');
    }
}
