@extends('layouts.app')

@section('title', 'Sambutan')

@section('content')

<section x-data="{ show: false }" 
    x-init="setTimeout(() => show = true, 200)"
    class="relative min-h-screen flex flex-col md:flex-row items-start justify-between overflow-hidden">

    
    <div class="relative w-full md:w-1/2 flex justify-center md:justify-end items-start py-16 md:py-24 z-10
                   transition-all duration-1000 ease-out transform" 
         :class="show 
                ? 'opacity-100 translate-x-0' 
                : 'opacity-0 -translate-x-20'">

        <div class="relative z-10 overflow-hidden rounded-[40px] shadow-2xl md:mt-4">
            <img src="{{ $katasambutan?->image ? asset('storage/' . $katasambutan->image) : asset('images/depan-kanan-orang.jpg') }}"
                alt="Kepala Badan"
                class="object-cover w-[300px] md:w-[400px] lg:w-[450px] rounded-[40px] transition-all duration-1000 ease-out transform"
                :class="show ? 'scale-100' : 'scale-90 opacity-0'">
        </div>
    </div>

    
    <div class="relative w-full md:w-1/2 text-gray-800 px-8 md:px-16 py-10 md:py-24 space-y-6 z-10
                   transition-all duration-1000 ease-out transform delay-300" 
         :class="show 
                ? 'opacity-100 translate-x-0' 
                : 'opacity-0 translate-x-20'">

        <h1 class="text-4xl md:text-5xl font-extrabold leading-tight text-indigo-700">
            {{ $katasambutan?->judul ?? 'Kata Sambutan' }}
        </h1>

        <div class="text-lg leading-relaxed text-gray-600 ck-content">
            {!! $katasambutan?->deskripsi ?? 'Deskripsi sambutan belum tersedia.' !!}
        </div>

        <div class="pt-4">
            <p class="font-bold text-lg text-indigo-700">Kepala {{ $katasambutan?->nama_opd ?? 'Nama OPD' }}</p>
            <p class="text-sm text-gray-500">{{ $katasambutan?->nama_kepala_badan ?? '-' }}</p>
        </div>
    </div>
</section>

@endsection
