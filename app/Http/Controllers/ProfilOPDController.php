<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilOPD;
use Illuminate\Support\Facades\Storage;

class ProfilOPDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profilopd = ProfilOPD::first();

        return view('admin.profilOPDAdmin', compact('profilopd'));
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
            'nama_opd' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
        ]);


        ProfilOPD::truncate();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profilOPD', 'public');
        }

        ProfilOPD::create([
            'nama_opd' => $request->nama_opd,
            'deskripsi' => $request->deskripsi,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.profilOPDAdmin')->with('success', 'Profil OPD berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $profilopd = ProfilOPD::first();

        return view('umum.profilOPD', compact('profilopd'));
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
        $profilopd = ProfilOPD::findOrFail($id);

        $request->validate([
            'nama_opd' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
        ]);

        $data = $request->only(['nama_opd', 'deskripsi', 'visi', 'misi']);

        if ($request->hasFile('image')) {
            if ($profilopd->image) {
                Storage::disk('public')->delete($profilopd->image);
            }
            $data['image'] = $request->file('image')->store('sambutan', 'public');
        }

        $profilopd->update($data);

        return redirect()->route('admin.profilOPDAdmin')->with('success', 'Profil OPD berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $profilopd = ProfilOPD::findOrFail($id);

        if ($profilopd->image) {
            Storage::disk('public')->delete($profilopd->image);
        }

        $profilopd->delete();

        return redirect()->route('admin.profilOPDAdmin')->with('success', 'Profil OPD berhasil dihapus.');
    }
}
