<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Super Admin</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-gray-100 via-white to-gray-200 min-h-screen text-gray-800">


    <header class="bg-gradient-to-r from-indigo-600 to-purple-600 shadow-lg">
        <div class="max-w-6xl mx-auto flex justify-between items-center px-6 py-4">
            <h1 class="text-2xl font-bold text-white flex items-center space-x-2">

                <span>Dashboard Super Admin</span>
            </h1>

            <form action="{{ route('admin.logout') }}" method="POST" class="flex items-center">
                @csrf
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-lg shadow-md transition-all duration-200 hover:scale-[1.05]">
                    Logout
                </button>
            </form>
        </div>
    </header>


    <main class="max-w-6xl mx-auto p-6 space-y-8">


        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-indigo-700">Kelola Administrator</h2>
            <a href="{{ route('super.admin.store') }}"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow-md font-medium transition-all duration-200 hover:scale-[1.05]">
                + Tambah Admin
            </a>
        </div>


        @if(session('success'))
            <div
                class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded relative animate-fade-in-down">
                {{ session('success') }}
            </div>
        @endif

        @if(session('new_admin_plain_password'))
            <div
                class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-3 rounded relative animate-fade-in-down">
                Password baru admin:
                <strong>{{ session('new_admin_plain_password') }}</strong>
            </div>
        @endif

        @if(session('updated_admin_plain_password'))
            <div
                class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-3 rounded relative animate-fade-in-down">
                Password admin diperbarui:
                <strong>{{ session('updated_admin_plain_password') }}</strong>
            </div>
        @endif


        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-indigo-500 to-indigo-600 text-white text-left">
                    <tr>
                        <th class="px-5 py-3 text-sm uppercase font-semibold">#</th>
                        <th class="px-5 py-3 text-sm uppercase font-semibold">Username</th>
                        <th class="px-5 py-3 text-sm uppercase font-semibold">Email</th>
                        <th class="px-5 py-3 text-center text-sm uppercase font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $admin)
                        <tr class="border-t hover:bg-gray-50 transition-all duration-150 odd:bg-gray-50 even:bg-white">
                            <td class="px-5 py-3">{{ $loop->iteration }}</td>
                            <td class="px-5 py-3 font-medium">{{ $admin->username }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $admin->gmail }}</td>
                            <td class="px-5 py-3 text-center space-x-2">
                                <!-- Tombol Edit -->
                                <a href="{{ route('super.admin.edit', $admin->id) }}"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg shadow-sm transition hover:scale-[1.05]">
                                    Edit
                                </a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('super.admin.destroy') }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="confirm_username" value="{{ $admin->username }}">
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus admin ini?')"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-lg shadow-sm transition hover:scale-[1.05]">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if($admins->isEmpty())
                        <tr>
                            <td colspan="4" class="px-5 py-5 text-center text-gray-500 italic">
                                Belum ada data admin.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>


        <footer class="text-center text-sm text-gray-500 pt-6 border-t border-gray-200">
            © {{ date('Y') }} <span class="text-white-600 font-medium">Kominfo Papua Selatan </span>Semua Hak Dilindungi
        </footer>

    </main>


    <style>
        @keyframes fade-in-down {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-down {
            animation: fade-in-down 0.4s ease-in-out;
        }
    </style>

</body>

</html>