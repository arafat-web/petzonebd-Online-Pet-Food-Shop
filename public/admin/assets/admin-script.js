/* ═══════════════════════════════════════════════════════════ */
/* ADMIN PANEL - JAVASCRIPT FUNCTIONALITY */
/* ═══════════════════════════════════════════════════════════ */

document.addEventListener('DOMContentLoaded', function() {
    // Sidebar Toggle
    const menuToggle = document.getElementById('admin-menu-toggle');
    const sidebarClose = document.getElementById('admin-sidebar-close');
    const body = document.body;
    const sidebar = document.getElementById('admin-sidebar');

    // Initialize sidebar state based on screen size
    function initSidebarState() {
        if (window.innerWidth > 768) {
            // Desktop: sidebar always visible
            body.classList.remove('sidebar-open');
            body.classList.remove('sidebar-closed');
        } else {
            // Mobile: sidebar hidden by default
            body.classList.remove('sidebar-open');
        }
    }

    // Call on page load
    initSidebarState();

    // Open/Close Sidebar on Mobile
    if (menuToggle) {
        menuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            body.classList.toggle('sidebar-open');
        });
    }

    // Close Sidebar button
    if (sidebarClose) {
        sidebarClose.addEventListener('click', function() {
            body.classList.remove('sidebar-open');
        });
    }

    // Close sidebar when clicking outside (mobile only)
    document.addEventListener('click', function(event) {
        if (sidebar && window.innerWidth <= 768) {
            const menuToggle = document.getElementById('admin-menu-toggle');
            
            if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                body.classList.remove('sidebar-open');
            }
        }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        initSidebarState();
    });

    // Close sidebar when opening user menu
    const userBtn = document.querySelector('.admin-user-btn');
    if (userBtn) {
        userBtn.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                body.classList.remove('sidebar-open');
            }
        });
    }
});
