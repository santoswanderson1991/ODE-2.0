<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category\Services;

use ODE\Modules\Catalog\Category\DTO\CategoryData;
use ODE\Modules\Catalog\Category\Repositories\CategoryRepository;
use ODE\Modules\Catalog\Category\Validators\CategoryValidator;

final class CategoryService
{
    public function __construct(
        private readonly CategoryRepository $repository,
        private readonly CategoryValidator $validator,
    ) {
    }

    /**
     * @return array<int,object>
     */
    public function all(): array
    {
        return $this->repository->all();
    }

    public function create(CategoryData $data): object
    {
        $data = $this->prepareData($data);

        $this->validator->validate($data);

        return $this->repository->insert($data);
    }

    public function update(CategoryData $data): object
    {
        $data = $this->prepareData($data);
        $this->validator->validate($data);

        return $this->repository->update($data);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }

    public function find(int $id): ?object
    {
        return $this->repository->find($id);
    }

    private function prepareData(CategoryData $data): CategoryData
    {
        $slug = $this->buildSlug(
            $data->slug,
            $data->name,
            $data->id
        );

        return new CategoryData(
            id: $data->id,
            name: $data->name,
            slug: $slug,
            description: $data->description,
            position: $data->position,
            active: $data->active,
        );
    }

    private function buildSlug(
        string $slug,
        string $name,
        ?int $ignoreId = null
    ): string {

        $slug = trim($slug);

        if ($slug === '') {
            $slug = sanitize_title($name);
        } else {
            $slug = sanitize_title($slug);
        }

        return $this->makeUniqueSlug(
            $slug,
            $ignoreId
        );
    }

    private function makeUniqueSlug(
        string $slug,
        ?int $ignoreId = null
    ): string {

        $base = $slug;

        $suffix = 2;

        while (
            $this->repository->slugExists(
                $slug,
                $ignoreId
            )
        ) {

            $slug = "{$base}-{$suffix}";

            $suffix++;

        }

        return $slug;
    }
}