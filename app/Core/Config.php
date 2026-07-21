<?php

declare(strict_types=1);

namespace ODE\Core;

final class Config
{
    private string $basePath;

    public function __construct(string $basePath)
    {
        $this->basePath = rtrim($basePath, DIRECTORY_SEPARATOR);
    }

    public function get(string $file, mixed $default = null): mixed
    {
        $path = $this->basePath
            . DIRECTORY_SEPARATOR
            . 'config'
            . DIRECTORY_SEPARATOR
            . $file . '.php';

        if (! file_exists($path)) {
            return $default;
        }

        $config = require $path;

        return is_array($config)
            ? $config
            : $default;
    }
}