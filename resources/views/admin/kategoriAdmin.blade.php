@extends('layouts.admin')

@section('title', 'Manajemen Kategori Berita')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-6 text-indigo-700">Kelola Kategori Berita</h1>

        <!-- Tombol Tambah -->
        <button onclick="openModal('createModal')"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded mb-4 transition duration-200">
            + Tambah Kategori
        </button>

        <!-- Tabel -->
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white">
                    <tr>
                        <th class="px-4 py-3 border-b text-left font-semibold">ID</th>
                        <th class="px-4 py-3 border-b text-left font-semibold">Nama</th>
                        <th class="px-4 py-3 border-b text-center font-semibold">Icon</th>
                        <th class="px-4 py-3 border-b text-center font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategori as $item)
                        <tr class="odd:bg-gray-50 even:bg-white hover:bg-indigo-50 transition">
                            <td class="px-4 py-3 border-b">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 border-b font-medium text-gray-700">{{ $item->nama }}</td>
                            <td class="px-4 py-3 border-b text-center">
                                @if($item->icon)
                                    <i class="{{ $item->icon }} text-indigo-600 text-xl"></i>
                                @else
                                    <span class="text-gray-400">Tidak ada icon</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 border-b text-center">
                                <div class="flex justify-center space-x-2">
                                    <button onclick="openModal('editModal{{ $item->id }}')"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm transition duration-200 shadow-sm">
                                        Edit
                                    </button>
                                    <form action="{{ route('kategoriAdmin.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus kategori ini?')"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm transition duration-200 shadow-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div id="editModal{{ $item->id }}"
                            class="hidden fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-50 p-6">
                            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
                                
                                <div
                                    class="flex justify-between items-center px-6 py-4 border-b bg-indigo-600 text-white rounded-t-2xl">
                                    <h5 class="font-semibold text-lg">Edit Kategori</h5>
                                    <button onclick="closeModal('editModal{{ $item->id }}')"
                                        class="text-white hover:text-gray-200 text-2xl">&times;</button>
                                </div>

                               
                                <form action="{{ route('kategoriAdmin.update', $item->id) }}" method="POST"
                                    class="p-8 space-y-5">
                                    @csrf
                                    @method('PUT')

                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
                                        <input type="text" name="nama" value="{{ $item->nama }}" required
                                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none transition duration-200">
                                    </div>

                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Icon</label>
                                        <div class="relative">
                                            <button type="button" onclick="togglePicker('editIconPicker{{ $item->id }}')"
                                                class="flex items-center justify-between w-full border border-gray-300 rounded-lg px-4 py-2 bg-white">
                                                <i id="selectedIconEdit{{ $item->id }}"
                                                    class="{{ $item->icon }} text-indigo-600"></i>
                                                <span class="ml-2 text-gray-600">{{ $item->icon }}</span>
                                            </button>
                                            <input type="hidden" name="icon" id="iconInputEdit{{ $item->id }}"
                                                value="{{ $item->icon }}">
                                            <div id="editIconPicker{{ $item->id }}"
                                                class="hidden absolute z-50 bg-white border rounded-lg mt-2 shadow-lg p-3 grid grid-cols-8 gap-3 max-h-72 overflow-y-auto">
                                                
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="flex justify-end space-x-3 pt-4 border-t mt-4">
                                        <button type="button" onclick="closeModal('editModal{{ $item->id }}')"
                                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition">Batal</button>
                                        <button type="submit"
                                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div id="createModal" class="hidden fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-50 p-6">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center px-6 py-4 border-b bg-indigo-600 text-white rounded-t-xl">
                <h5 class="font-semibold text-lg">Tambah Kategori</h5>
                <button onclick="closeModal('createModal')" class="text-white hover:text-gray-200 text-2xl">&times;</button>
            </div>
            <form action="{{ route('kategoriAdmin.store') }}" method="POST" class="p-6">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                    <input type="text" name="nama" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none transition">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Icon</label>
                    <div class="relative">
                        <button type="button" onclick="togglePicker('createIconPicker')"
                            class="flex items-center justify-between w-full border border-gray-300 rounded-lg px-4 py-2 bg-white">
                            <i id="selectedIconCreate" class="fa-solid fa-circle text-gray-400"></i>
                            <span class="ml-2 text-gray-600">Pilih Icon</span>
                        </button>
                        <input type="hidden" name="icon" id="iconInputCreate">
                        <div id="createIconPicker"
                            class="hidden absolute z-50 bg-white border rounded-lg mt-2 shadow-lg p-3 grid grid-cols-8 gap-3 max-h-72 overflow-y-auto">
                            
                        </div>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="closeModal('createModal')"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition">Batal</button>
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    
    <script>
        function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
        function closeModal(id) { document.getElementById(id).classList.add('hidden'); }
        function togglePicker(id) { document.getElementById(id).classList.toggle('hidden'); }

        
        const icons = [
            "fa-solid fa-user", "fa-solid fa-home", "fa-solid fa-star", "fa-solid fa-heart",
            "fa-solid fa-newspaper", "fa-solid fa-book", "fa-solid fa-gear", "fa-solid fa-envelope",
            "fa-brands fa-facebook", "fa-brands fa-twitter", "fa-brands fa-youtube", "fa-brands fa-instagram",
            "fa-solid fa-camera", "fa-solid fa-calendar", "fa-solid fa-comments", "fa-solid fa-chart-line",
            "fa-solid fa-globe", "fa-solid fa-folder", "fa-solid fa-bell", "fa-solid fa-pen",
            "fa-solid fa-laptop", "fa-solid fa-graduation-cap", "fa-solid fa-city", "fa-solid fa-building",
            "fa-solid fa-shield-halved", "fa-solid fa-phone", "fa-solid fa-briefcase"
        ];

        document.addEventListener('DOMContentLoaded', () => {
           
            const createPicker = document.getElementById('createIconPicker');
            icons.forEach(icon => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'p-2 hover:bg-indigo-100 rounded';
                btn.innerHTML = `<i class="${icon} text-indigo-600 text-xl"></i>`;
                btn.onclick = () => {
                    document.getElementById('selectedIconCreate').className = icon + ' text-indigo-600';
                    document.getElementById('iconInputCreate').value = icon;
                    togglePicker('createIconPicker');
                };
                createPicker.appendChild(btn);
            });

            
            @foreach($kategori as $item)
                const editPicker{{ $item->id }} = document.getElementById('editIconPicker{{ $item->id }}');
                icons.forEach(icon => {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'p-2 hover:bg-indigo-100 rounded';
                    btn.innerHTML = `<i class="${icon} text-indigo-600 text-xl"></i>`;
                    btn.onclick = () => {
                        document.getElementById('selectedIconEdit{{ $item->id }}').className = icon + ' text-indigo-600';
                        document.getElementById('iconInputEdit{{ $item->id }}').value = icon;
                        togglePicker('editIconPicker{{ $item->id }}');
                    };
                    editPicker{{ $item->id }}.appendChild(btn);
                });
            @endforeach
            });
    </script>
@endsection