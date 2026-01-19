<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StrukturOrganisasi;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $strukturorganisasi = StrukturOrganisasi::first();

        return view('admin.strukturOrganisasiAdmin', compact('strukturorganisasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
        ]);


        StrukturOrganisasi::truncate();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('strukturorganisasi', 'public');
        }

        StrukturOrganisasi::create([
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.strukturOrganisasiAdmin')->with('success', 'Struktur organisasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $strukturorganisasi = StrukturOrganisasi::first();

        return view('umum.struktur-organisasi', compact('strukturorganisasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $strukturorganisasi = StrukturOrganisasi::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
        ]);

        $data = $request->only(['image']);

        if ($request->hasFile('image')) {
            if ($strukturorganisasi->image) {
                Storage::disk('public')->delete($strukturorganisasi->image);
            }
            $data['image'] = $request->file('image')->store('strukturorganisasi', 'public');
        }

        $strukturorganisasi->update($data);

        return redirect()->route('admin.strukturOrganisasiAdmin')->with('success', 'Struktur organisasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $strukturorganisasi = StrukturOrganisasi::findOrFail($id);

        if ($strukturorganisasi->image) {
            Storage::disk('public')->delete($strukturorganisasi->image);
        }

        $strukturorganisasi->delete();

        return redirect()->route('admin.strukturOrganisasiAdmin')->with('success', 'Struktur organisasi berhasil dihapus.');
    }
}
