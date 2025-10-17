@extends('layouts.admin')

@section('title', 'Manajemen Profil OPD')
@section('content')
    <div class="max-w-6xl mx-auto p-6">

        <h1 class="text-3xl font-bold mb-6 text-indigo-700">Kelola Profil OPD</h1>

        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="mb-6 p-4 rounded bg-green-100 text-green-800 shadow">
                {{ session('success') }}
            </div>
        @endif

        @if($profilopd)
            {{-- ================= UPDATE FORM ================= --}}
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8 transition transform hover:scale-[1.01]">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Update Profil OPD</h2>

                <form action="{{ route('profilOPDAdmin.update', $profilopd->id) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Nama OPD</label>
                        <input type="text" name="nama_opd" value="{{ old('nama_opd', $profilopd->nama_opd) }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea id="description_edit" name="deskripsi" rows="6" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">{{ old('deskripsi', $profilopd->deskripsi) }}</textarea>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Visi</label>
                        <textarea id="visi_edit" name="visi" rows="6" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">{{ old('visi', $profilopd->visi) }}</textarea>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Misi</label>
                        <textarea id="misi_edit" name="misi" rows="6" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">{{ old('misi', $profilopd->misi) }}</textarea>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Gambar</label>
                        <input type="file" name="image"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                        @if($profilopd->image)
                            <img src="{{ asset('storage/' . $profilopd->image) }}" alt="Gambar"
                                class="mt-3 w-48 h-48 object-cover rounded-lg shadow-md border">
                        @endif
                    </div>

                    <div class="flex justify-end gap-4 pt-4 border-t mt-4">
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg shadow-md transition duration-200">
                            Update
                        </button>
                    </div>
                </form>
            </div>

            {{-- ================= DELETE FORM ================= --}}
            <div class="bg-red-50 rounded-xl shadow-lg p-6 transition transform hover:scale-[1.01]">
                <h2 class="text-xl font-semibold mb-4 text-red-700">Hapus Profil OPD</h2>
                <p class="mb-4 text-gray-700">Klik tombol di bawah untuk menghapus Profil OPD ini secara permanen.</p>

                <form action="{{ route('profilOPDAdmin.destroy', $profilopd->id) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus Profil OPD?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg shadow-md transition duration-200">
                        Hapus
                    </button>
                </form>
            </div>

        @else
            {{-- ================= FORM TAMBAH ================= --}}
            <div class="bg-white rounded-xl shadow-lg p-6 transition transform hover:scale-[1.01]">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Tambah Profil OPD Baru</h2>

                <form action="{{ route('profilOPDAdmin.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-5">
                    @csrf

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Nama OPD</label>
                        <input type="text" name="nama_opd" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea id="description_create" name="deskripsi" rows="6" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none"></textarea>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Visi</label>
                        <textarea id="visi_create" name="visi" rows="6" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none"></textarea>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Misi</label>
                        <textarea id="misi_create" name="misi" rows="6" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none"></textarea>
                    </div>


                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Gambar</label>
                        <input type="file" name="image"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>

                    <div class="flex justify-end pt-4 border-t mt-4">
                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg shadow-md transition duration-200">
                            Tambah Profil OPD
                        </button>
                    </div>
                </form>
            </div>
        @endif

    </div>

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (document.getElementById("description_create")) {
                CKEDITOR.replace("description_create", { height: 200 });
            }

            if (document.getElementById("visi_create")) {
                CKEDITOR.replace("visi_create", { height: 200 });
            }

            if (document.getElementById("misi_create")) {
                CKEDITOR.replace("misi_create", { height: 200 });
            }

            if (document.querySelector('[id="description_edit"]')) {
                CKEDITOR.replace("description_edit", { height: 200 });
            }

            if (document.querySelector('[id="visi_edit"]')) {
                CKEDITOR.replace("visi_edit", { height: 200 });
            }

            if (document.querySelector('[id="misi_edit"]')) {
                CKEDITOR.replace("misi_edit", { height: 200 });
            }
        });
    </script>
@endsection