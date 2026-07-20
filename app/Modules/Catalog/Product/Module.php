<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Product;

use ODE\Core\Container;
use ODE\Core\Contracts\ModuleInterface;
use ODE\Core\Database\MigrationManager;
use ODE\Modules\Catalog\Product\Admin\Menu;
use ODE\Modules\Catalog\Product\Ajax\ProductAjax;
use ODE\Modules\Catalog\Product\Assets\Assets;
use ODE\Modules\Catalog\Product\Controllers\ProductController;
use ODE\Modules\Catalog\Product\Database\ProductMigration;
use ODE\Modules\Catalog\Product\Repositories\ProductRepository;
use ODE\Modules\Catalog\Product\Services\ProductService;
use ODE\Modules\Catalog\Product\Validators\ProductValidator;


final class Module implements ModuleInterface
{
    public function register(Container $container): void
    {
        $container->singleton(
            ProductRepository::class,
            fn () => new ProductRepository()
        );

        $container->singleton(
            ProductValidator::class,
            fn () => new ProductValidator()
        );

        $container->singleton(
            ProductService::class,
            fn (Container $container) => new ProductService(
                $container->get(ProductRepository::class),
                $container->get(ProductValidator::class)
            )
        );

        $container->singleton(
            ProductController::class,
            fn (Container $container) => new ProductController(
                $container->get(ProductService::class)
            )
        );

        $container->singleton(
            ProductAjax::class,
            fn (Container $container) => new ProductAjax(
                $container->get(ProductController::class)
            )
        );

        $container->singleton(
            Menu::class,
            fn (Container $container) => new Menu($container)
        );

        $container->singleton(
            Assets::class,
            fn () => new Assets()
        );
    }

    public function boot(Container $container): void
    {
        $container
            ->get(MigrationManager::class)
            ->add(
                new ProductMigration()
            );

        $container
            ->get(ProductAjax::class)
            ->register();

        $container
            ->get(Menu::class)
            ->register();

        $container
            ->get(Assets::class)
            ->register();
    }
}