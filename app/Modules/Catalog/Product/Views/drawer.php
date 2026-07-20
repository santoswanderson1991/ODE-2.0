<?php

declare(strict_types=1);

/**
 * @var array<int,object> $categories
 */

?>

<div
    id="ode-product-drawer"
    class="ode-drawer"
>

    <form
        id="ode-product-form"
        class="ode-form"
    >

        <?php wp_nonce_field('ode_product'); ?>

        <input
            type="hidden"
            name="action"
            value="ode_product_store"
        >

        <input
            type="hidden"
            name="id"
            value=""
        >

        <div class="ode-drawer-header">

            <h2>

                Produto

            </h2>

        </div>

        <div class="ode-drawer-body">

            <div class="ode-field">

                <label>

                    Categoria

                </label>

                <select
                    name="category_id"
                    required
                >

                    <option value="">

                        Selecione...

                    </option>

                    <?php foreach ($categories as $category) : ?>

                        <option
                            value="<?= (int) $category->id; ?>"
                        >

                            <?= esc_html($category->name); ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="ode-field">

                <label>

                    Nome

                </label>

                <input
                    type="text"
                    name="name"
                    required
                >

            </div>

            <div class="ode-field">

                <label>

                    Slug

                </label>

                <input
                    type="text"
                    name="slug"
                >

            </div>

            <div class="ode-field">

                <label>

                    Descrição

                </label>

                <textarea
                    name="description"
                    rows="4"
                ></textarea>

            </div>

            <div class="ode-grid grid-2">

                <div class="ode-field">

                    <label>

                        Preço

                    </label>

                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        name="price"
                        required
                    >

                </div>

                <div class="ode-field">

                    <label>

                        Promoção

                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="sale_price"
                    >

                </div>

            </div>

            <div class="ode-field ode-media-picker">

                <label>

                    Imagem

                </label>

                <input
                    type="hidden"
                    name="image_id"
                    value=""
                >

                <div
                    class="ode-media-preview"
                ></div>

                <button
                    type="button"
                    class="button"
                    data-media
                >

                    Selecionar imagem

                </button>

            </div>

            <div class="ode-grid grid-2">

                <div class="ode-field">

                    <label>

                        Ordem

                    </label>

                    <input
                        type="number"
                        name="position"
                        value="0"
                    >

                </div>

                <div class="ode-field">

                    <label>

                        Ativo

                    </label>

                    <input
                        type="hidden"
                        name="active"
                        value="0"
                    >

                    <input
                        type="checkbox"
                        name="active"
                        value="1"
                        checked
                    >

                </div>

            </div>

        </div>

        <div class="ode-drawer-footer">

            <button
                class="button button-primary"
                type="submit"
            >

                Salvar Produto

            </button>

        </div>

    </form>

</div>