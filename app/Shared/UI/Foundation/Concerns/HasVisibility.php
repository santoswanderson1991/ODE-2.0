<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Foundation\Concerns;

trait HasVisibility
{
    protected bool $visible = true;

    public function show(): static
    {
        $this->visible = true;

        return $this;
    }

    public function hide(): static
    {
        $this->visible = false;

        return $this;
    }

    public function isVisible(): bool
    {
        return $this->visible;
    }
}