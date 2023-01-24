<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package medicll
 */

if (is_single() || is_page()) {
    $layout = get_post_meta($post->ID, 'mediclf_field_post_layout', true);
    $sidebar = get_post_meta($post->ID, 'mediclf_field_post_sidebar', true);
} else {
    global $mediclf_framework_options;
    $layout = isset($mediclf_framework_options['mediclf-default-layout']) ? $mediclf_framework_options['mediclf-default-layout'] : '';
    $sidebar = isset($mediclf_framework_options['mediclf-default-sidebar']) ? $mediclf_framework_options['mediclf-default-sidebar'] : '';
}

$sidebar_class = $layout == 'left' ? 'pull-left' : 'pull-right';
if (is_active_sidebar('sidebar-1') && $layout == '') {
    ?>
    <aside class="col-md-3 col-sm-4 col-xs-12">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </aside>
    <?php
} else if (( $layout == 'right' || $layout == 'left' )) {
    ?>
    <aside class="col-md-3 col-sm-4 col-xs-12 <?php echo sanitize_html_class($sidebar_class) ?>">
        <?php dynamic_sidebar($sidebar); ?>
    </aside>
    <?php
}
