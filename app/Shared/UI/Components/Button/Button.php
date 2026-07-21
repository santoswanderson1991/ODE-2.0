<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Components\Button;

use ODE\Shared\UI\Components\Element\Element;
use ODE\Shared\UI\Support\View;
use ODE\Shared\UI\Support\AssetRegistry;

final class Button extends Element
{
    protected string $tag = 'button';

    protected string $label = '';

    protected string $variant = 'primary';

    protected string $type = 'button';

    protected bool $loading = false;

    protected bool $disabled = false;

    protected bool $fullWidth = false;

    protected ?string $icon = null;

    public function __construct()
    {
        parent::__construct();

        $this->classes(
            'ode-button'
        );

        AssetRegistry::style(
            'ode-button',
            ODE_PLUGIN_URL .
            'resources/ui/button/button.css'
        );

        AssetRegistry::script(
            'ode-button',
            ODE_PLUGIN_URL .
            'resources/ui/button/button.js'
        );
    }

    public function label(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function type(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function submit(): static
    {
        return $this->type('submit');
    }

    public function reset(): static
    {
        return $this->type('reset');
    }

    public function primary(): static
    {
        $this->variant = 'primary';

        return $this;
    }

    public function secondary(): static
    {
        $this->variant = 'secondary';

        return $this;
    }

    public function success(): static
    {
        $this->variant = 'success';

        return $this;
    }

    public function warning(): static
    {
        $this->variant = 'warning';

        return $this;
    }

    public function danger(): static
    {
        $this->variant = 'danger';

        return $this;
    }

    public function icon(string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function loading(
        bool $loading = true
    ): static {

        $this->loading = $loading;

        return $this;

    }

    public function disabled(
        bool $disabled = true
    ): static {

        $this->disabled = $disabled;

        return $this;

    }

    public function fullWidth(
        bool $full = true
    ): static {

        $this->fullWidth = $full;

        return $this;

    }

    public function render(): string
    {
        $this->class(
            'ode-button--'.$this->variant
        );

        if ($this->fullWidth) {
            $this->class('ode-button--block');
        }

        return View::render(

            __DIR__.'/Resources/button.php',

            [

                'button' => $this,

            ]

        );
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getVariant(): string
    {
        return $this->variant;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function isLoading(): bool
    {
        return $this->loading;
    }

    public function isDisabled(): bool
    {
        return $this->disabled;
    }
}