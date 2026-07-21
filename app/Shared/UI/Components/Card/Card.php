<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Layout\Card;

use ODE\Shared\UI\Layout\Container\Container;

class Card extends Container
{
    public function __construct()
    {
        parent::__construct();

        $this->class('ode-card');
    }

    public function padding(string $size = 'md'): static
    {
        $this->class('ode-card-padding-'.$size);

        return $this;
    }

    public function shadow(string $size = 'md'): static
    {
        $this->class('ode-shadow-'.$size);

        return $this;
    }

    public function rounded(string $size = 'md'): static
    {
        $this->class('ode-radius-'.$size);

        return $this;
    }
}