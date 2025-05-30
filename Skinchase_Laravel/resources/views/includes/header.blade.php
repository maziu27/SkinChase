<header class="bg-gray-800 shadow-md py-4 px-6 flex justify-between items-center relative z-50">
    <!-- Logo + Nav -->
    <div class="flex items-center space-x-6">
        <a href="{{ route('home') }}" class="text-purple-400 hover:text-[#0095d9] font-bold text-xl">SkinChase</a>
        <nav class="hidden md:flex space-x-6">
            <a href="{{ route('market') }}"
                class="flex items-center gap-2 text-purple-400 hover:text-[#0095d9] font-bold text-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 9l1-4h16l1 4M4 9h16v10a1 1 0 01-1 1h-3a1 1 0 01-1-1v-4H9v4a1 1 0 01-1 1H5a1 1 0 01-1-1V9z" />
                </svg>
                Market
            </a>
        </nav>
    </div>

    <!-- Carrito + Perfil -->
    <div class="flex items-center gap-4 relative">
        <!-- Basket Wrapper + Button -->
        <div id="basket-wrapper" class="relative">
            <!-- Botón del carrito -->
            <button id="basket-toggle" class="relative text-purple-400 hover:text-[#0095d9]">
                <img src="{{ asset('images/basket.svg')}}" class="w-[40px] h-[40px] ">
                <span class="basket-count absolute top-0 right-0 bg-red-600 text-white text-xs px-2 rounded-full hidden">0</span>
            </button>

            <!-- Sidebar de la Cesta -->
            <div id="basket-sidebar"
                class="absolute right-0 mt-2 w-80 bg-[#1e1e1e] text-white rounded-md shadow-lg transform scale-95 opacity-0 pointer-events-none transition-all duration-300 z-50">
                <div class="flex justify-between items-center p-4 border-b border-gray-700">
                    <h2 class="text-xl font-semibold">Shopping cart</h2>
                    <button id="close-basket" class="text-gray-400 hover:text-red-500 text-xl">&times;</button>
                </div>
                <div id="basket-items" class="p-4 space-y-4 overflow-y-auto max-h-[80vh]">
                    <!-- Aquí se listarán los productos -->
                </div>
                <div class="p-4 border-t border-gray-700">
                    <button id="clear-basket" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded">Empty cart</button>
                </div>
                <div class="p-4 border-t border-gray-700">
                    <button id="checkout-all" class="w-full bg-lime-600 hover:bg-lime-900 text-white py-2 rounded">Checkout</button>
                </div>
            </div>
        </div>

        <!-- Dropdown Profile -->
        <div class="relative" id="dropdown-wrapper">
            <button id="profile-button" class="focus:outline-none">
                @if(Auth::check() && Auth::user()->profile_picture)
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="w-10 h-10 rounded-md">
                @else
                    <svg width="40" height="40" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="32" cy="20" r="12" fill="#C4C4C4" />
                        <path d="M16 52C16 43.1634 23.1634 36 32 36C40.8366 36 48 43.1634 48 52V56H16V52Z" fill="#C4C4C4" />
                    </svg>
                @endif
            </button>

            <!-- Dropdown Menu -->
            <div id="profile-dropdown"
                class="origin-top-right absolute right-0 mt-2 w-56 bg-gray-900 text-white rounded-md shadow-lg transform scale-95 opacity-0 transition-all duration-300 pointer-events-none z-50">
                <ul class="py-2 text-sm">
                    <li class="flex items-center px-4 py-2 hover:bg-gray-700 cursor-pointer">
                        <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M16 21v-2a4 4 0 00-8 0v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        <a href="{{ route('redirect') }}" class="text-white">Profile</a>
                    </li>
                    <li class="flex items-center px-4 py-2 hover:bg-gray-700 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9l1-4h16l1 4M4 9h16v10a1 1 0 01-1 1h-3a1 1 0 01-1-1v-4H9v4a1 1 0 01-1 1H5a1 1 0 01-1-1V9z" />
                        </svg>
                        <a href="{{ route('market') }}" class="text-white">Market</a>
                    </li>
                    <li class="flex items-center px-4 py-2 hover:bg-gray-700 cursor-pointer text-orange-400">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 12h18M3 12l6 6m-6-6l6-6" />
                        </svg>
                        <a href="#">Trades</a>
                    </li>
                    <li class="flex items-center px-4 py-2 hover:bg-gray-700 cursor-pointer text-yellow-400">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M5 13l4 4L19 7" />
                        </svg>
                        <a href="#">Sell items</a>
                    </li>
                    <li class="flex items-center px-4 py-2 hover:bg-gray-700 cursor-pointer text-yellow-300">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                        <a href="#">My stall</a>
                    </li>
                    <li class="flex items-center px-4 py-2 hover:bg-gray-700 cursor-pointer text-cyan-400">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <circle cx="12" cy="12" r="4" />
                        </svg>
                        Watchlist
                    </li>
                    <li class="flex items-center px-4 py-2 hover:bg-gray-700 cursor-pointer text-white">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M17 8h2a2 2 0 012 2v10a2 2 0 01-2 2h-2M7 8h10M7 8H5a2 2 0 00-2 2v10a2 2 0 002 2h2" />
                        </svg>
                        Support
                    </li>
                    <li class="flex items-center px-4 py-2 hover:bg-red-700 cursor-pointer text-red-500 border-t border-gray-700">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M17 16l4-4m0 0l-4-4m4 4H7" />
                        </svg>
                        <form method="POST" action="{{ route('logout') }}" class="text-red-500">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

<script>
    const profileBtn = document.getElementById('profile-button');
    const dropdown = document.getElementById('profile-dropdown');
    const wrapper = document.getElementById('dropdown-wrapper');

    const basketToggle = document.getElementById('basket-toggle');
    const basketSidebar = document.getElementById('basket-sidebar');
    const closeBasket = document.getElementById('close-basket');
    const basketWrapper = document.getElementById('basket-wrapper');

    function closeAllDropdowns() {
        // Cerrar el dropdown del perfil
        dropdown.classList.add('pointer-events-none', 'opacity-0', 'scale-95');
        // Cerrar el sidebar del carrito
        basketSidebar.classList.add('pointer-events-none', 'opacity-0', 'scale-95');
    }

    profileBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        const isOpen = !dropdown.classList.contains('pointer-events-none');
        closeAllDropdowns();
        if (!isOpen) {
            dropdown.classList.remove('pointer-events-none', 'opacity-0', 'scale-95');
        }
    });

    basketToggle.addEventListener('click', function (e) {
        e.stopPropagation();
        const isOpen = !basketSidebar.classList.contains('pointer-events-none');
        closeAllDropdowns();
        if (!isOpen) {
            basketSidebar.classList.remove('pointer-events-none', 'opacity-0', 'scale-95');
        }
    });

    closeBasket.addEventListener('click', function () {
        basketSidebar.classList.add('pointer-events-none', 'opacity-0', 'scale-95');
    });

    document.addEventListener('click', function (event) {
        if (!wrapper.contains(event.target) && !basketWrapper.contains(event.target)) {
            closeAllDropdowns();
        }
    });

    @auth
        console.log('{{ Auth::user()->name }} is logged in');
    @else
        console.log('No one is logged in');
    @endauth
</script>