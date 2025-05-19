
{{--

SITIO DE PRUEBA SIGMA PARA PROBAR COSAS 

--}}

{{-- SITIO DE PRUEBA SIGMA PARA PROBAR COSAS --}}

@include('includes.header')

<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SkinChase</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen">

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

            <input type="submit" value="Filtrar"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded cursor-pointer">
        </form>
    </aside>

    <div id="product-container" class="grid grid-cols-2 md:grid-cols-4 gap-4 p-4"></div>

    <script>
    //el cachondeo este hace lo mismo que el fetchData de la API en la vista Market pero con un fetch a items en mySQL
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
    </script>

</body>
</html>

<!--


⠋⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⠙
⠀⠀⠂⣁⣀⠌⢀⠀⠁⡀⠁⠠⢈⠐⠈⠀⠓⠪⢥⣒⠈⠄⣈⡀⠄⢁⠠⠈⠀⠘⠒⠛⠭⢖⣢⠥⠀⡁⠠⠈⠄⠈⠒⠋⠴⢌⣀⠄⠁⠠⢈⠀⠄⠁⠘⠊⠓⠚⠽⡲⠤⢅⡀⢈⠠⢈⠀⡄⣁⠀⠂⠀
⠀⢂⠁⠀⠀⠉⠉⠉⠒⠓⠈⠁⠀⠀⠀⠀⠀⠀⠀⠀⠉⠙⠒⠒⠊⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠉⠉⠉⠁⠀⠀⠀⠀⠀⠀⠀⠀⠉⠉⠉⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠉⠒⠚⠂⠈⠀⠀⠀⠈⠃⠀⡀
⠀⡐⢀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢈⠀⠀
⠀⠰⠀⠠⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠠⠀⠀
⠀⠠⢁⠀⠇⠀⠀⢀⡤⠴⢤⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠠⠁⠄⠁
⠀⠀⠄⠀⠀⠀⢀⠟⠀⠀⠀⡇⠀⠀⠀⠀⡀⢄⠀⠀⠀⠀⠀⣼⣿⠀⠀⠀⠀⠀⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⡀⠀⠀⠀⠀⢠⣤⡄⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢠⡜⠻⡄⠀⠀⠀⡇⠄⠀⠀
⠀⠀⠌⠀⠀⠀⢾⠄⠀⠀⡠⠃⠀⠀⠀⠐⢺⣿⡆⠀⠀⠀⠀⣾⣿⠀⠀⠀⠀⣸⣿⡏⠀⠀⠀⠀⠀⠀⠐⣾⣧⠀⠀⠀⠀⢸⣿⡇⠀⠀⠀⣄⣿⣿⠲⠀⠀⠀⠀⠀⠀⣟⢄⡴⠃⠀⠀⠀⢱⠀⠈⠀
⠀⠈⡄⠀⠀⠀⠈⠂⠄⠊⠀⠀⠀⠀⠀⠀⢁⢻⣿⡄⢀⣀⣤⣿⣿⣤⣀⣀⢠⣿⡿⠘⠀⠀⠀⠀⠀⠀⠀⡸⣿⣇⠄⠀⢀⣸⣿⣇⣀⠀⠀⣸⣿⡇⠃⠀⠀⠀⠀⠀⠀⠈⠉⠀⠀⠀⠀⠀⠈⠆⠀⠁
⠀⠐⣠⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣨⠿⠛⠉⠁⠀⠀⠀⠀⠀⠉⠛⠿⣧⡀⠀⠀⠀⠀⠀⠀⠀⠀⣻⡿⠞⠋⠉⠉⠉⠉⠉⠉⠓⠿⣿⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⠁⠠⠀
⠀⠠⠐⠐⢄⢀⢶⠙⡄⠀⠀⠀⠀⠀⢀⣴⠟⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⠹⣶⡀⠀⠀⠀⢔⣵⠟⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠙⠷⣦⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢈⠀⠄⠀
⠀⠀⠁⢦⠘⠘⠧⠔⠀⠀⠀⠀⠀⢠⡞⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⢿⡄⠀⣨⡟⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠙⢿⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⠂⢀⠠⠀
⠀⠐⠀⢘⡞⠀⠀⠀⠀⠀⠀⠀⢌⡟⠀⠀⠀⠀⠀⠀⠀⢀⣴⠞⠿⠛⠻⢶⣤⡀⠀⠀⠀⠈⢿⢠⡏⠀⠀⠀⠀⢀⣴⢞⠻⡉⠏⠛⣶⣄⠀⠀⠀⠀⠀⠀⠈⣷⠀⠀⠀⠀⠀⠀⠀⠀⠀⠠⠀⢀⠀⠀
⠀⢀⠈⢰⠃⠀⠀⠀⠀⠀⠀⠐⣸⠃⠀⠀⠀⠀⠀⠀⣰⡿⠃⠀⠀⣨⣄⡀⠈⡿⡄⠀⠀⠀⠘⣿⠀⠀⠀⠀⢠⣟⠆⠀⠀⠀⣥⣄⠈⡜⣧⠀⠀⠀⠀⠀⠀⢸⡇⠀⠀⠀⠀⠀⠀⠀⠀⢰⡀⠀⠀⠂
⠀⠀⠀⡎⠀⠀⠀⠀⠀⠀⠀⠀⣿⠀⠀⠀⠀⠀⠀⠀⡏⡇⢠⣷⣶⣿⣿⣿⡄⠱⣿⠀⠀⠀⠀⣏⠀⠀⠀⠈⢸⠸⠈⣾⣶⣾⣿⣿⡇⠀⣺⡇⠀⠀⠀⠀⠀⠄⡇⠀⠀⠀⠀⠀⠀⠀⠀⠘⣆⠀⠁⠀
⠀⠀⠁⣇⠢⠀⠀⠀⠀⠀⠀⠀⢸⡄⠀⠀⠀⠀⠀⠀⢧⠃⠀⢿⣿⣿⡿⠟⠀⣀⡟⡄⠀⠀⠀⣯⠀⠀⠀⠀⠸⡄⠐⠹⣿⣿⣿⠿⠃⢠⣽⠳⠀⠀⠀⠀⠀⢸⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠏⠀⡀⠁
⠀⠈⢀⢘⡆⢡⠀⠀⠀⠀⢀⣤⠾⠝⠋⠋⠙⠷⢖⣤⡈⠳⣤⠀⠈⠉⠀⠀⣠⠞⠁⠀⢀⣴⠾⠛⠻⢷⣦⡀⠀⠙⢷⣠⠀⠀⠀⠀⣠⡽⠃⣀⣤⠴⠖⠒⠒⠻⠶⢤⣄⡀⠀⠀⠀⠀⠀⡈⠐⠀⢀⠀
⠀⠠⠀⠈⢳⠀⠀⠀⢀⡾⠋⢠⡀⠀⠐⠀⠠⠔⢀⠉⢷⡀⠈⠙⠓⠒⠚⠋⠁⠀⠀⢠⡟⠁⠀⠀⠀⠀⠘⣷⠀⠀⠀⠉⠙⠛⠛⠋⢁⣴⠟⠉⠰⠂⠀⠀⠀⠀⠀⣤⠈⠻⣦⠀⠀⠀⢠⠀⠀⠂⠀⠀
⠀⠀⠐⠀⣿⠀⠀⠀⢸⠁⠀⠀⠀⠀⠀⠓⡀⠀⠀⢡⢸⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀⣸⠀⠀⠀⠀⠀⢀⠎⣿⠘⠀⠀⠀⠀⠀⠀⠀⣾⠃⡀⠀⠀⠀⡀⠊⠲⠀⠀⠀⠀⠀⢹⡆⠀⠀⢸⡀⠀⠂⠁⠀
⠀⠐⠀⠀⡏⠀⠀⠀⠘⣆⠀⠀⢠⣲⢶⠶⠥⠂⠀⠈⣸⠃⠀⠀⠀⠀⠀⠀⠀⣀⣴⠟⡆⠀⠀⠀⠀⢈⢆⡟⢦⣄⡀⠀⠀⠀⠀⠀⣿⠀⠁⠀⠀⢰⠷⢲⡶⢦⡂⠀⠀⠀⣾⠁⠀⠀⠈⡇⠀⢀⠀⠂
⠀⢀⠈⠰⡇⠀⠀⠀⠀⠈⠳⠤⠀⠑⠘⣆⡀⠀⠄⠞⠓⡶⠦⠤⠤⠤⠶⠖⠛⠉⠀⠁⠀⠀⠀⠀⠀⢢⡾⠁⠀⠪⠍⠛⠒⠶⠶⠶⠟⢦⡀⠀⠀⠐⣡⡞⠌⠀⠀⠀⣀⠼⠃⠀⠀⠀⠀⡃⠀⠀⠠⠀
⠀⠀⡀⠐⣇⢂⠀⠀⠀⠀⠀⠀⠀⠀⠀⠘⢶⢄⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠔⠋⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠁⠀⡀⣴⠏⠈⠀⠀⠀⠈⠁⠀⠀⠀⠀⠀⠀⠆⠀⠁⡀⠀
⠀⢀⠀⠐⡸⡄⢂⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⡳⣅⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⢀⣤⠞⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⡐⠀⡀⠂⠀⠀
⠀⠀⠠⠀⢙⣣⠌⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⢝⢦⣄⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣠⠶⠋⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢠⡧⠀⠀⠠⠀⠁
⠀⠐⠀⣠⣼⡎⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠊⠙⡲⢦⣄⣀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣀⣠⣤⠶⠚⠋⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⣷⣄⠐⠀⠀⠂
⠀⢀⣾⠏⢱⠇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠉⠛⢻⠷⠶⠶⠶⣶⣴⣶⣶⠶⠶⠶⠛⣿⠋⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣀⠀⠀⠀⠀⠀⠀⠀⣷⠙⢷⣄⠁⠀
⢀⣾⠃⠀⡞⡀⠀⠀⠀⠀⠀⠀⢀⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⠘⠀⠀⠀⠀⣿⢸⡇⠀⠀⠀⠀⣻⠸⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⡠⣪⠝⠂⠉⠆⠀⠀⠀⠀⠀⡸⡆⠀⠻⣆⠀
⣾⠃⠀⠀⢧⣧⢀⠀⠀⠀⠀⡾⠃⢹⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣾⠀⠀⠀⠀⠀⣿⢸⡇⠀⠀⠀⠀⣼⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⡼⠘⠁⠀⠀⠀⡆⠀⠀⠀⠀⢀⣇⠇⠀⠀⢻⡆
⡏⠀⠀⠀⠘⡞⡄⠑⢂⠀⠀⠳⡠⠎⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣄⠀⠀⠀⠛⠛⠛⠛⠛⠛⠛⠘⠛⠛⠛⠛⠛⠛⠀⠀⠀⢀⠀⠀⠀⠀⠀⠀⠀⠀⢇⠀⠀⢀⡠⠊⠀⠀⠀⠀⡀⣞⡜⠀⠀⠀⠈⣷
⣇⠀⠀⠀⠀⠘⢽⠀⠈⠀⠀⠀⠀⠀⠀⡠⠖⠲⢢⠀⠀⠀⠀⠀⠈⠓⢤⣀⠀⠀⠀⠀⠀⠀⣀⣠⢄⣀⣀⡀⠀⠀⢀⣠⠴⠋⠀⠀⠀⠀⠀⠀⠀⠀⠀⠉⠉⠉⠀⠀⠀⠀⠀⠸⣸⡜⠀⠀⠀⠀⠀⢹
⠙⢻⡟⡶⢶⠶⢏⡆⠀⠀⠀⠀⠀⠀⢸⠁⠀⠀⢸⠀⠀⠀⠀⠀⠀⠀⠀⠈⠙⠓⠒⠒⠚⠉⠀⠀⠀⠀⠈⠉⠛⠛⠉⠀⠀⠀⠀⠀⠀⠀⠀⠀⣴⢲⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⠶⣦⠶⠶⣶⠞⠛
⠀⢸⡇⠀⣿⢠⢻⠀⠀⠀⠀⠀⠀⠀⢸⠀⠀⢠⠃⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠓⠊⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⢣⢸⡇⠀⣿⠀⠀
⠀⣽⠀⠈⣿⠈⣸⡀⠀⠀⠀⠀⠀⠀⠈⠑⠒⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣀⣀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⡼⡞⢸⡇⠀⢹⡄⠀
⠀⡿⠀⣨⡟⠀⠑⣳⣤⣀⡠⣤⣐⠶⠶⠶⢤⣕⣂⣠⠦⣭⣴⢤⣄⣀⠀⢀⣀⢤⣴⠶⠤⣤⡂⢐⣢⠭⣔⡶⠦⣭⣀⣀⣀⣀⢤⣴⠶⢶⣲⣤⡥⢤⣤⣔⠶⠮⠭⣖⣦⣤⣴⣾⠛⠁⠸⡇⠀⢸⡆⠀
⢀⡇⠀⢹⡇⠀⠀⢈⣿⠉⠉⠀⠀⠀⠀⠀⠀⠀⠉⠉⠉⠀⠉⠓⠮⣍⡙⠛⠊⠉⠀⢐⡴⡿⣿⢟⡞⣿⣿⠿⣦⠐⠨⠍⠒⠉⣁⣤⠞⠋⠀⠀⠈⠉⠀⠀⠀⠀⠀⠀⠀⠀⣿⡃⠀⠀⡀⣿⠀⠘⡇⠀
⢸⡇⠀⣸⣇⠀⠈⠠⣿⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⠙⠲⢤⣀⣠⢟⠁⠀⠹⣯⣾⣿⠏⠄⠈⠳⣄⣀⡴⠞⠋⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣿⠀⠀⠄⠀⣿⠀⠀⡧⠀
⢸⠁⠀⣿⠀⠀⠐⢀⣿⠀⠀⠀⠀⠀⠀⠀⠀⢀⠀⣀⢀⢀⣀⣀⣀⣀⣀⣀⣀⠉⡁⠁⠀⠀⣸⡿⡿⣿⣆⣀⣀⣀⣈⣋⣀⣀⣀⣀⣀⣀⡀⣀⢀⣀⣀⣀⣀⣀⣀⣀⣀⣀⣿⠀⢀⠠⠀⢿⠀⠀⣿⠀
⣿⣄⣀⣿⣠⣄⣂⣄⣿⣯⣭⣍⣭⣋⣭⣙⣭⣩⣍⣭⣩⣍⣍⣭⣩⣍⣭⣩⣍⣭⣹⣍⣿⣽⣿⣹⣗⣯⣿⣯⣭⣩⣍⣩⣩⣍⣍⣭⣉⣍⣭⣩⣍⣭⣩⣍⣩⣍⣭⣩⣍⣽⣿⣠⣄⣠⣠⣼⣇⣀⣹⣴



-->