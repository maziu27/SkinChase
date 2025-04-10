document.addEventListener("DOMContentLoaded", function () {
    // Initialize basket
    const basket = JSON.parse(localStorage.getItem('basket')) || [];
    const basketToggle = document.getElementById('basket-toggle');
    const basketElement = document.getElementById('basket');
    const basketItems = document.getElementById('basket-items');
    const basketTotal = document.getElementById('basket-total');
    const basketData = document.getElementById('basket-data');

    // Basket toggle functionality
    if (basketToggle && basketElement) {
        basketToggle.addEventListener('click', function(e) {
            console.log("Basket toggle clicked");
            e.stopPropagation();
            basketElement.classList.toggle('hidden');
            updateBasketUI();
        });

        document.addEventListener('click', function(e) {
            if (!basketElement.contains(e.target) && e.target !== basketToggle) {
                basketElement.classList.add('hidden');
            }
        });
    }

    function updateBasketUI() {
        if (!basketItems || !basketTotal) return;
        
        basketItems.innerHTML = '';
        let total = 0;

        basket.forEach((item, index) => {
            const div = document.createElement('div');
            div.classList.add('bg-gray-500', 'p-2', 'rounded');
            div.innerHTML = `
                <img src="${item.image}" class="w-full h-32 object-contain mb-2 rounded" alt="${item.name}">
                <p class="text-sm font-semibold">${item.name}</p>
                <p class="text-sm">Float: ${parseFloat(item.float).toFixed(5)}</p>
                <p class="text-sm">Price: ${item.price} EUR</p>
                <button class="text-red-600 text-sm mt-2 remove-item" data-index="${index}">Remove</button>
            `;
            basketItems.appendChild(div);
            total += parseFloat(item.price);
        });

        basketTotal.textContent = total.toFixed(2);
        if (basketData) basketData.value = JSON.stringify(basket);

        // Add remove item handlers
        document.querySelectorAll('.remove-item').forEach(btn => {
            btn.addEventListener('click', function() {
                basket.splice(parseInt(this.dataset.index), 1);
                localStorage.setItem('basket', JSON.stringify(basket));
                updateBasketUI();
            });
        });
    }

    fetch('/api/fetch-data')
        .then(response => response.json())
        .then(responseData => {
            if (responseData.data && Array.isArray(responseData.data)) {
                loadProducts(responseData.data);
            }
        });
});

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
            <img src="https://steamcommunity-a.akamaihd.net/economy/image/${item.icon_url}" alt="Skin Image" class="w-[512] h-[384] object-cover rounded-md mx-auto">
            <h3 class="text-lg font-semibold mt-2">${item.market_hash_name}</h3>
            <p class="text-gray-600">Price: <span class="font-bold">${(product.price / 100).toFixed(2)} EUR</span></p>
            <p class="text-gray-500">Float Value: ${parseFloat(item.float_value).toFixed(5)}</p>
            <button class="mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Buy Now</button>
            <button class="mt-2 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 add-to-basket" 
                    data-asset-id="${item.asset_id}"
                    data-name="${item.market_hash_name}"
                    data-price="${(product.price / 100).toFixed(2)}"
                    data-float="${item.float_value}"
                    data-image="https://steamcommunity-a.akamaihd.net/economy/image/${item.icon_url}">
                Add to basket
            </button>
        `;

        productContainer.appendChild(productElement);
        
       
    });
}