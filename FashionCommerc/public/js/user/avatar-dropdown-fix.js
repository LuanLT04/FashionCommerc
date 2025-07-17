/**
 * Avatar Dropdown Fix - Simple Version
 * Ensures avatar dropdown works on all pages without Bootstrap conflicts
 */

(function() {
    'use strict';

    let initialized = false;

    function log(message) {
        console.log('[Avatar Dropdown] ' + message);
    }

    function initAvatarDropdown() {
        if (initialized) {
            log('Already initialized, skipping');
            return;
        }

        const avatarDropdown = document.getElementById('avatarDropdown');
        if (!avatarDropdown) {
            log('Avatar dropdown element not found');
            return;
        }

        log('Initializing avatar dropdown');
        initialized = true;

        // Remove Bootstrap attributes to prevent conflicts
        avatarDropdown.removeAttribute('data-bs-toggle');
        avatarDropdown.removeAttribute('data-toggle');

        // Add click handler
        avatarDropdown.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            log('Avatar clicked');

            const dropdownMenu = avatarDropdown.nextElementSibling;
            if (!dropdownMenu || !dropdownMenu.classList.contains('dropdown-menu')) {
                log('Dropdown menu not found');
                return;
            }

            // Close all other dropdowns
            document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                if (menu !== dropdownMenu) {
                    menu.classList.remove('show');
                }
            });

            // Toggle current dropdown
            const isOpen = dropdownMenu.classList.contains('show');
            if (isOpen) {
                dropdownMenu.classList.remove('show');
                log('Dropdown closed');
            } else {
                dropdownMenu.classList.add('show');
                log('Dropdown opened');
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const dropdownMenu = avatarDropdown.nextElementSibling;
            if (dropdownMenu &&
                !avatarDropdown.contains(e.target) &&
                !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.remove('show');
                log('Dropdown closed by outside click');
            }
        });

        // Close dropdown on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const dropdownMenu = avatarDropdown.nextElementSibling;
                if (dropdownMenu && dropdownMenu.classList.contains('show')) {
                    dropdownMenu.classList.remove('show');
                    log('Dropdown closed by escape key');
                }
            }
        });

        log('Avatar dropdown initialized successfully');
    }

    // Try multiple initialization methods
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            log('DOM loaded, initializing...');
            setTimeout(initAvatarDropdown, 100);
        });
    } else {
        log('DOM already loaded, initializing immediately...');
        setTimeout(initAvatarDropdown, 100);
    }

    // Fallback initialization
    window.addEventListener('load', function() {
        setTimeout(function() {
            if (!initialized) {
                log('Fallback initialization on window load');
                initAvatarDropdown();
            }
        }, 200);
    });

})();


