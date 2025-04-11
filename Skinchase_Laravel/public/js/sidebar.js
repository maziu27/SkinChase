function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');

    if (sidebar.style.display === 'none') {
        sidebar.style.display = 'block';
        mainContent.style.marginLeft = '250px'; // Adjust this value based on your sidebar width
    } else {
        sidebar.style.display = 'none';
        mainContent.style.marginLeft = '0';
    }
}