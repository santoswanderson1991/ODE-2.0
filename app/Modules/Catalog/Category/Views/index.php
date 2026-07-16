<?php

declare(strict_types=1);

/**
 * @var array<ODE\Modules\Catalog\Category\Entities\Category> $categories
 */

if (! defined('ABSPATH')) {
    exit;
}
?>

<div class="wrap ode-page">

    <div class="ode-page-header">

        <div>

            <h1 class="wp-heading-inline">
                Categorias
            </h1>

            <p>
                Gerencie as categorias do catálogo.
            </p>

        </div>

        <button
            class="button button-primary"
            id="ode-new-category"
        >
            Nova Categoria
        </button>

    </div>

    <div id="ode-category-form"></div>

    <div id="ode-category-table">

        <?php

        require __DIR__ . '/table.php';

        ?>

    </div>

</div>