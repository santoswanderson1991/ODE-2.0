<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Fields;

abstract class BooleanField extends Field
{
    protected bool $checked = false;

    public function checked(bool $checked = true): static
    {
        $this->checked = $checked;

        return $this;
    }
}