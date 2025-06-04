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
                        tension: 0.3,
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