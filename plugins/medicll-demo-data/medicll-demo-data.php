<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Medicll Demo Data
 * Plugin URI:        https:/wordpress.org
 * Description:       Demo Data is a supporting plugin.
 * Version:           1.0
 * Author:            Eyecix
 * Author URI:        https:/wordpress.org
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       medicll-demo
 * Domain Path:       /languages
 */
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Retrieve the root url of the plugin.
 *
 */
function medicll_demo_data_get_url($path = '') {
    return plugin_dir_url(__FILE__) . $path;
}

/**
 * Retrieve the root path of the plugin.
 *
 */
function medicll_demo_data_get_path($path = '') {
    return plugin_dir_path(__FILE__) . $path;
}

