<?php

declare(strict_types=1);

namespace ODE\Core;

final class Kernel
{
    private Application $app;

    /**
     * @var array<ServiceProvider>
     */
    private array $providers = [];

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function register(ServiceProvider $provider): void
    {
        $provider->register(
            $this->app->container()
        );

        $this->providers[] = $provider;
    }

    public function boot(): void
    {
        foreach ($this->providers as $provider) {
            $provider->boot(
                $this->app->container()
            );
        }
    }
}