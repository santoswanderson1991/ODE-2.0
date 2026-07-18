'use strict';

class ODEDrawer {

    constructor() {

        this.drawers = document.querySelectorAll('.ode-drawer');

        this.registerEvents();

    }

    registerEvents() {

        document.addEventListener(
            'click',
            (event) => {

                const openButton = event.target.closest('[data-drawer-open]');

                if (openButton) {

                    event.preventDefault();

                    this.open(
                        openButton.dataset.drawerOpen
                    );

                }

                const closeButton = event.target.closest('[data-drawer-close]');

                if (closeButton) {

                    event.preventDefault();

                    this.close(
                        closeButton.closest('.ode-drawer')
                    );

                }

                const overlay = event.target.closest('.ode-drawer-overlay');

                if (overlay) {

                    this.close(
                        overlay.closest('.ode-drawer')
                    );

                }

            }
        );

        document.addEventListener(
            'keydown',
            (event) => {

                if (event.key === 'Escape') {

                    this.closeAll();

                }

            }
        );

    }

    open(id) {

        const drawer = document.getElementById(id);

        if (!drawer) {
            return;
        }

        drawer.classList.add('is-open');

        drawer.setAttribute(
            'aria-hidden',
            'false'
        );

        document.body.classList.add(
            'ode-drawer-open'
        );

        document.dispatchEvent(
            new CustomEvent(
                'ode:drawer.open',
                {
                    detail: {
                        id
                    }
                }
            )
        );

    }

    close(drawer) {

        if (!drawer) {
            return;
        }

        drawer.classList.remove(
            'is-open'
        );

        drawer.setAttribute(
            'aria-hidden',
            'true'
        );

        if (
            document.querySelectorAll(
                '.ode-drawer.is-open'
            ).length === 0
        ) {

            document.body.classList.remove(
                'ode-drawer-open'
            );

        }

        document.dispatchEvent(
            new CustomEvent(
                'ode:drawer.close',
                {
                    detail: {
                        id: drawer.id
                    }
                }
            )
        );

    }

    closeAll() {

        this.drawers.forEach(
            (drawer) => this.close(drawer)
        );

    }

}

window.ODEDrawer = ODEDrawer;