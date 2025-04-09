//js para los productos de cs float
console.log("Inventory script loaded.");

function fetchInventory() {
    fetch('/api/fetch-inventory')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                console.error("Error en la API:", data.error);
                return;
            }
            loadInventory(data);
        })
        .catch(error => {
            console.error("Error al obtener el inventario:", error);
        });
}