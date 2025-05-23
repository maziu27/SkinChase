<aside id="sidebar"
                class="bg-[#1e1e1e] p-5 w-full md:w-[250px] rounded-[10px] transition-all duration-300 ease-in-out max-h-[calc(75vh-2rem)] overflow-y-auto">
                <form id="filter-form" class="space-y-4">
                    @csrf

                    <!-- Inputs -->
                    <div class="space-y-2">
                        <input type="text" placeholder="Search for items" name="name"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-blue-500">
                        <input type="number" step="any" placeholder="Float from" name="floatFrom"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                        <input type="number" step="any" placeholder="Float to" name="floatTo"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                        <input type="number" placeholder="Price from" name="priceFrom"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                        <input type="number" placeholder="Price to" name="priceTo"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                    </div>

                    <h3 class="text-lg font-semibold">Special</h3>
                    <div class="space-y-2">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="StatTrak" value="1" class="form-checkbox text-blue-500">
                            <span>StatTrak</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="Souvenir" value="1" class="form-checkbox text-blue-500">
                            <span>Souvenir</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="Normal" value="1" class="form-checkbox text-blue-500">
                            <span>Normal</span>
                        </label>
                    </div>

                    <div class="space-y-2">
                        <input type="text" placeholder="Sticker Slot 1" name="sticker1"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                        <input type="text" placeholder="Sticker Slot 2" name="sticker2"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                        <input type="text" placeholder="Sticker Slot 3" name="sticker3"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                        <input type="text" placeholder="Sticker Slot 4" name="sticker4"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                        <input type="text" placeholder="Sticker Slot 5" name="sticker5"
                            class="w-full p-2 rounded bg-gray-700 border border-gray-600">
                    </div>

                    <!-- input oculto -->
                    <input type="hidden" name="sort_by" id="sort-by">

                    <input type="submit" value="Filtrar"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded cursor-pointer">
                </form>
            </aside>