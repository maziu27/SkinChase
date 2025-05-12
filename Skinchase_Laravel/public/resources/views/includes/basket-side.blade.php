<!-- Sidebar de la Cesta -->
<div id="basket-sidebar"
    class="fixed top-0 right-0 w-80 h-full bg-[#1e1e1e] text-white shadow-lg transform translate-x-full transition-transform duration-300 z-50">
    <div class="flex justify-between items-center p-4 border-b border-gray-700">
        <h2 class="text-xl font-semibold">Shopping cart</h2>
        <button id="close-basket" class="text-gray-400 hover:text-red-500 text-xl">&times;</button>
    </div>
    <div id="basket-items" class="p-4 space-y-4 overflow-y-auto max-h-[80vh]">
        <!-- Aquí se listarán los productos -->
    </div>
    <div class="p-4 border-t border-gray-700">
        <button id="clear-basket" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded">Empty cart</button>
    </div>

    <!-- checkout boton -->
    <!-- checkout botón (pago múltiple) -->
    <div class="p-4 border-t border-gray-700">
        <button id="checkout-all"
            class="w-full bg-lime-600 hover:bg-lime-900 text-white py-2 rounded">
            Checkout
        </button>
    </div>
</div>