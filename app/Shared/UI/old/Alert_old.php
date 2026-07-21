<?php

declare(strict_types=1);

namespace ODE\Shared\UI;

final class Alert
{
    public static function success(string $message): void
    {
        self::render($message, 'success');
    }

    public static function error(string $message): void
    {
        self::render($message, 'error');
    }

    public static function warning(string $message): void
    {
        self::render($message, 'warning');
    }

    public static function info(string $message): void
    {
        self::render($message, 'info');
    }

    public static function render(
        string $message,
        string $type = 'info',
        bool $dismissible = true
    ): void {

        $class = match ($type) {

            'success' => 'notice notice-success',

            'error' => 'notice notice-error',

            'warning' => 'notice notice-warning',

            default => 'notice notice-info',

        };

        if ($dismissible) {
            $class .= ' is-dismissible';
        }

        ?>

        <div class="<?= esc_attr($class); ?>">

            <p>

                <?= esc_html($message); ?>

            </p>

        </div>

        <?php
    }
}