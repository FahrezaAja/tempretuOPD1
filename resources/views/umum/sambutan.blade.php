@extends('layouts.app')

@section('title', 'Sambutan')

@section('content')

<section 
    x-data="{ show: false }" 
    x-init="setTimeout(() => show = true, 200)" 
    class="relative min-h-screen flex flex-col md:flex-row items-center justify-between overflow-hidden">

    {{-- Background --}}
    <div class="absolute inset-0 z-0"></div>

    {{-- Kolom Gambar --}}
    <div 
        class="relative w-full md:w-1/2 flex justify-center items-center py-16 z-10
               transition-all duration-1000 ease-out transform"
        :class="show 
            ? 'opacity-100 translate-x-0' 
            : 'opacity-0 -translate-x-20'">
        
        <div class="relative z-10 overflow-hidden rounded-[40px] shadow-2xl">
            <img src="{{ asset('images/depan-kanan-orang.jpg') }}" 
                 alt="Kepala Badan"
                 class="object-cover w-[300px] md:w-[400px] lg:w-[450px] rounded-[40px]
                        transition-all duration-1000 ease-out transform"
                 :class="show ? 'scale-100' : 'scale-90 opacity-0'">
        </div>
    </div>

    {{-- Kolom Teks Sambutan --}}
    <div 
        class="relative w-full md:w-1/2 text-gray-800 px-8 md:px-16 py-20 space-y-6 z-10
               transition-all duration-1000 ease-out transform delay-300"
        :class="show 
            ? 'opacity-100 translate-x-0' 
            : 'opacity-0 translate-x-20'">

        <h1 class="text-4xl md:text-5xl font-extrabold leading-tight text-indigo-700">
            Lorem Ipsum
        </h1>

        <p class="text-lg leading-relaxed text-gray-600">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur deleniti architecto minima ex. Inventore maiores ipsam voluptatem omnis, veniam, nemo quis pariatur totam nobis porro deserunt consequuntur ab, doloribus quas?
        </p>

        <div class="pt-4">
            <p class="font-bold text-lg text-indigo-700">Nama OPD</p>
            <p class="text-sm text-gray-500">Nama Kepala Badan</p>
        </div>
    </div>

</section>

{{-- Optional: efek parallax lembut --}}
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('sambutanParallax', () => ({
            offsetY: 0,
            init() {
                window.addEventListener('scroll', () => {
                    this.offsetY = window.scrollY * 0.3;
                });
            }
        }));
    });
</script>

@endsection
