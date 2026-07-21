<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Fields;

final class Money extends Input
{
    protected string $currency = 'R$';

    protected int $decimals = 2;

    public function currency(string $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function decimals(int $decimals): static
    {
        $this->decimals = max(0, $decimals);

        return $this;
    }

    public function render(): void
    {
        ?>

        <div class="ode-field">

            <?php if ($this->label !== '') : ?>

                <label
                    for="<?= esc_attr($this->id); ?>"
                    class="ode-label"
                >

                    <?= esc_html($this->label); ?>

                    <?php if ($this->required) : ?>

                        <span class="ode-required">*</span>

                    <?php endif; ?>

                </label>

            <?php endif; ?>

            <div class="ode-money-field">

                <span class="ode-money-prefix">

                    <?= esc_html($this->currency); ?>

                </span>

                <input
                    type="text"
                    id="<?= esc_attr($this->id); ?>"
                    name="<?= esc_attr($this->name); ?>"
                    value="<?= esc_attr((string) $this->value); ?>"
                    placeholder="<?= esc_attr($this->placeholder); ?>"
                    class="regular-text ode-money"
                    data-decimals="<?= esc_attr((string) $this->decimals); ?>"
                    <?= $this->required ? 'required' : ''; ?>
                    <?= $this->disabled ? 'disabled' : ''; ?>
                >

            </div>

            <?php if ($this->help !== null) : ?>

                <p class="description">

                    <?= esc_html($this->help); ?>

                </p>

            <?php endif; ?>

        </div>

        <?php
    }
}