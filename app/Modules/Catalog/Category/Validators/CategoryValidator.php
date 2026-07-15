<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category\Validators;

use InvalidArgumentException;
use ODE\Modules\Catalog\Category\DTO\CategoryDTO;

final class CategoryValidator
{
    public function validate(CategoryDTO $dto): void
    {
        $this->validateName($dto->name);
        $this->validateSlug($dto->slug);
        $this->validatePosition($dto->position);
    }

    private function validateName(string $name): void
    {
        if (trim($name) === '') {
            throw new InvalidArgumentException(
                'O nome da categoria é obrigatório.'
            );
        }

        if (mb_strlen($name) > 100) {
            throw new InvalidArgumentException(
                'O nome da categoria deve possuir no máximo 100 caracteres.'
            );
        }
    }

    private function validateSlug(string $slug): void
    {
        if (trim($slug) === '') {
            throw new InvalidArgumentException(
                'O slug é obrigatório.'
            );
        }

        if (! preg_match('/^[a-z0-9-]+$/', $slug)) {
            throw new InvalidArgumentException(
                'Slug inválido.'
            );
        }
    }

    private function validatePosition(int $position): void
    {
        if ($position < 0) {
            throw new InvalidArgumentException(
                'Posição inválida.'
            );
        }
    }
}