@vite(['resources/js/app.js'])

<style>
  /* ===== NAVBAR GLOBAL STYLING ===== */
  .navbar-glass {
    background: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(14px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
  }

  .navbar-solid {
    background: #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }

  .nav-link {
    position: relative;
    color: #333;
    font-weight: 500;
    transition: color 0.3s ease;
  }

  .nav-link:hover {
    color: #4f46e5;
  }

  .nav-link::after {
    content: '';
    position: absolute;
    bottom: -3px;
    left: 0;
    width: 0;
    height: 2px;
    background: #4f46e5;
    transition: width 0.3s ease;
  }

  .nav-link:hover::after {
    width: 100%;
  }

  .dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    margin-top: 8px;
    background: white;
    border-radius: 0.5rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    min-width: 180px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-8px);
    transition: all 0.25s ease;
    overflow: hidden;
    z-index: 50;
  }

  .group:hover .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
  }

  .dropdown-item {
    display: block;
    padding: 10px 16px;
    color: #333;
    font-size: 0.95rem;
    transition: all 0.2s ease;
  }

  .dropdown-item:hover {
    background: #eef2ff;
    color: #4f46e5;
  }

  .mobile-link, .mobile-sub {
    display: block;
    text-align: center;
    font-weight: 500;
    color: #333;
    transition: color 0.3s ease;
  }

  .mobile-link:hover, .mobile-sub:hover {
    color: #4f46e5;
  }

  .mobile-sub {
    padding: 8px 0;
    font-size: 0.95rem;
    color: #555;
  }

  @keyframes glow {
    0%,100% { filter: drop-shadow(0 0 0 rgba(79, 70, 229, 0)); }
    50% { filter: drop-shadow(0 0 8px rgba(79, 70, 229, 0.4)); }
  }

  .animate-logo-glow {
    animation: glow 3s infinite ease-in-out;
  }
</style>

<nav x-data="{ open: false, scrolled: false }"
     x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 50)"
     :class="scrolled ? 'navbar-solid' : 'navbar-glass'"
     class="fixed top-0 left-0 right-0 transition-all duration-700 z-50">

  <div class="w-full px-6 lg:px-10 py-4 flex items-center justify-between">

    
    <a href="/" class="flex items-center space-x-3">
      <img src="{{ $logo && $logo->image && file_exists(public_path('storage/' . $logo->image))
          ? asset('storage/' . $logo->image)
          : asset('images/logoPPS.png') }}"
           alt="{{ $sampul->nama_instansi ?? 'Logo Instansi' }}"
           class="h-12 w-auto object-contain flex-shrink-0">
      <div class="flex flex-col leading-tight">
        <span class="text-xl font-bold text-gray-800 tracking-wide">
          {{ $sampul->nama_opd ?? 'Kominfo Papua Selatan' }}
        </span>
        <span class="text-xs text-gray-600 -mt-1">Papua Selatan</span>
      </div>
    </a>

    {{-- DESKTOP MENU --}}
    <div class="hidden md:flex items-center space-x-10">
      <a href="/" class="nav-link">Beranda</a>
      <div class="relative group">
        <div class="flex items-center nav-link cursor-pointer">
          <span>Profil</span>
          <i class="fa-solid fa-chevron-down ml-2 text-xs"></i>
        </div>
        <div class="dropdown-menu">
          <a href="/sambutan" class="dropdown-item">Sambutan Kepala Badan</a>
          <a href="/profilOPD" class="dropdown-item">Profil Badan</a>
          <a href="/tupoksi" class="dropdown-item">Tugas Pokok & Fungsi</a>
          <a href="/struktur-organisasi" class="dropdown-item">Struktur Organisasi</a>
        </div>
      </div>
      <div class="relative group">
        <div class="flex items-center nav-link cursor-pointer">
          <span>Unit Kerja</span>
          <i class="fa-solid fa-chevron-down ml-2 text-xs"></i>
        </div>
        <div class="dropdown-menu">
          <a href="/sekretariat" class="dropdown-item">Sekretariat</a>
          <a href="/bidang-politik" class="dropdown-item">Bidang Politik</a>
          <a href="/bidang-kesatuan-bangsa" class="dropdown-item">Bidang Kesatuan Bangsa</a>
        </div>
      </div>
      <div class="relative group">
        <div class="flex items-center nav-link cursor-pointer">
          <span>Dokumen</span>
          <i class="fa-solid fa-chevron-down ml-2 text-xs"></i>
        </div>
        <div class="dropdown-menu">
          <a href="/program-kegiatan" class="dropdown-item">Program Kegiatan</a>
          <a href="/produk-hukum" class="dropdown-item">Produk Hukum</a>
        </div>
      </div>
      <div class="relative group">
        <div class="flex items-center nav-link cursor-pointer">
          <span>Berita</span>
          <i class="fa-solid fa-chevron-down ml-2 text-xs"></i>
        </div>
        <div class="dropdown-menu">
          <a href="/berita-terbaru" class="dropdown-item">Berita Terbaru</a>
          <a href="/kategori" class="dropdown-item">Kategori</a>
        </div>
      </div>
      <a href="/galeri" class="nav-link">Galeri</a>
      <a href="/kontak" class="nav-link">Kontak</a>
    </div>

    {{-- MOBILE TOGGLE --}}
    <button @click="open = !open" class="md:hidden text-gray-800 focus:outline-none">
      <i :class="open ? 'fa-solid fa-xmark text-2xl' : 'fa-solid fa-bars text-2xl'"></i>
    </button>
  </div>

  {{-- MOBILE MENU --}}
  <div x-show="open" x-transition
       class="md:hidden bg-white/95 backdrop-blur-xl border-t border-gray-200 shadow-lg">

    <div class="px-6 py-6 flex flex-col items-center space-y-4">
      <a href="/" class="mobile-link"><i class="fa-solid fa-house mr-2"></i> Beranda</a>

      <div x-data="{ pOpen: false }" class="w-full">
        <button @click="pOpen = !pOpen"
                class="w-full flex justify-center items-center mobile-link">
          <i class="fa-solid fa-user mr-2"></i> Profil
          <i :class="pOpen ? 'fa-solid fa-chevron-up ml-2' : 'fa-solid fa-chevron-down ml-2'"></i>
        </button>
        <div x-show="pOpen" x-transition class="mt-2 space-y-1">
          <a href="/sambutan" class="mobile-sub">Sambutan Kepala Badan</a>
          <a href="/profilOPD" class="mobile-sub">Profil Badan</a>
          <a href="/tupoksi" class="mobile-sub">Tugas Pokok & Fungsi</a>
          <a href="/struktur-organisasi" class="mobile-sub">Struktur Organisasi</a>
        </div>
      </div>

      <div x-data="{ uOpen: false }" class="w-full">
        <button @click="uOpen = !uOpen"
                class="w-full flex justify-center items-center mobile-link">
          <i class="fa-solid fa-building mr-2"></i> Unit Kerja
          <i :class="uOpen ? 'fa-solid fa-chevron-up ml-2' : 'fa-solid fa-chevron-down ml-2'"></i>
        </button>
        <div x-show="uOpen" x-transition class="mt-2 space-y-1">
          <a href="/sekretariat" class="mobile-sub">Sekretariat</a>
          <a href="/bidang-politik" class="mobile-sub">Bidang Politik</a>
          <a href="/bidang-kesatuan-bangsa" class="mobile-sub">Bidang Kesatuan Bangsa</a>
        </div>
      </div>

      <div x-data="{ dOpen: false }" class="w-full">
        <button @click="dOpen = !dOpen"
                class="w-full flex justify-center items-center mobile-link">
          <i class="fa-solid fa-file-lines mr-2"></i> Dokumen
          <i :class="dOpen ? 'fa-solid fa-chevron-up ml-2' : 'fa-solid fa-chevron-down ml-2'"></i>
        </button>
        <div x-show="dOpen" x-transition class="mt-2 space-y-1">
          <a href="/program-kegiatan" class="mobile-sub">Program Kegiatan</a>
          <a href="/produk-hukum" class="mobile-sub">Produk Hukum</a>
        </div>
      </div>

      <div x-data="{ bOpen: false }" class="w-full">
        <button @click="bOpen = !bOpen"
                class="w-full flex justify-center items-center mobile-link">
          <i class="fa-solid fa-newspaper mr-2"></i> Berita
          <i :class="bOpen ? 'fa-solid fa-chevron-up ml-2' : 'fa-solid fa-chevron-down ml-2'"></i>
        </button>
        <div x-show="bOpen" x-transition class="mt-2 space-y-1">
          <a href="/berita-terbaru" class="mobile-sub">Berita Terbaru</a>
          <a href="/kategori" class="mobile-sub">Kategori</a>
        </div>
      </div>

      <a href="/galeri" class="mobile-link"><i class="fa-solid fa-images mr-2"></i> Galeri</a>
      <a href="/kontak" class="mobile-link"><i class="fa-solid fa-envelope mr-2"></i> Kontak</a>
    </div>
  </div>
</nav>
