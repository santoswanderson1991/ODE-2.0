<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category\Admin;

use ODE\Core\Container;
use ODE\Modules\Catalog\Category\Controllers\CategoryController;

final class Menu
{
    public function __construct(
        private readonly Container $container,
    ) {
    }

    public function register(): void
    {
        add_action(
            'admin_menu',
            [$this, 'menu']
        );
    }

    public function menu(): void
    {
        add_menu_page(
            page_title: 'Olegário Delivery',
            menu_title: 'Olegário Delivery',
            capability: 'manage_options',
            menu_slug: 'ode',
            callback: [$this, 'dashboard'],
            icon_url: 'dashicons-store',
            position: 26
        );

        add_submenu_page(
            parent_slug: 'ode',
            page_title: 'Categorias',
            menu_title: 'Categorias',
            capability: 'manage_options',
            menu_slug: 'ode-categories',
            callback: [$this, 'categories']
        );
    }

    public function dashboard(): void
    {
        echo '<div id="ode-dashboard"></div>';
    }

    public function categories(): void
    {
        $controller = $this->container->get(
            CategoryController::class
        );

        $categories = $controller->index();

        $view = dirname(__DIR__) . '/Views/index.php';

        if (! file_exists($view)) {
            wp_die('View não encontrada.');
        }

        require $view;
    }
}