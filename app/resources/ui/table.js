'use strict';

class ODETable {

    constructor() {

        this.registerEvents();

    }

    registerEvents() {

        document.addEventListener(
            'ode:table.reload',
            (event) => {

                this.reload(event.detail);

            }
        );

    }

    async reload(config) {

        if (!config) {
            return;
        }

        const container = document.querySelector(
            config.target
        );

        if (!container) {
            return;
        }

        container.classList.add('ode-loading');

        try {

            const response = await fetch(
                config.url,
                {
                    method: 'GET',
                    credentials: 'same-origin'
                }
            );

            const html = await response.text();

            container.innerHTML = html;

            document.dispatchEvent(
                new CustomEvent(
                    'ode:table.loaded',
                    {
                        detail: config
                    }
                )
            );

        } catch (error) {

            console.error(error);

            document.dispatchEvent(
                new CustomEvent(
                    'ode:table.error',
                    {
                        detail: error
                    }
                )
            );

        } finally {

            container.classList.remove(
                'ode-loading'
            );

        }

    }

}

window.ODETable = ODETable;