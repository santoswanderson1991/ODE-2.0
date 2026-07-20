<?php

declare(strict_types=1);

namespace ODE\Modules\Catalog\Product\Validators;

use InvalidArgumentException;
use ODE\Modules\Catalog\Product\DTO\ProductData;

final class ProductValidator
{
    public function validate(ProductData $data): void
    {
        $this->validateCategory($data);

        $this->validateName($data);

        $this->validateSlug($data);

        $this->validatePrice($data);

        $this->validatePosition($data);
    }

    private function validateCategory(ProductData $data): void
    {
        if ($data->categoryId <= 0) {

            throw new InvalidArgumentException(
                'Selecione uma categoria.'
            );

        }
    }

    private function validateName(ProductData $data): void
    {
        if (trim($data->name) === '') {

            throw new InvalidArgumentException(
                'O nome do produto é obrigatório.'
            );

        }

        if (mb_strlen($data->name) > 150) {

            throw new InvalidArgumentException(
                'O nome deve possuir no máximo 150 caracteres.'
            );

        }
    }

    private function validateSlug(ProductData $data): void
    {
        if (trim($data->slug) === '') {

            return;

        }

        if (! preg_match('/^[a-z0-9-]+$/', $data->slug)) {

            throw new InvalidArgumentException(
                'O slug deve conter apenas letras minúsculas, números e hífen.'
            );

        }
    }

    private function validatePrice(ProductData $data): void
    {
        if ($data->price <= 0) {

            throw new InvalidArgumentException(
                'O preço deve ser maior que zero.'
            );

        }

        if (
            $data->salePrice !== null &&
            $data->salePrice > $data->price
        ) {

            throw new InvalidArgumentException(
                'O preço promocional não pode ser maior que o preço normal.'
            );

        }

        if (
            $data->salePrice !== null &&
            $data->salePrice < 0
        ) {

            throw new InvalidArgumentException(
                'O preço promocional é inválido.'
            );

        }
    }

    private function validatePosition(ProductData $data): void
    {
        if ($data->position < 0) {

            throw new InvalidArgumentException(
                'A ordem deve ser maior ou igual a zero.'
            );

        }
    }
}