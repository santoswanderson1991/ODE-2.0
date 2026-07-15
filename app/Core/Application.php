<?php

declare(strict_types=1);

namespace ODE\Core;

final class Application
{
    private Container $container;

    private ModuleManager $modules;

    public function __construct(
        private readonly string $basePath
    ) {
        $this->container = new Container();

        $this->registerCore();
    }

    private function registerCore(): void
    {
        $this->container->singleton(
            self::class,
            fn () => $this
        );

        $this->container->singleton(
            Container::class,
            fn () => $this->container
        );

        $this->container->singleton(
            Config::class,
            fn () => new Config(
                $this->basePath
            )
        );

        $this->container->singleton(
            Plugin::class,
            fn () => new Plugin($this)
        );

        $this->container->singleton(
            Logger::class,
            fn () => new Logger(
                $this->basePath
            )
        );

        $this->container->singleton(
            ModuleManager::class,
            fn () => new ModuleManager(
                $this->container
            )
        );

        $this->modules = $this->container->get(
            ModuleManager::class
        );
    }

    public function boot(): void
    {
        $this->modules->boot();
    }

    public function boot(): void
    {
        $this->container
            ->get(Plugin::class)
            ->boot();

        $this->modules->boot();
    }

    public function basePath(): string
    {
        return $this->basePath;
    }
}