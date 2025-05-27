@extends('layouts.app')
@section('content')

    <div class="text-white text-center px-6 md:px-20 py-16 bg-[#0f0f1b]">
        <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
            Revolutionize Your CS2 Trading Experience with SkinChase
        </h1>
        <p class="text-lg md:text-xl text-gray-400 max-w-3xl mx-auto mb-10">
            SkinChase provides the most advanced trading tools that power millions of skin sales. Buy CS2 skins with unparalleled ease and security.
        </p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('market') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 9l1-4h16l1 4M4 9h16v10a1 1 0 01-1 1h-3a1 1 0 01-1-1v-4H9v4a1 1 0 01-1 1H5a1 1 0 01-1-1V9z" />
                </svg>
                Market
            </a>
        </div>
            <img class="mx-auto mb-8" src="{{ asset('images/SkinChase_logo-removebg-preview.png') }}" alt="Logo de SkinChase">

    </div>


@endsection
