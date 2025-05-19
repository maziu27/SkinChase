@extends('layouts.app')

@section('content')
<div class="relative flex items-center justify-center min-h-screen bg-gray-900 text-white px-4 overflow-hidden">

    <!-- easter egg??? wow!!! -->
    <div class="absolute inset-0 z-0 pointer-events-none opacity-70">
        @for ($i = 0; $i < 50; $i++)
            <img src="{{ asset('images/skins/skin' . ($i % 6 + 1) . '.png') }}"
                 class="absolute w"
                 style="
                    top: {{ rand(0, 90) }}%;
                    left: {{ rand(0, 90) }}%;
                    transform: rotate({{ rand(0, 360) }}deg) scale({{ rand(90, 120) / 100 }});
                    width: {{ rand(80, 140) }}px;
                    mix-blend-mode: screen;
                    opacity: 1;
                 ">
        @endfor
    </div>

    <div class="text-center z-10">
        <h1 class="text-3xl font-bold mb-6">This is not available at the moment gang... </h1>
        <a href="{{ route('home') }}"
           class="inline-block bg-violet-600 hover:bg-violet-700 text-white font-semibold py-2 px-4 rounded transition">
            Go back! :0
        </a>
        <img class="mx-auto max-w-xs mt-6 rounded shadow-lg" src="{{ asset('images/404.png') }}" alt="Not available emoji">
    </div>
</div>
@endsection