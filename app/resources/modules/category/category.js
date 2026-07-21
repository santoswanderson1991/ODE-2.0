'use strict';

class ODECategory {

    constructor() {

        this.form = document.getElementById(
            'ode-category-form'
        );

        this.registerEvents();

    }

    registerEvents() {

        document.addEventListener(
            'click',
            (event) => {

                const button = event.target.closest(
                    '#ode-new-category'
                );

                if (!button) {
                    return;
                }

                this.create();

            }
        );

        document.addEventListener(
            'click',
            (event) => {

                const button = event.target.closest(
                    '[data-action="edit"]'
                );

                if (!button) {
                    return;
                }

                this.edit(
                    button.dataset.id
                );

            }
        );

        document.addEventListener(
            'click',
            (event) => {

                const button = event.target.closest(
                    '[data-action="delete"]'
                );

                if (!button) {
                    return;
                }

                this.remove(
                    button.dataset.id
                );

            }
        );

        document.addEventListener(
            'ode:form.success',
            () => {

                this.reset();

                document.dispatchEvent(
                    new CustomEvent(
                        'ode:table.reload',
                        {
                            detail: {
                                target: '#ode-category-table',
                                url: ODE.ajaxUrl +
                                    '?action=ode_category_table'
                            }
                        }
                    )
                );

                const drawer = document.getElementById(
                    'category-drawer'
                );

                if (drawer) {

                    drawer.classList.remove(
                        'is-open'
                    );

                }

            }
        );

    }

    create() {

        this.reset();

        this.openDrawer();

    }

    async edit(id) {

        const response = await fetch(

            ODE.ajaxUrl +

            '?action=ode_category_find&id=' +

            id

        );

        const json = await response.json();

        if (!json.success) {

            alert(json.data.message);

            return;

        }

        const category = json.data;

        this.form.querySelector(
            '[name="id"]'
        ).value = category.id;

        this.form.querySelector(
            '[name="name"]'
        ).value = category.name;

        this.form.querySelector(
            '[name="slug"]'
        ).value = category.slug;

        this.form.querySelector(
            '[name="description"]'
        ).value = category.description;

        this.form.querySelector(
            '[name="position"]'
        ).value = category.position;

        this.form.querySelector(
            '[name="active"]'
        ).checked = Number(category.active) === 1;

        this.form.querySelector(
            '[name="action"]'
        ).value = 'ode_category_update';

        this.openDrawer();

    }

    async remove(id) {

        if (

            !confirm(

                'Deseja realmente excluir esta categoria?'

            )

        ) {

            return;

        }

        const form = new FormData();

        form.append(
            'action',
            'ode_category_delete'
        );

        form.append(
            'id',
            id
        );

        form.append(
            '_wpnonce',
            ODE.nonce
        );

        const response = await fetch(

            ODE.ajaxUrl,

            {

                method: 'POST',

                body: form

            }

        );

        const json = await response.json();

        if (!json.success) {

            alert(json.data.message);

            return;

        }

        document.dispatchEvent(

            new CustomEvent(

                'ode:table.reload',

                {

                    detail: {

                        target: '#ode-category-table',

                        url: ODE.ajaxUrl +

                            '?action=ode_category_table'

                    }

                }

            )

        );

    }

    reset() {

        this.form.reset();

        this.form.querySelector(
            '[name="id"]'
        ).value = '';

        this.form.querySelector(
            '[name="action"]'
        ).value = 'ode_category_store';

    }

    openDrawer() {

        const drawer = document.getElementById(
            'category-drawer'
        );

        if (!drawer) {
            return;
        }

        drawer.classList.add(
            'is-open'
        );

    }

}

document.addEventListener(
    'DOMContentLoaded',
    () => {

        new ODECategory();

    }
);

'use strict';

document.addEventListener('DOMContentLoaded', () => {

    const name = document.querySelector('[name="name"]');
    const slug = document.querySelector('[name="slug"]');

    if (!name || !slug) {
        return;
    }

    let manualEdition = false;

    slug.addEventListener('input', () => {
        manualEdition = slug.value.trim() !== '';
    });

    name.addEventListener('input', () => {

        if (manualEdition) {
            return;
        }

        slug.value = generateSlug(name.value);

    });

    function generateSlug(value) {

        return value
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '')
            .replace(/-{2,}/g, '-');

    }

});