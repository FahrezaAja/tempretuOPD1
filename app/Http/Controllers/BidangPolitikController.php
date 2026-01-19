<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BidangPolitik;

class BidangPolitikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bidangpolitik = BidangPolitik::first();

        return view('admin.bidangPolitikAdmin', compact('bidangpolitik'));
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


        BidangPolitik::truncate();

        BidangPolitik::create([
            'tugas_pokok' => $request->tugas_pokok,
            'fungsi' => $request->fungsi,
        ]);

        return redirect()->route('admin.bidangPolitikAdmin')->with('success', 'Bidang Politik berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $bidangpolitik = BidangPolitik::first();

        return view('umum.bidang-politik', compact('bidangpolitik'));
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
        $bidangpolitik = BidangPolitik::findOrFail($id);

        $request->validate([
            'tugas_pokok' => 'required|string',
            'fungsi' => 'required|string',
        ]);

        $data = $request->only(['tugas_pokok', 'fungsi']);

        $bidangpolitik->update($data);

        return redirect()->route('admin.bidangPolitikAdmin')->with('success', 'Bidang Politik berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bidangpolitik = BidangPolitik::findOrFail($id);

        $bidangpolitik->delete();

        return redirect()->route('admin.bidangPolitikAdmin')->with('success', 'Bidang Politik berhasil dihapus.');
    }
}
