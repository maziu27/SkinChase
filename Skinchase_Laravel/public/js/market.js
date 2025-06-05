// Esperar a que el DOM esté completamente cargado
document.addEventListener("DOMContentLoaded", function () {
    // Carga productos de CSFLOAT desde la API en web.php al iniciar la página.
    fetch("/api/fetch-data")
        .then((response) => response.json())
        .then((responseData) => {
            // Validar que la respuesta contenga datos válidos
            if (responseData.data && Array.isArray(responseData.data)) {
                //loadProducts(responseData.data); // Mostrar los productos en la interfaz
                updateBasketCount(); // Actualizar el contador de productos en la cesta
            }
        });
    
    const form = document.getElementById("filter-form");
    const container = document.getElementById("contenedor-productos");


    async function fetchItems(params = "") {
        container.innerHTML =
            "<p class='col-span-full text-center text-gray-400'>Loading...</p>";

        try {
            // hace petición a la API
            const response = await fetch(`/items?${params}`);
            // espera que la respuesta sea JSON
            const items = await response.json();

            // limpia el contenedor
            container.innerHTML = "";

            // muestra mensaje si no hay resultados
            if (items.length === 0) {
                container.innerHTML =
                    "<p class='col-span-full text-center text-yellow-400'> No results were found.</p>";
                return;
            }

            //crea y muestra cada item en el contenedor
            items.forEach((item) => {
                const card = document.createElement("div");
                card.className =
                    "bg-[#1A1D24] h-[428px] rounded-xl overflow-hidden shadow-md text-white p-4 flex flex-col gap-2 transition hover:shadow-lg cursor-pointer";
                    
                // plantilla HTML con botones de comprar ahora y añadir a la cesta
                card.innerHTML = `
                    <div class="relative bg-gradient-to-b from-purple-700 to-purple-900 rounded-lg p-2 flex justify-center items-center">
                        <img src="https://steamcommunity-a.akamaihd.net/economy/image/${
                            item.icon_url
                        }" alt="${item.name}" class="h-32 object-contain">
                    </div>
            
                    <div class="mt-2">
                        <h2 class="text-orange-500 font-semibold text-md">${item.name}</h2>
                            <p class="text-green-400 text-lg font-bold mt-1">€${(
                                item.price / 1
                            ).toFixed(2)}</p>
                            </div>

                        <div class="flex items-center gap-2 text-sm mt-1">
                            <p class="text-sm text-gray-400">
                                ${
                                    item.name.includes("Package")
                                        ? "Container"
                                        : item.float_value != null
                                        ? `Float: ${item.float_value}`
                                        : "Sticker"
                                }
                            </p>
                    </div>
                    
                    <div class="flex gap-2 mt-auto">
                        <button class="js-add-to-basket flex-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-md text-sm transition"
                            data-id="${item.asset_id}"
                            data-name="${item.name}"
                            data-price="${(item.price / 1).toFixed(2)}"
                            data-image="${item.icon_url}">Add to basket
                            </button>
            
                        <button class="buy-now flex-1 bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-md text-sm transition"
                            data-id="${item.asset_id}"
                            data-name="${item.name}"
                            data-price="${(item.price / 1).toFixed(2)}"
                            data-image="${item.icon_url}">Buy now
                        </button>
                    </div>
                `;

                // Agregar listener para abrir el modal
                card.addEventListener("click", function (e) {
                    if (e.target.closest("button")) return; // Evita que se abra el modal al hacer clic en botones
                    openModal(item);
                });

                container.appendChild(card);
            });
        } catch (err) {
            //error en caso que los items no se carguen
            console.error("Error loading items:", err);
            container.innerHTML =
                "<p class='col-span-full text-center text-red-500'>Error loading items.</p>";
        }
    }

    // Botón buy now que redirige a Stripe
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("buy-now")) {
            const btn = e.target;

            // Datos del producto a enviar
            const productData = {
                id: btn.dataset.id,
                name: btn.dataset.name,
                price: btn.dataset.price,
                image: btn.dataset.image,
            };

            // Enviar al backend para generar link de pago de Stripe
            fetch("/create-stripe-link", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({ items: [productData] }),
            })
                .then((res) => res.json())
                .then((data) => {
                    if (data.url) {
                        window.location.href = data.url; //redirigir a Stripe
                    } else if (data.error) {
                        alert("Error: " + data.error);
                    } else {
                        alert("Payment link failed.");
                    }
                })
                .catch((error) => {
                    //error no elegante D:
                    console.error("Fetch error:", error);
                    alert("Error en la conexión con el servidor.");
                });
        }
    });

    // Enviar filtros
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        const params = new URLSearchParams();

        // agrega solo campos con valores
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

//muestra opciones de ordenamiento
sortToggle.addEventListener("click", () => {
    sortOptions.classList.toggle("hidden");
});

//eventos para las opciones de ordenamiento
sortOptions.querySelectorAll("li").forEach((option) => {
    option.addEventListener("click", () => {
        const value = option.getAttribute("data-value");
        sortByInput.value = value;

        sortToggle.innerHTML = `${option.textContent}
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>`;

        sortOptions.classList.add("hidden");
        //dispara evento submit
        form.dispatchEvent(new Event("submit"));
    });
});

// Mostrar/ocultar sidebar en pantallas pequeñas
function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    sidebar.classList.toggle("hidden");
}