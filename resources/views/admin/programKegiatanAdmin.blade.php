@extends('layouts.admin')

@section('title', 'Manajemen Program Kegiatan')

@section('content')

    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-6 text-indigo-700">Kelola Program Kegiatan</h1>

        
        <button onclick="openModal('createModal')"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded mb-4 transition duration-200">
            + Tambah Dokumen
        </button>

        
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white">
                    <tr>
                        <th class="px-4 py-3 border-b font-semibold text-left">ID</th>
                        <th class="px-4 py-3 border-b font-semibold text-left">Penulis</th>
                        <th class="px-4 py-3 border-b font-semibold text-left">Nama File</th>
                        <th class="px-4 py-3 border-b font-semibold text-left">Kategori</th>
                        <th class="px-4 py-3 border-b font-semibold text-center">Tanggal</th>
                        <th class="px-4 py-3 border-b font-semibold text-center">File</th>
                        <th class="px-4 py-3 border-b font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($programKegiatan as $item)
                        <tr class="transition duration-200 odd:bg-gray-50 even:bg-white hover:bg-indigo-50 hover:shadow-sm">
                            <td class="px-4 py-3 border-b text-gray-700">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 border-b text-gray-700">
                                @if($item->penulis)
                                    <div class="ck-content prose max-w-full">{{ $item->penulis }}</div>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 border-b text-gray-700">
                                @if($item->nama_file)
                                    <div class="ck-content prose max-w-full">{{ $item->nama_file }}</div>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 border-b text-gray-700">
                                @if($item->kategori)
                                    <span
                                        class="inline-block bg-indigo-100 text-indigo-700 text-xs font-medium px-2 py-1 rounded-full">
                                        {{ $item->kategori }}
                                    </span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 border-b text-center text-gray-700">
                                @if($item->tanggal)
                                    <div class="ck-content prose max-w-full">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                    </div>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 border-b text-center">
                                @if($item->file)
                                    <a href="{{ route('admin.programKegiatanAdmin.download', $item->id) }}"
                                        class="text-indigo-600 font-medium hover:text-indigo-800 hover:underline transition">
                                        Lihat File
                                    </a>
                                @else
                                    <span class="text-gray-400">Tidak ada file</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 border-b text-center">
                                <div class="flex justify-center space-x-2">
                                    <button onclick="openModal('editModal{{ $item->id }}')"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm transition duration-200 shadow-sm">
                                        Edit
                                    </button>
                                    <form action="{{ route('admin.programKegiatanAdmin.destroy', $item->id) }}" method="POST"
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

    <!-- Modal Tambah Dokumen -->
    <div id="createModal" class="hidden fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-50 p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center px-6 py-4 border-b bg-indigo-600 text-white rounded-t-lg">
                <h5 class="font-semibold text-lg">Tambah Dokumen</h5>
                <button onclick="closeModal('createModal')" class="text-white hover:text-gray-200 text-xl">&times;</button>
            </div>
            <form action="{{ route('admin.programKegiatanAdmin.store') }}" method="POST" enctype="multipart/form-data"
                class="p-6">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Penulis <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="penulis" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-200"
                        placeholder="Masukkan penulis">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama File <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="nama_file" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-200"
                        placeholder="Masukkan nama file">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="kategori" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blindigoue-500 focus:border-indigo-500 outline-none transition duration-200"
                        placeholder="Masukkan kategori">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal <span
                            class="text-red-500">*</span></label>
                    <input type="date" name="tanggal" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-200">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">File Dokumen <span
                            class="text-red-500">*</span></label>
                    <input type="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-200">
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

    <!-- Modal Edit Dokumen -->
    @foreach ($programKegiatan as $item)
        <div id="editModal{{ $item->id }}"
            class="hidden fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-50 p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
                <div class="flex justify-between items-center px-6 py-4 border-b bg-indigo-600 text-white rounded-t-lg">
                    <h5 class="font-semibold text-lg">Edit Dokumen</h5>
                    <button onclick="closeModal('editModal{{ $item->id }}')"
                        class="text-white hover:text-gray-200 text-xl">&times;</button>
                </div>
                <form action="{{ route('admin.programKegiatanAdmin.update', $item->id) }}" method="POST"
                    enctype="multipart/form-data" class="p-6">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Penulis <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="penulis" value="{{ $item->penulis }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-200"
                            placeholder="Masukkan penulis">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama File <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nama_file" value="{{ $item->nama_file }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-200"
                            placeholder="Masukkan nama file">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="kategori" value="{{ $item->kategori }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-200"
                            placeholder="Masukkan kategori">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal <span
                                class="text-red-500">*</span></label>
                        <input type="date" name="tanggal" value="{{ $item->tanggal }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-200">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">File Dokumen</label>
                        <input type="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition duration-200">
                        @if($item->file)
                            <div class="mt-3">
                                <p class="text-sm text-gray-600">File saat ini: <a href="{{ asset('storage/' . $item->file) }}"
                                        target="_blank" class="text-indigo-600 hover:underline">Lihat File</a></p>
                            </div>
                        @endif
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

    <!-- Script Modal + Delete -->
    <script>
        function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
        function closeModal(id) { document.getElementById(id).classList.add('hidden'); }

        // Hapus konfirmasi
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function () {
                let form = this.closest('form');
                if (confirm('Yakin ingin menghapus? Data tidak bisa dikembalikan!')) {
                    form.submit();
                }
            });
        });
    </script>

@endsection