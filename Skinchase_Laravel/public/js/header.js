const profileBtn = document.getElementById("profile-button");
const dropdown = document.getElementById("profile-dropdown");
const wrapper = document.getElementById("dropdown-wrapper");

// Toggle con animación
profileBtn.addEventListener("click", function (e) {
    //stopPropagation hace que el dropdown no se cierre en el momento
    e.stopPropagation();
    dropdown.classList.toggle("pointer-events-none");
    dropdown.classList.toggle("opacity-0");
    dropdown.classList.toggle("scale-95");
});

// Ocultar al hacer clic fuera
document.addEventListener("click", function (event) {
    if (!wrapper.contains(event.target)) {
        dropdown.classList.add("pointer-events-none", "opacity-0", "scale-95");
    }
});
