<?php

/**
 * @package Viral Mag
 */
function viral_mag_widgets_show_widget_field($instance = '', $widget_field = '', $viral_mag_field_value = '') {

    extract($widget_field);

    if (isset($viral_mag_widgets_default)) {
        if ($viral_mag_widgets_field_type == 'checkbox') {
            $viral_mag_field_value = !empty($viral_mag_field_value) ? $viral_mag_field_value : '0';
        } else {
            $viral_mag_field_value = !empty($viral_mag_field_value) ? $viral_mag_field_value : $viral_mag_widgets_default;
        }
    }

    $viral_mag_widgets_class = isset($viral_mag_widgets_class) ? $viral_mag_widgets_class : '';
    $viral_mag_widgets_row = isset($viral_mag_widgets_row) ? $viral_mag_widgets_row : 3;

    switch ($viral_mag_widgets_field_type) {
        case 'tab' :
            $selector = 'viral_mag_' . md5(uniqid(rand(), true));
            ?>
            <script>
                jQuery(function ($) {
                    var id = $('#<?php echo $selector; ?>').parent();
                    viral_mag_widget_tabs(id);
                });
            </script>
            <div class="ht-widget-tab <?php echo $viral_mag_widgets_class; ?>" id="<?php echo $selector; ?>">
                <?php
                foreach ($viral_mag_widgets_tabs as $viral_mag_widgets_class => $viral_mag_widgets_tab_name) {
                    ?>
                    <div class="<?php echo esc_attr($viral_mag_widgets_class); ?>"><?php echo esc_html($viral_mag_widgets_tab_name) ?></div>
                <?php }
                ?>
            </div>
            <?php
            break;

        case 'open' :
            $data_id = '';
            if (isset($viral_mag_widgets_data_id)) {
                $data_id .= 'data-id ="' . $viral_mag_widgets_data_id . '"';
            }
            echo '<div class ="' . $viral_mag_widgets_class . '" ' . $data_id . '>';
            break;

        case 'close' :
            echo '</div>';
            break;

        case 'icon' :
            ?>
            <div class="ht-widget-icon-box ht-form-row <?php echo $viral_mag_widgets_class; ?>">
                <?php if (isset($viral_mag_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($viral_mag_widgets_name); ?>"><?php echo esc_html($viral_mag_widgets_title); ?>:</label>
                <?php } ?>

                <div class="ht-selected-icon">
                    <i class="<?php echo esc_attr($viral_mag_field_value); ?>"></i>
                    <span><i class="icofont-simple-down"></i></span>
                </div>

                <div class="ht-icon-box">
                    <div class="ht-icon-search">
                        <input type="text" class="ht-icon-search-input" placeholder="<?php echo esc_attr__('Type to filter', 'viral-mag') ?>" />
                    </div>

                    <ul class="ht-icon-list clearfix">
                        <?php
                        if (isset($viral_mag_icon_array) && !empty($viral_mag_icon_array)) {
                            $icon_array = $viral_mag_icon_array;
                        } else {
                            $icon_array = viral_mag_eleganticons_array();
                        }

                        foreach ($icon_array as $icon) {
                            $icon_class = ($viral_mag_field_value == $icon) ? 'icon-active' : '';
                            echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($icon) . '"></i></li>';
                        }
                        ?>
                    </ul>
                </div>
                <input type="hidden" name="<?php echo $instance->get_field_name($viral_mag_widgets_name); ?>" value="<?php echo esc_attr($viral_mag_field_value); ?>" />

                <?php if (isset($viral_mag_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($viral_mag_widgets_description); ?></small>
                <?php } ?>
            </div>
            <?php
            break;

        case 'selector' :
            ?>
            <p class="ht-form-row <?php echo $viral_mag_widgets_class; ?>">
                <?php if (isset($viral_mag_widgets_title)) { ?>
                    <label><?php echo esc_html($viral_mag_widgets_title); ?></label>
                <?php } ?>

                <?php foreach ($viral_mag_widgets_field_options as $viral_mag_option_name => $viral_mag_option_title) { ?>
                    <label class="ht-image-label" for="<?php echo $instance->get_field_id($viral_mag_option_name); ?>">
                        <input id="<?php echo $instance->get_field_id($viral_mag_option_name); ?>" name="<?php echo $instance->get_field_name($viral_mag_widgets_name); ?>" type="radio" value="<?php echo esc_attr($viral_mag_option_name); ?>" <?php checked($viral_mag_option_name, $viral_mag_field_value); ?> />
                        <img src="<?php echo esc_url($viral_mag_option_title); ?>" />
                    </label>
                <?php }
                ?>

                <?php if (isset($viral_mag_widgets_description)) { ?>
                    <small><?php echo wp_kses_post($viral_mag_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'text' :
            ?>
            <p class="ht-form-row <?php echo $viral_mag_widgets_class; ?>">
                <?php if (isset($viral_mag_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($viral_mag_widgets_name); ?>"><?php echo esc_html($viral_mag_widgets_title); ?>:</label>
                <?php } ?>

                <input class="widefat" id="<?php echo $instance->get_field_id($viral_mag_widgets_name); ?>" name="<?php echo $instance->get_field_name($viral_mag_widgets_name); ?>" type="text" value="<?php echo esc_html($viral_mag_field_value); ?>" />

                <?php if (isset($viral_mag_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($viral_mag_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'url' :
            ?>
            <p class="ht-form-row <?php echo $viral_mag_widgets_class; ?>">
                <?php if (isset($viral_mag_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($viral_mag_widgets_name); ?>"><?php echo esc_html($viral_mag_widgets_title); ?>:</label>
                <?php } ?>

                <input class="widefat" id="<?php echo $instance->get_field_id($viral_mag_widgets_name); ?>" name="<?php echo $instance->get_field_name($viral_mag_widgets_name); ?>" type="text" value="<?php echo esc_url($viral_mag_field_value); ?>" />

                <?php if (isset($viral_mag_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($viral_mag_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'editor' :
            ?>
            <p class="ht-form-row <?php echo $viral_mag_widgets_class; ?>">
                <?php if (isset($viral_mag_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($viral_mag_widgets_name); ?>"><?php echo esc_html($viral_mag_widgets_title); ?>:</label>
                <?php }
                ?>
                <input class="widefat" id="<?php echo $instance->get_field_id($viral_mag_widgets_name); ?>" name="<?php echo $instance->get_field_name($viral_mag_widgets_name); ?>" value='<?php echo wp_kses_post($viral_mag_field_value); ?>' type="hidden" />
                <a href="#" class="button ht-wp-editor-button"><?php esc_html_e('Add/Edit Content', 'viral-mag') ?></a>

                <?php if (isset($viral_mag_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($viral_mag_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'inline_editor' :
            $selector = 'viral_mag_' . md5(uniqid(rand(), true));
            ?>
            <div class="ht-form-row <?php echo $viral_mag_widgets_class; ?>" id="<?php echo $selector; ?>">
                <?php if (isset($viral_mag_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($viral_mag_widgets_name); ?>"><?php echo esc_html($viral_mag_widgets_title); ?>:</label>
                <?php } ?>

                <textarea class="widefat ht-inline-editor" rows="<?php echo absint($viral_mag_widgets_row); ?>" id="<?php echo $instance->get_field_id($viral_mag_widgets_name); ?>" name="<?php echo $instance->get_field_name($viral_mag_widgets_name); ?>"><?php echo wp_kses_post($viral_mag_field_value); ?></textarea>

                <?php if (isset($viral_mag_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($viral_mag_widgets_description); ?></small>
                <?php } ?>
            </div>
            <script>
                jQuery(function ($) {
                    if (!$('body').hasClass('wp-customizer')) {
                        viral_mag_widget_editor('#<?php echo $selector; ?>');
                    }
                });
            </script>
            <?php
            break;

        case 'textarea' :
            ?>
            <p class="ht-form-row <?php echo $viral_mag_widgets_class; ?>">
                <?php if (isset($viral_mag_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($viral_mag_widgets_name); ?>"><?php echo esc_html($viral_mag_widgets_title); ?>:</label>
                <?php } ?>

                <textarea class="widefat" rows="<?php echo absint($viral_mag_widgets_row); ?>" id="<?php echo $instance->get_field_id($viral_mag_widgets_name); ?>" name="<?php echo $instance->get_field_name($viral_mag_widgets_name); ?>"><?php echo wp_kses_post($viral_mag_field_value); ?></textarea>

                <?php if (isset($viral_mag_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($viral_mag_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'color' :
            $selector = 'viral_mag_' . md5(uniqid(rand(), true));
            ?>
            <div class="ht-color-widget ht-form-row <?php echo $viral_mag_widgets_class; ?>" id="<?php echo $selector; ?>">
                <?php if (isset($viral_mag_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($viral_mag_widgets_name); ?>"><?php echo esc_html($viral_mag_widgets_title); ?>:</label>
                <?php } ?>

                <input class="ht-widget-color-picker" id="<?php echo $instance->get_field_id($viral_mag_widgets_name); ?>" name="<?php echo $instance->get_field_name($viral_mag_widgets_name); ?>" type="text" value="<?php echo esc_attr($viral_mag_field_value) ?>"/>

                <?php if (isset($viral_mag_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($viral_mag_widgets_description); ?></small>
                <?php } ?>
            </div>
            <script>
                jQuery(function ($) {
                    if (!$('body').hasClass('wp-customizer')) {
                        viral_mag_widget_color_picker('#<?php echo $selector; ?>');
                    }
                });
            </script>
            <?php
            break;

        case 'checkbox' :
            ?>
            <p class="ht-form-row <?php echo $viral_mag_widgets_class; ?>">
                <input id="<?php echo $instance->get_field_id($viral_mag_widgets_name); ?>" name="<?php echo $instance->get_field_name($viral_mag_widgets_name); ?>" type="checkbox" value="1" <?php checked('1', $viral_mag_field_value); ?>/>

                <label for="<?php echo $instance->get_field_id($viral_mag_widgets_name); ?>"><?php echo esc_html($viral_mag_widgets_title); ?></label>

                <?php if (isset($viral_mag_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($viral_mag_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'multicheckbox' :
            ?>
            <p class="ht-form-row <?php echo $viral_mag_widgets_class; ?>">
                <?php if (isset($viral_mag_widgets_title)) { ?>
                    <label><?php echo esc_html($viral_mag_widgets_title); ?></label>
                    <?php
                }

                if (!empty($viral_mag_widgets_field_options)) {
                    foreach ($viral_mag_widgets_field_options as $viral_mag_option_name => $viral_mag_option_title) {
                        ?>
                        <input id="<?php echo $instance->get_field_id($viral_mag_option_name); ?>" name="<?php echo $instance->get_field_name($viral_mag_widgets_name) . '[' . $viral_mag_option_name . ']'; ?>" type="checkbox" value="1" <?php checked('1', isset($viral_mag_field_value[$viral_mag_option_name])); ?>/>

                        <label for="<?php echo $instance->get_field_id($viral_mag_option_name); ?>"><?php echo esc_html($viral_mag_option_title); ?></label><br />
                        <?php
                    }
                } else {
                    esc_html_e('- No options found', 'viral-mag');
                }
                ?>

                <?php if (isset($viral_mag_widgets_description)) { ?>
                    <small><?php echo wp_kses_post($viral_mag_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'radio' :
            ?>
            <p class="ht-form-row <?php echo $viral_mag_widgets_class; ?>">
                <?php if (isset($viral_mag_widgets_title)) { ?>
                    <label><?php echo esc_html($viral_mag_widgets_title); ?></label>
                <?php } ?>

                <?php foreach ($viral_mag_widgets_field_options as $viral_mag_option_name => $viral_mag_option_title) { ?>
                    <input id="<?php echo $instance->get_field_id($viral_mag_option_name); ?>" name="<?php echo $instance->get_field_name($viral_mag_widgets_name); ?>" type="radio" value="<?php echo esc_attr($viral_mag_option_name); ?>" <?php checked($viral_mag_option_name, $viral_mag_field_value); ?> />
                    <label for="<?php echo $instance->get_field_id($viral_mag_option_name); ?>"><?php echo esc_html($viral_mag_option_title); ?></label>
                    <br />
                <?php }
                ?>

                <?php if (isset($viral_mag_widgets_description)) { ?>
                    <small><?php echo wp_kses_post($viral_mag_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'select' :
            ?>
            <p class="ht-form-row <?php echo $viral_mag_widgets_class; ?>">
                <?php if (isset($viral_mag_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($viral_mag_widgets_name); ?>"><?php echo esc_html($viral_mag_widgets_title); ?>:</label>
                <?php } ?>

                <select name="<?php echo $instance->get_field_name($viral_mag_widgets_name); ?>" id="<?php echo $instance->get_field_id($viral_mag_widgets_name); ?>" class="widefat">
                    <?php foreach ($viral_mag_widgets_field_options as $viral_mag_option_name => $viral_mag_option_title) { ?>
                        <option value="<?php echo esc_attr($viral_mag_option_name); ?>" <?php selected($viral_mag_option_name, $viral_mag_field_value); ?>><?php echo esc_html($viral_mag_option_title); ?></option>
                    <?php } ?>
                </select>

                <?php if (isset($viral_mag_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($viral_mag_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'number' :
            ?>
            <p class="ht-form-row <?php echo $viral_mag_widgets_class; ?>">
                <?php if (isset($viral_mag_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($viral_mag_widgets_name); ?>"><?php echo esc_html($viral_mag_widgets_title); ?>:</label>
                <?php } ?>

                <input name="<?php echo $instance->get_field_name($viral_mag_widgets_name); ?>" type="number" step="1" min="0" id="<?php echo $instance->get_field_id($viral_mag_widgets_name); ?>" value="<?php echo absint($viral_mag_field_value); ?>" class="small-text" />

                <?php if (isset($viral_mag_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($viral_mag_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'upload':
            $image = $image_class = "";
            if ($viral_mag_field_value) {
                $image = '<img src="' . esc_url($viral_mag_field_value) . '" style="max-width:100%;"/>';
                $image_class = ' hidden';
            }
            ?>
            <div class="ht-form-row attachment-media-view widget-media-view <?php echo $viral_mag_widgets_class; ?>">

                <?php if (isset($viral_mag_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($viral_mag_widgets_name); ?>"><?php echo esc_html($viral_mag_widgets_title); ?>:</label>
                <?php } ?>

                <div class="placeholder<?php echo $image_class; ?>">
                    <?php esc_html_e('No image selected', 'viral-mag'); ?>
                </div>
                <div class="thumbnail thumbnail-image">
                    <?php echo $image; ?>
                </div>

                <div class="actions clearfix">
                    <button type="button" class="button ht-delete-button align-left"><?php esc_html_e('Remove', 'viral-mag'); ?></button>
                    <button type="button" class="button ht-upload-button alignright"><?php esc_html_e('Select Image', 'viral-mag'); ?></button>

                    <input name="<?php echo $instance->get_field_name($viral_mag_widgets_name); ?>" id="<?php echo $instance->get_field_id($viral_mag_widgets_name); ?>" class="upload-id" type="hidden" value="<?php echo esc_url($viral_mag_field_value) ?>"/>
                </div>

                <?php if (isset($viral_mag_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($viral_mag_widgets_description); ?></small>
                <?php } ?>

            </div>
            <?php
            break;

        case 'datepicker' :
            $selector = 'viral_mag_' . md5(uniqid(rand(), true));
            ?>
            <p class="ht-form-row <?php echo $viral_mag_widgets_class; ?>" id="<?php echo $selector; ?>">
                <?php if (isset($viral_mag_widgets_title)) { ?>
                    <label for="<?php echo $instance->get_field_id($viral_mag_widgets_name); ?>"><?php echo esc_html($viral_mag_widgets_title); ?>:</label>
                <?php } ?>

                <input class="widefat ht-datepicker" id="<?php echo $instance->get_field_id($viral_mag_widgets_name); ?>" name="<?php echo $instance->get_field_name($viral_mag_widgets_name); ?>" type="text" value="<?php echo esc_html($viral_mag_field_value); ?>" autocomplete="off" />

                <?php if (isset($viral_mag_widgets_description)) { ?>
                    <br />
                    <small><?php echo wp_kses_post($viral_mag_widgets_description); ?></small>
                <?php } ?>
            </p>
            <script>
                jQuery(function ($) {
                    if (!$('body').hasClass('wp-customizer')) {
                        viral_mag_widget_datepicker('#<?php echo $selector; ?>');
                    }
                });
            </script>
            <?php
            break;

        case 'heading' :
            ?>
            <p class="ht-form-row <?php echo $viral_mag_widgets_class; ?>">
                <?php if (isset($viral_mag_widgets_title)) { ?>
                    <label class="ht-label-heading" for="<?php echo $instance->get_field_id($viral_mag_widgets_name); ?>"><?php echo esc_html($viral_mag_widgets_title); ?>:</label>
                    <?php
                }

                if (isset($viral_mag_widgets_description)) {
                    ?>
                    <br />
                    <small><?php echo wp_kses_post($viral_mag_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'repeater':
            $selector = 'viral_mag_' . md5(uniqid(rand(), true));
            ?>
            <div class="ht-form-row ht-widget-repeater-wrap <?php echo $viral_mag_widgets_class; ?>" id="<?php echo $selector; ?>">
                <?php if (isset($viral_mag_widgets_title)) { ?>
                    <p><?php echo esc_html($viral_mag_widgets_title); ?></p>
                    <?php
                }

                if (!is_array($viral_mag_field_value)) {
                    foreach ($viral_mag_widgets_repeater_fields as $key => $viral_mag_widgets_repeater_field) {
                        $viral_mag_default_fields[$key] = '';
                    }

                    $viral_mag_field_value = array();
                    $viral_mag_field_value[1] = $viral_mag_default_fields;
                }

                $count = count($viral_mag_field_value);
                ?>

                <div class="ht-widget-repeater" data-count="<?php echo $count; ?>">
                    <?php
                    $i = 0;
                    foreach ($viral_mag_field_value as $viral_mag_field_val) {
                        $i++;
                        ?>
                        <div class="ht-widget-repeater-box">
                            <?php if (isset($viral_mag_widgets_repeater_title)) { ?>
                                <div class="ht-repeater-box-title"><?php echo '<span>' . esc_html($viral_mag_widgets_repeater_title) . ' - ' . $viral_mag_field_val[$viral_mag_widgets_repeater_fields_title] . '</span>'; ?> <span class="ht-repeater-toggle"></span></div>
                            <?php }
                            ?>
                            <div class="ht-repeater-content">
                                <?php
                                foreach ($viral_mag_widgets_repeater_fields as $key => $viral_mag_widgets_repeater_field) {
                                    $id = $instance->get_field_id($viral_mag_widgets_name . '-' . $i . '-' . $key);
                                    $name = $instance->get_field_name($viral_mag_widgets_name);
                                    $value = isset($viral_mag_field_val[$key]) ? $viral_mag_field_val[$key] : '';

                                    switch ($viral_mag_widgets_repeater_field['type']) {
                                        case 'text':
                                            ?>
                                            <p>
                                                <?php if (isset($viral_mag_widgets_repeater_field['title'])) { ?>
                                                    <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($viral_mag_widgets_repeater_field['title']); ?>:</label><br />
                                                <?php }
                                                ?>
                                                <input class="widefat" id="<?php echo esc_attr($id); ?>" name="<?php echo $name . '[' . $i . '][' . $key . ']'; ?>" type="text" value="<?php echo wp_kses_post($value); ?>" />

                                                <?php if (isset($viral_mag_widgets_repeater_field['desc'])) { ?>
                                                    <br />
                                                    <small><?php echo wp_kses_post($viral_mag_widgets_repeater_field['desc']); ?></small>
                                                <?php }
                                                ?>
                                            </p>
                                            <?php
                                            break;

                                        case 'textarea':
                                            ?>
                                            <p>
                                                <?php if (isset($viral_mag_widgets_repeater_field['title'])) { ?>
                                                    <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($viral_mag_widgets_repeater_field['title']); ?>:</label><br />
                                                <?php }
                                                ?>
                                                <textarea class="widefat" id="<?php echo esc_attr($id); ?>" name="<?php echo $name . '[' . $i . '][' . $key . ']'; ?>"><?php echo wp_kses_post($value); ?></textarea>

                                                <?php if (isset($viral_mag_widgets_repeater_field['desc'])) { ?>
                                                    <br />
                                                    <small><?php echo wp_kses_post($viral_mag_widgets_repeater_field['desc']); ?></small>
                                                <?php }
                                                ?>
                                            </p>
                                            <?php
                                            break;

                                        case 'select' :
                                            ?>
                                            <p>
                                                <?php if (isset($viral_mag_widgets_repeater_field['title'])) { ?>
                                                    <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($viral_mag_widgets_repeater_field['title']); ?>:</label><br />
                                                    <?php
                                                }

                                                $options = $viral_mag_widgets_repeater_field['options'];
                                                if ($options) {
                                                    ?>
                                                    <select name="<?php echo $name . '[' . $i . '][' . $key . ']'; ?>" id="<?php echo esc_attr($id); ?>" class="widefat">
                                                        <?php foreach ($options as $viral_mag_option_name => $viral_mag_option_title) { ?>
                                                            <option value="<?php echo esc_attr($viral_mag_option_name); ?>" <?php selected($viral_mag_option_name, $value); ?>><?php echo esc_html($viral_mag_option_title); ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <?php
                                                }
                                                if (isset($viral_mag_widgets_repeater_field['desc'])) {
                                                    ?>
                                                    <br />
                                                    <small><?php echo wp_kses_post($viral_mag_widgets_repeater_field['desc']); ?></small>
                                                <?php }
                                                ?>
                                            </p>
                                            <?php
                                            break;

                                        case 'icon' :
                                            ?>
                                            <div class="ht-widget-icon-box">
                                                <?php if (isset($viral_mag_widgets_repeater_field['title'])) { ?>
                                                    <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($viral_mag_widgets_repeater_field['title']); ?>:</label><br />
                                                <?php }
                                                ?>

                                                <div class="ht-selected-icon">
                                                    <i class="<?php echo esc_attr($value); ?>"></i>
                                                    <span><i class="icofont-simple-down"></i></span>
                                                </div>

                                                <div class="ht-icon-box">
                                                    <div class="ht-icon-search">
                                                        <input type="text" class="ht-icon-search-input" placeholder="<?php echo esc_attr__('Type to filter', 'viral-mag') ?>" />
                                                    </div>
                                                    <ul class="ht-icon-list clearfix">
                                                        <?php
                                                        if (isset($viral_mag_widgets_repeater_field['icon_array']) && !empty($viral_mag_widgets_repeater_field['icon_array'])) {
                                                            $icon_array = $viral_mag_widgets_repeater_field['icon_array'];
                                                        } else {
                                                            $icon_array = viral_mag_font_awesome_icon_array();
                                                        }
                                                        foreach ($icon_array as $icon) {
                                                            $icon_class = $value == $icon ? 'icon-active' : '';
                                                            echo '<li class=' . esc_attr($icon_class) . '><i class="' . $icon . '"></i></li>';
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                                <input type="hidden" name="<?php echo $name . '[' . $i . '][' . $key . ']'; ?>" value="<?php echo esc_attr($value); ?>" />

                                                <?php if (isset($viral_mag_widgets_repeater_field['desc'])) { ?>
                                                    <br />
                                                    <small><?php echo wp_kses_post($viral_mag_widgets_repeater_field['desc']); ?></small>
                                                <?php } ?>
                                            </div>
                                            <?php
                                            break;

                                        case 'editor' :
                                            ?>
                                            <p>
                                                <?php if (isset($viral_mag_widgets_repeater_field['title'])) { ?>
                                                    <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($viral_mag_widgets_repeater_field['title']); ?>:</label><br />
                                                <?php }
                                                ?>
                                                <input class="widefat" id="<?php echo esc_attr($id); ?>" name="<?php echo $name . '[' . $i . '][' . $key . ']'; ?>" value="<?php echo esc_textarea($value); ?>" type="hidden" />
                                                <a href="#" class="button ht-wp-editor-button"><?php esc_html_e('Add/Edit Content', 'viral-mag') ?></a>
                                                <?php if (isset($viral_mag_widgets_repeater_field['desc'])) { ?>
                                                    <br />
                                                    <small><?php echo wp_kses_post($viral_mag_widgets_repeater_field['desc']); ?></small>
                                                <?php } ?>
                                            </p>
                                            <?php
                                            break;

                                        case 'upload':
                                            $image = $image_class = "";
                                            if ($value) {
                                                $image = '<img src="' . esc_url($value) . '" style="max-width:100%;"/>';
                                                $image_class = ' hidden';
                                            }
                                            ?>
                                            <div class="attachment-media-view widget-media-view">

                                                <?php if (isset($viral_mag_widgets_repeater_field['title'])) { ?>
                                                    <label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($viral_mag_widgets_repeater_field['title']); ?>:</label><br />
                                                <?php } ?>

                                                <div class="placeholder<?php echo $image_class; ?>">
                                                    <?php esc_html_e('No image selected', 'viral-mag'); ?>
                                                </div>
                                                <div class="thumbnail thumbnail-image">
                                                    <?php echo $image; ?>
                                                </div>

                                                <div class="actions clearfix">
                                                    <button type="button" class="button ht-delete-button align-left"><?php esc_html_e('Remove', 'viral-mag'); ?></button>
                                                    <button type="button" class="button ht-upload-button alignright"><?php esc_html_e('Select Image', 'viral-mag'); ?></button>

                                                    <input name="<?php echo $name . '[' . $i . '][' . $key . ']'; ?>" id="<?php echo esc_attr($id); ?>" class="upload-id" type="hidden" value="<?php echo esc_url($value) ?>"/>
                                                </div>

                                                <?php if (isset($viral_mag_widgets_repeater_field['desc'])) { ?>
                                                    <br />
                                                    <small><?php echo wp_kses_post($viral_mag_widgets_repeater_field['desc']); ?></small>
                                                <?php } ?>

                                            </div>
                                            <?php
                                            break;
                                    }
                                }
                                ?>
                                <a href="#" class="button ht-widget-repeater-remove"><?php esc_html_e('Remove', 'viral-mag'); ?></a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <a href="#" class="button ht-widget-add-item"><?php echo esc_html($viral_mag_widgets_add_button); ?></a>
            </div>
            <script>
                jQuery(function ($) {
                    viral_mag_widget_sortable('#<?php echo $selector; ?>');
                });
            </script>
            <?php
            break;
    }
}

function viral_mag_exclude_widget_update($widget_field_type) {
    $uncheck_array = array('tab', 'open', 'close', 'heading');
    if (in_array($widget_field_type, $uncheck_array)) {
        return true;
    } else {
        return false;
    }
}

function viral_mag_widgets_updated_field_value($widget_field, $new_field_value) {
    extract($widget_field);
    if ($viral_mag_widgets_field_type == 'number') {
        return absint($new_field_value);
    } elseif ($viral_mag_widgets_field_type == 'editor' || $viral_mag_widgets_field_type == 'inline_editor' || $viral_mag_widgets_field_type == 'textarea') {
        return wp_kses_post(force_balance_tags($new_field_value));
    } elseif ($viral_mag_widgets_field_type == 'url') {
        return esc_url_raw($new_field_value);
    } elseif ($viral_mag_widgets_field_type == 'multicheckbox') {
        return $new_field_value;
    } elseif ($viral_mag_widgets_field_type == 'checkbox') {
        if ($new_field_value) {
            return '1';
        } else {
            return '0';
        }
    } elseif ($viral_mag_widgets_field_type == 'repeater') {
        if (!empty($new_field_value)) {
            foreach ($new_field_value as $new_field_key => $new_field_val) {
                foreach ($new_field_val as $key => $value) {
                    $output[$new_field_key][$key] = wp_kses_post($value);
                }
            }
            return $output;
        }
    } else {
        return wp_kses_post(force_balance_tags($new_field_value));
    }
}
