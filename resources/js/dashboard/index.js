document.addEventListener('DOMContentLoaded', function () {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('layoutSidenav_nav');

    sidebarToggle.addEventListener('click', function () {
        sidebar.classList.toggle('contraer');
    });
});