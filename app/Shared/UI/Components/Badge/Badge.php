<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Components\Badge;

final class Badge
{
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

    public static function boolean(bool $status): void
    {
        self::render(
            $status ? 'Ativo' : 'Inativo',
            $status ? 'success' : 'danger'
        );
    }

    private static function render(
        string $label,
        string $type
    ): void {

        ?>

        <span class="ode-badge ode-badge-<?= esc_attr($type); ?>">

            <?= esc_html($label); ?>

        </span>

        <?php

    }
}