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
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 9l1-4h16l1 4M4 9h16v10a1 1 0 01-1 1h-3a1 1 0 01-1-1v-4H9v4a1 1 0 01-1 1H5a1 1 0 01-1-1V9z" />
            </svg>
            <a href="{{ route('market') }}" class="text-white">Market</a>
        </li>
        <li class="flex items-center px-4 py-2 hover:bg-gray-700 cursor-pointer text-yellow-400">
            <img src="{{ asset('images/sale-tag.svg')}}" class=" w-5 h-5 mr-3">

            </img>
            <a href="inventory">Sell items</a>
        </li>
        <li class="flex items-center px-4 py-2 hover:bg-gray-700 cursor-pointer text-orange-400">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M3 12h18M3 12l6 6m-6-6l6-6" />
            </svg>
            <a href="#">Trades</a>
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