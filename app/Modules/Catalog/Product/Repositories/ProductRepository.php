<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Product\Repositories;

use RuntimeException;
use wpdb;
use ODE\Modules\Catalog\Product\DTO\ProductData;

final class ProductRepository
{
    private wpdb $db;

    private string $table;

    public function __construct()
    {
        global $wpdb;

        $this->db = $wpdb;

        $this->table = $wpdb->prefix . 'ode_products';
    }

    /**
     * @return array<int,object>
     */
    public function all(): array
    {
        return $this->db->get_results(
            "
            SELECT
                p.id,
                p.category_id,
                p.name,
                p.slug,
                p.description,
                p.price,
                p.sale_price,
                p.image_id,
                p.position,
                p.active,
                p.created_at,
                p.updated_at,
                c.name AS category_name
            FROM {$this->table} p
            LEFT JOIN {$this->db->prefix}ode_categories c
                ON c.id = p.category_id
            ORDER BY
                p.position ASC,
                p.name ASC
            "
        );
    }

    public function find(int $id): ?object
    {
        return $this->db->get_row(
            $this->db->prepare(
                "
                SELECT *
                FROM {$this->table}
                WHERE id = %d
                ",
                $id
            )
        );
    }

    public function insert(ProductData $data): object
    {
        $result = $this->db->insert(
            $this->table,
            [
                'category_id' => $data->categoryId,
                'name'        => $data->name,
                'slug'        => $data->slug,
                'description' => $data->description,
                'price'       => $data->price,
                'sale_price'  => $data->salePrice,
                'image_id'    => $data->imageId,
                'position'    => $data->position,
                'active'      => $data->active ? 1 : 0,
                'created_at'  => current_time('mysql'),
                'updated_at'  => current_time('mysql'),
            ],
            [
                '%d',
                '%s',
                '%s',
                '%s',
                '%f',
                '%f',
                '%d',
                '%d',
                '%d',
                '%s',
                '%s',
            ]
        );

        if ($result === false) {
            throw new RuntimeException($this->db->last_error);
        }

        return $this->find(
            (int) $this->db->insert_id
        );
    }

    public function update(ProductData $data): object
    {
        if ($data->id === null) {
            throw new RuntimeException(
                'ID do produto não informado.'
            );
        }

        $result = $this->db->update(
            $this->table,
            [
                'category_id' => $data->categoryId,
                'name'        => $data->name,
                'slug'        => $data->slug,
                'description' => $data->description,
                'price'       => $data->price,
                'sale_price'  => $data->salePrice,
                'image_id'    => $data->imageId,
                'position'    => $data->position,
                'active'      => $data->active ? 1 : 0,
                'updated_at'  => current_time('mysql'),
            ],
            [
                'id' => $data->id,
            ],
            [
                '%d',
                '%s',
                '%s',
                '%s',
                '%f',
                '%f',
                '%d',
                '%d',
                '%d',
                '%s',
            ],
            [
                '%d',
            ]
        );

        if ($result === false) {
            throw new RuntimeException(
                'Erro ao atualizar produto.'
            );
        }

        return $this->find($data->id);
    }

    public function delete(int $id): void
    {
        $result = $this->db->delete(
            $this->table,
            [
                'id' => $id,
            ],
            [
                '%d',
            ]
        );

        if ($result === false) {
            throw new RuntimeException(
                'Erro ao excluir produto.'
            );
        }
    }

    public function slugExists(
        string $slug,
        ?int $ignoreId = null
    ): bool {

        $sql = "
            SELECT COUNT(*)
            FROM {$this->table}
            WHERE slug = %s
        ";

        $params = [$slug];

        if ($ignoreId !== null) {
            $sql .= " AND id <> %d";
            $params[] = $ignoreId;
        }

        return (bool) $this->db->get_var(
            $this->db->prepare(
                $sql,
                ...$params
            )
        );
    }
}