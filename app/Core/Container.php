<?php

declare(strict_types=1);

namespace ODE\Core;

use Closure;
use InvalidArgumentException;

final class Container
{
    /**
     * @var array<string,array{factory:Closure,shared:bool}>
     */
    private array $bindings = [];

    /**
     * @var array<string,mixed>
     */
    private array $instances = [];

    public function singleton(string $id, Closure $factory): void
    {
        $this->bindings[$id] = [
            'factory' => $factory,
            'shared'  => true,
        ];
    }

    public function bind(string $id, Closure $factory): void
    {
        $this->bindings[$id] = [
            'factory' => $factory,
            'shared'  => false,
        ];
    }

    public function has(string $id): bool
    {
        return isset($this->bindings[$id]) || isset($this->instances[$id]);
    }

    public function get(string $id): mixed
    {
        if (isset($this->instances[$id])) {
            return $this->instances[$id];
        }

        if (! isset($this->bindings[$id])) {
            throw new InvalidArgumentException(
                sprintf('Service [%s] is not registered.', $id)
            );
        }

        $binding = $this->bindings[$id];

        $object = ($binding['factory'])($this);

        if ($binding['shared']) {
            $this->instances[$id] = $object;
        }

        return $object;
    }
}