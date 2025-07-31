document.addEventListener('DOMContentLoaded', function () {
    // Get essential elements
    const toggleBtn = document.getElementById('toggleBtn');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const body = document.body;

    // Create overlay for mobile sidebar
    let sidebarOverlay = document.createElement('div');
    sidebarOverlay.className = 'sidebar-overlay';
    sidebarOverlay.id = 'sidebarOverlay';
    body.appendChild(sidebarOverlay);

    // Debug logging
    console.log('Mobile Sidebar Debug:');
    console.log('Toggle button found:', !!toggleBtn);
    console.log('Sidebar found:', !!sidebar);
    console.log('Main content found:', !!mainContent);
    console.log('Window width:', window.innerWidth);
    console.log('User agent:', navigator.userAgent);

    // Initialize sidebar state
    function initializeSidebar() {
        if (window.innerWidth <= 768) {
            // Mobile: hide sidebar by default
            sidebar.style.transform = 'translateX(-100%)';
            sidebar.style.visibility = 'visible';
            sidebar.style.opacity = '1';
            sidebar.classList.remove('show');
            sidebarOverlay.classList.remove('show');
        } else {
            // Desktop: show sidebar
            sidebar.style.transform = 'translateX(0)';
            sidebar.style.visibility = 'visible';
            sidebar.style.opacity = '1';
        }
    }

    // Enhanced toggle function
    function toggleSidebar() {
        console.log('Toggle sidebar called');
        console.log('Current window width:', window.innerWidth);
        console.log('Sidebar classes:', sidebar.classList.toString());
        
        if (window.innerWidth <= 768) {
            // Mobile behavior
            if (sidebar.classList.contains('show')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        } else {
            // Desktop behavior
            if (sidebar.classList.contains('sidebar-collapsed')) {
                expandSidebar();
            } else {
                collapseSidebar();
            }
        }
    }

    // Enhanced open sidebar function
    function openSidebar() {
        console.log('Opening sidebar for mobile...');
        
        // Add show class
        sidebar.classList.add('show');
        sidebarOverlay.classList.add('show');
        
        // Force mobile styles
        sidebar.style.transform = 'translateX(0)';
        sidebar.style.visibility = 'visible';
        sidebar.style.opacity = '1';
        sidebar.style.zIndex = '1001';
        sidebar.style.transition = 'transform 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
        
        // Prevent body scroll
        body.style.overflow = 'hidden';
        
        // Ensure overlay is visible
        sidebarOverlay.style.opacity = '1';
        sidebarOverlay.style.visibility = 'visible';
        sidebarOverlay.style.zIndex = '1000';
        
        console.log('Sidebar opened successfully');
    }
    // Enhanced close sidebar function
    function closeSidebar() {
        console.log('Closing sidebar...');
        
        // Remove show class
        sidebar.classList.remove('show');
        sidebarOverlay.classList.remove('show');
        
        // Animate out
        sidebar.style.transform = 'translateX(-100%)';
        sidebar.style.transition = 'transform 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
        
        // Restore body scroll
        body.style.overflow = '';
        
        // Hide overlay
        sidebarOverlay.style.opacity = '0';
        sidebarOverlay.style.visibility = 'hidden';
        
        console.log('Sidebar closed successfully');
    }

    // Desktop functions
    function collapseSidebar() {
        sidebar.classList.add('sidebar-collapsed');
        mainContent.classList.add('main-content-expanded');
    }

    function expandSidebar() {
        sidebar.classList.remove('sidebar-collapsed');
        mainContent.classList.remove('main-content-expanded');
    }

    // Handle resize events
    function handleResize() {
        console.log('Resize event - new width:', window.innerWidth);
        
        if (window.innerWidth > 768) {
            // Desktop: reset mobile state
            sidebar.classList.remove('show');
            sidebarOverlay.classList.remove('show');
            body.style.overflow = '';
            sidebar.style.transform = '';
            sidebar.style.zIndex = '';
            sidebar.style.transition = '';
        } else {
            // Mobile: ensure proper state
            if (!sidebar.classList.contains('show')) {
                sidebar.style.transform = 'translateX(-100%)';
            }
        }
    }

    // Event listeners
    if (toggleBtn) {
        // Primary click handler
        toggleBtn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Toggle button clicked!');
            toggleSidebar();
        });

        // Touch events for better mobile support
        toggleBtn.addEventListener('touchstart', function (e) {
            e.preventDefault();
            console.log('Toggle button touched!');
            toggleSidebar();
        }, { passive: false });
    }

    // Overlay click handler
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Overlay clicked - closing sidebar');
            closeSidebar();
        });

        // Touch events for overlay
        sidebarOverlay.addEventListener('touchstart', function (e) {
            e.preventDefault();
            console.log('Overlay touched - closing sidebar');
            closeSidebar();
        }, { passive: false });
    }

    // Close sidebar when clicking outside (mobile only)
    document.addEventListener('click', function (e) {
        if (window.innerWidth <= 768 && sidebar.classList.contains('show')) {
            if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
                console.log('Clicked outside - closing sidebar');
                closeSidebar();
            }
        }
    });

    // Escape key handler
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && sidebar.classList.contains('show')) {
            console.log('Escape key pressed - closing sidebar');
            closeSidebar();
        }
    });

    // Window resize handler
    window.addEventListener('resize', function () {
        handleResize();
    });

    // Orientation change handler
    window.addEventListener('orientationchange', function () {
        setTimeout(handleResize, 100);
    });

    // Touch gesture support for mobile
    let touchStartX = 0;
    let touchStartY = 0;
    let touchEndX = 0;
    let touchEndY = 0;

    document.addEventListener('touchstart', function (e) {
        touchStartX = e.changedTouches[0].screenX;
        touchStartY = e.changedTouches[0].screenY;
    }, { passive: true });

    document.addEventListener('touchend', function (e) {
        touchEndX = e.changedTouches[0].screenX;
        touchEndY = e.changedTouches[0].screenY;
        handleSwipe();
    }, { passive: true });

    function handleSwipe() {
        if (window.innerWidth <= 768) {
            const swipeThreshold = 50;
            const swipeDistance = touchEndX - touchStartX;
            const verticalDistance = Math.abs(touchEndY - touchStartY);
            
            // Only handle horizontal swipes (vertical distance < 100px)
            if (verticalDistance < 100) {
                // Swipe right to open sidebar (from left edge)
                if (swipeDistance > swipeThreshold && touchStartX < 50) {
                    console.log('Swipe right detected - opening sidebar');
                    openSidebar();
                }
                // Swipe left to close sidebar
                else if (swipeDistance < -swipeThreshold && sidebar.classList.contains('show')) {
                    console.log('Swipe left detected - closing sidebar');
                    closeSidebar();
                }
            }
        }
    }

    // Sidebar menu link handlers
    const navLinks = document.querySelectorAll('.sidebar-menu .nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            // Remove active class from all links
            navLinks.forEach(l => l.classList.remove('active'));
            // Add active class to clicked link
            this.classList.add('active');
            
            // Close sidebar on mobile after navigation
            if (window.innerWidth <= 768) {
                setTimeout(closeSidebar, 300);
            }
        });
    });

    // Prevent sidebar menu clicks from affecting toggle
    const sidebarMenu = document.querySelector('.sidebar-menu');
    if (sidebarMenu) {
        sidebarMenu.addEventListener('click', function (e) {
            e.stopPropagation();
        });
    }

    // // User dropdown functionality
    // const userDropdown = document.getElementById('userDropdown');
    // if (userDropdown) {
    //     userDropdown.addEventListener('click', function (e) {
    //         e.preventDefault();
    //         e.stopPropagation();
    //         const dropdownMenu = this.nextElementSibling;
    //         if (dropdownMenu) {
    //             dropdownMenu.classList.toggle('show');
    //         }
    //     });

    //     // Close dropdown when clicking outside
    //     document.addEventListener('click', function (e) {
    //         if (!userDropdown.contains(e.target) && !e.target.closest('.dropdown-menu')) {
    //             const dropdownMenu = document.querySelector('.dropdown-menu');
    //             if (dropdownMenu) {
    //                 dropdownMenu.classList.remove('show');
    //             }
    //         }
    //     });
    // }

    // Initialize everything
    initializeSidebar();
    
    // Ensure proper initialization after a short delay
    setTimeout(initializeSidebar, 100);
    
    // Add loading state
    document.body.classList.add('loaded');
    
    console.log('Mobile sidebar functionality initialized successfully');
});