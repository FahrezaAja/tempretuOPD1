<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sampul;
use Illuminate\Support\Facades\Storage;

class SampulController extends Controller
{
    public function index()
    {
        $sampul = Sampul::first();
        return view('admin.sampulAdmin', compact('sampul'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_opd' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto_pemimpin' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'media' => 'nullable|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480',
        ]);

        Sampul::truncate();

        $fotoPemimpinPath = null;
        if ($request->hasFile('foto_pemimpin')) {
            $fotoPemimpinPath = $request->file('foto_pemimpin')->store('sampul/foto_pemimpin', 'public');
        }

        $mediaPath = null;
        if ($request->hasFile('media')) {
            $mediaPath = $request->file('media')->store('sampul/media', 'public');
        }

        Sampul::create([
            'nama_opd' => $request->nama_opd,
            'deskripsi' => $request->deskripsi,
            'foto_pemimpin' => $fotoPemimpinPath,
            'media' => $mediaPath,
        ]);

        return redirect()->route('admin.sampulAdmin')->with('success', 'Sampul berhasil ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        $sampul = Sampul::findOrFail($id);

        $request->validate([
            'nama_opd' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto_pemimpin' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'media' => 'nullable|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480',
        ]);

        $data = $request->only(['nama_opd', 'deskripsi']);

        if ($request->hasFile('foto_pemimpin')) {
            if ($sampul->foto_pemimpin) {
                Storage::disk('public')->delete($sampul->foto_pemimpin);
            }
            $data['foto_pemimpin'] = $request->file('foto_pemimpin')->store('sampul/foto_pemimpin', 'public');
        }

        if ($request->hasFile('media')) {
            if ($sampul->media) {
                Storage::disk('public')->delete($sampul->media);
            }
            $data['media'] = $request->file('media')->store('sampul/media', 'public');
        }

        $sampul->update($data);

        return redirect()->route('admin.sampulAdmin')->with('success', 'Sampul berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $sampul = Sampul::findOrFail($id);

        if ($sampul->foto_pemimpin) {
            Storage::disk('public')->delete($sampul->foto_pemimpin);
        }
        if ($sampul->media) {
            Storage::disk('public')->delete($sampul->media);
        }

        $sampul->delete();

        return redirect()->route('admin.sampulAdmin')->with('success', 'Sampul berhasil dihapus.');
    }
}
