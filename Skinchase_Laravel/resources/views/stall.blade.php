@extends('layouts.app')

@section('title', 'Stall | SkinChase')
@if(!auth()->check())
    <script>window.location.href = "{{ route('login') }}";</script>
@else
    @section('content')
        <h1 class="text-center p-3 text-purple-400 text-4xl md:text-6xl font-bold mb-6 leading-tight">{{Auth::user()->name}}'s
            Stall</h1>

        <div class="max-w-6xl mx-auto p-4">
            <div id="inventory-container"
                class="flex-1 grid gap-4 xl:grid-cols-5 lg:grid-cols-5 md:grid-cols-3 sm:grid-cols-3 grid-cols-2 overflow-hidden">
                
            </div>
        </div>

        <script>
            const userId = {{ Auth::id() }};

            // función para renderizar los items
            function renderItems(items) {
                const inventoryContainer = document.getElementById("inventory-container");

                if (!items || items.length === 0) {
                    inventoryContainer.innerHTML = `
                        <div class="col-span-full text-center py-10">
                            <p class='text-gray-400'>
                                You don't have any items listed in your stall yet.
                            </p>
                        </div>
                    `;
                    return;
                }

                inventoryContainer.innerHTML = items.map(item => `
                    <div class="bg-[#1A1D24] h-[300px] rounded-xl overflow-hidden shadow-md text-white p-4 flex flex-col gap-2 transition hover:shadow-lg cursor-pointer">
                        <div class="relative bg-gradient-to-b from-purple-700 to-purple-900 rounded-lg p-2 flex justify-center items-center">
                            <img src="${item.icon_url || '/images/default-item.png'}" alt="${item.market_hash_name}" class="h-32 object-contain">
                        </div>

                        <div class="mt-2">
                            <h2 class="text-orange-500 font-semibold text-md text-center">${item.market_hash_name}</h2>
                            <p class="text-green-400 text-lg font-bold text-center">€${(item.price || 0).toFixed(2)}</p>
                        </div>
                    </div>
                `).join('');
            }

            // obtener los items del usuario
            async function fetchUserItems() {
                const inventoryContainer = document.getElementById("inventory-container");
                inventoryContainer.innerHTML = `
                    <div class="col-span-full text-center py-10">
                        <p class='text-gray-400'>
                            Loading your items...
                        </p>
                    </div>
                `;

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
                        <div class="col-span-full text-center py-10">
                            <p class='text-red-500'>
                                Error loading items: ${error.message}
                            </p>
                        </div>
                    `;
                }
            }

            document.addEventListener("DOMContentLoaded", function () {
                console.log("User's stall loaded correctly");
                fetchUserItems();
            });
        </script>
    @endsection
@endif