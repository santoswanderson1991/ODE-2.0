<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Fields;

abstract class Field
{
    protected string $name;

    protected string $id;

    protected string $label = '';

    protected mixed $value = null;

    protected string $placeholder = '';

    protected bool $required = false;

    protected bool $disabled = false;

    protected ?string $help = null;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->id = $name;
    }

    public static function make(string $name): static
    {
        return new static($name);
    }

    public function id(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function label(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function value(mixed $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function placeholder(string $placeholder): static
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    public function required(bool $required = true): static
    {
        $this->required = $required;

        return $this;
    }

    public function disabled(bool $disabled = true): static
    {
        $this->disabled = $disabled;

        return $this;
    }

    public function help(string $help): static
    {
        $this->help = $help;

        return $this;
    }

    abstract public function render(): void;
}