<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category;

use ODE\Core\Container;
use ODE\Modules\Catalog\Category\Repositories\CategoryRepository;
use ODE\Modules\Catalog\Category\Services\CategoryService;
use ODE\Modules\Catalog\Category\Validators\CategoryValidator;
use ODE\Modules\Catalog\Category\Controllers\CategoryController;

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

    }

    public function boot(): void
    {
    }
}