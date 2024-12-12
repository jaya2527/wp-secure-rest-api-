<?php

if (!defined('ABSPATH')) {
    exit;
}

/*
 * Plugin Name: JWT Authentication Custom Api Plugin
 * Description: Plugin to make custom changes in local.authentication.com/.
 * Version:     2.5.5
 * Text Domain: wp-secure-rest-api
*/


// Define constants.
if (!defined('WSR_PLUGIN_DIR')) {
    define('WSR_PLUGIN_DIR', untrailingslashit(plugin_dir_path(__FILE__)));
    define('WSR_VERSION', '2.5.5');
    define('WSR_PLUGIN_URL', untrailingslashit(plugins_url(basename(plugin_dir_path(__FILE__)), basename(__FILE__))));
    define('WSR_INCLUDES', plugin_dir_path(__FILE__) . '/includes/');
    define('WSR_PLUGIN_BASENAME', plugin_basename(__FILE__));
    define('WSR_TEMPLATES', plugin_dir_path(__FILE__) . '/templates/');
    define('WSR_ASSETS', WSR_PLUGIN_URL . '/assets/');
}


if (!class_exists('WSR')) {
    include_once(WSR_PLUGIN_DIR . '/includes/class-wsr.php');
}
function jwtCustomApi()
{
    return WSR::getInstance();
}
$GLOBALS['WSR'] = jwtCustomApi();