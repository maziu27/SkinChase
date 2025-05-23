@extends('layouts.app')


@section('content')

    <div class="flex flex-col bg-gray-900 text-white">

        <!-- Botones de ordenar y filtrar juntos -->
        <div class="p-4 flex gap-4">
            <!-- Botón de filtro -->
            <div>
                <button class="bg-purple-500 rounded-xl px-4 py-2 text-white text-2xl focus:outline-none h-full"
                    onclick="toggleSidebar()">
                    ☰ Filter
                </button>
            </div>

            <!-- Botón de ordenar -->
            <div class="relative w-52"> <!-- Aumentado el ancho de w-40 a w-52 -->
                <button type="button" id="sort-toggle"
                    class="bg-purple-500 rounded-xl px-4 py-2 text-white text-2xl focus:outline-none flex items-center justify-between w-full h-full">
                    Order by
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="sort-options" class="absolute z-10 mt-1 w-52 bg-gray-800 rounded shadow-lg hidden">
                    <ul class="text-sm">
                        <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer" data-value="lowest_price">Lowest Price</li>
                        <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer" data-value="highest_price">Highest Price</li>
                        <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer" data-value="most_recent">Most Recent</li>
                        <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer" data-value="lowest_float">Lowest Float</li>
                        <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer" data-value="highest_float">Highest Float</li>
                    </ul>
                </div>
            </div>
        </div>

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
                <img id="modal-image" src="" alt="Product" class="w-96 h-96 object-contain mb-6">

                <!-- Botones -->
                <div class="flex gap-4">
                    <button class="bg-blue-600 hover:bg-blue-700 px-5 py-3 rounded">Add to Cart</button>
                    <button class="buy-now bg-green-600 hover:bg-green-700 px-5 py-3 rounded">Buy Now</button>
                </div>

                <!-- Botón cerrar -->
                <button onclick="closeModal()" class="mt-6 bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white">
                    Close
                </button>
            </div>
        </div>
        </div>
    </main>

    </div>

    <script src="{{ asset('js/market.js') }}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
@endsection