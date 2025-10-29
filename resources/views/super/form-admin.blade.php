<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($admin) ? 'Edit Admin' : 'Tambah Admin Baru' }} - Super Admin</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-gray-100 via-white to-gray-200 min-h-screen text-gray-800">

    <div class="max-w-2xl mx-auto py-10 px-6">
        <div
            class="bg-white/80 backdrop-blur-md rounded-2xl shadow-xl border border-gray-200 p-8 transition-all duration-300 hover:shadow-2xl">

            <h1 class="text-3xl font-bold text-indigo-700 mb-6 flex items-center space-x-2">

                <span>{{ isset($admin) ? 'Edit Admin: ' . $admin->username : 'Tambah Admin Baru' }}</span>
            </h1>


            <form action="{{ isset($admin) ? route('super.admin.update', $admin->id) : route('super.admin.store') }}"
                method="POST" class="space-y-6">
                @csrf
                @if(isset($admin)) @method('PUT') @endif

                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Username</label>
                    <input type="text" name="username"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                        value="{{ old('username', $admin->username ?? '') }}" placeholder="Masukkan username">
                    @error('username')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Email</label>
                    <input type="email" name="gmail"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                        value="{{ old('gmail', $admin->gmail ?? '') }}" placeholder="Masukkan email admin">
                    @error('gmail')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div>
                    <label class="block font-semibold text-gray-700 mb-1">
                        Password {{ isset($admin) ? '(kosongkan jika tidak ingin diubah)' : '' }}
                    </label>
                    <input type="password" name="password"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                        placeholder="Masukkan password baru">

                    <div class="mt-3 bg-gray-50 border border-gray-200 rounded-lg p-3">
                        <p class="text-gray-700 font-medium text-sm mb-1">Aturan Password:</p>
                        <ul class="list-disc list-inside text-sm text-gray-600 space-y-1">
                            <li>Minimal 1 huruf besar (A-Z)</li>
                            <li>Minimal 1 huruf kecil (a-z)</li>
                            <li>Minimal 1 angka (0-9)</li>
                            <li>Minimal 1 karakter unik (@$!_%*?&)</li>
                            <li>Panjang 8-15 karakter</li>
                        </ul>
                    </div>

                    @error('password')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4">
                    <a href="{{ route('super.dashboard') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-medium px-4 py-2 rounded-lg shadow-md transition-all duration-200 hover:scale-[1.05]">
                        Kembali
                    </a>

                    <button type="submit"
                        class="{{ isset($admin) ? 'bg-blue-600 hover:bg-blue-700' : 'bg-green-600 hover:bg-green-700' }} text-white font-medium px-5 py-2 rounded-lg shadow-md transition-all duration-200 hover:scale-[1.05]">
                        {{ isset($admin) ? 'Update Admin' : 'Buat Admin' }}
                    </button>
                </div>
            </form>
        </div>

        <footer class="text-center text-sm text-gray-500 pt-6 border-t border-gray-200">
            © {{ date('Y') }} <span class="text-white-600 font-medium">Kominfo Papua Selatan </span>Semua Hak Dilindungi
        </footer>
    </div>

</body>

</html>