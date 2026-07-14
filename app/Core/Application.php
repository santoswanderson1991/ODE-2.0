<?php

declare(strict_types=1);

namespace ODE\Core;

final class Application
{
    private Container $container;

    private Environment $environment;

    private Config $config;

    public function __construct(string $basePath)
    {
        $this->container = new Container();

        $this->environment = new Environment($basePath);

        $this->config = new Config();

        $this->registerCore();
    }

    private function registerCore(): void
    {
        $this->container->singleton(
            Container::class,
            fn () => $this->container
        );

        $this->container->singleton(
            Environment::class,
            fn () => $this->environment
        );

        $this->container->singleton(
            Config::class,
            fn () => $this->config
        );
    }

    public function container(): Container
    {
        return $this->container;
    }

    public function environment(): Environment
    {
        return $this->environment;
    }

    public function config(): Config
    {
        return $this->config;
    }
}