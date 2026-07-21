'use strict';

class ODERequest {

    static async post(action, data = {}) {

        const formData = new FormData();

        formData.append(
            'action',
            action
        );

        formData.append(
            '_ajax_nonce',
            ODE.nonce
        );

        Object.entries(data).forEach(

            ([key, value]) => {

                formData.append(
                    key,
                    value
                );

            }

        );

        const response = await fetch(

            ODE.ajaxUrl,

            {

                method: 'POST',

                credentials: 'same-origin',

                body: formData

            }

        );

        const json = await response.json();

        if (!json.success) {

            throw new Error(

                json.data.message

            );

        }

        return json.data;

    }

    static async get(action, data = {}) {

        const params = new URLSearchParams({

            action,

            ...data

        });

        const response = await fetch(

            `${ODE.ajaxUrl}?${params}`

        );

        const json = await response.json();

        if (!json.success) {

            throw new Error(

                json.data.message

            );

        }

        return json.data;

    }

}