@extends('layouts.app')

@section('title', 'Galeri')

@section('content')

    <section x-data="gallery()" class="px-6 md:px-20 py-20">

        {{-- ===================== HEADER ===================== --}}
        <div class="flex flex-col md:flex-row items-center justify-between mb-8">
            <h1 class="text-4xl md:text-5xl font-extrabold text-indigo-700 mb-4 md:mb-0">Galeri</h1>
            <div class="flex gap-2">
                <button @click="currentTab='video'"
                    :class="currentTab==='video' ? 'bg-indigo-700 text-white' : 'bg-white text-indigo-700 border border-indigo-700'"
                    class="px-4 py-2 rounded-lg font-semibold transition-colors">
                    Video
                </button>
                <button @click="currentTab='foto'"
                    :class="currentTab==='foto' ? 'bg-indigo-700 text-white' : 'bg-white text-indigo-700 border border-indigo-700'"
                    class="px-4 py-2 rounded-lg font-semibold transition-colors">
                    Foto
                </button>
            </div>
        </div>

        {{-- ===================== VIDEO SECTION ===================== --}}
        <div x-show="currentTab==='video'" x-transition class="space-y-6">

            {{-- Video Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <template x-for="vid in paginatedVideos" :key="vid.file">
                    <div
                        class="bg-white shadow-xl rounded-2xl overflow-hidden relative transition-transform hover:scale-[1.02]">
                        <video :src="`/videos/${vid.file}`" controls class="w-full h-[220px] object-cover"></video>
                        <div class="p-4">
                            <h2 class="text-lg font-bold text-indigo-700 mb-1" x-text="vid.title"></h2>
                            <p class="text-gray-700 text-sm" x-text="vid.desc"></p>
                        </div>
                    </div>
                </template>
            </div>

            {{-- Pagination Video --}}
            <div class="flex justify-center items-center mt-6 space-x-2">

                <button @click="if(videoPage>1) videoPage--" :disabled="videoPage===1"
                    class="px-3 py-1 rounded-lg font-semibold border border-indigo-700 text-indigo-700 hover:bg-indigo-700 hover:text-white transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    Prev
                </button>

                <template x-for="page in pageWindow(videoPage, totalVideoPages)" :key="page">
                    <button @click="videoPage=page"
                        :class="page===videoPage ? 'bg-indigo-700 text-white' : 'bg-white text-indigo-700 border border-indigo-700'"
                        class="px-3 py-1 rounded-lg font-semibold transition-colors">
                        <span x-text="page"></span>
                    </button>
                </template>

                <button @click="if(videoPage<totalVideoPages) videoPage++" :disabled="videoPage===totalVideoPages"
                    class="px-3 py-1 rounded-lg font-semibold border border-indigo-700 text-indigo-700 hover:bg-indigo-700 hover:text-white transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    Next
                </button>

            </div>
        </div>

        {{-- ===================== FOTO SECTION ===================== --}}
        <div x-show="currentTab==='foto'" x-transition class="space-y-6">

            {{-- Foto Grid --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <template x-for="photo in paginatedFotos" :key="photo.file">
                    <div class="cursor-pointer overflow-hidden rounded-xl shadow-lg transition-transform hover:scale-[1.03]"
                        @click="openModal(photo)">
                        <img :src="`/images/${photo.file}`" alt="" class="w-full h-48 object-cover">
                    </div>
                </template>
            </div>

            {{-- Pagination Foto --}}
            <div class="flex justify-center items-center mt-6 space-x-2">

                <button @click="if(fotoPage>1) fotoPage--" :disabled="fotoPage===1"
                    class="px-3 py-1 rounded-lg font-semibold border border-indigo-700 text-indigo-700 hover:bg-indigo-700 hover:text-white transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    Prev
                </button>

                <template x-for="page in pageWindow(fotoPage, totalFotoPages)" :key="page">
                    <button @click="fotoPage=page"
                        :class="page===fotoPage ? 'bg-indigo-700 text-white' : 'bg-white text-indigo-700 border border-indigo-700'"
                        class="px-3 py-1 rounded-lg font-semibold transition-colors">
                        <span x-text="page"></span>
                    </button>
                </template>

                <button @click="if(fotoPage<totalFotoPages) fotoPage++" :disabled="fotoPage===totalFotoPages"
                    class="px-3 py-1 rounded-lg font-semibold border border-indigo-700 text-indigo-700 hover:bg-indigo-700 hover:text-white transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    Next
                </button>

            </div>
        </div>

        {{-- ===================== FOTO MODAL ===================== --}}
        <div x-show="modalOpen" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
            style="display: none;">
            <div @click.away="closeModal"
                class="bg-white rounded-3xl shadow-2xl max-w-3xl w-full mx-4 md:mx-0 overflow-hidden">

                {{-- Gambar --}}
                <div class="w-full h-96 md:h-[500px] overflow-hidden">
                    <img :src="`/images/${currentPhoto.file}`" alt="" class="w-full h-full object-contain bg-gray-100">
                </div>

                {{-- Deskripsi --}}
                <div class="p-6 max-h-48 overflow-y-auto">
                    <p class="text-gray-700" x-text="currentPhoto.desc"></p>
                </div>

                {{-- Close Button --}}
                <div class="flex justify-end p-4">
                    <button @click="closeModal"
                        class="px-4 py-2 bg-indigo-700 text-white rounded-lg font-semibold hover:bg-indigo-800 transition-colors">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

    </section>

    <script>
        function gallery() {
            return {
                currentTab: 'video',
                videoPage: 1,
                fotoPage: 1,
                perPage: 6,
                videos: [
                    { title: 'Video 1', desc: 'Deskripsi Video 1', file: 'video1.mp4' },
                    { title: 'Video 2', desc: 'Deskripsi Video 2', file: 'video2.mp4' },
                    { title: 'Video 3', desc: 'Deskripsi Video 3', file: 'video3.mp4' },
                    { title: 'Video 4', desc: 'Deskripsi Video 4', file: 'video4.mp4' },
                    { title: 'Video 5', desc: 'Deskripsi Video 5', file: 'video5.mp4' },
                    { title: 'Video 6', desc: 'Deskripsi Video 6', file: 'video6.mp4' },
                    { title: 'Video 7', desc: 'Deskripsi Video 7', file: 'video7.mp4' },
                    { title: 'Video 8', desc: 'Deskripsi Video 8', file: 'video8.mp4' },
                    { title: 'Video 9', desc: 'Deskripsi Video 9', file: 'video9.mp4' }
                ],
                fotos: [
                    { title: 'Foto 1', desc: 'Deskripsi panjang foto 1...', file: 'depan-kanan-orang.jpg' },
                    { title: 'Foto 2', desc: 'Deskripsi panjang foto 2...', file: 'foto2.jpg' },
                    { title: 'Foto 3', desc: 'Deskripsi panjang foto 3...', file: 'foto3.jpg' },
                    { title: 'Foto 4', desc: 'Deskripsi panjang foto 4...', file: 'foto4.jpg' },
                    { title: 'Foto 5', desc: 'Deskripsi panjang foto 5...', file: 'foto5.jpg' },
                    { title: 'Foto 6', desc: 'Deskripsi panjang foto 6...', file: 'foto6.jpg' },
                    { title: 'Foto 7', desc: 'Deskripsi panjang foto 7...', file: 'foto7.jpg' },
                    { title: 'Foto 8', desc: 'Deskripsi panjang foto 8...', file: 'foto8.jpg' },
                    { title: 'Foto 9', desc: 'Deskripsi panjang foto 9...', file: 'foto9.jpg' }
                ],

                modalOpen: false,
                currentPhoto: {},

                get totalVideoPages() {
                    return Math.ceil(this.videos.length / this.perPage);
                },
                get totalFotoPages() {
                    return Math.ceil(this.fotos.length / this.perPage);
                },
                get paginatedVideos() {
                    const start = (this.videoPage - 1) * this.perPage;
                    return this.videos.slice(start, start + this.perPage);
                },
                get paginatedFotos() {
                    const start = (this.fotoPage - 1) * this.perPage;
                    return this.fotos.slice(start, start + this.perPage);
                },

                openModal(photo) {
                    this.currentPhoto = photo;
                    this.modalOpen = true;
                },
                closeModal() {
                    this.modalOpen = false;
                },

                // Fungsi windowed pagination maksimal 5 angka
                pageWindow(current, total) {
                    let windowSize = 5;
                    let start = Math.max(current - 2, 1);
                    let end = Math.min(start + windowSize - 1, total);
                    start = Math.max(end - windowSize + 1, 1);
                    let pages = [];
                    for (let i = start; i <= end; i++) pages.push(i);
                    return pages;
                }
            }
        }
    </script>

@endsection