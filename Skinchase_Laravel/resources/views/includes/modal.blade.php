<!-- Modal de producto -->
<div id="product-modal" class="fixed inset-0 z-50 bg-black bg-opacity-70 hidden justify-center items-center p-2 sm:p-4"
    onclick="closeModalOnBackdrop(event)">
    <div class="bg-[#1A1D24] rounded-xl p-4 sm:p-8 w-full max-w-5xl max-h-[90vh] overflow-y-auto text-white flex flex-col items-center relative"
        onclick="event.stopPropagation()">
        <div class="text-center mb-4 sm:mb-6 w-full">
            <h3 class="text-xl sm:text-2xl font-bold" id="modal-name">Product Name</h3>
            <p id="modal-float" class="text-gray-300 text-sm sm:text-base mt-1">Float: 0.0000</p>
            <p id="modal-price" class="text-green-400 font-bold text-lg sm:text-xl mt-1">€0.00</p>
        </div>

        <div class="w-full flex justify-center">
            <img id="modal-image" src="" alt="Product"
                class="w-48 h-48 sm:w-64 sm:h-64 md:w-80 md:h-80 lg:w-96 lg:h-96 object-contain mb-4 sm:mb-6 transition-transform duration-300 ease-in-out md:hover:scale-150">
        </div>

        <div class="flex gap-4 w-full px-2 sm:px-0">
            <button id="modal-add-to-basket"
                class="js-add-to-basket flex-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-md text-sm transition">
                Add to basket
            </button>
            <button id="modal-buy-now"
                class="buy-now flex-1 bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-md text-sm transition">
                Buy now
            </button>
        </div>

        <button onclick="closeModal()" class="mt-6 md:hidden bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white">
            Close
        </button>

        <div class="w-full mt-4 h-48 sm:h-64">
            <canvas id="priceChart"></canvas>
        </div>
    </div>
</div>