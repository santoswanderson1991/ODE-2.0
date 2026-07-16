<?php

declare(strict_types=1);

namespace ODE\Core;

use ODE\Modules\Catalog\Category\Module as CategoryModule;

final class Application
{
    private readonly Container $container;

    private readonly ModuleManager $moduleManager;

    public function __construct(
        private readonly string $basePath
    ) {
        $this->container = new Container();

        $this->registerCore();

        $this->registerModules();
    }

    private function registerCore(): void
    {
        $this->container->instance(
            self::class,
            $this
        );

        $this->container->instance(
            Container::class,
            $this->container
        );

        $this->container->singleton(
            Config::class,
            fn () => new Config($this->basePath)
        );

        $this->container->singleton(
            Logger::class,
            fn () => new Logger($this->basePath)
        );

        $this->container->singleton(
            ModuleManager::class,
            fn (Container $container) => new ModuleManager($container)
        );

        $this->moduleManager = $this->container->get(
            ModuleManager::class
        );
    }

    private function registerModules(): void
    {
        $this->moduleManager->register(
            new CategoryModule()
        );
    }

    public function boot(): void
    {
        $this->moduleManager->boot();
    }

    public function container(): Container
    {
        return $this->container;
    }

    public function basePath(): string
    {
        return $this->basePath;
    }
}