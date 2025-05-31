// Esperar a que el DOM esté completamente cargado
document.addEventListener("DOMContentLoaded", function () {
    // Cargar productos desde la API al iniciar la página
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
            const response = await fetch(`/items?${params}`);
            const items = await response.json();

            container.innerHTML = "";

            if (items.length === 0) {
                container.innerHTML =
                    "<p class='col-span-full text-center text-yellow-400'> No results were found.</p>";
                return;
            }

            items.forEach((item) => {
                const card = document.createElement("div");
                card.className =
                    "bg-[#1A1D24] h-[428px] rounded-xl overflow-hidden shadow-md text-white p-4 flex flex-col gap-2 transition hover:shadow-lg cursor-pointer";

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
                                ${/*si el nombre incluye "package" asigna el valor container,
                                    si el float no es null pone el float y el valor, y si es null
                                    asigna el valor a sticker */
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
            console.error("Error loading items:", err);
            container.innerHTML =
                "<p class='col-span-full text-center text-red-500'>Error loading items.</p>";
        }
    }

    // Botón "Buy Now" → redirige a Stripe
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
                body: JSON.stringify(productData),
            })
                .then((res) => res.json())
                .then((data) => {
                    if (data.url) {
                        window.location.href = data.url; // Redirigir a Stripe
                    } else {
                        alert("Payment link failed."); // Mostrar error
                    }
                });
        }
    });

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

sortOptions.querySelectorAll("li").forEach((option) => {
    option.addEventListener("click", () => {
        const value = option.getAttribute("data-value");
        sortByInput.value = value;

        sortToggle.innerHTML = `${option.textContent}
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>`;

        sortOptions.classList.add("hidden");
        form.dispatchEvent(new Event("submit"));
    });
});

// Mostrar/ocultar sidebar en pantallas pequeñas
function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    sidebar.classList.toggle("hidden");
}

/* 


    Funciones carrito


*/
document.addEventListener("DOMContentLoaded", () => {
    const basketToggle = document.getElementById("basket-toggle");
    const clearBasketButton = document.getElementById("clear-basket");
    const closeBasket = document.getElementById("close-basket");

    if (basketToggle) {
        basketToggle.addEventListener("click", () => {
            const sidebar = document.getElementById("basket-sidebar");
            sidebar.classList.remove("translate-x-full");
            sidebar.classList.add("translate-x-0");
            renderBasketItems();
        });
    }

    if (closeBasket) {
        closeBasket.addEventListener("click", () => {
            const sidebar = document.getElementById("basket-sidebar");
            sidebar.classList.remove("translate-x-0");
            sidebar.classList.add("translate-x-full");
        });
    }

    if (clearBasketButton) {
        clearBasketButton.addEventListener("click", () => {
            if (confirm("Do you really want to empty your basket?")) {
                localStorage.removeItem("basket");
                updateBasketCount();
                renderBasketItems();
            }
        });
    }

    function addToBasket(product) {
        let basket = getBasket();
        if (!basket.some((item) => item.id === product.id)) {
            basket.push(product);
            localStorage.setItem("basket", JSON.stringify(basket));
            updateBasketCount();
        } else {
            alert(`${product.name} is already in your basket.`);
        }
    }

    function getBasket() {
        return JSON.parse(localStorage.getItem("basket")) || [];
    }

    function updateBasketCount() {
        const basket = getBasket();
        const count = basket.length;
        let countBadge = basketToggle.querySelector(".basket-count");
        if (!countBadge) {
            countBadge = document.createElement("span");
            countBadge.className =
                "basket-count absolute top-0 right-0 bg-red-600 text-white text-xs px-2 rounded-full";
            basketToggle.appendChild(countBadge);
        }
        countBadge.textContent = count;
        countBadge.classList.toggle("hidden", count === 0);
    }

    function renderBasketItems() {
        const basket = getBasket();
        const container = document.getElementById("basket-items");
        container.innerHTML = "";
    
        if (basket.length === 0) {
            container.innerHTML =
                '<p class="text-gray-400">Your basket is empty.</p>';
            document.getElementById("basket-total").textContent = "€0.00";
            return;
        }
    
        let total = 0;
    
        basket.forEach((item) => {
            const div = document.createElement("div");
            div.className =
                "flex items-center justify-between bg-gray-800 p-2 rounded";
            div.innerHTML = `
                <img src="https://steamcommunity-a.akamaihd.net/economy/image/${item.image}" alt="${item.name}" class="w-12 h-12 rounded object-cover mr-2">
                <div class="flex-1">
                    <p class="text-sm font-semibold">${item.name}</p>
                    <p class="text-sm text-gray-400">${item.price} EUR</p>
                </div>
                <button class="remove-item text-red-500 hover:text-red-700 text-lg font-bold" data-id="${item.id}">&times;</button>
            `;
            container.appendChild(div);
    
            total += parseFloat(item.price);
        });
    
        document.getElementById("basket-total").textContent = `€${total.toFixed(2)}`;
    
        document.querySelectorAll(".remove-item").forEach((btn) => {
            btn.addEventListener("click", () => {
                const id = btn.getAttribute("data-id");
                removeFromBasket(id);
            });
        });
    }

    function removeFromBasket(id) {
        let basket = getBasket();
        basket = basket.filter((item) => item.id !== id);
        localStorage.setItem("basket", JSON.stringify(basket));
        updateBasketCount();
        renderBasketItems();
    }

    // Llamar contador al cargar la página
    updateBasketCount();

    // Escuchar clics en los botones js-add-to-basket
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("js-add-to-basket")) {
            const btn = e.target;
            const product = {
                id: btn.dataset.id,
                name: btn.dataset.name,
                price: btn.dataset.price,
                image: btn.dataset.image,
            };
            addToBasket(product);
        }
    });

    // Botón "Checkout All" para pagar todos los productos en la cesta
    const checkoutAll = document.getElementById("checkout-all");
    if (checkoutAll) {
        checkoutAll.addEventListener("click", () => {
            const basket = JSON.parse(localStorage.getItem("basket")) || [];

            if (basket.length === 0) {
                alert("Your basket is empty.");
                return;
            }

            fetch("/create-stripe-link", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({ items: basket }),
            })
                .then((res) => res.json())
                .then((data) => {
                    if (data.url) {
                        window.location.href = data.url;
                    } else {
                        alert("Payment link failed.");
                    }
                });
        });
    }
});
