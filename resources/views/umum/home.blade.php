@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    {{-- ================= HERO SECTION (VIDEO BACKGROUND PARALLAX) ================= --}}
    <section x-data="heroParallax()" x-init="init()"
        class="relative h-screen flex items-center justify-center overflow-hidden">

        {{-- Background Video --}}
        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover brightness-75">
            <source src="{{ asset('videos/hero.mp4') }}" type="video/mp4">
            Browser kamu tidak mendukung video tag.
        </video>

        {{-- Overlay Gelap agar teks lebih jelas --}}
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/40 to-transparent"></div>

        {{-- Hero Content --}}
        <div
            class="relative z-30 flex flex-col-reverse md:flex-row items-center justify-between w-full px-6 sm:px-10 lg:px-24 text-white">
            <div class="max-w-xl text-left space-y-6 mt-10 md:mt-0" :style="'transform: translateX(' + textOffset + 'px);'">
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight">
                    <span class="text-indigo-400">Lorem Ipsum</span><br>
                </h1>
                <p class="text-gray-200 text-lg">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem sequi et officia perspiciatis
                    laboriosam dicta, quisquam quod obcaecati cumque odit autem dolorem est dignissimos? Nobis earum sint
                    sapiente perspiciatis maiores?
                </p>
            </div>

            <div class="relative flex justify-center items-center" :style="'transform: translateX(' + imageOffset + 'px);'">
                <div class="absolute inset-0 bg-indigo-500/20 blur-[100px] rounded-full scale-125"></div>
                <div class="relative z-10 overflow-hidden rounded-[40px] shadow-2xl">
                    <img src="{{ asset('images/depan-kanan-orang.jpg') }}" alt="Ilustrasi Forensik"
                        class="object-contain w-[280px] md:w-[350px] lg:w-[420px] transition-transform duration-700 ease-in-out hover:scale-[1.03]">
                </div>
            </div>
        </div>
    </section>

    {{-- ================= SECTION 2 ================= --}}
    <section x-data="sectionTwoParallax()"
        class="relative w-full flex flex-col md:flex-row items-center justify-between overflow-hidden bg-gray-100 py-20 px-6 md:px-0">

        <div class="relative w-full md:w-1/2 bg-black text-white py-16 px-8 md:px-12 flex flex-col justify-center rounded-r-[80px] z-10 shadow-2xl"
            :style="'transform: translateX(' + textOffset + 'px);'">
            <div
                class="absolute right-[-120px] top-1/2 transform -translate-y-1/2 
                                                w-0 h-0 
                                                border-t-[100px] border-t-transparent 
                                                border-b-[100px] border-b-transparent 
                                                border-l-[130px] border-l-black rounded-tr-[40px] drop-shadow-[0_4px_8px_rgba(0,0,0,0.5)]">
            </div>

            <p class="text-sm tracking-widest text-gray-400 uppercase font-bold">Kepala OPD</p>
            <p class="text-sm tracking-widest text-gray-400 uppercase font-semibold">Nama Kepala OPD</p>

            <h2 class="text-4xl md:text-5xl font-extrabold leading-tight mt-4">
                Profesionalisme & Integritas<br>
            </h2>

            <p class="text-gray-300 text-base leading-relaxed mt-6 max-w-md">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet necessitatibus nihil magnam dolor quia
                ducimus alias ab possimus velit accusamus.
            </p>

            <a href="/sambutan"
                class="inline-block mt-6 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-full shadow-lg transition-all duration-300">
                Baca Selengkapnya
            </a>
        </div>

        <div class="relative w-full md:w-1/2 flex justify-center items-center mt-16 md:mt-0 z-20 px-4"
            :style="'transform: translateX(' + imageOffset + 'px);'">
            <div class="absolute inset-0 blur-[100px] rounded-full scale-125"></div>
            <div class="relative z-10 overflow-hidden rounded-[40px] shadow-2xl">
                <img src="{{ asset('images/depan-kanan-orang.jpg') }}" alt="Ilustrasi Forensik"
                    class="object-contain w-[280px] md:w-[350px] lg:w-[420px] transition-transform duration-700 ease-in-out hover:scale-[1.03]">
            </div>
        </div>
    </section>

    {{-- ================= BERITA TERBARU ================= --}}
    <section x-data="newsCarousel()"
        class="relative bg-gradient-to-b from-black via-gray-900 to-black py-24 px-6 lg:px-20 text-white overflow-hidden">

        <div class="text-center mb-16">
            <h2 class="text-5xl font-extrabold mb-4 tracking-tight">Berita Terbaru</h2>
            <p class="text-gray-400 text-lg max-w-3xl mx-auto">Informasi terkini seputar kegiatan, penelitian, dan inovasi
                forensik digital.</p>
        </div>

        <div class="relative w-full overflow-hidden">
            <div class="flex transition-transform duration-[1200ms] ease-linear"
                :style="'transform: translateX(' + offset + 'px); transition-duration:' + (smooth ? '1200ms' : '0ms')">
                <template x-for="(news, index) in newsList" :key="index">
                    <div class="min-w-[350px] max-w-[350px] mx-3 bg-gray-800 rounded-2xl overflow-hidden shadow-lg cursor-pointer hover:scale-[1.02] transition-transform duration-500"
                        @click="selectedNews = news; openModal = true;">
                        <img :src="'{{ asset('images') }}/' + news.image" alt="" class="w-full h-56 object-cover">
                        <div class="p-5">
                            <h3 class="text-xl font-bold mb-2 text-indigo-400" x-text="news.title"></h3>
                            <p class="text-gray-300 text-sm leading-relaxed" x-text="news.content"></p>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        {{-- Modal Berita --}}
        <div x-show="openModal" x-transition.opacity x-cloak
            class="fixed inset-0 bg-black/70 flex items-center justify-center z-50 p-4" @click.self="openModal = false">
            <div class="bg-white text-gray-800 rounded-2xl shadow-2xl max-w-2xl w-full overflow-hidden">
                <img :src="'{{ asset('images') }}/' + selectedNews.image" alt="" class="w-full h-[300px] object-cover">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-2 text-indigo-700" x-text="selectedNews.title"></h3>
                    <p class="text-gray-600 text-base leading-relaxed" x-text="selectedNews.content"></p>
                    <div class="mt-6 text-right">
                        <button @click="openModal = false"
                            class="px-5 py-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition-all">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= GALERI FOTO TERBARU ================= --}}
    <section x-data="galleryModal()" class="relative bg-white py-28 px-6 lg:px-20 overflow-hidden text-gray-800">
        <div class="text-center mb-20">
            <h2 class="text-5xl font-extrabold mb-4 tracking-tight">Galeri</h2>
            <p class="text-gray-500 text-lg max-w-2xl mx-auto">
                Koleksi visual eksklusif yang menangkap momen mendalam dalam dunia forensik digital.
            </p>
        </div>

        <div class="grid grid-cols-12 gap-6 md:gap-8">
            <template x-for="(item, index) in galleryList" :key="index">
                <div class="col-span-12 md:col-span-4 relative overflow-hidden rounded-[30px] shadow-xl group cursor-pointer"
                    @click="openModal(item)">
                    <img :src="item.image" :alt="item.title"
                        class="w-full h-[300px] object-cover transition-transform duration-700 group-hover:scale-110">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent flex items-end p-5">
                        <h3 class="text-lg font-semibold text-white" x-text="item.title"></h3>
                    </div>
                </div>
            </template>
        </div>

        {{-- Modal Galeri --}}
        <div x-show="isOpen" x-transition.opacity x-cloak
            class="fixed inset-0 bg-black/80 flex items-center justify-center z-50 p-4" @click.self="closeModal()">
            <div x-show="selectedImage" x-transition.scale
                class="bg-white text-gray-900 rounded-2xl shadow-2xl max-w-3xl w-full overflow-hidden">
                <img :src="selectedImage" alt="" class="w-full h-[400px] object-cover">
                <div class="p-8">
                    <h3 class="text-3xl font-bold mb-2 text-indigo-700" x-text="selectedTitle"></h3>
                    <p class="text-sm text-gray-500 mb-4" x-text="selectedDate"></p>
                    <p class="text-gray-700 leading-relaxed text-lg" x-text="selectedDescription"></p>
                    <div class="mt-8 flex justify-end">
                        <button @click="closeModal()"
                            class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full shadow-md transition-all">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= SCRIPT ================= --}}
    <script>
        document.addEventListener('alpine:init', () => {

            // === HERO VIDEO PARALLAX ===
            Alpine.data('heroParallax', () => ({
                textOffset: 0,
                imageOffset: 0,
                init() {
                    window.addEventListener('scroll', () => {
                        const scrollPos = window.scrollY;
                        const limit = Math.min(scrollPos, 1000);
                        this.textOffset = -limit * 0.85;
                        this.imageOffset = limit * 0.85;
                    });
                }
            }));

            // === SECTION 2 PARALLAX ===
            Alpine.data('sectionTwoParallax', () => ({
                textOffset: -300,
                imageOffset: 300,
                init() {
                    const section = this.$el;
                    window.addEventListener('scroll', () => {
                        const rect = section.getBoundingClientRect();
                        const windowHeight = window.innerHeight;
                        if (rect.top < windowHeight && rect.bottom > 0) {
                            let progress = 1 - (rect.top / windowHeight);
                            progress = Math.min(Math.max(progress, 0), 1);
                            this.textOffset = -300 * (1 - progress);
                            this.imageOffset = 300 * (1 - progress);
                        }
                    });
                }
            }));

            // === NEWS CAROUSEL ===
            Alpine.data('newsCarousel', () => ({
                originalNews: [
                    { title: 'Kasus Cyberbullying di WeChat Terungkap', image: 'contohberita1.jpeg', content: 'Tim forensik digital berhasil menemukan bukti kuat dari ponsel pelaku menggunakan metode DFRWS.' },
                    { title: 'Peningkatan Keamanan Data Pemerintah', image: 'contohberita2.jpeg', content: 'Dinas Kominfo menerapkan sistem audit digital untuk menjaga integritas data publik.' },
                    { title: 'Pelatihan Digital Forensik untuk Aparat', image: 'contohberita3.jpeg', content: 'Pelatihan ini memperkuat kemampuan penyidik menangani bukti elektronik dengan profesional.' },
                    { title: 'Inovasi Sistem Keamanan Siber Nasional', image: 'contohberita4.jpeg', content: 'Penerapan teknologi baru untuk melindungi infrastruktur kritis dari serangan siber.' },
                    { title: 'Workshop Analisis Forensik Terbaru', image: 'contohberita5.jpeg', content: 'Praktisi belajar teknik terbaru untuk investigasi digital yang lebih efektif.' },
                ],
                newsList: [],
                offset: 0,
                slideWidth: 0,
                currentIndex: 0,
                animating: false,
                visibleCount: 3,
                interval: null,
                smooth: true,
                openModal: false,
                selectedNews: null,

                init() {
                    this.newsList = [...this.originalNews, ...this.originalNews, ...this.originalNews];
                    this.currentIndex = this.originalNews.length;
                    this.$nextTick(() => {
                        this.slideWidth = this.$el.querySelector('.flex > div').offsetWidth + 24;
                        this.offset = -this.slideWidth * this.currentIndex;
                        this.interval = setInterval(() => this.nextSlide(), 3000);
                    });
                },

                nextSlide() {
                    if (this.animating) return;
                    this.animating = true;
                    this.smooth = true;
                    this.currentIndex++;
                    this.offset = -this.slideWidth * this.currentIndex;
                    setTimeout(() => {
                        if (this.currentIndex >= this.originalNews.length * 2) {
                            this.smooth = false;
                            this.currentIndex = this.originalNews.length;
                            this.offset = -this.slideWidth * this.currentIndex;
                            this.$nextTick(() => setTimeout(() => this.smooth = true, 20));
                        }
                        this.animating = false;
                    }, 1000);
                }
            }));

            // === GALLERY MODAL ===
            Alpine.data('galleryModal', () => ({
                isOpen: false,
                selectedTitle: '',
                selectedImage: '',
                selectedDate: '',
                selectedDescription: '',
                galleryList: [
                    { title: 'Investigasi Lapangan', date: '12 September 2025', description: 'Kegiatan investigasi lapangan dalam penyelidikan kasus forensik digital.', image: '{{ asset('images/bg.png') }}' },
                    { title: 'Workshop Forensik', date: '20 Agustus 2025', description: 'Pelatihan intensif mengenai teknik digital forensik untuk penyidik profesional.', image: '{{ asset('images/bg.png') }}' },
                    { title: 'Simulasi Kasus Siber', date: '3 Juli 2025', description: 'Simulasi penanganan insiden siber oleh tim ahli digital forensik.', image: '{{ asset('images/bg.png') }}' },
                    { title: 'Analisis Data', date: '10 Juni 2025', description: 'Analisis data forensik untuk menemukan pola aktivitas digital yang mencurigakan.', image: '{{ asset('images/bg.png') }}' },
                    { title: 'Tim Ahli', date: '15 Mei 2025', description: 'Potret tim ahli yang berperan penting dalam investigasi digital forensik.', image: '{{ asset('images/bg.png') }}' },
                    { title: 'Aksi di Lapangan', date: '1 Mei 2025', description: 'Dokumentasi aksi langsung tim investigasi digital di lokasi kejadian.', image: '{{ asset('images/bg.png') }}' },
                ],
                openModal(item) {
                    this.selectedTitle = item.title;
                    this.selectedImage = item.image;
                    this.selectedDate = item.date;
                    this.selectedDescription = item.description;
                    this.isOpen = true;
                },
                closeModal() {
                    this.isOpen = false;
                }
            }));
        });
    </script>

@endsection