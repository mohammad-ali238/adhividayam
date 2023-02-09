<?php
// This is the export file that writes json files
// Your build process should probably exclude this file from the final theme zip, but it doesn't really matter.
// Change line 100 where it has the hard coded: /../theme/images/stock/ path
// This is the path where media files are copied to during export.
// Change this to your theme folder images/stock/ path, whatever that may be.
// The importer will look for local 'images/stock/*.jpg' files during import.
// Also change the json export path near the bottom: theme/plugins/demo-data-setup/content/

$default_content = array();
$post_types = array('attachment', 'post', 'page', 'job', 'candidate', 'employer', 'package', 'faq');
foreach (get_post_types() as $post_type) {
    if (!in_array($post_type, $post_types)) { // which post types to ignore.
        $post_types[] = $post_type;
    }
}
$categories = get_categories(array('type' => ''));
$taxonomies = get_taxonomies();
//              print_r($categories);
foreach ($post_types as $post_type) {
    if (in_array($post_type, array('revision', 'event', 'event-recurring'))) {
        continue;
    } // post types to ignore.
    $args = array('post_type' => $post_type, 'posts_per_page' => - 1);
    $args['post_status'] = array('publish', 'private', 'inherit');
    if ($post_type == 'attachment') {
        
    }
    $post_datas = get_posts($args);
    if (!isset($default_content[$post_type])) {
        $default_content[$post_type] = array();
    }
    $object = get_post_type_object($post_type);
    if ($object && !empty($object->labels->singular_name)) {
        $type_title = $object->labels->name;
    } else {
        $type_title = ucwords($post_type) . 's';
    }

    foreach ($post_datas as $post_data) {
        $meta = get_post_meta($post_data->ID, '', true);
        
        foreach ($meta as $meta_key => $meta_val) {
            if (
            // which keys to nuke all the time
                    in_array($meta_key, array('_location_id')) ||
                    (
                    // which keys we want to keep all the time, using strpos:
                    strpos($meta_key, 'elementor') === false &&
                    strpos($meta_key, 'miraclesoftsolutions') === false &&
                    strpos($meta_key, 'vc_') === false &&
                    strpos($meta_key, 'wpb_') === false &&
                    strpos($meta_key, 'dtbwp_') === false &&
                    strpos($meta_key, '_slider') === false &&
                    // which post types we keep all meta values for:
                    !in_array($post_type, array(
                        'nav_menu_item',
                        'location',
                        'event',
                        'page',
                        'post',
                        'job',
                        'candidate',
                        'employer',
                        'faq',
                        'package',
                        'product',
                        'wpcf7_contact_form',
                    )) &&
                    // other meta keys we always want to keep:
                    !in_array($meta_key, array(
                        'dtbwp_post_title_details',
                        'dtbwp_page_style',
                        'sliderlink',
                        'slidercolor',
                        '_wp_attached_file',
                        '_thumbnail_id',
                    ))
                    )
            ) {
                unset($meta[$meta_key]);
            } else {
                $meta[$meta_key] = maybe_unserialize(get_post_meta($post_data->ID, $meta_key, true));
            }
        }
        if ($post_data->ID == 2) {
            //print_r($meta);
        }
        // copy stock images into the images/stock/ folder for theme import.
        if ($post_type == 'attachment') {
            $file = get_attached_file($post_data->ID);
            if (is_file($file)) {
                if (filesize($file) > 1500000) {
                    $image = wp_get_image_editor($file);
                    if (!is_wp_error($image)) {
                        list( $width, $height, $type, $attr ) = getimagesize($file);
                        $image->resize(min($width, 1200), null, false);
                        $image->save($file);
                    }
                }
                $post_data->guid = wp_get_attachment_url($post_data->ID);
                if (function_exists('medicll_demo_data_get_path') && is_dir(medicll_demo_data_get_path('content/'))) {
                    if (!is_dir(medicll_demo_data_get_path('content/images/'))) {
                        mkdir(medicll_demo_data_get_path('content/images/'), 0755);
                    }
                    $img_dir = medicll_demo_data_get_path('content/images/');
                    //if (isset($_GET['demo_path']) && $_GET['demo_path'] != '') {
                    //    $img_dir .= $_GET['demo_path'] . '/';
                    //    if (!is_dir($img_dir)) {
                    //        mkdir($img_dir, 0755);
                    //    }
                    //}
                    copy($file, $img_dir . basename($file));
                }
            }
            // fix for incorrect GUID when renaming files with the rename plugin, causes import to bust.
        }
        $terms = array();
        foreach ($taxonomies as $taxonomy) {
            $terms[$taxonomy] = wp_get_post_terms($post_data->ID, $taxonomy, array('fields' => 'all'));
            if ($terms[$taxonomy]) {
                foreach ($terms[$taxonomy] as $tax_id => $tax) {
                    if (!empty($tax->term_id)) {
                        $terms[$taxonomy][$tax_id]->meta = get_term_meta($tax->term_id);
                        if (!empty($terms[$taxonomy][$tax_id]->meta)) {
                            foreach ($terms[$taxonomy][$tax_id]->meta as $key => $val) {
                                if (is_array($val) && count($val) == 1 && isset($val[0])) {
                                    $terms[$taxonomy][$tax_id]->meta[$key] = $val[0];
                                }
                            }
                        }
                    }
                }
            }
        }
        $default_content[$post_type][] = array(
            'type_title' => $type_title,
            'post_id' => $post_data->ID,
            'post_title' => $post_data->post_title,
            'post_status' => $post_data->post_status,
            'post_name' => $post_data->post_name,
            'post_content' => $post_data->post_content,
            'post_excerpt' => $post_data->post_excerpt,
            'post_parent' => $post_data->post_parent,
            'menu_order' => $post_data->menu_order,
            'post_date' => $post_data->post_date,
            'post_date_gmt' => $post_data->post_date_gmt,
            'guid' => $post_data->guid,
            'post_mime_type' => $post_data->post_mime_type,
            'meta' => $meta,
            'terms' => $terms,
                //                          'other' => $post_data,
        );
    }
}
// put certain content at very end.
$nav = isset($default_content['nav_menu_item']) ? $default_content['nav_menu_item'] : array();
if ($nav) {
    unset($default_content['nav_menu_item']);
    $default_content['nav_menu_item'] = $nav;
}
//              print_r($default_content);
//              exit;
// find the ID of our menu names so we can import them into default menu locations and also the widget positions below.
$menus = get_terms('nav_menu');
$menu_ids = array();
foreach ($menus as $menu) {
    if ($menu->name == 'Main Menu') {
        $menu_ids['primary'] = $menu->term_id;
    } else if ($menu->name == 'Quick Links') {
        $menu_ids['footer_quick'] = $menu->term_id;
    }
}
// used for me to export my widget settings.
$widget_positions = get_option('sidebars_widgets');
$widget_options = array();
$my_options = array();
foreach ($widget_positions as $sidebar_name => $widgets) {
    if (is_array($widgets)) {
        foreach ($widgets as $widget_name) {
            $widget_name_strip = preg_replace('#-\d+$#', '', $widget_name);
            $widget_options[$widget_name_strip] = get_option('widget_' . $widget_name_strip);
        }
    }
}
// choose which custom options to load into defaults
$all_options = wp_load_alloptions();
//print_r($all_options);exit;
foreach ($all_options as $name => $value) {
    if (stristr($name, 'jobsearch_plugin_options') !== false) {
        $arr_value = maybe_unserialize($value);
        $my_options[$name] = json_encode($arr_value);
    }
}

$theme_options = array();
foreach ($all_options as $name => $value) {
    if (stristr($name, 'mediclf_framework_options') !== false) {
        $arr_value = maybe_unserialize($value);
        $theme_options[$name] = json_encode($arr_value);
    }
}

$custom_fields = array();
foreach ($all_options as $name => $value) {
    if (stristr($name, 'jobsearch_custom_field_') !== false) {
        $custom_fields[$name] = $value;
    }
}

$dir = '';
if (function_exists('medicll_demo_data_get_path')) {
    $dir = medicll_demo_data_get_path('content/');
}

if (is_dir($dir)) {

    // which style are we writing to?
    if (isset($_GET['demo_path']) && $_GET['demo_path'] != '') {
        $dir .= $_GET['demo_path'] . '/';
        if (!is_dir($dir)) {
            mkdir($dir, 0755);
        }
    }

    file_put_contents($dir . 'default.json', json_encode($default_content));
    file_put_contents($dir . 'widget_positions.json', json_encode($widget_positions));
    file_put_contents($dir . 'widget_options.json', json_encode($widget_options));
    file_put_contents($dir . 'menu.json', json_encode($menu_ids));
    file_put_contents($dir . 'theme_options.json', json_encode($theme_options));
            
    //////////////////
    if (function_exists('medicll_demo_data_get_path')) {
        global $wp_filesystem;
        require_once ABSPATH . '/wp-admin/includes/file.php';

        if (false === ($creds = request_filesystem_credentials(wp_nonce_url('post.php'), '', false, false, array()) )) {
            return true;
        }
        if (!WP_Filesystem($creds)) {
            request_filesystem_credentials(wp_nonce_url('post.php'), '', true, false, array());
            return true;
        }

        $saved_templates = get_option('wpb_js_templates');
        if (!empty($saved_templates)) {
            $wp_bakery_dir = medicll_demo_data_get_path('content/') . 'wp_bakery_templates/';
            if (!is_dir($wp_bakery_dir)) {
                @mkdir($wp_bakery_dir, 0755);
            }
            foreach ($saved_templates as $saved_template_key => $saved_template) {
                if (isset($saved_template['template']) && $saved_template['template'] != '') {
                    $template_file = $wp_bakery_dir . $saved_template_key . '.json';
                    $template_file_contnt = json_encode($saved_template);
                    $wp_filesystem->put_contents($template_file, $template_file_contnt, FS_CHMOD_FILE);
                }
            }
        }
    }
    //////////////////
    ?>
    <h1>Export Done:</h1>
    <p>Export content has been placed into /theme/plugins/demo-data-setup/content/*.json files</p>
    <p>Stock images have been copied into /theme/images/stock/ for faster theme install.</p>
    <?php
} else {
    ?>
    <h1>Export Failed:</h1>
    <p>There is some error.</p>
    <?php
}
