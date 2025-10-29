@extends('layouts.admin')

@section('title', 'Manajemen Aplikasi')
@section('page-title', 'Manajemen Aplikasi')

@section('content')

    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-6 text-indigo-700">Kelola Aplikasi</h1>

        <!-- Tombol Tambah -->
        <button onclick="openModal('createModal')"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded mb-4 transition duration-200">
            + Tambah Aplikasi
        </button>

        <!-- Tabel Data -->
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white">
                    <tr>
                        <th class="px-4 py-3 border-b text-left font-semibold">ID</th>
                        <th class="px-4 py-3 border-b text-left font-semibold">Nama Aplikasi</th>
                        <th class="px-4 py-3 border-b text-left font-semibold">Link</th>
                        <th class="px-4 py-3 border-b text-center font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aplikasi as $item)
                        <tr class="transition duration-200 odd:bg-gray-50 even:bg-white hover:bg-indigo-50 hover:shadow-sm">
                            <td class="px-4 py-3 border-b">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 border-b font-medium text-gray-800">{{ $item->nama }}</td>
                            <td class="px-4 py-3 border-b text-blue-600">
                                <a href="{{ $item->link }}" target="_blank" class="hover:underline">{{ $item->link }}</a>
                            </td>
                            <td class="px-4 py-3 border-b text-center">
                                <div class="flex justify-center space-x-2">
                                    <button onclick="openModal('editModal{{ $item->id }}')"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm transition duration-200 shadow-sm">
                                        Edit
                                    </button>
                                    <form action="{{ route('admin.aplikasiAdmin.destroy', $item->id) }}" method="POST"
                                        class="inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" data-id="{{ $item->id }}"
                                            class="btn-delete bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm transition duration-200 shadow-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div id="createModal" class="hidden fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-50 p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-lg">
            <div class="flex justify-between items-center px-6 py-4 border-b bg-indigo-600 text-white rounded-t-lg">
                <h5 class="font-semibold text-lg">Tambah Aplikasi</h5>
                <button onclick="closeModal('createModal')" class="text-white hover:text-gray-200 text-xl">&times;</button>
            </div>
            <form action="{{ route('admin.aplikasiAdmin.store') }}" method="POST" class="p-6">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Aplikasi</label>
                    <input type="text" name="nama" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-200"
                        placeholder="Masukkan nama aplikasi">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Link Aplikasi</label>
                    <input type="url" name="link" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-200"
                        placeholder="https://contoh.go.id">
                </div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="closeModal('createModal')"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition duration-200">Batal</button>
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition duration-200">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    @foreach ($aplikasi as $item)
        <div id="editModal{{ $item->id }}"
            class="hidden fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-50 p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-lg">
                <div class="flex justify-between items-center px-6 py-4 border-b bg-indigo-600 text-white rounded-t-lg">
                    <h5 class="font-semibold text-lg">Edit Aplikasi</h5>
                    <button onclick="closeModal('editModal{{ $item->id }}')"
                        class="text-white hover:text-gray-200 text-xl">&times;</button>
                </div>
                <form action="{{ route('admin.aplikasiAdmin.update', $item->id) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Aplikasi</label>
                        <input type="text" name="nama" value="{{ $item->nama }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-200">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Link Aplikasi</label>
                        <input type="url" name="link" value="{{ $item->link }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-200">
                    </div>
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeModal('editModal{{ $item->id }}')"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition duration-200">Batal</button>
                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition duration-200">Update</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    
    <script>
        function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
        function closeModal(id) { document.getElementById(id).classList.add('hidden'); }

        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function () {
                let form = this.closest('form');
                if (confirm('Yakin ingin menghapus aplikasi ini?')) form.submit();
            });
        });
    </script>

@endsection