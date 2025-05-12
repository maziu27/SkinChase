<!-- resources/views/components/basket.blade.php -->

{{-- <div id="basket" class="fixed top-[72px] right-0 w-64 bg-gray-900 shadow-lg p-4 z-50 overflow-y-auto h-[calc(100vh-72px)] hidden">
    <h2 class="text-xl font-bold mb-4">Your Basket</h2>
    <div id="basket-items" class="space-y-4"></div>
    <div class="mt-4 border-t pt-2">
        <p class="text-lg font-semibold">Total: <span id="basket-total">0.00</span> EUR</p>
        <form method="POST" action="{{ route('checkout') }}">
            @csrf
            <input type="hidden" name="basket_data" id="basket-data">
            <button type="submit" class="mt-4 w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                Checkout
            </button>
            <button class="buy-now mt-2 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
                    data-id="${item.asset_id}"
                    data-name="${item.market_hash_name}"
                    data-price="${(product.price / 100).toFixed(2)}"
                    data-image="${item.icon_url}">
                    Checkout
            </button>
        </form>
    </div>
</div>
 --}}
