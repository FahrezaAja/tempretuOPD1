<?php

namespace App\Http\Controllers;
use App\Models\ProdukHukum;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProdukHukumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produkHukum = ProdukHukum::latest()->get();
        return view('admin.produkHukumAdmin', compact('produkHukum'));
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
            'nomor' => 'required|integer',
            'tahun' => 'required|integer',
            'nama_file' => 'required|string',
            'kategori' => 'required|string',
            'tanggal' => 'required|date',
            'file' => 'required|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10000', // max 10MB
        ]);

        $path = $request->file('file')->store('produk-hukum', 'public');

        ProdukHukum::create([
            'penulis' => $request->penulis,
            'nomor' => $request->nomor,
            'tahun' => $request->tahun,
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
        $produkHukum = ProdukHukum::latest()->get();
        $kategoriList = ProdukHukum::select('kategori')->distinct()->pluck('kategori');
        return view('umum.produk-hukum', compact('produkHukum', 'kategoriList'));
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
        $produkHukum = ProdukHukum::findOrFail($id);

        $request->validate([
            'penulis' => 'required|string',
            'nomor' => 'required|integer',
            'tahun' => 'required|integer',
            'nama_file' => 'required|string',
            'kategori' => 'required|string',
            'tanggal' => 'required|date',
            'file' => 'sometimes|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10000', // max 10MB
        ]);

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($produkHukum->file && Storage::disk('public')->exists($produkHukum->file)) {
                Storage::disk('public')->delete($produkHukum->file);
            }
            $path = $request->file('file')->store('produk-hukum', 'public');
            $produkHukum->file = $path;
        }

        $produkHukum->penulis = $request->penulis;
        $produkHukum->nomor = $request->nomor;
        $produkHukum->tahun = $request->tahun;
        $produkHukum->nama_file = $request->nama_file;
        $produkHukum->kategori = $request->kategori;
        $produkHukum->tanggal = $request->tanggal;
        $produkHukum->save();

        return redirect()->back()->with('success', 'Dokumen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produkHukum = ProdukHukum::findOrFail($id);

        if ($produkHukum->file && Storage::disk('public')->exists($produkHukum->file)) {
            Storage::disk('public')->delete($produkHukum->file);
        }

        $produkHukum->delete();

        return redirect()->back()->with('success', 'Dokumen berhasil dihapus.');
    }

    public function download($id)
    {
        $item = ProdukHukum::findOrFail($id);

        if (!$item->file) {
            abort(404, 'File tidak ditemukan');
        }

        $path = storage_path('app/public/' . $item->file);
        $originalName = $item->nama_file . '.' . pathinfo($item->file, PATHINFO_EXTENSION);

        return response()->download($path, $originalName);
    }
}
