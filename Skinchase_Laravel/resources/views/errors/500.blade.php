@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-900 text-white px-4">
        <div class="text-center">
            <h1 class="text-3xl font-bold mb-6">ERROR IN DA SERVER LOL</h1>
            <a href="{{ route('home') }}"
                class="inline-block bg-violet-600 hover:bg-violet-700 text-white font-semibold py-2 px-4 rounded transition">
                Go back!
            </a>
            <img class="mx-auto max-w-xs rounded shadow-lg" src="{{ asset('images/404.png') }}" alt="Not available emohi">
        </div>
    </div>
@endsection