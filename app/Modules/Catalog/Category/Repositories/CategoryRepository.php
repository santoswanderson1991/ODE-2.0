<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category\Repositories;

use ODE\Modules\Catalog\Category\DTO\CategoryDTO;
use wpdb;

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
     * @return CategoryDTO[]
     */
    public function all(): array
    {
        $rows = $this->db->get_results(
            "SELECT * FROM {$this->table} ORDER BY position ASC",
            ARRAY_A
        );

        if (! is_array($rows)) {
            return [];
        }

        return array_map(
            fn(array $row) => $this->map($row),
            $rows
        );
    }

    public function find(int $id): ?CategoryDTO
    {
        $row = $this->db->get_row(
            $this->db->prepare(
                "SELECT * FROM {$this->table} WHERE id = %d",
                $id
            ),
            ARRAY_A
        );

        if (! is_array($row)) {
            return null;
        }

        return $this->map($row);
    }

    public function create(CategoryDTO $dto): int
    {
        $this->db->insert(
            $this->table,
            [
                'name'      => $dto->name,
                'slug'      => $dto->slug,
                'position'  => $dto->position,
                'active'    => $dto->active ? 1 : 0,
            ],
            [
                '%s',
                '%s',
                '%d',
                '%d',
            ]
        );

        return (int) $this->db->insert_id;
    }

    private function map(array $row): CategoryDTO
    {
        return new CategoryDTO(
            (int) $row['id'],
            $row['name'],
            $row['slug'],
            (int) $row['position'],
            (bool) $row['active']
        );
    }
}