<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Product\Database;

use ODE\Core\Database\MigrationInterface;

final class ProductMigration implements MigrationInterface
{
    public function up(): void
    {
        global $wpdb;

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $table = $wpdb->prefix . 'ode_products';

        $charset = $wpdb->get_charset_collate();

        $sql = <<<SQL
CREATE TABLE {$table} (

    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,

    category_id BIGINT UNSIGNED NOT NULL,

    name VARCHAR(150) NOT NULL,

    slug VARCHAR(180) NOT NULL,

    description LONGTEXT NULL,

    price DECIMAL(10,2) NOT NULL DEFAULT 0,

    sale_price DECIMAL(10,2) NULL,

    image_id BIGINT UNSIGNED NULL,

    position INT NOT NULL DEFAULT 0,

    active TINYINT(1) NOT NULL DEFAULT 1,

    created_at DATETIME NOT NULL,

    updated_at DATETIME NULL,

    PRIMARY KEY (id),

    UNIQUE KEY slug (slug),

    KEY category (category_id),

    KEY active (active),

    KEY position (position)

) {$charset};

SQL;

        dbDelta($sql);
    }

    public function down(): void
    {
        global $wpdb;

        $table = $wpdb->prefix . 'ode_products';

        $wpdb->query(
            "DROP TABLE IF EXISTS {$table}"
        );
    }
}