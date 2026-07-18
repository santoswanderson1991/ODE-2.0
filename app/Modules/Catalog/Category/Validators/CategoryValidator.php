<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Category\Validators;

use InvalidArgumentException;
use ODE\Modules\Catalog\Category\DTO\CategoryData;

final class CategoryValidator
{
    public function validate(CategoryData $data): void
    {
        $this->validateName($data);
        $this->validateSlug($data);
        $this->validatePosition($data);
    }

    private function validateName(CategoryData $data): void
    {
        if (trim($data->name) === '') {
            throw new InvalidArgumentException(
                'O nome da categoria é obrigatório.'
            );
        }

        if (mb_strlen($data->name) > 150) {
            throw new InvalidArgumentException(
                'O nome deve possuir no máximo 150 caracteres.'
            );
        }
    }

    private function validateSlug(CategoryData $data): void
    {
        // Slug vazio será gerado automaticamente pelo Service.
        if (trim($data->slug) === '') {
            return;
        }

        if (!preg_match('/^[a-z0-9-]+$/', $data->slug)) {
            throw new InvalidArgumentException(
                'O slug deve conter apenas letras minúsculas, números e hífen.'
            );
        }
    }

    private function validatePosition(CategoryData $data): void
    {
        if ($data->position < 0) {
            throw new InvalidArgumentException(
                'A ordem deve ser maior ou igual a zero.'
            );
        }
    }
}