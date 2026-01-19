<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sekretariat;
class SekretariatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sekretariat = Sekretariat::first();

        return view('admin.sekretariatAdmin', compact('sekretariat'));
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


        Sekretariat::truncate();

        Sekretariat::create([
            'tugas_pokok' => $request->tugas_pokok,
            'fungsi' => $request->fungsi,
        ]);

        return redirect()->route('admin.sekretariatAdmin')->with('success', 'Sekretariat berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $sekretariat = Sekretariat::first();

        return view('umum.sekretariat', compact('sekretariat'));
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
        $sekretariat = Sekretariat::findOrFail($id);

        $request->validate([
            'tugas_pokok' => 'required|string',
            'fungsi' => 'required|string',
        ]);

        $data = $request->only(['tugas_pokok', 'fungsi']);

        $sekretariat->update($data);

        return redirect()->route('admin.sekretariatAdmin')->with('success', 'Sekretariat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sekretariat = Sekretariat::findOrFail($id);

        $sekretariat->delete();

        return redirect()->route('admin.sekretariatAdmin')->with('success', 'Sekretariat berhasil dihapus.');
    }
}
