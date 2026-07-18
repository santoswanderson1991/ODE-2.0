<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Fields;

interface RenderableField
{
    public function render(): void;
}