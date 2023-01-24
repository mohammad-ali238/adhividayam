<?php
/*
 * widget for about us in footer
 */
if (!class_exists('Mediclf_about_Infos')) {

    class Mediclf_about_Infos extends WP_Widget
    {
        /**
         * Sets up a new mediclf   widget instance.
         */
        public function __construct()
        {
            parent::__construct(
                'mediclf_about_infos', // Base ID.
                __('About Info', 'mediclf'), // Name.
                array('classname' => 'widget_footer_contact', 'description' => __('About info widget for contact.', 'mediclf'))
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
            $logo = isset($instance['logo']) ? esc_attr($instance['logo']) : '';
            $addr = isset($instance['addr']) ? esc_attr($instance['addr']) : '';
            $phn1 = isset($instance['phn1']) ? esc_attr($instance['phn1']) : '';
            $phn2 = isset($instance['phn2']) ? esc_attr($instance['phn2']) : '';
            $email1 = isset($instance['email1']) ? esc_attr($instance['email1']) : '';
            $email2 = isset($instance['email2']) ? esc_attr($instance['email2']) : '';
            ?>
            <div class="mediclf-element-field text-widget-fields">
                <p>
                <label><?php esc_html_e('Title', 'mediclf') ?></label>
                <input type="text" name="<?php echo ($this->get_field_name('desc')) ?>" value="<?php echo ($title) ?>">
                </p>
                <p>
                <label><?php esc_html_e('Logo', 'mediclf') ?></label>
                <input type="text" name="<?php echo ($this->get_field_name('logo')) ?>" value="<?php echo ($logo) ?>">
                </p>
                <p>
                <label><?php esc_html_e('Address', 'mediclf') ?></label>
                <input type="text" name="<?php echo ($this->get_field_name('addr')) ?>" value="<?php echo ($addr) ?>">
                </p>
                <p>
                <label><?php esc_html_e('Phone 1', 'mediclf') ?></label>
                <input type="text" name="<?php echo ($this->get_field_name('phn1')) ?>" value="<?php echo ($phn1) ?>">
                </p>
                <p>
                <label><?php esc_html_e('Phone 2', 'mediclf') ?></label>
                <input type="text" name="<?php echo ($this->get_field_name('phn2')) ?>" value="<?php echo ($phn2) ?>">
                </p>
                <p>
                <label><?php esc_html_e('Email 1', 'mediclf') ?></label>
                <input type="text" name="<?php echo ($this->get_field_name('email1')) ?>" value="<?php echo ($email1) ?>">
                </p>
                <p>
                <label><?php esc_html_e('Email 2', 'mediclf') ?></label>
                <input type="text" name="<?php echo ($this->get_field_name('email2')) ?>" value="<?php echo ($email2) ?>">
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
            $instance['logo'] = $new_instance['logo'];
            $instance['addr'] = $new_instance['addr'];
            $instance['phn1'] = $new_instance['phn1'];
            $instance['phn2'] = $new_instance['phn2'];
            $instance['email1'] = $new_instance['email1'];
            $instance['email2'] = $new_instance['email2'];
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
            
            $logo = isset($instance['logo']) ? esc_attr($instance['logo']) : '';
            $addr = isset($instance['addr']) ? esc_attr($instance['addr']) : '';
            $phn1 = isset($instance['phn1']) ? esc_attr($instance['phn1']) : '';
            $phn2 = isset($instance['phn2']) ? esc_attr($instance['phn2']) : '';
            $email1 = isset($instance['email1']) ? esc_attr($instance['email1']) : '';
            $email2 = isset($instance['email2']) ? esc_attr($instance['email2']) : '';

            $before_widget = isset($args['before_widget']) ? $args['before_widget'] : '';
            $after_widget = isset($args['after_widget']) ? $args['after_widget'] : '';

            $before_title = isset($args['before_title']) ? $args['before_title'] : '';
            $after_title = isset($args['after_title']) ? $args['after_title'] : '';
            
            echo ($before_widget);

            if ('' !== $title) {
                echo ($before_title) . esc_html($title) . ($after_title);
            }
            
            ?>
            <div class="medicll-fcol">
                <?php

                ?>
                <strong class="medicll-logo">
                    <a href="#">
                        <img src="images/flogo.png" alt="">
                    </a>
                </strong>
                <?php

                ?>
                <ul class="medicll-faddressinfo">
                    <?php
                    if ($addr != '') {
                        ?>
                        <li>
                            <span class="medicll-addressicon"><img src="<?php echo Mediclf_Plugin::root_url() ?>images/img-08.png" alt=""></span>
                            <address><?php echo ($addr) ?></address>
                        </li>
                        <?php
                    }
                    if ($phn1 != '' || $phn2 != '') {
                    ?>
                    <li>
                        <span class="medicll-addressicon"><img src="<?php echo Mediclf_Plugin::root_url() ?>images/img-09.png" alt=""></span>
                        <div class="medicll-phone">
                            <span>(01) 98 - 765 432 10</span>
                            <span>(01) 90 - 123 456 78</span>
                        </div>
                    </li>
                    <?php
                    }
                    ?>
                    <li>
                        <span class="medicll-addressicon"><img src="<?php echo Mediclf_Plugin::root_url() ?>images/img-10.png" alt=""></span>
                        <div class="medicll-phone">
                            <span><a href="mailto:admin@adhividayam.com">admin@adhividayam.com</a></span>
                            <span><a href="mailto:info@adhividayam.com">info@adhividayam.com</a></span>
                        </div>
                    </li>
                    <?php

                    ?>
                </ul>
            </div>
            <?php

            echo ($after_widget);
        }

    }

}
add_action('widgets_init', function () {
    return register_widget("mediclf_about_infos");
});