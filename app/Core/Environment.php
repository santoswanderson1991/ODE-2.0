<?php

declare(strict_types=1);

namespace ODE\Core;

final class Environment
{
    private string $basePath;

    public function __construct(string $basePath)
    {
        $this->basePath = rtrim($basePath, DIRECTORY_SEPARATOR);
    }

    public function basePath(string $path = ''): string
    {
        return $this->join($this->basePath, $path);
    }

    public function appPath(string $path = ''): string
    {
        return $this->join(
            $this->basePath('app'),
            $path
        );
    }

    public function configPath(string $path = ''): string
    {
        return $this->join(
            $this->basePath('config'),
            $path
        );
    }

    public function storagePath(string $path = ''): string
    {
        return $this->join(
            $this->basePath('storage'),
            $path
        );
    }

    public function bootstrapPath(string $path = ''): string
    {
        return $this->join(
            $this->basePath('bootstrap'),
            $path
        );
    }

    public function databasePath(string $path = ''): string
    {
        return $this->join(
            $this->basePath('database'),
            $path
        );
    }

    public function publicPath(string $path = ''): string
    {
        return $this->join(
            $this->basePath('public'),
            $path
        );
    }

    public function testsPath(string $path = ''): string
    {
        return $this->join(
            $this->basePath('tests'),
            $path
        );
    }

    public function docsPath(string $path = ''): string
    {
        return $this->join(
            $this->basePath('docs'),
            $path
        );
    }

    public function isWindows(): bool
    {
        return PHP_OS_FAMILY === 'Windows';
    }

    public function isLinux(): bool
    {
        return PHP_OS_FAMILY === 'Linux';
    }

    public function isMac(): bool
    {
        return PHP_OS_FAMILY === 'Darwin';
    }

    private function join(string $base, string $path): string
    {
        if ($path === '') {
            return $base;
        }

        return $base . DIRECTORY_SEPARATOR . ltrim(
            $path,
            DIRECTORY_SEPARATOR
        );
    }
}