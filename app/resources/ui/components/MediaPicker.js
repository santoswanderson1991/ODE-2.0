'use strict';

class ODEMediaPicker {

    constructor() {

        this.frame = null;

        this.bind();

    }

    bind() {

        document.addEventListener(

            'click',

            (event) => {

                const button = event.target.closest(
                    '[data-media]'
                );

                if (!button) {
                    return;
                }

                event.preventDefault();

                this.open(button);

            }

        );

    }

    open(button) {

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

                this.fill(button, attachment);

            }

        );

        this.frame.open();

    }

    fill(button, attachment) {

        const wrapper = button.closest('.ode-media-picker');

        if (!wrapper) {
            return;
        }

        const input = wrapper.querySelector(
            'input[type="hidden"]'
        );

        if (input) {
            input.value = attachment.id;
        }

        const preview = wrapper.querySelector(
            '.ode-media-preview'
        );

        if (preview) {

            preview.innerHTML = `

                <img
                    src="${attachment.url}"
                    alt=""
                >

            `;

        }

    }

}