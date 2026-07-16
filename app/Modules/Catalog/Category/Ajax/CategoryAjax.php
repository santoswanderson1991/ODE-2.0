<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category\Ajax;

use Throwable;
use ODE\Modules\Catalog\Category\Controllers\CategoryController;

final class CategoryAjax
{
    public function __construct(
        private readonly CategoryController $controller,
    ) {
    }

    public function register(): void
    {
        add_action(
            'wp_ajax_ode_category_index',
            [$this, 'index']
        );

        add_action(
            'wp_ajax_ode_category_store',
            [$this, 'store']
        );

        add_action(
            'wp_ajax_ode_category_update',
            [$this, 'update']
        );

        add_action(
            'wp_ajax_ode_category_delete',
            [$this, 'delete']
        );
    }

    public function index(): void
    {
        try {

            wp_send_json_success(
                $this->controller->index()
            );

        } catch (Throwable $e) {

            wp_send_json_error(
                [
                    'message' => $e->getMessage(),
                ],
                500
            );

        }
    }

    public function store(): void
    {
        try {

            $category = $this->controller->store($_POST);

            wp_send_json_success($category);

        } catch (Throwable $e) {

            wp_send_json_error(
                [
                    'message' => $e->getMessage(),
                ],
                500
            );

        }
    }

    public function update(): void
    {
        try {

            $category = $this->controller->update($_POST);

            wp_send_json_success($category);

        } catch (Throwable $e) {

            wp_send_json_error(
                [
                    'message' => $e->getMessage(),
                ],
                500
            );

        }
    }

    public function delete(): void
    {
        try {

            $id = (int) ($_POST['id'] ?? 0);

            $this->controller->destroy($id);

            wp_send_json_success();

        } catch (Throwable $e) {

            wp_send_json_error(
                [
                    'message' => $e->getMessage(),
                ],
                500
            );

        }
    }
}