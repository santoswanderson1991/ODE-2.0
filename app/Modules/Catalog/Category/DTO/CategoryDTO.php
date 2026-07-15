<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category\DTO;

final readonly class CategoryDTO
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $slug,
        public int $position,
        public bool $active
    ) {
    }

    public function toArray(): array
    {
        return [
            'id'       => $this->id,
            'name'     => $this->name,
            'slug'     => $this->slug,
            'position' => $this->position,
            'active'   => $this->active,
        ];
    }
}