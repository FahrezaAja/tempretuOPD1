@extends('layouts.app')

@section('title', 'Kontak')

@section('content')
    <section class="px-6 md:px-20 py-20">

        <h1 class="text-4xl md:text-5xl font-extrabold text-indigo-700 mb-12 text-center">
            Kontak Kami
        </h1>


        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start justify-center">


            <div class="flex justify-center">
                <div class="w-full max-w-[550px] h-80 md:h-[420px] rounded-2xl overflow-hidden shadow-xl bg-gray-100">
                    @if($kontak && $kontak->maps_iframe)
                        {!! $kontak->maps_iframe !!}
                    @else
                        <div class="flex items-center justify-center h-full text-gray-500 italic">
                            Peta lokasi belum tersedia.
                        </div>
                    @endif
                </div>
            </div>


            <div class="flex flex-col gap-8">


                <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col items-start transition hover:scale-[1.02]">
                    <div class="flex items-center gap-3 mb-2 text-indigo-700">
                        <i class="fas fa-map-marker-alt text-2xl"></i>
                        <h2 class="text-xl font-bold">Alamat</h2>
                    </div>
                    <p class="text-gray-700 text-left leading-relaxed font-bold">
                        {{ $kontak->alamat ?? 'Belum ada alamat yang ditambahkan.' }}
                    </p>
                </div>


                <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col items-start transition hover:scale-[1.02]">
                    <div class="flex items-center gap-3 mb-2 text-indigo-700">
                        <i class="fas fa-phone-alt text-2xl"></i>
                        <h2 class="text-xl font-bold">Telepon</h2>
                    </div>
                    <p class="text-gray-700 text-left leading-relaxed font-bold">
                        {{ $kontak->telepon ?? 'Belum ada nomor telepon.' }}
                    </p>
                </div>


                <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col items-start transition hover:scale-[1.02]">
                    <div class="flex items-center gap-3 mb-2 text-indigo-700">
                        <i class="fas fa-envelope text-2xl"></i>
                        <h2 class="text-xl font-bold">Email</h2>
                    </div>
                    <p class="text-gray-700 text-left leading-relaxed font-bold">
                        {{ $kontak->email ?? 'Belum ada email yang ditambahkan.' }}
                    </p>
                </div>

            </div>
        </div>

    </section>
@endsection