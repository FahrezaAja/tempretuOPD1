@extends('layouts.app')

@section('title', 'Berita Terbaru')

@section('content')
    <section class="bg-gradient-to-br from-indigo-50 via-white to-indigo-100 py-20">
        <div class="max-w-[1600px] mx-auto px-6 lg:px-20">

            {{-- 🔹 Judul Halaman --}}
            <div class="text-center mb-16">
                <h2 class="text-5xl font-extrabold text-gray-800 mb-4">Berita Terbaru</h2>
            </div>

            {{-- ===================== DATA SEMENTARA ===================== --}}
            @php
                $berita = [
                    ['judul' => 'Lorem Ipsum', 'kategori' => 'Kategori', 'gambar' => 'https://source.unsplash.com/1200x800/?cyber,crime'],
                    ['judul' => 'Lorem Ipsum', 'kategori' => 'Kategori', 'gambar' => 'https://source.unsplash.com/1200x800/?digital,forensic'],
                    ['judul' => 'Lorem Ipsum', 'kategori' => 'Kategori', 'gambar' => 'https://source.unsplash.com/1200x800/?technology,security'],
                    ['judul' => 'Lorem Ipsum', 'kategori' => 'Kategori', 'gambar' => 'https://source.unsplash.com/1200x800/?hacker,computer'],
                    ['judul' => 'Lorem Ipsum', 'kategori' => 'Kategori', 'gambar' => 'https://source.unsplash.com/1200x800/?dfrws,conference'],
                    ['judul' => 'Lorem Ipsum', 'kategori' => 'Kategori', 'gambar' => 'https://source.unsplash.com/1200x800/?teen,online'],
                ];

                // Kategori utama dari halaman Profil OPD
                $kategoriUtama = [
                    'Agenda',
                    'Artikel',
                    'Berita',
                    'Berita Lain',
                    'Budaya',
                    'Info Umum',
                    'Informasi Masyarakat',
                    'Kesehatan',
                    'Olahraga',
                    'Pemerintahan',
                    'Potensi',
                    'Produk Hukum',
                    'SKPD',
                    'Wisata',
                ];

                // Gabungkan kategori utama + kategori berita dengan jumlah
                $kategoriBerita = collect($berita)->groupBy('kategori')->map->count();
                $kategori = collect($kategoriUtama)->mapWithKeys(function ($nama) use ($kategoriBerita) {
                    return [$nama => $kategoriBerita[$nama] ?? 0];
                });
            @endphp

            {{-- ===================== GRID UTAMA ===================== --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                {{-- === KOLOM BERITA (10/12) === --}}
                <div class="lg:col-span-10 grid sm:grid-cols-2 xl:grid-cols-3 gap-10">
                    @foreach ($berita as $item)
                        <article
                            class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-1">
                            <div class="relative overflow-hidden">
                                <img src="{{ $item['gambar'] }}" alt="{{ $item['judul'] }}"
                                    class="w-full h-72 object-cover transition-transform duration-500 hover:scale-105">
                            </div>
                            <div class="p-8">
                                <h3
                                    class="text-xl font-bold text-gray-800 mb-3 hover:text-indigo-600 transition-colors duration-300">
                                    {{ $item['judul'] }}
                                </h3>
                                <div class="flex items-center justify-between">
                                    <span
                                        class="inline-block bg-indigo-100 text-indigo-700 text-xs font-semibold px-3 py-1 rounded-full">
                                        {{ $item['kategori'] }}
                                    </span>
                                    <a href="#" class="text-indigo-600 text-sm font-semibold hover:underline">Baca Selengkapnya
                                        →</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                {{-- === KOLOM KATEGORI (2/12) === --}}
                <aside class="lg:col-span-2 bg-white rounded-3xl shadow-md p-8 h-fit self-start">
                    <h4 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Kategori</h4>
                    <ul class="space-y-4">
                        @foreach ($kategori as $nama => $jumlah)
                            <li>
                                <a href="#"
                                    class="flex justify-between items-center text-gray-700 hover:text-indigo-600 font-medium transition">
                                    <span>{{ $nama }}</span>
                                    <span class="text-sm bg-indigo-50 text-indigo-700 font-semibold px-2 py-0.5 rounded-md">
                                        {{ $jumlah }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </aside>

            </div>
        </div>
    </section>
@endsection