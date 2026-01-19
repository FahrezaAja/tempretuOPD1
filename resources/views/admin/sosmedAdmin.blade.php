@extends('layouts.admin')

@section('title', 'Manajemen Sosial Media')
@section('content')
    <div class="max-w-5xl mx-auto p-6">

        <h1 class="text-3xl font-bold mb-6 text-indigo-700">Kelola Link Sosial Media</h1>

        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="mb-6 p-4 rounded bg-green-100 text-green-800 shadow">
                {{ session('success') }}
            </div>
        @endif

        @if($sosmed)
            {{-- ================= UPDATE FORM ================= --}}
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8 transition transform hover:scale-[1.01]">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Update Link Sosial Media</h2>

                <form action="{{ route('admin.sosmedAdmin.update', $sosmed->id) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Facebook</label>
                        <input type="url" name="facebook" value="{{ old('facebook', $sosmed->facebook) }}"
                            placeholder="https://facebook.com/username"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Instagram</label>
                        <input type="url" name="instagram" value="{{ old('instagram', $sosmed->instagram) }}"
                            placeholder="https://instagram.com/username"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">TikTok</label>
                        <input type="url" name="tiktok" value="{{ old('tiktok', $sosmed->tiktok) }}"
                            placeholder="https://tiktok.com/@username"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">YouTube</label>
                        <input type="url" name="youtube" value="{{ old('youtube', $sosmed->youtube) }}"
                            placeholder="https://youtube.com/@username"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
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
                <h2 class="text-xl font-semibold mb-4 text-red-700">Hapus Data Sosial Media</h2>
                <p class="mb-4 text-gray-700">Klik tombol di bawah untuk menghapus semua link sosial media.</p>

                <form action="{{ route('admin.sosmedAdmin.destroy', $sosmed->id) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus semua link sosial media ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg shadow-md transition duration-200">
                        Hapus
                    </button>
                </form>
            </div>

        @else
            {{-- ================= TAMBAH BARU ================= --}}
            <div class="bg-white rounded-xl shadow-lg p-6 transition transform hover:scale-[1.01]">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Tambah Link Sosial Media</h2>

                <form action="{{ route('admin.sosmedAdmin.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Facebook</label>
                        <input type="url" name="facebook" placeholder="https://facebook.com/username"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Instagram</label>
                        <input type="url" name="instagram" placeholder="https://instagram.com/username"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">TikTok</label>
                        <input type="url" name="tiktok" placeholder="https://tiktok.com/@username"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">YouTube</label>
                        <input type="url" name="youtube" placeholder="https://youtube.com/@username"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>

                    <div class="flex justify-end pt-4 border-t mt-4">
                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg shadow-md transition duration-200">
                            Tambah Link
                        </button>
                    </div>
                </form>
            </div>
        @endif

    </div>
@endsection