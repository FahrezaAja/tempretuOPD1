@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="min-h-screen flex flex-col">

        {{-- Selamat datang --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Selamat datang, {{ Auth::user()->username }}</h1>
            <p class="text-gray-600 mt-2">Ini adalah dashboard admin Anda. Gunakan aksi cepat di bawah untuk mengelola
                konten utama.</p>
        </div>

        {{-- Statistik Berita --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
            <div
                class="bg-indigo-600 text-white rounded-2xl p-5 flex flex-col items-center justify-center shadow-lg transform transition hover:-translate-y-1 hover:shadow-2xl">
                <i class="fas fa-newspaper text-3xl mb-2"></i>
                <span class="text-lg font-semibold">Total Berita</span>
                <span class="text-2xl font-bold mt-1">{{ $totalBerita }}</span>
            </div>

            <div
                class="bg-green-600 text-white rounded-2xl p-5 flex flex-col items-center justify-center shadow-lg transform transition hover:-translate-y-1 hover:shadow-2xl">
                <i class="fas fa-file-alt text-3xl mb-2"></i>
                <span class="text-lg font-semibold">Berita Biasa</span>
                <span class="text-2xl font-bold mt-1">{{ $beritaBiasa }}</span>
            </div>

            <div
                class="bg-yellow-500 text-white rounded-2xl p-5 flex flex-col items-center justify-center shadow-lg transform transition hover:-translate-y-1 hover:shadow-2xl">
                <i class="fas fa-star text-3xl mb-2"></i>
                <span class="text-lg font-semibold">Berita Unggulan</span>
                <span class="text-2xl font-bold mt-1">{{ $beritaUnggulan }}</span>
            </div>
        </div>

        
        <div class="mb-4">
            <h2 class="text-2xl font-semibold text-gray-700 uppercase">Aksi Cepat</h2>
            <hr class="mt-2 border-gray-300">
        </div>

        {{-- Quick Action Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <a href="{{ route('admin.programKegiatanAdmin') }}"
                class="bg-gray-800 hover:bg-gray-700 text-white rounded-lg p-6 flex flex-col items-center justify-center shadow-lg transition transform hover:-translate-y-1">
                <i class="fas fa-file-alt text-4xl mb-3"></i>
                <span class="text-lg font-semibold">Program Kegiatan</span>
            </a>

            <a href="{{ route('admin.produkHukumAdmin') }}"
                class="bg-gray-800 hover:bg-gray-700 text-white rounded-lg p-6 flex flex-col items-center justify-center shadow-lg transition transform hover:-translate-y-1">
                <i class="fas fa-gavel text-4xl mb-3"></i>
                <span class="text-lg font-semibold">Produk Hukum</span>
            </a>

            <a href="{{ route('admin.beritaAdmin') }}"
                class="bg-gray-800 hover:bg-gray-700 text-white rounded-lg p-6 flex flex-col items-center justify-center shadow-lg transition transform hover:-translate-y-1">
                <i class="fas fa-newspaper text-4xl mb-3"></i>
                <span class="text-lg font-semibold">Berita Terbaru</span>
            </a>

            <a href="{{ route('admin.kategoriAdmin') }}"
                class="bg-gray-800 hover:bg-gray-700 text-white rounded-lg p-6 flex flex-col items-center justify-center shadow-lg transition transform hover:-translate-y-1">
                <i class="fas fa-list text-4xl mb-3"></i>
                <span class="text-lg font-semibold">Kategori</span>
            </a>

            <a href="{{ route('admin.galeriVideoAdmin') }}"
                class="bg-gray-800 hover:bg-gray-700 text-white rounded-lg p-6 flex flex-col items-center justify-center shadow-lg transition transform hover:-translate-y-1">
                <i class="fas fa-video text-4xl mb-3"></i>
                <span class="text-lg font-semibold">Galeri Video</span>
            </a>

            <a href="{{ route('admin.galeriFotoAdmin') }}"
                class="bg-gray-800 hover:bg-gray-700 text-white rounded-lg p-6 flex flex-col items-center justify-center shadow-lg transition transform hover:-translate-y-1">
                <i class="fas fa-photo-video text-4xl mb-3"></i>
                <span class="text-lg font-semibold">Galeri Foto</span>
            </a>
        </div>
    </div>
@endsection