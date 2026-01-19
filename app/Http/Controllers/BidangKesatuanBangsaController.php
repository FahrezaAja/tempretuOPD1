<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BidangKesatuanBangsa;

class BidangKesatuanBangsaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bidangkesatuanbangsa = BidangKesatuanBangsa::first();

        return view('admin.bidangKesatuanBangsaAdmin', compact('bidangkesatuanbangsa'));
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


        BidangKesatuanBangsa::truncate();

        BidangKesatuanBangsa::create([
            'tugas_pokok' => $request->tugas_pokok,
            'fungsi' => $request->fungsi,
        ]);

        return redirect()->route('admin.bidangKesatuanBangsaAdmin')->with('success', 'Bidang Kesatuan Bangsa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $bidangkesatuanbangsa = BidangKesatuanBangsa::first();

        return view('umum.bidang-kesatuan-bangsa', compact('bidangkesatuanbangsa'));
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
        $bidangkesatuanbangsa = BidangKesatuanBangsa::findOrFail($id);

        $request->validate([
            'tugas_pokok' => 'required|string',
            'fungsi' => 'required|string',
        ]);

        $data = $request->only(['tugas_pokok', 'fungsi']);

        $bidangkesatuanbangsa->update($data);

        return redirect()->route('admin.bidangKesatuanBangsaAdmin')->with('success', 'Bidang Kesatuan Bangsa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bidangkesatuanbangsa = BidangKesatuanBangsa::findOrFail($id);

        $bidangkesatuanbangsa->delete();

        return redirect()->route('admin.bidangKesatuanBangsaAdmin')->with('success', 'Bidang Kesatuan Bangsa berhasil dihapus.');
    }
}
