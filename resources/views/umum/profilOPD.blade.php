@extends('layouts.app')

@section('title', 'Profil OPD')

@section('content')

<section 
    x-data="{ show: false }"
    x-init="setTimeout(() => show = true, 200)"
    class="relative bg-gradient-to-br from-indigo-50 via-white to-indigo-100 overflow-hidden">

    {{-- ===================== HERO SECTION ===================== --}}
    <div class="relative flex flex-col items-center justify-center text-center py-24 md:py-32 overflow-hidden">

        <h1 class="text-5xl md:text-6xl font-extrabold text-indigo-700 tracking-tight transition-all duration-1000"
             :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
            Profil Organisasi Perangkat Daerah
        </h1>
    </div>

    {{-- ===================== ABOUT SECTION ===================== --}}
    <div class="relative flex flex-col md:flex-row items-center justify-between px-8 md:px-20 py-16 space-y-10 md:space-y-0 md:space-x-12">

        {{-- Gambar Ilustrasi --}}
        <div class="w-full md:w-1/2 flex justify-center transition-all duration-1000 ease-out transform"
             :class="show ? 'opacity-100 -translate-y-0' : 'opacity-0 translate-y-10'">
            <div class="relative w-[420x] md:w-[520px] lg:w-[600px]  rounded-[40px] overflow-hidden shadow-2xl">
                <img src="{{ asset('images/gedung.jpg') }}" 
                     alt="Gedung OPD" 
                     class="object-cover w-full h-full scale-100 transition-transform duration-700 hover:scale-105">
            </div>
        </div>

        {{-- Tentang OPD --}}
        <div class="w-full md:w-1/2 text-gray-700 leading-relaxed transition-all duration-1000 ease-out transform delay-200"
             :class="show ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-10'">

            <h2 class="text-3xl font-bold text-indigo-700 mb-4">Tentang Badan OPD</h2>
            <p class="text-lg text-gray-600 mb-4">
                Dinas Komunikasi dan Informatika Provinsi Papua Selatan memiliki peran strategis dalam pengelolaan sistem informasi,
                komunikasi publik, serta pengembangan teknologi digital yang menunjang tata kelola pemerintahan daerah yang transparan dan inovatif.
            </p>
            <p class="text-lg text-gray-600">
                Kami berkomitmen untuk menghadirkan layanan informasi publik yang cepat, akurat, dan terpercaya melalui transformasi digital
                yang berkesinambungan, serta mendukung visi pembangunan daerah berbasis data dan kolaborasi.
            </p>
        </div>
    </div>

    {{-- ===================== VISI MISI SECTION ===================== --}}
    <div class="relative bg-indigo-700 text-white py-20 px-8 md:px-24 rounded-t-[60px] mt-10 shadow-inner">

        <div class="text-center mb-12">
            <h2 class="text-4xl font-extrabold mb-4 transition-all duration-1000"
                :class="show ? 'opacity-100 scale-100' : 'opacity-0 scale-90'">
                Visi & Misi
            </h2>
        </div>

        <div class="grid md:grid-cols-2 gap-10 mt-12">

            {{-- VISI --}}
            <div class="bg-white/10 backdrop-blur-lg p-8 rounded-[30px] shadow-xl transition-all duration-1000 ease-out transform hover:scale-[1.03]"
                 :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                <h3 class="text-2xl font-bold mb-4 text-white">Visi</h3>
                <p class="text-indigo-100 text-lg leading-relaxed">
                    “Terwujudnya sistem komunikasi dan informasi publik yang cerdas, transparan, serta mendukung Papua Selatan sebagai provinsi digital yang berdaya saing.”
                </p>
            </div>

            {{-- MISI --}}
            <div class="bg-white/10 backdrop-blur-lg p-8 rounded-[30px] shadow-xl transition-all duration-1000 ease-out transform delay-200 hover:scale-[1.03]"
                 :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                <h3 class="text-2xl font-bold mb-4 text-white">Misi</h3>
                <ul class="list-disc list-inside text-indigo-100 space-y-3 text-lg">
                    <li>Meningkatkan tata kelola teknologi informasi yang terintegrasi.</li>
                    <li>Mendorong literasi digital masyarakat dan aparatur daerah.</li>
                    <li>Mewujudkan komunikasi publik yang efektif dan transparan.</li>
                    <li>Mengembangkan infrastruktur TIK yang inklusif dan berkelanjutan.</li>
                </ul>
            </div>

        </div>
    </div>

</section>

@endsection
