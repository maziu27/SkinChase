@extends('layouts.app')

@section('content')
    @auth
        <div class="flex flex-col items-center justify-center min-h-screen bg-gray-900 text-white px-4">
            <h1 class="text-5xl font-bold text-center mb-8 text-purple-400">
                {{ Auth::user()->name }}, thank you for buying on SkinChase 🎉
            </h1>
                 <p>You bought: <strong></strong></p>
                
            <img class="w-48 h-auto mx-auto" src="{{ asset('images/thumbs-up.png') }}" alt="Thumbs up">
        </div>
    @else
        <script>
            window.location.href = "{{ route('login') }}";
        </script>
    @endauth
@endsection