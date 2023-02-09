<?php
/**
 * medicll functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package medicll
 */

if ( ! defined( 'MEDICLL_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'MEDICLL_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function medicll_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on medicll, use a find and replace
		* to change 'medicll' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'medicll', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'medicll' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'medicll' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'medicll_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'medicll_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function medicll_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'medicll_content_width', 640 );
}
add_action( 'after_setup_theme', 'medicll_content_width', 0 );

add_action('after_setup_theme', 'medicll_content_width', 0);


require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'medicll_register_required_plugins');

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function medicll_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array();
    // This is an example of how to include a plugin bundled with a theme.
    $plugins[] = array(
        'name' => esc_html__('Medicll Framework', 'medicll'), // The plugin name.
        'slug' => 'medicll-framework', // The plugin slug (typically the folder name).
        'source' => get_template_directory() . '/inc/activation-plugins/medicll-framework.zip', // The plugin source.
        'required' => true, // If false, the plugin is only 'recommended' instead of required.
        'version' => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
        'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
        'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        'external_url' => '', // If set, overrides default API URL and points to an external URL.
        'is_callable' => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
    );
    if (class_exists('Mediclf_Plugin')) {
        $plugins[] = array(
            'name' => esc_html__('Medicll Demo Data', 'medicll'), // The plugin name.
            'slug' => 'medicll-demo-data', // The plugin slug (typically the folder name).
            'source' => get_template_directory() . '/inc/activation-plugins/medicll-demo-data.zip', // The plugin source.
            'required' => true, // If false, the plugin is only 'recommended' instead of required.
            'version' => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => '', // If set, overrides default API URL and points to an external URL.
            'is_callable' => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
        );
		$plugins[] = array(
            'name' => esc_html__('Envato Market', 'medicll'), // The plugin name.
            'slug' => 'envato-market', // The plugin slug (typically the folder name).
            'source' => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip', // The plugin source.
            'required' => true, // If false, the plugin is only 'recommended' instead of required.
            'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => '', // If set, overrides default API URL and points to an external URL.
            'is_callable' => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
        );
        $plugins[] = array(
            'name' => esc_html__('WPBakery Page Builder', 'medicll'), // The plugin name.
            'slug' => 'js_composer', // The plugin slug (typically the folder name).
            'source' => get_template_directory() . '/inc/activation-plugins/js_composer.zip', // The plugin source.
            'required' => true, // If false, the plugin is only 'recommended' instead of required.
            'version' => '6.9.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => '', // If set, overrides default API URL and points to an external URL.
            'is_callable' => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
        );
    }

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id' => 'medicll', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message' => '', // Message to output right before the plugins table.
        'strings' => array(
            'page_title' => esc_html__('Install Required Plugins', 'medicll'),
            'menu_title' => esc_html__('Install Plugins', 'medicll'),
            /* translators: %s: plugin name. */
            'installing' => esc_html__('Installing Plugin: %s', 'medicll'),
            /* translators: %s: plugin name. */
            'updating' => esc_html__('Updating Plugin: %s', 'medicll'),
            'oops' => esc_html__('Something went wrong with the plugin API.', 'medicll'),
            'notice_can_install_required' => _n_noop(
                    /* translators: 1: plugin name(s). */
                    'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'medicll'
            ),
            'notice_can_install_recommended' => _n_noop(
                    /* translators: 1: plugin name(s). */
                    'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'medicll'
            ),
            'notice_ask_to_update' => _n_noop(
                    /* translators: 1: plugin name(s). */
                    'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'medicll'
            ),
            'notice_ask_to_update_maybe' => _n_noop(
                    /* translators: 1: plugin name(s). */
                    'There is an update available for: %1$s.', 'There are updates available for the following plugins: %1$s.', 'medicll'
            ),
            'notice_can_activate_required' => _n_noop(
                    /* translators: 1: plugin name(s). */
                    'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'medicll'
            ),
            'notice_can_activate_recommended' => _n_noop(
                    /* translators: 1: plugin name(s). */
                    'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'medicll'
            ),
            'install_link' => _n_noop(
                    'Begin installing plugin', 'Begin installing plugins', 'medicll'
            ),
            'update_link' => _n_noop(
                    'Begin updating plugin', 'Begin updating plugins', 'medicll'
            ),
            'activate_link' => _n_noop(
                    'Begin activating plugin', 'Begin activating plugins', 'medicll'
            ),
            'return' => esc_html__('Return to Required Plugins Installer', 'medicll'),
            'plugin_activated' => esc_html__('Plugin activated successfully.', 'medicll'),
            'activated_successfully' => esc_html__('The following plugin was activated successfully:', 'medicll'),
            /* translators: 1: plugin name. */
            'plugin_already_active' => esc_html__('No action taken. Plugin %1$s was already active.', 'medicll'),
            /* translators: 1: plugin name. */
            'plugin_needs_higher_version' => esc_html__('Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'medicll'),
            /* translators: 1: dashboard link. */
            'complete' => esc_html__('All plugins installed and activated successfully. %1$s', 'medicll'),
            'dismiss' => esc_html__('Dismiss this notice', 'medicll'),
            'notice_cannot_install_activate' => esc_html__('There are one or more required or recommended plugins to install, update or activate.', 'medicll'),
            'contact_admin' => esc_html__('Please contact the administrator of this site for help.', 'medicll'),
            'nag_type' => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
        ),
    );

    tgmpa($plugins, $config);
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function medicll_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'medicll' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'medicll' ),
			'before_widget' => '<section id="%1$s" class="widget medicll-widget medicll-widgetcategories medicll-widgetcount medicll-leficon %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="medicll-widgettitle"><span class="medicll-widgeticon"><i><img src="' . get_theme_file_uri('images/img-26.png') . '" alt=""></i></span><h3>',
			'after_title'   => '</h3></div>',
		)
	);
}
add_action( 'widgets_init', 'medicll_widgets_init' );

add_action('widgets_init', 'medicll_dynamic_sidebars');

function medicll_dynamic_sidebars() {
	global $mediclf_framework_options;

	$medicll_sidebars = isset($mediclf_framework_options['mediclf-themes-sidebars']) ? $mediclf_framework_options['mediclf-themes-sidebars'] : '';
	if (is_array($medicll_sidebars) && sizeof($medicll_sidebars) > 0) {
		foreach ($medicll_sidebars as $sidebar) {
			if ($sidebar != '') {
				$sidebar_id = urldecode(sanitize_title($sidebar));
				register_sidebar(array(
					'name' => $sidebar,
					'id' => $sidebar_id,
					'description' => esc_html__('Add widgets here.', 'medicll'),
					'before_widget' => '<div id="%1$s" class="widget medicll-widget medicll-widgetcategories medicll-widgetcount medicll-leficon %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<div class="medicll-widgettitle"><span class="medicll-widgeticon"><i><img src="' . get_theme_file_uri('images/img-26.png') . '" alt=""></i></span><h3>',
					'after_title' => '</h3></div>',
				));
			}
		}
	}
}

/**
 * Enqueue scripts and styles.
 */
function medicll_scripts() {
	wp_enqueue_style( 'medicll-google-font', '//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800);', array(), MEDICLL_VERSION );
	
	wp_enqueue_style( 'medicll-fontawesome', get_theme_file_uri('css/font-awesome.min.css'), array(), MEDICLL_VERSION );

	wp_enqueue_style( 'medicll-style', get_stylesheet_uri(), array(), MEDICLL_VERSION );
	
	wp_enqueue_style( 'medicll-color', get_theme_file_uri('css/color.css'), array(), MEDICLL_VERSION );
	wp_enqueue_style( 'medicll-responsive', get_theme_file_uri('css/responsive.css'), array(), MEDICLL_VERSION );
	wp_enqueue_style( 'medicll-transitions', get_theme_file_uri('css/transitions.css'), array(), MEDICLL_VERSION );

	wp_style_add_data( 'medicll-style', 'rtl', 'replace' );

	wp_enqueue_script( 'medicll-navigation', get_theme_file_uri('js/navigation.js'), array(), MEDICLL_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'medicll-modernizr', get_theme_file_uri('js/modernizr-2.8.3-respond-1.4.2.min.js'), array('jquery'), MEDICLL_VERSION);

	wp_enqueue_script( 'medicll-bootstrap', get_theme_file_uri('js/bootstrap.min.js'), array(), MEDICLL_VERSION, true );
	wp_enqueue_script( 'medicll-moment', get_theme_file_uri('js/moment-with-locales.js'), array(), MEDICLL_VERSION, true );
	wp_enqueue_script( 'medicll-functions', get_theme_file_uri('js/functions.js'), array(), MEDICLL_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'medicll_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

require get_theme_file_path('inc/layout-functions.php');
