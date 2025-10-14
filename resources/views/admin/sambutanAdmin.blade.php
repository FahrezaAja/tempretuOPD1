@extends('layouts.admin')

@section('title', 'Manajemen Sambutan')
@section('page-title', 'Manajemen Sambutan')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Kelola Kata Sambutan</h2>

        @if ($katasambutan)
            {{-- Jika data sudah ada --}}
            <form action="{{ route('katasambutan.update', $katasambutan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                    <input type="text" name="judul" value="{{ $katasambutan->judul }}" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama OPD</label>
                    <input type="text" name="nama_opd" value="{{ $katasambutan->nama_opd }}" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kepala Badan</label>
                    <input type="text" name="nama_kepala_badan" value="{{ $katasambutan->nama_kepala_badan }}" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea id="description" name="deskripsi" rows="6"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none"
                        required>{{ $katasambutan->deskripsi }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                    <input type="file" name="image"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                    @if ($katasambutan->image)
                        <div class="mt-3">
                            <p class="text-sm text-gray-600">Foto saat ini:</p>
                            <img src="{{ asset('storage/' . $katasambutan->image) }}" class="h-32 w-32 object-cover rounded-lg border mt-1">
                        </div>
                    @endif
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <form action="{{ route('katasambutan.destroy', $katasambutan->id) }}" method="POST" class="inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                            class="btn-delete bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition duration-200">
                            Hapus
                        </button>
                    </form>

                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition duration-200">
                        Update
                    </button>
                </div>
            </form>

        @else
            {{-- Jika data belum ada --}}
            <form action="{{ route('katasambutan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                    <input type="text" name="judul" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama OPD</label>
                    <input type="text" name="nama_opd" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kepala Badan</label>
                    <input type="text" name="nama_kepala_badan" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea id="description" name="deskripsi" rows="6" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                    <input type="file" name="image"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-200">
                        Tambah Sambutan
                    </button>
                </div>
            </form>
        @endif
    </div>

    {{-- Preview Hasil --}}
    @if ($katasambutan)
        <div class="mt-8 bg-gray-50 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-3">Preview Sambutan</h3>
            <div class="border-t border-gray-200 pt-4">
                <h4 class="text-2xl font-bold mb-2">{{ $katasambutan->judul }}</h4>
                <p class="text-sm text-gray-600 mb-2"><strong>Nama OPD:</strong> {{ $katasambutan->nama_opd }}</p>
                <p class="text-sm text-gray-600 mb-4"><strong>Kepala Badan:</strong> {{ $katasambutan->nama_kepala_badan }}</p>
                <div class="prose max-w-none">{!! $katasambutan->deskripsi !!}</div>
                @if ($katasambutan->image)
                    <div class="mt-4">
                        <img src="{{ asset('storage/' . $katasambutan->image) }}" class="rounded-lg shadow max-w-sm">
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>

{{-- CKEditor --}}
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('description', { height: 200 });

    // Hapus konfirmasi
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function() {
            if (confirm('Yakin ingin menghapus sambutan? Data akan dikosongkan.')) {
                this.closest('form').submit();
            }
        });
    });
</script>
@endsection
