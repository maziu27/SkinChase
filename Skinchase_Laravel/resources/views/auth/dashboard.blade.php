@extends('layouts.app')

@section('title', 'Dashboard | SkinChase')

@if(!auth()->check())
    <script>window.location.href = "{{ route('login') }}";</script>
@else
    @section('content')
        <h1 class="text-center my-6 text-3xl font-bold text-purple-500">Welcome back, {{ auth()->user()->name }} </h1>

        {{-- Perfil del usuario --}}
        <div class="max-w-5xl mx-auto bg-[#1A1D24] text-white rounded-xl p-6 shadow-lg space-y-6">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center space-x-4">
                    @if(auth()->user()->profile_picture)
                        <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" class="w-24 h-24 rounded-full">
                    @endif
                    <div>
                        <p class="text-xl font-bold">{{ auth()->user()->name }}</p>
                        <div class="flex items-center gap-2 text-sm mt-1">
                        </div>
                    </div>
                </div>
                <span class="bg-green-500 text-white px-3 py-1 rounded-md font-medium mt-4 md:mt-0">✔ Verified</span>
            </div>

            Earnings
            <div class="bg-[#2A2D34] p-4 rounded-lg">
                <h2 class="text-lg font-semibold mb-2">Earnings</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <p class="text-gray-400">Purchases</p>
                        <p class="text-green-400 font-bold">n/a €</p>
                    </div>
                    <div>
                        <p class="text-gray-400">Net</p>
                        <p class="text-yellow-400 font-bold">n/a €</p>
                    </div>
                </div>
            </div>

            {{-- Tabs --}}
            {{-- Tabs --}}
            <div class="flex space-x-4 border-b border-gray-600 text-sm text-gray-300 pt-4">
                <button data-tab="personal-info"
                    class="tab-button pb-2 border-b-2 border-purple-500 text-purple-400 font-semibold">Personal Info</button>
                <button data-tab="items-for-sale" class="tab-button pb-2">Listed items</button>
                <button data-tab="transactions" class="tab-button pb-2">Transactions</button>
               {{-- <button data-tab="trades" class="tab-button pb-2">Trades</button>--}}
            </div>

            {{--Personal Info --}}
            <div id="personal-info" class="tab-content">
                <div class="bg-[#2A2D34] p-4 rounded-lg">
                    <h3 class="text-lg font-semibold flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A4 4 0 016 16h12a4 4 0 011 1.804M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Personal Info
                    </h3>
                    <p class="text-sm text-gray-400 mt-1 mb-4">Enter and change your personal information here.</p>

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm text-gray-300 mb-1" for="email">Email address</label>
                            <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}"
                                class="w-full bg-gray-800 text-white border border-gray-600 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>

                        <div>
                            <label class="block text-sm text-gray-300 mb-1" for="password">New Password</label>
                            <input type="password" name="password" id="password"
                                class="w-full bg-gray-800 text-white border border-gray-600 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>

                        <div>
                            <label class="block text-sm text-gray-300 mb-1" for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full bg-gray-800 text-white border border-gray-600 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>

                        <div>
                            <label class="block text-sm text-gray-300 mb-1" for="trade_link">Steam Trade Link</label>
                            <input type="url" name="trade_link" id="trade_link"
                                value="{{ old('trade_link', auth()->user()->trade_link) }}"
                                class="w-full bg-gray-800 text-white border border-gray-600 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>

                        <div>
                            <label class="block text-sm text-gray-300 mb-1" for="profile_picture">Profile Picture</label>
                            <input type="file" name="profile_picture" id="profile_picture"
                                class="w-full bg-gray-800 text-white border border-gray-600 rounded px-4 py-2">
                        </div>

                        <button type="submit"
                            class="bg-purple-600 hover:bg-purple-700 text-white text-center px-4 py-2 rounded">
                            Update Info
                        </button>
                    </form>
                    <form method="POST" action="{{ route('logout') }}" class="text-center pt-4">
                        @csrf
                        <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded transition">
                            Delete account
                        </button>
                    </form>
                </div>
            </div>

            <div id="items-for-sale" class="tab-content hidden">
                {{-- Items for sale content --}}
                <div class="bg-[#2A2D34] p-4 rounded-lg">
                    <h3 class="text-lg font-semibold mb-4">Your Items for Sale</h3>
                    <div id="inventory-container"
                        class="grid gap-4 xl:grid-cols-6 lg:grid-cols-5 md:grid-cols-3 sm:grid-cols-3 grid-cols-2"></div>
                    <!-- Aquí puedes listar los items del usuario -->
                </div>
            </div>

            <div id="transactions" class="tab-content hidden">
                {{-- Transactions content --}}
                <div class="bg-[#2A2D34] p-4 rounded-lg">
                    <h3 class="text-lg font-semibold mb-4">Transaction History</h3>

                </div>
            </div>
            {{--
            <div id="trades" class="tab-content hidden">
                {{-- Trades content 
                <div class="bg-[#2A2D34] p-4 rounded-lg">
                    <h3 class="text-lg font-semibold mb-4">Trade History</h3>
                    <p class="text-gray-400">No trades yet.</p>
                </div>
            </div>--}}

            {{-- Botón de logout --}}
            <form method="POST" action="{{ route('logout') }}" class="text-center pt-4">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded transition">
                    Log out
                </button>
            </form>


        </div>
    @endsection
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Obtener el ID del contenido a mostrar
                const tabId = button.getAttribute('data-tab');

                // Remover clases activas de todos los botones
                tabButtons.forEach(btn => {
                    btn.classList.remove('border-b-2', 'border-purple-500', 'text-purple-400', 'font-semibold');
                    btn.classList.add('text-gray-300');
                });

                // Añadir clases activas al botón clickeado
                button.classList.add('border-b-2', 'border-purple-500', 'text-purple-400', 'font-semibold');
                button.classList.remove('text-gray-300');

                // Ocultar todos los contenidos
                tabContents.forEach(content => {
                    content.classList.add('hidden');
                });

                // Mostrar el contenido correspondiente
                document.getElementById(tabId).classList.remove('hidden');
            });
        });
    });
</script>

<!--skins en venta -->
<script>
    const userId = {{ Auth::id() }};

    // Define renderItems function before it's used
    function renderItems(items) {
        const inventoryContainer = document.getElementById("inventory-container");

        if (!items || items.length === 0) {
            inventoryContainer.innerHTML = `
                    <p class='text-gray-400 col-span-full text-center py-10'>
                        You don't have any items listed in your stall yet. Sell your items <a class="text-blue-500" href="{{route('inventory')}}">here</a>
                    </p>
                `;
            return;
        }

        inventoryContainer.innerHTML = items.map(item => `
    <div class="item-card bg-gray-800 rounded-lg overflow-hidden shadow-lg transition-transform hover:scale-105">
        <img src="${item.icon_url || '/images/default-item.png'}" alt="${item.market_hash_name}" 
             class="w-full h-32 object-contain bg-gray-900 p-2">
        <div class="p-3">
            <h3 class="text-white font-semibold break-words">${item.market_hash_name}</h3>
            <p class="text-orange-400 font-bold">€${(item.price || 0).toFixed(2)}</p>
        </div>
    </div>
`).join('');

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