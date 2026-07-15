<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category\Ajax;

use ODE\Modules\Catalog\Category\Controllers\CategoryController;

final class CategoryAjax
{
    public function __construct(
        private readonly CategoryController $controller
    ) {
    }

    public function register(): void
    {
        add_action(
            'wp_ajax_ode_category_store',
            [$this, 'store']
        );
    }

    public function store(): void
    {
        check_ajax_referer(
            'ode_admin',
            'nonce'
        );

        if (! current_user_can('manage_options')) {
            wp_send_json_error(
                ['message' => 'Sem permissão.'],
                403
            );
        }

        try {

            $id = $this->controller->store($_POST);

            wp_send_json_success([
                'id' => $id,
                'message' => 'Categoria criada com sucesso.'
            ]);

        } catch (\Throwable $e) {

            wp_send_json_error([
                'message' => $e->getMessage()
            ], 400);

        }
    }
}