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