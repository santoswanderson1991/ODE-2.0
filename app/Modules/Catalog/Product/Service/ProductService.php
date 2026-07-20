<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Product\Services;

use ODE\Modules\Catalog\Product\DTO\ProductData;
use ODE\Modules\Catalog\Product\Repositories\ProductRepository;
use ODE\Modules\Catalog\Product\Validators\ProductValidator;

final class ProductService
{
    public function __construct(
        private readonly ProductRepository $repository,
        private readonly ProductValidator $validator,
    ) {
    }

    /**
     * @return array<int,object>
     */
    public function all(): array
    {
        return $this->repository->all();
    }

    public function find(int $id): ?object
    {
        return $this->repository->find($id);
    }

    public function create(ProductData $data): object
    {
        $this->validator->validate($data);

        return $this->repository->insert($data);
    }

    public function update(ProductData $data): object
    {
        $this->validator->validate($data);

        return $this->repository->update($data);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }

    public function slugExists(
        string $slug,
        ?int $ignoreId = null
    ): bool {
        return $this->repository->slugExists(
            $slug,
            $ignoreId
        );
    }
}