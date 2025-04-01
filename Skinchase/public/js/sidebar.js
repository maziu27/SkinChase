document.addEventListener("DOMContentLoaded", function () {
    let sidebar = document.querySelector(".sidebar");
    let toggleBtn = document.querySelector(".toggle-btn");

    toggleBtn.addEventListener("click", function () {
        sidebar.classList.toggle("collapsed");
        toggleBtn.classList.toggle("moved"); // Agregamos una clase para manejar el estilo con CSS
    });
});
