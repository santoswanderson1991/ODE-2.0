'use strict';

class ODESlug {

    constructor() {

        this.bind();

    }

    bind() {

        document.addEventListener(

            'input',

            (event) => {

                const input = event.target;

                if (!input.matches('[name="name"]')) {
                    return;
                }

                const form = input.closest('form');

                if (!form) {
                    return;
                }

                const slug = form.querySelector(
                    '[name="slug"]'
                );

                if (!slug) {
                    return;
                }

                if (slug.dataset.manual === '1') {
                    return;
                }

                slug.value = this.generate(
                    input.value
                );

            }

        );

        document.addEventListener(

            'input',

            (event) => {

                if (
                    event.target.matches('[name="slug"]')
                ) {

                    event.target.dataset.manual = '1';

                }

            }

        );

    }

    generate(value) {

        return value

            .normalize('NFD')

            .replace(/[\u0300-\u036f]/g, '')

            .toLowerCase()

            .replace(/[^a-z0-9]+/g, '-')

            .replace(/^-+|-+$/g, '')

            .replace(/-{2,}/g, '-');

    }

}