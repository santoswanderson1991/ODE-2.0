<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Core;

use ODE\Shared\UI\Contracts\ComponentInterface;

abstract class BaseComponent implements ComponentInterface
{
    /**
     * ID HTML.
     */
    protected ?string $id = null;

    /**
     * Classes CSS.
     *
     * @var array<int,string>
     */
    protected array $classes = [];

    /**
     * Atributos HTML.
     *
     * @var array<string,mixed>
     */
    protected array $attributes = [];

    /**
     * Data Attributes.
     *
     * @var array<string,mixed>
     */
    protected array $data = [];

    /**
     * Conteúdo interno.
     */
    protected string $content = '';

    /**
     * Visibilidade.
     */
    protected bool $visible = true;

    /**
     * Factory.
     */
    public static function make(): static
    {
        return new static();
    }

    /**
     * Define ID.
     */
    public function id(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Adiciona classe CSS.
     */
    public function class(string $class): static
    {
        if (!in_array($class, $this->classes, true)) {
            $this->classes[] = $class;
        }

        return $this;
    }

    /**
     * Adiciona múltiplas classes.
     *
     * @param array<int,string> $classes
     */
    public function classes(array $classes): static
    {
        foreach ($classes as $class) {
            $this->class($class);
        }

        return $this;
    }

    /**
     * Define atributo HTML.
     */
    public function attribute(string $name, mixed $value = true): static
    {
        $this->attributes[$name] = $value;

        return $this;
    }

    /**
     * Define data attribute.
     */
    public function data(string $name, mixed $value): static
    {
        $this->data[$name] = $value;

        return $this;
    }

    /**
     * Define conteúdo.
     */
    public function content(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Exibe componente.
     */
    public function show(): static
    {
        $this->visible = true;

        return $this;
    }

    /**
     * Oculta componente.
     */
    public function hide(): static
    {
        $this->visible = false;

        return $this;
    }

    /**
     * Retorna ID.
     */
    protected function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Retorna classes.
     *
     * @return array<int,string>
     */
    protected function getClasses(): array
    {
        return $this->classes;
    }

    /**
     * Retorna atributos.
     *
     * @return array<string,mixed>
     */
    protected function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Retorna data attributes.
     *
     * @return array<string,mixed>
     */
    protected function getData(): array
    {
        return $this->data;
    }

    /**
     * Retorna conteúdo.
     */
    protected function getContent(): string
    {
        return $this->content;
    }

    /**
     * Componente visível?
     */
    protected function isVisible(): bool
    {
        return $this->visible;
    }

    /**
     * Renderização obrigatória.
     */
    abstract public function render(): string;
}