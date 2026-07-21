<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Foundation\Concerns;

trait HasAttributes
{
    /**
     * Atributos definidos pelo desenvolvedor.
     *
     * @var array<string,mixed>
     */
    protected array $attributes = [];

    /**
     * Adiciona um atributo HTML.
     */
    public function attribute(
        string $name,
        mixed $value = true
    ): static {

        $this->attributes[$name] = $value;

        return $this;
    }

    /**
     * Retorna apenas os atributos definidos.
     *
     * Não inclui:
     * - id
     * - class
     * - style
     * - data-*
     *
     * @return array<string,mixed>
     */
    protected function rawAttributes(): array
    {
        return $this->attributes;
    }
}