<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category;

use ODE\Core\Container;
use ODE\Core\Contracts\ModuleInterface;
use ODE\Modules\Catalog\Category\Controllers\CategoryController;
use ODE\Modules\Catalog\Category\Repositories\CategoryRepository;
use ODE\Modules\Catalog\Category\Services\CategoryService;
use ODE\Modules\Catalog\Category\Validators\CategoryValidator;
use ODE\Modules\Catalog\Category\Admin\Menu;
use ODE\Modules\Catalog\Category\Ajax\CategoryAjax;
use ODE\Modules\Catalog\Category\Assets\Assets;
use ODE\Core\Database\MigrationManager;
use ODE\Modules\Catalog\Category\Database\CategoryMigration;



final class Module implements ModuleInterface
{
    public function register(Container $container): void
    {
        $container->singleton(
            CategoryRepository::class,
            fn () => new CategoryRepository()
        );

        $container->singleton(
            CategoryValidator::class,
            fn () => new CategoryValidator()
        );

        $container->singleton(
            CategoryService::class,
            fn (Container $container) => new CategoryService(
                $container->get(CategoryRepository::class),
                $container->get(CategoryValidator::class)
            )
        );

        $container->singleton(
            CategoryController::class,
            fn (Container $container) => new CategoryController(
                $container->get(CategoryService::class)
            )
        );

        $container->singleton(
            CategoryAjax::class,
            fn (Container $container) => new CategoryAjax(
                $container->get(CategoryController::class)
            )
        );

        $container->singleton(
            Menu::class,
            fn (Container $container) => new Menu($container)
        );

        $container->singleton(
            Assets::class,
            fn (Container $container) => new Assets()
        );
    }

    public function boot(Container $container): void
    {

        $container
            ->get(MigrationManager::class)
            ->add(
                new CategoryMigration()
        );

        $container
            ->get(CategoryAjax::class)
            ->register();

        $container
            ->get(Menu::class)
            ->register();

        $container
            ->get(Assets::class)
            ->register();
    }
}