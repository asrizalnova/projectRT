document.addEventListener('DOMContentLoaded', function() {
    const toggleSidebar = document.querySelector('.toggle-sidebar');
    const sidebar = document.querySelector('.sidebar');

    toggleSidebar.addEventListener('click', function() {
        sidebar.classList.toggle('active');
    });
});
