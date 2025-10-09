@extends('layouts.app')

@section('title', 'Tugas Pokok dan Fungsi')

@section('content')

<section 
    x-data="{ show: false }"
    x-init="setTimeout(() => show = true, 200)"
    class="relative min-h-screen overflow-hidden">

    {{-- ===================== HERO SECTION ===================== --}}
    <div class="relative flex flex-col items-center justify-center text-center py-24 md:py-32 overflow-hidden">
        <h1 class="text-5xl md:text-6xl font-extrabold text-indigo-700 tracking-tight transition-all duration-1000"
            :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
            Tugas Pokok & Fungsi
        </h1>
    </div>

    {{-- ===================== CONTENT SECTION (2 Columns) ===================== --}}
    <div class="max-w-7xl mx-auto px-8 md:px-16 py-20">
        <div class="grid md:grid-cols-2 gap-10 md:gap-16">

            {{-- ===================== TUGAS POKOK (KIRI) ===================== --}}
            <div class="bg-white/70 backdrop-blur-lg shadow-xl rounded-[40px] p-10 md:p-14 transition-all duration-1000 ease-out transform"
                 :class="show ? 'opacity-100 -translate-x-0' : 'opacity-0 -translate-x-10'">
                <h2 class="text-3xl font-bold text-indigo-700 mb-6">Tugas Pokok</h2>
                <p class="text-lg text-gray-700 leading-relaxed">
                    Dinas Komunikasi dan Informatika Provinsi Papua Selatan mempunyai tugas pokok melaksanakan urusan pemerintahan daerah 
                    di bidang komunikasi, informatika, statistik, dan persandian sesuai dengan ketentuan peraturan perundang-undangan.
                    <br><br>
                    Tugas tersebut meliputi penyusunan kebijakan, koordinasi, pelaksanaan, pembinaan, serta evaluasi kegiatan komunikasi publik
                    dan pengelolaan sistem informasi pemerintahan guna mewujudkan tata kelola yang transparan dan berbasis teknologi digital.
                </p>
            </div>

            {{-- ===================== FUNGSI (KANAN) ===================== --}}
            <div class="bg-indigo-700 text-white shadow-xl rounded-[40px] p-10 md:p-14 transition-all duration-1000 ease-out transform delay-200"
                 :class="show ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-10'">
                <h2 class="text-3xl font-bold mb-6">Fungsi</h2>
                <ul class="list-disc list-inside text-indigo-100 text-lg leading-relaxed space-y-3">
                    <li>Perumusan dan pelaksanaan kebijakan di bidang komunikasi, informatika, statistik, dan persandian.</li>
                    <li>Koordinasi dan fasilitasi komunikasi publik antar perangkat daerah dan masyarakat.</li>
                    <li>Pengelolaan sistem informasi dan infrastruktur TIK daerah yang terintegrasi.</li>
                    <li>Penyelenggaraan literasi digital serta peningkatan kapasitas SDM TIK.</li>
                    <li>Pemantauan, evaluasi, dan pelaporan kegiatan komunikasi dan informatika.</li>
                    <li>Pengembangan tata kelola data, statistik, dan keamanan informasi daerah.</li>
                </ul>
            </div>

        </div>
    </div>

</section>

@endsection
