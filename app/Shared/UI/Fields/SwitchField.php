<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Fields;

final class SwitchField extends BooleanField
{
    public function render(): void
    {
        ?>

        <div class="ode-field ode-switch">

            <label class="ode-switch-wrapper">

                <input
                    type="checkbox"
                    id="<?= esc_attr($this->id); ?>"
                    name="<?= esc_attr($this->name); ?>"
                    value="1"
                    <?= checked($this->checked, true, false); ?>
                    <?= $this->disabled ? 'disabled' : ''; ?>
                >

                <span class="ode-switch-slider"></span>

                <span class="ode-switch-label">

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