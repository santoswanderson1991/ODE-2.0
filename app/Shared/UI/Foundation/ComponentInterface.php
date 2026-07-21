<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Foundation;

interface ComponentInterface
{
    public static function make(): static;

    public function render(): string;
}