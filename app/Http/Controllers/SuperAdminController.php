<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class SuperAdminController extends Controller
{
    // Dashboard super admin → daftar semua admin
    public function index()
    {
        $admins = User::where('role', 'admin')->orderBy('username')->get();
        return view('super.dashboard', compact('admins'));
    }

    // Form create admin
    public function create()
    {
        return view('super.create-admin');
    }

    // Simpan admin baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:100', 'unique:users,username'],
            'gmail' => ['required', 'email', 'max:255', 'unique:users,gmail'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'gmail' => $validated['gmail'],
            'password' => bcrypt($validated['password']),
            'role' => 'admin',
        ]);

        // Simpan password asli sekali untuk flash message
        session()->flash('new_admin_plain_password', $validated['password']);

        return redirect()->route('super.dashboard')->with('success', 'Admin baru berhasil dibuat.');
    }

    // Form edit admin
    public function edit($id)
    {
        $admin = User::findOrFail($id);
        return view('super.manage-admin', compact('admin'));
    }

    // Update admin
    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $validated = $request->validate([
            'username' => ['required', 'string', 'max:100', Rule::unique('users', 'username')->ignore($admin->id)],
            'gmail' => ['required', 'email', 'max:255', Rule::unique('users', 'gmail')->ignore($admin->id)],
            'password' => ['nullable', 'string', 'min:6'],
        ]);

        $admin->username = $validated['username'];
        $admin->gmail = $validated['gmail'];

        if (!empty($validated['password'])) {
            $admin->password = bcrypt($validated['password']);
            // Flash password baru untuk modal
            session()->flash('updated_admin_plain_password', $validated['password']);
        }

        $admin->save();

        return redirect()->route('super.dashboard')->with('success', 'Data admin berhasil diperbarui.');
    }

    // Form delete admin
    public function deleteForm()
    {
        return view('super.delete-admin');
    }

    // Hapus admin
    public function destroy(Request $request)
    {
        $request->validate(['confirm_username' => ['required', 'string']]);
        $username = $request->input('confirm_username');

        $admin = User::where('username', $username)->where('role', 'admin')->first();

        if (!$admin) {
            return back()->withErrors(['confirm_username' => 'Nama/username tidak ditemukan atau bukan admin.']);
        }

        $admin->delete();
        return redirect()->route('super.dashboard')->with('success', 'Admin berhasil dihapus.');
    }

    // Tampilkan data admin sebagai JSON (untuk modal)
}
