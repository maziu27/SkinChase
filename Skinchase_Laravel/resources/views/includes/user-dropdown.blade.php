<!-- Dropdown Menu -->
<div id="profile-dropdown"
    class="origin-top-right absolute right-0 mt-2 w-56 bg-gray-900 text-white rounded-md shadow-lg transform scale-95 opacity-0 transition-all duration-300 pointer-events-none z-50">
    <ul class="py-2 text-sm">
        <li class="flex items-center px-4 py-2 hover:bg-gray-700 cursor-pointer text-blue-400 hover:text-blue-300">
            <svg class="w-5 h-5 mr-3 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M16 21v-2a4 4 0 00-8 0v2" />
                <circle cx="12" cy="7" r="4" />
            </svg>
            <a href="{{ route('redirect') }}" class="text-blue-400 hover:text-blue-300">Profile</a>
        </li>
        <li class="flex items-center px-4 py-2 hover:bg-gray-700 cursor-pointer text-green-400 hover:text-green-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3 text-green-400" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 9l1-4h16l1 4M4 9h16v10a1 1 0 01-1 1h-3a1 1 0 01-1-1v-4H9v4a1 1 0 01-1 1H5a1 1 0 01-1-1V9z" />
            </svg>
            <a href="{{ route('market') }}" class="text-green-400 hover:text-green-300">Market</a>
        </li>
        <li class="flex items-center px-4 py-2 hover:bg-gray-700 cursor-pointer text-purple-400 hover:text-purple-300">
            <svg class="w-5 h-5 mr-2 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11.119 3.02c.584-.086 1.216.112 1.68.576l7.61 7.619c.761.761.798 1.969.075 2.692l-6.574 6.574c-.723.723-1.931.686-2.692-.075l-7.619-7.61c-.463-.464-.662-1.096-.576-1.68l.987-6.807c.023-.158.147-.282.305-.305l6.807-.987zM7.73 11.27a2.54 2.54 0 0 0 3.54 0 2.54 2.54 0 0 0 0-3.54 2.54 2.54 0 0 0-3.54 0 2.54 2.54 0 0 0 0 3.54z">
                </path>
            </svg>
            <a href="inventory" class="text-purple-400 hover:text-purple-300">Sell items</a>
        </li>
        <li class="flex items-center px-4 py-2 hover:bg-gray-700 cursor-pointer text-yellow-400 hover:text-yellow-300">
            <svg class="w-5 h-5 mr-3 text-yellow-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M4 6h16M4 10h16M4 14h16M4 18h16" />
            </svg>
            <a href="stall" class="text-yellow-400 hover:text-yellow-300">My stall</a>
        </li>
        <li class="flex items-center px-4 py-2 hover:bg-red-700 cursor-pointer text-red-400 hover:text-red-300 border-t border-gray-700">
            <svg class="w-5 h-5 mr-3 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M17 16l4-4m0 0l-4-4m4 4H7" />
            </svg>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-400 hover:text-red-300">Logout</button>
            </form>
        </li>
    </ul>
</div>