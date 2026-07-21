<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Foundation\Concerns;

trait HasContent
{
    protected string $content = '';

    public function content(
        string $content
    ): static {

        $this->content = $content;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}