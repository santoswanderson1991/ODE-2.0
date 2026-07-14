<?php

declare(strict_types=1);

namespace ODE\Core;

abstract class ServiceProvider
{
    public function register(Container $container): void
    {
    }

    public function boot(Container $container): void
    {
    }
}