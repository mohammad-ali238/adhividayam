<?php
/*
 * widget for Nav Menu in footer
 */
if (!class_exists('Mediclf_Nav_Menu')) {

    class Mediclf_Nav_Menu extends WP_Widget
    {
        /**
         * Sets up a new mediclf   widget instance.
         */
        public function __construct()
        {
            parent::__construct(
                'mediclf_nav_menu', // Base ID.
                __('Nav Menu', 'mediclf'), // Name.
                array('classname' => 'widget_footer_nav', 'description' => __('Nav Menu widget.', 'mediclf'))
            );
        }

        /**
         * Outputs the mediclf   widget settings form.
         *
         * @param array $instance Current settings.
         */
        function form($instance)
        {

            global $mediclf_form_fields;

            $instance = wp_parse_args((array)$instance, array('title' => ''));
            $title = $instance['title'];
            $nav_itm = isset($instance['nav_itm']) ? esc_attr($instance['nav_itm']) : '';

            $wp_menus = wp_get_nav_menus();
            ?>
            <div class="mediclf-element-field text-widget-fields">
                <p>
                <label><?php esc_html_e('Title', 'mediclf') ?></label>
                <input type="text" name="<?php echo ($this->get_field_name('title')) ?>" value="<?php echo ($title) ?>">
                </p>
                <p>
                <label><?php esc_html_e('Menu', 'mediclf') ?></label>
                <select name="<?php echo ($this->get_field_name('nav_itm')) ?>">
                    <option value=""><?php esc_html_e('Select Menu', 'mediclf') ?></option>
                    <?php
                    if (!empty($wp_menus)) {
                        foreach ($wp_menus as $menu_itm) {
                            ?>
                            <option value="<?php echo ($menu_itm->slug) ?>"<?php echo ($nav_itm == $menu_itm->slug ? ' selected' : '') ?>><?php echo ($menu_itm->name) ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                </p>
            </div>
            
            <?php
        }

        /**
         * Handles updating settings for the current mediclf   widget instance.
         *
         * @param array $new_instance New settings for this instance as input by the user.
         * @param array $old_instance Old settings for this instance.
         * @return array Settings to save or bool false to cancel saving.
         */
        function update($new_instance, $old_instance)
        {

            $instance = $old_instance;
            $instance['title'] = $new_instance['title'];
            $instance['nav_itm'] = $new_instance['nav_itm'];
            return $instance;
        }

        /**
         * Outputs the content for the current mediclf   widget instance.
         *
         * @param array $args Display arguments including 'before_title', 'after_title',
         * 'before_widget', and 'after_widget'.
         * @param array $instance Settings for the current Text widget instance.
         */
        function widget($args, $instance)
        {
            extract($args, EXTR_SKIP);
            $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
            $title = htmlspecialchars_decode(stripslashes($title));
            
            $nav_itm = isset($instance['nav_itm']) ? esc_attr($instance['nav_itm']) : '';

            $before_widget = isset($args['before_widget']) ? $args['before_widget'] : '';
            $after_widget = isset($args['after_widget']) ? $args['after_widget'] : '';

            $before_title = isset($args['before_title']) ? $args['before_title'] : '';
            $after_title = isset($args['after_title']) ? $args['after_title'] : '';
            
            echo ($before_widget);

            ?>
            
            <div class="medicll-fcol">
                <?php
                if ('' !== $title) {
                    echo ($before_title) . esc_html($title) . ($after_title);
                }
                if ($nav_itm != '') {
                    $menu_links = wp_get_nav_menu_items($nav_itm);
                    //var_dump($menu_links);
                    if (!empty($menu_links)) {
                        ?>
                        <ul class="medicll-usefullinks">
                            <?php
                            foreach ($menu_links as $menu_link_itm) {
                                ?>
                                <li><a href="<?php echo ($menu_link_itm->url) ?>"><?php echo ($menu_link_itm->title) ?></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    }
                }
                ?>
            </div>
            <?php

            echo ($after_widget);
        }

    }

}
add_action('widgets_init', function () {
    return register_widget("mediclf_nav_menu");
});