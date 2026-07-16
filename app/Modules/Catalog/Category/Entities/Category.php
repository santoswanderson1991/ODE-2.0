<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category\Entities;

final readonly class Category
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $slug,
        public int $position,
        public bool $active,
        public ?string $description = null,
        public ?string $image = null,
        public ?\DateTimeImmutable $createdAt = null,
        public ?\DateTimeImmutable $updatedAt = null,
    ) {
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function deactivate(): self
    {
        return new self(
            id: $this->id,
            name: $this->name,
            slug: $this->slug,
            position: $this->position,
            active: false,
            description: $this->description,
            image: $this->image,
            createdAt: $this->createdAt,
            updatedAt: new \DateTimeImmutable()
        );
    }

    public function activate(): self
    {
        return new self(
            id: $this->id,
            name: $this->name,
            slug: $this->slug,
            position: $this->position,
            active: true,
            description: $this->description,
            image: $this->image,
            createdAt: $this->createdAt,
            updatedAt: new \DateTimeImmutable()
        );
    }
}