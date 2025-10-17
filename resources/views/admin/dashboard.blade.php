@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <form action="{{ route('admin.logout') }}" method="POST" class="inline">
        @csrf
        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
            Logout
        </button>
    </form>
@endsection