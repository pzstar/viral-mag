<?php
/**
 * @package Viral Mag
 */
add_action('widgets_init', 'viral_mag_register_contact_info');

function viral_mag_register_contact_info() {
    register_widget('viral_mag_contact_info');
}

class viral_mag_contact_info extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'viral_mag_contact_info', '&bull; VM : Contact Info', array(
                'description' => esc_html__('A widget to display Contact Information', 'viral-mag')
            )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'ht_tab' => array(
                'viral_mag_widgets_tabs' => array(
                    'vm-input' => esc_html__('Inputs', 'viral-mag'),
                    'vm-settings' => esc_html__('Settings', 'viral-mag')
                ),
                'viral_mag_widgets_field_type' => 'tab'
            ),
            'tab_open' => array(
                'viral_mag_widgets_class' => 'vm-widget-tab-content-wrap',
                'viral_mag_widgets_field_type' => 'open'
            ),
            'input_open' => array(
                'viral_mag_widgets_class' => 'vm-widget-tab-content',
                'viral_mag_widgets_data_id' => 'vm-input',
                'viral_mag_widgets_field_type' => 'open'
            ),
            'title' => array(
                'viral_mag_widgets_name' => 'title',
                'viral_mag_widgets_title' => esc_html__('Title', 'viral-mag'),
                'viral_mag_widgets_field_type' => 'text'
            ),
            'phone' => array(
                'viral_mag_widgets_name' => 'phone',
                'viral_mag_widgets_title' => esc_html__('Phone', 'viral-mag'),
                'viral_mag_widgets_field_type' => 'text'
            ),
            'contact_info_email' => array(
                'viral_mag_widgets_name' => 'email',
                'viral_mag_widgets_title' => esc_html__('Email', 'viral-mag'),
                'viral_mag_widgets_field_type' => 'text'
            ),
            'website' => array(
                'viral_mag_widgets_name' => 'website',
                'viral_mag_widgets_title' => esc_html__('Website', 'viral-mag'),
                'viral_mag_widgets_field_type' => 'text'
            ),
            'address' => array(
                'viral_mag_widgets_name' => 'address',
                'viral_mag_widgets_title' => esc_html__('Contact Address', 'viral-mag'),
                'viral_mag_widgets_field_type' => 'textarea',
                'viral_mag_widgets_row' => '4'
            ),
            'time' => array(
                'viral_mag_widgets_name' => 'time',
                'viral_mag_widgets_title' => esc_html__('Contact Time', 'viral-mag'),
                'viral_mag_widgets_field_type' => 'textarea',
                'viral_mag_widgets_row' => '3'
            ),
            'input_close' => array(
                'viral_mag_widgets_field_type' => 'close'
            ),
            'settings_open' => array(
                'viral_mag_widgets_class' => 'vm-widget-tab-content',
                'viral_mag_widgets_data_id' => 'vm-settings',
                'viral_mag_widgets_field_type' => 'open'
            ),
            'title_color' => array(
                'viral_mag_widgets_name' => 'title_color',
                'viral_mag_widgets_title' => esc_html__('Title Color', 'viral-mag'),
                'viral_mag_widgets_field_type' => 'color'
            ),
            'text_color' => array(
                'viral_mag_widgets_name' => 'text_color',
                'viral_mag_widgets_title' => esc_html__('Text Color', 'viral-mag'),
                'viral_mag_widgets_field_type' => 'color'
            ),
            'icon_color' => array(
                'viral_mag_widgets_name' => 'icon_color',
                'viral_mag_widgets_title' => esc_html__('Icon Color', 'viral-mag'),
                'viral_mag_widgets_field_type' => 'color'
            ),
            'background_color' => array(
                'viral_mag_widgets_name' => 'background_color',
                'viral_mag_widgets_title' => esc_html__('Background Color', 'viral-mag'),
                'viral_mag_widgets_field_type' => 'color'
            ),
            'padding' => array(
                'viral_mag_widgets_name' => 'padding',
                'viral_mag_widgets_title' => esc_html__('Padding', 'viral-mag'),
                'viral_mag_widgets_field_type' => 'number'
            ),
            'settings_close' => array(
                'viral_mag_widgets_field_type' => 'close'
            ),
            'tab_close' => array(
                'viral_mag_widgets_field_type' => 'close'
            )
        );

        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        extract($args);

        $title = isset($instance['title']) ? $instance['title'] : '';
        $phone = isset($instance['phone']) ? $instance['phone'] : '';
        $email = isset($instance['email']) ? $instance['email'] : '';
        $website = isset($instance['website']) ? $instance['website'] : '';
        $address = isset($instance['address']) ? $instance['address'] : '';
        $time = isset($instance['time']) ? $instance['time'] : '';
        $title_color = isset($instance['title_color']) ? $instance['title_color'] : '';
        $text_color = isset($instance['text_color']) ? $instance['text_color'] : '';
        $icon_color = isset($instance['icon_color']) ? $instance['icon_color'] : '';
        $background_color = isset($instance['background_color']) ? $instance['background_color'] : '';
        $padding = isset($instance['padding']) ? $instance['padding'] : '';

        $title_style = $text_style = $icon_style = $wrap_style = '';
        $wrap_css = array();

        if (!empty($title_color)) {
            $title_style = 'style="color:' . $title_color . '"';
        }

        if (!empty($text_color)) {
            $text_style = 'style="color:' . $text_color . '"';
        }

        if (!empty($icon_color)) {
            $icon_style = 'style="color:' . $icon_color . '"';
        }

        if (!empty($background_color)) {
            $wrap_css[] = "background-color:$background_color";
        }

        if (!empty($padding)) {
            $wrap_css[] = "padding:" . $padding . "px";
        }

        if (!empty($wrap_css)) {
            $wrap_style = 'style="' . implode(';', $wrap_css) . '"';
        }

        echo $before_widget;
        ?>
        <?php
        if (!empty($title)):
            echo $before_title . '<span ' . $title_style . '>' . apply_filters('widget_title', $title) . '</span>' . $after_title;
        endif;
        ?>
        <div class="vm-contact-info" <?php echo $wrap_style; ?>>
            <ul <?php echo $text_style; ?>>
                <?php if (!empty($phone)): ?>
                    <li><i class="icofont-phone" <?php echo $icon_style; ?>></i><?php echo wp_kses_post($phone); ?></li>
                <?php endif; ?>

                <?php if (!empty($email)): ?>
                    <li><i class="icofont-envelope" <?php echo $icon_style; ?>></i><?php echo wp_kses_post($email); ?></li>
                <?php endif; ?>

                <?php if (!empty($website)): ?>
                    <li><i class="icofont-globe-alt" <?php echo $icon_style; ?>></i><?php echo wp_kses_post($website); ?></li>
                <?php endif; ?>

                <?php if (!empty($address)): ?>
                    <li><i class="icofont-address-book" <?php echo $icon_style; ?>></i><?php echo wpautop(esc_html($address)); ?></li>
                <?php endif; ?>

                <?php if (!empty($time)): ?>
                    <li><i class="icofont-clock-time" <?php echo $icon_style; ?>></i><?php echo wpautop(esc_html($time)); ?></li>
                <?php endif; ?>
            </ul>
        </div>
        <?php
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    viral_mag_widgets_updated_field_value()        defined in widget-fields.php
     *
     * @return  array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {
            extract($widget_field);
            if (!viral_mag_exclude_widget_update($viral_mag_widgets_field_type)) {
                $new = isset($new_instance[$viral_mag_widgets_name]) ? $new_instance[$viral_mag_widgets_name] : '';
                // Use helper function to get updated field values
                $instance[$viral_mag_widgets_name] = viral_mag_widgets_updated_field_value($widget_field, $new);
            }
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param   array $instance Previously saved values from database.
     *
     * @uses    viral_mag_widgets_show_widget_field()      defined in widget-fields.php
     */
    public function form($instance) {
        $widget_fields = $this->widget_fields();
        // Loop through fields
        foreach ($widget_fields as $widget_field) {
            // Make array elements available as variables
            extract($widget_field);

            if (!viral_mag_exclude_widget_update($viral_mag_widgets_field_type)) {
                $viral_mag_widgets_field_value = !empty($instance[$viral_mag_widgets_name]) ? $instance[$viral_mag_widgets_name] : '';
            } else {
                $viral_mag_widgets_field_value = '';
            }

            viral_mag_widgets_show_widget_field($this, $widget_field, $viral_mag_widgets_field_value);
        }
    }

}
