<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Components\Badge;

use ODE\Shared\UI\Foundation\Component;
use ODE\Shared\UI\Support\View;

final class Badge extends Component
{
    private string $label = '';

    private string $variant = 'secondary';

    public function __construct()
    {
        $this->classes('ode-badge');
    }

    public static function make(string $label = ''): static
    {
        $badge = new static();

        if ($label !== '') {
            $badge->label($label);
        }

        return $badge;
    }

    public function label(string $label): static
    {
        $this->label = $label;

        return $this;
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

    public function info(): static
    {
        $this->variant = 'info';

        return $this;
    }

    public function render(): string
    {
        $this->class('ode-badge--' . $this->variant);

        return View::render(
            __DIR__ . '/Resources/badge.php',
            [
                'badge' => $this,
            ]
        );
    }

    public function getLabel(): string
    {
        return $this->label;
    }

}