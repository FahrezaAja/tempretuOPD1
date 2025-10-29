@extends('layouts.admin')

@section('title', 'Manajemen Berita')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-6 text-indigo-700">Kelola Berita</h1>

        <!-- Tombol Tambah -->
        <button onclick="openModal('createModal')"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded mb-4 transition duration-200">
            + Tambah Berita
        </button>

        <!-- Tabel -->
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white">
                    <tr>
                        <th class="px-4 py-3 border-b text-left font-semibold">ID</th>
                        <th class="px-4 py-3 border-b text-left font-semibold">Judul</th>
                        <th class="px-4 py-3 border-b text-left font-semibold">Kategori</th>
                        <th class="px-4 py-3 border-b text-center font-semibold">Tanggal</th>
                        <th class="px-4 py-3 border-b text-center font-semibold">Unggulan</th>
                        <th class="px-4 py-3 border-b text-center font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($berita as $item)
                        <tr class="odd:bg-gray-50 even:bg-white hover:bg-indigo-50 transition">
                            <td class="px-4 py-3 border-b">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 border-b font-medium text-gray-700">{{ $item->judul }}</td>
                            <td class="px-4 py-3 border-b">{{ $item->kategori->nama }}</td>
                            <td class="px-4 py-3 border-b text-center">
                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                            </td>
                            <td class="px-4 py-3 border-b text-center">
                                @if($item->unggulan)
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Ya</span>
                                @else
                                    <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-sm">Tidak</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 border-b text-center">
                                <div class="flex justify-center space-x-2">
                                    <!-- Tombol Lihat -->
                                    <button onclick="openModal('viewModal{{ $item->id }}')"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm transition duration-200 shadow-sm">
                                        Lihat
                                    </button>

                                    <!-- Tombol Edit -->
                                    <button onclick="openModal('editModal{{ $item->id }}')"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm transition duration-200 shadow-sm">
                                        Edit
                                    </button>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('beritaAdmin.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus berita ini?')"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm transition duration-200 shadow-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- ================== MODAL LIHAT BERITA ================== -->
                        <div id="viewModal{{ $item->id }}"
                            class="hidden fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-50 p-6">
                            <div
                                class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto transition-all transform scale-95 opacity-0 animate-fadeIn">
                                <!-- Header Modal -->
                                <div
                                    class="flex justify-between items-center py-4 border-b bg-indigo-600 text-white rounded-t-2xl px-8">
                                    <h5 class="font-semibold text-lg">Detail Berita</h5>
                                    <button onclick="closeModal('viewModal{{ $item->id }}')"
                                        class="text-white text-2xl">&times;</button>
                                </div>

                                <!-- Isi Modal -->
                                <div class="p-8 space-y-5">
                                    <h2 class="text-2xl font-bold text-center text-gray-800 mt-2">{{ $item->judul }}</h2>

                                    @if($item->foto_sampul)
                                        <img src="{{ asset('storage/' . $item->foto_sampul) }}" alt="Foto Sampul"
                                            class="w-full h-64 object-cover rounded-lg shadow">
                                    @endif

                                    @if($item->foto_berita)
                                        <div class="grid grid-cols-3 gap-3">
                                            @foreach($item->foto_berita as $foto)
                                                <img src="{{ asset('storage/' . $foto) }}" alt="Foto Berita"
                                                    class="w-full h-32 object-cover rounded-md border border-gray-200">
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="space-y-1 text-sm text-gray-700 mt-2 leading-tight">
                                        <p><span class="font-semibold text-gray-800">Tanggal:</span>
                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</p>
                                        <p><span class="font-semibold text-gray-800">Kategori:</span>
                                            {{ $item->kategori->nama }}</p>
                                        <p><span class="font-semibold text-gray-800">Status:</span>
                                            @if($item->unggulan)
                                                <span class="text-green-600 font-semibold">Berita Unggulan</span>
                                            @else
                                                <span class="text-gray-500">Bukan Berita Unggulan</span>
                                            @endif
                                        </p>
                                    </div>

                                    <hr class="border-gray-300 my-4">

                                    <div class="prose max-w-none text-gray-800 leading-relaxed ck-content">
                                        {!! $item->deskripsi !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <!-- ================== MODAL EDIT BERITA ================== -->
                        <div id="editModal{{ $item->id }}"
                            class="hidden fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-50 p-6">
                            <div
                                class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto px-8 md:px-12">
                                <div
                                    class="flex justify-between items-center py-4 border-b bg-indigo-600 text-white rounded-t-2xl -mx-8 md:-mx-12 px-8 md:px-12">
                                    <h5 class="font-semibold text-lg">Edit Berita</h5>
                                    <button onclick="closeModal('editModal{{ $item->id }}')"
                                        class="text-white text-2xl">&times;</button>
                                </div>

                                <form action="{{ route('beritaAdmin.update', $item->id) }}" method="POST"
                                    enctype="multipart/form-data" class="py-8 space-y-6">
                                    @csrf
                                    @method('PUT')

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul</label>
                                        <input type="text" name="judul" value="{{ $item->judul }}" required
                                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                                        <textarea id="description_edit{{ $item->id }}" name="deskripsi" rows="5" required
                                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">{{ $item->deskripsi }}</textarea>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                        <select name="kategori_id" required
                                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach($kategori as $k)
                                                <option value="{{ $k->id }}" {{ $item->kategori_id == $k->id ? 'selected' : '' }}>
                                                    {{ $k->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                                        <input type="date" name="tanggal"
                                            value="{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}" required
                                            class="border border-gray-300 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-indigo-500 outline-none">
                                    </div>

                                    <!-- Foto Sampul -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto Sampul</label>
                                        <input type="file" name="foto_sampul" accept="image/*"
                                            class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                        @if($item->foto_sampul)
                                            <p class="text-sm text-gray-600 mt-3">Gambar Sebelumnya:</p>
                                            <img src="{{ asset('storage/' . $item->foto_sampul) }}" alt="Sampul"
                                                class="w-32 h-32 object-cover rounded mt-2 border border-gray-200">
                                        @endif
                                    </div>

                                    <!-- Foto Berita -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto Berita (Beberapa
                                            Gambar)</label>
                                        <input type="file" name="foto_berita[]" multiple accept="image/*"
                                            class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                        @if($item->foto_berita)
                                            <p class="text-sm text-gray-600 mt-3">Gambar Sebelumnya:</p>
                                            <div class="grid grid-cols-4 gap-3 mt-2">
                                                @foreach($item->foto_berita as $foto)
                                                    <img src="{{ asset('storage/' . $foto) }}"
                                                        class="w-24 h-24 object-cover rounded border border-gray-200">
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" name="unggulan" id="unggulan{{ $item->id }}" {{ $item->unggulan ? 'checked' : '' }}
                                            class="w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                        <label for="unggulan{{ $item->id }}" class="text-gray-700">Jadikan berita
                                            unggulan</label>
                                    </div>

                                    <div class="flex justify-end space-x-3 pt-4 border-t mt-4">
                                        <button type="button" onclick="closeModal('editModal{{ $item->id }}')"
                                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">Batal</button>
                                        <button type="submit"
                                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- ================== MODAL TAMBAH BERITA ================== -->
    <div id="createModal" class="hidden fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-50 p-6">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto px-8 md:px-12">
            <div
                class="flex justify-between items-center py-4 border-b bg-indigo-600 text-white rounded-t-2xl -mx-8 md:-mx-12 px-8 md:px-12">
                <h5 class="font-semibold text-lg">Tambah Berita</h5>
                <button onclick="closeModal('createModal')" class="text-white text-2xl">&times;</button>
            </div>

            <form action="{{ route('beritaAdmin.store') }}" method="POST" enctype="multipart/form-data"
                class="py-8 space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Judul</label>
                    <input type="text" name="judul" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea id="description_create" name="deskripsi" rows="5" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <select name="kategori_id" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategori as $k)
                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                    <input type="date" name="tanggal" required
                        class="border border-gray-300 rounded-lg px-4 py-2 w-full focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>

                <!-- Foto Sampul -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Sampul</label>
                    <input type="file" name="foto_sampul" accept="image/*"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                <!-- Foto Berita -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Berita (Beberapa Gambar)</label>
                    <input type="file" name="foto_berita[]" multiple accept="image/*"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                <div class="flex items-center space-x-2">
                    <input type="checkbox" name="unggulan" id="unggulan_create"
                        class="w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                    <label for="unggulan_create" class="text-gray-700">Jadikan berita unggulan</label>
                </div>

                <div class="flex justify-end space-x-3 pt-4 border-t mt-4">
                    <button type="button" onclick="closeModal('createModal')"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">Batal</button>
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    
    <script>
        function openModal(id) {
            const modal = document.getElementById(id);
            modal.classList.remove('hidden');
            modal.querySelector('div').classList.add('scale-100', 'opacity-100');
        }
        function closeModal(id) {
            const modal = document.getElementById(id);
            modal.classList.add('hidden');
        }
    </script>

   
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.2s ease-out forwards;
        }
    </style>

    
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (document.getElementById("description_create")) {
                CKEDITOR.replace("description_create", { height: 200 });
            }
            @foreach($berita as $item)
                if (document.getElementById("description_edit{{ $item->id }}")) {
                    CKEDITOR.replace("description_edit{{ $item->id }}", { height: 200 });
                }
            @endforeach
        });
    </script>
@endsection