<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Core;

final class AssetManager
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
        string $path
    ): void {

        self::$styles[$handle] = $path;
    }

    public static function script(
        string $handle,
        string $path
    ): void {

        self::$scripts[$handle] = $path;
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

    public static function hasStyle(string $handle): bool
    {
        return isset(self::$styles[$handle]);
    }

    public static function hasScript(string $handle): bool
    {
        return isset(self::$scripts[$handle]);
    }

    public static function reset(): void
    {
        self::$styles = [];
        self::$scripts = [];
    }
}