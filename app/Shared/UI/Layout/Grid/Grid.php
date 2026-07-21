<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Layout\Grid;

use ODE\Shared\UI\Components\Element\Element;

class Grid extends Element
{
    public function __construct()
    {
        $this->class('ode-grid');
    }

    public function columns(
        int $columns
    ): static {

        $this->cssVar(
            '--ode-columns',
            (string) $columns
        );

        return $this;

    }

    public function gap(
        string $gap
    ): static {

        $this->cssVar(
            '--ode-gap',
            $gap
        );

        return $this;

    }

    public function align(
        string $align
    ): static {

        $this->cssVar(
            '--ode-align',
            $align
        );

        return $this;

    }

    public function justify(
        string $justify
    ): static {

        $this->cssVar(
            '--ode-justify',
            $justify
        );

        return $this;

    }
}