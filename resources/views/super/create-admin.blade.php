@extends('layouts.app')

@section('title', 'Tambah Admin')

@section('content')
    <div class="max-w-2xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Tambah Admin Baru</h1>

        <form action="{{ route('super.admin.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label>Username</label>
                <input type="text" name="username" class="w-full border px-3 py-2" value="{{ old('username') }}">
                @error('username')<p class="text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="gmail" class="w-full border px-3 py-2" value="{{ old('gmail') }}">
                @error('gmail')<p class="text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="mb-4">
                <label>Password</label>
                <input type="password" name="password" class="w-full border px-3 py-2">
                @error('password')<p class="text-red-500">{{ $message }}</p>@enderror
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Buat Admin</button>
            <a href="{{ route('super.dashboard')}}"
                class="bg-gray-600 text-white px-4 py-2 rounded">
                Kembali
            </a>
        </form>
    </div>
@endsection