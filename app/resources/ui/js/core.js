window.ODE = window.ODE || {};

ODE.version = "2.0.0";

ODE.ready = function(callback){

    if(document.readyState !== "loading"){
        callback();
        return;
    }

    document.addEventListener(
        "DOMContentLoaded",
        callback
    );

};

ODE.events = {

    on(event, callback){

        document.addEventListener(
            event,
            callback
        );

    },

    emit(event, detail = {}){

        document.dispatchEvent(

            new CustomEvent(
                event,
                {
                    detail
                }
            )

        );

    }

};

ODE.ready(function(){

    console.log(
        "ODE UI Framework iniciado."
    );

});