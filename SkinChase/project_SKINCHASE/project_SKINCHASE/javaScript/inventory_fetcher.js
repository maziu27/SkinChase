// Fetch inventory from PHP
function fetchInventory() {
    fetch('fetch_inventory.php') // Point to your PHP file
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error("Error:", data.error);
                return;
            }
            loadInventory(data); // Pass the items to render
        })
        .catch(error => {
            console.error("Failed to fetch inventory:", error);
        });
}

// Function to render the inventory items in the HTML
function loadInventory(items) {
    const inventoryContainer = document.getElementById('inventory');
    inventoryContainer.innerHTML = ''; // Clear previous inventory

    items.forEach(item => {
        const itemDiv = document.createElement('div');
        itemDiv.className = 'product';
        itemDiv.innerHTML = `
            <img src="${item.icon_url}" alt="${item.name}">
            <div class="name">${item.name}</div>
            <div class="rarity">${item.rarity}</div>
            <div class="weapon-type">${item.weapon_type}</div>
        `;
        inventoryContainer.appendChild(itemDiv);
    });
}

// Call fetchInventory function when the page loads
document.addEventListener('DOMContentLoaded', fetchInventory);
