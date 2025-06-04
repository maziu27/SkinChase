document.addEventListener("DOMContentLoaded", function () {
  console.log("Steam inventory loaded correctly");
  console.log("DOM is loaded, starting to fetch inventory...");
  const inventoryContainer = document.getElementById("inventory-container");
  
  // Crear el modal dinámicamente
  const modalHTML = `
      <div id="priceModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
          <div class="bg-gray-800 rounded-lg p-6 w-full max-w-md">
              <h3 class="text-xl font-bold text-white mb-4">Set Price</h3>
              <p id="itemName" class="text-orange-500 mb-2"></p>
              <div class="mb-4">
                  <label for="priceInput" class="block text-sm text-gray-300 mb-2">Price (€)</label>
                  <input type="number" step="0.01" id="priceInput" 
                         class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white">
              </div>
              <div class="flex gap-2">
                  <button id="cancelSell" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md">
                      Cancel
                  </button>
                  <button id="confirmSell" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                      Confirm
                  </button>
              </div>
          </div>
      </div>
  `;
  document.body.insertAdjacentHTML('beforeend', modalHTML);
  
  // Elementos del modal
  const priceModal = document.getElementById("priceModal");
  const priceInput = document.getElementById("priceInput");
  const itemName = document.getElementById("itemName");
  const cancelSell = document.getElementById("cancelSell");
  const confirmSell = document.getElementById("confirmSell");
  
  let currentItem = null;
  
  // Manejadores del modal
  cancelSell.addEventListener("click", () => {
      priceModal.classList.add("hidden");
  });
  
  confirmSell.addEventListener("click", async () => {
      const price = parseFloat(priceInput.value);
      if (isNaN(price) || price <= 0) {
          alert("Please enter a valid price");
          return;
      }
      
      if (currentItem) {
          await sellItem(currentItem, price);
          priceModal.classList.add("hidden");
      }
  });
  
  // Función para vender el ítem
  async function sellItem(item, price) {
      const formData = {
          asset_id: item.asset_id,
          market_hash_name: item.market_hash_name,
          icon_url: item.icon_url,
          type: item.type ?? "Unknown",
          tradable: item.tradable,
          tags: item.tags || [],
          price: price
      };
      
      try {
          const response = await fetch("/items", {
              method: "POST",
              headers: {
                  "Content-Type": "application/json",
                  "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                  "Accept": "application/json",
              },
              body: JSON.stringify(formData)
          });
          
          const data = await response.json();
          if (response.ok) {
              alert("Item listed for sale successfully!");
          } else {
              throw new Error(data.message || "Failed to list item");
          }
      } catch (error) {
          console.error("Error:", error);
          alert("Error listing item: " + error.message);
      }
  }

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
          card.className = "bg-[#1A1D24] h-[428px] rounded-xl overflow-hidden shadow-md text-white p-4 flex flex-col gap-2 transition hover:shadow-lg cursor-pointer";

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
                  <button class="js-sell-item flex-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-md text-sm transition"
                      data-id="${item.asset_id}">
                      Sell
                  </button>
              </div>
          `;

          const sellButton = card.querySelector(".js-sell-item");
          sellButton.addEventListener("click", (e) => {
              e.stopPropagation();
              currentItem = item;
              itemName.textContent = item.market_hash_name;
              priceInput.value = item.price ? item.price.toFixed(2) : "";
              priceModal.classList.remove("hidden");
              priceInput.focus();
          });

          inventoryContainer.appendChild(card);
      });
  }

  async function fetchInventory() {
      inventoryContainer.innerHTML = "<p class='text-gray-400'>Loading your Steam inventory...</p>";

      try {
          const response = await fetch("/api/steam/inventory");
          const items = await response.json();

          if (Array.isArray(items)) {
              renderInventory(items);
          } else if (items.error) {
              inventoryContainer.innerHTML = `<p class='text-red-500'>${items.error}</p>`;
          } else {
              inventoryContainer.innerHTML = "<p class='text-red-500'>Unexpected error loading inventory.</p>";
          }
      } catch (error) {
          console.error("Error:", error);
          inventoryContainer.innerHTML = "<p class='text-red-500'>Error loading inventory.</p>";
      }
  }

  fetchInventory();
});