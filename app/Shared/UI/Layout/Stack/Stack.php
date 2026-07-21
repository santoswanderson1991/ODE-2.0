<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Layout\Stack;

use ODE\Shared\UI\Components\Element\Element;

class Stack extends Element
{
    public function __construct()
    {
        $this->class('ode-stack');
    }

    public function gap(string $gap): static
    {
        $this->attribute(
            'style',
            '--ode-gap:'.$gap
        );

        return $this;
    }

    public function horizontal(): static
    {
        $this->class('ode-stack-horizontal');

        return $this;
    }

    public function vertical(): static
    {
        $this->class('ode-stack-vertical');

        return $this;
    }
}