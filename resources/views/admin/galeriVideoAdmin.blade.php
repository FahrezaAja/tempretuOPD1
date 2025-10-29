@extends('layouts.admin')

@section('title', 'Galeri Video Admin')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold mb-6 text-indigo-600">Kelola Galeri Video</h1>

        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 shadow">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.galeriVideoAdmin') }}" method="POST" class="mb-8 flex flex-col md:flex-row gap-3">
            @csrf
            <input type="url" name="youtube_link"
                class="border rounded-lg px-4 py-3 w-full focus:outline-none focus:ring-2 focus:ring-indigo-400 shadow-sm"
                placeholder="https://youtu.be/..." required>
            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg shadow hover:scale-105 transition-transform duration-200">
                Tambahkan
            </button>
        </form>

        {{-- Grid video --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($videos as $video)
                <div
                    class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden transform hover:-translate-y-1">
                    @php
                        preg_match("/(?:youtu.be\/|youtube.com\/(?:watch\?v=|embed\/))([\w\-]+)/", $video->youtube_link, $matches);
                        $youtube_id = $matches[1] ?? '';
                    @endphp

                    @if($youtube_id)
                        <iframe class="w-full h-48 sm:h-56 lg:h-48" src="https://www.youtube.com/embed/{{ $youtube_id }}"
                            frameborder="0" allowfullscreen></iframe>
                    @else
                        <p class="text-red-500 p-4">Link YouTube tidak valid</p>
                    @endif

                    
                    <form action="{{ route('galeriVideoAdmin.destroy', $video->id) }}" method="POST" class="p-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg w-full shadow hover:scale-105 transition-transform duration-200">
                            Hapus
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection