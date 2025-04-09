document.addEventListener("DOMContentLoaded", function () {
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