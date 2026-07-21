<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category\Controllers;

use ODE\Modules\Catalog\Category\DTO\CategoryData;
use ODE\Modules\Catalog\Category\Services\CategoryService;

final class CategoryController
{
    public function __construct(
        private readonly CategoryService $service,
    ) {
    }

    /**
     * @return array<int,object>
     */
    public function index(): array
    {
        return $this->service->all();
    }

    /**
     * @param array<string,mixed> $input
     */
    public function store(array $input): object
    {
        $data = CategoryData::fromArray($input);

        return $this->service->create($data);
    }

    /**
     * @param array<string,mixed> $input
     */
    public function update(array $input): object
    {
        $data = CategoryData::fromArray($input);

        return $this->service->update($data);
    }

    public function destroy(int $id): void
    {
        $this->service->delete($id);
    }

    public function find(int $id): ?object
    {
        return $this->service->find($id);
    }
}