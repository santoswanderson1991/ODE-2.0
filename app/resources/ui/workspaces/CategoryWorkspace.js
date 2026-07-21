'use strict';

class CategoryWorkspace {

    constructor() {

        this.form = document.getElementById(
            'ode-category-form'
        );

        this.table = new ODEDataTable(
            '#ode-category-table'
        );

        this.events();

    }

    events() {

        ODE.listen(

            'ode:form.success',

            () => this.reload()

        );

        document.addEventListener(

            'click',

            (event) => {

                const button = event.target.closest(
                    '#ode-new-category'
                );

                if (button) {

                    this.create();

                }

            }

        );

    }

    create() {

        this.form.reset();

        this.openDrawer();

    }

    async reload() {

        try {

            const response = await ODERequest.get(
                'ode_category_table'
            );

            this.table.replace(
                response.html
            );

            ODEToast.success(
                'Categoria salva.'
            );

            ODEDrawer.close();

        } catch (error) {

            ODEToast.error(
                error.message
            );

        }

    }

    openDrawer() {

        ODEDrawer.open(
            'category-drawer'
        );

    }

}