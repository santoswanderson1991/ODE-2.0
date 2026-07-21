<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Core;

final class Attributes
{
    /**
     * @var array<string,mixed>
     */
    private array $attributes = [];

    /**
     * Adiciona atributo.
     */
    public function set(string $name, mixed $value = true): self
    {
        $this->attributes[$name] = $value;

        return $this;
    }

    /**
     * Remove atributo.
     */
    public function remove(string $name): self
    {
        unset($this->attributes[$name]);

        return $this;
    }

    /**
     * Verifica existência.
     */
    public function has(string $name): bool
    {
        return array_key_exists($name, $this->attributes);
    }

    /**
     * Obtém atributo.
     */
    public function get(string $name, mixed $default = null): mixed
    {
        return $this->attributes[$name] ?? $default;
    }

    /**
     * Adiciona classe CSS.
     */
    public function addClass(string $class): self
    {
        $current = trim((string) ($this->attributes['class'] ?? ''));

        $classes = $current === ''
            ? []
            : preg_split('/\s+/', $current);

        if (!in_array($class, $classes, true)) {
            $classes[] = $class;
        }

        $this->attributes['class'] = implode(' ', $classes);

        return $this;
    }

    /**
     * Define data attribute.
     */
    public function data(string $name, mixed $value): self
    {
        $this->attributes['data-' . $name] = $value;

        return $this;
    }

    /**
     * Converte para array.
     *
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        return $this->attributes;
    }

    /**
     * Converte em HTML.
     */
    public function render(): string
    {
        $html = [];

        foreach ($this->attributes as $name => $value) {

            if ($value === false || $value === null) {
                continue;
            }

            if ($value === true) {
                $html[] = $name;
                continue;
            }

            $html[] = sprintf(
                '%s="%s"',
                htmlspecialchars($name, ENT_QUOTES),
                htmlspecialchars((string) $value, ENT_QUOTES)
            );
        }

        return implode(' ', $html);
    }
}