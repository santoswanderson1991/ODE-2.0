<?php

declare(strict_types=1);

use ODE\Shared\UI\Workspace;
use ODE\Shared\UI\Toolbar;
use ODE\Shared\UI\Table;
use ODE\Shared\UI\Drawer;
use ODE\Shared\UI\Form;
use ODE\Shared\UI\Button;

use ODE\Shared\UI\Fields\Hidden;
use ODE\Shared\UI\Fields\Input;
use ODE\Shared\UI\Fields\Textarea;
use ODE\Shared\UI\Fields\SwitchField;

/**
 * @var array<ODE\Modules\Catalog\Category\Entities\Category> $categories
 */

Workspace::begin(
    'Categorias',
    'Gerencie as categorias do catálogo.'
);

Toolbar::render(
    actions: [
        [
            'label' => 'Nova Categoria',
            'id' => 'ode-new-category',
            'class' => 'button button-primary',
            'icon' => 'dashicons-plus-alt2',
        ],
    ]
);

$rows = [];

foreach ($categories as $category) {

    $rows[] = [

        'id'       => $category->id,

        'name'     => $category->name,

        'slug'     => $category->slug,

        'position' => $category->position,

        'status'   => $category->active
            ? 'Ativa'
            : 'Inativa',

    ];

}

Table::render(

    columns: [

        'id'       => 'ID',

        'name'     => 'Nome',

        'slug'     => 'Slug',

        'position' => 'Ordem',

        'status'   => 'Status',

    ],

    rows: $rows,

    actions: function(array $row) {

        ?>

        <button
            class="button button-small"
            data-action="edit"
            data-id="<?= esc_attr((string) $row['id']); ?>"
        >

            Editar

        </button>

        <button
            class="button button-small button-link-delete"
            data-action="delete"
            data-id="<?= esc_attr((string) $row['id']); ?>"
        >

            Excluir

        </button>

        <?php

    }

);

Drawer::begin(

    id: 'category-drawer',

    title: 'Categoria',

    description: 'Cadastro de categoria.'

);

Form::begin(

    attributes: [

        'id' => 'ode-category-form'

    ]

);

Hidden::make('action')
    ->value('ode_category_store')
    ->render();

Hidden::make('_wpnonce')
    ->value(wp_create_nonce('ode_category'))
    ->render();

Hidden::make('id')
    ->render();

Input::make('name')
    ->label('Nome')
    ->required()
    ->render();

Input::make('slug')
    ->label('Slug')
    ->render();

Textarea::make('description')
    ->label('Descrição')
    ->rows(5)
    ->render();

Input::make('position')
    ->number()
    ->label('Ordem')
    ->value(0)
    ->render();

SwitchField::make('active')
    ->label('Categoria ativa')
    ->checked()
    ->render();

Button::primary(

    'Salvar Categoria',

    [

        'type' => 'submit',

        'icon' => 'dashicons-saved',

    ]

);

Form::end();

Drawer::end();

Workspace::end();