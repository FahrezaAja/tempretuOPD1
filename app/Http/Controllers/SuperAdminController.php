<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    // Dashboard super admin → daftar semua admin
    public function index()
    {
        $admins = User::where('role', 'admin')->orderBy('username')->get();
        return view('super.dashboard', compact('admins'));
    }

    // Simpan admin baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:100', 'unique:users,username'],
            'gmail' => ['required', 'email', 'max:255', 'unique:users,gmail'],
            'password' => ['required', 'string', function($attribute, $value, $fail) {
                if(strlen($value) < 8) {
                    $fail('Password minimal 8 karakter.');
                }
                if(strlen($value) > 15) {
                    $fail('Password maksimal 15 karakter.');
                }
                if(!preg_match('/[A-Z]/', $value)) {
                    $fail('Password minimal 1 huruf besar (uppercase).');
                }
                if(!preg_match('/[a-z]/', $value)) {
                    $fail('Password minimal 1 huruf kecil (lowercase).');
                }
                if(!preg_match('/[0-9]/', $value)) {
                    $fail('Password minimal 1 angka.');
                }
                if(!preg_match('/[@$!%*_?&]/', $value)) {
                    $fail('Password minimal 1 karakter unik/special (@$!%_*?&).');
                }
            }],
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'gmail' => $validated['gmail'],
            'password' => Hash::make($validated['password']),
            'role' => 'admin',
        ]);

        session()->flash('new_admin_plain_password', $validated['password']);

        return redirect()->route('super.dashboard')->with('success', 'Admin baru berhasil dibuat.');
    }

    // Update admin
    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $validated = $request->validate([
            'username' => ['required', 'string', 'max:100', Rule::unique('users', 'username')->ignore($admin->id)],
            'gmail' => ['required', 'email', 'max:255', Rule::unique('users', 'gmail')->ignore($admin->id)],
            'password' => ['nullable', 'string', function($attribute, $value, $fail) {
                if($value) {
                    if(strlen($value) < 8) {
                        $fail('Password minimal 8 karakter.');
                    }
                    if(strlen($value) > 15) {
                        $fail('Password maksimal 15 karakter.');
                    }
                    if(!preg_match('/[A-Z]/', $value)) {
                        $fail('Password minimal 1 huruf besar (uppercase).');
                    }
                    if(!preg_match('/[a-z]/', $value)) {
                        $fail('Password minimal 1 huruf kecil (lowercase).');
                    }
                    if(!preg_match('/[0-9]/', $value)) {
                        $fail('Password minimal 1 angka.');
                    }
                    if(!preg_match('/[@$!%*_?&]/', $value)) {
                        $fail('Password minimal 1 karakter unik/special (@$!%*?&).');
                    }
                }
            }],
        ]);

        $admin->username = $validated['username'];
        $admin->gmail = $validated['gmail'];

        if (!empty($validated['password'])) {
            $admin->password = Hash::make($validated['password']);
            session()->flash('updated_admin_plain_password', $validated['password']);
        }

        $admin->save();

        return redirect()->route('super.dashboard')->with('success', 'Data admin berhasil diperbarui.');
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
}
