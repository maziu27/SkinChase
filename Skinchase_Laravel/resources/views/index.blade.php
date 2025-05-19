<!--elementos de csfloat-->
@extends('layouts.app')

@section('content')
{{-- <h1 class="text-center text-6xl"> Welcome to SkinChase </h1> --}}

<img class="mx-auto" src="{{ asset(path: 'images/SkinChase_logo-removebg-preview.png') }}" alt="Logo de SkinChase">
  
  {{--<a class="text-center" href="{{ url('/auth/steam') }}">
      <img src="https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_01.png" alt="Sign in through Steam">
    </a>
    --}}
{{--
    <div class="flex flex-col md:flex-row items-center gap-6 mb-20" data-aos="fade-right" data-aos-delay="100">
                <img class="w-full md:w-1/2 h-48 object-cover rounded shadow-lg"
                     src="{{ asset('images/skins/skin1.png') }}" alt="dlore">
                <p class="text-white text-justify text-base md:text-lg max-w-lg px-2">
                    hola hola hola
                </p>
            </div>

            <div class="flex flex-col md:flex-row-reverse items-center gap-6 mb-20" data-aos="fade-left" data-aos-delay="200">
                <img class="w-full md:w-1/2 h-48 object-cover rounded shadow-lg"
                     src="{{ asset('images/skins/skin1.png') }}" alt="dlore">
                <p class="text-black text-justify text-base md:text-lg max-w-lg px-2">
                    holaa holaa holaa
                </p>
            </div>

            <div class="flex flex-col md:flex-row items-center gap-6 mb-20" data-aos="fade-right" data-aos-delay="100">
                <img class="w-full md:w-1/2 h-48 object-cover rounded shadow-lg"
                     src="{{ asset('images/skins/skin1.png') }}" alt="dlore">
                <p class="text-white text-justify text-base md:text-lg max-w-lg px-2">
                    hola hola hola
                </p>
            </div>
      </div>
      --}}
@endsection()

