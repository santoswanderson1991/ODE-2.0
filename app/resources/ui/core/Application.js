'use strict';

class ODEApplication {

    constructor() {

        this.booted = false;
Gcontinue
    }

    boot(workspace = null) {

        if (this.booted) {
            return;
        }

        this.booted = true;

        new ODEForm();

        new ODESlug();

        new ODEMediaPicker();

        if (workspace) {

            workspace.boot();

        }

    }

}

window.ODEApp = new ODEApplication();