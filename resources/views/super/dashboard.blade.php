<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Super Admin</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-6xl mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-indigo-700">Dashboard Super Admin</h1>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded transition">
                    Logout
                </button>
            </form>


        </div>

        <!-- Tombol tambah admin -->
        <a href="{{ route('super.admin.store') }}"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
            Tambah Admin
        </a>


        <!-- Pesan sukses -->
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mt-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Flash password baru -->
        @if(session('new_admin_plain_password'))
            <div class="bg-yellow-100 text-yellow-800 p-3 rounded mt-4">
                Password baru admin: <strong>{{ session('new_admin_plain_password') }}</strong>
            </div>
        @endif

        @if(session('updated_admin_plain_password'))
            <div class="bg-yellow-100 text-yellow-800 p-3 rounded mt-4">
                Password admin diperbarui: <strong>{{ session('updated_admin_plain_password') }}</strong>
            </div>
        @endif

        <!-- Tabel daftar admin -->
        <div class="mt-6 overflow-x-auto bg-white rounded-lg shadow">
            <table class="w-full border-collapse border border-gray-200">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="border px-4 py-2 text-left">ID</th>
                        <th class="border px-4 py-2 text-left">Username</th>
                        <th class="border px-4 py-2 text-left">Email</th>
                        <th class="border px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $admin)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">{{ $admin->username }}</td>
                            <td class="border px-4 py-2">{{ $admin->gmail }}</td>
                            <td class="border px-4 py-2 text-center space-x-2">

                                <!-- Tombol Edit -->
                                <a href="{{ route('super.admin.edit', $admin->id) }}"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded transition">
                                    Edit
                                </a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('super.admin.destroy') }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="confirm_username" value="{{ $admin->username }}">
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus admin ini?')"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>