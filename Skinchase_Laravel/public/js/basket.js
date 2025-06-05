document.addEventListener("DOMContentLoaded", () => {
    //elementos del carrito
    const basketToggle = document.getElementById("basket-toggle");
    const clearBasketButton = document.getElementById("clear-basket");
    const closeBasket = document.getElementById("close-basket");

    //si se toglea el carrito se muestra
    if (basketToggle) {
        basketToggle.addEventListener("click", () => {
            const sidebar = document.getElementById("basket-sidebar");
            sidebar.classList.remove("translate-x-full");
            sidebar.classList.add("translate-x-0");
            renderBasketItems(); //renderiza los objetos
        });
    }
    // si se cierra... se cierra :v
    if (closeBasket) {
        closeBasket.addEventListener("click", () => {
            const sidebar = document.getElementById("basket-sidebar");
            sidebar.classList.remove("translate-x-0");
            sidebar.classList.add("translate-x-full");
        });
    }

    //vacia el carrito
    if (clearBasketButton) {
        clearBasketButton.addEventListener("click", () => {
            if (confirm("Do you really want to empty your basket?")) {
                localStorage.removeItem("basket");
                updateBasketCount();
                renderBasketItems();
            }
        });
    }

    //agrega los items al carrito
    function addToBasket(product) {
        let basket = getBasket();
        //si el item no esta se agrega
        if (!basket.some((item) => item.id === product.id)) {
            basket.push(product);
            localStorage.setItem("basket", JSON.stringify(basket));
            updateBasketCount();
        } else {
            //si el item esta en el carro ERROR malisimo y grave extremo
            alert(`${product.name} is already in your basket.`);
        }
    }

    //funcion que retorna el basket desde localStorage
    function getBasket() {
        return JSON.parse(localStorage.getItem("basket")) || [];
    }

    // actualiza el contador del carrito
    function updateBasketCount() {
        const basket = getBasket();
        const count = basket.length;
        let countBadge = basketToggle.querySelector(".basket-count");
        //si el contador no existe lo crea como dios manda
        if (!countBadge) {
            countBadge = document.createElement("span");
            countBadge.className =
                "basket-count absolute top-0 right-0 bg-red-600 text-white text-xs px-2 rounded-full";
            basketToggle.appendChild(countBadge);
        }
        //contenido del texto es el contador
        countBadge.textContent = count;
        countBadge.classList.toggle("hidden", count === 0);
    }

    //renderiza los items en el carrito
    function renderBasketItems() {
        const basket = getBasket();
        const container = document.getElementById("basket-items");
        container.innerHTML = "";
    
        //si no hay nada en el carrito está vacio.
        if (basket.length === 0) {
            container.innerHTML =
                '<p class="text-gray-400">Your basket is empty.</p>';
            document.getElementById("basket-total").textContent = "€0.00";
            return;
        }
    
        let total = 0;
    
        // crea elementos para cada item en el carrito
        basket.forEach((item) => {
            const div = document.createElement("div");
            div.className =
                "flex items-center justify-between bg-gray-800 p-2 rounded";
            div.innerHTML = `
                <img src="https://steamcommunity-a.akamaihd.net/economy/image/${item.image}" alt="${item.name}" class="w-12 h-12 rounded object-cover mr-2">
                <div class="flex-1">
                    <p class="text-sm font-semibold">${item.name}</p>
                    <p class="text-sm text-gray-400">${item.price} EUR</p>
                </div>
                <button class="remove-item text-red-500 hover:text-red-700 text-lg font-bold" data-id="${item.id}">&times;</button>
            `;
            container.appendChild(div);
    
            // suma el total del precio de los items
            total += parseFloat(item.price);
        });
    
        //actualiza el total del preico
        document.getElementById("basket-total").textContent = `€${total.toFixed(2)}`;
    
        // llamada a la funcion que borra items del carrito
        document.querySelectorAll(".remove-item").forEach((btn) => {
            btn.addEventListener("click", () => {
                const id = btn.getAttribute("data-id");
                removeFromBasket(id);
            });
        });
    }

    // funcion que borra items del carrito a través del ID
    function removeFromBasket(id) {
        let basket = getBasket();
        basket = basket.filter((item) => item.id !== id);
        localStorage.setItem("basket", JSON.stringify(basket));
        updateBasketCount();
        renderBasketItems();
    }

    // Llamar contador al cargar la página
    updateBasketCount();

    // Escuchar clics en los botones js-add-to-basket
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("js-add-to-basket")) {
            const btn = e.target;
            const product = {
                id: btn.dataset.id,
                name: btn.dataset.name,
                price: btn.dataset.price,
                image: btn.dataset.image,
            };
            addToBasket(product);
        }
    });

    // Botón checkout-all para pagar todos los productos en la cesta
    const checkoutAll = document.getElementById("checkout-all");
    if (checkoutAll) {
        checkoutAll.addEventListener("click", () => {
            const basket = JSON.parse(localStorage.getItem("basket")) || [];

            if (basket.length === 0) {
                alert("Your basket is empty.");
                return;
            }

            fetch("/create-stripe-link", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({ items: basket }),
            })
                .then((res) => res.json())
                .then((data) => {
                    if (data.url) {
                        window.location.href = data.url;
                    } else {
                        alert("Payment link failed.");
                    }
                });
        });
    }
});
