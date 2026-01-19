@vite('resources/css/app.css')

<div class="max-w-2xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">{{ isset($admin) ? 'Edit Admin: ' . $admin->username : 'Tambah Admin Baru' }}</h1>

    <form action="{{ isset($admin) ? route('super.admin.update', $admin->id) : route('super.admin.store') }}" method="POST">
        @csrf
        @if(isset($admin)) @method('PUT') @endif

        <!-- Username -->
        <div class="mb-4">
            <label>Username</label>
            <input type="text" name="username" class="w-full border px-3 py-2" value="{{ old('username', $admin->username ?? '') }}">
            @error('username')<p class="text-red-500">{{ $message }}</p>@enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="gmail" class="w-full border px-3 py-2" value="{{ old('gmail', $admin->gmail ?? '') }}">
            @error('gmail')<p class="text-red-500">{{ $message }}</p>@enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label>Password {{ isset($admin) ? '(kosongkan jika tidak ingin diubah)' : '' }}</label>
            <input type="password" name="password" class="w-full border px-3 py-2">

            <!-- Tulisan aturan password -->
            <p class="text-gray-600 text-sm mt-1">
                Password harus memenuhi aturan berikut:
                <ul class="list-disc list-inside">
                    <li>Minimal 1 huruf besar (A-Z)</li>
                    <li>Minimal 1 huruf kecil (a-z)</li>
                    <li>Minimal 1 angka (0-9)</li>
                    <li>Minimal 1 karakter unik/special (@$!_%*?&)</li>
                    <li>Panjang 8-15 karakter</li>
                </ul>
            </p>

            @error('password')<p class="text-red-500">{{ $message }}</p>@enderror
        </div>

        <!-- Submit -->
        <button type="submit" class="{{ isset($admin) ? 'bg-blue-500' : 'bg-green-500' }} text-white px-4 py-2 rounded">
            {{ isset($admin) ? 'Update Admin' : 'Buat Admin' }}
        </button>
        <a href="{{ route('super.dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded">Kembali</a>
    </form>
</div>

