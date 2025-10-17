@extends('layouts.app')

@section('title', 'Kategori')
@section('page-title', 'Kategori')

@section('content')
    <section class="bg-gradient-to-br from-indigo-50 via-white to-indigo-100 py-20">
        <div class="max-w-[1600px] mx-auto px-6 lg:px-20">

            {{-- 🔹 Judul Halaman --}}
            <div class="text-center mb-16">
                <h2 class="text-5xl font-extrabold text-gray-800 mb-4">Profil Badan OPD</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Kategori informasi dan konten terkait aktivitas, potensi, serta kebijakan OPD.
                </p>
            </div>

            {{-- ===================== GRID KATEGORI ===================== --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">

                @php
                    $kategori = [
                        ['ikon' => 'fa-briefcase', 'judul' => 'Agenda'],
                        ['ikon' => 'fa-newspaper', 'judul' => 'Artikel'],
                        ['ikon' => 'fa-wifi', 'judul' => 'Berita'],
                        ['ikon' => 'fa-binoculars', 'judul' => 'Berita Lain'],
                        ['ikon' => 'fa-dove', 'judul' => 'Budaya'],
                        ['ikon' => 'fa-bell', 'judul' => 'Info Umum'],
                        ['ikon' => 'fa-bullhorn', 'judul' => 'Informasi Masyarakat'],
                        ['ikon' => 'fa-heart-pulse', 'judul' => 'Kesehatan'],
                        ['ikon' => 'fa-volleyball', 'judul' => 'Olahraga'],
                        ['ikon' => 'fa-building', 'judul' => 'Pemerintahan'],
                        ['ikon' => 'fa-medal', 'judul' => 'Potensi'],
                        ['ikon' => 'fa-scale-balanced', 'judul' => 'Produk Hukum'],
                        ['ikon' => 'fa-building-wheat', 'judul' => 'SKPD'],
                        ['ikon' => 'fa-umbrella-beach', 'judul' => 'Wisata'],
                    ];
                @endphp

                @foreach ($kategori as $item)
                    <article
                        class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-1">
                        <div class="flex flex-col items-center justify-center p-10 text-center">
                            <i class="fa-solid {{ $item['ikon'] }} text-5xl text-indigo-600 mb-5"></i>
                            <h3
                                class="text-xl font-bold text-gray-800 mb-2 hover:text-indigo-600 transition-colors duration-300">
                                <a href="#">{{ $item['judul'] }}</a>
                            </h3>
                        </div>
                    </article>
                @endforeach

            </div>
        </div>
    </section>
@endsection