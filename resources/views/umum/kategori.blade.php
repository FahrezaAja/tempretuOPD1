@extends('layouts.app')

@section('title', 'Kategori')
@section('page-title', 'Kategori')

@section('content')
    @php
        use Illuminate\Support\Str;
    @endphp

    <section class="py-20">
        <div class="max-w-[1600px] mx-auto px-6 lg:px-20">


            <div class="text-center mb-16">
                <h2 class="text-5xl font-extrabold text-gray-800 mb-4">Kategori Informasi</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Pilih kategori untuk melihat berita terbaru sesuai kategori.
                </p>
            </div>

            {{-- ===================== GRID KATEGORI ===================== --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">

                <article
                    class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-1">
                    <div class="flex flex-col items-center justify-center p-10 text-center">
                        <i class="fa-solid fa-folder text-5xl text-indigo-600 mb-5"></i>
                        <h3
                            class="text-xl font-bold text-gray-800 mb-2 hover:text-indigo-600 transition-colors duration-300">
                            <a href="{{ route('berita-terbaru') }}">Semua Berita</a>
                        </h3>
                    </div>
                </article>


                @forelse ($kategori as $item)
                    @php
                        $ikon = $item->ikon ?? $item->icon ?? 'fa-solid fa-folder';
                        if (!Str::contains($ikon, 'fa-solid') && !Str::contains($ikon, 'fa-regular') && !Str::contains($ikon, 'fa-brands')) {
                            $ikon = 'fa-solid ' . $ikon;
                        }
                    @endphp

                    <article
                        class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-1">
                        <div class="flex flex-col items-center justify-center p-10 text-center">
                            <i class="{{ $ikon }} text-5xl text-indigo-600 mb-5"></i>
                            <h3
                                class="text-xl font-bold text-gray-800 mb-2 hover:text-indigo-600 transition-colors duration-300">
                                <a href="{{ route('berita-terbaru', ['kategori' => $item->nama]) }}">
                                    {{ $item->nama }}
                                </a>
                            </h3>
                        </div>
                    </article>
                @empty
                    <p class="text-center text-gray-500 col-span-4">Belum ada kategori.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection