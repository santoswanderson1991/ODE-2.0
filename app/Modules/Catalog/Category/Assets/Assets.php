<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category\Assets;

final class Assets
{
    public function register(): void
    {
        add_action(
            'admin_enqueue_scripts',
            [$this, 'enqueue']
        );
    }

    public function enqueue(string $hook): void
    {
        if (!$this->shouldLoad($hook)) {
            return;
        }

        wp_enqueue_style(
            'ode-category',
            ODE_PLUGIN_URL . 'app/resources/modules/category/category.css',
            ['ode-ui'],
            ODE_VERSION
        );

        wp_enqueue_script(
            'ode-category',
            ODE_PLUGIN_URL . 'app/resources/modules/category/category.js',
            ['ode-ui'],
            ODE_VERSION,
            true
        );

        wp_localize_script(
            'ode-category',
            'ODECategoryConfig',
            [
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'nonce'   => wp_create_nonce('ode_category'),
            ]
        );
    }

    private function shouldLoad(string $hook): bool
    {
        if (!isset($_GET['page'])) {
            return false;
        }

        return $_GET['page'] === 'ode-categories';
    }
}