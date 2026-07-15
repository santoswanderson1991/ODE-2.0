<?php

declare(strict_types=1);

namespace ODE\Core;

final class Plugin
{
    public function __construct(
        private readonly Application $application
    ) {
    }

    public function boot(): void
    {
        register_activation_hook(
            ODE_PLUGIN_FILE,
            [$this, 'activate']
        );

        register_deactivation_hook(
            ODE_PLUGIN_FILE,
            [$this, 'deactivate']
        );

        add_action(
            'plugins_loaded',
            [$this, 'loaded']
        );

        add_action(
            'init',
            [$this, 'init']
        );
    }

    public function activate(): void
    {
        do_action('ode_activate');
    }

    public function deactivate(): void
    {
        do_action('ode_deactivate');
    }

    public function loaded(): void
    {
        do_action('ode_loaded');
    }

    public function init(): void
    {
        do_action('ode_init');
    }
}