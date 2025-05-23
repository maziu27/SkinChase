 <div id="product-modal" class="fixed inset-0 z-50 bg-black bg-opacity-70 hidden justify-center items-center"
            onclick="closeModalOnBackdrop(event)">
            <div class="bg-[#1A1D24] rounded-xl p-8 w-[95%] max-w-5xl text-white flex flex-col items-center relative"
                onclick="event.stopPropagation()">
                <!-- Título y detalles -->
                <div class="text-center mb-6">
                    <h3 class="text-2xl font-bold" id="modal-name">Nombre del producto</h3>
                    <p id="modal-float" class="text-gray-300 mt-1">Float: 0.0000</p>
                    <p id="modal-price" class="text-green-400 font-bold text-xl mt-1">€0.00</p>
                </div>

                <!-- Imagen -->
                <img id="modal-image" src="" alt="Product" class="w-96 h-96 object-contain mb-6">

                <!-- Botones -->
                <div class="flex gap-4">
                    <button class="bg-blue-600 hover:bg-blue-700 px-5 py-3 rounded">Add to Cart</button>
                    <button class="buy-now bg-green-600 hover:bg-green-700 px-5 py-3 rounded">Buy Now</button>
                </div>

                <!-- Botón cerrar -->
                <button onclick="closeModal()" class="mt-6 bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white">
                    Close
                </button>
            </div>
        </div>