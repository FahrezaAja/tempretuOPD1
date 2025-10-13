<aside class="bg-gray-800 text-gray-100 w-64 h-screen flex flex-col fixed top-0 left-0 z-40 overflow-y-auto" x-data="{ profilOpen: false, unitOpen: false, dokumenOpen: false, galeriOpen: false }">
    {{-- 🔹 Header Sidebar dengan Logo --}}
    <div class="px-6 py-4 flex items-center justify-start border-b border-gray-700">
        <img src="{{ asset('images/logoPPS.png') }}" alt="Logo" class="h-13 w-10 mr-3 object-cover">
        <h1 class="text-xl font-bold">Admin Panel</h1>
    </div>

    <nav class="flex-1 px-4 py-6">
        <ul class="space-y-2">

            <!-- Dashboard -->
            <li>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2 rounded hover:bg-gray-700 transition">
                    <i class="fas fa-tachometer-alt mr-3 w-5 text-center"></i>
                    Dashboard
                </a>
            </li>

            <!-- Profil Dropdown -->
            <li x-data="{ open: false }">
                <button @click="open = !open" class="flex justify-between items-center w-full px-3 py-2 rounded hover:bg-gray-700 transition focus:outline-none">
                    <span class="flex items-center">
                        <i class="fas fa-user mr-3 w-5 text-center"></i>
                        Profil
                    </span>
                    <i :class="{'fa-rotate-90': open}" class="fas fa-chevron-right transition-transform w-3 text-center"></i>
                </button>
                <ul x-show="open" x-transition class="mt-1 pl-8 space-y-1 text-sm text-gray-300">
                    <li><a href="#" class="block px-2 py-1 rounded hover:bg-gray-700">Sambutan Kepala Badan</a></li>
                    <li><a href="#" class="block px-2 py-1 rounded hover:bg-gray-700">Profil Badan</a></li>
                    <li><a href="#" class="block px-2 py-1 rounded hover:bg-gray-700">Tupoksi</a></li>
                    <li><a href="#" class="block px-2 py-1 rounded hover:bg-gray-700">Struktur Organisasi</a></li>
                </ul>
            </li>

            <!-- Unit Kerja Dropdown -->
            <li x-data="{ open: false }">
                <button @click="open = !open" class="flex justify-between items-center w-full px-3 py-2 rounded hover:bg-gray-700 transition focus:outline-none">
                    <span class="flex items-center">
                        <i class="fas fa-building mr-3 w-5 text-center"></i>
                        Unit Kerja
                    </span>
                    <i :class="{'fa-rotate-90': open}" class="fas fa-chevron-right transition-transform w-3 text-center"></i>
                </button>
                <ul x-show="open" x-transition class="mt-1 pl-8 space-y-1 text-sm text-gray-300">
                    <li><a href="#" class="block px-2 py-1 rounded hover:bg-gray-700">Sekretariat</a></li>
                    <li><a href="#" class="block px-2 py-1 rounded hover:bg-gray-700">Bidang Politik</a></li>
                    <li><a href="#" class="block px-2 py-1 rounded hover:bg-gray-700">Bidang Kesatuan Bangsa</a></li>
                </ul>
            </li>

            <!-- Dokumen Dropdown -->
            <li x-data="{ open: false }">
                <button @click="open = !open" class="flex justify-between items-center w-full px-3 py-2 rounded hover:bg-gray-700 transition focus:outline-none">
                    <span class="flex items-center">
                        <i class="fas fa-file-alt mr-3 w-5 text-center"></i>
                        Dokumen
                    </span>
                    <i :class="{'fa-rotate-90': open}" class="fas fa-chevron-right transition-transform w-3 text-center"></i>
                </button>
                <ul x-show="open" x-transition class="mt-1 pl-8 space-y-1 text-sm text-gray-300">
                    <li><a href="#" class="block px-2 py-1 rounded hover:bg-gray-700">Program Kegiatan</a></li>
                    <li><a href="#" class="block px-2 py-1 rounded hover:bg-gray-700">Produk Hukum</a></li>
                </ul>
            </li>

            <!-- Berita -->
            <li>
                <a href="#" class="flex items-center px-3 py-2 rounded hover:bg-gray-700 transition">
                    <i class="fas fa-newspaper mr-3 w-5 text-center"></i>
                    Berita
                </a>
            </li>

            <!-- Galeri Dropdown -->
            <li x-data="{ open: false }">
                <button @click="open = !open" class="flex justify-between items-center w-full px-3 py-2 rounded hover:bg-gray-700 transition focus:outline-none">
                    <span class="flex items-center">
                        <i class="fas fa-photo-video mr-3 w-5 text-center"></i>
                        Galeri
                    </span>
                    <i :class="{'fa-rotate-90': open}" class="fas fa-chevron-right transition-transform w-3 text-center"></i>
                </button>
                <ul x-show="open" x-transition class="mt-1 pl-8 space-y-1 text-sm text-gray-300">
                    <li><a href="#" class="block px-2 py-1 rounded hover:bg-gray-700">Galeri Video</a></li>
                    <li><a href="#" class="block px-2 py-1 rounded hover:bg-gray-700">Galeri Foto</a></li>
                </ul>
            </li>

            <!-- Kontak -->
            <li>
                <a href="#" class="flex items-center px-3 py-2 rounded hover:bg-gray-700 transition">
                    <i class="fas fa-envelope mr-3 w-5 text-center"></i>
                    Kontak
                </a>
            </li>

        </ul>
    </nav>
</aside>
