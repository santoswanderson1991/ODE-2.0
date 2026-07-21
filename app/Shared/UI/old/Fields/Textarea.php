<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Fields;

final class Textarea extends Field
{
    protected int $rows = 5;

    public function rows(int $rows): static
    {
        $this->rows = max(1, $rows);

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

            <textarea
                id="<?= esc_attr($this->id); ?>"
                name="<?= esc_attr($this->name); ?>"
                rows="<?= esc_attr((string) $this->rows); ?>"
                class="large-text ode-textarea"
                placeholder="<?= esc_attr($this->placeholder); ?>"
                <?= $this->required ? 'required' : ''; ?>
                <?= $this->disabled ? 'disabled' : ''; ?>
            ><?= esc_textarea((string) $this->value); ?></textarea>

            <?php if ($this->help !== null) : ?>

                <p class="description">

                    <?= esc_html($this->help); ?>

                </p>

            <?php endif; ?>

        </div>

        <?php
    }
}
