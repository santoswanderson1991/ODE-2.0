'use strict';

class ODEToast {

    static success(message) {

        this.show(message, 'success');

    }

    static error(message) {

        this.show(message, 'error');

    }

    static warning(message) {

        this.show(message, 'warning');

    }

    static info(message) {

        this.show(message, 'info');

    }

    static show(message, type) {

        let container = document.querySelector(
            '.ode-toast-container'
        );

        if (!container) {

            container = document.createElement('div');

            container.className =
                'ode-toast-container';

            document.body.appendChild(container);

        }

        const toast = document.createElement('div');

        toast.className = `ode-toast ${type}`;

        toast.innerHTML = message;

        container.appendChild(toast);

        requestAnimationFrame(() => {

            toast.classList.add('show');

        });

        setTimeout(() => {

            toast.classList.remove('show');

            setTimeout(() => {

                toast.remove();

            }, 300);

        }, 3000);

    }

}