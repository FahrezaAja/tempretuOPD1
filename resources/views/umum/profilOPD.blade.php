@extends('layouts.app')

@section('title', 'Profil OPD')

@section('content')

    <section x-data="{ show: false }" x-init="setTimeout(() => show = true, 200)"
        class="relative overflow-hidden">

        
        <div class="relative flex flex-col items-center justify-center text-center py-24 md:py-32 overflow-hidden">
            <h1 class="text-5xl md:text-6xl font-extrabold text-indigo-700 tracking-tight transition-all duration-1000"
                :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                Profil {{ $profilopd->nama_opd ?? 'Organisasi Perangkat Daerah' }}
            </h1>
        </div>

        
        <div
            class="relative flex flex-col md:flex-row items-center justify-between px-8 md:px-20 py-16 space-y-10 md:space-y-0 md:space-x-12">

            
            <div class="w-full md:w-1/2 flex justify-center transition-all duration-1000 ease-out transform"
                :class="show ? 'opacity-100 -translate-y-0' : 'opacity-0 translate-y-10'">
                <div class="relative w-[420px] md:w-[520px] lg:w-[600px] rounded-[40px] overflow-hidden shadow-2xl">
                    @if(!empty($profilopd->image))
                        <img src="{{ asset('storage/' . $profilopd->image) }}" alt="Gambar {{ $profilopd->nama_opd }}"
                            class="object-cover w-full h-full scale-100 transition-transform duration-700 hover:scale-105">
                    @else
                        <img src="{{ asset('images/gedung.jpg') }}" alt="Gedung OPD"
                            class="object-cover w-full h-full scale-100 transition-transform duration-700 hover:scale-105">
                    @endif
                </div>
            </div>

            
            <div class="w-full md:w-1/2 text-gray-700 leading-relaxed transition-all duration-1000 ease-out transform delay-200"
                :class="show ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-10'">

                <h2 class="text-3xl font-bold text-indigo-700 mb-4">Tentang</h2>

                @if(!empty($profilopd->deskripsi))
                    <p class="text-lg text-gray-600 mb-4">
                        {!! $profilopd->deskripsi !!}
                    </p>
                @else
                    <p class="text-lg text-gray-500 italic">
                        Deskripsi profil OPD belum tersedia.
                    </p>
                @endif
            </div>
        </div>

        
        <div class="relative bg-indigo-700 text-white py-16 px-6 md:px-20 rounded-3xl md:rounded-[40px] shadow-lg">

            <div class="text-center mb-12">
                <h2 class="text-4xl font-extrabold mb-4 transition-all duration-1000"
                    :class="show ? 'opacity-100 scale-100' : 'opacity-0 scale-90'">
                    Visi & Misi
                </h2>
            </div>

            <div class="grid md:grid-cols-2 gap-8">

                
                <div class="bg-indigo-600 text-white p-8 rounded-2xl shadow-lg transition-all duration-700 transform hover:scale-[1.03]"
                    :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                    <h3 class="text-2xl font-bold mb-4">Visi</h3>
                    @if(!empty($profilopd->visi))
                        <div class="text-lg ck-content">
                            {!! $profilopd->visi !!}
                        </div>
                    @else
                        <p class="italic text-indigo-200">Visi belum diinputkan.</p>
                    @endif
                </div>

                
                <div class="bg-indigo-600 text-white p-8 rounded-2xl shadow-lg transition-all duration-700 transform delay-200 hover:scale-[1.03]"
                    :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                    <h3 class="text-2xl font-bold mb-4">Misi</h3>
                    @if(!empty($profilopd->misi))
                        @php
                            $misiList = preg_split("/\r\n|\n|\r/", $profilopd->misi);
                        @endphp
                        <div class="space-y-2 text-lg ck-content">
                            @foreach($misiList as $misi)
                                @if(trim($misi) !== '')
                                    {!! $misi !!}
                                @endif
                            @endforeach
                        </div>
                    @else
                        <p class="italic text-indigo-200">Misi belum diinputkan.</p>
                    @endif
                </div>

            </div>
        </div>


    </section>

@endsection