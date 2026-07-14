<?php

declare(strict_types=1);

namespace ODE\Core;

use Closure;
use InvalidArgumentException;

final class Container
{
    /**
     * @var array<string,mixed>
     */
    private array $bindings = [];

    /**
     * @var array<string,mixed>
     */
    private array $instances = [];

    public function singleton(string $abstract, Closure $factory): void
    {
        $this->bindings[$abstract] = [
            'factory' => $factory,
            'shared'  => true,
        ];
    }

    public function bind(string $abstract, Closure $factory): void
    {
        $this->bindings[$abstract] = [
            'factory' => $factory,
            'shared'  => false,
        ];
    }

    public function has(string $abstract): bool
    {
        return isset($this->bindings[$abstract]) ||
               isset($this->instances[$abstract]);
    }

    public function make(string $abstract): mixed
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        if (! isset($this->bindings[$abstract])) {
            throw new InvalidArgumentException(
                "Container binding '{$abstract}' not found."
            );
        }

        $binding = $this->bindings[$abstract];

        $object = ($binding['factory'])($this);

        if ($binding['shared']) {
            $this->instances[$abstract] = $object;
        }

        return $object;
    }
}