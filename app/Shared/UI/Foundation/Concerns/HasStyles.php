<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Foundation\Concerns;

trait HasStyles
{
    /**
     * @var array<string,string>
     */
    protected array $styles = [];

    public function style(
        string $property,
        string $value
    ): static {

        $this->styles[$property] = $value;

        return $this;
    }

    public function cssVar(
        string $variable,
        string $value
    ): static {

        return $this->style(
            $variable,
            $value
        );

    }

    public function styles(): array
    {
        return $this->styles;
    }

    protected function buildStyleAttribute(): string
    {
        $style = [];

        foreach ($this->styles as $property => $value) {

            $style[] = sprintf(
                '%s:%s',
                $property,
                $value
            );

        }

        return implode(';', $style);
    }
}