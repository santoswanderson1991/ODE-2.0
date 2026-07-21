<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Product\Assets;

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
        if (! $this->shouldLoad()) {
            return;
        }

        wp_enqueue_style(
            'ode-product',
            ODE_PLUGIN_URL . 'app/Modules/Catalog/Product/Assets/product.css',
            ['ode-ui'],
            ODE_VERSION
        );

        wp_enqueue_script(
            'ode-product',
            ODE_PLUGIN_URL . 'app/Modules/Catalog/Product/Assets/product.js',
            ['ode-ui'],
            ODE_VERSION,
            true
        );

        wp_localize_script(
            'ode-product',
            'ODEProductConfig',
            [
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'nonce'   => wp_create_nonce('ode_product'),
            ]
        );
    }

    private function shouldLoad(): bool
    {
        return isset($_GET['page'])
            && $_GET['page'] === 'ode-products';
    }
}