console.log("Steam inventoory loaded correctly");
document.addEventListener("DOMContentLoaded", function () {
    console.log("DOM is loaded, starting to fetch inventory...");
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
                            data-name="${item.market_hash_name}"
                            data-price="${(item.price / 1).toFixed(2)}"
                            data-image="${item.icon_url}">Sell
                            </button>
                </div>
          `;
          // Attach event listener to the Sell button
          const sellButton = card.querySelector(".js-add-to-basket");
          sellButton.addEventListener("click", async function () {
            const formData = {
                asset_id: this.dataset.id,
                market_hash_name: this.dataset.name,
                icon_url: this.dataset.image,
                type: item.type ?? "Unknown",
                tradable: item.tradable,
                tags: item.tags || [],
            };
        
            try {
                const response = await fetch("/items", {  // or "/api/items" if using api.php
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Accept": "application/json",
                    },
                    body: JSON.stringify(formData)
                });
        
                // Handle response...
            } catch (error) {
                console.error("Error:", error);
            }
        });

          inventoryContainer.appendChild(card);
      });
    }
  
    async function fetchInventory() {
      inventoryContainer.innerHTML = "<p class='text-gray-400'>Loading your Steam inventory...</p>";

      console.log("Initializing fetch inventory");
      try {
        const response = await fetch("/api/steam/inventory");
        const items = await response.json();
        console.log("Data received from fetch", items);

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