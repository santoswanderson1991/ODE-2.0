<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Foundation\Concerns;

trait HasData
{
    protected array $dataset = [];

    public function data(
        string $key,
        mixed $value
    ): static {

        $this->dataset[$key] = $value;

        return $this;
    }

    public function dataset(): array
    {
        return $this->dataset;
    }
}