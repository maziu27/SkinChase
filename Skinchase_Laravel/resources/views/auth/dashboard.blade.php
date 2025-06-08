@extends('layouts.app')

@section('title', 'Dashboard | SkinChase')
<!-- si el usuario no está iniciado sesión redirecciona al login -->
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
                            <span class="text-gray-400">Member since {{ auth()->user()->created_at->format('M Y') }}</span>
                        </div>
                    </div>
                </div>
                <span class="bg-green-500 text-white px-3 py-1 rounded-md font-medium mt-4 md:mt-0">Verified</span>
            </div>

            {{-- Tabs --}}
            <div class="flex space-x-4 border-b border-gray-600 text-sm text-gray-300 pt-4">
                <button data-tab="personal-info"
                    class="tab-button pb-2 border-b-2 border-purple-500 text-purple-400 font-semibold">Personal Info</button>
                <button data-tab="items-for-sale" class="tab-button pb-2">Listed items</button>
                <button data-tab="transactions" class="tab-button pb-2">Transactions</button>
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
                </div>
            </div>

            <div id="items-for-sale" class="tab-content hidden">
                {{-- Items for sale content --}}
                <div class="bg-[#2A2D34] p-4 rounded-lg">
                    <h3 class="text-lg font-semibold mb-4">Items for Sale. Check out your stall <a class="text-blue-500"
                            href="{{route('stall')}}">here.</a></h3>
                    <div id="inventory-container"
                        class="grid gap-4 xl:grid-cols-6 lg:grid-cols-5 md:grid-cols-3 sm:grid-cols-3 grid-cols-2"></div>
                </div>
            </div>

            <div id="transactions" class="tab-content hidden">
                {{-- Transacciones --}}
                <div class="bg-[#2A2D34] p-4 rounded-lg">
                    <h3 class="text-lg font-semibold mb-4">Transaction History</h3>
                    <div id="transactions-container" class="space-y-4">
                        <!-- Las transacciones se cargarán aqui -->
                        <div class="text-center py-8">
                            <div
                                class="animate-spin inline-block w-8 h-8 border-4 border-purple-500 border-t-transparent rounded-full">
                            </div>
                            <p class="mt-4 text-gray-400">Loading transactions...</p>
                        </div>
                    </div>
                </div>
            </div>

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

<!-- funcionalidad de cambiar de pestaña en el contenedor -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        //mete eventos a los botones de pestañas.
        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Obtener el ID del contenido a mostrar
                const tabId = button.getAttribute('data-tab');

                // quitar clases activas de todos los botones
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

                // Load transactions if that tab is selected
                if (tabId === 'transactions') {
                    fetchUserTransactions();
                }
            });
        });
    });

    // skins en venta
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

    // Funcion para pillar las transacciones del usuario
    async function fetchUserTransactions() {
        const container = document.getElementById('transactions-container');

        try {
            const response = await fetch(`/api/user/transactions`, {
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                credentials: 'include'
            });

            if (!response.ok) {
                throw new Error('Failed to fetch transactions');
            }

            const transactions = await response.json();

            if (transactions.length === 0) {
                container.innerHTML = `
                <div class="text-center py-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-300">No transactions yet</h3>
                    <p class="mt-1 text-gray-500">Your transaction history will appear here</p>
                </div>
            `;
                return;
            }

            container.innerHTML = transactions.map(transaction => `
            <div class="bg-gray-700 rounded-lg p-4">
                <div class="flex justify-between items-start">
                    <div class="flex items-center space-x-3">
                        <div class="bg-gray-600 p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ${transaction.status === 'completed' ? 'text-green-400' : 'text-yellow-400'}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                ${transaction.status === 'completed' ?
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />' :
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />'}
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-white">${transaction.status === 'completed' ? 'Completed' : 'Pending'}</h4>
                            <p class="text-sm text-gray-400">${new Date(transaction.created_at).toLocaleString()}</p>
                        </div>
                    </div>
                    <span class="text-lg font-bold ${transaction.status === 'completed' ? 'text-green-400' : 'text-yellow-400'}">
                        €${parseFloat(transaction.price).toFixed(2)}
                    </span>
                </div>
                <div class="mt-3 pt-3 border-t border-gray-600">
                    <div class="flex items-center space-x-2 bg-gray-800 p-2 rounded">
                        
                        <div class="truncate">
                            <p class="text-xs text-white truncate">${transaction.item_name}</p>
                        </div>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-t border-gray-600">
                    <p class="text-sm text-gray-400">Transaction ID: ${transaction.id}</p>
                </div>
            </div>
        `).join('');

        } catch (error) {
            console.error('Error fetching transactions:', error);
            container.innerHTML = `
            <div class="text-center py-8 text-red-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <p class="mt-4">Failed to load transactions. Please try again later.</p>
            </div>
        `;
        }
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
                throw new Error('Bad network response');
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
        console.log("User's dashboard loaded correctly");
        // cuando cargue la página se cargan las skins del usuario
        fetchUserItems();
    });
</script>