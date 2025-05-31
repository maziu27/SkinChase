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

                <div class="p-4 border-t border-gray-700 flex justify-between items-center">
                    <span class="text-lg font-medium">Total:</span>
                    <span id="basket-total" class="text-lg font-bold">$0.00</span>
                </div>

                <div class="p-4 border-t border-gray-700">
                    <button id="checkout-all" class="w-full bg-lime-600 hover:bg-lime-900 text-white py-2 rounded">Checkout</button>
                </div>

                <div class="p-4 border-t border-gray-700">
                    <button id="clear-basket" class="w-full bg-red-500 hover:bg-red-700 text-white py-2 rounded">Empty cart</button>
                </div>
                
            </div>
        </div>