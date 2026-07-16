<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category\Controllers;

use ODE\Modules\Catalog\Category\DTO\CategoryData;
use ODE\Modules\Catalog\Category\Services\CategoryService;

final readonly class CategoryController
{
    public function __construct(
        private CategoryService $service,
    ) {
    }

    public function index(): array
    {
        return $this->service->all();
    }

    public function show(int $id): mixed
    {
        return $this->service->find($id);
    }

    public function store(array $request): mixed
    {
        $data = CategoryData::fromArray($request);

        return $this->service->create($data);
    }

    public function update(array $request): mixed
    {
        $data = CategoryData::fromArray($request);

        return $this->service->update($data);
    }

    public function destroy(int $id): void
    {
        $this->service->delete($id);
    }

    public function count(): int
    {
        return $this->service->count();
    }
}