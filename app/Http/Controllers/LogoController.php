<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logo;
use Illuminate\Support\Facades\Storage;

class LogoController extends Controller
{

    public function index()
    {
        $logo = Logo::first();

        return view('admin.logoAdmin', compact('logo'));
    }

    public function store(Request $request)
    {

        if (!$request->hasFile('image')) {
            return back()->withErrors(['image' => 'Wajib Unggah Logo'])->withInput();
        }

        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:10048',
        ]);


        Logo::truncate();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('logo', 'public');
        }

        Logo::create([
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.logoAdmin')->with('success', 'Logo berhasil ditambahkan.');
    }


    public function update(Request $request, string $id)
    {
        $logo = Logo::findOrFail($id);

        if (!$request->hasFile('image')) {
            return back()->withErrors(['image' => 'Wajib mengubah sesuatu'])->withInput();

        }
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:10048',
        ]);

        $data = $request->only([]);

        if ($request->hasFile('image')) {
            if ($logo->image) {
                Storage::disk('public')->delete($logo->image);
            }
            $data['image'] = $request->file('image')->store('logo', 'public');
        }

        $logo->update($data);

        return redirect()->route('admin.logoAdmin')->with('success', 'Logo berhasil diperbarui.');
    }


    public function destroy(string $id)
    {
        $logo = Logo::findOrFail($id);

        if ($logo->image) {
            Storage::disk('public')->delete($logo->image);
        }

        $logo->delete();

        return redirect()->route('admin.logoAdmin')->with('success', 'Logo berhasil dihapus.');
    }
}
