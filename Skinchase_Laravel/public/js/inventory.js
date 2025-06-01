console.log("Archivo inventory.js cargado");
document.addEventListener("DOMContentLoaded", function () {
    console.log("DOM listo, ejecutando fetchInventory");
    const inventoryContainer = document.getElementById("inventory-container");
  
    function renderInventory(items) {
      inventoryContainer.innerHTML = "";
  
      if (!items || items.length === 0) {
        inventoryContainer.innerHTML = "<p class='text-gray-400'>No skins found in the inventory.</p>";
        return;
      }
  
      items.forEach((item) => {
        const card = document.createElement("div");
        card.className =
          "bg-[#1A1D24] rounded-xl shadow-md p-4 text-white flex flex-col items-center";
  
        card.innerHTML = `
          <img src="${item.icon_url}" alt="${item.market_hash_name}" class="h-24 mb-2" />
          <p class="text-sm font-semibold text-center">${item.market_hash_name}</p>
          <p class="text-xs text-gray-400 mt-1">${item.type ?? "Unknown type"}</p>
          <p class="text-xs text-gray-400">${item.tradable ? "Tradable" : "Not Tradable"}</p>
        `;
  
        inventoryContainer.appendChild(card);
      });
    }
  
    async function fetchInventory() {
      inventoryContainer.innerHTML = "<p class='text-gray-400'>Loading your Steam inventory...</p>";

      console.log("Iniciando fetch del inventario Steam...");
      try {
        const response = await fetch("/api/steam/inventory");
        const items = await response.json();
        console.log("Datos recibidos del fetch:", items);

        if (Array.isArray(items)) {
          renderInventory(items);
        } else if (items.error) {
          inventoryContainer.innerHTML = `<p class='text-red-500'>${items.error}</p>`;
        } else {
          inventoryContainer.innerHTML = "<p class='text-red-500'>Unexpected error loading inventory.</p>";
        }
      } catch (error) {
        console.error("Error atrapado en fetchInventory:", error);
        inventoryContainer.innerHTML = "<p class='text-red-500'>Error loading inventory.</p>";
      }
    }
  
    fetchInventory();
  });