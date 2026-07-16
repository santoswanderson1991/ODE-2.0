<?php

declare(strict_types=1);

namespace ODE;

use ODE\Core\Application;

function bootstrap(): void
{
    static $app = null;

    if ($app instanceof Application) {
        return;
    }

    $app = new Application(
        ODE_PLUGIN_PATH
    );

    $app->boot();
}