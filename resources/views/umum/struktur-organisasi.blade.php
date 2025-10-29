@extends('layouts.app')

@section('title', 'Struktur Organisasi')

@section('content')

    <section x-data="{ show: false }" x-init="setTimeout(() => show = true, 200)"
        class="relative min-h-screen overflow-hidden flex flex-col items-center justify-center px-6 md:px-16 py-20">

        
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-extrabold text-indigo-700 tracking-tight transition-all duration-1000"
                :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                Struktur Organisasi
            </h1>
        </div>

        
        <div class="relative w-full flex justify-center transition-all duration-1000 ease-out transform"
            :class="show ? 'opacity-100 scale-100' : 'opacity-0 scale-95'">

            <div
                class="rounded-[30px] overflow-hidden shadow-xl bg-white/90 backdrop-blur-md p-6 md:p-8 w-full max-w-[70rem]">
                @if ($strukturorganisasi && $strukturorganisasi->image)
                    
                    <img src="{{ asset('storage/' . $strukturorganisasi->image) }}" alt="Struktur Organisasi"
                        class="w-full h-auto object-contain rounded-[20px] transition-transform duration-700">
                @else
                    
                    <div class="text-center text-gray-600 py-20">
                        <p class="text-xl">Belum ada data struktur organisasi.</p>
                    </div>
                @endif
            </div>
        </div>

    </section>

@endsection