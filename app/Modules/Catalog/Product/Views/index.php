<?php

declare(strict_types=1);

use ODE\Shared\UI\Components\Workspace\Workspace;
use ODE\Shared\UI\Components\Toolbar\Toolbar;
use ODE\Shared\UI\Components\Button\Button;

/**
 * @var array<int,object> $products
 */

Workspace::begin(
    'Produtos',
    'Gerencie os produtos do catálogo.'
);

Toolbar::begin();

Button::primary(
    'Novo Produto',
    'ode-new-product'
);

Toolbar::end();

require __DIR__ . '/partials/table.php';

require __DIR__ . '/drawer.php';

Workspace::end();