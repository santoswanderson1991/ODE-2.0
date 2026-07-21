<?php

declare(strict_types=1);

namespace ODE\Shared\UI;

final class Workspace
{
    public static function begin(
        string $title,
        ?string $description = null,
        bool $card = true
    ): void {

        Page::begin(
            $title,
            $description
        );

        if ($card) {
            Card::begin();
        }
    }

    public static function end(
        bool $card = true
    ): void {

        if ($card) {
            Card::end();
        }

        Page::end();
    }
}