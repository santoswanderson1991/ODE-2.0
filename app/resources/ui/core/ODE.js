'use strict';

window.ODE = window.ODE || {};

ODE.ready = function (callback) {

    if (document.readyState === 'loading') {

        document.addEventListener(
            'DOMContentLoaded',
            callback
        );

        return;

    }

    callback();

};

ODE.dispatch = function (event, detail = {}) {

    document.dispatchEvent(

        new CustomEvent(

            event,

            {

                detail

            }

        )

    );

};

ODE.listen = function (event, callback) {

    document.addEventListener(
        event,
        callback
    );

};