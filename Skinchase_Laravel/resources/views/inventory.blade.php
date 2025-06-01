@extends('layouts.app')

@section('content')

@include('includes.scripts')

@section('content')
<h1 class="text-center text-4xl md:text-6xl font-bold mb-6 leading-tight">Steam inventory</h1>

<div class="max-w-6xl mx-auto p-4">
    <div id="inventory-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Inventory items will be injected here by inventory.js -->
    </div>
</div>
@endsection
<script>
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
          let tagsHtml = "";
          if (item.tags && item.tags.length > 0) {
              tagsHtml = '<div class="tags flex flex-wrap gap-1 mt-2">';
              item.tags.forEach(tag => {
                  tagsHtml += `<span class="px-2 py-0.5 text-xs rounded bg-gray-700 text-white">${tag.localized_tag_name}</span>`;
              });
              tagsHtml += "</div>";
          }

          const card = document.createElement("div");
          card.className =
              "bg-[#1A1D24] h-[428px] rounded-xl overflow-hidden shadow-md text-white p-4 flex flex-col gap-2 transition hover:shadow-lg cursor-pointer";

          card.innerHTML = `
              <div class="relative bg-gradient-to-b from-purple-700 to-purple-900 rounded-lg p-2 flex justify-center items-center">
                  <img src="${item.icon_url}" alt="${item.market_hash_name}" class="h-32 object-contain">
              </div>

              <div class="mt-2">
                  <h2 class="text-orange-500 font-semibold text-md text-center">${item.market_hash_name}</h2>
                  <p class="text-xs text-gray-400 mt-1 text-center">${item.type ?? "Unknown type"}</p>
                  <p class="text-xs text-gray-400 text-center">${item.tradable ? "Tradable" : "Not Tradable"}</p>
                  ${tagsHtml}
              </div>

              <div class="flex gap-2 mt-auto">
                        <button class="js-add-to-basket flex-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-md text-sm transition"
                            data-id="${item.asset_id}"
                            data-name="${item.name}"
                            data-price="${(item.price / 1).toFixed(2)}"
                            data-image="${item.icon_url}">Sell
                            </button>
                </div>
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
</script>