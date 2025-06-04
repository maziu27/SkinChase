@extends('layouts.app')

@section('title', 'Stall | SkinChase')
@if(!auth()->check())
    <script>window.location.href = "{{ route('login') }}";</script>
@else
    @section('content')
        <h1 class="text-center p-3 text-purple-400 text-4xl md:text-6xl font-bold mb-6 leading-tight">{{Auth::user()->name}}'s
            Stall</h1>

        <div class="container mx-auto px-4">
            <div id="inventory-container"
                class="grid gap-4 xl:grid-cols-6 lg:grid-cols-5 md:grid-cols-3 sm:grid-cols-3 grid-cols-2"></div>
        </div>

        <script>
            const userId = {{ Auth::id() }};

            // Define renderItems function before it's used
            function renderItems(items) {
                const inventoryContainer = document.getElementById("inventory-container");

                if (!items || items.length === 0) {
                    inventoryContainer.innerHTML = `
                    <p class='text-gray-400 col-span-full text-center py-10'>
                        You don't have any items listed in your stall yet.
                    </p>
                `;
                    return;
                }

                inventoryContainer.innerHTML = items.map(item => `
                <div class="item-card bg-gray-800 rounded-lg overflow-hidden shadow-lg transition-transform hover:scale-105">
                    <img src="${item.icon_url || '/images/default-item.png'}" alt="${item.market_hash_name}" 
                         class="w-full h-32 object-contain bg-gray-900 p-2">
                    <div class="p-3">
                        <h3 class="text-white font-semibold truncate">${item.market_hash_name}</h3>
                        <p class="text-orange-400 font-bold">€${(item.price || 0).toFixed(2)}</p>
                        <button class="update-price mt-2 w-full bg-blue-600 hover:bg-blue-700 text-white py-1 px-3 rounded"
                                data-id="${item.id}"
                                data-name="${item.market_hash_name}"
                                data-price="${item.price || 0}">
                            Update Price
                        </button>
                    </div>
                </div>
            `).join('');

                // Rest of your event listeners...
            }

            function updateItemPrice(itemId, newPrice) {
                fetch(`/api/items/${itemId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ price: newPrice })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Price updated successfully!');
                            document.getElementById('priceModal').classList.add('hidden');
                            fetchUserItems(); // Refresh the list
                        } else {
                            alert('Error updating price: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error updating price');
                    });
            }

            async function fetchUserItems() {
                const inventoryContainer = document.getElementById("inventory-container");
                inventoryContainer.innerHTML = "<p class='text-gray-400 col-span-full text-center py-10'>Loading your items...</p>";

                try {
                    const response = await fetch(`/api/user/items?user_id=${userId}`, {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const items = await response.json();
                    renderItems(items);
                } catch (error) {
                    console.error("Error:", error);
                    inventoryContainer.innerHTML = `
                            <p class='text-red-500 col-span-full text-center py-10'>
                                Error loading items: ${error.message}
                            </p>
                        `;
                }
            }

            document.addEventListener("DOMContentLoaded", function () {
                console.log("User's stall loaded correctly");

                // Create the modal dynamically
                const modalHTML = `
                        <div id="priceModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                            <div class="bg-gray-800 rounded-lg p-6 w-full max-w-md">
                                <h3 class="text-xl font-bold text-white mb-4">Update Price</h3>
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
                                        Update
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                document.body.insertAdjacentHTML('beforeend', modalHTML);

                // Set up cancel button
                document.getElementById('cancelSell').addEventListener('click', function () {
                    document.getElementById('priceModal').classList.add('hidden');
                });

                // Load user items on page load
                fetchUserItems();
            });
        </script>
    @endsection
@endif