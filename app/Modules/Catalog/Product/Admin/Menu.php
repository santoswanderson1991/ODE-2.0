<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Product\Admin;

use ODE\Core\Container;
use ODE\Modules\Catalog\Category\Controllers\CategoryController;
use ODE\Modules\Catalog\Product\Controllers\ProductController;

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
        add_submenu_page(
            parent_slug: 'ode',
            page_title: 'Produtos',
            menu_title: 'Produtos',
            capability: 'manage_options',
            menu_slug: 'ode-products',
            callback: [$this, 'products']
        );
    }

    public function products(): void
    {
        /** @var ProductController $productController */
        $productController = $this->container->get(
            ProductController::class
        );

        /** @var CategoryController $categoryController */
        $categoryController = $this->container->get(
            CategoryController::class
        );

        $products = $productController->index();

        $categories = $categoryController->index();

        $view = dirname(__DIR__) . '/Views/index.php';

        if (! file_exists($view)) {
            wp_die('View não encontrada.');
        }

        require $view;
    }
}