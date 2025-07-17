<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/maindashboad.css')}}">
 
</head>
<body>
    <!-- Sidebar -->
     @include('layouts.sidebar')

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        @yield('content')
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle sidebar
            const toggleBtn = document.getElementById('toggleBtn');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('sidebar-collapsed');
                mainContent.classList.toggle('main-content-expanded');
            });
            
            // Mobile sidebar toggle
            const mediaQuery = window.matchMedia('(max-width: 768px)');
            
            function handleMobileChange(e) {
                if (e.matches) {
                    sidebar.classList.remove('sidebar-collapsed');
                    sidebar.classList.remove('sidebar-mobile-show');
                    mainContent.classList.remove('main-content-expanded');
                } else {
                    if (!sidebar.classList.contains('sidebar-collapsed')) {
                        sidebar.classList.add('sidebar-collapsed');
                        mainContent.classList.add('main-content-expanded');
                    }
                }
            }
            
            mediaQuery.addListener(handleMobileChange);
            handleMobileChange(mediaQuery);
            
            // Sidebar menu item hover effect
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                link.addEventListener('mouseenter', function() {
                    if (sidebar.classList.contains('sidebar-collapsed')) {
                        this.style.transform = 'translateX(5px)';
                        this.style.background = 'rgba(255, 255, 255, 0.1)';
                    }
                });
                
                link.addEventListener('mouseleave', function() {
                    if (sidebar.classList.contains('sidebar-collapsed')) {
                        this.style.transform = '';
                        this.style.background = '';
                    }
                });
                
                link.addEventListener('click', function(e) {
                    if (!this.classList.contains('active')) {
                        navLinks.forEach(l => l.classList.remove('active'));
                        this.classList.add('active');
                    }
                });
            });
            
            // Mobile menu toggle
            toggleBtn.addEventListener('click', function() {
                if (window.matchMedia('(max-width: 768px)').matches) {
                    sidebar.classList.toggle('sidebar-mobile-show');
                }
            });
        });
    </script>
    
</body>
</html>