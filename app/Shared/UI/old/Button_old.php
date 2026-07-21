<?php

declare(strict_types=1);

namespace ODE\Shared\UI;

final class Button
{
    /**
     * @param array<string,mixed> $attributes
     */
    public static function render(
        string $label,
        array $attributes = []
    ): void {

        $type = $attributes['type'] ?? 'button';

        $class = $attributes['class']
            ?? 'button';

        $id = $attributes['id']
            ?? '';

        $icon = $attributes['icon']
            ?? null;

        $disabled = ! empty($attributes['disabled']);

        ?>

        <button
            type="<?= esc_attr($type); ?>"
            class="<?= esc_attr($class); ?>"
            id="<?= esc_attr($id); ?>"
            <?= $disabled ? 'disabled' : ''; ?>
        >

            <?php if ($icon) : ?>

                <span
                    class="dashicons <?= esc_attr($icon); ?>"
                ></span>

            <?php endif; ?>

            <?= esc_html($label); ?>

        </button>

        <?php
    }

    public static function primary(
        string $label,
        array $attributes = []
    ): void {

        $attributes['class'] =
            ($attributes['class'] ?? '')
            . ' button button-primary';

        self::render($label, $attributes);
    }

    public static function secondary(
        string $label,
        array $attributes = []
    ): void {

        $attributes['class'] =
            ($attributes['class'] ?? '')
            . ' button';

        self::render($label, $attributes);
    }

    public static function danger(
        string $label,
        array $attributes = []
    ): void {

        $attributes['class'] =
            ($attributes['class'] ?? '')
            . ' button button-link-delete';

        self::render($label, $attributes);
    }

    public static function icon(
        string $icon,
        string $label,
        array $attributes = []
    ): void {

        $attributes['icon'] = $icon;

        self::render($label, $attributes);
    }
}