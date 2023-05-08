<?php
/**
 *
 * @package Viral Mag
 */
$viral_mag_active_widgets = array_keys(viral_mag_registered_widget_list());

if (is_array($viral_mag_active_widgets)) {
    foreach ($viral_mag_active_widgets as $viral_mag_widgets) {
        if (file_exists(get_template_directory() . '/inc/widgets/' . $viral_mag_widgets . '.php')) {
            require_once get_template_directory() . '/inc/widgets/' . $viral_mag_widgets . '.php';
        }
    }
}

function viral_mag_registered_widget_list() {
    return array(
        'widget-category' => esc_html__('Categories', 'viral-mag'),
        'widget-contact-info' => esc_html__('Contact Info', 'viral-mag'),
        'widget-latest-posts' => esc_html__('Latest Posts', 'viral-mag'),
        'widget-post-carousel-category' => esc_html__('Post Carousel by Category', 'viral-mag'),
        'widget-post-list-category' => esc_html__('Post Listing by Category', 'viral-mag'),
        'widget-post-list' => esc_html__('Post Listing', 'viral-mag'),
    );
}

function viral_mag_category_list() {
    $viral_mag_categories = get_categories(array('hide_empty' => 0));
    $viral_mag_cat = array();
    if ($viral_mag_categories) {
        foreach ($viral_mag_categories as $viral_mag_category) {
            $viral_mag_cat[$viral_mag_category->term_id] = $viral_mag_category->cat_name;
        }
    }

    return $viral_mag_cat;
}

/**
 * Enqueue Style and Script for widgets
 */
require_once get_template_directory() . '/inc/widgets/widget-fields.php';

function viral_mag_admin_scripts() {
    wp_enqueue_style('materialdesignicons', get_template_directory_uri() . '/css/materialdesignicons.css', array(), VIRAL_MAG_VERSION);
    wp_enqueue_style('icofont', get_template_directory_uri() . '/css/icofont.css', array(), VIRAL_MAG_VERSION);
    wp_enqueue_style('eleganticons', get_template_directory_uri() . '/css/eleganticons.css', array(), VIRAL_MAG_VERSION);
    wp_enqueue_style('viral-mag-admin-style', get_template_directory_uri() . '/inc/widgets/css/widget-style.css', array('wp-color-picker'), VIRAL_MAG_VERSION);

    wp_enqueue_media();
    $is_widgets_block_editor = function_exists('wp_use_widgets_block_editor') && wp_use_widgets_block_editor() ? 'true' : 'false';
    wp_enqueue_script('viral-mag-widget-script', get_template_directory_uri() . '/inc/widgets/js/widget-script.js', array('jquery', 'wp-color-picker', 'jquery-ui-datepicker'), VIRAL_MAG_VERSION, true);
    wp_localize_script('viral-mag-widget-script', 'viral_mag_widget_options', array(
        'widgets_block_editor' => $is_widgets_block_editor,
    ));
}

add_action('admin_enqueue_scripts', 'viral_mag_admin_scripts', 100);

add_action('elementor/editor/before_enqueue_scripts', 'viral_mag_admin_scripts');


/* ADD EDITOR TO CUSTOMIZER */

function viral_mag_customizer_editor() {
    ?>
    <div id="vm-wp-editor-widget-container" style="display: none;">
        <a class="vm-wp-editor-widget-close" href="#" title="<?php esc_attr_e('Close', 'viral-mag'); ?>"><i class="icofont-close-squared-alt"></i></a>
        <div class="editor">
            <?php
            $settings = array('textarea_rows' => 55, 'editor_height' => 260);
            wp_editor('', 'wpeditorwidget', $settings);
            ?>
            <p><a href="#" class="vm-wp-editor-widget-update-close button button-primary"><?php _e('Save and Close', 'viral-mag'); ?></a></p>
        </div>
    </div>
    <div id="vm-wp-editor-widget-backdrop" style="display: none;"></div>
    <?php
}

// END output_wp_editor_widget_html*/

add_action('widgets_admin_page', 'viral_mag_customizer_editor', 100);
add_action('customize_controls_print_footer_scripts', 'viral_mag_customizer_editor');
add_action('elementor/editor/before_enqueue_scripts', 'viral_mag_customizer_editor');

//SiteOrigin Builder
if (function_exists('siteorigin_panels_render')) {
    add_action('admin_print_scripts-post.php', 'viral_mag_customizer_editor', 100);
    add_action('admin_print_scripts-post-new.php', 'viral_mag_customizer_editor', 100);
}

//Beaver Builder
if (class_exists('FLBuilder')) {
    if (isset($_GET['fl_builder'])) {
        add_action('viral_mag_after_footer', 'viral_mag_customizer_editor', 100);
    }
}

/* Add Filters for the Customizer wp_editor */
add_filter('wp_editor_widget_content', 'wptexturize');
add_filter('wp_editor_widget_content', 'convert_smilies');
add_filter('wp_editor_widget_content', 'convert_chars');
add_filter('wp_editor_widget_content', 'wpautop');
add_filter('wp_editor_widget_content', 'shortcode_unautop');
add_filter('wp_editor_widget_content', 'do_shortcode', 11);
