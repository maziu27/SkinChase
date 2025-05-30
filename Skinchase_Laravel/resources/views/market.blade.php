@extends('layouts.app')


@section('content')

    <div class="flex flex-col bg-gray-900 text-white">
        <!-- Botones de ordenar y filtrar juntos -->
        @include('includes.market-buttons')
    </div>

    <main class="flex-1 overflow-y-auto p-4">
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Sidebar Filtro -->
            @include('includes.sidebar')

            <!-- Contenedor de productos -->
            <div id="contenedor-productos"
                class="flex-1 grid gap-4 xl:grid-cols-6 lg:grid-cols-5 md:grid-cols-3 sm:grid-cols-3 grid-cols-2 overflow-hidden">
            </div>

           
        </div>
         @include('includes.basket')
            <!-- Modal -->
            @include('includes.market-modal')

            
    </main>

    </div>

    <script src="{{ asset('js/market.js') }}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
@endsection