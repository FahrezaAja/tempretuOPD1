@extends('layouts.app')

@section('title', 'Kontak')

@section('content')

    <section class="px-6 md:px-20 py-20">

        <h1 class="text-4xl md:text-5xl font-extrabold text-indigo-700 mb-12 text-center">
            Kontak Kami
        </h1>

        {{-- Map --}}
        <div class="w-full h-80 md:h-[450px] mb-12 rounded-2xl overflow-hidden shadow-lg">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3970.123456789!2d139.1234567!3d-7.1234567!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x123456789abcdef!2sDinas%20Komunikasi%20dan%20Informatika%20Papua%20Selatan!5e0!3m2!1sen!2sid!4v1690000000000"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

        {{-- Kontak Info --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">

            {{-- Alamat --}}
            <div
                class="bg-white rounded-2xl shadow-xl p-6 flex flex-col items-center transition-transform hover:scale-[1.03]">
                <div class="flex items-center gap-2 mb-2 text-indigo-700">
                    <i class="fas fa-map-marker-alt text-xl"></i>
                    <h2 class="text-xl font-bold">Alamat</h2>
                </div>
                <p class="text-gray-700">
                    Jl. Contoh Alamat No.123<br>
                    Kota Contoh, Papua Selatan
                </p>
            </div>

            {{-- Telepon --}}
            <div
                class="bg-white rounded-2xl shadow-xl p-6 flex flex-col items-center transition-transform hover:scale-[1.03]">
                <div class="flex items-center gap-2 mb-2 text-indigo-700">
                    <i class="fas fa-phone-alt text-xl"></i>
                    <h2 class="text-xl font-bold">Telepon</h2>
                </div>
                <p class="text-gray-700">
                    +62 812-3456-7890
                </p>
            </div>

            {{-- Email --}}
            <div
                class="bg-white rounded-2xl shadow-xl p-6 flex flex-col items-center transition-transform hover:scale-[1.03]">
                <div class="flex items-center gap-2 mb-2 text-indigo-700">
                    <i class="fas fa-envelope text-xl"></i>
                    <h2 class="text-xl font-bold">Email</h2>
                </div>
                <p class="text-gray-700">
                    info@diskominfo.papuaselatan.go.id
                </p>
            </div>

        </div>

    </section>

@endsection