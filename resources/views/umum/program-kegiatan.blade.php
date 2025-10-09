@extends('layouts.app')

@section('title', 'Dokumen Program Kegiatan')

@section('content')

<section x-data="{ view: 'table', documents: [
    { penulis: 'Admin', nama: 'Rencana Kerja 2025', kategori: 'Strategis', tanggal: '2025-01-10', file: 'rencana-kerja-2025.pdf' },
    { penulis: 'Sekretariat', nama: 'Laporan Kegiatan 2024', kategori: 'Laporan', tanggal: '2025-02-15', file: 'laporan-2024.pdf' },
    { penulis: 'Tim Teknis', nama: 'Program Digitalisasi', kategori: 'Program', tanggal: '2025-03-05', file: 'program-digitalisasi.pdf' }
] }" class="px-6 md:px-20 py-20">

    {{-- ===================== HEADER ===================== --}}
    <div class="flex flex-col md:flex-row items-center justify-between mb-8">
        <h1 class="text-4xl md:text-5xl font-extrabold text-indigo-700 mb-4 md:mb-0">Dokumen Program Kegiatan</h1>
        
        {{-- Toggle Button --}}
        <div class="flex gap-2">
            <button @click="view='table'" 
                    :class="view==='table' ? 'bg-indigo-700 text-white' : 'bg-white text-indigo-700 border border-indigo-700'"
                    class="px-4 py-2 rounded-lg font-semibold transition-colors">
                Tabel
            </button>
            <button @click="view='card'" 
                    :class="view==='card' ? 'bg-indigo-700 text-white' : 'bg-white text-indigo-700 border border-indigo-700'"
                    class="px-4 py-2 rounded-lg font-semibold transition-colors">
                Card
            </button>
        </div>
    </div>

    {{-- ===================== CONTENT ===================== --}}
    <div class="relative">

        {{-- TABEL VIEW --}}
        <div 
            x-show="view==='table'" 
            x-transition:enter="transition duration-500 ease-out"
            x-transition:enter-start="opacity-0 transform -translate-x-10"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition duration-500 ease-in"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform translate-x-10"
            x-cloak
            class="overflow-x-auto shadow-lg rounded-xl bg-white"
        >
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-indigo-700 text-white sticky top-0 z-10">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Penulis</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Nama File</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Kategori</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Tanggal</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <template x-for="doc in documents" :key="doc.file">
                        <tr class="hover:bg-indigo-50 transition-colors">
                            <td class="px-6 py-4 text-gray-700 font-medium" x-text="doc.penulis"></td>
                            <td class="px-6 py-4 text-gray-700" x-text="doc.nama"></td>
                            <td class="px-6 py-4 text-gray-700" x-text="doc.kategori"></td>
                            <td class="px-6 py-4 text-gray-700" x-text="doc.tanggal"></td>
                            <td class="px-6 py-4 text-center">
                                <a :href="`/files/${doc.file}`" target="_blank" 
                                   class="px-3 py-1 bg-indigo-700 text-white rounded-lg font-semibold hover:bg-indigo-800 transition-colors">
                                   Unduh
                                </a>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        {{-- CARD VIEW --}}
        <div 
            x-show="view==='card'" 
            x-transition:enter="transition duration-500 ease-out"
            x-transition:enter-start="opacity-0 transform translate-x-10"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition duration-500 ease-in"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform translate-x-10"
            x-cloak
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6"
        >
            <template x-for="doc in documents" :key="doc.file">
                <div class="bg-white shadow-xl rounded-2xl p-6 flex flex-col justify-between transition-transform hover:scale-[1.02]">
                    <div>
                        <h2 class="text-xl font-bold text-indigo-700 mb-2" x-text="doc.nama"></h2>
                        <p class="text-gray-700 mb-1"><span class="font-semibold">Penulis:</span> <span x-text="doc.penulis"></span></p>
                        <p class="text-gray-700 mb-1"><span class="font-semibold">Kategori:</span> <span x-text="doc.kategori"></span></p>
                        <p class="text-gray-700 mb-4"><span class="font-semibold">Tanggal:</span> <span x-text="doc.tanggal"></span></p>
                    </div>
                    <div class="mt-2">
                        <a :href="`/files/${doc.file}`" target="_blank" 
                           class="px-4 py-2 bg-indigo-700 text-white rounded-lg font-semibold w-full text-center hover:bg-indigo-800 transition-colors">
                           Unduh
                        </a>
                    </div>
                </div>
            </template>
        </div>

    </div>

</section>

@endsection
