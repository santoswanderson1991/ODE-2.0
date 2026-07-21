'use strict';

class ODEDrawer {

    static open(id) {

        const drawer = document.getElementById(id);

        if (!drawer) {
            return;
        }

        drawer.classList.add('is-open');

        document.body.classList.add('ode-drawer-open');

    }

    static close(id = null) {

        if (id) {

            const drawer = document.getElementById(id);

            if (drawer) {

                drawer.classList.remove('is-open');

            }

        } else {

            document.querySelectorAll('.ode-drawer')
                .forEach(drawer => {

                    drawer.classList.remove('is-open');

                });

        }

        document.body.classList.remove('ode-drawer-open');

    }

    static toggle(id) {

        const drawer = document.getElementById(id);

        if (!drawer) {
            return;
        }

        drawer.classList.toggle('is-open');

    }

}

document.addEventListener(

    'click',

    event => {

        const open = event.target.closest('[data-drawer-open]');

        if (open) {

            event.preventDefault();

            ODEDrawer.open(
                open.dataset.drawerOpen
            );

        }

        const close = event.target.closest('[data-drawer-close]');

        if (close) {

            event.preventDefault();

            ODEDrawer.close();

        }

    }

);