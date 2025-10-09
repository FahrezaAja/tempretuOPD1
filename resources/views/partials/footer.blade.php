<footer class="bg-gray-900 text-gray-300 pt-14 pb-8 mt-20">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10 grid grid-cols-1 md:grid-cols-3 gap-12">

        {{-- 🔹 Kolom 1: Logo & Deskripsi --}}
        <div>
            <div class="flex items-center space-x-3 mb-4">
                {{-- Logo tanpa bentuk bulat --}}
                <img src="{{ asset('images/logoPPS.png') }}" alt="Logo Kominfo" class="h-12 w-auto object-contain">

                <h2 class="text-lg font-semibold text-white">Kominfo Papua Selatan</h2>
            </div>
            <p class="text-gray-400 leading-relaxed text-sm">
                Dinas Komunikasi dan Informatika Papua Selatan berkomitmen untuk membangun sistem informasi yang aman,
                transparan, dan mendukung tata kelola pemerintahan digital.
            </p>
        </div>

        {{-- 🔹 Kolom 2: Tautan Cepat --}}
        <div>
            <h2 class="text-white font-semibold text-lg mb-4">Aplikasi Kami</h2>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ url('/') }}" class="hover:text-blue-400 transition">E-Aplikasi</a></li>
                <li><a href="{{ url('/profil') }}" class="hover:text-blue-400 transition">E-Aplikasi</a></li>
                <li><a href="{{ url('/layanan') }}" class="hover:text-blue-400 transition">E-Aplikasi</a></li>
                <li><a href="{{ url('/berita') }}" class="hover:text-blue-400 transition">E-Aplikasi</a></li>
                <li><a href="{{ url('/kontak') }}" class="hover:text-blue-400 transition">E-Aplikasi</a></li>
            </ul>
        </div>

        {{-- 🔹 Kolom 3: Kontak & Sosial Media --}}
        <div>
            <h2 class="text-white font-semibold text-lg mb-4">Hubungi Kami</h2>
            <ul class="space-y-2 text-sm mb-5">
                <li class="flex items-center space-x-3">
                    <i class="fas fa-envelope text-blue-400"></i>
                    <span>info@kominfopapuaselatan.go.id</span>
                </li>
                <li class="flex items-center space-x-3">
                    <i class="fas fa-map-marker-alt text-blue-400"></i>
                    <span>Jl. Merdeka No. 45, Merauke, Papua Selatan</span>
                </li>
                <li class="flex items-center space-x-3">
                    <i class="fas fa-phone text-blue-400"></i>
                    <span>(0971) 123-4567</span>
                </li>
            </ul>

            {{-- 🔹 Sosial Media --}}
            <div class="flex space-x-4 mt-4">
                <a href="https://facebook.com" target="_blank"
                    class="bg-blue-600 hover:bg-blue-700 text-white w-9 h-9 flex items-center justify-center rounded-full transition transform hover:-translate-y-1 shadow-md">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://instagram.com" target="_blank"
                    class="bg-gradient-to-tr from-pink-500 to-yellow-400 hover:opacity-90 text-white w-9 h-9 flex items-center justify-center rounded-full transition transform hover:-translate-y-1 shadow-md">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://tiktok.com" target="_blank"
                    class="bg-black hover:bg-gray-800 text-white w-9 h-9 flex items-center justify-center rounded-full transition transform hover:-translate-y-1 shadow-md">
                    <i class="fab fa-tiktok"></i>
                </a>
                <a href="https://youtube.com" target="_blank"
                    class="bg-red-600 hover:bg-red-700 text-white w-9 h-9 flex items-center justify-center rounded-full transition transform hover:-translate-y-1 shadow-md">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- 🔹 Garis Pemisah --}}
    <div class="border-t border-gray-700 mt-10 pt-6 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} <span class="text-white font-semibold">Kominfo Papua Selatan</span>. Semua hak
        dilindungi.
    </div>
</footer>