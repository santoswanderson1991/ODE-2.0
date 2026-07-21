<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Support;

final class AssetRegistry
{
    /**
     * @var array<string,string>
     */
    private static array $styles = [];

    /**
     * @var array<string,string>
     */
    private static array $scripts = [];

    public static function style(
        string $handle,
        string $file
    ): void {

        self::$styles[$handle] = $file;

    }

    public static function script(
        string $handle,
        string $file
    ): void {

        self::$scripts[$handle] = $file;

    }

    /**
     * @return array<string,string>
     */
    public static function styles(): array
    {
        return self::$styles;
    }

    /**
     * @return array<string,string>
     */
    public static function scripts(): array
    {
        return self::$scripts;
    }

    public static function reset(): void
    {
        self::$styles = [];
        self::$scripts = [];
    }
}