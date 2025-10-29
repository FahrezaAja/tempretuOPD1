@extends('layouts.app')

@section('title', 'Berita Terbaru')

@section('content')
<section class="py-20">
    <div class="max-w-[1600px] mx-auto px-6 lg:px-20">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-extrabold text-gray-800 mb-4 text-indigo-600">Berita Terbaru</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            {{-- ===================== KOLOM BERITA ===================== --}}
            <div class="lg:col-span-10 grid sm:grid-cols-2 xl:grid-cols-3 gap-10">

                @forelse ($berita as $item)
                    <article
                        class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-1">
                        <div class="relative overflow-hidden">
                            @if($item->foto_sampul)
                                <img src="{{ asset('storage/' . $item->foto_sampul) }}" alt="{{ $item->judul }}"
                                    class="w-full h-72 object-cover transition-transform duration-500 hover:scale-105">
                            @else
                                <img src="https://source.unsplash.com/1200x800/?news,information"
                                    alt="{{ $item->judul }}" class="w-full h-72 object-cover">
                            @endif

                            @if($item->unggulan)
                                <span
                                    class="absolute top-4 left-4 bg-yellow-400 text-white px-3 py-1 text-xs font-semibold rounded-full shadow-md">
                                    ⭐ Unggulan
                                </span>
                            @endif
                        </div>

                        <div class="p-8 space-y-3">
                            <h3
                                class="text-xl font-bold text-gray-800 hover:text-indigo-600 transition duration-300 line-clamp-2">
                                {{ $item->judul }}
                            </h3>

                            <div class="flex items-center text-sm text-gray-500 space-x-2">
                                <i class="fa-regular fa-calendar"></i>
                                <span>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</span>
                                <span>•</span>
                                <span class="text-indigo-600 font-medium">{{ $item->kategori->nama }}</span>
                            </div>

                            <div class="pt-3">
                                <button onclick="openModal('viewModal{{ $item->id }}')"
                                    class="text-indigo-600 font-semibold hover:underline">
                                    Baca Selengkapnya →
                                </button>
                            </div>
                        </div>
                    </article>

                    {{-- ===================== MODAL BERITA ===================== --}}
                    <div id="viewModal{{ $item->id }}"
                        class="hidden fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-50 p-6">
                        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto transition-all transform scale-95 opacity-0 animate-fadeIn">
                            <div
                                class="flex justify-between items-center py-4 border-b bg-indigo-600 text-white rounded-t-2xl px-8">
                                <h5 class="font-semibold text-lg">{{ $item->judul }}</h5>
                                <button onclick="closeModal('viewModal{{ $item->id }}')" class="text-white text-2xl">&times;</button>
                            </div>

                            <div class="p-8 space-y-6">
                                @if($item->foto_sampul)
                                    <img src="{{ asset('storage/' . $item->foto_sampul) }}" alt="Foto Sampul"
                                        class="w-full h-64 object-cover rounded-lg shadow">
                                @endif

                                @if($item->foto_berita)
                                    <div class="grid grid-cols-3 gap-3 mt-4">
                                        @foreach($item->foto_berita as $foto)
                                            <img src="{{ asset('storage/' . $foto) }}" alt="Foto Berita"
                                                class="w-full h-32 object-cover rounded border border-gray-200">
                                        @endforeach
                                    </div>
                                @endif

                                
                                <div class="flex flex-wrap gap-4 text-sm text-gray-600 mt-3 items-center">
                                    <span><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</span>
                                    <span><strong>Kategori:</strong> {{ $item->kategori->nama }}</span>
                                </div>

                                <hr class="border-gray-300">

                                <div class="prose max-w-none text-gray-800 leading-relaxed ck-content">
                                    {!! $item->deskripsi !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500 text-lg py-10">
                        Belum ada berita yang tersedia.
                    </div>
                @endforelse
            </div>

            {{-- ===================== KOLOM KATEGORI ===================== --}}
            <aside class="lg:col-span-2 bg-white rounded-3xl shadow-md p-8 h-fit self-start">
                <h4 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Kategori</h4>
                <ul class="space-y-4">
                    
                    <li>
                        <a href="{{ route('berita-terbaru') }}"
                            class="flex justify-between items-center {{ !$kategoriFilter ? 'text-indigo-700 font-bold' : 'text-gray-700 hover:text-indigo-600' }}">
                            <span>Semua Kategori</span>
                            <span class="text-sm bg-indigo-50 text-indigo-700 font-semibold px-2 py-0.5 rounded-md">
                                {{ $berita->count() }}
                            </span>
                        </a>
                    </li>

                    
                    @foreach ($kategori as $kat)
                        <li>
                            <a href="{{ route('berita-terbaru', ['kategori' => $kat->nama]) }}"
                                class="flex justify-between items-center {{ $kategoriFilter == $kat->nama ? 'text-indigo-700 font-bold' : 'text-gray-700 hover:text-indigo-600' }}">
                                <span>{{ $kat->nama }}</span>
                                <span class="text-sm bg-indigo-50 text-indigo-700 font-semibold px-2 py-0.5 rounded-md">
                                    {{ $kat->berita_count }}
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </aside>

        </div>
    </div>
</section>


<script>
    function openModal(id) {
        const modal = document.getElementById(id);
        modal.classList.remove('hidden');
        modal.querySelector('div').classList.add('scale-100', 'opacity-100');
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        modal.classList.add('hidden');
    }
</script>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}
.animate-fadeIn {
    animation: fadeIn 0.2s ease-out forwards;
}
</style>
@endsection
