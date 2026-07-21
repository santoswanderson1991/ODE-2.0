'use strict';

class ODEDataTable {

    constructor(selector) {

        this.table = document.querySelector(selector);

        if (!this.table) {
            return;
        }

        this.body = this.table.querySelector('tbody');

    }

    replace(html) {

        this.body.innerHTML = html;

    }

    append(html) {

        this.body.insertAdjacentHTML(
            'beforeend',
            html
        );

    }

    prepend(html) {

        this.body.insertAdjacentHTML(
            'afterbegin',
            html
        );

    }

    remove(id) {

        const row = this.body.querySelector(
            `[data-id="${id}"]`
        );

        if (row) {
            row.remove();
        }

    }

    clear() {

        this.body.innerHTML = '';

    }

}