import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function () {

    const menuButton = document.getElementById('mobileMenuButton');
    const mainMenu = document.getElementById('mainMenu');

    if (!menuButton || !mainMenu) {
        return;
    }


    /* ==========================================
       HAMBURGER
    ========================================== */

    menuButton.addEventListener('click', function () {

        const isOpen = mainMenu.classList.toggle('mobile-open');

        menuButton.setAttribute(
            'aria-expanded',
            isOpen ? 'true' : 'false'
        );


        const icon = menuButton.querySelector('i');

        if (icon) {

            if (isOpen) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-xmark');
            } else {
                icon.classList.remove('fa-xmark');
                icon.classList.add('fa-bars');
            }

        }

    });


    /* ==========================================
       DROPDOWN MOBILE
    ========================================== */

    const dropdowns = mainMenu.querySelectorAll('.dropdown');

    dropdowns.forEach(function (dropdown) {

        const toggle = dropdown.querySelector('.dropdown-toggle');

        if (!toggle) {
            return;
        }


        toggle.addEventListener('click', function () {

            /*
             * Desktop tetap menggunakan hover.
             * Kode klik hanya untuk tablet / HP.
             */

            if (window.innerWidth > 900) {
                return;
            }


            const willOpen = !dropdown.classList.contains('open');


            /* Tutup dropdown lain */

            dropdowns.forEach(function (otherDropdown) {

                if (otherDropdown !== dropdown) {

                    otherDropdown.classList.remove('open');

                    const otherToggle =
                        otherDropdown.querySelector('.dropdown-toggle');

                    if (otherToggle) {
                        otherToggle.setAttribute(
                            'aria-expanded',
                            'false'
                        );
                    }

                }

            });


            /* Buka / tutup dropdown */

            dropdown.classList.toggle('open', willOpen);

            toggle.setAttribute(
                'aria-expanded',
                willOpen ? 'true' : 'false'
            );

        });

    });


    /* ==========================================
       RESET KETIKA KEMBALI KE DESKTOP
    ========================================== */

    window.addEventListener('resize', function () {

        if (window.innerWidth > 900) {

            mainMenu.classList.remove('mobile-open');

            menuButton.setAttribute(
                'aria-expanded',
                'false'
            );


            const icon = menuButton.querySelector('i');

            if (icon) {
                icon.classList.remove('fa-xmark');
                icon.classList.add('fa-bars');
            }


            dropdowns.forEach(function (dropdown) {

                dropdown.classList.remove('open');

                const toggle =
                    dropdown.querySelector('.dropdown-toggle');

                if (toggle) {
                    toggle.setAttribute(
                        'aria-expanded',
                        'false'
                    );
                }

            });

        }

    });

});