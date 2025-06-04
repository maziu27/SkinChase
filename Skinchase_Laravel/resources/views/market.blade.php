@extends('layouts.app')

@section('title', 'Market | SkinChase')

@if(!auth()->check())
    <script>window.location.href = "{{ route('login') }}";</script>
@else
@section('content')
    <div class="flex flex-col bg-gray-900 text-white">
        @include('includes.market-buttons')
    </div>

    <main class="flex-1 overflow-y-auto p-4">
        <div class="flex flex-col md:flex-row gap-4">
            @include('includes.sidebar')

            <div id="contenedor-productos" class="flex-1 grid gap-4 xl:grid-cols-6 lg:grid-cols-5 md:grid-cols-3 sm:grid-cols-3 grid-cols-2 overflow-hidden">
                <!-- Los productos se cargarán aquí mediante JavaScript -->
            </div>
        </div>
        
        @include('includes.basket')
        
       @include('includes.modal')
    </main>

    @auth
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/charts.js') }}"></script>
    <script src="{{ asset('js/market.js') }}"></script>

    @endauth
@endsection
@endif