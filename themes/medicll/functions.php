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
