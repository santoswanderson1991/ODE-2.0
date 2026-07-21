<?php

declare(strict_types=1);

namespace ODE\Core\Database;

final class MigrationManager
{
    /**
     * @var array<MigrationInterface>
     */
    private array $migrations = [];

    public function add(MigrationInterface $migration): self
    {
        $this->migrations[] = $migration;

        return $this;
    }

    public function migrate(): void
    {
        foreach ($this->migrations as $migration) {
            $migration->up();
        }
    }

    public function rollback(): void
    {
        foreach (array_reverse($this->migrations) as $migration) {
            $migration->down();
        }
    }

    /**
     * @return array<MigrationInterface>
     */
    public function all(): array
    {
        return $this->migrations;
    }

    public function count(): int
    {
        return count($this->migrations);
    }
}