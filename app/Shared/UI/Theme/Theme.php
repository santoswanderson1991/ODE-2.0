<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Theme;

final class Theme
{
    public const PRIMARY = 'ode-primary';
    public const SECONDARY = 'ode-secondary';
    public const SUCCESS = 'ode-success';
    public const WARNING = 'ode-warning';
    public const DANGER = 'ode-danger';

    public static function color(string $token): string
    {
        return sprintf('var(--%s)', $token);
    }

    public static function radius(string $size = 'md'): string
    {
        return sprintf('var(--ode-radius-%s)', $size);
    }

    public static function shadow(string $size = 'md'): string
    {
        return sprintf('var(--ode-shadow-%s)', $size);
    }
}