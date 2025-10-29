@extends('layouts.app')

@section('title', 'Galeri')

@section('content')

    <section x-data="gallery()" class="px-6 md:px-20 py-20">

        {{-- ===================== HEADER ===================== --}}
        <div class="flex flex-col md:flex-row items-center justify-between mb-8">
            <h1 class="text-4xl md:text-5xl font-extrabold text-indigo-700 mb-4 md:mb-0">Galeri</h1>
            <div class="flex gap-2">
                <a href="?tab=video">
                    <button
                        :class="currentTab==='video' ? 'bg-indigo-700 text-white' : 'bg-white text-indigo-700 border border-indigo-700'"
                        class="px-4 py-2 rounded-lg font-semibold transition-colors">
                        Video
                    </button>
                </a>
                <a href="?tab=foto">
                    <button
                        :class="currentTab==='foto' ? 'bg-indigo-700 text-white' : 'bg-white text-indigo-700 border border-indigo-700'"
                        class="px-4 py-2 rounded-lg font-semibold transition-colors">
                        Foto
                    </button>
                </a>
            </div>
        </div>

        {{-- ===================== VIDEO SECTION ===================== --}}
        <div x-show="currentTab==='video'" x-transition class="space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($videos as $vid)
                    @php

                        preg_match("/(?:youtu.be\/|youtube.com\/(?:watch\\?v=|embed\/|shorts\/))([\\w\\-]+)/", $vid->youtube_link, $matches);
                        $youtube_id = $matches[1] ?? '';
                    @endphp

                    <div
                        class="bg-white shadow-xl rounded-2xl overflow-hidden relative transition-transform hover:scale-[1.02]">
                        @if($youtube_id)
                            <iframe src="https://www.youtube.com/embed/{{ $youtube_id }}" class="w-full h-[220px]" frameborder="0"
                                allowfullscreen>
                            </iframe>
                        @else
                            <p class="text-red-500 p-4 text-center font-medium">Link YouTube tidak valid</p>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $videos->appends(['tab' => 'video'])->links('pagination::tailwind') }}
            </div>
        </div>

        {{-- ===================== FOTO SECTION ===================== --}}
        <div x-show="currentTab==='foto'" x-transition class="space-y-6">

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
                @foreach($fotos as $photo)
                    <div class="cursor-pointer overflow-hidden rounded-2xl shadow-lg transition-transform hover:scale-[1.02] bg-white"
                        @click="openModal({ 
                                        file: '{{ asset('storage/' . $photo->image) }}', 
                                        desc: `{!! e($photo->deskripsi ?? '') !!}`, 
                                        tanggal: '{{ \Carbon\Carbon::parse($photo->tanggal)->translatedFormat('d F Y') }}' 
                                    })">
                        <img src="{{ asset('storage/' . $photo->image) }}" alt="Foto" class="w-full h-[220px] object-cover">
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $fotos->appends(['tab' => 'foto'])->links('pagination::tailwind') }}
            </div>
        </div>

        {{-- ===================== FOTO MODAL ===================== --}}
        <div x-show="modalOpen" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black/60"
            style="display: none;">
            <div
                class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full mx-4 md:mx-0 overflow-hidden flex flex-col relative">


                <button @click="closeModal"
                    class="absolute top-3 right-3 text-gray-600 hover:text-red-500 bg-white/80 rounded-full p-2 shadow-md transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>


                <div class="w-full h-[450px] overflow-hidden bg-gray-100 flex items-center justify-center">
                    <img :src="currentPhoto.file" alt="Foto" class="max-w-full max-h-full object-contain">
                </div>


                <div class="px-6 pt-4 text-sm text-gray-500 font-medium border-t border-gray-200">
                    📅 <span x-text="currentPhoto.tanggal"></span>
                </div>


                <div
                    class="p-6 text-gray-700 text-base leading-relaxed max-h-48 overflow-y-auto whitespace-pre-line break-words border-t border-gray-100">
                    <p x-html="currentPhoto.desc"></p>
                </div>
            </div>
        </div>

    </section>

    {{-- ===================== SCRIPT ===================== --}}
    <script>
        function gallery() {
            const params = new URLSearchParams(window.location.search);
            const tab = params.get('tab') || 'video'; // default video
            return {
                currentTab: tab,
                modalOpen: false,
                currentPhoto: {},

                openModal(photo) {
                    this.currentPhoto = photo;
                    this.modalOpen = true;
                },
                closeModal() {
                    this.modalOpen = false;
                },
            }
        }
    </script>

    {{-- ===================== CUSTOM SCROLLBAR ===================== --}}
    <style>
        .p-6::-webkit-scrollbar {
            width: 6px;
        }

        .p-6::-webkit-scrollbar-thumb {
            background-color: rgba(99, 102, 241, 0.6);
            border-radius: 4px;
        }

        .p-6::-webkit-scrollbar-thumb:hover {
            background-color: rgba(79, 70, 229, 0.8);
        }
    </style>

@endsection