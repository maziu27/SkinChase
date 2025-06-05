<aside id="sidebar"
    class="p-6 w-full md:w-[280px] rounded-xl bg-gray-800/95 backdrop-blur-sm border border-gray-700 shadow-lg transition-all duration-200 ease-out">
    <form id="filter-form" class="space-y-5">
        @csrf

        <!-- Search Input -->
        <div class="relative">
            <svg class="absolute left-3 top-3 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="text" placeholder="Search for items" name="name"
                class="w-full pl-10 pr-4 py-2.5 rounded-lg bg-gray-700/80 border border-gray-600/50 focus:bg-gray-700 focus:ring-2 focus:ring-blue-500/60 focus:border-blue-500 text-white placeholder-gray-400 transition-all duration-200">
        </div>

        <!-- Price Range -->
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium text-gray-300">Price Range</span>
                <span class="text-xs text-gray-500">(EUR)</span>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div class="relative">
                    <input type="number" placeholder="From" name="priceFrom"
                        class="w-full px-3 py-2 rounded-lg bg-gray-700/80 border border-gray-600/50 focus:bg-gray-700 focus:ring-2 focus:ring-blue-500/60 focus:border-blue-500 text-white placeholder-gray-500 transition-all duration-200">
                </div>
                <div class="relative">
                    <input type="number" placeholder="To" name="priceTo"
                        class="w-full px-3 py-2 rounded-lg bg-gray-700/80 border border-gray-600/50 focus:bg-gray-700 focus:ring-2 focus:ring-blue-500/60 focus:border-blue-500 text-white placeholder-gray-500 transition-all duration-200">
                </div>
            </div>
        </div>

        <!-- Hidden Sort Input -->
        <input type="hidden" name="sort_by" id="sort-by">

        <!-- Submit Button -->
        <button type="submit"
            class="w-full bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-medium py-2.5 px-4 rounded-lg shadow hover:shadow-md transition-all duration-300 flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
            </svg>
            Filter
        </button>
    </form>
</aside>