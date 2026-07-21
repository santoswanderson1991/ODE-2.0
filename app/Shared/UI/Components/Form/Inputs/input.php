<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Components\Form\Inputs;

use ODE\Shared\UI\Components\Form\Field;
use ODE\Shared\UI\Support\Html;

final class Input extends Field
{
    protected string $type = 'text';

    protected ?string $autocomplete = null;

    protected bool $autofocus = false;

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected ?string $prefix = null;

    protected ?string $suffix = null;

    protected ?string $icon = null;

    public static function make(string $name = ''): static
    {
        $field = new static();

        if ($name !== '') {
            $field->name($name);
        }

        return $field;
    }

    public function type(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function email(): static
    {
        return $this->type('email');
    }

    public function password(): static
    {
        return $this->type('password');
    }

    public function number(): static
    {
        return $this->type('number');
    }

    public function tel(): static
    {
        return $this->type('tel');
    }

    public function url(): static
    {
        return $this->type('url');
    }

    public function date(): static
    {
        return $this->type('date');
    }

    public function datetime(): static
    {
        return $this->type('datetime-local');
    }

    public function search(): static
    {
        return $this->type('search');
    }

    public function color(): static
    {
        return $this->type('color');
    }

    public function hidden(): static
    {
        return $this->type('hidden');
    }

    public function file(): static
    {
        return $this->type('file');
    }

    public function autocomplete(string $value): static
    {
        $this->autocomplete = $value;

        return $this;
    }

    public function autofocus(bool $value = true): static
    {
        $this->autofocus = $value;

        return $this;
    }

    public function maxlength(int $value): static
    {
        $this->maxLength = $value;

        return $this;
    }

    public function minlength(int $value): static
    {
        $this->minLength = $value;

        return $this;
    }

    public function prefix(string $value): static
    {
        $this->prefix = $value;

        return $this;
    }

    public function suffix(string $value): static
    {
        $this->suffix = $value;

        return $this;
    }

    public function icon(string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function render(): string
    {
        $attributes = [

            'type'        => $this->type,
            'name'        => $this->getName(),
            'value'       => (string) ($this->getValue() ?? ''),
            'placeholder' => $this->getPlaceholder(),
            'class'       => 'ode-input',

        ];

        if ($this->isRequired()) {
            $attributes['required'] = true;
        }

        if ($this->isReadonly()) {
            $attributes['readonly'] = true;
        }

        if ($this->isDisabled()) {
            $attributes['disabled'] = true;
        }

        if ($this->autocomplete !== null) {
            $attributes['autocomplete'] = $this->autocomplete;
        }

        if ($this->autofocus) {
            $attributes['autofocus'] = true;
        }

        if ($this->maxLength !== null) {
            $attributes['maxlength'] = $this->maxLength;
        }

        if ($this->minLength !== null) {
            $attributes['minlength'] = $this->minLength;
        }

        return \ODE\Shared\UI\Support\View::render(

            __DIR__.'/Resources/input.php',

            [

                'label'      => $this->getLabel(),

                'help'       => $this->getHelpText(),

                'errors'     => $this->getErrors(),

                'prefix'     => $this->prefix,

                'suffix'     => $this->suffix,

                'attributes' => $attributes,

            ]

        );
    }
}