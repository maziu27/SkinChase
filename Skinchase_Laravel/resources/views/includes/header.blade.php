<header class="bg-gray-800 shadow-md py-4 px-6 flex justify-between items-center relative z-50">
    <!-- Logo + Nav -->
    <div class="flex items-center space-x-6">
        <a href="{{ route('home') }}" class="text-purple-400 hover:text-purple-700 font-bold text-xl">SkinChase</a>
        <nav class="hidden md:flex space-x-6">
            <a href="{{ route('market') }}"
                class="flex items-center gap-2 text-purple-400 hover:text-purple-700 font-bold text-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 9l1-4h16l1 4M4 9h16v10a1 1 0 01-1 1h-3a1 1 0 01-1-1v-4H9v4a1 1 0 01-1 1H5a1 1 0 01-1-1V9z" />
                </svg>
                Market
            </a>

            <a href="{{route('inventory')}}"
                class="flex items-center gap-2 text-purple-400 hover:text-purple-700 font-bold text-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11.119 3.02c.584-.086 1.216.112 1.68.576l7.61 7.619c.761.761.798 1.969.075 2.692l-6.574 6.574c-.723.723-1.931.686-2.692-.075l-7.619-7.61c-.463-.464-.662-1.096-.576-1.68l.987-6.807c.023-.158.147-.282.305-.305l6.807-.987zM7.73 11.27a2.54 2.54 0 0 0 3.54 0 2.54 2.54 0 0 0 0-3.54 2.54 2.54 0 0 0-3.54 0 2.54 2.54 0 0 0 0 3.54z">
                    </path>
                </svg>
                Sell
            </a>
        </nav>
    </div>

    <!-- Carrito + Perfil -->
    <div class="flex items-center gap-4 relative">
        <!-- Basket Wrapper + Button -->
        <div id="basket-wrapper" class="relative">
            <!-- Botón del carrito -->
            <button id="basket-toggle" class="relative text-purple-400 hover:text-purple-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span
                    class="basket-count absolute top-0 right-0 bg-red-600 text-white text-xs px-2 rounded-full hidden">0</span>
            </button>

            @include('includes.basket-side')

            <!-- Dropdown Profile -->
            <div class="relative" id="dropdown-wrapper">
                <button id="profile-button" class="focus:outline-none">
                    @if(Auth::check() && Auth::user()->profile_picture)
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="w-10 h-10 rounded-md">
                    @else
                        <svg class="text-purple-400" width="40" height="40" viewBox="0 0 64 64" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="32" cy="20" r="12" fill="#C4C4C4" />
                            <path d="M16 52C16 43.1634 23.1634 36 32 36C40.8366 36 48 43.1634 48 52V56H16V52Z"
                                fill="#C4C4C4" />
                        </svg>
                    @endif
                </button>

                @include('includes.user-dropdown')
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