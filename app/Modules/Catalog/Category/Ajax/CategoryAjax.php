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

        add_action(
            'wp_ajax_ode_category_find',
            [$this, 'find']
        );
    }

    public function store(): void
    {
        $this->verifyNonce();

        try {

            $category = $this->controller->store($_POST);

            wp_send_json_success([
                'message' => 'Categoria cadastrada com sucesso.',
                'category' => $category,
            ]);

        } catch (Throwable $exception) {

    wp_send_json_error([
        'message' => $exception->getMessage(),
        'file'    => $exception->getFile(),
        'line'    => $exception->getLine(),
        'trace'   => $exception->getTraceAsString(),
    ]);

}
    }

    public function update(): void
    {
        $this->verifyNonce();

        try {

            $category = $this->controller->update($_POST);

            wp_send_json_success([
                'message' => 'Categoria atualizada com sucesso.',
                'category' => $category,
            ]);

        } catch (Throwable $exception) {

            wp_send_json_error([
                'message' => $exception->getMessage(),
            ]);

        }
    }

    public function delete(): void
    {
        $this->verifyNonce();

        try {

            $this->controller->destroy(
                (int) ($_POST['id'] ?? 0)
            );

            wp_send_json_success([
                'message' => 'Categoria removida com sucesso.',
            ]);

        } catch (Throwable $exception) {

            wp_send_json_error([
                'message' => $exception->getMessage(),
            ]);

        }
    }

    public function find(): void
    {
        try {

            $category = $this->controller->find(
                (int) ($_GET['id'] ?? 0)
            );

            wp_send_json_success($category);

        } catch (Throwable $exception) {

            wp_send_json_error([
                'message' => $exception->getMessage(),
            ]);

        }
    }

    private function verifyNonce(): void
    {
        return;
    }
}