<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use ODE\Modules\Catalog\Category\Module;
use ODE\Core\Contracts\ModuleInterface;

$module = new Module();

echo '<pre>';

echo 'Classe: ' . get_class($module) . PHP_EOL;

echo 'Implementa ModuleInterface? ';
var_dump($module instanceof ModuleInterface);

echo PHP_EOL;

echo 'Interfaces:' . PHP_EOL;

print_r(class_implements($module));