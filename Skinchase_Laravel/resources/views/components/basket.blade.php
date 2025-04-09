<!-- resources/views/components/basket.blade.php -->
<div id="basket" class="fixed top-[72px] right-0 w-64 bg-gray-900 shadow-lg p-4 z-50 overflow-y-auto h-[calc(100vh-72px)] hidden md:block">
    <h2 class="text-xl font-bold mb-4">Your Basket</h2>
    <div id="basket-items" class="space-y-4"></div>
    <div class="mt-4 border-t pt-2">
        <p class="text-lg font-semibold">Total: <span id="basket-total">0.00</span> EUR</p>
        <form method="POST" > <!--falta route checkout -->
            @csrf
            <input type="hidden" name="basket_data" id="basket-data">
            <button type="submit" class="mt-4 w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                Checkout
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const basket = JSON.parse(localStorage.getItem('basket')) || [];

    function updateBasketUI() {
        const basketContainer = document.getElementById('basket-items');
        const basketTotal = document.getElementById('basket-total');
        const basketInput = document.getElementById('basket-data');

        basketContainer.innerHTML = '';
        let total = 0;

        basket.forEach((item, index) => {
            const div = document.createElement('div');
            div.classList.add('bg-gray-500', 'p-2', 'rounded');

            div.innerHTML = `
                <img src="${item.image}" class="w-full h-32 object-contain mb-2 rounded" alt="${item.name}">
                <p class="text-sm font-semibold">${item.name}</p>
                <p class="text-sm">Float: ${parseFloat(item.float).toFixed(5)}</p>
                <p class="text-sm">Price: ${item.price} EUR</p>
                <button class="text-red-600 text-sm mt-2 remove-item" data-index="${index}">Remove</button>
            `;

            basketContainer.appendChild(div);
            total += parseFloat(item.price);
        });

        basketTotal.textContent = total.toFixed(2);
        if (basketInput) {
            basketInput.value = JSON.stringify(basket);
        }

        document.querySelectorAll('.remove-item').forEach(btn => {
            btn.addEventListener('click', function () {
                const index = parseInt(this.dataset.index);
                basket.splice(index, 1);
                localStorage.setItem('basket', JSON.stringify(basket));
                updateBasketUI();
            });
        });
    }

    updateBasketUI();

    document.body.addEventListener('click', function (e) {
        if (e.target.classList.contains('add-to-basket')) {
            const data = e.target.dataset;
            const item = {
                asset_id: data.assetId,
                name: data.name,
                price: data.price,
                float: data.float,
                image: data.image
            };
            basket.push(item);
            localStorage.setItem('basket', JSON.stringify(basket));
            updateBasketUI();
        }
    });
});
</script>

