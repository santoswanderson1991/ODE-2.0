<?php

declare(strict_types=1);

namespace ODE\Core\Contracts;

use ODE\Core\Container;

interface ModuleInterface
{
    public function register(Container $container): void;

    public function boot(Container $container): void;
}