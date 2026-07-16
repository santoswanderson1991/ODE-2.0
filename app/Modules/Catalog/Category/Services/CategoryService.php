<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category\Services;

use ODE\Modules\Catalog\Category\DTO\CategoryData;
use ODE\Modules\Catalog\Category\Entities\Category;
use ODE\Modules\Catalog\Category\Repositories\CategoryRepository;
use ODE\Modules\Catalog\Category\Validators\CategoryValidator;

final readonly class CategoryService
{
    public function __construct(
        private CategoryRepository $repository,
        private CategoryValidator $validator,
    ) {
    }

    /**
     * @return Category[]
     */
    public function all(): array
    {
        return $this->repository->all();
    }

    public function find(int $id): ?Category
    {
        return $this->repository->find($id);
    }

    public function create(CategoryData $data): Category
    {
        $this->validator->validate($data);

        $id = $this->repository->create($data);

        $category = $this->repository->find($id);

        if (! $category instanceof Category) {
            throw new \RuntimeException(
                'Não foi possível recuperar a categoria criada.'
            );
        }

        return $category;
    }

    public function update(CategoryData $data): Category
    {
        if ($data->id === null) {
            throw new \InvalidArgumentException(
                'ID da categoria é obrigatório.'
            );
        }

        $this->validator->validate($data);

        if (! $this->repository->exists($data->id)) {
            throw new \RuntimeException(
                'Categoria não encontrada.'
            );
        }

        $this->repository->update($data);

        $category = $this->repository->find($data->id);

        if (! $category instanceof Category) {
            throw new \RuntimeException(
                'Erro ao atualizar categoria.'
            );
        }

        return $category;
    }

    public function delete(int $id): void
    {
        if (! $this->repository->exists($id)) {
            throw new \RuntimeException(
                'Categoria não encontrada.'
            );
        }

        $this->repository->delete($id);
    }

    public function count(): int
    {
        return $this->repository->count();
    }
}