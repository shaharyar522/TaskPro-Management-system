 document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('toggleBtn');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');

        if (toggleBtn && sidebar && mainContent) {
            toggleBtn.addEventListener('click', function () {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
            });
        }

        // Sidebar active link
        const navLinks = document.querySelectorAll('.sidebar-menu .nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function () {
                navLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Dropdown toggle
        const userDropdown = document.getElementById('userDropdown');
        if (userDropdown) {
            userDropdown.addEventListener('click', function (e) {
                e.preventDefault();
                const dropdownMenu = this.nextElementSibling;
                dropdownMenu.classList.toggle('show');
            });

            document.addEventListener('click', function (e) {
                if (!userDropdown.contains(e.target) && !e.target.closest('.dropdown-menu')) {
                    const dropdownMenu = document.querySelector('.dropdown-menu');
                    if (dropdownMenu) dropdownMenu.classList.remove('show');
                }
            });
        }
    });