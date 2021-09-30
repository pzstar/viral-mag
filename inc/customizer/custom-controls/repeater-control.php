<?php

/** Repeater Control */
class Viral_Mag_Repeater_Control extends WP_Customize_Control {

    /**
     * The control type.
     *
     * @access public
     * @var string
     */
    public $type = 'viral-mag-repeater';
    public $box_label = '';
    public $add_label = '';
    private $cats = '';

    /**
     * The fields that each container row will contain.
     *
     * @access public
     * @var array
     */
    public $fields = array();

    /**
     * Repeater drag and drop controller
     *
     * @since  1.0.0
     */
    public function __construct($manager, $id, $args = array(), $fields = array()) {
        $this->fields = $fields;
        $this->box_label = isset($args['box_label']) ? $args['box_label'] : '';
        $this->add_label = isset($args['add_label']) ? $args['add_label'] : '';
        $this->cats = get_categories(array('hide_empty' => false));
        parent::__construct($manager, $id, $args);
    }

    public function render_content() {
        ?>
        <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>

        <?php if ($this->description) { ?>
            <span class="description customize-control-description">
                <?php echo wp_kses_post($this->description); ?>
            </span>
        <?php } ?>

        <ul class="viral-mag-repeater-field-control-wrap">
            <?php
            $this->viral_mag_get_fields();
            ?>
        </ul>

        <input type="hidden" <?php esc_attr($this->link()); ?> class="viral-mag-repeater-collector" value="<?php echo esc_attr($this->value()); ?>" />
        <button type="button" class="button viral-mag-add-control-field"><?php echo esc_html($this->add_label); ?></button>
        <?php
    }

    private function viral_mag_get_fields() {
        $fields = $this->fields;
        $values = json_decode($this->value());

        if (is_array($values)) {
            foreach ($values as $value) {
                ?>
                <li class="viral-mag-repeater-field-control">
                    <h3 class="viral-mag-repeater-field-title"><?php echo esc_html($this->box_label); ?></h3>

                    <div class="viral-mag-repeater-fields">
                        <?php
                        foreach ($fields as $key => $field) {
                            $class = isset($field['class']) ? $field['class'] : '';
                            ?>
                            <div class="viral-mag-fields viral-mag-type-<?php echo esc_attr($field['type']) . ' ' . esc_attr($class); ?>">

                                <?php
                                $label = isset($field['label']) ? $field['label'] : '';
                                $description = isset($field['description']) ? $field['description'] : '';
                                if ($field['type'] != 'toggle' && $field['type'] != 'checkbox') {
                                    ?>
                                    <span class="customize-control-repeater-title"><?php echo esc_html($label); ?></span>
                                    <span class="description customize-control-description"><?php echo wp_kses_post($description); ?></span>
                                    <?php
                                }

                                $new_value = isset($value->$key) ? $value->$key : '';
                                $default = isset($field['default']) ? $field['default'] : '';

                                switch ($field['type']) {
                                    case 'text':
                                        echo '<input data-default="' . esc_attr($default) . '" data-name="' . esc_attr($key) . '" type="text" value="' . esc_attr($new_value) . '"/>';
                                        break;

                                    case 'textarea':
                                        echo '<textarea data-default="' . esc_attr($default) . '"  data-name="' . esc_attr($key) . '">' . esc_textarea($new_value) . '</textarea>';
                                        break;

                                    case 'upload':
                                        $image_class = "";
                                        if ($new_value) {
                                            $image_class = ' hidden';
                                        }
                                        echo '<div class="viral-mag-fields-wrap">';
                                        echo '<div class="attachment-media-view">';
                                        echo '<div class="placeholder' . esc_attr($image_class) . '">';
                                        esc_html_e('No image selected', 'viral-mag');
                                        echo '</div>';
                                        echo '<div class="thumbnail thumbnail-image">';
                                        if ($new_value) {
                                            echo '<img src="' . esc_url($new_value) . '" style="max-width:100%;"/>';
                                        }
                                        echo '</div>';
                                        echo '<div class="actions viral-mag-clearfix">';
                                        echo '<button type="button" class="button viral-mag-delete-button align-left">' . esc_html__('Remove', 'viral-mag') . '</button>';
                                        echo '<button type="button" class="button viral-mag-upload-button alignright">' . esc_html__('Select Image', 'viral-mag') . '</button>';
                                        echo '<input data-default="' . esc_attr($default) . '" class="upload-id" data-name="' . esc_attr($key) . '" type="hidden" value="' . esc_attr($new_value) . '"/>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                        break;

                                    case 'category':
                                        echo '<select data-default="' . esc_attr($default) . '"  data-name="' . esc_attr($key) . '">';
                                        echo '<option value="-1" ' . selected($new_value, '-1', false) . '>' . esc_html__('Latest Posts', 'viral-mag') . '</option>';
                                        foreach ($this->cats as $cat) {
                                            printf('<option value="%1$s" %2$s>%3$s</option>', esc_attr($cat->term_id), selected($new_value, $cat->term_id, false), esc_html($cat->name));
                                        }
                                        echo '</select>';
                                        break;

                                    case 'select':
                                        $options = $field['options'];
                                        echo '<select  data-default="' . esc_attr($default) . '"  data-name="' . esc_attr($key) . '">';
                                        foreach ($options as $option => $val) {
                                            printf('<option value="%1$s" %2$s>%3$s</option>', esc_attr($option), selected($new_value, $option, false), esc_html($val));
                                        }
                                        echo '</select>';
                                        break;

                                    case 'toggle':
                                        $checkbox_class = ($new_value == 'yes') ? 'viral-mag-toggle-on' : '';
                                        echo '<div class="viral-mag-toggle">';
                                        echo '<label class="viral-mag-toggle-label ' . esc_attr($checkbox_class) . '">';
                                        echo '<input class="viral-mag-toggle-checkbox" data-default="' . esc_attr($default) . '" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '" type="checkbox" ' . checked($new_value, 'yes', false) . '/>';
                                        echo '</label>';
                                        echo '</div>';
                                        if (!empty($label)) {
                                            echo '<span class="customize-control-title viral-mag-toggle-title">' . esc_html($label) . '</span>';
                                        }
                                        if (!empty($description)) {
                                            echo '<span class="description customize-control-description">' . esc_html($description) . '</span>';
                                        }
                                        break;

                                    case 'checkbox':
                                        echo '<label>';
                                        echo '<input data-default="' . esc_attr($default) . '" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '" type="checkbox" ' . checked($new_value, 'yes', false) . '/>';
                                        echo esc_html($label);
                                        echo '<span class="description customize-control-description">' . esc_html($description) . '</span>';
                                        echo '</label>';
                                        break;

                                    case 'colorpicker':
                                        echo '<input data-default="' . esc_attr($default) . '" class="viral-mag-color-picker" data-alpha="true" data-name="' . esc_attr($key) . '" type="text" value="' . esc_attr($new_value) . '"/>';
                                        break;

                                    case 'selector':
                                        $options = $field['options'];
                                        echo '<div class="selector-labels">';
                                        foreach ($options as $option => $val) {
                                            $class = ( $new_value == $option ) ? 'selector-selected' : '';
                                            echo '<label class="' . $class . '" data-val="' . esc_attr($option) . '">';
                                            echo '<img src="' . esc_url($val) . '"/>';
                                            echo '</label>';
                                        }
                                        echo '</div>';
                                        echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '"/>';
                                        break;

                                    case 'radio':
                                        $options = $field['options'];
                                        echo '<div class="radio-labels">';
                                        foreach ($options as $option => $val) {
                                            echo '<label>';
                                            echo '<input value="' . esc_attr($option) . '" type="radio" ' . checked($new_value, $option, false) . '/>';
                                            echo esc_html($val);
                                            echo '</label>';
                                        }
                                        echo '</div>';
                                        echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '"/>';
                                        break;

                                    case 'switch':
                                        $switch = $field['switch'];
                                        $switch_class = ($new_value == 'on') ? 'viral-mag-switch-on' : '';
                                        echo '<div class="viral-mag-switch ' . esc_attr($switch_class) . '">';
                                        echo '<div class="viral-mag-switch-inner">';
                                        echo '<div class="viral-mag-switch-active">';
                                        echo '<div class="viral-mag-switch-button">' . esc_html($switch["on"]) . '</div>';
                                        echo '</div>';
                                        echo '<div class="viral-mag-switch-inactive">';
                                        echo '<div class="viral-mag-switch-button">' . esc_html($switch["off"]) . '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '"/>';
                                        break;

                                    case 'range':
                                        $options = $field['options'];
                                        $new_value = $new_value ? $new_value : $options['val'];
                                        echo '<div class="viral-mag-range-slider-control-wrap">';
                                        echo '<div class="viral-mag-range-slider" data-default="' . esc_attr($options['val']) . '" data-value="' . esc_attr($new_value) . '" data-min="' . esc_attr($options['min']) . '" data-max="' . esc_attr($options['max']) . '" data-step="' . esc_attr($options['step']) . '"></div>';
                                        echo '<div class="viral-mag-range-slider-input">';
                                        echo '<input type="number" disabled="disabled" value="' . esc_attr($new_value) . '"  data-name="' . esc_attr($key) . '"/>';
                                        echo '</div>';
                                        echo '<span class="viral-mag-range-slider-unit">' . esc_html($options['unit']) . '</span>';
                                        echo '</div>';
                                        break;

                                    case 'icon':
                                        echo '<div class="viral-mag-icon-box-wrap">';
                                        echo '<div class="viral-mag-selected-icon">';
                                        echo '<i class="' . esc_attr($new_value) . '"></i>';
                                        echo '<span><i class="viral-mag-down-icon"></i></span>';
                                        echo '</div>';
                                        echo '<div class="viral-mag-icon-box">';
                                        echo '<div class="viral-mag-icon-search">';
                                        echo '<select>';

                                        //See customizer-fonts-iucon.php file
                                        $viral_mag_icons = apply_filters('viral_mag_register_icon', array());

                                        if ($viral_mag_icons && is_array($viral_mag_icons)) {
                                            foreach ($viral_mag_icons as $viral_mag_icon) {
                                                if ($viral_mag_icon['name'] && $viral_mag_icon['label']) {
                                                    echo '<option value="' . esc_attr($viral_mag_icon['name']) . '">' . esc_html__($viral_mag_icon['label']) . '</option>';
                                                }
                                            }
                                        }

                                        echo '</select>';
                                        echo '<input type="text" class="viral-mag-icon-search-input" placeholder="' . esc_html__('Type to filter', 'viral-mag') . '" />';
                                        echo '</div>';


                                        $viral_mag_active_class = ' active';

                                        if ($viral_mag_icons && is_array($viral_mag_icons)) {
                                            foreach ($viral_mag_icons as $viral_mag_icon) {
                                                $viral_mag_icon_name = $viral_mag_icon['name'] ? $viral_mag_icon['name'] : '';
                                                $viral_mag_icon_prefix = $viral_mag_icon['prefix'] ? $viral_mag_icon['prefix'] : '';
                                                $viral_mag_icon_displayPrefix = $viral_mag_icon['displayPrefix'] ? $viral_mag_icon['displayPrefix'] . ' ' : '';

                                                echo '<ul class="viral-mag-icon-list ' . esc_attr($viral_mag_icon_name) . esc_attr($viral_mag_active_class) . '">';
                                                $viral_mag_icon_array = isset($viral_mag_icon['icons']) ? $viral_mag_icon['icons'] : '';
                                                if (is_array($viral_mag_icon_array)) {
                                                    foreach ($viral_mag_icon_array as $viral_mag_icon_id) {

                                                        $icon_class = ($new_value == $viral_mag_icon_id) ? 'icon-active' : '';
                                                        echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($viral_mag_icon_displayPrefix) . esc_attr($viral_mag_icon_prefix) . esc_attr($viral_mag_icon_id) . '"></i></li>';
                                                    }
                                                }
                                                echo '</ul>';
                                                $active_class = '';
                                            }
                                        }

                                        echo '</div>';
                                        echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '"/>';
                                        echo '</div>';
                                        break;

                                    case 'multicategory':
                                        $new_value_array = !is_array($new_value) ? explode(',', $new_value) : $new_value;
                                        echo '<ul class="viral-mag-multi-category-list">';
                                        foreach ($this->cats as $cat) {
                                            $checked = in_array($cat->term_id, $new_value_array) ? 'checked="checked"' : '';
                                            echo '<li>';
                                            echo '<label>';
                                            echo '<input type="checkbox" value="' . esc_attr($cat->term_id) . '" ' . $checked . '/>';
                                            echo esc_html($cat->name);
                                            echo '</label>';
                                            echo '</li>';
                                        }
                                        echo '</ul>';
                                        echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr(implode(',', $new_value_array)) . '" data-name="' . esc_attr($key) . '"/>';
                                        break;

                                    default:
                                        break;
                                }
                                ?>
                            </div>
                        <?php }
                        ?>

                        <div class="viral-mag-clearfix viral-mag-repeater-footer">
                            <div class="alignright">
                                <a class="viral-mag-repeater-field-remove" href="#remove"><?php esc_html_e('Delete', 'viral-mag') ?></a> |
                                <a class="viral-mag-repeater-field-close" href="#close"><?php esc_html_e('Close', 'viral-mag') ?></a>
                            </div>
                        </div>
                    </div>
                </li>
                <?php
            }
        }
    }

}
