<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category\DTO;

final readonly class CategoryData
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $slug,
        public string $description,
        public int $position,
        public bool $active,
    ) {
    }

    /**
     * @param array<string,mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(

            id: isset($data['id'])
                ? (int) $data['id']
                : null,

            name: trim(
                (string) ($data['name'] ?? '')
            ),

            slug: trim(
                (string) ($data['slug'] ?? '')
            ),

            description: trim(
                (string) ($data['description'] ?? '')
            ),

            position: (int) ($data['position'] ?? 0),

            active: !empty($data['active'])

        );
    }

    /**
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        return [

            'id' => $this->id,

            'name' => $this->name,

            'slug' => $this->slug,

            'description' => $this->description,

            'position' => $this->position,

            'active' => $this->active,

        ];
    }
}