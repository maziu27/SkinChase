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
            {{--
            <a href="#" class="flex items-center gap-2 text-purple-400 hover:text-[#0095d9] font-bold text-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M12 6a6 6 0 110 12 6 6 0 010-12z" />
                </svg>
                Tools
            </a>--}}
            {{--
            <a href="#" class="flex items-center gap-2 text-purple-400 hover:text-[#0095d9] font-bold text-xl">
                {{--<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                App
            </a>
            <a href="{{ route('test') }}"
                class="flex items-center gap-2 text-purple-400 hover:text-[#0095d9] font-bold text-xl">
                {{--<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16" />
                </svg>
                TESTING
            </a>--}}
        </nav>
    </div>

    <!-- Dropdown Profile -->
    <div class="relative" id="dropdown-wrapper">
        <button id="profile-button" class="focus:outline-none">
            @if(Auth::check() && Auth::user()->profile_picture)
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="w-10 h-10 rounded-md">
            @else
                <svg width="40" height="40" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
  <circle cx="32" cy="20" r="12" fill="#C4C4C4"/>
  <path d="M16 52C16 43.1634 23.1634 36 32 36C40.8366 36 48 43.1634 48 52V56H16V52Z" fill="#C4C4C4"/>
</svg>
            @endif
        </button>

        @include('includes.basket-side')
        
        <!-- Dropdown Menu -->
        <div id="profile-dropdown"
            class="origin-top-right absolute right-0 mt-2 w-56 bg-gray-900 text-white rounded-md shadow-lg transform scale-95 opacity-0 transition-all duration-300 pointer-events-none z-50">
            <ul class="py-2 text-sm">
                <li class="flex items-center px-4 py-2 hover:bg-gray-700 cursor-pointer">
                    <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M16 21v-2a4 4 0 00-8 0v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                    <a href="{{ route('redirect') }}" class="text-white">Profile</a>
                </li>
                <li class="flex items-center px-4 py-2 hover:bg-gray-700 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 9l1-4h16l1 4M4 9h16v10a1 1 0 01-1 1h-3a1 1 0 01-1-1v-4H9v4a1 1 0 01-1 1H5a1 1 0 01-1-1V9z" />
                    </svg>
                    <a href="{{ route('market') }}" class="text-white">Market</a>
                </li>
                <li class="flex items-center px-4 py-2 hover:bg-gray-700 cursor-pointer text-green-400">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 19V6m0 0l-6 6m6-6l6 6" />
                    </svg>
                    <a href="#">Deposit</a>
                </li>
                <li class="flex items-center px-4 py-2 hover:bg-gray-700 cursor-pointer text-blue-400">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 5v13m0 0l6-6m-6 6l-6-6" />
                    </svg>
                    <a href="#">Withdraw</a>
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
                <li class="flex items-center px-4 py-2 hover:bg-gray-700 cursor-pointer text-purple-400">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 5v14m0 0l6-6m-6 6l-6-6" />
                    </svg>
                    <a href="#">Offers</a>
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

                <li
                    class="flex items-center px-4 py-2 hover:bg-red-700 cursor-pointer text-red-500 border-t border-gray-700">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 16l4-4m0 0l-4-4m4 4H7" />
                    </svg>
                    <form method="POST" action="{{ route('logout') }}" class="text-red-500">
                        @csrf
                        <button type="submit">
                            Logout
                        </button>

                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>

<!-- Script para el dropdown -->
<script>
    const profileBtn = document.getElementById('profile-button');
    const dropdown = document.getElementById('profile-dropdown');
    const wrapper = document.getElementById('dropdown-wrapper');

    profileBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        dropdown.classList.toggle('pointer-events-none');
        dropdown.classList.toggle('opacity-0');
        dropdown.classList.toggle('scale-95');
    });

    document.addEventListener('click', function (event) {
        if (!wrapper.contains(event.target)) {
            dropdown.classList.add('pointer-events-none', 'opacity-0', 'scale-95');
        }
    });



    @auth
        console.log('{{ Auth::user()->name }} is logged in');
    @else
        console.log('No one is logged in');
    @endauth
</script>