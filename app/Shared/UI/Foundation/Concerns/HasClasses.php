<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Foundation\Concerns;

trait HasClasses
{
    /**
     * @var array<int,string>
     */
    protected array $classes = [];

    /**
     * Adiciona uma classe CSS.
     */
    public function class(string $class): static
    {
        if ($class !== '' && !in_array($class, $this->classes, true)) {
            $this->classes[] = $class;
        }

        return $this;
    }

    /**
     * Adiciona várias classes CSS.
     *
     * Aceita:
     *
     * ->classes('btn','btn-primary')
     *
     * ou
     *
     * ->classes(['btn','btn-primary'])
     */
    public function classes(string|array ...$classes): static
    {
        foreach ($classes as $item) {

            if (is_array($item)) {

                foreach ($item as $class) {
                    $this->class($class);
                }

                continue;
            }

            $this->class($item);
        }

        return $this;
    }

    /**
     * Remove uma classe.
     */
    public function removeClass(string $class): static
    {
        $this->classes = array_values(
            array_filter(
                $this->classes,
                static fn (string $item): bool => $item !== $class
            )
        );

        return $this;
    }

    /**
     * Verifica se existe.
     */
    public function hasClass(string $class): bool
    {
        return in_array($class, $this->classes, true);
    }

    /**
     * String final.
     */
    public function classString(): string
    {
        return implode(' ', $this->classes);
    }
}