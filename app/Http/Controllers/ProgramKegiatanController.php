<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramKegiatan;
use Illuminate\Support\Facades\Storage;

class ProgramKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programKegiatan = ProgramKegiatan::latest()->get();
        return view('admin.programKegiatanAdmin', compact('programKegiatan'));
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
            'penulis' => 'required|string',
            'nama_file' => 'required|string',
            'kategori' => 'required|string',
            'tanggal' => 'required|date',
            'file' => 'required|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10000', // max 10MB
        ]);

        $path = $request->file('file')->store('program-kegiatan', 'public');

        ProgramKegiatan::create([
            'penulis' => $request->penulis,
            'nama_file' => $request->nama_file,
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal,
            'file' => $path,
        ]);

        return redirect()->back()->with('success', 'Dokumen berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $programKegiatan = ProgramKegiatan::latest()->get();
        $kategoriList = ProgramKegiatan::select('kategori')->distinct()->pluck('kategori');

        return view('umum.program-kegiatan', compact('programKegiatan', 'kategoriList'));
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
        $programKegiatan = ProgramKegiatan::findOrFail($id);

        $request->validate([
            'penulis' => 'required|string',
            'nama_file' => 'required|string',
            'kategori' => 'required|string',
            'tanggal' => 'required|date',
            'file' => 'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10000', // max 10MB
        ]);

        if ($request->hasFile('file')) {
            if ($programKegiatan->file && Storage::disk('public')->exists($programKegiatan->file)) {
                Storage::disk('public')->delete($programKegiatan->file);
            }
            $path = $request->file('file')->store('program-kegiatan', 'public');
            $programKegiatan->file = $path;
        }

        $programKegiatan->penulis = $request->penulis;
        $programKegiatan->nama_file = $request->nama_file;
        $programKegiatan->kategori = $request->kategori;
        $programKegiatan->tanggal = $request->tanggal;
        $programKegiatan->save();

        return redirect()->back()->with('success', 'Dokumen berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $programKegiatan = ProgramKegiatan::findOrFail($id);

        if ($programKegiatan->file && Storage::disk('public')->exists($programKegiatan->file)) {
            Storage::disk('public')->delete($programKegiatan->file);
        }

        $programKegiatan->delete();

        return redirect()->back()->with('success', 'Dokumen berhasil dihapus.');
    }
    public function download($id)
    {
        $item = ProgramKegiatan::findOrFail($id);

        if (!$item->file) {
            abort(404, 'File tidak ditemukan');
        }

        $path = storage_path('app/public/' . $item->file);
        $originalName = $item->nama_file . '.' . pathinfo($item->file, PATHINFO_EXTENSION);

        return response()->download($path, $originalName);
    }
}
