<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category\Controllers;

use ODE\Modules\Catalog\Category\DTO\CategoryDTO;
use ODE\Modules\Catalog\Category\Services\CategoryService;

final class CategoryController
{
    public function __construct(
        private readonly CategoryService $service
    ) {
    }

    /**
     * @return CategoryDTO[]
     */
    public function index(): array
    {
        return $this->service->all();
    }

    public function show(int $id): ?CategoryDTO
    {
        return $this->service->find($id);
    }

    public function store(array $data): int
    {
        $dto = new CategoryDTO(
            id: null,
            name: trim((string) ($data['name'] ?? '')),
            slug: sanitize_title((string) ($data['slug'] ?? '')),
            position: (int) ($data['position'] ?? 0),
            active: (bool) ($data['active'] ?? true)
        );

        return $this->service->create($dto);
    }
}