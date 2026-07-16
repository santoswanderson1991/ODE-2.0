<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category;

use ODE\Core\Container;
use ODE\Core\Contracts\ModuleInterface;
use ODE\Modules\Catalog\Category\Controllers\CategoryController;
use ODE\Modules\Catalog\Category\Repositories\CategoryRepository;
use ODE\Modules\Catalog\Category\Services\CategoryService;
use ODE\Modules\Catalog\Category\Validators\CategoryValidator;

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
            \ODE\Modules\Catalog\Category\Ajax\CategoryAjax::class,
            fn (Container $container) => new \ODE\Modules\Catalog\Category\Ajax\CategoryAjax(
                $container->get(CategoryController::class)
            )
        );
    }

    public function boot(Container $container): void
    {
        $container
            ->get(\ODE\Modules\Catalog\Category\Ajax\CategoryAjax::class)
            ->register();
    }
}