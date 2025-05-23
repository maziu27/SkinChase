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
                    Ordenar por
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
            <aside id="sidebar"
                class="bg-[#1e1e1e] p-5 w-full md:w-[250px] rounded-[10px] transition-all duration-300 ease-in-out max-h-[calc(75vh-2rem)] overflow-y-auto">
                <form id="filter-form" class="space-y-4">
                    @csrf

                    <!-- Inputs -->
                    <div class="space-y-2">
                        <input type="text" placeholder="Search for items" name="name"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-blue-500">
                        <input type="number" step="any" placeholder="Float from" name="floatFrom"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                        <input type="number" step="any" placeholder="Float to" name="floatTo"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                        <input type="number" placeholder="Price from" name="priceFrom"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                        <input type="number" placeholder="Price to" name="priceTo"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                    </div>

                    <h3 class="text-lg font-semibold">Special</h3>
                    <div class="space-y-2">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="StatTrak" value="1" class="form-checkbox text-blue-500">
                            <span>StatTrak</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="Souvenir" value="1" class="form-checkbox text-blue-500">
                            <span>Souvenir</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="Normal" value="1" class="form-checkbox text-blue-500">
                            <span>Normal</span>
                        </label>
                    </div>

                    <div class="space-y-2">
                        <input type="text" placeholder="Sticker Slot 1" name="sticker1"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                        <input type="text" placeholder="Sticker Slot 2" name="sticker2"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                        <input type="text" placeholder="Sticker Slot 3" name="sticker3"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                        <input type="text" placeholder="Sticker Slot 4" name="sticker4"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                        <input type="text" placeholder="Sticker Slot 5" name="sticker5"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                    </div>

                    <!-- input oculto -->
                    <input type="hidden" name="sort_by" id="sort-by">

                    <input type="submit" value="Filtrar"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded cursor-pointer">
                </form>
            </aside>

            <!-- Contenedor de productos -->
            <div id="contenedor-productos"
                class="flex-1 grid gap-4 xl:grid-cols-6 lg:grid-cols-5 md:grid-cols-3 sm:grid-cols-3 grid-cols-2 overflow-hidden">
                </div>
            </div>

            <div id="product-modal" class="fixed inset-0 z-50 bg-black bg-opacity-70 hidden justify-center items-center">
    <div class="bg-[#1A1D24] rounded-xl p-6 w-[90%] max-w-6xl text-white grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Información adicional -->
        <div>
            <h3 class="text-lg font-bold mb-2" id="modal-name">Nombre del producto</h3>
            <p id="modal-float" class="text-gray-300">Float: 0.0000</p>
            <p id="modal-price" class="text-green-400 font-bold mt-2">€0.00</p>
            
        </div>

        <!-- Imagen -->
        <div class="flex flex-col items-center justify-center">
            <img id="modal-image" src="" alt="Product" class="w-48 h-48 object-contain mb-4">
            <div class="flex gap-4">
                <button class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded">Add to Cart</button>
                <button class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded">Buy Now</button>
            </div>

            <button onclick="closeModal()" class="mt-4 bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white">
                Cerrar
            </button>
        </div>

        <!-- Similares -->
        {{--<div>
            <h4 class="font-semibold mb-2">Similares</h4>
            <div id="similar-products" class="space-y-2 text-sm text-gray-300">
                <p>No hay similares.</p>
            </div>
        </div>--}}
    </div>
</div>
    </main>

    </div>

    <script src="{{ asset('js/market.js') }}"></script>

<script>
function openModal(item) {
    document.getElementById('modal-name').innerText = item.name;
    document.getElementById('modal-float').innerText = item.float_value ? 'Float: ' + item.float_value : 'Sticker';
    document.getElementById('modal-price').innerText = '€' + Number(item.price).toFixed(2);
    document.getElementById('modal-image').src = `https://steamcommunity-a.akamaihd.net/economy/image/${item.icon_url}`;

    // Mostrar modal
    const modal = document.getElementById('product-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    // Lógica para mostrar similares, si los tienes
    document.getElementById('similar-products').innerHTML = `<p>No hay similares.</p>`;
}

function closeModal() {
    const modal = document.getElementById('product-modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
@endsection