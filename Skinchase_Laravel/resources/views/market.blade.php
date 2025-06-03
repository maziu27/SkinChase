@extends('layouts.app')

@section('title', 'Market | SkinChase')


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

         <div id="product-modal" class="fixed inset-0 z-50 bg-black bg-opacity-70 hidden justify-center items-center"
            onclick="closeModalOnBackdrop(event)">
            <div class="bg-[#1A1D24] rounded-xl p-8 w-[95%] max-w-5xl text-white flex flex-col items-center relative"
                onclick="event.stopPropagation()">
                <!-- Título y detalles -->
                <div class="text-center mb-6">
                    <h3 class="text-2xl font-bold" id="modal-name">Nombre del producto</h3>
                    <p id="modal-float" class="text-gray-300 mt-1">Float: 0.0000</p>
                    <p id="modal-price" class="text-green-400 font-bold text-xl mt-1">€0.00</p>
                </div>

                <!-- Imagen -->
                <img id="modal-image" src="" alt="Product"
                class="w-96 h-96 object-contain mb-6 transition-transform duration-300 ease-in-out md:hover:scale-150">

                <!-- Botones -->
                <div class="flex gap-4">
                    <button id="modal-add-to-basket" class="js-add-to-basket flex-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-md text-sm transition">
                        Add to basket
                    </button>
                    <button id="modal-buy-now" class="buy-now flex-1 bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-md text-sm transition">
                        Buy now
                    </button>
                </div>

                <!-- Botón cerrar -->
                <button onclick="closeModal()" class="mt-6 md:hidden bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white">
                    Close
                </button>
                
                <div class="w-full mt-4">
                    <img src="{{ asset('images/graph.png') }}" alt="Price graph" class="w-full h-auto object-contain">
                </div>
            </div>

                
        </div> 
            
    </main>

    </div>

    <script src="{{ asset('js/market.js') }}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
@endsection