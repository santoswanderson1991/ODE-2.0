<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Components\Form\Inputs;

use ODE\Shared\UI\Support\View;

final class InputView
{
    /**
     * @param array<string,mixed> $data
     */
    public static function render(
        array $data
    ): string {

        return View::render(
            __DIR__ . '/Resources/input.php',
            $data
        );

    }
}