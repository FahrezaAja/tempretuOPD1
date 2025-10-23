@extends('layouts.app')

@section('title', 'Hapus Admin')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Hapus Admin</h1>

    <form action="{{ route('super.admin.destroy') }}" method="POST">
        @csrf
        @method('DELETE')

        <div class="mb-4">
            <label>Konfirmasi Username Admin</label>
            <input type="text" name="confirm_username" class="w-full border px-3 py-2">
            @error('confirm_username')<p class="text-red-500">{{ $message }}</p>@enderror
        </div>

        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Hapus Admin</button>
    </form>
</div>
@endsection
