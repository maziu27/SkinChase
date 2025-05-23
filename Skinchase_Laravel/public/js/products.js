// Esperar a que el DOM esté completamente cargado
/*
document.addEventListener("DOMContentLoaded", function () {
    // 1. Cargar productos desde la API al iniciar la página
    fetch("/api/fetch-data")
        .then((response) => response.json())
        .then((responseData) => {
            // Validar que la respuesta contenga datos válidos
            if (responseData.data && Array.isArray(responseData.data)) {
                loadProducts(responseData.data); // Mostrar los productos en la interfaz
                updateBasketCount(); // Actualizar el contador de productos en la cesta
            }
        });


    
    // 2. Abrir el sidebar del carrito al hacer clic en el icono
    const basketToggle = document.getElementById("basket-toggle");
    if (basketToggle) {
        basketToggle.addEventListener("click", () => {
            const sidebar = document.getElementById("basket-sidebar");
            sidebar.classList.remove("translate-x-full"); // Mostrar sidebar (deslizar hacia adentro)
            sidebar.classList.add("translate-x-0");
            renderBasketItems(); // Mostrar productos actuales en el carrito
        });
    }

    // 3. Cerrar el sidebar al hacer clic en la "X"
    
    const closeSidebar = document.getElementById("close-basket");
    if (closeSidebar) {
        closeSidebar.addEventListener("click", () => {
            const sidebar = document.getElementById("basket-sidebar");
            sidebar.classList.remove("translate-x-0"); // Ocultar sidebar (deslizar hacia afuera)
            sidebar.classList.add("translate-x-full");
        });
    }
    
    // 4. Botón para vaciar completamente el carrito
    
    const clearBasketButton = document.getElementById("clear-basket");
    if (clearBasketButton) {
        clearBasketButton.addEventListener("click", () => {
            if (confirm("¿Seguro que quieres vaciar la cesta?")) {
                localStorage.removeItem("basket"); // Eliminar el carrito del localStorage
                updateBasketCount(); // Actualizar el contador del carrito
                renderBasketItems(); // Actualizar la vista del sidebar del carrito
            }
        });
    }
});

// Función para mostrar los productos en la UI

function loadProducts(products) {
    const productContainer = document.getElementById("product-container");
    if (!productContainer) return;

    productContainer.innerHTML = ""; // Limpiar el contenedor

    // Iterar por cada producto recibido
    products.forEach((product) => {
        const item = product.item;
        if (!item || !item.asset_id || !product.price) return; // Validación de datos

        const productElement = document.createElement("div");
        productElement.classList.add("product");

        // Estructura HTML de cada producto
        productElement.innerHTML = `
        <div class="bg-gray-800 p-7 hover:scale-105 rounded-xl shadow-lg text-center">
        <h3 class="text-sm text-white font-semibold mb-2 truncate">${
            item.market_hash_name
        }</h3>
        <img src="https://steamcommunity-a.akamaihd.net/economy/image/${
            item.icon_url
        }" alt="Skin Image" class="w-full h-32 object-contain rounded-md mb-3 border border-gray-700">
        <p class="text-white text-sm mb-1">Price: <span class="font-bold text-purple-400">${(
            product.price / 100
        ).toFixed(2)} EUR</span></p>
        <p class="text-gray-400 text-xs mb-4">Float Value: ${parseFloat(
            item.float_value
        ).toFixed(5)}</p>
        
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
        </div>
    </div>
`;

        // Agregar el producto al contenedor
        productContainer.appendChild(productElement);
    });

    // EVENTOS DE LOS BOTONES

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

    // Botón "Add to cart" → agregar producto al carrito
    document.querySelectorAll(".add-to-basket").forEach((button) => {
        button.addEventListener("click", () => {
            const product = {
                id: button.getAttribute("data-id"),
                name: button.getAttribute("data-name"),
                price: button.getAttribute("data-price"),
                image: button.getAttribute("data-image"),
            };
            addToBasket(product); // Añadir al carrito
        });
    });
}


// Añadir producto al carrito si no está repetido
function addToBasket(product) {
    let basket = getBasket(); // Obtener carrito actual

    // Verificar si ya está agregado
    if (!basket.some((item) => item.id === product.id)) {
        basket.push(product); // Agregar nuevo producto
        localStorage.setItem("basket", JSON.stringify(basket)); // Guardar en localStorage
        updateBasketCount(); // Actualizar contador visual
    } else {
        alert(`${product.name} is already in your basket.`); // Mensaje si ya existe
    }
}

// Obtener productos del carrito desde localStorage
function getBasket() {
    return JSON.parse(localStorage.getItem("basket")) || [];
}

// Actualizar contador visual del icono del carrito
function updateBasketCount() {
    const basketToggle = document.getElementById("basket-toggle");
    const basket = getBasket();
    let count = basket.length;

    // Buscar o crear el "badge" de cantidad
    let countBadge = basketToggle.querySelector(".basket-count");
    if (!countBadge) {
        countBadge = document.createElement("span");
        countBadge.className =
            "basket-count absolute top-0 right-0 bg-red-600 text-white text-xs px-2 rounded-full";
        basketToggle.appendChild(countBadge);
    }

    countBadge.textContent = count; // Actualizar número
}

// Mostrar productos actuales en el carrito (sidebar)
function renderBasketItems() {
    const basket = getBasket();
    const container = document.getElementById("basket-items");
    container.innerHTML = "";

    // Si está vacío, mostrar mensaje
    if (basket.length === 0) {
        container.innerHTML =
            '<p class="text-gray-400">Your basket is empty.</p>';
        return;
    }

    // Mostrar cada producto del carrito
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
    });

    // Evento para eliminar un producto individual del carrito
    document.querySelectorAll(".remove-item").forEach((btn) => {
        btn.addEventListener("click", () => {
            const id = btn.getAttribute("data-id");
            removeFromBasket(id); // Eliminar producto específico
        });
    });
}

// Eliminar producto del carrito por ID
function removeFromBasket(id) {
    let basket = getBasket(); // Obtener carrito actual
    basket = basket.filter((item) => item.id !== id); // Quitar producto
    localStorage.setItem("basket", JSON.stringify(basket)); // Guardar carrito actualizado
    updateBasketCount(); // Actualizar contador
    renderBasketItems(); // Refrescar vista del sidebar
}
*/