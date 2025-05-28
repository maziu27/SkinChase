function openModal(item) {
    document.getElementById('modal-name').innerText = item.name;
    document.getElementById('modal-float').innerText = 
    /*si el nombre incluye "package" asigna el valor container,
    si el float no es null pone el float y el valor, y si es null
    asigna el valor a sticker */
    item.name.includes("Package")
        ? "Container"
        : item.float_value !== null
        ? `Float: ${item.float_value}`
        : "Sticker";
    document.getElementById('modal-price').innerText = '€' + Number(item.price).toFixed(2);
    document.getElementById('modal-image').src = `https://steamcommunity-a.akamaihd.net/economy/image/${item.icon_url}`;

    // Mostrar modal
    const modal = document.getElementById('product-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    // Lógica para mostrar similares, si los tienes
    document.getElementById('similar-products').innerHTML = `<p>No hay similares.</p>`;
}

function closeModal() {
    const modal = document.getElementById('product-modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function closeModalOnBackdrop(event) {
    if (event.target.id === 'product-modal') {
        closeModal();
    }
}