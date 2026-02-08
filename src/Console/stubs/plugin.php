<?php
/*
Plugin Name: ##{{APP_NAME}}##
Description: ##{{APP_DESCRIPTION}}##
Version: ##{{APP_VERSION}}##
Author: ##{{APP_AUTHOR}}##
*/

use Lib\Core\Core;

require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';

register_activation_hook(__FILE__, fn() => Core::Install(__DIR__));
register_deactivation_hook(__FILE__, fn() => Core::Uninstall(__DIR__));

add_action('init', function () {
    new Core(__DIR__)->Init();
}, 9999);
