'use strict';

document.addEventListener(

    'DOMContentLoaded',

    () => {

        new ODEForm();

        new ODESlug();

    }

);

document.addEventListener(

    'ode:form.success',

    () => {

        location.reload();

    }

);