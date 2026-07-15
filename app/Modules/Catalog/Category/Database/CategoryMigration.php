<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category\Database;

final class CategoryMigration
{
    public function up(): void
    {
        global $wpdb;

        $table = $wpdb->prefix . 'ode_categories';

        $charset = $wpdb->get_charset_collate();

        $sql = "
        CREATE TABLE {$table} (

            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,

            name VARCHAR(100) NOT NULL,

            slug VARCHAR(120) NOT NULL,

            position INT NOT NULL DEFAULT 0,

            active TINYINT(1) NOT NULL DEFAULT 1,

            created_at DATETIME NOT NULL,

            updated_at DATETIME NULL,

            PRIMARY KEY (id),

            UNIQUE KEY slug (slug),

            KEY position (position),

            KEY active (active)

        ) {$charset};
        ";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        dbDelta($sql);
    }
}