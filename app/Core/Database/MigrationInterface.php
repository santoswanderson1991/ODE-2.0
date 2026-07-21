<?php

declare(strict_types=1);

namespace ODE\Core\Database;

interface MigrationInterface
{
    public function up(): void;

    public function down(): void;
}