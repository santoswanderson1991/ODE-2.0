<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Components\Form;

use ODE\Shared\UI\Foundation\Component;

abstract class Field extends Component
{
    protected string $name = '';

    protected string $label = '';

    protected mixed $value = null;

    protected ?string $placeholder = null;

    protected ?string $helpText = null;

    protected bool $required = false;

    protected bool $disabled = false;

    protected bool $readonly = false;

    protected array $rules = [];

    protected array $errors = [];

    /**
     * Define o nome do campo.
     */
    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Define o label.
     */
    public function label(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Valor padrão.
     */
    public function value(mixed $value): static
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Placeholder.
     */
    public function placeholder(string $placeholder): static
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * Texto auxiliar.
     */
    public function help(string $text): static
    {
        $this->helpText = $text;

        return $this;
    }

    /**
     * Campo obrigatório.
     */
    public function required(bool $required = true): static
    {
        $this->required = $required;

        if ($required && !in_array('required', $this->rules, true)) {
            $this->rules[] = 'required';
        }

        return $this;
    }

    /**
     * Somente leitura.
     */
    public function readonly(bool $readonly = true): static
    {
        $this->readonly = $readonly;

        return $this;
    }

    /**
     * Desabilitado.
     */
    public function disabled(bool $disabled = true): static
    {
        $this->disabled = $disabled;

        return $this;
    }

    /**
     * Adiciona regra.
     */
    public function rule(string $rule): static
    {
        if (!in_array($rule, $this->rules, true)) {
            $this->rules[] = $rule;
        }

        return $this;
    }

    /**
     * Adiciona erro.
     */
    public function error(string $message): static
    {
        $this->errors[] = $message;

        return $this;
    }

    /**
     * Limpa erros.
     */
    public function clearErrors(): static
    {
        $this->errors = [];

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function getPlaceholder(): ?string
    {
        return $this->placeholder;
    }

    public function getHelpText(): ?string
    {
        return $this->helpText;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function isReadonly(): bool
    {
        return $this->readonly;
    }

    public function isDisabled(): bool
    {
        return $this->disabled;
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getRules(): array
    {
        return $this->rules;
    }
}