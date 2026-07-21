<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Fields;

final class Hidden extends Input
{
    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->hidden();
    }

    public function render(): void
    {
        ?>

        <input
            id="<?= esc_attr($this->id); ?>"
            name="<?= esc_attr($this->name); ?>"
            type="hidden"
            value="<?= esc_attr((string) $this->value); ?>"
        >

        <?php
    }
}