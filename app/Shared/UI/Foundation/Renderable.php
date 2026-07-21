<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Foundation;

interface Renderable
{
    public function render(): string;
}