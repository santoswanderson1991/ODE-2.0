<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Fields;

class Input extends Field implements RenderableField
{
    protected string $type = 'text';

    public function type(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function number(): static
    {
        return $this->type('number');
    }

    public function email(): static
    {
        return $this->type('email');
    }

    public function password(): static
    {
        return $this->type('password');
    }

    public function hidden(): static
    {
        return $this->type('hidden');
    }

    public function render(): void
    {
        ?>

        <div class="ode-field">

            <?php if ($this->label !== '') : ?>

                <label for="<?= esc_attr($this->id); ?>">

                    <?= esc_html($this->label); ?>

                    <?php if ($this->required) : ?>

                        <span class="ode-required">*</span>

                    <?php endif; ?>

                </label>

            <?php endif; ?>

            <input
                id="<?= esc_attr($this->id); ?>"
                name="<?= esc_attr($this->name); ?>"
                type="<?= esc_attr($this->type); ?>"
                value="<?= esc_attr((string) $this->value); ?>"
                placeholder="<?= esc_attr($this->placeholder); ?>"
                <?= $this->required ? 'required' : ''; ?>
                <?= $this->disabled ? 'disabled' : ''; ?>
            >

            <?php if ($this->help !== null) : ?>

                <p class="description">

                    <?= esc_html($this->help); ?>

                </p>

            <?php endif; ?>

        </div>

        <?php
    }
}