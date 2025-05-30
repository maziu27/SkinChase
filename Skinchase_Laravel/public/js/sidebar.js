function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');

    if (sidebar.style.display === 'none') {
        sidebar.style.display = 'block';
        mainContent.style.marginLeft = '250px'; // Valor no fijo, ajusta segun vaya la elegancia
    } else {
        sidebar.style.display = 'none';
       
        mainContent.style.marginLeft = '0';
    }
}

//esto no hace nada literalmente kajajaja