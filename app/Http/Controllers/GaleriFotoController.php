<?php

namespace App\Http\Controllers;

use App\Models\GaleriFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriFotoController extends Controller
{
    public function index()
    {
        $galeri = GaleriFoto::latest()->get();
        return view('admin.galeriFotoAdmin', compact('galeri'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'nullable|date',
        ]);

        $path = $request->file('image')->store('galeri-foto', 'public');

        GaleriFoto::create([
            'deskripsi' => $request->deskripsi,
            'image' => $path,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->back()->with('success', 'Foto berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $galeri = GaleriFoto::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            if ($galeri->image && Storage::disk('public')->exists($galeri->image)) {
                Storage::disk('public')->delete($galeri->image);
            }
            $path = $request->file('image')->store('galeri-foto', 'public');
            $galeri->image = $path;
        }

        $galeri->deskripsi = $request->deskripsi;
        $galeri->tanggal = $request->tanggal;
        $galeri->save();

        return redirect()->back()->with('success', 'Foto berhasil diupdate.');
    }

    public function destroy($id)
    {
        $galeri = GaleriFoto::findOrFail($id);

        if ($galeri->image && Storage::disk('public')->exists($galeri->image)) {
            Storage::disk('public')->delete($galeri->image);
        }

        $galeri->delete();

        return redirect()->back()->with('success', 'Foto berhasil dihapus.');
    }
}
