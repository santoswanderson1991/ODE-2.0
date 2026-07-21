'use strict';

class ODEForm {

    constructor() {

        this.bind();

    }

    bind() {

        document.addEventListener(

            'submit',

            (event) => {

                const form = event.target;

                if (!form.matches('.ode-form')) {
                    return;
                }

                event.preventDefault();

                this.submit(form);

            }

        );

    }

    async submit(form) {

        const submitButton = form.querySelector(
            '[type="submit"]'
        );

        const originalText = submitButton
            ? submitButton.innerHTML
            : '';

        if (submitButton) {

            submitButton.disabled = true;

            submitButton.innerHTML = 'Salvando...';

        }

        try {

            const formData = new FormData(form);

            const response = await fetch(

                ODE.ajaxUrl,

                {
                    method: 'POST',
                    credentials: 'same-origin',
                    body: formData
                }

            );

            const json = await response.json();

            if (json.success) {

                document.dispatchEvent(

                    new CustomEvent(

                        'ode:form.success',

                        {

                            detail: {

                                form,

                                response: json.data

                            }

                        }

                    )

                );

            } else {

                document.dispatchEvent(

                    new CustomEvent(

                        'ode:form.error',

                        {

                            detail: {

                                form,

                                response: json.data

                            }

                        }

                    )

                );

            }

        } catch (error) {

            console.error(error);

            document.dispatchEvent(

                new CustomEvent(

                    'ode:form.exception',

                    {

                        detail: {

                            form,

                            error

                        }

                    }

                )

            );

        } finally {

            if (submitButton) {

                submitButton.disabled = false;

                submitButton.innerHTML = originalText;

            }

        }

    }

}