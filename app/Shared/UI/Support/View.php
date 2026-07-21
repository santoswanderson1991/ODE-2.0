<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Support;

use RuntimeException;

final class View
{
    /**
     * @param array<string,mixed> $data
     */
    public static function render(
        string $view,
        array $data = []
    ): string {

        if (!is_file($view)) {

            throw new RuntimeException(
                sprintf(
                    'View "%s" não encontrada.',
                    $view
                )
            );

        }

        extract(
            $data,
            EXTR_SKIP
        );

        ob_start();

        require $view;

        return (string) ob_get_clean();

    }
}