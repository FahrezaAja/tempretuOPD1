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

  .mobile-link {
    display: block;
    padding: 10px 0;
    font-weight: 500;
    color: #333;
    transition: color 0.3s ease;
  }

  .mobile-link:hover {
    color: #4f46e5;
  }

  .mobile-sub {
    display: block;
    padding: 8px 0;
    font-size: 0.9rem;
    color: #555;
    transition: color 0.3s ease;
  }

  .mobile-sub:hover {
    color: #4f46e5;
  }

  @keyframes glow {
    0%, 100% {
      filter: drop-shadow(0 0 0 rgba(79, 70, 229, 0));
    }
    50% {
      filter: drop-shadow(0 0 8px rgba(79, 70, 229, 0.4));
    }
  }

  .animate-logo-glow {
    animation: glow 3s infinite ease-in-out;
  }
</style>

<nav x-data="{ open: false, scrolled: false }"
  x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 50)"
  :class="scrolled ? 'navbar-solid' : 'navbar-glass'"
  class="fixed top-0 left-0 right-0 transition-all duration-700 z-50">
  
  <div class="max-w-7xl mx-auto px-6 lg:px-10 py-4 flex items-center justify-between">

    {{-- === LOGO DINAMIS === --}}
    <a href="/" class="flex items-center space-x-3">
      <img 
        src="{{ $logo && $logo->media && file_exists(public_path('storage/' . $logo->media)) 
          ? asset('storage/' . $logo->media) 
          : asset('images/logoPPS.png') }}"
        alt="{{ $sampul->nama_opd ?? 'Logo Instansi' }}"
        class="h-12 w-auto animate-logo-glow">

      <span class="text-xl font-bold text-gray-800 tracking-wide">
        {{ $sampul->nama_opd ?? 'Kominfo Papua Selatan' }}
      </span>
    </a>

    {{-- === DESKTOP MENU === --}}
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

    {{-- === MOBILE TOGGLE === --}}
    <button @click="open = !open" class="md:hidden text-gray-800 focus:outline-none">
      <i :class="open ? 'fa-solid fa-xmark text-2xl' : 'fa-solid fa-bars text-2xl'"></i>
    </button>
  </div>

  {{-- === MOBILE MENU === --}}
  <div x-show="open" x-transition class="md:hidden bg-white/95 backdrop-blur-xl border-t border-gray-200 shadow-lg">
    <div class="px-6 py-4 space-y-3">
      <a href="/" class="mobile-link">Beranda</a>
      {{-- PROFIL --}}
      <div x-data="{ dropdownOpen: false }">
        <button @click="dropdownOpen = !dropdownOpen" class="w-full flex justify-between items-center mobile-link">
          Profil
          <i :class="dropdownOpen ? 'fa-solid fa-chevron-up text-sm' : 'fa-solid fa-chevron-down text-sm'"></i>
        </button>
        <div x-show="dropdownOpen" x-transition class="pl-4 mt-2 space-y-1">
          <a href="/sambutan" class="mobile-sub">Sambutan Kepala Badan</a>
          <a href="/profilOPD" class="mobile-sub">Profil Badan</a>
          <a href="/tupoksi" class="mobile-sub">Tugas Pokok & Fungsi</a>
          <a href="/strukturOrganisasi" class="mobile-sub">Struktur Organisasi</a>
        </div>
      </div>

      <a href="/galeri" class="mobile-link">Galeri</a>
      <a href="/kontak" class="mobile-link">Kontak</a>
    </div>
  </div>
</nav>
