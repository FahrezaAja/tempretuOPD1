@extends('layouts.admin')

@section('title', 'Manajemen Logo')
@section('content')
    <div class="max-w-6xl mx-auto p-6">

        <h1 class="text-3xl font-bold mb-6 text-indigo-700">Kelola Logo</h1>

        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="mb-6 p-4 rounded bg-green-100 text-green-800 shadow">
                {{ session('success') }}
            </div>
        @endif

        @if($logo)
            {{-- ================= UPDATE FORM ================= --}}
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8 transition transform hover:scale-[1.01]">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Update Logo</h2>

                <form action="{{ route('logoAdmin.update', $logo->id) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Logo (wajib png)</label>
                        <input type="file" name="image" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">

                        @error('image')
                            <p class="text-red-700 mt-2 text-sm">{{ $message }}</p>
                        @enderror
                        
                        @if($logo->image)
                            <img src="{{ asset('storage/' . $logo->image) }}" alt="Gambar"
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
                <h2 class="text-xl font-semibold mb-4 text-red-700">Hapus Logo</h2>
                <p class="mb-4 text-gray-700">Klik tombol di bawah untuk menghapus Logo ini secara permanen.</p>

                <form action="{{ route('logoAdmin.destroy', $logo->id) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus sambutan ini?');">
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
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Tambah Logo Baru</h2>

                <form action="{{ route('logoAdmin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Gambar</label>
                        <input type="file" name="image" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">

                        @error('image')
                            <p class="text-red-700 mt-2 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end pt-4 border-t mt-4">
                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg shadow-md transition duration-200">
                            Tambah Logo
                        </button>
                    </div>
                </form>
            </div>
        @endif

    </div>
@endsection