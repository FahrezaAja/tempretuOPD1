@extends('layouts.admin')

@section('title', 'Manajemen Bidang Politik')
@section('content')
    <div class="max-w-6xl mx-auto p-6">

        <h1 class="text-3xl font-bold mb-6 text-indigo-700">Kelola Bidang Politik</h1>

        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="mb-6 p-4 rounded bg-green-100 text-green-800 shadow">
                {{ session('success') }}
            </div>
        @endif

        @if($bidangpolitik)
            {{-- ================= UPDATE FORM ================= --}}
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8 transition transform hover:scale-[1.01]">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Update Bidang Politik</h2>

                <form action="{{ route('bidangPolitikAdmin.update', $bidangpolitik->id) }}" method="POST"
                    enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Tugas Pokok</label>
                        <textarea id="tugaspokok_edit" name="tugas_pokok" rows="6" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">{{ old('tugas_pokok', $bidangpolitik->tugas_pokok) }}</textarea>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Fungsi</label>
                        <textarea id="fungsi_edit" name="fungsi" rows="6" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">{{ old('deskripsi', $bidangpolitik->fungsi) }}</textarea>
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
                <h2 class="text-xl font-semibold mb-4 text-red-700">Hapus Bidang Politik</h2>
                <p class="mb-4 text-gray-700">Klik tombol di bawah untuk menghapus Bidang Politik ini secara permanen.</p>

                <form action="{{ route('bidangPolitikAdmin.destroy', $bidangpolitik->id) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus Bidang Politik?');">
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
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Tambah Bidang Politik Baru</h2>

                <form action="{{ route('bidangPolitikAdmin.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-5">
                    @csrf

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Tugas Pokok</label>
                        <textarea id="tugaspokok_create" name="tugas_pokok" rows="6" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none"></textarea>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Fungsi</label>
                        <textarea id="fungsi_create" name="fungsi" rows="6" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none"></textarea>
                    </div>

                    <div class="flex justify-end pt-4 border-t mt-4">
                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg shadow-md transition duration-200">
                            Tambah Bidang Politik
                        </button>
                    </div>
                </form>
            </div>
        @endif

    </div>

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (document.getElementById("tugaspokok_create")) {
                CKEDITOR.replace("tugaspokok_create", { height: 200 });
            }

            if (document.getElementById("fungsi_create")) {
                CKEDITOR.replace("fungsi_create", { height: 200 });
            }

            if (document.querySelector('[id="tugaspokok_edit"]')) {
                CKEDITOR.replace("tugaspokok_edit", { height: 200 });
            }

            if (document.querySelector('[id="fungsi_edit"]')) {
                CKEDITOR.replace("fungsi_edit", { height: 200 });
            }
        });
    </script>
@endsection