<?php

/**
 * Plugin Name:       Medicll Framework
 * Plugin URI:        https://wordpress.org
 * Description:       MEDICLF plugin.
 * Version:           1.0
 * Author:            WordPress
 * Author URI:        https://wordpress.org
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mediclf
 * Domain Path:       /languages
 */

defined('ABSPATH') || exit;

if (!defined('MEDICLF_PLUGIN_FILE')) {
    define('MEDICLF_PLUGIN_FILE', __FILE__);
}

function MEDICLF__activate_plugin() {
    require_once plugin_dir_path(__FILE__) . 'includes/classes/class-activator.php';
    $activate = new MEDICLF_Plugin_Activator();
}

register_activation_hook(__FILE__, 'MEDICLF__activate_plugin');

include_once dirname(MEDICLF_PLUGIN_FILE) . '/includes/class-plugin.php';
