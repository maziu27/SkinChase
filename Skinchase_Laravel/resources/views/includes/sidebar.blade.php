<aside id="sidebar"
                class="bg-[#1e1e1e] p-5 w-full md:w-[250px] rounded-[10px] transition-all duration-300 ease-in-out max-h-[calc(29vh-2rem)] overflow-y-auto">
                <form id="filter-form" class="space-y-4">
                    @csrf

                    <!-- Inputs -->
                    <div class="space-y-2">
                        <input type="text" placeholder="Search for items" name="name"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-blue-500">
                        <input type="number" placeholder="Price from" name="priceFrom"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                        <input type="number" placeholder="Price to" name="priceTo"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                    </div>
                
                    <!-- input oculto -->
                    <input type="hidden" name="sort_by" id="sort-by">

                    <input type="submit" value="Filter"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded cursor-pointer">
                </form>
            </aside>