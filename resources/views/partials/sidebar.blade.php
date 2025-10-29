<aside class="bg-gray-800 text-gray-100 w-64 h-screen flex flex-col fixed top-0 left-0 z-40 overflow-y-auto"
    x-data="{ profilOpen: false, unitOpen: false, dokumenOpen: false, galeriOpen: false }">

    {{-- 🔹 Header Sidebar dengan Logo --}}
    <div class="px-6 py-4 flex items-center justify-start border-b border-gray-700">
        <a href="/" class="flex items-center space-x-3">
            <img src="{{ $logo && $logo->image && file_exists(public_path('storage/' . $logo->image))
    ? asset('storage/' . $logo->image)
    : asset('images/logoPPS.png') }}" alt="{{ $sampul->nama_opd ?? 'Logo Instansi' }}"
                class="h-12 w-auto object-contain flex-shrink-0">
            <h1 class="text-xl font-bold">Admin Panel</h1>
    </div>

    {{-- 🔹 Navigasi --}}
    <nav class="flex-1 px-4 py-6">
        <ul class="space-y-2">

            <!-- Dashboard -->
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-3 py-2 rounded hover:bg-gray-700 transition">
                    <i class="fas fa-tachometer-alt mr-3 w-5 text-center"></i>
                    Dashboard
                </a>
            </li>

            <!-- Logo -->
            <li>
                <a href="{{ route('admin.logoAdmin') }}"
                    class="flex items-center px-3 py-2 rounded hover:bg-gray-700 transition">
                    <i class="fas fa-image mr-3 w-5 text-center"></i>
                    Logo
                </a>
            </li>

            <!-- Sampul -->
            <li>
                <a href="{{ route('admin.sampulAdmin') }}"
                    class="flex items-center px-3 py-2 rounded hover:bg-gray-700 transition">
                    <i class="fas fa-book-open mr-3 w-5 text-center"></i>
                    Sampul
                </a>
            </li>

            <!-- Profil Dropdown -->
            <li x-data="{ open: false }">
                <button @click="open = !open"
                    class="flex justify-between items-center w-full px-3 py-2 rounded hover:bg-gray-700 transition focus:outline-none">
                    <span class="flex items-center">
                        <i class="fas fa-user mr-3 w-5 text-center"></i>
                        Profil OPD
                    </span>
                    <i :class="{'fa-rotate-90': open}"
                        class="fas fa-chevron-right transition-transform w-3 text-center"></i>
                </button>
                <ul x-show="open" x-transition class="mt-1 pl-8 space-y-1 text-sm text-gray-300">
                    <li><a href="{{ route('admin.sambutanAdmin') }}"
                            class="block px-2 py-1 rounded hover:bg-gray-700">Sambutan Kepala Badan</a></li>
                    <li><a href="{{ route('admin.profilOPDAdmin') }}"
                            class="block px-2 py-1 rounded hover:bg-gray-700">Profil Badan</a></li>
                    <li><a href="{{ route('admin.tupoksiAdmin') }}"
                            class="block px-2 py-1 rounded hover:bg-gray-700">Tupoksi</a></li>
                    <li><a href="{{ route('admin.strukturOrganisasiAdmin') }}"
                            class="block px-2 py-1 rounded hover:bg-gray-700">Struktur Organisasi</a></li>
                </ul>
            </li>

            <!-- Unit Kerja Dropdown -->
            <li x-data="{ open: false }">
                <button @click="open = !open"
                    class="flex justify-between items-center w-full px-3 py-2 rounded hover:bg-gray-700 transition focus:outline-none">
                    <span class="flex items-center">
                        <i class="fas fa-building mr-3 w-5 text-center"></i>
                        Unit Kerja
                    </span>
                    <i :class="{'fa-rotate-90': open}"
                        class="fas fa-chevron-right transition-transform w-3 text-center"></i>
                </button>
                <ul x-show="open" x-transition class="mt-1 pl-8 space-y-1 text-sm text-gray-300">
                    <li><a href="{{ route('admin.sekretariatAdmin') }}"
                            class="block px-2 py-1 rounded hover:bg-gray-700">Sekretariat</a></li>
                    <li><a href="{{ route('admin.bidangPolitikAdmin') }}"
                            class="block px-2 py-1 rounded hover:bg-gray-700">Bidang Politik</a></li>
                    <li><a href="{{ route('admin.bidangKesatuanBangsaAdmin') }}"
                            class="block px-2 py-1 rounded hover:bg-gray-700">Bidang Kesatuan Bangsa</a></li>
                </ul>
            </li>

            <!-- Dokumen Dropdown -->
            <li x-data="{ open: false }">
                <button @click="open = !open"
                    class="flex justify-between items-center w-full px-3 py-2 rounded hover:bg-gray-700 transition focus:outline-none">
                    <span class="flex items-center">
                        <i class="fas fa-file-alt mr-3 w-5 text-center"></i>
                        Dokumen
                    </span>
                    <i :class="{'fa-rotate-90': open}"
                        class="fas fa-chevron-right transition-transform w-3 text-center"></i>
                </button>
                <ul x-show="open" x-transition class="mt-1 pl-8 space-y-1 text-sm text-gray-300">
                    <li><a href="{{ route('admin.programKegiatanAdmin') }}"
                            class="block px-2 py-1 rounded hover:bg-gray-700">Program Kegiatan</a></li>
                    <li><a href="{{ route('admin.produkHukumAdmin') }}"
                            class="block px-2 py-1 rounded hover:bg-gray-700">Produk Hukum</a></li>
                </ul>
            </li>

            <!-- Berita Dropdown -->
            <li x-data="{ open: false }">
                <button @click="open = !open"
                    class="flex justify-between items-center w-full px-3 py-2 rounded hover:bg-gray-700 transition focus:outline-none">
                    <span class="flex items-center">
                        <i class="fas fa-newspaper mr-3 w-5 text-center"></i>
                        Berita
                    </span>
                    <i :class="{'fa-rotate-90': open}"
                        class="fas fa-chevron-right transition-transform w-3 text-center"></i>
                </button>
                <ul x-show="open" x-transition class="mt-1 pl-8 space-y-1 text-sm text-gray-300">
                    <li><a href="{{ route('admin.beritaAdmin') }}"
                            class="block px-2 py-1 rounded hover:bg-gray-700">Berita Terbaru</a></li>
                    <li><a href="{{ route('admin.kategoriAdmin') }}"
                            class="block px-2 py-1 rounded hover:bg-gray-700">Kategori</a></li>
                </ul>
            </li>

            <!-- Galeri Dropdown -->
            <li x-data="{ open: false }">
                <button @click="open = !open"
                    class="flex justify-between items-center w-full px-3 py-2 rounded hover:bg-gray-700 transition focus:outline-none">
                    <span class="flex items-center">
                        <i class="fas fa-photo-video mr-3 w-5 text-center"></i>
                        Galeri
                    </span>
                    <i :class="{'fa-rotate-90': open}"
                        class="fas fa-chevron-right transition-transform w-3 text-center"></i>
                </button>
                <ul x-show="open" x-transition class="mt-1 pl-8 space-y-1 text-sm text-gray-300">
                    <li><a href="{{ route('admin.galeriVideoAdmin') }}"
                            class="block px-2 py-1 rounded hover:bg-gray-700">Galeri Video</a></li>
                    <li><a href="{{ route('admin.galeriFotoAdmin') }}"
                            class="block px-2 py-1 rounded hover:bg-gray-700">Galeri Foto</a></li>
                </ul>
            </li>

            <!-- Informasi Dropdown -->
            <li x-data="{ open: false }">
                <button @click="open = !open"
                    class="flex justify-between items-center w-full px-3 py-2 rounded hover:bg-gray-700 transition focus:outline-none">
                    <span class="flex items-center">
                        <i class="fas fa-phone mr-3 w-5 text-center"></i>
                        Informasi
                    </span>
                    <i :class="{'fa-rotate-90': open}"
                        class="fas fa-chevron-right transition-transform w-3 text-center"></i>
                </button>
                <ul x-show="open" x-transition class="mt-1 pl-8 space-y-1 text-sm text-gray-300">
                    <li><a href="{{ route('admin.kontakAdmin') }}"
                            class="block px-2 py-1 rounded hover:bg-gray-700">Kontak</a></li>
                    <li><a href="{{ route('admin.aplikasiAdmin') }}"
                            class="block px-2 py-1 rounded hover:bg-gray-700">Aplikasi</a></li>
                    <li><a href="{{ route('admin.sosmedAdmin') }}"
                            class="block px-2 py-1 rounded hover:bg-gray-700">Sosial Media</a></li>
                </ul>
            </li>

        </ul>
    </nav>

    
    <div class="px-4 py-4 border-t border-gray-700 mt-auto">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded transition">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </button>
        </form>
    </div>

</aside>