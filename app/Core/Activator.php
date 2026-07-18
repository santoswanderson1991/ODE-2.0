<?php

declare(strict_types=1);

namespace ODE\Core;

use ODE\Core\Database\MigrationManager;
use ODE\Modules\Catalog\Category\Database\CategoryMigration;

final class Activator
{
    public function __construct(
        private readonly Container $container,
    ) {
    }

    public function activate(): void
    {
        $this->registerMigrations();

        $this->container
            ->get(MigrationManager::class)
            ->migrate();

        flush_rewrite_rules();
    }

    private function registerMigrations(): void
    {
        $manager = $this->container->get(
            MigrationManager::class
        );

        $manager->add(
            new CategoryMigration()
        );

        /*
         * Futuras migrations:
         *
         * ProductMigration
         * CustomerMigration
         * OrderMigration
         * CouponMigration
         * DeliveryMigration
         */
    }
}