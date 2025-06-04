@extends('layouts.app')

@section('title', 'Market | SkinChase')

@section('content')
    <div class="flex flex-col bg-gray-900 text-white">
        @include('includes.market-buttons')
    </div>

    <main class="flex-1 overflow-y-auto p-4">
        <div class="flex flex-col md:flex-row gap-4">
            @include('includes.sidebar')

            <div id="contenedor-productos" class="flex-1 grid gap-4 xl:grid-cols-6 lg:grid-cols-5 md:grid-cols-3 sm:grid-cols-3 grid-cols-2 overflow-hidden">
            </div>
        </div>
        
        @include('includes.basket')
        
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
                    <button id="modal-add-to-basket" class="js-add-to-basket flex-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-md text-sm transition">
                        Add to basket
                    </button>
                    <button id="modal-buy-now" class="buy-now flex-1 bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-md text-sm transition">
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
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/market.js') }}"></script>
    <script>
        let priceChart = null;

        function openModal(item) {
            document.getElementById('modal-name').innerText = item.name;
            document.getElementById('modal-float').innerText =
                item.name.includes("Package")
                    ? "Container"
                    : item.float_value !== null
                    ? `Float: ${item.float_value}`
                    : "Sticker";
            document.getElementById('modal-price').innerText = '€' + Number(item.price).toFixed(2);
            document.getElementById('modal-image').src = `https://steamcommunity-a.akamaihd.net/economy/image/${item.icon_url}`;

            const addToBasketBtn = document.getElementById('modal-add-to-basket');
            const buyNowBtn = document.getElementById('modal-buy-now');

            const product = {
                id: item.asset_id,
                name: item.name,
                price: (item.price / 1).toFixed(2),
                image: item.icon_url
            };

            const newAddToBasket = addToBasketBtn.cloneNode(true);
            addToBasketBtn.parentNode.replaceChild(newAddToBasket, addToBasketBtn);
            newAddToBasket.addEventListener('click', () => {
                let basket = JSON.parse(localStorage.getItem("basket")) || [];
                if (!basket.some(p => p.id === product.id)) {
                    basket.push(product);
                    localStorage.setItem("basket", JSON.stringify(basket));
                    document.querySelector(".basket-count").textContent = basket.length;
                } else {
                    alert(`${product.name} is already in your basket.`);
                }
            });

            const newBuyNow = buyNowBtn.cloneNode(true);
            buyNowBtn.parentNode.replaceChild(newBuyNow, buyNowBtn);
            newBuyNow.addEventListener('click', () => {
                fetch("/create-stripe-link", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                    body: JSON.stringify({ items: [product] }),
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.url) {
                            window.location.href = data.url;
                        } else {
                            alert("Payment link failed.");
                        }
                    })
                    .catch(() => alert("Error connecting to server."));
            });

            createPriceChart(item.price);

            const modal = document.getElementById('product-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function createPriceChart(currentPrice) {
            const ctx = document.getElementById('priceChart').getContext('2d');
            
            if (priceChart) {
                priceChart.destroy();
            }
            
            const labels = [];
            const data = [];
            const now = new Date();
            
            const seed = currentPrice * 12345; 
            
            for (let i = 6; i >= 0; i--) {
                const date = new Date(now);
                date.setDate(date.getDate() - i);
                labels.push(date.toLocaleDateString('en-UK', { weekday: 'short' }));
                
                const randomFactor = Math.sin(seed + i * 100) * 0.15; 
                const fluctuatedPrice = currentPrice * (1 + randomFactor);
                
                data.push(Number(fluctuatedPrice.toFixed(2)));
            }
            
            priceChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Price (€)',
                        data: data,
                        borderColor: 'rgb(34, 197, 94)',
                        backgroundColor: 'rgba(34, 197, 94, 0.1)',
                        tension: 0.3, // Línea más suave
                        fill: true,
                        pointRadius: 3,
                        pointHoverRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return '€' + context.parsed.y.toFixed(2);
                                }
                            }
                        },
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false,
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: 'rgba(255, 255, 255, 0.7)'
                            }
                        },
                        y: {
                            min: Math.min(...data) * 0.95, 
                            max: Math.max(...data) * 1.05, 
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: 'rgba(255, 255, 255, 0.7)',
                                callback: function(value) {
                                    return '€' + value.toFixed(2);
                                }
                            }
                        }
                    }
                }
            });
        }

        function closeModal() {
            if (priceChart) {
                priceChart.destroy();
                priceChart = null;
            }
            const modal = document.getElementById('product-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function closeModalOnBackdrop(event) {
            if (event.target.id === 'product-modal') {
                closeModal();
            }
        }
    </script>
@endsection