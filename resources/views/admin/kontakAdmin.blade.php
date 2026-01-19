@extends('layouts.admin')

@section('title', 'Manajemen Kontak')
@section('content')
    <div class="max-w-6xl mx-auto p-6">

        <h1 class="text-3xl font-bold mb-6 text-indigo-700">Kelola Kontak</h1>

        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="mb-6 p-4 rounded bg-green-100 text-green-800 shadow">
                {{ session('success') }}
            </div>
        @endif

        @if($kontak)
            {{-- ================= UPDATE FORM ================= --}}
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8 transition transform hover:scale-[1.01]">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Update Kontak</h2>

                <form action="{{ route('admin.kontakAdmin.update', $kontak->id) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Google Maps Iframe</label>
                        <textarea name="maps_iframe" rows="5" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none"
                            placeholder="Tempelkan kode iframe Google Maps di sini">{{ old('maps_iframe', $kontak->maps_iframe) }}</textarea>
                        <p class="text-sm text-gray-500 mt-1">Salin kode <code>&lt;iframe&gt;</code> dari Google Maps dan tempel
                            di sini.</p>

                        @if($kontak->maps_iframe)
                            <div>
                                {!! $kontak->maps_iframe !!}
                            </div>
                        @endif
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Alamat</label>
                        <input type="text" name="alamat" value="{{ old('alamat', $kontak->alamat) }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Telepon</label>
                        <input type="text" name="telepon" value="{{ old('telepon', $kontak->telepon) }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $kontak->email) }}" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>

                    <div class="flex justify-end gap-4 pt-4 border-t mt-4">
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg shadow-md transition duration-200">
                            Update Kontak
                        </button>
                    </div>
                </form>
            </div>

            {{-- ================= DELETE FORM ================= --}}
            <div class="bg-red-50 rounded-xl shadow-lg p-6 transition transform hover:scale-[1.01]">
                <h2 class="text-xl font-semibold mb-4 text-red-700">Hapus Data Kontak</h2>
                <p class="mb-4 text-gray-700">Klik tombol di bawah untuk menghapus data kontak secara permanen.</p>

                <form action="{{ route('admin.kontakAdmin.destroy', $kontak->id) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus data kontak ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg shadow-md transition duration-200">
                        Hapus Kontak
                    </button>
                </form>
            </div>

        @else
            {{-- ================= FORM TAMBAH ================= --}}
            <div class="bg-white rounded-xl shadow-lg p-6 transition transform hover:scale-[1.01]">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Tambah Kontak Baru</h2>

                <form action="{{ route('admin.kontakAdmin.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Google Maps Iframe</label>
                        <textarea name="maps_iframe" rows="5" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none"
                            placeholder="Tempelkan kode iframe Google Maps di sini">{{ old('maps_iframe') }}</textarea>
                        <p class="text-sm text-gray-500 mt-1">Salin kode <code>&lt;iframe&gt;</code> dari Google Maps dan tempel
                            di sini.</p>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Alamat</label>
                        <input type="text" name="alamat" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Telepon</label>
                        <input type="text" name="telepon" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>

                    <div class="flex justify-end pt-4 border-t mt-4">
                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg shadow-md transition duration-200">
                            Simpan Kontak
                        </button>
                    </div>
                </form>
            </div>
        @endif

    </div>
@endsection