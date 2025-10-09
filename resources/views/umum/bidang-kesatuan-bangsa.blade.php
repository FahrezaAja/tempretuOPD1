@extends('layouts.app')

@section('title', 'Bidang Kesatuan Bangsa')

@section('content')

<section 
    x-data="{ show: false }"
    x-init="setTimeout(() => show = true, 200)"
    class="relative bg-gradient-to-br from-indigo-50 via-white to-indigo-100 overflow-hidden px-8 md:px-20 py-20">

    {{-- ===================== HEADER SECTION ===================== --}}
    <div class="text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-extrabold text-indigo-700 tracking-tight transition-all duration-1000"
            :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
            Bidang Politik
        </h1>
    </div>

    {{-- ===================== CONTENT SECTION ===================== --}}
    <div class="grid md:grid-cols-2 gap-10 md:gap-16 mt-12">

        {{-- TUGAS POKOK --}}
        <div class="bg-white/80 backdrop-blur-lg rounded-[30px] p-8 shadow-xl transition-all duration-1000 ease-out transform hover:scale-[1.02]"
             :class="show ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-10'">

            <h2 class="text-2xl font-bold text-indigo-700 mb-4">Tugas Pokok Bidang Kesatuan Bangsa</h2>
            <p class="text-gray-700 leading-relaxed text-lg">
                Sekretariat memiliki tugas pokok untuk melaksanakan pelayanan administratif, penyusunan program, serta pengelolaan urusan umum dan keuangan dalam mendukung pelaksanaan tugas Dinas Komunikasi dan Informatika Provinsi Papua Selatan.
            </p>
        </div>

        {{-- FUNGSI --}}
        <div class="bg-white/80 backdrop-blur-lg rounded-[30px] p-8 shadow-xl transition-all duration-1000 ease-out transform hover:scale-[1.02] delay-200"
             :class="show ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-10'">

            <h2 class="text-2xl font-bold text-indigo-700 mb-4">Fungsi Bidang Kesatuan Bangsa</h2>
            <ul class="list-disc list-inside text-gray-700 space-y-3 text-lg leading-relaxed">
                <li>Menyiapkan perumusan kebijakan teknis di bidang perencanaan, keuangan, dan kepegawaian.</li>
                <li>Melaksanakan koordinasi dan pengawasan pelaksanaan program serta kegiatan administrasi umum.</li>
                <li>Mengelola urusan tata usaha, perlengkapan, dan dokumentasi perkantoran.</li>
                <li>Menyusun laporan kinerja dan pelaksanaan kegiatan dinas secara berkala.</li>
                <li>Melaksanakan tugas lain yang diberikan oleh Kepala Dinas sesuai bidang tugasnya.</li>
            </ul>
        </div>

    </div>
</section>

@endsection
