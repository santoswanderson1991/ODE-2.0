<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category\Repositories;

use RuntimeException;
use wpdb;
use ODE\Modules\Catalog\Category\DTO\CategoryData;

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
     * @return array<int,object>
     */
    public function all(): array
    {
        return $this->db->get_results(
            "
            SELECT *
            FROM {$this->table}
            ORDER BY position ASC, name ASC
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

    public function insert(CategoryData $data): object
    {
        $result = $this->db->insert(
            $this->table,
            [
                'name'        => $data->name,
                'slug'        => $data->slug,
                'description' => $data->description,
                'position'    => $data->position,
                'active'      => $data->active ? 1 : 0,
                'created_at'  => current_time('mysql'),
                'updated_at'  => current_time('mysql'),
            ],
            [
                '%s',
                '%s',
                '%s',
                '%d',
                '%d',
                '%s',
                '%s',
            ]
        );

        if ($result === false) {

            throw new RuntimeException(
                $this->db->last_error
            );

        }

        return $this->find(
            (int) $this->db->insert_id
        );
    }

    public function update(CategoryData $data): object
    {
        if ($data->id === null) {
            throw new RuntimeException(
                'ID da categoria não informado.'
            );
        }

        $result = $this->db->update(
            $this->table,
            [
                'name'        => $data->name,
                'slug'        => $data->slug,
                'description' => $data->description,
                'position'    => $data->position,
                'active'      => $data->active ? 1 : 0,
                'updated_at'  => current_time('mysql'),
            ],
            [
                'id' => $data->id,
            ],
            [
                '%s',
                '%s',
                '%s',
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
                'Erro ao atualizar categoria.'
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
                'Erro ao excluir categoria.'
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