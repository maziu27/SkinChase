document.addEventListener("DOMContentLoaded", function () {
    fetch('fetch_data.php') // Fetch data from the PHP API
        .then(response => response.json())
        .then(responseData => {
            console.log("Fetched data:", responseData); // Debugging

            if (responseData.data && Array.isArray(responseData.data)) {
                loadProducts(responseData.data);
            } else {
                console.error("Invalid data format:", responseData);
            }
        })
        .catch(error => {
            console.error('Error fetching market inventory:', error);
        });
});

function loadProducts(products) {
    const productContainer = document.getElementById('productContainer');
    productContainer.innerHTML = ''; // Clear previous content

    products.forEach(product => {
        const item = product.item; // Extract item details

        if (!item || !item.asset_id || !product.price) {
            console.error("Invalid product data:", product);
            return;
        }

        const productElement = document.createElement('div');
        productElement.classList.add('product');

        // Display product details
        productElement.innerHTML =  `
            <img src="https://steamcommunity-a.akamaihd.net/economy/image/${item.icon_url}" alt="Skin Image">
            <h3>${item.market_hash_name}</h3>
            <h3>Price: ${product.price / 100} EUR</h3>
            <p>Float Value: ${item.float_value}</p>
            
            
        `;

        productContainer.appendChild(productElement);
    });
}
