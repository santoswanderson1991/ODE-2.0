<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category\DTO;

use ODE\Modules\Catalog\Category\Entities\Category;

final readonly class CategoryData
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $slug,
        public int $position,
        public bool $active,
        public ?string $description = null,
        public ?string $image = null,
    ) {
    }

    /**
     * Cria um DTO a partir dos dados enviados pelo formulário.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: isset($data['id']) ? (int) $data['id'] : null,
            name: trim((string) ($data['name'] ?? '')),
            slug: trim((string) ($data['slug'] ?? '')),
            position: (int) ($data['position'] ?? 0),
            active: (bool) ($data['active'] ?? true),
            description: $data['description'] ?? null,
            image: $data['image'] ?? null,
        );
    }

    /**
     * Converte o DTO em Entity.
     */
    public function toEntity(): Category
    {
        return new Category(
            id: $this->id,
            name: $this->name,
            slug: $this->slug,
            position: $this->position,
            active: $this->active,
            description: $this->description,
            image: $this->image,
        );
    }

    /**
     * Exporta para array.
     */
    public function toArray(): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'slug'        => $this->slug,
            'position'    => $this->position,
            'active'      => $this->active,
            'description' => $this->description,
            'image'       => $this->image,
        ];
    }
}