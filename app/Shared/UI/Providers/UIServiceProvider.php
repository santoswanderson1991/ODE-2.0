<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Providers;

use ODE\Shared\UI\Support\AssetRegistry;

final class UIServiceProvider
{
    public function boot(): void
    {
        add_action(
            'wp_enqueue_scripts',
            [$this, 'enqueue']
        );

        add_action(
            'admin_enqueue_scripts',
            [$this, 'enqueue']
        );
    }

    public function enqueue(): void
    {
        foreach (AssetRegistry::styles() as $handle => $file) {

            wp_enqueue_style(
                $handle,
                $file,
                [],
                ODE_VERSION
            );

        }

        foreach (AssetRegistry::scripts() as $handle => $file) {

            wp_enqueue_script(
                $handle,
                $file,
                [],
                ODE_VERSION,
                true
            );

        }
    }
}