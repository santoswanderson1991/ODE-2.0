<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Product\Controllers;

use ODE\Modules\Catalog\Product\DTO\ProductData;
use ODE\Modules\Catalog\Product\Services\ProductService;

final class ProductController
{
    public function __construct(
        private readonly ProductService $service,
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
        $data = ProductData::fromArray($input);

        return $this->service->create($data);
    }

    /**
     * @param array<string,mixed> $input
     */
    public function update(array $input): object
    {
        $data = ProductData::fromArray($input);

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