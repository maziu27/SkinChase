<!-- Header -->
<div class="flex justify-between items-center bg-gray-800 text-white p-4">
    <div class="flex items-center gap-4">
        <a href="{{ route('home') }}">
            <span class="text-xl font-bold text-purple-400">SkinChase</span>
        </a>
        <a href="{{ route('market') }}" class="text-white hover:text-purple-400">Market</a>
        <a href="#" class="text-white hover:text-purple-400">Tools</a>
        <a href="#" class="text-white hover:text-purple-400">App</a>
    </div>

    <div class="flex items-center gap-4 ml-auto">
        <span class="bg-gray-700 px-3 py-1 rounded">n/a EUR</span>

        <div class="relative">
            <button class="bg-gray-700 text-white px-3 py-1 rounded">Currency</button>
            <div class="absolute hidden bg-gray-100 text-black mt-1 w-32 shadow-md">
                <a href="#" class="block px-4 py-2 hover:bg-gray-300">EUR</a>
                <a href="#" class="block px-4 py-2 hover:bg-gray-300">USD</a>
                <a href="#" class="block px-4 py-2 hover:bg-gray-300">CNY</a>
                <a href="#" class="block px-4 py-2 hover:bg-gray-300">JPY</a>
            </div>
        </div>

        <div class="relative">
        <button id="basket-toggle" class="text-white hover:text-purple-400 focus:outline-none relative">
            <i class="fas fa-shopping-basket text-xl"></i>
            <!-- El contador se inserta aquí por JS -->
        </button>
        </div>

        <div class="relative">
            <a href="https://steamcommunity.com/id/penisfight">
                <img src="https://avatars.fastly.steamstatic.com/1792a5b9ef50f593698f3a5e6a9dad56c86b3b23_full.jpg" class="w-10 rounded-md">
            </a>
            <div class="absolute hidden bg-gray-100 text-black mt-1 w-40 shadow-md">
                <a href="#" class="block px-4 py-2 hover:bg-gray-300">Deposit</a>
                <a href="#" class="block px-4 py-2 hover:bg-gray-300">Withdraw</a>
                <a href="#" class="block px-4 py-2 hover:bg-gray-300">Inventory</a>
                <a href="#" class="block px-4 py-2 hover:bg-gray-300">Stall</a>
                <a href="#" class="block px-4 py-2 hover:bg-gray-300">Support</a>
            </div>
        </div>
    </div>
</div>