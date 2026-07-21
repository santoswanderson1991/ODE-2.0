<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Layout\Container;

use ODE\Shared\UI\Components\Element\Element;

class Container extends Element
{
    protected string $tag = 'div';

    public function __construct()
    {
        $this->class('ode-container');
    }

    public function fluid(bool $fluid = true): static
    {
        if ($fluid) {
            $this->class('ode-container-fluid');
        }

        return $this;
    }

    public function render(): string
    {
        return parent::render();
    }
}