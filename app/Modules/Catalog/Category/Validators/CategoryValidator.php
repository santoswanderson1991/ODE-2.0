<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category\Validators;

use InvalidArgumentException;
use ODE\Modules\Catalog\Category\DTO\CategoryData;

final class CategoryValidator
{
    public function validate(CategoryData $data): void
    {
        $this->validateName($data->name);
        $this->validateSlug($data->slug);
        $this->validatePosition($data->position);
    }

    private function validateName(string $name): void
    {
        if ($name === '') {
            throw new InvalidArgumentException(
                'O nome da categoria é obrigatório.'
            );
        }

        if (mb_strlen($name) < 3) {
            throw new InvalidArgumentException(
                'O nome da categoria deve possuir pelo menos 3 caracteres.'
            );
        }

        if (mb_strlen($name) > 120) {
            throw new InvalidArgumentException(
                'O nome da categoria deve possuir no máximo 120 caracteres.'
            );
        }
    }

    private function validateSlug(string $slug): void
    {
        if ($slug === '') {
            throw new InvalidArgumentException(
                'O slug da categoria é obrigatório.'
            );
        }

        if (! preg_match('/^[a-z0-9-]+$/', $slug)) {
            throw new InvalidArgumentException(
                'O slug deve conter apenas letras minúsculas, números e hífens.'
            );
        }

        if (mb_strlen($slug) > 150) {
            throw new InvalidArgumentException(
                'O slug deve possuir no máximo 150 caracteres.'
            );
        }
    }

    private function validatePosition(int $position): void
    {
        if ($position < 0) {
            throw new InvalidArgumentException(
                'A posição não pode ser negativa.'
            );
        }
    }
}