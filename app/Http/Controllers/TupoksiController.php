<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tupoksi;

class TupoksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tupoksi = Tupoksi::first();

        return view('admin.tupoksiAdmin', compact('tupoksi'));

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
            'tugas_pokok' => 'required|string',
            'fungsi' => 'required|string',
        ]);


        Tupoksi::truncate();

        Tupoksi::create([
            'tugas_pokok' => $request->tugas_pokok,
            'fungsi' => $request->fungsi,
        ]);

        return redirect()->route('admin.tupoksiAdmin')->with('success', 'Tugas pokok & fungsi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $tupoksi = Tupoksi::first();

        return view('umum.tupoksi', compact('tupoksi'));
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
        $tupoksi = Tupoksi::findOrFail($id);

        $request->validate([
            'tugas_pokok' => 'required|string',
            'fungsi' => 'required|string',
        ]);

        $data = $request->only(['tugas_pokok', 'fungsi']);

        $tupoksi->update($data);

        return redirect()->route('admin.tupoksiAdmin')->with('success', 'Tugas pokok & fungsi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tupoksi = Tupoksi::findOrFail($id);

        $tupoksi->delete();

        return redirect()->route('admin.tupoksiAdmin')->with('success', 'Tugas pokok & fungsi berhasil dihapus.');
    }
}
