<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Fields;

final class Checkbox extends BooleanField
{
    protected bool $checked = false;

    public function checked(bool $checked = true): static
    {
        $this->checked = $checked;

        return $this;
    }

    public function render(): void
    {
        ?>

        <div class="ode-field ode-checkbox">

            <label>

                <input
                    type="checkbox"
                    id="<?= esc_attr($this->id); ?>"
                    name="<?= esc_attr($this->name); ?>"
                    value="1"
                    <?= checked($this->checked, true, false); ?>
                    <?= $this->required ? 'required' : ''; ?>
                    <?= $this->disabled ? 'disabled' : ''; ?>
                >

                <span>

                    <?= esc_html($this->label); ?>

                    <?php if ($this->required) : ?>

                        <span class="ode-required">*</span>

                    <?php endif; ?>

                </span>

            </label>

            <?php if ($this->help !== null) : ?>

                <p class="description">

                    <?= esc_html($this->help); ?>

                </p>

            <?php endif; ?>

        </div>

        <?php
    }
}