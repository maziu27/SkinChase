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

            @include('includes.basket-side')

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