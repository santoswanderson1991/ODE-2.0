<?php

declare(strict_types=1);

namespace ODE\Core;

final class ModuleManager
{
    /**
     * @var array<int, object>
     */
    private array $modules = [];

    public function __construct(
        private readonly Container $container
    ) {
    }

    public function register(object $module): self
    {
        $this->modules[] = $module;

        return $this;
    }

    public function boot(): void
    {
        foreach ($this->modules as $module) {

            if (method_exists($module, 'register')) {
                $module->register($this->container);
            }

            if (method_exists($module, 'boot')) {
                $module->boot();
            }
        }
    }

    /**
     * @return array<int, object>
     */
    public function all(): array
    {
        return $this->modules;
    }

    public function count(): int
    {
        return count($this->modules);
    }
}