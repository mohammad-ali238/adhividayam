<?php

defined('ABSPATH') || exit;

if (!class_exists('ReduxFramework')) {
    return;
}

// This is your option name where all the Redux data is stored.
$opt_name = 'mediclf_framework_options';

$theme = wp_get_theme();
$args = array(
    // This is where your data is stored in the database and also becomes your global variable name.
    'opt_name' => $opt_name,
    // Name that appears at the top of your panel.
    'display_name' => $theme->get('Name'),
    // Version that appears at the top of your panel.
    'display_version' => $theme->get('Version'),
    // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only).
    'menu_type' => 'menu',
    // Show the sections below the admin menu item or not.
    'allow_sub_menu' => true,
    // The text to appear in the admin menu.
    'menu_title' => __('Theme Options', 'mediclf'),
    // The text to appear on the page title.
    'page_title' => __('Theme Options', 'mediclf'),
    // Enabled the Webfonts typography module to use asynchronous fonts.
    'async_typography' => false,
    // Disable to create your own google fonts loader.
    'disable_google_fonts_link' => false,
    // Show the panel pages on the admin bar.
    'admin_bar' => true,
    // Icon for the admin bar menu.
    'admin_bar_icon' => 'dashicons-portfolio',
    // Priority for the admin bar menu.
    'admin_bar_priority' => 50,
    // Sets a different name for your global variable other than the opt_name.
    'global_variable' => '',
    // Show the time the page took to load, etc (forced on while on localhost or when WP_DEBUG is enabled).
    'dev_mode' => false,
    // Enable basic customizer support.
    'customizer' => true,
    // Allow the panel to opened expanded.
    'open_expanded' => false,
    // Disable the save warning when a user changes a field.
    'disable_save_warn' => false,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_priority' => null,
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters.
    'page_parent' => 'themes.php',
    // Permissions needed to access the options panel.
    'page_permissions' => 'manage_options',
    // Specify a custom URL to an icon.
    'menu_icon' => '',
    // Force your panel to always open to a specific tab (by id).
    'last_tab' => '',
    // Icon displayed in the admin panel next to your menu_title.
    'page_icon' => 'icon-themes',
    // Page slug used to denote the panel, will be based off page title, then menu title, then opt_name if not provided.
    'page_slug' => $opt_name,
    // On load save the defaults to DB before user clicks save.
    'save_defaults' => true,
    // Display the default value next to each field when not set to the default value.
    'default_show' => false,
    // What to print by the field's title if the value shown is default.
    'default_mark' => '*',
    // Shows the Import/Export panel when not used as a field.
    'show_import_export' => true,
    // The time transinets will expire when the 'database' arg is set.
    'transient_time' => 60 * MINUTE_IN_SECONDS,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output.
    'output' => true,
    // Allows dynamic CSS to be generated for customizer and google fonts,
    // but stops the dynamic CSS from going to the page head.
    'output_tag' => true,
    // Disable the footer credit of Redux. Please leave if you can help it.
    'footer_credit' => '',
    // If you prefer not to use the CDN for ACE Editor.
    // You may download the Redux Vendor Support plugin to run locally or embed it in your code.
    'use_cdn' => true,
    // Set the theme of the option panel.  Use 'wp' to use a more modern style, default is classic.
    'admin_theme' => 'wp',
    // HINTS.
    'hints' => array(
        'icon' => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color' => 'lightgray',
        'icon_size' => 'normal',
        'tip_style' => array(
            'color' => 'red',
            'shadow' => true,
            'rounded' => false,
            'style' => '',
        ),
        'tip_position' => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect' => array(
            'show' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'mouseover',
            ),
            'hide' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'click mouseleave',
            ),
        ),
    ),
    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'database' => '',
    'network_admin' => true,
);

$redux_class = new Redux;

if (class_exists('Redux') && method_exists($redux_class, 'set_args')) {
    Redux::set_args($opt_name, $args);

    $gen_opts_atts = array();
    $gen_opts_atts[] = array(
        'id' => 'mediclf-site-logo',
        'type' => 'media',
        'url' => true,
        'title' => __('Site Logo', 'mediclf'),
        'compiler' => 'true',
        'desc' => __('Site Logo media uploader.', 'mediclf'),
        'subtitle' => __('Site Logo media uploader.', 'mediclf'),
        'default' => array('url' => trailingslashit(get_template_directory_uri()) . 'images/logo.png'),
    );
    $gen_opts_atts[] = array(
        'id' => 'mediclf-logo-width',
        'type' => 'slider',
        'title' => __('Logo Width', 'mediclf'),
        'subtitle' => __('Set Logo Width', 'mediclf'),
        'desc' => __('Set Logo Width in (px)', 'mediclf'),
        "default" => 0,
        "min" => 0,
        "step" => 1,
        "max" => 500,
        'display_value' => 'text'
    );
    $gen_opts_atts[] = array(
        'id' => 'mediclf-logo-height',
        'type' => 'slider',
        'title' => __('Logo Height', 'mediclf'),
        'subtitle' => __('Set Logo Height', 'mediclf'),
        'desc' => __('Set Logo Height in (px)', 'mediclf'),
        "default" => 0,
        "min" => 0,
        "step" => 1,
        "max" => 500,
        'display_value' => 'text'
    );
    $gen_opts_atts[] = array(
        'id' => 'mediclf-site-loader',
        'type' => 'button_set',
        'title' => __('Site loader', 'mediclf'),
        'subtitle' => __('Site loader on page loading.', 'mediclf'),
        'desc' => '',
        'options' => array(
            'on' => __('On', 'mediclf'),
            'off' => __('Off', 'mediclf'),
        ),
        'default' => 'on',
    );

    $redux_genral_options = array(
        'title' => __('General Options', 'mediclf'),
        'id' => 'general-options',
        'desc' => __('These are really basic options!', 'mediclf'),
        'icon' => 'el el-home',
        'fields' => apply_filters('mediclf_framewrok_options_general', $gen_opts_atts)
    );
    Redux::set_section($opt_name, $redux_genral_options);

    add_filter('redux/options/mediclf_framework_options/sections', 'mediclf_frame_plugin_core_settings', 1);

    function mediclf_frame_plugin_core_settings($setting_sections)
    {
        global $mediclf_framework_options, $wpdb;
        //
        $mediclf_framework_options = get_option('mediclf_framework_options');

        $header_opt_settings = array(
            'title' => __('Header', 'mediclf'),
            'id' => 'general-options-header',
            'desc' => __('Set Header Fields.', 'mediclf'),
            'icon' => 'el el-credit-card',
            'fields' => array()
        );

        $all_page = array('', __('Select Page', 'mediclf'));

        $args = array(
            'sort_order' => 'asc',
            'sort_column' => 'post_title',
            'hierarchical' => 1,
            'exclude' => '',
            'include' => '',
            'meta_key' => '',
            'meta_value' => '',
            'authors' => '',
            'child_of' => 0,
            'parent' => -1,
            'exclude_tree' => '',
            'number' => '',
            'offset' => 0,
            'post_type' => 'page',
            'post_status' => 'publish'
        );
        $pages = get_pages($args);
        if (!empty($pages)) {
            foreach ($pages as $page) {
                $all_page[$page->post_name] = $page->post_title;
            }
        }

        $header_opt_settings['fields'][] = array(
            'id' => 'header-style',
            'type' => 'select',
            'title' => __('Header Styles', 'mediclf'),
            'subtitle' => '',
            'desc' => '',
            'options' => array(
                'style1' => __('Header Style 1', 'mediclf'),
                'style2' => __('Header Style 2', 'mediclf'),
            ),
            'default' => 'style1',
        );
        $header_opt_settings['fields'][] = array(
            'id' => 'header_email',
            'type' => 'text',
            'title' => __('Header Email', 'mediclf'),
            'required' => array('header-style', 'equals', 'style9'),
            'subtitle' => __('Put email address here to show on header left', 'mediclf'),
            'desc' => '',
            'default' => '',
        );
        $header_opt_settings['fields'][] = array(
            'id' => 'header_phone',
            'type' => 'text',
            'title' => __('Header Phone', 'mediclf'),
            'required' => array('header-style', 'equals', 'style9'),
            'subtitle' => __('Put phone number  here to show on header left', 'mediclf'),
            'desc' => '',
            'default' => '',
        );
        $header_opt_settings['fields'][] = array(
            'id' => 'mediclf-top-header',
            'type' => 'button_set',
            'title' => __('Top Header', 'mediclf'),
            'subtitle' => __('Top Header on/off.', 'mediclf'),
            'desc' => '',
            'options' => array(
                'on' => __('On', 'mediclf'),
                'off' => __('Off', 'mediclf'),
            ),
            'default' => 'off',
            'required' => array('header-style', 'equals', 'style12'),
        );
        $header_opt_settings['fields'] = apply_filters('mediclf_framewrok_options_headers', $header_opt_settings['fields']);
        $setting_sections[] = $header_opt_settings;
        $section_settings = array(
            'title' => __('Sub Header', 'mediclf'),
            'id' => 'subheader-options',
            'desc' => __('Default Sub Header settings.', 'mediclf'),
            'icon' => 'el el-lines',
            'fields' => array(
                array(
                    'id' => 'mediclf-subheader',
                    'type' => 'button_set',
                    'title' => __('Sub Header', 'mediclf'),
                    'subtitle' => __('Sub Header on/off.', 'mediclf'),
                    'desc' => '',
                    'options' => array(
                        'on' => __('On', 'mediclf'),
                        'off' => __('Off', 'mediclf'),
                    ),
                    'default' => 'on',
                ),
                array(
                    'id' => 'mediclf-subheader-height',
                    'type' => 'slider',
                    'title' => __('Sub Header Height', 'mediclf'),
                    'required' => array('mediclf-subheader', 'equals', 'on'),
                    'subtitle' => __('Set Sub Header Height', 'mediclf'),
                    'desc' => __('Set Sub Header Height in (px)', 'mediclf'),
                    "default" => 0,
                    "min" => 0,
                    "step" => 1,
                    "max" => 1000,
                    'display_value' => 'text'
                ),
                array(
                    'id' => 'mediclf-subheader-pading-top',
                    'type' => 'slider',
                    'title' => __('Padding Top', 'mediclf'),
                    'required' => array('mediclf-subheader', 'equals', 'on'),
                    'subtitle' => __('Set Sub Header Padding Top', 'mediclf'),
                    'desc' => __('Set Sub Header Padding Top', 'mediclf'),
                    "default" => 0,
                    "min" => 0,
                    "step" => 1,
                    "max" => 1000,
                    'display_value' => 'text'
                ),
                array(
                    'id' => 'mediclf-subheader-pading-bottom',
                    'type' => 'slider',
                    'title' => __('Padding Bottom', 'mediclf'),
                    'required' => array('mediclf-subheader', 'equals', 'on'),
                    'subtitle' => __('Set Sub Header Padding Bottom', 'mediclf'),
                    'desc' => __('Set Sub Header Padding Bottom', 'mediclf'),
                    "default" => 0,
                    "min" => 0,
                    "step" => 1,
                    "max" => 1000,
                    'display_value' => 'text'
                ),
                array(
                    'id' => 'mediclf-subheader-title',
                    'type' => 'button_set',
                    'title' => __('Sub Header Title', 'mediclf'),
                    'required' => array('mediclf-subheader', 'equals', 'on'),
                    'subtitle' => __('Sub Header Title on/off.', 'mediclf'),
                    'desc' => '',
                    'options' => array(
                        'on' => __('On', 'mediclf'),
                        'off' => __('Off', 'mediclf'),
                    ),
                    'default' => 'on',
                ),
                array(
                    'id' => 'mediclf-subheader-breadcrumb',
                    'type' => 'button_set',
                    'title' => __('Sub Header Breadcrumb', 'mediclf'),
                    'required' => array('mediclf-subheader', 'equals', 'on'),
                    'subtitle' => __('Sub Header Breadcrumb on/off.', 'mediclf'),
                    'desc' => '',
                    'options' => array(
                        'on' => __('On', 'mediclf'),
                        'off' => __('Off', 'mediclf'),
                    ),
                    'default' => 'on',
                ),
                array(
                    'id' => 'mediclf-subheader-bg-img',
                    'type' => 'media',
                    'url' => true,
                    'title' => __('Sub Header Background Image', 'mediclf'),
                    'required' => array('mediclf-subheader', 'equals', 'on'),
                    'compiler' => 'true',
                    'desc' => '',
                    'subtitle' => __('Sub Header media uploader.', 'mediclf'),
                    'default' => '',
                ),
                array(
                    'id' => 'mediclf-subheader-bg-color',
                    'type' => 'color_rgba',
                    'transparent' => false,
                    'title' => __('Sub Header Background Color', 'mediclf'),
                    'required' => array('mediclf-subheader', 'equals', 'on'),
                    'subtitle' => __('Set Sub Header Background Color.', 'mediclf'),
                    'desc' => '',
                    'default' => 'rgba(17,22,44,0.66)'
                ),

            )
        );

        $setting_sections[] = $section_settings;
        
        // footer section start
        $header_opt_settings = array(
            'title' => __('Footer', 'mediclf'),
            'id' => 'general-options-footer',
            'desc' => __('Set Footer Fields.', 'mediclf'),
            'icon' => 'el el-tasks',
            'fields' => array(
                array(
                    'id' => 'footer-style',
                    'type' => 'select',
                    'title' => __('Footer Style', 'mediclf'),
                    'subtitle' => '',
                    'desc' => '',
                    'options' => array(
                        'style1' => __('Footer Style 1', 'mediclf'),
                        'style2' => __('Footer Style 2', 'mediclf'),
                    ),
                    'default' => 'style1',
                ),
                array(
                    'id' => 'mediclf-footer-copyright-text',
                    'type' => 'textarea',
                    'title' => __('Copyright Text', 'mediclf'),
                    'subtitle' => __('Set Copyright Text here.', 'mediclf'),
                    'desc' => '',
                    'default' => sprintf(__('&copy; Copyrights %s. %s All rights reserved.', 'mediclf'), date('Y'), get_bloginfo('name')),
                ),
                array(
                    'id' => 'footer-background',
                    'type' => 'media',
                    'url' => true,
                    'title' => __('Footer Background', 'mediclf'),
                    'compiler' => 'true',
                    'desc' => __('Footer Background media uploader.', 'mediclf'),
                    'subtitle' => __('Footer Background media uploader.', 'mediclf'),
                    'default' => array('url' => ''),
                ),
            )
        );
        $setting_sections[] = $header_opt_settings;

        // footer sidebars section start
        $footer_sidebar_settings = array(
            'title' => __('Footer Sidebars', 'mediclf'),
            'id' => 'footer-sidebar-options',
            'desc' => __('Set Footer Sidebars.', 'mediclf'),
            'icon' => 'el el-th',
            'fields' => array(
                array(
                    'id' => 'mediclf-footer-sidebar-switch',
                    'type' => 'button_set',
                    'title' => __('Footer Widgets Area', 'mediclf'),
                    'subtitle' => __('Footer Widgets Area on/off', 'mediclf'),
                    'desc' => '',
                    'options' => array(
                        'on' => __('On', 'mediclf'),
                        'off' => __('Off', 'mediclf'),
                    ),
                    'default' => 'off',
                ),
                array(
                    'id' => 'mediclf-footer-sidebars',
                    'type' => 'mediclf_multi_select',
                    'select_title' => __('Select Column Width', 'mediclf'),
                    'input_title' => __('Sidebar Name', 'mediclf'),
                    'select_name' => 'col_width',
                    'input_name' => 'sidebar_name',
                    'add_more_text' => __('Add Sidebar', 'mediclf'),
                    'select_options' => array(
                        '12_12' => '12/12',
                        '6_12' => '6/12',
                        '4_12' => '4/12',
                        '3_12' => '3/12',
                        '9_12' => '9/12',
                        '2_12' => '2/12',
                        '10_12' => '10/12',
                        '8_12' => '8/12',
                        '5_12' => '5/12',
                        '7_12' => '7/12',
                    ),
                    'title' => __('Footer Sidebars', 'mediclf'),
                    'required' => array('mediclf-footer-sidebar-switch', 'equals', 'on'),
                    'subtitle' => __('Set Footer Sidebars here.', 'mediclf'),
                    'desc' => '',
                    'default' => '',
                ),
            )
        );
        $setting_sections[] = $footer_sidebar_settings;

        $section_settings = array(
            'title' => __('Color', 'mediclf'),
            'id' => 'theme-all-colors',
            'desc' => __('Set the First color for theme.', 'mediclf'),
            'icon' => 'el el-brush',
            'fields' => array(
                array(
                    'id' => 'mediclf-main-color',
                    'type' => 'color',
                    'transparent' => false,
                    'title' => __('Theme Color', 'mediclf'),
                    'subtitle' => __('Set Main Theme Color.', 'mediclf'),
                    'desc' => '',
                    'default' => ''
                ),
                array(
                    'id' => 'mediclf-body-color',
                    'type' => 'color',
                    'transparent' => false,
                    'title' => __('Body Background Color', 'mediclf'),
                    'subtitle' => __('Set Body Background Color.', 'mediclf'),
                    'desc' => '',
                    'default' => ''
                ),
                array(
                    'id' => 'header-colors-section',
                    'type' => 'section',
                    'title' => __('Header Colors', 'mediclf'),
                    'subtitle' => '',
                    'indent' => true,
                ),
                array(
                    'id' => 'header-bg-color',
                    'type' => 'color_rgba',
                    'transparent' => true,
                    'title' => __('Header Background Color', 'mediclf'),
                    'subtitle' => '',
                    'desc' => __('This color will apply to Header Background.', 'mediclf'),
                    'default' => '#ffffff',
                ),
                array(
                    'id' => 'header-links-color',
                    'type' => 'color_rgba',
                    'transparent' => true,
                    'title' => __('Link Color', 'mediclf'),
                    'subtitle' => '',
                    'desc' => __('This color will apply to the header links.', 'mediclf'),
                    'default' => '#6a6a6a',
                ),
                array(
                    'id' => 'header-txts-color',
                    'type' => 'color_rgba',
                    'transparent' => true,
                    'title' => __('Text Color', 'mediclf'),
                    'subtitle' => '',
                    'desc' => __('This color will apply to the header text.', 'mediclf'),
                    'default' => '#6a6a6a',
                ),
                array(
                    'id' => 'header-icons-color',
                    'type' => 'color_rgba',
                    'transparent' => true,
                    'title' => __('Icons Color', 'mediclf'),
                    'subtitle' => '',
                    'desc' => __('This color will apply to the header icons.', 'mediclf'),
                    'default' => '#00adef',
                ),
                array(
                    'id' => 'header-btn-bg-color',
                    'type' => 'color_rgba',
                    'transparent' => true,
                    'title' => __('Buttons Background Color', 'mediclf'),
                    'subtitle' => '',
                    'desc' => __('This color will apply to Header Background Buttons.', 'mediclf'),
                    'default' => '#ffffff',
                ),
                array(
                    'id' => 'header-btn-text-color',
                    'type' => 'color_rgba',
                    'transparent' => true,
                    'title' => __('Buttons Text Color', 'mediclf'),
                    'subtitle' => '',
                    'desc' => __('This color will apply to the header buttons text.', 'mediclf'),
                    'default' => '#6a6a6a',
                ),
                array(
                    'id' => 'menu-colors-section',
                    'type' => 'section',
                    'title' => __('Header Menu Colors', 'mediclf'),
                    'subtitle' => '',
                    'indent' => true,
                ),
                array(
                    'id' => 'menu-link-color',
                    'type' => 'link_color',
                    'title' => __('Menu Links Color', 'mediclf'),
                    'subtitle' => '',
                    'visited' => true,
                    'desc' => __('These colors will apply to header navigation menu items.', 'mediclf'),
                    'default' => array(
                        'regular' => '#656c6c',
                        'hover' => '#13b5ea',
                        'active' => '#13b5ea',
                        'visited' => '',
                    )
                ),
                array(
                    'id' => 'submenu-bg-color',
                    'type' => 'color',
                    'transparent' => false,
                    'title' => __('SubMenu Background Color', 'mediclf'),
                    'subtitle' => '',
                    'desc' => __('This color will apply to SubMenu Background.', 'mediclf'),
                    'default' => '#ffffff',
                ),
                array(
                    'id' => 'submenu-link-color',
                    'type' => 'link_color',
                    'title' => __('SubMenu Links Color', 'mediclf'),
                    'subtitle' => '',
                    'visited' => true,
                    'desc' => __('These colors will apply to header navigation sub-menu items.', 'mediclf'),
                    'default' => array(
                        'regular' => '#656c6c',
                        'hover' => '#13b5ea',
                        'active' => '#13b5ea',
                        'visited' => '',
                    )
                ),

                array(
                    'id' => 'footer-colors-section',
                    'type' => 'section',
                    'title' => __('Footer Colors', 'mediclf'),
                    'subtitle' => '',
                    'indent' => true,
                ),
                array(
                    'id' => 'footer-bg-color',
                    'type' => 'color',
                    'transparent' => false,
                    'title' => __('Footer Background Color', 'mediclf'),
                    'subtitle' => '',
                    'desc' => __('This color will apply on the Footer Background.', 'mediclf'),
                    'default' => '#26272b',
                ),
                array(
                    'id' => 'footer-text-color',
                    'type' => 'color',
                    'transparent' => false,
                    'title' => __('Footer Text Color', 'mediclf'),
                    'subtitle' => '',
                    'desc' => __('This color will apply to Footer Text.', 'mediclf'),
                    'default' => '#999999',
                ),
                array(
                    'id' => 'footer-link-color',
                    'type' => 'link_color',
                    'title' => __('Footer Links Color Option', 'mediclf'),
                    'subtitle' => '',
                    'visited' => true,
                    'desc' => __('These colors will apply to Footer links.', 'mediclf'),
                    'default' => array(
                        'regular' => '#999999',
                        'hover' => '#ffffff',
                        'active' => '#999999',
                        'visited' => '#ffffff',
                    )
                ),
                array(
                    'id' => 'footer-border-color',
                    'type' => 'color',
                    'transparent' => false,
                    'title' => __('Footer Borders Color', 'mediclf'),
                    'subtitle' => '',
                    'desc' => __('This color will apply on Footer all Borders like widgets etc.', 'mediclf'),
                    'default' => '#2e2e2e',
                ),
                array(
                    'id' => 'footer-copyright-bgcolor',
                    'type' => 'color',
                    'transparent' => false,
                    'title' => __('Footer copyright Background', 'mediclf'),
                    'subtitle' => '',
                    'desc' => __('This color will apply to Footer copyright Background.', 'mediclf'),
                    'default' => '#26272b',
                ),
                array(
                    'id' => 'footer-copyright-color',
                    'type' => 'color',
                    'transparent' => false,
                    'title' => __('Footer copyright Text Color', 'mediclf'),
                    'subtitle' => '',
                    'desc' => __('This color will apply to Footer copyright Text.', 'mediclf'),
                    'default' => '#999999',
                ),
            ),
        );
        $setting_sections[] = $section_settings;

        $footer_sidebar_settings = array(
            'title' => __('Typography', 'mediclf'),
            'id' => 'custom-typo-sec',
            'desc' => '',
            'icon' => 'el el-font',
            'fields' => array(
                array(
                    'id' => 'body-typo',
                    'type' => 'typography',
                    'title' => __('Body Typography', 'mediclf'),
                    'google' => true,
                    'text-transform' => true,
                    'letter-spacing' => true,
                    'word-spacing' => true,
                    'text-align' => false,
                    'font-backup' => true,
                    'output' => array('body', 'p', 'li'),
                    'units' => 'px',
                    'subtitle' => __('Typography options with each property can be called individually.', 'mediclf'),
                    'default' => array(
                        'color' => '#333333',
                        'font-style' => 'normal',
                        'font-family' => 'Roboto',
                        'google' => true,
                        'font-size' => '14px',
                        'line-height' => '20px'
                    ),
                ),
                array(
                    'id' => 'menu-typo',
                    'type' => 'typography',
                    'title' => __('Menu Typography', 'mediclf'),
                    'google' => true,
                    'color' => false,
                    'text-transform' => true,
                    'letter-spacing' => true,
                    'word-spacing' => true,
                    'text-align' => false,
                    'font-backup' => true,
                    'output' => array('.navbar-nav > li > a', '.mediclf-header-six .navbar-nav > li > a'),
                    'units' => 'px',
                    'subtitle' => __('Typography options with each property can be called individually.', 'mediclf'),
                    'default' => array(
                        'font-style' => 'normal',
                        'font-family' => 'Roboto',
                        'google' => true,
                        'font-size' => '14px',
                        'line-height' => '20px'
                    ),
                ),
                array(
                    'id' => 'submenu-typo',
                    'type' => 'typography',
                    'title' => __('SubMenu Typography', 'mediclf'),
                    'google' => true,
                    'text-transform' => true,
                    'letter-spacing' => true,
                    'word-spacing' => true,
                    'text-align' => false,
                    'color' => false,
                    'font-backup' => true,
                    'output' => array('.navbar-nav .sub-menu li a', '.navbar-nav .children li a', '.mediclf-megalist li a'),
                    'units' => 'px',
                    'subtitle' => __('Typography options with each property can be called individually.', 'mediclf'),
                    'default' => array(
                        'font-style' => 'normal',
                        'font-family' => 'Roboto',
                        'google' => true,
                        'font-size' => '14px',
                        'line-height' => '20px'
                    ),
                ),
                array(
                    'id' => 'h1-typo',
                    'type' => 'typography',
                    'title' => __('H1 Typography', 'mediclf'),
                    'google' => true,
                    'text-transform' => true,
                    'letter-spacing' => true,
                    'word-spacing' => true,
                    'text-align' => false,
                    'font-backup' => true,
                    'output' => array('h1', 'body h1'),
                    'units' => 'px',
                    'subtitle' => __('Typography options with each property can be called individually.', 'mediclf'),
                    'default' => array(
                        'color' => '#333333',
                        'font-style' => 'normal',
                        'font-family' => 'Roboto',
                        'google' => true,
                        'font-size' => '26px',
                        'line-height' => '30px'
                    ),
                ),
                array(
                    'id' => 'h2-typo',
                    'type' => 'typography',
                    'title' => __('H2 Typography', 'mediclf'),
                    'google' => true,
                    'text-transform' => true,
                    'letter-spacing' => true,
                    'word-spacing' => true,
                    'text-align' => false,
                    'font-backup' => true,
                    'output' => array('h2', 'body h2'),
                    'units' => 'px',
                    'subtitle' => __('Typography options with each property can be called individually.', 'mediclf'),
                    'default' => array(
                        'color' => '#333333',
                        'font-style' => 'normal',
                        'font-family' => 'Roboto',
                        'google' => true,
                        'font-size' => '24px',
                        'line-height' => '28px'
                    ),
                ),
                array(
                    'id' => 'h3-typo',
                    'type' => 'typography',
                    'title' => __('H3 Typography', 'mediclf'),
                    'google' => true,
                    'text-transform' => true,
                    'letter-spacing' => true,
                    'word-spacing' => true,
                    'text-align' => false,
                    'font-backup' => true,
                    'output' => array('h3', 'body h3'),
                    'units' => 'px',
                    'subtitle' => __('Typography options with each property can be called individually.', 'mediclf'),
                    'default' => array(
                        'color' => '#333333',
                        'font-style' => 'normal',
                        'font-family' => 'Roboto',
                        'google' => true,
                        'font-size' => '22px',
                        'line-height' => '26px'
                    ),
                ),
                array(
                    'id' => 'h4-typo',
                    'type' => 'typography',
                    'title' => __('H4 Typography', 'mediclf'),
                    'google' => true,
                    'text-transform' => true,
                    'letter-spacing' => true,
                    'word-spacing' => true,
                    'text-align' => false,
                    'font-backup' => true,
                    'output' => array('h4', 'body h4'),
                    'units' => 'px',
                    'subtitle' => __('Typography options with each property can be called individually.', 'mediclf'),
                    'default' => array(
                        'color' => '#333333',
                        'font-style' => 'normal',
                        'font-family' => 'Roboto',
                        'google' => true,
                        'font-size' => '20px',
                        'line-height' => '24px'
                    ),
                ),
                array(
                    'id' => 'h5-typo',
                    'type' => 'typography',
                    'title' => __('H5 Typography', 'mediclf'),
                    'google' => true,
                    'text-transform' => true,
                    'letter-spacing' => true,
                    'word-spacing' => true,
                    'text-align' => false,
                    'font-backup' => true,
                    'output' => array('h5', 'body h5'),
                    'units' => 'px',
                    'subtitle' => __('Typography options with each property can be called individually.', 'mediclf'),
                    'default' => array(
                        'color' => '#333333',
                        'font-style' => 'normal',
                        'font-family' => 'Roboto',
                        'google' => true,
                        'font-size' => '18px',
                        'line-height' => '22px'
                    ),
                ),
                array(
                    'id' => 'h6-typo',
                    'type' => 'typography',
                    'title' => __('H6 Typography', 'mediclf'),
                    'google' => true,
                    'text-transform' => true,
                    'letter-spacing' => true,
                    'word-spacing' => true,
                    'text-align' => false,
                    'font-backup' => true,
                    'output' => array('h6', 'body h6'),
                    'units' => 'px',
                    'subtitle' => __('Typography options with each property can be called individually.', 'mediclf'),
                    'default' => array(
                        'color' => '#333333',
                        'font-style' => 'normal',
                        'font-family' => 'Roboto',
                        'google' => true,
                        'font-size' => '16px',
                        'line-height' => '20px'
                    ),
                ),
                array(
                    'id' => 'fancy-title-typo',
                    'type' => 'typography',
                    'title' => __('Fancy Title Typography', 'mediclf'),
                    'google' => true,
                    'text-transform' => true,
                    'letter-spacing' => true,
                    'word-spacing' => true,
                    'text-align' => false,
                    'font-backup' => true,
                    'output' => array('.mediclf-fancy-title h2'),
                    'units' => 'px',
                    'subtitle' => __('Typography options with each property can be called individually.', 'mediclf'),
                    'default' => array(
                        'color' => '#333333',
                        'font-style' => 'normal',
                        'font-family' => 'Roboto',
                        'google' => true,
                        'font-size' => '24px',
                        'line-height' => '28px'
                    ),
                ),
                array(
                    'id' => 'page-title-typo',
                    'type' => 'typography',
                    'title' => __('Page Title Typography', 'mediclf'),
                    'google' => true,
                    'text-transform' => true,
                    'letter-spacing' => true,
                    'word-spacing' => true,
                    'text-align' => false,
                    'font-backup' => true,
                    'output' => array('.mediclf-page-title h1'),
                    'units' => 'px',
                    'subtitle' => __('Typography options with each property can be called individually.', 'mediclf'),
                    'default' => array(
                        'color' => '#ffffff',
                        'font-style' => '600',
                        'font-family' => 'Roboto',
                        'google' => true,
                        'font-size' => '30px',
                        'line-height' => '34px'
                    ),
                ),
                array(
                    'id' => 'sidebar-widget-typo',
                    'type' => 'typography',
                    'title' => __('Sidebar widget title Typography', 'mediclf'),
                    'google' => true,
                    'text-transform' => true,
                    'letter-spacing' => true,
                    'word-spacing' => true,
                    'text-align' => false,
                    'font-backup' => true,
                    'output' => array('.mediclf-widget-title h2'),
                    'units' => 'px',
                    'subtitle' => __('Typography options with each property can be called individually.', 'mediclf'),
                    'default' => array(
                        'color' => '#333333',
                        'font-style' => 'normal',
                        'font-family' => 'Roboto',
                        'google' => true,
                        'font-size' => '20px',
                        'line-height' => '24px'
                    ),
                ),
                array(
                    'id' => 'footer-widget-typo',
                    'type' => 'typography',
                    'title' => __('Footer widget title Typography', 'mediclf'),
                    'google' => true,
                    'text-transform' => true,
                    'letter-spacing' => true,
                    'word-spacing' => true,
                    'text-align' => false,
                    'font-backup' => true,
                    'output' => array('.footer-widget-title h2,.mediclf-footer-title3 h2,.mediclf-footer-title4 h2'),
                    'units' => 'px',
                    'subtitle' => __('Typography options with each property can be called individually.', 'mediclf'),
                    'default' => array(
                        'color' => '#ffffff',
                        'font-style' => 'normal',
                        'font-family' => 'Roboto',
                        'google' => true,
                        'font-size' => '18px',
                        'line-height' => '22px'
                    ),
                ),
            )
        );
        $setting_sections[] = $footer_sidebar_settings;

        $section_settings = array(
            'title' => __('Social Sharing', 'mediclf'),
            'id' => 'social-sharing',
            'desc' => __('Select platforms to share your posts.', 'mediclf'),
            'icon' => 'el el-share',
            'fields' => array(
                array(
                    'id' => 'mediclf-social-sharing-facebook',
                    'type' => 'button_set',
                    'title' => __('Facebook', 'mediclf'),
                    'subtitle' => __('Social Sharing on Facebook.', 'mediclf'),
                    'desc' => '',
                    'options' => array(
                        'on' => __('On', 'mediclf'),
                        'off' => __('Off', 'mediclf'),
                    ),
                    'default' => 'on',
                ),
                array(
                    'id' => 'mediclf-social-sharing-twitter',
                    'type' => 'button_set',
                    'title' => __('Twitter', 'mediclf'),
                    'subtitle' => __('Social Sharing on Twitter.', 'mediclf'),
                    'desc' => '',
                    'options' => array(
                        'on' => __('On', 'mediclf'),
                        'off' => __('Off', 'mediclf'),
                    ),
                    'default' => 'on',
                ),
                array(
                    'id' => 'mediclf-social-sharing-google',
                    'type' => 'button_set',
                    'title' => __('Google Plus', 'mediclf'),
                    'subtitle' => __('Social Sharing on Google Plus.', 'mediclf'),
                    'desc' => '',
                    'options' => array(
                        'on' => __('On', 'mediclf'),
                        'off' => __('Off', 'mediclf'),
                    ),
                    'default' => 'on',
                ),
                array(
                    'id' => 'mediclf-social-sharing-tumblr',
                    'type' => 'button_set',
                    'title' => __('Tumblr', 'mediclf'),
                    'subtitle' => __('Social Sharing on Tumblr.', 'mediclf'),
                    'desc' => '',
                    'options' => array(
                        'on' => __('On', 'mediclf'),
                        'off' => __('Off', 'mediclf'),
                    ),
                    'default' => 'on',
                ),
                array(
                    'id' => 'mediclf-social-sharing-dribbble',
                    'type' => 'button_set',
                    'title' => __('Dribbble', 'mediclf'),
                    'subtitle' => __('Social Sharing on Dribbble.', 'mediclf'),
                    'desc' => '',
                    'options' => array(
                        'on' => __('On', 'mediclf'),
                        'off' => __('Off', 'mediclf'),
                    ),
                    'default' => 'on',
                ),
                array(
                    'id' => 'mediclf-social-sharing-stumbleupon',
                    'type' => 'button_set',
                    'title' => __('StumbleUpon', 'mediclf'),
                    'subtitle' => __('Social Sharing on StumbleUpon.', 'mediclf'),
                    'desc' => '',
                    'options' => array(
                        'on' => __('On', 'mediclf'),
                        'off' => __('Off', 'mediclf'),
                    ),
                    'default' => 'on',
                ),
                array(
                    'id' => 'mediclf-social-sharing-youtube',
                    'type' => 'button_set',
                    'title' => __('Youtube', 'mediclf'),
                    'subtitle' => __('Social Sharing on Youtube.', 'mediclf'),
                    'desc' => '',
                    'options' => array(
                        'on' => __('On', 'mediclf'),
                        'off' => __('Off', 'mediclf'),
                    ),
                    'default' => 'on',
                ),
                array(
                    'id' => 'mediclf-social-sharing-more',
                    'type' => 'button_set',
                    'title' => __('Share More', 'mediclf'),
                    'subtitle' => __('Social Sharing on other platforms.', 'mediclf'),
                    'desc' => '',
                    'options' => array(
                        'on' => __('On', 'mediclf'),
                        'off' => __('Off', 'mediclf'),
                    ),
                    'default' => 'on',
                ),
            )
        );
        $setting_sections[] = $section_settings;

        $section_settings = array(
            'title' => __('Social Networking', 'mediclf'),
            'id' => 'social-networking',
            'desc' => __('Set profile links for your Social Networking platforms.', 'mediclf'),
            'icon' => 'el el-random',
            'fields' => array(
                array(
                    'id' => 'mediclf-social-networking-twitter',
                    'type' => 'text',
                    'title' => __('Twitter', 'mediclf'),
                    'subtitle' => __('Set a profile link for Twitter.', 'mediclf'),
                    'desc' => '',
                    'default' => '',
                ),
                array(
                    'id' => 'mediclf-social-networking-facebook',
                    'type' => 'text',
                    'title' => __('Facebook', 'mediclf'),
                    'subtitle' => __('Set a profile link for Facebook.', 'mediclf'),
                    'desc' => '',
                    'default' => '',
                ),
                array(
                    'id' => 'mediclf-social-networking-google',
                    'type' => 'text',
                    'title' => __('Google Plus', 'mediclf'),
                    'subtitle' => __('Set a profile link for Google Plus.', 'mediclf'),
                    'desc' => '',
                    'default' => '',
                ),
                array(
                    'id' => 'mediclf-social-networking-youtube',
                    'type' => 'text',
                    'title' => __('YouTube', 'mediclf'),
                    'subtitle' => __('Set a profile link for youtube.', 'mediclf'),
                    'desc' => '',
                    'default' => '',
                ),
                array(
                    'id' => 'mediclf-social-networking-vimeo',
                    'type' => 'text',
                    'title' => __('Vimeo', 'mediclf'),
                    'subtitle' => __('Set a profile link for Vimeo.', 'mediclf'),
                    'desc' => '',
                    'default' => '',
                ),
                array(
                    'id' => 'mediclf-social-networking-linkedin',
                    'type' => 'text',
                    'title' => __('Linkedin', 'mediclf'),
                    'subtitle' => __('Set a profile link for linkedin.', 'mediclf'),
                    'desc' => '',
                    'default' => '',
                ),
                array(
                    'id' => 'mediclf-social-networking-pinterest',
                    'type' => 'text',
                    'title' => __('Pinterest', 'mediclf'),
                    'subtitle' => __('Set a profile link for Pinterest.', 'mediclf'),
                    'desc' => '',
                    'default' => '',
                ),
                array(
                    'id' => 'mediclf-social-networking-instagram',
                    'type' => 'text',
                    'title' => __('Instagram', 'mediclf'),
                    'subtitle' => __('Set a profile link for Instagram.', 'mediclf'),
                    'desc' => '',
                    'default' => '',
                ),
            )
        );
        $setting_sections[] = $section_settings;

        $api_set_arr = array();
        
        $api_set_arr[] = array(
            'id' => 'google-api-section',
            'type' => 'section',
            'title' => __('Google API settings section.', 'mediclf'),
            'subtitle' => '',
            'indent' => true,
        );
        $api_set_arr[] = array(
            'id' => 'mediclf-google-api-key',
            'type' => 'text',
            'transparent' => false,
            'title' => __('API Key', 'mediclf'),
            'subtitle' => __('Please enter the API key of your Google account.', 'mediclf'),
            'desc' => '',
            'default' => ''
        );

        $section_settings = array(
            'title' => __('API Settings', 'mediclf'),
            'id' => 'api-settings',
            'desc' => __('Set API\'s for theme.', 'mediclf'),
            'icon' => 'el el-idea',
            'fields' => $api_set_arr,
        );
        $setting_sections[] = $section_settings;

        if (!function_exists('get_editable_roles')) {
            require_once ABSPATH . 'wp-admin/includes/user.php';
        }
        $tmp_roles = get_editable_roles();
        $roles = array();
        foreach ($tmp_roles as $tmp_role => $details) {
            $name = translate_user_role($details['name']);
            $roles[$tmp_role] = $name;
        }

        // footer section start
        $sidebars_array = array('' => esc_html__('Select Sidebar', 'mediclf'));
        $mediclf_framework_sidebars = isset($mediclf_framework_options['mediclf-themes-sidebars']) ? $mediclf_framework_options['mediclf-themes-sidebars'] : '';
        if (is_array($mediclf_framework_sidebars) && sizeof($mediclf_framework_sidebars) > 0) {
            foreach ($mediclf_framework_sidebars as $sidebar) {
                $sidebars_array[sanitize_title($sidebar)] = $sidebar;
            }
        }
        $sidebar_opt_settings = array(
            'title' => __('Layouts', 'mediclf'),
            'id' => 'themes-layouts',
            'desc' => __('Set Theme layouts and sidebars list.', 'mediclf'),
            'icon' => 'el el-pause',
            'fields' => array(
                array(
                    'id' => 'mediclf-themes-sidebars',
                    'type' => 'multi_text',
                    'title' => __('Sidebars', 'mediclf'),
                    'subtitle' => __('Create a Dynamic List of Sidebars.', 'mediclf'),
                    'desc' => __('These Sidebars will list in Theme Appearance >> Widgets.', 'mediclf'),
                    'default' => '',
                ),
                array(
                    'id' => 'mediclf-default-layout',
                    'type' => 'image_select',
                    'title' => __('Select Layout', 'mediclf'),
                    'subtitle' => '',
                    'desc' => __('Select default Layout for default pages.', 'mediclf'),
                    'options' => array(
                        'full' => array(
                            'alt' => __('Full Width', 'mediclf'),
                            'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                        ),
                        'right' => array(
                            'alt' => __('Right Sidebar', 'mediclf'),
                            'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                        ),
                        'left' => array(
                            'alt' => __('Left Sidebar', 'mediclf'),
                            'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                        ),
                    ),
                    'default' => ''
                ),
                array(
                    'id' => 'mediclf-default-sidebar',
                    'type' => 'select',
                    'title' => __('Select Sidebar', 'mediclf'),
                    'required' => array('mediclf-default-layout', '!=', 'full'),
                    'subtitle' => '',
                    'desc' => __('Select default Sidebars for default pages.', 'mediclf'),
                    'options' => $sidebars_array,
                    'default' => ''
                ),
            )
        );

        $setting_sections[] = $sidebar_opt_settings;

        $footer_sidebar_settings = array(
            'title' => __('Custom Js', 'mediclf'),
            'id' => 'custom-css-js',
            'desc' => __('Add Custom Js code.', 'mediclf'),
            'icon' => 'el el-edit',
            'fields' => array(
                array(
                    'id' => 'javascript_editor',
                    'type' => 'ace_editor',
                    'title' => __('Js Code', 'mediclf'),
                    'subtitle' => __('Paste your Js code here.', 'mediclf'),
                    'mode' => 'javascript',
                    'theme' => 'chrome',
                    'desc' => __('Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.', 'mediclf'),
                    'default' => "jQuery(document).ready(function(){\n\n});"
                ),
            )
        );
        $setting_sections[] = $footer_sidebar_settings;

        return $setting_sections;
    }
}