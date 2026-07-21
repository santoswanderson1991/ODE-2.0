<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Core;

use RuntimeException;

final class ViewRenderer
{
    /**
     * Renderiza um template PHP.
     *
     * @param array<string,mixed> $data
     */
    public static function render(
        string $view,
        array $data = []
    ): string {

        if (!file_exists($view)) {
            throw new RuntimeException(
                sprintf('View não encontrada: %s', $view)
            );
        }

        extract($data, EXTR_SKIP);

        ob_start();

        require $view;

        return (string) ob_get_clean();
    }
}