@extends('layouts.app')

@section('title', 'Bidang Politik')

@section('content')

    <section x-data="{ show: false }" x-init="setTimeout(() => show = true, 200)"
        class="relative overflow-hidden px-8 md:px-20 py-20">

        {{-- ===================== HEADER SECTION ===================== --}}
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-extrabold text-indigo-700 tracking-tight transition-all duration-1000"
                :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                Bidang Politik
            </h1>
        </div>

        {{-- ===================== CONTENT SECTION ===================== --}}
        <div class="grid md:grid-cols-2 gap-10 md:gap-16 mt-12">


            <div class="bg-white/80 backdrop-blur-lg rounded-[30px] p-8 shadow-xl transition-all duration-1000 ease-out transform hover:scale-[1.02]"
                :class="show ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-10'">

                <h2 class="text-2xl font-bold text-indigo-700 mb-4">Tugas Pokok Bidang Politik</h2>
                <div class="text-gray-700 leading-relaxed text-lg ck-content">
                    {!! $bidangpolitik->tugas_pokok ?? 'Belum ada tugas pokok.' !!}
                </div>
            </div>


            <div class="bg-white/80 backdrop-blur-lg rounded-[30px] p-8 shadow-xl transition-all duration-1000 ease-out transform hover:scale-[1.02] delay-200 ck-content"
                :class="show ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-10'">

                <h2 class="text-2xl font-bold text-indigo-700 mb-4">Fungsi Bidang Politik</h2>
                {!! $bidangpolitik->fungsi ?? 'Belum ada fungsi.' !!}
            </div>

        </div>
    </section>

@endsection