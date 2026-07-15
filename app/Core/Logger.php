<?php

declare(strict_types=1);

namespace ODE\Core;

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger as Monolog;

final class Logger
{
    private Monolog $logger;

    public function __construct(string $basePath)
    {
        $directory = $basePath
            . DIRECTORY_SEPARATOR
            . 'storage'
            . DIRECTORY_SEPARATOR
            . 'logs';

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $this->logger = new Monolog('ode');

        $this->logger->pushHandler(
            new StreamHandler(
                $directory . DIRECTORY_SEPARATOR . 'ode.log',
                Level::Debug
            )
        );
    }

    public function debug(string $message, array $context = []): void
    {
        $this->logger->debug($message, $context);
    }

    public function info(string $message, array $context = []): void
    {
        $this->logger->info($message, $context);
    }

    public function warning(string $message, array $context = []): void
    {
        $this->logger->warning($message, $context);
    }

    public function error(string $message, array $context = []): void
    {
        $this->logger->error($message, $context);
    }
}