<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Product\Ajax;

use Throwable;
use ODE\Modules\Catalog\Product\Controllers\ProductController;

final class ProductAjax
{
    public function __construct(
        private readonly ProductController $controller,
    ) {
    }

    public function register(): void
    {
        add_action(
            'wp_ajax_ode_product_store',
            [$this, 'store']
        );

        add_action(
            'wp_ajax_ode_product_update',
            [$this, 'update']
        );

        add_action(
            'wp_ajax_ode_product_delete',
            [$this, 'delete']
        );

        add_action(
            'wp_ajax_ode_product_find',
            [$this, 'find']
        );

        add_action(
            'wp_ajax_ode_product_table',
            [$this, 'table']
        );
    }

    public function store(): void
    {
        check_ajax_referer('ode_product');

        try {

            $product = $this->controller->store($_POST);

            wp_send_json_success($product);

        } catch (Throwable $e) {

            wp_send_json_error([
                'message' => $e->getMessage(),
            ]);

        }
    }

    public function update(): void
    {
        check_ajax_referer('ode_product');

        try {

            $product = $this->controller->update($_POST);

            wp_send_json_success($product);

        } catch (Throwable $e) {

            wp_send_json_error([
                'message' => $e->getMessage(),
            ]);

        }
    }

    public function delete(): void
    {
        check_ajax_referer('ode_product');

        try {

            $this->controller->destroy(
                (int) ($_POST['id'] ?? 0)
            );

            wp_send_json_success();

        } catch (Throwable $e) {

            wp_send_json_error([
                'message' => $e->getMessage(),
            ]);

        }
    }

    public function find(): void
    {
        check_ajax_referer('ode_product');

        try {

            $product = $this->controller->find(
                (int) ($_POST['id'] ?? 0)
            );

            wp_send_json_success($product);

        } catch (Throwable $e) {

            wp_send_json_error([
                'message' => $e->getMessage(),
            ]);

        }
    }

     public function table(): void
    {
        check_ajax_referer('ode_product');

        try {

            $products = $this->controller->index();

            ob_start();

            require dirname(__DIR__) . '/Views/partials/table.php';

            $html = ob_get_clean();

            wp_send_json_success([
                'html' => $html,
            ]);

        } catch (Throwable $e) {

            if (ob_get_level() > 0) {
                ob_end_clean();
            }

            wp_send_json_error([
                'message' => $e->getMessage(),
            ]);
        }
    }
}