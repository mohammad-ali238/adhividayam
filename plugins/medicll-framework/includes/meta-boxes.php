<?php

defined('ABSPATH') || exit;

class Mediclf_Meta_Boxes {
    
    public function __construct() {
        add_action('save_post', array($this, 'save_meta_fields'), 5);
        add_action('add_meta_boxes', array($this, 'post_layout_meta_boxes'));
    }

    public function save_meta_fields($post_id = '') {

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        foreach ($_POST as $key => $value) {
            if (strstr($key, 'mediclf_field_')) {
                update_post_meta($post_id, $key, $value);
            }
        }
    }

    public function post_layout_meta_boxes() {
        add_meta_box('mediclf-post-layout', esc_html__('Post Layout', 'mediclf'), array($this, 'post_layout_meta'), 'post', 'side');
        add_meta_box('mediclf-page-layout', esc_html__('Page Layout', 'mediclf'), array($this, 'post_layout_meta'), 'page', 'side');
    }

    public function post_layout_meta() {
        global $mediclf_framework_options, $post;

        $post_layout = get_post_meta($post->ID, 'mediclf_field_post_layout', true);
        $post_sidebar = get_post_meta($post->ID, 'mediclf_field_post_sidebar', true); //var_dump(get_post_meta($post->ID));
    
        $sidebars_array = array();
        $mediclf_sidebars = isset($mediclf_framework_options['mediclf-themes-sidebars']) ? $mediclf_framework_options['mediclf-themes-sidebars'] : '';
        if (is_array($mediclf_sidebars) && sizeof($mediclf_sidebars) > 0) {
            foreach ($mediclf_sidebars as $sidebar) {
                $sadbar_id = sanitize_title($sidebar);
                $sidebars_array[$sadbar_id] = $sidebar;
            }
        }
        ?>
        <div class="mediclf-post-layout">
            <div class="mediclf-element-field">
                <div class="elem-label">
                    <label><?php esc_html_e('Select Layout', 'mediclf') ?></label>
                </div>
                <div class="elem-field">
                    <select name="mediclf_field_post_layout">
                        <option value="full"<?php echo ($post_layout == 'full' ? ' selected' : '') ?>><?php esc_html_e('Full', 'mediclf') ?></option>
                        <option value="right"<?php echo ($post_layout == 'right' ? ' selected' : '') ?>><?php esc_html_e('Right Sidebar', 'mediclf') ?></option>
                        <option value="left"<?php echo ($post_layout == 'left' ? ' selected' : '') ?>><?php esc_html_e('Left Sidebar', 'mediclf') ?></option>
                    </select>
                </div>
            </div>
            <div class="mediclf-element-field">
                <div class="elem-label">
                    <label><?php esc_html_e('Select Sidebar', 'mediclf') ?></label>
                </div>
                <div class="elem-field">
                    <select name="mediclf_field_post_sidebar">
                        <option value=""<?php echo ($post_sidebar == '' ? ' selected' : '') ?>><?php esc_html_e('Select Sidebar', 'mediclf') ?></option>
                        <?php
                        if (!empty($sidebars_array)) {
                            foreach ($sidebars_array as $sidebar_id => $sidebar_title) {
                                ?>
                                <option value="<?php echo ($sidebar_id) ?>"<?php echo ($post_sidebar == $sidebar_id ? ' selected' : '') ?>><?php echo ($sidebar_title) ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <?php
    }

}

new Mediclf_Meta_Boxes;