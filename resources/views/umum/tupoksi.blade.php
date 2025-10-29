@extends('layouts.app')

@section('title', 'Tugas Pokok dan Fungsi')

@section('content')

    <section x-data="{ show: false }" x-init="setTimeout(() => show = true, 200)"
        class="relative min-h-screen overflow-hidden">


        <div class="relative flex flex-col items-center justify-center text-center py-24 md:py-32 overflow-hidden">
            <h1 class="text-5xl md:text-6xl font-extrabold text-indigo-700 tracking-tight transition-all duration-1000"
                :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                Tugas Pokok & Fungsi
            </h1>
        </div>


        <div class="max-w-7xl mx-auto px-8 md:px-16 py-20">
            <div class="grid md:grid-cols-2 gap-10 md:gap-16">


                <div class="bg-white/70 backdrop-blur-lg shadow-xl rounded-[40px] p-10 md:p-14 transition-all duration-1000 ease-out transform"
                    :class="show ? 'opacity-100 -translate-x-0' : 'opacity-0 -translate-x-10'">
                    <h2 class="text-3xl font-bold text-indigo-700 mb-6">Tugas Pokok</h2>
                    <div class="text-lg text-gray-700 leading-relaxed ck-content">
                        {!! $tupoksi->tugas_pokok ?? 'Belum ada data tugas pokok.' !!}
                    </div>
                </div>


                <div class="bg-indigo-700 text-white shadow-xl rounded-[40px] p-10 md:p-14 transition-all duration-1000 ease-out transform delay-200"
                    :class="show ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-10'">
                    <h2 class="text-3xl font-bold mb-6">Fungsi</h2>
                    <div class="text-indigo-100 text-lg leading-relaxed ck-content">
                        {!! $tupoksi->fungsi ?? 'Belum ada data fungsi.' !!}
                    </div>
                </div>

            </div>
        </div>

    </section>

@endsection