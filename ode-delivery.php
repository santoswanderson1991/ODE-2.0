<?php
/**
 * Plugin Name: ODE Delivery
 * Plugin URI: https://pizzariaolegario.com.br
 * Description: Sistema de Delivery da Olegário.
 * Version: 2.0.0-alpha.1
 * Requires at least: 6.8
 * Requires PHP: 8.3
 * Author: Space Ham Creative
 * License: GPL-2.0-or-later
 * Text Domain: ode-delivery
 */

declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

define('ODE_VERSION', '2.0.0-alpha.1');
define('ODE_PLUGIN_FILE', __FILE__);
define('ODE_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('ODE_PLUGIN_URL', plugin_dir_url(__FILE__));

$autoload = ODE_PLUGIN_PATH . 'vendor/autoload.php';

if (! file_exists($autoload)) {
    add_action('admin_notices', static function (): void {
        echo '<div class="notice notice-error"><p><strong>ODE Delivery:</strong> Execute <code>composer install</code>.</p></div>';
    });

    return;
}

require_once $autoload;
require_once ODE_PLUGIN_PATH . 'bootstrap/app.php';

register_activation_hook(

    __FILE__,

    static function () {

        $application = new \ODE\Core\Application(
            ODE_PLUGIN_PATH
        );

        $application->boot();

        $activator = new \ODE\Core\Activator(
            $application->container()
        );

        $activator->activate();

    }

);

register_deactivation_hook(
    __FILE__,
    [\ODE\WordPress\Deactivator::class, 'deactivate']
);

ODE\bootstrap();