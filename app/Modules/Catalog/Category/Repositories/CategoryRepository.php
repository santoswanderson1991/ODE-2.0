<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category\Repositories;

use wpdb;
use ODE\Modules\Catalog\Category\DTO\CategoryData;
use ODE\Modules\Catalog\Category\Entities\Category;

final class CategoryRepository
{
    private wpdb $db;

    private string $table;

    public function __construct()
    {
        global $wpdb;

        $this->db = $wpdb;
        $this->table = $wpdb->prefix . 'ode_categories';
    }

    /**
     * Retorna todas as categorias.
     *
     * @return Category[]
     */
    public function all(): array
    {
        $rows = $this->db->get_results(
            "SELECT * FROM {$this->table} ORDER BY position ASC",
            ARRAY_A
        );

        return array_map(
            fn(array $row) => $this->map($row),
            $rows ?: []
        );
    }

    public function find(int $id): ?Category
    {
        $row = $this->db->get_row(
            $this->db->prepare(
                "SELECT * FROM {$this->table} WHERE id = %d",
                $id
            ),
            ARRAY_A
        );

        if (!$row) {
            return null;
        }

        return $this->map($row);
    }

    public function exists(int $id): bool
    {
        return $this->find($id) !== null;
    }

    public function create(CategoryData $data): int
    {
        $this->db->insert(
            $this->table,
            [
                'name'        => $data->name,
                'slug'        => $data->slug,
                'description' => $data->description,
                'image'       => $data->image,
                'position'    => $data->position,
                'active'      => $data->active ? 1 : 0,
            ],
            [
                '%s',
                '%s',
                '%s',
                '%s',
                '%d',
                '%d',
            ]
        );

        return (int) $this->db->insert_id;
    }

    public function update(CategoryData $data): bool
    {
        return (bool) $this->db->update(
            $this->table,
            [
                'name'        => $data->name,
                'slug'        => $data->slug,
                'description' => $data->description,
                'image'       => $data->image,
                'position'    => $data->position,
                'active'      => $data->active ? 1 : 0,
            ],
            [
                'id' => $data->id,
            ],
            [
                '%s',
                '%s',
                '%s',
                '%s',
                '%d',
                '%d',
            ],
            [
                '%d',
            ]
        );
    }

    public function delete(int $id): bool
    {
        return (bool) $this->db->delete(
            $this->table,
            [
                'id' => $id,
            ],
            [
                '%d',
            ]
        );
    }

    public function count(): int
    {
        return (int) $this->db->get_var(
            "SELECT COUNT(*) FROM {$this->table}"
        );
    }

    private function map(array $row): Category
    {
        return new Category(
            id: (int) $row['id'],
            name: $row['name'],
            slug: $row['slug'],
            position: (int) $row['position'],
            active: (bool) $row['active'],
            description: $row['description'],
            image: $row['image'],
            createdAt: isset($row['created_at'])
                ? new \DateTimeImmutable($row['created_at'])
                : null,
            updatedAt: isset($row['updated_at'])
                ? new \DateTimeImmutable($row['updated_at'])
                : null,
        );
    }
}