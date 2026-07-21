'use strict';

class ODEForm {

    constructor() {

        this.bind();

    }

    bind() {

    console.log('ODEForm::bind()');

    document.addEventListener(
        'submit',
        (event) => {

            console.log('SUBMIT DISPARADO', event.target);

            const form = event.target;

            if (!form.matches('.ode-form')) {
                console.log('Não é ode-form');
                return;
            }

            event.preventDefault();

            console.log('Enviando formulário...');

            this.submit(form);

        }
    );

}

    async submit(form) {

        const submit = form.querySelector(
            '[type="submit"]'
        );

        if (submit) {

            submit.disabled = true;

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
                            detail: json.data
                        }
                    )
                );

                alert('Categoria salva com sucesso!');

                const drawer = document.querySelector('.ode-drawer.open');

                if (drawer) {
                    drawer.classList.remove('open');
                }

                setTimeout(() => {
                    window.location.reload();
                }, 500);

            } else {

                alert(json.data.message);

                document.dispatchEvent(
                    new CustomEvent(
                        'ode:form.error',
                        {
                            detail: json.data
                        }
                    )
                );

            }

        } catch (error) {

            console.error(error);

            alert('Erro ao salvar categoria.');

            document.dispatchEvent(

                new CustomEvent(

                    'ode:form.exception',

                    {

                        detail: error

                    }

                )

            );

        } finally {

            if (submit) {

                submit.disabled = false;

            }

        }

    }

}

window.ODEForm = ODEForm;