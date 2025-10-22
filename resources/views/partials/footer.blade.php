<footer class="bg-gray-900 text-gray-300 pt-14 pb-8 mt-20">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10 grid grid-cols-1 md:grid-cols-3 gap-12">

        {{-- 🔹 Kolom 1: Logo & Deskripsi --}}
        <div>
            <div class="flex items-center space-x-3 mb-4">
                {{-- Logo dinamis --}}
                <img src="{{ $logo && $logo->media && file_exists(public_path('storage/' . $logo->media)) 
                    ? asset('storage/' . $logo->media) 
                    : asset('images/logoPPS.png') }}"
                    alt="{{ $sampul->nama_instansi ?? 'Logo Instansi' }}"
                    class="h-12 w-auto object-contain">

                <h2 class="text-lg font-semibold text-white">
                    {{ $sampul->nama_opd ?? 'Kominfo Papua Selatan' }}
                </h2>
            </div>
            <p class="text-gray-400 leading-relaxed text-sm">
                {!! $sampul->deskripsi ?? 'Dinas Komunikasi dan Informatika Papua Selatan berkomitmen untuk membangun sistem informasi yang aman, transparan, dan mendukung tata kelola pemerintahan digital.' !!}
            </p>
        </div>

        {{-- 🔹 Kolom 2: Aplikasi Kami --}}
        <div>
            <h2 class="text-white font-semibold text-lg mb-4">Aplikasi Kami</h2>
            <ul class="space-y-2 text-sm">
                @forelse ($aplikasi as $item)
                    <li>
                        <a href="{{ $item->link ?? '#' }}" target="_blank" rel="noopener noreferrer"
                           class="hover:text-blue-400 transition duration-200 flex items-center gap-2">
                            <i class="fas fa-external-link-alt text-xs text-blue-500"></i>
                            {{ $item->nama ?? 'E-Aplikasi' }}
                        </a>
                    </li>
                @empty
                    <li class="text-gray-500">Belum ada aplikasi yang ditambahkan.</li>
                @endforelse
            </ul>
        </div>

        {{-- 🔹 Kolom 3: Kontak & Sosial Media --}}
        <div>
            <h2 class="text-white font-semibold text-lg mb-4">Hubungi Kami</h2>
            <ul class="space-y-2 text-sm mb-5">
                <li class="flex items-center space-x-3">
                    <i class="fas fa-envelope text-blue-400"></i>
                    <span>{{ $kontak->email ?? 'info@kominfopapuaselatan.go.id' }}</span>
                </li>
                <li class="flex items-center space-x-3">
                    <i class="fas fa-map-marker-alt text-blue-400"></i>
                    <span>{{ $kontak->alamat ?? 'Jl. Merdeka No. 45, Merauke, Papua Selatan' }}</span>
                </li>
                <li class="flex items-center space-x-3">
                    <i class="fas fa-phone text-blue-400"></i>
                    <span>{{ $kontak->telepon ?? '(0971) 123-4567' }}</span>
                </li>
            </ul>

            {{-- 🔹 Sosial Media Dinamis --}}
            <div class="flex space-x-4 mt-4">
                @if(!empty($sosmed->facebook))
                    <a href="{{ $sosmed->facebook }}" target="_blank" rel="noopener noreferrer"
                        class="bg-blue-600 hover:bg-blue-700 text-white w-9 h-9 flex items-center justify-center rounded-full transition transform hover:-translate-y-1 shadow-md">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                @endif

                @if(!empty($sosmed->instagram))
                    <a href="{{ $sosmed->instagram }}" target="_blank" rel="noopener noreferrer"
                        class="bg-gradient-to-tr from-pink-500 to-yellow-400 hover:opacity-90 text-white w-9 h-9 flex items-center justify-center rounded-full transition transform hover:-translate-y-1 shadow-md">
                        <i class="fab fa-instagram"></i>
                    </a>
                @endif

                @if(!empty($sosmed->tiktok))
                    <a href="{{ $sosmed->tiktok }}" target="_blank" rel="noopener noreferrer"
                        class="bg-black hover:bg-gray-800 text-white w-9 h-9 flex items-center justify-center rounded-full transition transform hover:-translate-y-1 shadow-md">
                        <i class="fab fa-tiktok"></i>
                    </a>
                @endif

                @if(!empty($sosmed->youtube))
                    <a href="{{ $sosmed->youtube }}" target="_blank" rel="noopener noreferrer"
                        class="bg-red-600 hover:bg-red-700 text-white w-9 h-9 flex items-center justify-center rounded-full transition transform hover:-translate-y-1 shadow-md">
                        <i class="fab fa-youtube"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>

    {{-- 🔹 Garis Pemisah --}}
    <div class="border-t border-gray-700 mt-10 pt-6 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} 
        <span class="text-white font-semibold">Kominfo Papua Selatan</span>. 
        Semua hak dilindungi.
    </div>
</footer>
