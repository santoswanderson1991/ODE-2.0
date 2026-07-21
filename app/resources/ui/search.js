'use strict';

class ODESearch {

    constructor() {

        this.debounce = null;

        this.registerEvents();

    }

    registerEvents() {

        document.addEventListener(
            'input',
            (event) => {

                const input = event.target.closest('[data-search-target]');

                if (!input) {
                    return;
                }

                clearTimeout(this.debounce);

                this.debounce = setTimeout(
                    () => this.search(input),
                    400
                );

            }
        );

    }

    search(input) {

        const target = input.dataset.searchTarget;

        const url = input.dataset.searchUrl;

        if (!target || !url) {
            return;
        }

        const query = encodeURIComponent(
            input.value
        );

        document.dispatchEvent(

            new CustomEvent(

                'ode:table.reload',

                {

                    detail: {

                        target,

                        url: `${url}&search=${query}`

                    }

                }

            )

        );

    }

}

window.ODESearch = ODESearch;