document.addEventListener("DOMContentLoaded", function () {
    // Cargar productos desde la API
    fetch('/api/fetch-data')
        .then(response => response.json())
        .then(responseData => {
            if (responseData.data && Array.isArray(responseData.data)) {
                loadProducts(responseData.data);
                updateBasketCount(); // Mostrar el contador inicial de productos en la cesta
            }
        });

    // Mostrar/Ocultar el sidebar al hacer clic en el botón del carrito
    const basketToggle = document.getElementById('basket-toggle');
    if (basketToggle) {
        basketToggle.addEventListener('click', () => {
            const sidebar = document.getElementById('basket-sidebar');
            sidebar.classList.remove('translate-x-full');
            sidebar.classList.add('translate-x-0');
            renderBasketItems(); // Mostrar los productos en el sidebar
        });
    }

    // Cerrar el sidebar
    const closeSidebar = document.getElementById('close-basket');
    if (closeSidebar) {
        closeSidebar.addEventListener('click', () => {
            const sidebar = document.getElementById('basket-sidebar');
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('translate-x-full');
        });
    }

    // Vaciar la cesta
    const clearBasketButton = document.getElementById('clear-basket');
    if (clearBasketButton) {
        clearBasketButton.addEventListener('click', () => {
            if (confirm("¿Seguro que quieres vaciar la cesta?")) {
                localStorage.removeItem('basket');
                updateBasketCount();
                renderBasketItems();
            }
        });
    }
});

// Función para cargar productos en la UI
function loadProducts(products) {
    const productContainer = document.getElementById('product-container');
    if (!productContainer) return;

    productContainer.innerHTML = '';

    products.forEach(product => {
        const item = product.item;
        if (!item || !item.asset_id || !product.price) return;

        const productElement = document.createElement('div');
        productElement.classList.add('product');
        productElement.innerHTML = `
            <h3 class="text-xs color-white font-semibold mt-2">${item.market_hash_name}</h3>
            <img src="https://steamcommunity-a.akamaihd.net/economy/image/${item.icon_url}" alt="Skin Image">
            <p class="text-white">Price: <span class="font-bold">${(product.price / 100).toFixed(2)} EUR</span></p>
            <p class="text-gray-500">Float Value: ${parseFloat(item.float_value).toFixed(5)}</p>
            <button class="add-to-basket mt-2 bg-blue-500 color-white px-4 py-2 rounded hover:bg-blue-600" 
                data-id="${item.asset_id}"
                data-name="${item.market_hash_name}"
                data-price="${(product.price / 100).toFixed(2)}"
                data-image="${item.icon_url}">
                Add to cart
            </button>
        `;

        productContainer.appendChild(productElement);
    });

    // Añadir evento a cada botón de añadir a la cesta
    document.querySelectorAll('.add-to-basket').forEach(button => {
        button.addEventListener('click', () => {
            const product = {
                id: button.getAttribute('data-id'),
                name: button.getAttribute('data-name'),
                price: button.getAttribute('data-price'),
                image: button.getAttribute('data-image')
            };
            addToBasket(product);
        });
    });
}

// Añadir producto a la cesta
function addToBasket(product) {
    let basket = getBasket();

    // Verificamos si el producto ya está en la cesta
    if (!basket.some(item => item.id === product.id)) {
        basket.push(product);
        localStorage.setItem('basket', JSON.stringify(basket));
        updateBasketCount();
    } else {
        alert(`${product.name} is already in you basket.`);
    }
}

// Obtener la cesta desde localStorage
function getBasket() {
    return JSON.parse(localStorage.getItem('basket')) || [];
}

// Actualizar el contador de productos en el carrito (cesta)
function updateBasketCount() {
    const basketToggle = document.getElementById('basket-toggle');
    const basket = getBasket();
    let count = basket.length;

    // Si no existe un badge de conteo, lo creamos
    let countBadge = basketToggle.querySelector('.basket-count');
    if (!countBadge) {
        countBadge = document.createElement('span');
        countBadge.className = 'basket-count absolute top-0 right-0 bg-red-600 text-white text-xs px-2 rounded-full';
        basketToggle.appendChild(countBadge);
    }

    countBadge.textContent = count;
}

// Mostrar los productos en el sidebar
function renderBasketItems() {
    const basket = getBasket();
    const container = document.getElementById('basket-items');
    container.innerHTML = '';

    if (basket.length === 0) {
        container.innerHTML = '<p class="text-gray-400">Your basket is empty.</p>';
        return;
    }

    basket.forEach(item => {
        const div = document.createElement('div');
        div.className = 'flex items-center justify-between bg-gray-800 p-2 rounded';
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

    // Eliminar productos de la cesta
    document.querySelectorAll('.remove-item').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.getAttribute('data-id');
            removeFromBasket(id);
        });
    });
}

// Eliminar un producto de la cesta
function removeFromBasket(id) {
    let basket = getBasket();
    basket = basket.filter(item => item.id !== id);
    localStorage.setItem('basket', JSON.stringify(basket));
    updateBasketCount();
    renderBasketItems();
}
