<?php

declare(strict_types=1);

namespace ODE\Shared\UI;

final class Badge
{
    public static function render(
        string $label,
        string $type = 'default'
    ): void {

        $class = match ($type) {

            'success' => 'ode-badge-success',

            'danger' => 'ode-badge-danger',

            'warning' => 'ode-badge-warning',

            'info' => 'ode-badge-info',

            'primary' => 'ode-badge-primary',

            default => 'ode-badge-default',

        };

        ?>

        <span class="ode-badge <?= esc_attr($class); ?>">

            <?= esc_html($label); ?>

        </span>

        <?php
    }

    public static function success(string $label): void
    {
        self::render($label, 'success');
    }

    public static function danger(string $label): void
    {
        self::render($label, 'danger');
    }

    public static function warning(string $label): void
    {
        self::render($label, 'warning');
    }

    public static function info(string $label): void
    {
        self::render($label, 'info');
    }

    public static function primary(string $label): void
    {
        self::render($label, 'primary');
    }

    public static function boolean(
        bool $value,
        string $trueLabel = 'Ativo',
        string $falseLabel = 'Inativo'
    ): void {

        if ($value) {

            self::success($trueLabel);

            return;
        }

        self::danger($falseLabel);
    }
}