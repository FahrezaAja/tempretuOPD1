@extends('layouts.app')

@section('title', 'Dokumen Produk Hukum')

@section('content')

    <section x-data="documentManager({{ $produkHukum->toJson() }}, {{ $kategoriList->toJson() }})" x-init="init()"
        class="px-6 md:px-20 py-20">


        <div class="flex flex-col md:flex-row items-center justify-between mb-8">
            <h1 class="text-4xl md:text-5xl font-extrabold text-indigo-700 mb-4 md:mb-0">Dokumen Produk Hukum</h1>


            <div class="flex gap-2">
                <button @click="view='table'"
                    :class="view==='table' ? 'bg-indigo-700 text-white' : 'bg-white text-indigo-700 border border-indigo-700'"
                    class="px-4 py-2 rounded-lg font-semibold transition-colors">
                    Tabel
                </button>
                <button @click="view='card'"
                    :class="view==='card' ? 'bg-indigo-700 text-white' : 'bg-white text-indigo-700 border border-indigo-700'"
                    class="px-4 py-2 rounded-lg font-semibold transition-colors">
                    Card
                </button>
            </div>
        </div>

        {{-- ===================== FILTER & SEARCH BAR ===================== --}}
        <div class="flex flex-wrap items-center gap-3 mb-6">
            <input type="search" x-model="search" placeholder="Cari penulis, nomor, tahun, nama file, atau kategori..."
                class="border border-gray-300 rounded-lg px-4 py-2 flex-1 min-w-[200px] focus:outline-none focus:ring focus:ring-indigo-300">

            <select x-model="kategori" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-indigo-300">
                <option value="ALL">Semua Kategori</option>
                <template x-for="k in kategoriList" :key="k">
                    <option x-text="k"></option>
                </template>
            </select>

            <select x-model="sortOrder"
                class="border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-indigo-300">
                <option value="asc">Urutkan A → Z</option>
                <option value="desc">Urutkan Z → A</option>
            </select>

            <span class="ml-auto text-gray-500 text-sm"
                x-text="`${filteredDocuments.length} dari ${documents.length} dokumen`"></span>
        </div>


        <div class="relative">

            {{-- ===================== TABLE VIEW ===================== --}}
            <div x-show="view==='table'" x-transition x-cloak class="overflow-x-auto shadow-lg rounded-xl bg-white">
                <table class="min-w-full border border-gray-200 shadow-sm rounded-lg overflow-hidden">
                    <thead
                        class="bg-gradient-to-r from-indigo-700 to-indigo-600 text-white uppercase text-sm tracking-wide">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold">Penulis</th>
                            <th class="px-6 py-3 text-left font-semibold">Nomor</th>
                            <th class="px-6 py-3 text-left font-semibold">Tahun</th>
                            <th class="px-6 py-3 text-left font-semibold">Nama File</th>
                            <th class="px-6 py-3 text-left font-semibold">Kategori</th>
                            <th class="px-6 py-3 text-left font-semibold">Tanggal</th>
                            <th class="px-6 py-3 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 bg-white">
                        <template x-for="doc in filteredDocuments" :key="doc.id">
                            <tr class="hover:bg-indigo-50 transition-all duration-200 ease-in-out">
                                <td class="px-6 py-4 text-gray-800 font-medium" x-text="doc.penulis"></td>
                                <td class="px-6 py-4 text-gray-600" x-text="doc.nomor"></td>
                                <td class="px-6 py-4 text-gray-600" x-text="doc.tahun"></td>
                                <td class="px-6 py-4">
                                    <span class="text-indigo-700 font-semibold" x-text="doc.nama_file"></span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-semibold"
                                        x-text="doc.kategori"></span>
                                </td>
                                <td class="px-6 py-4 text-gray-600" x-text="doc.tanggal"></td>
                                <td class="px-6 py-4 text-center">
                                    <a :href="`/storage/${doc.file}`" :download="`${doc.nama_file}`"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3" />
                                        </svg>
                                        Unduh
                                    </a>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>

            </div>

            {{-- ===================== CARD VIEW ===================== --}}
            <div x-show="view==='card'" x-transition x-cloak
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                <template x-for="doc in filteredDocuments" :key="doc.id">
                    <div
                        class="bg-white shadow-xl rounded-2xl p-6 flex flex-col justify-between transition-transform hover:scale-[1.02]">
                        <div>
                            <h2 class="text-xl font-bold text-indigo-700 mb-2" x-text="doc.nama_file"></h2>
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Penulis:</span> <span
                                    x-text="doc.penulis"></span></p>
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Nomor:</span> <span
                                    x-text="doc.nomor"></span></p>
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Tahun:</span> <span
                                    x-text="doc.tahun"></span></p>
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Kategori:</span> <span
                                    x-text="doc.kategori"></span></p>
                            <p class="text-gray-700 mb-1"><span class="font-semibold">Tanggal:</span> <span
                                    x-text="doc.tanggal"></span></p>

                        </div>

                        <div class="mt-4">
                            <a :href="`/storage/${doc.file}`" :download="`${doc.nama_file}`"
                                class="px-4 py-2 bg-indigo-700 text-white rounded-lg font-semibold w-full text-center hover:bg-indigo-800 transition-colors">
                                Unduh
                            </a>
                        </div>
                    </div>
                </template>
            </div>

        </div>

    </section>


    <script>
        function documentManager(initialDocuments, kategoriData) {
            return {
                view: 'table',
                search: '',
                kategori: 'ALL',
                sortOrder: 'asc',
                documents: initialDocuments,
                kategoriList: kategoriData,
                get filteredDocuments() {
                    let filtered = this.documents.filter(doc => {
                        const q = this.search.toLowerCase();

                        const penulis = (doc.penulis ?? '').toString().toLowerCase();
                        const nomor = (doc.nomor ?? '').toString().toLowerCase();
                        const tahun = (doc.tahun ?? '').toString().toLowerCase();
                        const nama_file = (doc.nama_file ?? '').toString().toLowerCase();
                        const kategori = (doc.kategori ?? '').toString().toLowerCase();

                        const matchQ =
                            !q ||
                            penulis.includes(q) ||
                            nomor.includes(q) ||
                            tahun.includes(q) ||
                            nama_file.includes(q) ||
                            kategori.includes(q);

                        const matchKategori = this.kategori === 'ALL' || doc.kategori === this.kategori;
                        return matchQ && matchKategori;
                    });


                    filtered.sort((a, b) => {
                        const nameA = (a.penulis ?? '').toString().toLowerCase();
                        const nameB = (b.penulis ?? '').toString().toLowerCase();
                        return this.sortOrder === 'asc'
                            ? nameA.localeCompare(nameB)
                            : nameB.localeCompare(nameA);
                    });

                    return filtered;
                },
                init() {
                    this.kategoriList.sort();
                }
            }
        }
    </script>

@endsection