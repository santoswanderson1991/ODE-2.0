<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Fields;

final class Select extends Field
{
    /**
     * @var array<string|int,mixed>
     */
    protected array $options = [];

    protected bool $multiple = false;

    public function options(array $options): static
    {
        $this->options = $options;

        return $this;
    }

    public function multiple(bool $multiple = true): static
    {
        $this->multiple = $multiple;

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

            <select
                id="<?= esc_attr($this->id); ?>"
                name="<?= esc_attr($this->name); ?><?= $this->multiple ? '[]' : ''; ?>"
                class="ode-select regular-text"
                <?= $this->multiple ? 'multiple' : ''; ?>
                <?= $this->required ? 'required' : ''; ?>
                <?= $this->disabled ? 'disabled' : ''; ?>
            >

                <?php if (! $this->multiple) : ?>

                    <option value="">

                        <?= esc_html($this->placeholder ?: 'Selecione'); ?>

                    </option>

                <?php endif; ?>

                <?php foreach ($this->options as $value => $label) : ?>

                    <?php if (is_array($label)) : ?>

                        <optgroup
                            label="<?= esc_attr((string) $value); ?>"
                        >

                            <?php foreach ($label as $groupValue => $groupLabel) : ?>

                                <option
                                    value="<?= esc_attr((string) $groupValue); ?>"
                                    <?= selected($this->value, $groupValue, false); ?>
                                >

                                    <?= esc_html((string) $groupLabel); ?>

                                </option>

                            <?php endforeach; ?>

                        </optgroup>

                    <?php else : ?>

                        <option
                            value="<?= esc_attr((string) $value); ?>"
                            <?= selected($this->value, $value, false); ?>
                        >

                            <?= esc_html((string) $label); ?>

                        </option>

                    <?php endif; ?>

                <?php endforeach; ?>

            </select>

            <?php if ($this->help !== null) : ?>

                <p class="description">

                    <?= esc_html($this->help); ?>

                </p>

            <?php endif; ?>

        </div>

        <?php
    }
}