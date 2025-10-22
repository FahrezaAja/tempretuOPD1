<?php

namespace App\Http\Controllers;

use App\Models\Sosmed;
use Illuminate\Http\Request;

class SosmedController extends Controller
{
    public function index()
    {
        $sosmed = Sosmed::first();
        return view('admin.sosmedAdmin', compact('sosmed'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'youtube' => 'nullable|url',
        ]);

        Sosmed::create($validated);

        return redirect()->back()->with('success', 'Link sosial media berhasil ditambahkan!');
    }

    public function update(Request $request, Sosmed $sosmed)
    {
        $validated = $request->validate([
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'youtube' => 'nullable|url',
        ]);

        $sosmed->update($validated);

        return redirect()->back()->with('success', 'Link sosial media berhasil diperbarui!');
    }

    public function destroy(Sosmed $sosmed)
    {
        $sosmed->delete();
        return redirect()->back()->with('success', 'Data sosial media berhasil dihapus!');
    }
}
