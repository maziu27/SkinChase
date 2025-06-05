let priceChart = null;

function createPriceChart(currentPrice) {
    const ctx = document.getElementById("priceChart").getContext("2d");

    // si en el modal hay un gráfico, lo destruye 
    if (priceChart) {
        priceChart.destroy();
    }

    //variables de datos y un seed que coge el precio actual para variarlo
    const labels = [];
    const data = [];
    const now = new Date();
    const seed = currentPrice * 12345;

    //simula el precio de la última semana con pequeñas variaciones
    for (let i = 6; i >= 0; i--) {
        const date = new Date(now);
        date.setDate(date.getDate() - i);
        labels.push(date.toLocaleDateString("en-UK", { weekday: "short" }));

        const randomFactor = Math.sin(seed + i * 100) * 0.15;
        const fluctuatedPrice = currentPrice * (1 + randomFactor);

        data.push(Number(fluctuatedPrice.toFixed(2)));
    }

    // crea el gráfico con los estilos
    priceChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Price (€)",
                    data: data,
                    borderColor: "rgb(34, 197, 94)",
                    backgroundColor: "rgba(34, 197, 94, 0.1)",
                    tension: 0.3,
                    fill: true,
                    pointRadius: 3,
                    pointHoverRadius: 5,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return "€" + context.parsed.y.toFixed(2);
                        },
                    },
                },
                legend: {
                    display: false,
                },
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                        color: "rgba(255, 255, 255, 0.1)",
                    },
                    ticks: {
                        color: "rgba(255, 255, 255, 0.7)",
                    },
                },
                y: {
                    min: Math.min(...data) * 0.95,
                    max: Math.max(...data) * 1.05,
                    grid: {
                        color: "rgba(255, 255, 255, 0.1)",
                    },
                    ticks: {
                        color: "rgba(255, 255, 255, 0.7)",
                        callback: function (value) {
                            return "€" + value.toFixed(2);
                        },
                    },
                },
            },
        },
    });
}
