<?php

defined('ABSPATH') || exit;

class Mediclf_Plugin {
    
    public $version = '1.0';
    
    public function __construct() {
        $this->define_constants();
        $this->includes();
        $this->init_hooks();
    }

    private function set_locale() {

        if (function_exists('determine_locale')) {
            $locale = determine_locale();
        } else {
            // @todo Remove when start supporting WP 5.0 or later.
            $locale = is_admin() ? get_user_locale() : get_locale();
        }
        $locale = apply_filters('plugin_locale', $locale, 'mediclf');
        unload_textdomain('mediclf');
        load_textdomain('mediclf', WP_LANG_DIR . '/plugins/mediclf-' . $locale . '.mo');
        load_plugin_textdomain('mediclf', false, dirname(dirname(plugin_basename(__FILE__))) . '/languages');
    }

    public function set_plugin_locale() {
        $this->set_locale();
    }
    
    private function define_const($name, $value) {
        if (!defined($name)) {
            define($name, $value);
        }
    }
    
    private function define_constants() {
        $this->define_const('MEDICLF_ABSPATH', dirname(MEDICLF_PLUGIN_FILE) . '/');
        $this->define_const('MEDICLF_VERSION', $this->version);
    }

    private function includes() {
        include_once MEDICLF_ABSPATH . 'includes/common-functions.php';
        include_once MEDICLF_ABSPATH . 'includes/redux-framework/redux-ext/loader.php';
        include_once MEDICLF_ABSPATH . 'includes/redux-framework/class-redux-framework-plugin.php';
        include_once MEDICLF_ABSPATH . 'includes/redux-framework/framework-options/options-config.php';

        //
        include_once MEDICLF_ABSPATH . 'includes/meta-boxes.php';

        include_once MEDICLF_ABSPATH . 'includes/widgets/about-info.php';
    }
    
    private function init_hooks() {
        
        add_action('wp_enqueue_scripts', array($this, 'front_enqueues'));
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueues'));
    }
    
    public function front_enqueues() {
        wp_enqueue_style('mediclf-bootstrap', self::root_url() . 'css/bootstrap.min.css', array(), MEDICLF_VERSION);
        wp_enqueue_style('mediclf-bootstrap', self::root_url() . 'css/bootstrap-datetimepicker.min.css', array(), MEDICLF_VERSION);
        wp_enqueue_style('mediclf-bootstrap', self::root_url() . 'css/normalize.css', array(), MEDICLF_VERSION);
        wp_enqueue_style('mediclf-bootstrap', self::root_url() . 'css/owl.carousel.css', array(), MEDICLF_VERSION);
        wp_enqueue_style('mediclf-bootstrap', self::root_url() . 'css/prettyPhoto.css', array(), MEDICLF_VERSION);
    }
    
    public function admin_enqueues() {
        wp_enqueue_style('mediclf-admin-styles', self::root_url() . 'css/admin/admin-styles.css', array(), MEDICLF_VERSION);
    }
    
    public static function root_url() {
        return trailingslashit(plugins_url('/', MEDICLF_PLUGIN_FILE));
    }
}

new Mediclf_Plugin;
