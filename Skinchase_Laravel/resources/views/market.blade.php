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
                <div id="product-container"
                    class="flex-1 grid gap-4 xl:grid-cols-6 lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-2"></div>
            </div>
        </main>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const form = document.getElementById("filter-form");
            const container = document.getElementById("product-container");

            async function fetchItems(params = "") {
                container.innerHTML = "<p class='col-span-full text-center text-gray-400'>Loading...</p>";

                try {
                    const response = await fetch(`/items?${params}`);
                    const items = await response.json();

                    container.innerHTML = "";

                    if (items.length === 0) {
                        container.innerHTML = "<p class='col-span-full text-center text-yellow-400'>No se encontraron resultados.</p>";
                        return;
                    }

                    items.forEach(item => {
                        const card = document.createElement("div");
                        card.className = "bg-gray-800 p-4 rounded-lg shadow hover:shadow-lg transition flex flex-col justify-between";

                        card.innerHTML = `
                            <img src="https://steamcommunity-a.akamaihd.net/economy/image/${item.icon_url}" alt="${item.name}" class="w-full h-32 object-contain mb-2 rounded">
                            <h2 class="text-lg font-semibold">${item.name}</h2>
                            <p class="text-sm text-gray-400">Float: ${item.float_value}</p>
                            <p class="text-green-400 font-bold mt-1">$${item.price}</p>
                            <button class="mt-3 bg-blue-600 hover:bg-blue-700 text-white py-1 px-3 rounded w-full transition">Comprar</button>
                        `;

                        container.appendChild(card);
                    });
                } catch (err) {
                    console.error("Error al cargar los items:", err);
                    container.innerHTML = "<p class='col-span-full text-center text-red-500'>Error al cargar los productos.</p>";
                }
            }

            // Enviar filtros
            form.addEventListener("submit", (e) => {
                e.preventDefault();
                const formData = new FormData(form);
                const params = new URLSearchParams();

                for (const [key, value] of formData.entries()) {
                    if (value.trim() !== "") {
                        params.append(key, value);
                    }
                }

                fetchItems(params.toString());
            });

            // Carga inicial
            fetchItems();
        });

        // Ordenamiento
        const sortToggle = document.getElementById("sort-toggle");
        const sortOptions = document.getElementById("sort-options");
        const sortByInput = document.getElementById("sort-by");
        const form = document.getElementById("filter-form");

        sortToggle.addEventListener("click", () => {
            sortOptions.classList.toggle("hidden");
        });

        sortOptions.querySelectorAll("li").forEach(option => {
            option.addEventListener("click", () => {
                const value = option.getAttribute("data-value");
                sortByInput.value = value;

                sortToggle.innerHTML = `${option.textContent}
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>`;

                sortOptions.classList.add("hidden");
                form.dispatchEvent(new Event('submit'));
            });
        });

        // Mostrar/ocultar sidebar en pantallas pequeñas
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("hidden");
        }
    </script>

@endsection
{{--@section('content')

<body class="bg-gray-900 text-white min-h-screen">

    <div class="p-4 w-40 relative">
        <button type="button" id="sort-toggle"
            class="bg-purple-500 rounded-xl p-2 text-white text-2xl focus:outline-none flex items-center justify-between w-full">
            Ordenar por
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div id="sort-options" class="absolute z-10 mt-1 w-40 bg-gray-800 rounded shadow-lg hidden">
            <ul class="text-sm">
                <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer" data-value="lowest_price">Precio más bajo</li>
                <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer" data-value="highest_price">Precio más alto</li>
                <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer" data-value="most_recent">Más reciente</li>
                <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer" data-value="lowest_float">Float más bajo</li>
                <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer" data-value="highest_float">Float más alto</li>
            </ul>
        </div>
    </div>

    <aside id="sidebar"
        class="bg-[#1e1e1e] p-5 w-full md:w-[250px] rounded-[10px] transition-all duration-300 ease-in-out max-h-[calc(100vh-2rem)] overflow-y-auto">
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

            <!-- input oculto dentro del formulario -->
            <input type="hidden" name="sort_by" id="sort-by">

            <input type="submit" value="Filtrar"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded cursor-pointer">
        </form>
    </aside>

    <div id="product-container" class="grid grid-cols-2 md:grid-cols-4 gap-4 p-4"></div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const form = document.getElementById("filter-form");
            const container = document.getElementById("product-container");

            async function fetchItems(params = "") {
                container.innerHTML = "<p class='col-span-full text-center text-gray-400'>Cargando...</p>";

                try {
                    const response = await fetch(`/items?${params}`);
                    const items = await response.json();

                    container.innerHTML = "";

                    if (items.length === 0) {
                        container.innerHTML = "<p class='col-span-full text-center text-yellow-400'>No se encontraron resultados.</p>";
                        return;
                    }

                    items.forEach(item => {
                        const card = document.createElement("div");
                        card.className = "bg-gray-800 p-4 rounded-lg shadow hover:shadow-lg transition flex flex-col justify-between";

                        card.innerHTML = `
                        <img src="https://steamcommunity-a.akamaihd.net/economy/image/${item.icon_url}" alt="${item.name}" class="w-full h-32 object-contain mb-2 rounded">
                        <h2 class="text-lg font-semibold">${item.name}</h2>
                        <p class="text-sm text-gray-400">Float: ${item.float_value}</p>
                        <p class="text-green-400 font-bold mt-1">$${item.price}</p>
                        <button class="mt-3 bg-blue-600 hover:bg-blue-700 text-white py-1 px-3 rounded w-full transition">Comprar</button>
                    `;

                        container.appendChild(card);
                    });
                } catch (err) {
                    console.error("Error al cargar los items:", err);
                    container.innerHTML = "<p class='col-span-full text-center text-red-500'>Error al cargar los productos.</p>";
                }
            }

            // Enviar filtros
            form.addEventListener("submit", (e) => {
                e.preventDefault();
                const formData = new FormData(form);
                const params = new URLSearchParams();

                for (const [key, value] of formData.entries()) {
                    if (value.trim() !== "") {
                        params.append(key, value);
                    }
                }

                fetchItems(params.toString());
            });

            // Carga inicial
            fetchItems();
        });

        // Lógica de ordenamiento
        const sortToggle = document.getElementById("sort-toggle");
        const sortOptions = document.getElementById("sort-options");
        const sortByInput = document.getElementById("sort-by");
        const form = document.getElementById("filter-form");

        sortToggle.addEventListener("click", () => {
            sortOptions.classList.toggle("hidden");
        });

        sortOptions.querySelectorAll("li").forEach(option => {
            option.addEventListener("click", () => {
                const value = option.getAttribute("data-value");
                sortByInput.value = value;

                sortToggle.innerHTML = `${option.textContent}
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>`;

                sortOptions.classList.add("hidden");

                // Reenvía el formulario para aplicar el filtro de ordenamiento
                form.dispatchEvent(new Event('submit'));
            });
        });
    </script>

</body>
@endsection --}}


{{--
@section('content')

<div class="flex flex-col h-screen bg-gray-900">

    <!-- Botón de ordenar (visible siempre) -->
    <div class="p-4 w-40 relative">
        <button type="button" id="sort-toggle"
            class="bg-purple-500 rounded-xl p-2 text-white text-2xl focus:outline-none flex items-center justify-between w-full">
            Ordenar por
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div id="sort-options" class="absolute z-10 mt-1 w-40 bg-gray-800 rounded shadow-lg hidden">
            <ul class="text-sm">
                <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer" data-value="lowest_price">Precio más bajo</li>
                <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer" data-value="highest_price">Precio más alto</li>
                <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer" data-value="most_recent">Más reciente</li>
                <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer" data-value="lowest_float">Float más bajo</li>
                <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer" data-value="highest_float">Float más alto</li>
            </ul>
        </div>
    </div>

    <!-- Botón de filtro de sidebar (visible siempre) -->
    <div class="p-4">
        <button class="bg-purple-500 rounded-xl p-2 text-white text-2xl focus:outline-none" onclick="toggleSidebar()">☰
            Filter</button>
    </div>
    <main class="flex-1 overflow-y-auto p-4">
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Sidebar Filtro (oculto por defecto) -->
            <aside id="sidebar"
                class="bg-[#1e1e1e] p-5 w-full md:w-[250px] rounded-[10px] transition-all duration-300 ease-in-out max-h-[calc(100vh-2rem)] overflow-y-auto">
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

                    <!-- input oculto dentro del formulario -->
                    <input type="hidden" name="sort_by" id="sort-by">

                    <input type="submit" value="Filtrar"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded cursor-pointer">
                </form>
            </aside>

            <!-- Contenedor de productos -->
            <div id="product-container"
                class="flex-1 grid gap-4 xl:grid-cols-6 lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-2">

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

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.getElementById("filter-form");
        const container = document.getElementById("product-container");

        async function fetchItems(params = "") {
            container.innerHTML = "<p class='col-span-full text-center text-gray-400'>Cargando...</p>";

            try {
                const response = await fetch(`/items?${params}`);
                const items = await response.json();

                container.innerHTML = "";

                if (items.length === 0) {
                    container.innerHTML = "<p class='col-span-full text-center text-yellow-400'>No se encontraron resultados.</p>";
                    return;
                }

                items.forEach(item => {
                    const card = document.createElement("div");
                    card.className = "bg-gray-800 p-4 rounded-lg shadow hover:shadow-lg transition flex flex-col justify-between";

                    card.innerHTML = `
                                <img src="https://steamcommunity-a.akamaihd.net/economy/image/${item.icon_url}" alt="${item.name}" class="w-full h-32 object-contain mb-2 rounded">
                                <h2 class="text-lg font-semibold">${item.name}</h2>
                                <p class="text-sm text-gray-400">Float: ${item.float_value}</p>
                                <p class="text-green-400 font-bold mt-1">$${item.price}</p>
                                <button class="mt-3 bg-blue-600 hover:bg-blue-700 text-white py-1 px-3 rounded w-full transition">Comprar</button>

                                 <div class="flex flex-col gap-2">
                <button class="add-to-basket bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-all duration-200"
                    data-id="${item.asset_id}"
                    data-name="${item.market_hash_name}"
                    data-price="${(product.price / 100).toFixed(2)}"
                    data-image="${item.icon_url}">
                    Add to Cart
                </button>

                <button class="buy-now bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-all duration-200"
                    data-id="${item.asset_id}"
                    data-name="${item.market_hash_name}"
                    data-price="${(product.price / 100).toFixed(2)}"
                    data-image="${item.icon_url}">
                    Buy Now
                </button>

                            `;

                    container.appendChild(card);
                });
            } catch (err) {
                console.error("Error al cargar los items:", err);
                container.innerHTML = "<p class='col-span-full text-center text-red-500'>Error al cargar los productos.</p>";
            }
        }

        // Enviar filtros
        form.addEventListener("submit", (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            const params = new URLSearchParams();

            for (const [key, value] of formData.entries()) {
                if (value.trim() !== "") {
                    params.append(key, value);
                }
            }

            fetchItems(params.toString());
        });

        // Carga inicial
        fetchItems();
    });

    // Lógica de ordenamiento
    const sortToggle = document.getElementById("sort-toggle");
    const sortOptions = document.getElementById("sort-options");
    const sortByInput = document.getElementById("sort-by");
    const form = document.getElementById("filter-form");

    sortToggle.addEventListener("click", () => {
        sortOptions.classList.toggle("hidden");
    });

    sortOptions.querySelectorAll("li").forEach(option => {
        option.addEventListener("click", () => {
            const value = option.getAttribute("data-value");
            sortByInput.value = value;

            sortToggle.innerHTML = `${option.textContent}
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>`;

            sortOptions.classList.add("hidden");

            // Reenvía el formulario para aplicar el filtro de ordenamiento
            form.dispatchEvent(new Event('submit'));
        });
    });
</script>
@endsection --}}