<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category;

use ODE\Core\Container;
use ODE\Modules\Catalog\Category\Repositories\CategoryRepository;
use ODE\Modules\Catalog\Category\Services\CategoryService;
use ODE\Modules\Catalog\Category\Validators\CategoryValidator;
use ODE\Modules\Catalog\Category\Controllers\CategoryController;
use ODE\Modules\Catalog\Category\Ajax\CategoryAjax;

final class Module
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
    }

    public function boot(): void
    {
        //
    }
}