<?php

declare(strict_types=1);

namespace ODE\Core;

use ODE\Core\Contracts\ModuleInterface;

final class ModuleManager
{
    /**
     * @var ModuleInterface[]
     */
    private array $modules = [];

    public function __construct(
        private readonly Container $container
    ) {
    }

    public function register(ModuleInterface $module): self
    {
        if (in_array($module, $this->modules, true)) {
            return $this;
        }

        $module->register($this->container);

        $this->modules[] = $module;

        return $this;
    }

    public function boot(): void
    {
        foreach ($this->modules as $module) {
            $module->boot($this->container);
        }
    }

    /**
     * @return ModuleInterface[]
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