<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Fields;

final class Select extends Field
{
    /**
     * @param array<string,string> $options
     */
    public static function render(
        string $name,
        string $label,
        array $options,
        string $selected = '',
        array $attributes = [],
    ): void {

        $id = $attributes['id'] ?? $name;

        ?>

        <div class="ode-field">

            <label
                class="ode-label"
                for="<?= esc_attr($id); ?>"
            >
                <?= esc_html($label); ?>
            </label>

            <select
                id="<?= esc_attr($id); ?>"
                name="<?= esc_attr($name); ?>"
                class="ode-select"
            >

                <?php foreach ($options as $value => $text) : ?>

                    <option
                        value="<?= esc_attr($value); ?>"
                        <?= selected($selected, (string) $value); ?>
                    >
                        <?= esc_html($text); ?>
                    </option>

                <?php endforeach; ?>

            </select>

        </div>

        <?php
    }
}