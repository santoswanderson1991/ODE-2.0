document.addEventListener(
    "click",
    function(e){

        const button=e.target.closest(".ode-button");

        if(!button){

            return;

        }

        button.classList.add("is-loading");

    }
);