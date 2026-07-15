<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category\Services;

use ODE\Modules\Catalog\Category\DTO\CategoryDTO;
use ODE\Modules\Catalog\Category\Repositories\CategoryRepository;
use ODE\Modules\Catalog\Category\Validators\CategoryValidator;

final class CategoryService
{
    public function __construct(
        private readonly CategoryRepository $repository,
        private readonly CategoryValidator $validator
    ) {
    }

    /**
     * @return CategoryDTO[]
     */
    public function all(): array
    {
        return $this->repository->all();
    }

    public function find(int $id): ?CategoryDTO
    {
        return $this->repository->find($id);
    }

    public function create(CategoryDTO $dto): int
    {
        $this->validator->validate($dto);

        return $this->repository->create($dto);
    }
}