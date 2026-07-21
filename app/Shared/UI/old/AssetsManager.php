<?php

declare(strict_types=1);

namespace ODE\Shared\UI;

final class AssetsManager
{
    public function register(): void
    {
        add_action(
            'admin_enqueue_scripts',
            [$this, 'enqueue']
        );
    }

    public function enqueue(): void
    {
        wp_enqueue_style(
            'ode-ui',
            ODE_PLUGIN_URL . 'app/resources/ui/ui.css',
            [],
            ODE_VERSION
        );

        wp_enqueue_script(
            'ode-ui',
            ODE_PLUGIN_URL . 'app/resources/ui/ui.js',
            ['jquery'],
            ODE_VERSION,
            true
        );

        wp_enqueue_script(
            'ode-drawer',
            ODE_PLUGIN_URL . 'app/resources/ui/drawer.js',
            ['ode-ui'],
            ODE_VERSION,
            true
        );

        wp_enqueue_script(
            'ode-form',
            ODE_PLUGIN_URL . 'app/resources/ui/form.js',
            ['ode-ui'],
            ODE_VERSION,
            true
        );

        wp_enqueue_script(
            'ode-table',
            ODE_PLUGIN_URL . 'app/resources/ui/table.js',
            ['ode-ui'],
            ODE_VERSION,
            true
        );

        wp_enqueue_script(
            'ode-search',
            ODE_PLUGIN_URL . 'app/resources/ui/search.js',
            ['ode-ui'],
            ODE_VERSION,
            true
        );

        wp_enqueue_script(
            'ode-media',
            ODE_PLUGIN_URL . 'app/resources/ui/media.js',
            ['ode-ui'],
            ODE_VERSION,
            true
        );

        wp_enqueue_media();

        wp_localize_script(
            'ode-ui',
            'ODE',
            [
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'nonce'   => wp_create_nonce('ode'),
            ]
        );
    }
}