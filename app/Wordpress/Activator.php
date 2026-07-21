<?php

declare(strict_types=1);

namespace ODE\WordPress;

use ODE\Modules\Catalog\Category\Database\CategoryMigration;

final class Activator
{
    public static function activate(): void
    {
        (new CategoryMigration())->up();

        flush_rewrite_rules();
    }
}