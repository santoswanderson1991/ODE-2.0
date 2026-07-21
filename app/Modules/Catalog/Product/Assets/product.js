'use strict';

class ProductWorkspace {

    constructor() {

        this.form = document.getElementById(
            'ode-product-form'
        );

        this.drawer = document.getElementById(
            'ode-product-drawer'
        );

        this.table = document.getElementById(
            'ode-product-table'
        );

        this.currentId = null;

        this.mediaFrame = null;

        this.bindEvents();

    }

    bindEvents() {

        document.addEventListener(

            'click',

            (event) => {

                this.handleClick(event);

            }

        );

        if (this.form) {

            this.form.addEventListener(

                'submit',

                (event) => {

                    event.preventDefault();

                    this.save();

                }

            );

        }

    }

    handleClick(event) {

        const target = event.target;

        const newButton = target.closest(
            '#ode-new-product'
        );

        if (newButton) {

            event.preventDefault();

            this.create();

            return;

        }

        const editButton = target.closest(
            '[data-action="edit"]'
        );

        if (editButton) {

            event.preventDefault();

            this.edit(
                editButton.dataset.id
            );

            return;

        }

        const deleteButton = target.closest(
            '[data-action="delete"]'
        );

        if (deleteButton) {

            event.preventDefault();

            this.destroy(
                deleteButton.dataset.id
            );

            return;

        }

        const mediaButton = target.closest(
            '[data-media]'
        );

        if (mediaButton) {

            event.preventDefault();

            this.mediaPicker();

            return;

        }

    }

    create() {

        this.currentId = null;

        this.reset();

        this.openDrawer();

    }

    openDrawer() {

        if (
            typeof ODEDrawer !== 'undefined'
        ) {

            ODEDrawer.open(
                'ode-product-drawer'
            );

            return;

        }

        this.drawer.classList.add(
            'is-open'
        );

    }

    closeDrawer() {

        if (
            typeof ODEDrawer !== 'undefined'
        ) {

            ODEDrawer.close();

            return;

        }

        this.drawer.classList.remove(
            'is-open'
        );

    }

    reset() {

        if (!this.form) {
            return;
        }

        this.form.reset();

        this.form.id.value = '';

        this.form.action.value = 'ode_product_store';

        this.currentId = null;

        const preview = this.form.querySelector(
            '.ode-media-preview'
        );

        if (preview) {
            preview.innerHTML = '';
        }

    }

    loading(status = true) {

        if (!this.form) {

            return;

        }

        if (status) {

            this.form.classList.add(
                'ode-loading'
            );

            return;

        }

        this.form.classList.remove(
            'ode-loading'
        );

    }

    async save() {

        this.loading(true);

        try {

            const formData = new FormData(this.form);

            if (this.currentId) {

                formData.set(
                    'action',
                    'ode_product_update'
                );

            } else {

                formData.set(
                    'action',
                    'ode_product_store'
                );

            }

            const response = await fetch(

                ajaxurl,

                {
                    method: 'POST',
                    credentials: 'same-origin',
                    body: formData
                }

            );

            const result = await response.json();

            if (!result.success) {

                throw new Error(
                    result.data.message ??
                    'Erro ao salvar produto.'
                );

            }

            this.toast(

                'Produto salvo com sucesso.',

                'success'

            );

            await this.reload();

            this.closeDrawer();

        } catch (error) {

            console.error(error);

            this.toast(

                error.message,

                'error'

            );

        }

        this.loading(false);

    }

    async edit(id) {

        try {

            const formData = new FormData();

            formData.append(

                'action',

                'ode_product_find'

            );

            formData.append(

                '_wpnonce',

                this.form.querySelector(
                    '[name="_wpnonce"]'
                ).value

            );

            formData.append(

                'id',

                id

            );

            const response = await fetch(

                ajaxurl,

                {
                    method: 'POST',
                    credentials: 'same-origin',
                    body: formData
                }

            );

            const result = await response.json();

            if (!result.success) {

                throw new Error(
                    result.data.message
                );

            }

            this.currentId = id;

            this.fill(

                result.data

            );

            this.openDrawer();

        } catch (error) {

            console.error(error);

            this.toast(

                error.message,

                'error'

            );

        }

    }

    async destroy(id) {

        if (

            !confirm(

                'Deseja realmente excluir este produto?'

            )

        ) {

            return;

        }

        try {

            const formData = new FormData();

            formData.append(

                'action',

                'ode_product_delete'

            );

            formData.append(

                '_wpnonce',

                this.form.querySelector(
                    '[name="_wpnonce"]'
                ).value

            );

            formData.append(

                'id',

                id

            );

            const response = await fetch(

                ajaxurl,

                {
                    method: 'POST',
                    credentials: 'same-origin',
                    body: formData
                }

            );

            const result = await response.json();

            if (!result.success) {

                throw new Error(
                    result.data.message
                );

            }

            await this.reload();

            this.toast(

                'Produto removido.',

                'success'

            );

        } catch (error) {

            console.error(error);

            this.toast(

                error.message,

                'error'

            );

        }

    }

    fill(product) {

        this.form.id.value = product.id;

        this.form.category_id.value = product.category_id;

        this.form.name.value = product.name;

        this.form.slug.value = product.slug;

        this.form.description.value =
            product.description ?? '';

        this.form.price.value =
            product.price;

        this.form.sale_price.value =
            product.sale_price ?? '';

        this.form.image_id.value =
            product.image_id ?? '';

        this.form.position.value =
            product.position;

        this.form.active.checked =
            Number(product.active) === 1;

        if (

            product.image_url

        ) {

            this.form
                .querySelector(
                    '.ode-media-preview'
                )
                .innerHTML =

                `<img src="${product.image_url}">`;

        }

    }

    async reload() {

        try {

            const formData = new FormData();

            formData.append(
                'action',
                'ode_product_table'
            );

            formData.append(
                '_wpnonce',
                this.form.querySelector(
                    '[name="_wpnonce"]'
                ).value
            );

            const response = await fetch(
                ajaxurl,
                {
                    method: 'POST',
                    credentials: 'same-origin',
                    body: formData
                }
            );

            const result = await response.json();

            if (!result.success) {
                throw new Error(
                    result.data.message ??
                    'Erro ao atualizar tabela.'
                );
            }

            const tbody = this.table.querySelector(
                'tbody'
            );

            const parser = new DOMParser();

            const html = parser.parseFromString(
                result.data.html,
                'text/html'
            );

            const newBody = html.querySelector(
                '#ode-product-table tbody'
            );

            if (tbody && newBody) {
                tbody.innerHTML = newBody.innerHTML;
            }

        } catch (error) {

            console.error(error);

            this.toast(
                error.message,
                'error'
            );

        }

    }

    mediaPicker() {

        if (typeof wp === 'undefined' || !wp.media) {
            return;
        }

        if (this.mediaFrame) {

            this.mediaFrame.open();

            return;

        }

        this.mediaFrame = wp.media({

            title: 'Selecionar imagem',

            multiple: false,

            library: {
                type: 'image'
            }

        });

        this.mediaFrame.on(
            'select',
            () => {

                const attachment =
                    this.mediaFrame
                        .state()
                        .get('selection')
                        .first()
                        .toJSON();

                this.form.image_id.value =
                    attachment.id;

                this.form
                    .querySelector('.ode-media-preview')
                    .innerHTML =
                    `<img src="${attachment.url}" alt="">`;

            }
        );

        this.mediaFrame.open();

    }

    generateSlug(text) {

        return text
            .toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');

    }

    initSlug() {

        const input =
            this.form.querySelector(
                '[name="name"]'
            );

        const slug =
            this.form.querySelector(
                '[name="slug"]'
            );

        if (!input || !slug) {
            return;
        }

        input.addEventListener(
            'keyup',
            () => {

                if (
                    slug.value.trim() === ''
                ) {

                    slug.value =
                        this.generateSlug(
                            input.value
                        );

                }

            }
        );

    }

    toast(message, type = 'success') {

        if (
            typeof ODEToast !== 'undefined'
        ) {

            ODEToast.show(
                message,
                type
            );

            return;

        }

        alert(message);

    }

}

document.addEventListener(

    'DOMContentLoaded',

    () => {

        const workspace =
            new ProductWorkspace();

        workspace.initSlug();

    }

);


    


