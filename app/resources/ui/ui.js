console.log('UI.JS NOVO CARREGADO');

'use strict';

class ODEApplication {

    constructor() {

        this.boot();

    }

    boot() {

        this.initializeDrawers();

        this.initializeMedia();

        this.initializeForms();

        this.initializeTables();

        this.initializeSearch();

    }

    initializeDrawers() {

        if (typeof ODEDrawer !== 'undefined') {

            new ODEDrawer();

        }

    }

    initializeMedia() {

        if (typeof ODEMedia !== 'undefined') {

            new ODEMedia();

        }

    }

    initializeForms() {

        if (typeof ODEForm !== 'undefined') {

            new ODEForm();

        }

    }

    initializeTables() {

        if (typeof ODETable !== 'undefined') {

            new ODETable();

        }

    }

    initializeSearch() {

        if (typeof ODESearch !== 'undefined') {

            new ODESearch();

        }

    }

}

    document.addEventListener(
        'DOMContentLoaded',
        () => {

            console.log('CRIANDO ODEAPP');

            window.ODEApp = new ODEApplication();

        }
    );


document.addEventListener(
    'DOMContentLoaded',
    () => {

        console.log('ANTES');
        console.log('window.ODE =', window.ODE);

        window.ODEApp = new ODEApplication();

        console.log('DEPOIS');
        console.log('window.ODE =', window.ODE);
        console.log('window.ODEApp =', window.ODEApp);

    }
);
