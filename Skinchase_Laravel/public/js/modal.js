
//funcion que abre el modal
function openModal(item) {
    //muestra las variables del item
    document.getElementById("modal-name").innerText = item.name;
    document.getElementById("modal-float").innerText =
        //si el item tiene el nombre package se le asigna container y si el float no es nulo
        //se le asigna el valor que corresponde
        item.name.includes("Package")
            ? "Container"
            : item.float_value !== null
            ? `Float: ${item.float_value}`
            : "Sticker";
    document.getElementById("modal-price").innerText =
        "€" + Number(item.price).toFixed(2);
    document.getElementById(
        "modal-image"
    ).src = `https://steamcommunity-a.akamaihd.net/economy/image/${item.icon_url}`;

    // coge los botones de includes(modal.blade.php)
    const addToBasketBtn = document.getElementById("modal-add-to-basket");
    const buyNowBtn = document.getElementById("modal-buy-now");

    // agrega el item a una constante
    const product = {
        id: item.asset_id,
        name: item.name,
        price: (item.price / 1).toFixed(2),
        image: item.icon_url,
    };

    //clona el botón para eliminar listeners anteriores
    const newAddToBasket = addToBasketBtn.cloneNode(true);
    addToBasketBtn.parentNode.replaceChild(newAddToBasket, addToBasketBtn);
    newAddToBasket.addEventListener("click", () => {
        let basket = JSON.parse(localStorage.getItem("basket")) || [];
        if (!basket.some((p) => p.id === product.id)) {
            basket.push(product);
            localStorage.setItem("basket", JSON.stringify(basket));
            document.querySelector(".basket-count").textContent = basket.length;
        } else {
            alert(`${product.name} is already in your basket.`);
        }
    });

    //igual que el anterior se clona para evitar listeners duplicados
    const newBuyNow = buyNowBtn.cloneNode(true);
    buyNowBtn.parentNode.replaceChild(newBuyNow, buyNowBtn);
    newBuyNow.addEventListener("click", () => {
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
            .then((res) => res.json())
            .then((data) => {
                if (data.url) {
                    window.location.href = data.url;
                } else {
                    alert("Payment link failed.");
                }
            })
            .catch(() => alert("Error connecting to server."));
    });

    // llama a la función para crear el gráfico
    createPriceChart(item.price);

    //quita las clases hidden para que salga visible.
    const modal = document.getElementById("product-modal");
    modal.classList.remove("hidden");
    modal.classList.add("flex");
}

// cierra el modal y destruye el gráfico
function closeModal() {
    if (priceChart) {
        priceChart.destroy();
        priceChart = null;
    }
    const modal = document.getElementById("product-modal");
    modal.classList.add("hidden");
    modal.classList.remove("flex");
}

//si hace clic fuera del modal se cierra
function closeModalOnBackdrop(event) {
    if (event.target.id === "product-modal") {
        closeModal();
    }
}