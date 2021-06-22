<?php
/**
 * @package Viral Mag
 */
add_action('widgets_init', 'viral_mag_register_category');

function viral_mag_register_category() {
    register_widget('viral_mag_category');
}

class viral_mag_category extends WP_Widget {

    public function __construct() {
        $widget_ops = array('description' => esc_html__('A widget to display Category in columns', 'viral-mag'));
        parent::__construct('viral_mag_category', '&bull; VP : Categories', $widget_ops);
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'title' => array(
                'viral_mag_widgets_name' => 'title',
                'viral_mag_widgets_title' => esc_html__('Title', 'viral-mag'),
                'viral_mag_widgets_field_type' => 'text'
            ),
            'column' => array(
                'viral_mag_widgets_name' => 'column',
                'viral_mag_widgets_title' => esc_html__('Display in', 'viral-mag'),
                'viral_mag_widgets_field_type' => 'select',
                'viral_mag_widgets_field_options' => array(
                    'ht-col-1' => esc_html__('One Column', 'viral-mag'),
                    'ht-col-2' => esc_html__('Two Columns', 'viral-mag'),
                    'ht-col-3' => esc_html__('Three Columns', 'viral-mag'),
                    'ht-col-4' => esc_html__('Four Columns', 'viral-mag'),
                ),
                'viral_mag_widgets_default' => 'col-1'
            ),
            'post_count' => array(
                'viral_mag_widgets_name' => 'post_count',
                'viral_mag_widgets_title' => esc_html__('Show Post Count', 'viral-mag'),
                'viral_mag_widgets_field_type' => 'checkbox'
            ),
            'category' => array(
                'viral_mag_widgets_name' => 'category',
                'viral_mag_widgets_title' => esc_html__('Display Selective Categories', 'viral-mag'),
                'viral_mag_widgets_field_type' => 'multicheckbox',
                'viral_mag_widgets_field_options' => viral_mag_category_list(),
                'viral_mag_widgets_description' => esc_html__('All Category will be displayed if any category is not selected.', 'viral-mag'),
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
        $column = isset($instance['column']) ? $instance['column'] : 'ht-col-1';
        $post_count = (isset($instance['post_count']) && $instance['post_count'] == '1') ? 'true' : 'false';
        $category = isset($instance['category']) ? $instance['category'] : '';

        echo $before_widget;

        if (!empty($title)):
            echo $before_title . apply_filters('widget_title', $title) . $after_title;
        endif;
        ?>
        <ul class="ht-category-widget <?php echo esc_attr($column); ?>">
            <?php
            if (!$category) {
                $category = viral_mag_category_list();
            }

            $category = array_keys($category);
            foreach ($category as $cat) {
                $category_obj = get_category($cat);
                ?>
                <li>
                    <a href="<?php echo esc_url(get_category_link($cat)); ?>">
                        <?php echo esc_html($category_obj->name); ?>
                        <?php if ($post_count == 'true') { ?>
                            <span>(<?php echo esc_html($category_obj->category_count); ?>)</span>
                        <?php } ?>
                    </a>
                </li>
                <?php
            }
            ?>
        </ul>
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
