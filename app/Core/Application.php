<?php

declare(strict_types=1);

namespace ODE\Core;

use ODE\Modules\Catalog\Category\Module as CategoryModule;
use ODE\Modules\Catalog\Product\Module as ProductModule;

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

        $this->container->singleton(
            \ODE\Shared\UI\AssetsManager::class,
            fn () => new \ODE\Shared\UI\AssetsManager()
        );

        $this->container->singleton(
            \ODE\Core\Database\MigrationManager::class,
            fn () => new \ODE\Core\Database\MigrationManager()
        );
    }

private function registerModules(): void
{
    $this->moduleManager->register(
        new CategoryModule()
    );

    $this->moduleManager->register(
        new ProductModule()
    );
}

    public function boot(): void
    {
        $this->moduleManager->boot();

        $this->container
            ->get(\ODE\Core\Database\MigrationManager::class)
            ->migrate();

        $this->container
            ->get(\ODE\Shared\UI\AssetsManager::class)
            ->register();
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