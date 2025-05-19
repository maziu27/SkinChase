@extends('layouts.app')

@section('content')
<div class="flex flex-col h-screen bg-gray-900">
    <!-- Botón de filtro (visible siempre) -->
    <div class="p-4">
        <button class="bg-purple-500 rounded-xl p-2 text-white text-2xl focus:outline-none" onclick="toggleSidebar()">☰ Filter</button>
    </div>

    <main class="flex-1 overflow-y-auto p-4">
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Sidebar Filtro (oculto por defecto) -->
            <aside id="sidebar"
                class="bg-[#1e1e1e] p-5 w-full md:w-[250px] rounded-[10px] transition-all duration-300 ease-in-out max-h-[calc(100vh-2rem)] overflow-y-auto hidden">
                <form action="#" method="post" class="space-y-4">
                    @csrf

                    <!-- Inputs -->
                    <div class="space-y-2">
                        <input type="text" placeholder="Search for items" name="name" required
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-blue-500">
                        <input type="number" placeholder="Float from" name="floatFrom"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                        <input type="number" placeholder="Float to" name="floatTo"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                        <input type="number" placeholder="Price from" name="priceFrom"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                        <input type="number" placeholder="Price to" name="priceTo"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                    </div>

                    <h3 class="text-lg font-semibold">Special</h3>
                    <div class="space-y-2">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="StatTrak" class="form-checkbox text-blue-500">
                            <span>StatTrak</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="Souvenir" class="form-checkbox text-blue-500">
                            <span>Souvenir</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="Normal" class="form-checkbox text-blue-500">
                            <span>Normal</span>
                        </label>
                    </div>

                    <!-- Stickers -->
                    <div class="space-y-2">
                        <input type="text" placeholder="Sticker Slot 1" name="sticker1"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-blue-500">
                        <input type="text" placeholder="Sticker Slot 2" name="sticker2"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                        <input type="text" placeholder="Sticker Slot 3" name="sticker3"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                        <input type="text" placeholder="Sticker Slot 4" name="sticker4"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                        <input type="text" placeholder="Sticker Slot 5" name="sticker5"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                    </div>

                    <h3 class="text-lg font-semibold">Listing Type</h3>
                    <div class="inline-flex">
                        <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l">All</button>
                        <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4">Buy Now</button>
                        <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r">Auction</button>
                    </div>

                    <input type="submit" value="Submit"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded cursor-pointer">
                </form>
            </aside>

            <!-- Contenedor de productos -->
            <div id="product-container"
                class="flex-1 grid gap-4 xl:grid-cols-6 lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-2">
                {{-- Dynamic products loaded via JS --}}
            </div>
        </div>
    </main>
</div>
@endsection

@section('scripts')
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('hidden');
    }
</script>
<script src="{{ asset('js/products.js') }}"></script>
@endsection