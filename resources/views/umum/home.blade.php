@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

    {{-- ================= HERO SECTION (FLEXIBLE VIDEO/IMAGE) ================= --}}
    <section x-data="heroSection()" x-init="init()"
        class="relative h-screen flex items-center justify-center overflow-hidden">


        @if($sampul && $sampul->media && \Illuminate\Support\Facades\Storage::disk('public')->exists($sampul->media))
            @php $ext = pathinfo($sampul->media, PATHINFO_EXTENSION); @endphp

            @if(in_array(strtolower($ext), ['mp4', 'mov', 'avi']))
                <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover brightness-75">
                    <source src="{{ asset('storage/' . $sampul->media) }}" type="video/mp4">
                    Browser kamu tidak mendukung video tag.
                </video>
            @else
                <img src="{{ asset('storage/' . $sampul->media) }}"
                    class="absolute inset-0 w-full h-full object-cover brightness-75" alt="Hero Background" loading="lazy">
            @endif
        @else
            <div class="absolute inset-0 w-full h-full flex items-center justify-center bg-gray-800 text-white">
                Belum ada Sampul
            </div>
        @endif


        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/40 to-transparent"></div>


        <div
            class="relative z-30 flex flex-col-reverse md:flex-row items-center justify-between w-full px-6 sm:px-10 lg:px-24 text-white">

            <div :class="mobile ? 'flex flex-col justify-center items-center text-center opacity-0 transition-opacity duration-700 fade-in' : ''"
                class="max-w-xl text-left space-y-6 mt-10 md:mt-0"
                :style="'transform: translate3d(' + textOffset + 'px, 0, 0);'">
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight">
                    <span class="text-indigo-400">{{ $sampul ? $sampul->nama_opd : 'Nama OPD' }}</span><br>
                </h1>
                <div class="text-gray-200 text-lg leading-relaxed text-justify break-words whitespace-pre-line w-full max-w-full overflow-hidden"
                    style="word-break: break-word; white-space: pre-wrap;">
                    {!! $sampul->deskripsi ?? 'Deskripsi default untuk hero section.' !!}
                </div>
            </div>


            <template x-if="desktop">
                <div class="relative flex justify-center items-center"
                    :style="'transform: translate3d(' + imageOffset + 'px, 0, 0);'">
                    <div class="absolute inset-0 bg-indigo-500/20 blur-[100px] rounded-full scale-125"></div>
                    <div class="relative z-10 overflow-hidden rounded-[40px]">
                        <img src="{{ $sampul && $sampul->foto_pemimpin && \Illuminate\Support\Facades\Storage::disk('public')->exists($sampul->foto_pemimpin) ? asset('storage/' . $sampul->foto_pemimpin) : asset('images/depan-kanan-orang.jpg') }}"
                            alt="Ilustrasi Forensik"
                            class="object-contain w-[280px] md:w-[350px] lg:w-[420px] transition-transform duration-700 ease-in-out hover:scale-[1.03]"
                            loading="lazy">
                    </div>
                </div>
            </template>
        </div>
    </section>
    {{-- ================= SECTION 2 ================= --}}
    <section x-data="sectionTwoParallax()"
        class="relative w-full flex flex-col md:flex-row items-center justify-between overflow-hidden bg-gray-100 py-20 px-6 md:px-0">


        <div class="relative w-full md:w-1/2 bg-black text-white py-16 px-8 md:px-12 flex flex-col justify-center rounded-[40px] z-10 shadow-2xl"
            :style="!isMobile ? 'transform: translateX(' + textOffset + 'px);' : ''">


            <div x-show="!isMobile"
                class="absolute right-[-120px] top-1/2 transform -translate-y-1/2 
                                 w-0 h-0 border-t-[100px] border-t-transparent 
                                 border-b-[100px] border-b-transparent 
                                 border-l-[130px] border-l-black rounded-tr-[40px] drop-shadow-[0_4px_8px_rgba(0,0,0,0.5)]">
            </div>

            <p class="text-sm tracking-widest text-gray-400 uppercase font-bold">
                KEPALA {{ $sambutan ? $sambutan->nama_opd : 'Nama Kepala OPD' }}
            </p>
            <p class="text-sm tracking-widest text-gray-400 uppercase font-semibold">
                {{ $sambutan ? $sambutan->nama_kepala_badan : 'Nama Kepala OPD' }}
            </p>

            <h2 class="text-4xl md:text-5xl font-extrabold leading-tight mt-4">
                {{ $sambutan ? $sambutan->judul : 'Kata Sambutan' }}
            </h2>

            <p class="text-gray-300 text-base leading-relaxed mt-6 max-w-md">
                @if($sambutan)
                    {!! \Illuminate\Support\Str::limit($sambutan->deskripsi, 200, '...') !!}
                @else
                    Deskripsi default sambutan kepala OPD.
                @endif
            </p>

            <a href="/sambutan"
                class="inline-block mt-6 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-full shadow-lg transition-all duration-300">
                Baca Selengkapnya
            </a>
        </div>


        <div class="relative w-full md:w-1/2 flex justify-center items-center mt-16 md:mt-0 z-20 px-4"
            :style="!isMobile ? 'transform: translateX(' + imageOffset + 'px);' : ''">
            <div class="absolute inset-0 blur-[100px] rounded-full scale-125"></div>
            <div class="relative z-10 overflow-hidden rounded-[40px] shadow-2xl">
                <img src="{{ $sambutan && $sambutan->image ? asset('storage/' . $sambutan->image) : asset('images/depan-kanan-orang.jpg') }}"
                    alt="Ilustrasi Forensik"
                    class="object-contain w-[280px] md:w-[350px] lg:w-[420px] transition-transform duration-700 ease-in-out hover:scale-[1.03]">
            </div>
        </div>
    </section>



    {{-- ================= BERITA TERBARU ================= --}}
    <section x-data="newsCarousel()"
        class="relative bg-gradient-to-b from-black via-gray-900 to-black py-24 px-6 lg:px-20 text-white overflow-hidden">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-extrabold mb-4 tracking-tight">Berita Terbaru</h2>
        </div>

        <div class="relative w-full overflow-hidden">
            <div class="flex transition-transform duration-[1000ms] ease-in-out"
                :style="'transform: translateX(' + offset + 'px); transition-duration:' + (smooth ? '1000ms' : '0ms')">
                <template x-for="(news, index) in newsList" :key="index">
                    <div
                        class="min-w-[350px] max-w-[350px] mx-3 bg-white rounded-3xl overflow-hidden shadow-lg cursor-pointer hover:shadow-2xl transition-transform duration-500">
                        <div class="relative overflow-hidden">
                            <img :src="news.image" alt=""
                                class="w-full h-56 object-cover transition-transform duration-500 hover:scale-105">
                            <template x-if="news.unggulan">
                                <span
                                    class="absolute top-4 left-4 bg-yellow-400 text-white px-3 py-1 text-xs font-semibold rounded-full shadow-md">
                                    ⭐ Unggulan
                                </span>
                            </template>
                        </div>

                        <div class="p-5 space-y-3">
                            <h3 class="text-xl font-bold text-gray-800 hover:text-indigo-600 transition duration-300 line-clamp-2"
                                x-text="news.title"></h3>

                            <div class="flex items-center text-sm text-gray-500 space-x-2">
                                <i class="fa-regular fa-calendar"></i>
                                <span x-text="news.tanggal"></span>
                                <span>•</span>
                                <span class="text-indigo-600 font-medium" x-text="news.kategori"></span>
                            </div>

                            <div class="pt-3">
                                <button class="text-indigo-600 font-semibold hover:underline"
                                    @click.stop="openNewsModal(news)">
                                    Baca Selengkapnya →
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        {{-- MODAL BERITA --}}
        <div x-show="openModal" x-transition.opacity.duration.300ms x-cloak
            class="fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-50 p-6"
            @click.self="closeNewsModal()">
            <div x-show="selectedNews" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95" @click.stop
                class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto">

                <div class="flex justify-between items-center py-4 border-b bg-indigo-600 text-white rounded-t-2xl px-8">
                    <h5 class="font-semibold text-lg" x-text="selectedNews.title"></h5>
                    <button @click.stop="closeNewsModal()" class="text-white text-2xl">&times;</button>
                </div>

                <div class="p-8 space-y-6">
                    <img :src="selectedNews.image" alt="Foto Sampul" class="w-full h-64 object-cover rounded-lg shadow">

                    <template x-if="selectedNews.foto_berita && selectedNews.foto_berita.length > 0">
                        <div class="grid grid-cols-3 gap-3 mt-4">
                            <template x-for="foto in selectedNews.foto_berita" :key="foto">
                                <img :src="foto" alt="Foto Berita"
                                    class="w-full h-32 object-cover rounded border border-gray-200">
                            </template>
                        </div>
                    </template>

                    <div class="flex flex-wrap gap-4 text-sm text-gray-600 mt-3 items-center">
                        <span><strong>Tanggal:</strong> <span x-text="selectedNews.tanggal"></span></span>
                        <span><strong>Kategori:</strong> <span x-text="selectedNews.kategori"></span></span>
                    </div>

                    <hr class="border-gray-300">

                    <div class="font-normal max-w-none text-gray-800 leading-relaxed" x-html="selectedNews.deskripsi"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= GALERI FOTO TERBARU ================= --}}
    <section x-data="galleryModal()" class="relative py-28 px-6 lg:px-20 overflow-hidden text-gray-800">
        <div class="text-center mb-20">
            <h2 class="text-5xl font-extrabold mb-4 tracking-tight">Galeri</h2>
        </div>

        {{-- GRID GALERI --}}
        <div class="grid grid-cols-12 gap-6 md:gap-8">
            <template x-for="(item, index) in galleryList" :key="index">
                <div class="col-span-12 md:col-span-4 relative overflow-hidden rounded-[30px] shadow-xl group cursor-pointer"
                    @click="openModal(item)">
                    <img :src="item.image" :alt="item.title"
                        class="w-full h-[300px] object-cover transition-transform duration-700 group-hover:scale-110"
                        loading="lazy">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent flex items-end p-5">
                        <h3 class="text-lg font-semibold text-white" x-text="item.title"></h3>
                    </div>
                </div>
            </template>
        </div>

        {{-- MODAL GALERI --}}
        <div x-show="isOpen" x-transition.opacity.duration.300ms x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 p-4" @click.self="closeModal()">
            <div x-transition.scale.duration.300ms
                class="bg-white rounded-3xl shadow-2xl max-w-3xl w-full overflow-hidden flex flex-col relative" @click.stop>
                <button @click.stop="closeModal()"
                    class="absolute top-3 right-3 text-gray-600 hover:text-red-500 bg-white/80 rounded-full p-2 shadow-md transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>


                <div class="w-full h-[450px] overflow-hidden bg-gray-100 flex items-center justify-center">
                    <img :src="selectedImage" alt="Foto" class="max-w-full max-h-full object-contain">
                </div>


                <div class="px-6 pt-4 text-sm text-gray-500 font-medium border-t border-gray-200 flex items-center gap-2">
                    <i class="fas fa-calendar"></i>
                    <span x-text="selectedDate"></span>
                </div>


                <div
                    class="font-normal p-6 text-gray-700 text-base leading-relaxed max-h-48 overflow-y-auto whitespace-pre-line break-words border-t border-gray-100">
                    <p x-html="selectedDescription"></p>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('alpine:init', () => {

            // ================= HERO SECTION =================
            Alpine.data('heroSection', () => ({
                desktop: window.innerWidth > 768,
                mobile: window.innerWidth <= 768,
                textOffset: 0,
                imageOffset: 0,
                ticking: false,
                init() {
                    const updateMode = () => {
                        this.desktop = window.innerWidth > 768;
                        this.mobile = !this.desktop;
                    };

                    updateMode();
                    window.addEventListener('resize', updateMode, { passive: true });
                    const loader = document.getElementById('loader');
                    if (loader) loader.style.display = 'none';

                    if (this.desktop) {
                        let lastScroll = 0;
                        const section = this.$el;

                        const onScroll = () => {
                            const scrollY = window.scrollY;
                            if (Math.abs(scrollY - lastScroll) > 2) {
                                lastScroll = scrollY;
                                if (!this.ticking) {
                                    this.ticking = true;
                                    requestAnimationFrame(() => {
                                        this.textOffset = -scrollY * 0.85;
                                        this.imageOffset = scrollY * 0.85;
                                        this.ticking = false;
                                    });
                                }
                            }
                        };
                        window.addEventListener('scroll', onScroll, { passive: true });
                    } else {
                        setTimeout(() => {
                            this.$el.querySelectorAll('.fade-in').forEach(el => {
                                el.classList.add('opacity-100');
                            });
                        }, 300);
                    }
                }
            }));


            // ================= SECTION 2 =================
            Alpine.data('sectionTwoParallax', () => ({
                desktop: window.innerWidth > 768,
                mobile: window.innerWidth <= 768,
                textOffset: -300,
                imageOffset: 300,
                ticking: false,
                isMobile: window.innerWidth <= 768,
                init() {
                    const updateMode = () => {
                        this.desktop = window.innerWidth > 768;
                        this.mobile = !this.desktop;
                        this.isMobile = !this.desktop;
                    };
                    updateMode();

                    window.addEventListener('resize', updateMode, { passive: true });

                    if (this.desktop) {
                        const section = this.$el;
                        const onScroll = () => {
                            if (!this.ticking) {
                                this.ticking = true;
                                requestAnimationFrame(() => {
                                    const rect = section.getBoundingClientRect();
                                    const windowHeight = window.innerHeight;
                                    if (rect.top < windowHeight && rect.bottom > 0) {
                                        let progress = 1 - (rect.top / windowHeight);
                                        progress = Math.min(Math.max(progress, 0), 1);
                                        this.textOffset = -300 * (1 - progress);
                                        this.imageOffset = 300 * (1 - progress);
                                    }
                                    this.ticking = false;
                                });
                            }
                        };
                        window.addEventListener('scroll', onScroll, { passive: true });
                    } else {
                        setTimeout(() => {
                            this.$el.querySelectorAll('.fade-in').forEach(el => el.classList.add('opacity-100'));
                        }, 300);
                    }
                }
            }));


            // ================= NEWS CAROUSEL =================
            Alpine.data('newsCarousel', () => ({
                originalNews: @json($berita ?? []),
                newsList: [],
                offset: 0,
                slideWidth: 0,
                currentIndex: 0,
                animating: false,
                interval: null,
                smooth: true,
                openModal: false,
                selectedNews: null,
                closeTimeout: null,

                init() {
                    if (!Array.isArray(this.originalNews) || this.originalNews.length === 0) {
                        console.warn('Tidak ada data berita untuk carousel.');
                        this.newsList = [];
                        return;
                    }


                    const minItems = 3;
                    let tempNews = [...this.originalNews.slice(0, 5)];

                    while (tempNews.length < minItems) {
                        tempNews = tempNews.concat(this.originalNews);
                    }


                    this.newsList = [...tempNews, ...tempNews, ...tempNews];
                    this.currentIndex = tempNews.length;

                    this.$nextTick(() => {
                        const firstSlide = this.$el.querySelector('.flex > div');
                        if (firstSlide) {
                            this.slideWidth = firstSlide.offsetWidth + 24;
                            this.offset = -this.slideWidth * this.currentIndex;
                            this.startAutoSlide();
                        }
                    });


                    document.addEventListener("visibilitychange", () => {
                        if (document.hidden) clearInterval(this.interval);
                        else if (this.newsList.length > 0) this.startAutoSlide();
                    });
                },

                startAutoSlide() {
                    if (this.interval) clearInterval(this.interval);
                    if (this.newsList.length === 0) return;
                    this.interval = setInterval(() => {
                        if (!this.openModal) this.nextSlide();
                    }, 4000);
                },

                nextSlide() {
                    if (this.animating || this.newsList.length === 0) return;
                    this.animating = true;
                    this.smooth = true;
                    this.currentIndex++;
                    this.offset = -this.slideWidth * this.currentIndex;

                    setTimeout(() => {
                        const tempLength = this.newsList.length / 3;
                        if (this.currentIndex >= tempLength * 2) {
                            this.smooth = false;
                            this.currentIndex = tempLength;
                            this.offset = -this.slideWidth * this.currentIndex;
                        }
                        this.animating = false;
                    }, 1000);
                },

                openNewsModal(news) {
                    clearTimeout(this.closeTimeout);
                    this.selectedNews = news;
                    this.openModal = true;
                    clearInterval(this.interval);
                },

                closeNewsModal() {
                    this.openModal = false;
                    this.closeTimeout = setTimeout(() => {
                        this.selectedNews = null;
                        this.startAutoSlide();
                    }, 300);
                }
            }));


            // ================= GALLERY MODAL =================
            Alpine.data('galleryModal', () => ({
                galleryList: @json($galeri ?? []),
                isOpen: false,
                selectedImage: '',
                selectedDescription: '',
                selectedDate: '',
                openModal(item) {
                    this.selectedImage = item.image;
                    this.selectedDescription = item.deskripsi ?? '';
                    this.selectedDate = item.tanggal ?? '';
                    this.isOpen = true;
                },
                closeModal() {
                    this.isOpen = false;
                    this.selectedImage = '';
                    this.selectedDescription = '';
                    this.selectedDate = '';
                }
            }));

        });
    </script>



@endsection