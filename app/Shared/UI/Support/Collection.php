<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Support;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

final class Collection implements IteratorAggregate, Countable
{
    /**
     * @var array<mixed>
     */
    private array $items = [];

    /**
     * @param array<mixed> $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * @param array<mixed> $items
     */
    public static function make(array $items = []): self
    {
        return new self($items);
    }

    /**
     * @param callable $callback
     */
    public function map(callable $callback): self
    {
        return new self(
            array_map($callback, $this->items)
        );
    }

    /**
     * @param callable $callback
     */
    public function filter(callable $callback): self
    {
        return new self(
            array_values(
                array_filter($this->items, $callback)
            )
        );
    }

    /**
     * @param callable $callback
     */
    public function each(callable $callback): self
    {
        foreach ($this->items as $key => $item) {
            $callback($item, $key);
        }

        return $this;
    }

    /**
     * @param callable $callback
     */
    public function sort(callable $callback): self
    {
        $items = $this->items;

        usort($items, $callback);

        return new self($items);
    }

    public function first(): mixed
    {
        return $this->items[0] ?? null;
    }

    public function last(): mixed
    {
        if ($this->items === []) {
            return null;
        }

        return $this->items[array_key_last($this->items)];
    }

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    public function count(): int
    {
        return count($this->items);
    }

    /**
     * @return array<mixed>
     */
    public function toArray(): array
    {
        return $this->items;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }
}