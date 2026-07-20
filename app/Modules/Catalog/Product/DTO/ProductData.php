<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Product\DTO;

final readonly class ProductData
{
    public function __construct(
        public ?int $id,
        public int $categoryId,
        public string $name,
        public string $slug,
        public string $description,
        public float $price,
        public ?float $salePrice,
        public ?int $imageId,
        public int $position,
        public bool $active,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: isset($data['id']) && $data['id'] !== ''
                ? (int) $data['id']
                : null,

            categoryId: (int) ($data['category_id'] ?? 0),

            name: trim((string) ($data['name'] ?? '')),

            slug: trim((string) ($data['slug'] ?? '')),

            description: trim((string) ($data['description'] ?? '')),

            price: (float) ($data['price'] ?? 0),

            salePrice: ($data['sale_price'] ?? '') !== ''
                ? (float) $data['sale_price']
                : null,

            imageId: ($data['image_id'] ?? '') !== ''
                ? (int) $data['image_id']
                : null,

            position: (int) ($data['position'] ?? 0),

            active: isset($data['active']),
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'category_id' => $this->categoryId,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'sale_price' => $this->salePrice,
            'image_id' => $this->imageId,
            'position' => $this->position,
            'active' => $this->active,
        ];
    }
}