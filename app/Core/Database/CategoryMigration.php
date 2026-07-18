<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category\Database;

use ODE\Core\Database\MigrationInterface;

final class CategoryMigration implements MigrationInterface
{
    public function up(): void
    {
        global $wpdb;

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $table = $wpdb->prefix . 'ode_categories';

        $charset = $wpdb->get_charset_collate();

        $sql = "

        CREATE TABLE {$table} (

            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,

            name VARCHAR(150) NOT NULL,

            slug VARCHAR(180) NOT NULL,

            description TEXT NULL,

            position INT NOT NULL DEFAULT 0,

            active TINYINT(1) NOT NULL DEFAULT 1,

            created_at DATETIME NOT NULL,

            updated_at DATETIME NOT NULL,

            PRIMARY KEY (id),

            UNIQUE KEY slug (slug),

            KEY position (position),

            KEY active (active)

        ) {$charset};

        ";

        dbDelta($sql);
    }

    public function down(): void
    {
        global $wpdb;

        $table = $wpdb->prefix . 'ode_categories';

        $wpdb->query(
            "DROP TABLE IF EXISTS {$table}"
        );
    }
}