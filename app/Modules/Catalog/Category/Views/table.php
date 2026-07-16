<?php

declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}
?>

<table class="widefat striped fixed">

    <thead>

    <tr>

        <th width="60">
            ID
        </th>

        <th>
            Nome
        </th>

        <th>
            Slug
        </th>

        <th width="90">
            Ordem
        </th>

        <th width="90">
            Status
        </th>

        <th width="180">
            Ações
        </th>

    </tr>

    </thead>

    <tbody>

    <?php if (empty($categories)) : ?>

        <tr>

            <td colspan="6">

                Nenhuma categoria cadastrada.

            </td>

        </tr>

    <?php else : ?>

        <?php foreach ($categories as $category) : ?>

            <tr>

                <td>

                    <?= esc_html((string) $category->id) ?>

                </td>

                <td>

                    <?= esc_html($category->name) ?>

                </td>

                <td>

                    <?= esc_html($category->slug) ?>

                </td>

                <td>

                    <?= esc_html((string) $category->position) ?>

                </td>

                <td>

                    <?php if ($category->active) : ?>

                        <span class="dashicons dashicons-yes-alt"></span>

                    <?php else : ?>

                        <span class="dashicons dashicons-dismiss"></span>

                    <?php endif; ?>

                </td>

                <td>

                    <button
                        class="button button-small ode-edit"
                        data-id="<?= esc_attr((string) $category->id) ?>"
                    >
                        Editar
                    </button>

                    <button
                        class="button button-small button-link-delete ode-delete"
                        data-id="<?= esc_attr((string) $category->id) ?>"
                    >
                        Excluir
                    </button>

                </td>

            </tr>

        <?php endforeach; ?>

    <?php endif; ?>

    </tbody>

</table>