<?php

/**
 * Viral Mag Theme Customizer
 *
 * @package Viral Mag
 */

/**
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function viral_mag_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->remove_control('header_text');

    global $wp_registered_sidebars;
    $imagepath = get_template_directory_uri();
    $viral_mag_menu_choice = $viral_mag_page_choice = $viral_mag_cat = $viral_mag_widget_list = array();

    $default_widget_list = viral_mag_get_default_widgets();

    $viral_mag_widget_list['none'] = esc_html__('-- Choose Widget --', 'viral-mag');
    if ($wp_registered_sidebars) {
        foreach ($wp_registered_sidebars as $wp_registered_sidebar) {
            if (!in_array($wp_registered_sidebar['id'], $default_widget_list)) {
                $viral_mag_widget_list[$wp_registered_sidebar['id']] = $wp_registered_sidebar['name'];
            }
        }
    }

    $viral_mag_categories = get_categories(array('hide_empty' => 0));
    if ($viral_mag_categories) {
        foreach ($viral_mag_categories as $viral_mag_category) {
            $viral_mag_cat[$viral_mag_category->term_id] = $viral_mag_category->cat_name;
        }
    }


    $viral_mag_pages = get_pages(array('hide_empty' => 0));
    if ($viral_mag_pages) {
        foreach ($viral_mag_pages as $viral_mag_pages_single) {
            $viral_mag_page_choice[$viral_mag_pages_single->ID] = $viral_mag_pages_single->post_title;
        }
    }

    $viral_mag_menus = get_terms('nav_menu', array('hide_empty' => false));
    if ($viral_mag_menus) {
        foreach ($viral_mag_menus as $viral_mag_menus_single) {
            $viral_mag_menu_choice[$viral_mag_menus_single->slug] = $viral_mag_menus_single->name;
        }
    }

    $wp_customize->register_control_type('Viral_Mag_Background_Control');
    $wp_customize->register_control_type('Viral_Mag_Control_Tab');
    $wp_customize->register_control_type('Viral_Mag_Dimensions_Control');
    $wp_customize->register_control_type('Viral_Mag_Range_Slider_Control');
    $wp_customize->register_control_type('Viral_Mag_Sortable_Control');
    $wp_customize->register_control_type('Viral_Mag_Color_Tab_Control');
    $wp_customize->register_section_type('Viral_Mag_Customize_Section_Pro');
    $wp_customize->register_section_type('Viral_Mag_Customize_Upgrade_Section');

    require get_template_directory() . '/inc/customizer/customizer-panel/general-settings.php';
    require get_template_directory() . '/inc/customizer/customizer-panel/color-settings.php';
    require get_template_directory() . '/inc/customizer/customizer-panel/header-settings.php';
    require get_template_directory() . '/inc/customizer/customizer-panel/sidebar-settings.php';
    require get_template_directory() . '/inc/customizer/customizer-panel/blog-settings.php';
    require get_template_directory() . '/inc/customizer/customizer-panel/footer-settings.php';
    require get_template_directory() . '/inc/customizer/customizer-panel/social-settings.php';

    $wp_customize->get_section('static_front_page')->priority = 1;

    $wp_customize->add_section(new Viral_Mag_Customize_Section_Pro($wp_customize, 'viral-mag-pro-section', array(
        'priority' => 0,
        'pro_text' => esc_html__('Upgrade to Pro', 'viral-mag'),
        'pro_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/?utm_source=wordpress&utm_medium=viral-mag-customizer-button&utm_campaign=viral-mag-upgrade'
    )));

    $wp_customize->add_section(new Viral_Mag_Customize_Section_Pro($wp_customize, 'viral-mag-doc-section', array(
        'title' => esc_html__('Documentation', 'viral-mag'),
        'priority' => 1000,
        'pro_text' => esc_html__('View', 'viral-mag'),
        'pro_url' => 'https://hashthemes.com/documentation/viral-mag-documentation/'
    )));

    $wp_customize->add_section(new Viral_Mag_Customize_Section_Pro($wp_customize, 'viral-mag-demo-import-section', array(
        'title' => esc_html__('Import Demo Content', 'viral-mag'),
        'priority' => 0,
        'pro_text' => esc_html__('Import', 'viral-mag'),
        'pro_url' => admin_url('admin.php?page=viral-mag-welcome')
    )));
}

add_action('customize_register', 'viral_mag_customize_register');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function viral_mag_customize_preview_js() {
    wp_enqueue_script('viral-mag-customizer', get_template_directory_uri() . '/inc/customizer/js/customizer-preview.js', array('customize-preview'), VIRAL_MAG_VER, true);
}

add_action('customize_preview_init', 'viral_mag_customize_preview_js');

function viral_mag_customizer_script() {
    wp_enqueue_script('viral-mag-customizer-chosen-script', get_template_directory_uri() . '/inc/customizer/js/chosen.jquery.js', array('jquery'), VIRAL_MAG_VER, true);
    wp_enqueue_script('wp-color-picker-alpha', get_template_directory_uri() . '/inc/customizer/js/wp-color-picker-alpha.js', array('jquery', 'wp-color-picker'), VIRAL_MAG_VER, true);
    $color_picker_strings = array(
        'clear' => esc_html__('Clear', 'viral-mag'),
        'clearAriaLabel' => esc_html__('Clear color', 'viral-mag'),
        'defaultString' => esc_html__('Default', 'viral-mag'),
        'defaultAriaLabel' => esc_html__('Select default color', 'viral-mag'),
        'pick' => esc_html__('Select Color', 'viral-mag'),
        'defaultLabel' => esc_html__('Color value', 'viral-mag'),
    );
    wp_localize_script('wp-color-picker-alpha', 'wpColorPickerL10n', $color_picker_strings);
    wp_enqueue_script('viral-mag-customizer-script', get_template_directory_uri() . '/inc/customizer/js/customizer-controls.js', array('jquery', 'jquery-ui-datepicker'), VIRAL_MAG_VER, true);

    wp_enqueue_style('materialdesignicons', get_template_directory_uri() . '/css/materialdesignicons.css', array(), VIRAL_MAG_VER);
    wp_enqueue_style('icofont', get_template_directory_uri() . '/css/icofont.css', array(), VIRAL_MAG_VER);
    wp_enqueue_style('eleganticons', get_template_directory_uri() . '/css/eleganticons.css', array(), VIRAL_MAG_VER);
    wp_enqueue_style('viral-mag-customizer-chosen-style', get_template_directory_uri() . '/inc/customizer/css/chosen.css', array(), VIRAL_MAG_VER);
    wp_enqueue_style('viral-mag-customizero-style', get_template_directory_uri() . '/inc/customizer/css/customizer-controls.css', array('wp-color-picker'), VIRAL_MAG_VER);
}

add_action('customize_controls_enqueue_scripts', 'viral_mag_customizer_script');

require get_template_directory() . '/inc/customizer/customizer-control-class.php';
require get_template_directory() . '/inc/customizer/customizer-control-sanitization.php';
require get_template_directory() . '/inc/customizer/customizer-active-callbacks.php';

add_action('wp_ajax_viral_mag_order_sections', 'viral_mag_order_sections');

function viral_mag_order_sections() {
    if (isset($_POST['sections'])) {
        set_theme_mod('viral_mag_frontpage_sections', $_POST['sections']);
    }
    wp_die();
}

function viral_mag_frontpage_sections() {
    $defaults = array(
        'viral_mag_frontpage_ticker_section',
        'viral_mag_frontpage_slider1_section',
        'viral_mag_frontpage_slider2_section',
        'viral_mag_frontpage_featured_section',
        'viral_mag_frontpage_tile1_section',
        'viral_mag_frontpage_tile2_section',
        'viral_mag_frontpage_mininews_section',
        'viral_mag_frontpage_leftnews_section',
        'viral_mag_frontpage_rightnews_section',
        'viral_mag_frontpage_fwcarousel_section',
        'viral_mag_frontpage_carousel1_section',
        'viral_mag_frontpage_carousel2_section',
        'viral_mag_frontpage_threecol_section',
        'viral_mag_frontpage_fwnews1_section',
        'viral_mag_frontpage_fwnews2_section',
        'viral_mag_frontpage_video_section'
    );
    $sections = get_theme_mod('viral_mag_frontpage_sections', $defaults);
    return $sections;
}

function viral_mag_get_section_position($key) {
    $sections = viral_mag_frontpage_sections();
    $position = array_search($key, $sections);
    $return = ( $position + 1 ) * 10;
    return $return;
}

function viral_mag_svg_seperator() {
    return array(
        'big-triangle-center' => esc_html__('Big Triangle Center', 'viral-mag'),
        'big-triangle-left' => esc_html__('Big Triangle Left', 'viral-mag'),
        'big-triangle-right' => esc_html__('Big Triangle Right', 'viral-mag'),
        'clouds' => esc_html__('Clouds', 'viral-mag'),
        'curve-center' => esc_html__('Curve Center', 'viral-mag'),
        'curve-repeater' => esc_html__('Curve Repeater', 'viral-mag'),
        'droplets' => esc_html__('Droplets', 'viral-mag'),
        'paper-cut' => esc_html__('Paint Brush', 'viral-mag'),
        'small-triangle-center' => esc_html__('Small Triangle Center', 'viral-mag'),
        'tilt-left' => esc_html__('Tilt Left', 'viral-mag'),
        'tilt-right' => esc_html__('Tilt Right', 'viral-mag'),
        'uniform-waves' => esc_html__('Uniform Waves', 'viral-mag'),
        'water-waves' => esc_html__('Water Waves', 'viral-mag'),
        'big-waves' => esc_html__('Big Waves', 'viral-mag'),
        'slanted-waves' => esc_html__('Slanted Waves', 'viral-mag'),
        'zigzag' => esc_html__('Zigzag', 'viral-mag'),
    );
}
