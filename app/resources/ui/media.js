'use strict';

class ODEMedia {

    constructor() {

        this.frame = null;

        this.registerEvents();

    }

    registerEvents() {

        document.addEventListener(
            'click',
            (event) => {

                const button = event.target.closest('.ode-media-open');

                if (!button) {
                    return;
                }

                event.preventDefault();

                this.open(button);

            }
        );

        document.addEventListener(
            'click',
            (event) => {

                const button = event.target.closest('.ode-media-remove');

                if (!button) {
                    return;
                }

                event.preventDefault();

                this.remove(button);

            }
        );

    }

    open(button) {

        const wrapper = button.closest('.ode-image-upload');

        const input = wrapper.querySelector('input[type="hidden"]');

        const preview = wrapper.querySelector('.ode-image-preview');

        if (this.frame) {
            this.frame.open();
            return;
        }

        this.frame = wp.media({

            title: 'Selecionar imagem',

            button: {

                text: 'Usar imagem'

            },

            multiple: false

        });

        this.frame.on(
            'select',
            () => {

                const attachment = this.frame
                    .state()
                    .get('selection')
                    .first()
                    .toJSON();

                input.value = attachment.id;

                preview.innerHTML = `
                    <img
                        src="${attachment.url}"
                        alt=""
                    >
                `;

            }
        );

        this.frame.open();

    }

    remove(button) {

        const wrapper = button.closest('.ode-image-upload');

        const input = wrapper.querySelector('input[type="hidden"]');

        const preview = wrapper.querySelector('.ode-image-preview');

        input.value = '';

        preview.innerHTML = '';

    }

}

window.ODEMedia = ODEMedia;