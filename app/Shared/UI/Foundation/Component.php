<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Foundation;

use ODE\Shared\UI\Foundation\Concerns\HasAttributes;
use ODE\Shared\UI\Foundation\Concerns\HasClasses;
use ODE\Shared\UI\Foundation\Concerns\HasContent;
use ODE\Shared\UI\Foundation\Concerns\HasData;
use ODE\Shared\UI\Foundation\Concerns\HasId;
use ODE\Shared\UI\Foundation\Concerns\HasStyles;
use ODE\Shared\UI\Foundation\Concerns\HasVisibility;

abstract class Component implements ComponentInterface
{
    use HasId;
    use HasClasses;
    use HasAttributes;
    use HasData;
    use HasContent;
    use HasStyles;
    use HasVisibility;

    public static function make(): static
    {
        return new static();
    }

    /**
     * Retorna todos os atributos HTML prontos para renderização.
     *
     * @return array<string,mixed>
     */
    public function getAttributes(): array
    {
        $attributes = $this->rawAttributes();

        if ($this->getId() !== null) {
            $attributes['id'] = $this->getId();
        }

        if ($this->classString() !== '') {
            $attributes['class'] = $this->classString();
        }

        foreach ($this->dataset() as $key => $value) {
            $attributes['data-' . $key] = $value;
        }

        if ($this->styles() !== []) {
            $attributes['style'] = $this->buildStyleAttribute();
        }

        return $attributes;
    }

    abstract public function render(): string;

    public function __toString(): string
    {
        return $this->render();
    }
}