<?php

declare(strict_types=1);

use ODE\Shared\UI\Table;
use ODE\Shared\UI\Badge;

/**
 * @var array<ODE\Modules\Catalog\Category\Entities\Category> $categories
 */

$rows = [];

foreach ($categories as $category) {

    $rows[] = [

        'id'       => $category->id,

        'name'     => $category->name,

        'slug'     => $category->slug,

        'position' => $category->position,

        'active'   => $category->active,

    ];

}

Table::render(

    columns: [

        'id'       => 'ID',

        'name'     => 'Nome',

        'slug'     => 'Slug',

        'position' => 'Ordem',

        'active'   => 'Status',

    ],

    rows: $rows,

    actions: function(array $row) {

        ?>

        <button
            class="button button-small ode-edit"
            data-id="<?= esc_attr((string) $row['id']); ?>"
        >
            Editar
        </button>

        <button
            class="button button-small button-link-delete ode-delete"
            data-id="<?= esc_attr((string) $row['id']); ?>"
        >
            Excluir
        </button>

        <?php

    }

);