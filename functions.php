<?php

/**
 * Viral Mag functions and definitions
 *
 * @package Viral Mag
 */
if (!defined('VIRAL_MAG_VERSION')) {
    $viral_mag_get_theme = wp_get_theme();
    $viral_mag_version = $viral_mag_get_theme->Version;
    define('VIRAL_MAG_VERSION', $viral_mag_version);
}

if (!function_exists('viral_mag_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function viral_mag_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Viral Mag, use a find and replace
         * to change 'viral-mag' to the name of your theme in all the template files
         */
        load_theme_textdomain('viral-mag', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support('post-thumbnails');
        add_image_size('viral-mag-1300x540', 1300, 540, true);
        add_image_size('viral-mag-800x500', 800, 500, true);
        add_image_size('viral-mag-700x700', 700, 700, true);
        add_image_size('viral-mag-650x500', 650, 500, true);
        add_image_size('viral-mag-500x500', 500, 500, true);
        add_image_size('viral-mag-500x600', 500, 600, true);
        add_image_size('viral-mag-360x240', 360, 240, true);
        add_image_size('viral-mag-150x150', 150, 150, true);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'viral-mag-primary-menu' => esc_html__('Primary Menu', 'viral-mag'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('viral_mag_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        add_theme_support('custom-logo', array(
            'height' => 62,
            'width' => 300,
            'flex-height' => true,
            'flex-width' => true,
            'header-text' => array('.vm-site-title', '.vm-site-description'),
        ));

        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');

        /*
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, icons, and column width.
         */
        add_editor_style(array('css/editor-style.css', viral_mag_fonts_url()));

        add_theme_support('customize-selective-refresh-widgets');

        // Add support for Block Styles.
        add_theme_support('wp-block-styles');

        // Add support for full and wide align images.
        add_theme_support('align-wide');

        // Add support for editor styles.
        add_theme_support('editor-styles');

        // Add support for responsive embedded content.
        add_theme_support('responsive-embeds');
    }

endif; // viral_mag_setup
add_action('after_setup_theme', 'viral_mag_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $viral_mag_content_width
 */
function viral_mag_content_width() {
    $GLOBALS['viral_mag_content_width'] = apply_filters('viral_mag_content_width', 640);
}

add_action('after_setup_theme', 'viral_mag_content_width', 0);

/**
 * Enables the Excerpt meta box in Page edit screen.
 */
function viral_mag_add_excerpt_support_for_pages() {
    add_post_type_support('page', 'excerpt');
}

add_action('init', 'viral_mag_add_excerpt_support_for_pages');

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function viral_mag_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Right Sidebar', 'viral-mag'),
        'id' => 'viral-mag-right-sidebar',
        'description' => esc_html__('Add widgets here to appear in your sidebar.', 'viral-mag'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Left Sidebar', 'viral-mag'),
        'id' => 'viral-mag-left-sidebar',
        'description' => esc_html__('Add widgets here to appear in your sidebar.', 'viral-mag'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('OffCanvas Sidebar', 'viral-mag'),
        'id' => 'viral-mag-offcanvas-sidebar',
        'description' => esc_html__('Add widgets here to appear in your OffCanvas Sidebar.', 'viral-mag'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer One', 'viral-mag'),
        'id' => 'viral-mag-footer1',
        'description' => esc_html__('Add widgets here to appear in your Footer.', 'viral-mag'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Two', 'viral-mag'),
        'id' => 'viral-mag-footer2',
        'description' => esc_html__('Add widgets here to appear in your Footer.', 'viral-mag'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Three', 'viral-mag'),
        'id' => 'viral-mag-footer3',
        'description' => esc_html__('Add widgets here to appear in your Footer.', 'viral-mag'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Four', 'viral-mag'),
        'id' => 'viral-mag-footer4',
        'description' => esc_html__('Add widgets here to appear in your Footer.', 'viral-mag'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Five', 'viral-mag'),
        'id' => 'viral-mag-footer5',
        'description' => esc_html__('Add widgets here to appear in your Footer.', 'viral-mag'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
}

add_action('widgets_init', 'viral_mag_widgets_init');

if (!function_exists('viral_mag_fonts_url')) :

    /**
     * Register Google fonts for Viral Mag.
     *
     * @since Viral Mag 1.0
     *
     * @return string Google fonts URL for the theme.
     */
    function viral_mag_fonts_url() {
        $fonts_url = '';
        $fonts = $customizer_font_family = array();
        $subsets = 'latin,latin-ext';
        $all_fonts = viral_mag_all_fonts();
        $google_fonts = viral_mag_google_fonts();

        $customizer_fonts = array(
            'viral_mag_body_family' => 'Poppins',
            'viral_mag_menu_family' => 'Poppins',
            'viral_mag_h_family' => 'Poppins',
            'viral_mag_page_title_family' => 'Default',
            'viral_mag_frontpage_title_family' => 'Default',
            'viral_mag_frontpage_block_title_family' => 'Default',
            'viral_mag_sidebar_title_family' => 'Default'
        );

        $common_header_typography = get_theme_mod('viral_mag_common_header_typography', true);
        if ($common_header_typography) {
            $customizer_fonts['viral_mag_h_family'] = 'Oswald';
        } else {
            $customizer_fonts['viral_mag_h1_family'] = 'Oswald';
            $customizer_fonts['viral_mag_h2_family'] = 'Oswald';
            $customizer_fonts['viral_mag_h3_family'] = 'Oswald';
            $customizer_fonts['viral_mag_h4_family'] = 'Oswald';
            $customizer_fonts['viral_mag_h5_family'] = 'Oswald';
            $customizer_fonts['viral_mag_h6_family'] = 'Oswald';
        }

        foreach ($customizer_fonts as $key => $value) {
            $font = get_theme_mod($key, $value);
            if (array_key_exists($font, $google_fonts)) {
                $customizer_font_family[] = $font;
            }
        }

        if ($customizer_font_family) {
            $customizer_font_family = array_unique($customizer_font_family);
            foreach ($customizer_font_family as $font_family) {
                if (isset($all_fonts[$font_family]['variants'])) {
                    $variants_array = $all_fonts[$font_family]['variants'];
                    $variants_keys = array_keys($variants_array);
                    $variants = implode(',', $variants_keys);

                    $fonts[] = $font_family . ':' . str_replace('italic', 'i', $variants);
                }
            }

            if ($fonts) {
                $fonts_url = add_query_arg(array(
                    'family' => urlencode(implode('|', $fonts)),
                    'subset' => urlencode($subsets),
                    'display' => 'swap',
                        ), 'https://fonts.googleapis.com/css');
            }

            return $fonts_url;
        }
    }

endif;

/**
 * Enqueue scripts and styles.
 */
function viral_mag_scripts() {
    $is_rtl = (is_rtl()) ? 'true' : 'false';

    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), VIRAL_MAG_VERSION, true);
    wp_enqueue_script('hoverintent', get_template_directory_uri() . '/js/hoverintent.js', array(), VIRAL_MAG_VERSION, true);
    wp_enqueue_script('superfish', get_template_directory_uri() . '/js/superfish.js', array('jquery'), VIRAL_MAG_VERSION, true);
    wp_enqueue_script('headroom', get_template_directory_uri() . '/js/headroom.js', array('jquery'), VIRAL_MAG_VERSION, true);
    wp_enqueue_script('theia-sticky-sidebar', get_template_directory_uri() . '/js/theia-sticky-sidebar.js', array('jquery'), VIRAL_MAG_VERSION, true);
    wp_enqueue_script('resizesensor', get_template_directory_uri() . '/js/ResizeSensor.js', array('jquery'), VIRAL_MAG_VERSION, true);
    wp_enqueue_script('viral-mag-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), VIRAL_MAG_VERSION, true);

    wp_enqueue_style('viral-mag-style', get_stylesheet_uri(), array(), VIRAL_MAG_VERSION);
    wp_enqueue_style('eleganticons', get_template_directory_uri() . '/css/eleganticons.css', array(), VIRAL_MAG_VERSION);
    wp_enqueue_style('materialdesignicons', get_template_directory_uri() . '/css/materialdesignicons.css', array(), VIRAL_MAG_VERSION);
    wp_enqueue_style('icofont', get_template_directory_uri() . '/css/icofont.css', array(), VIRAL_MAG_VERSION);
    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css', array(), VIRAL_MAG_VERSION);

    wp_add_inline_style('viral-mag-style', viral_mag_dymanic_styles());

    $fonts_url = viral_mag_fonts_url();
    $load_font_locally = get_theme_mod('viral_mag_load_google_font_locally', false);
    if ($fonts_url && $load_font_locally) {
        require_once get_theme_file_path('inc/wptt-webfont-loader.php');
        $fonts_url = wptt_get_webfont_url($fonts_url);
    }

    // Load Fonts if necessary.
    if ($fonts_url) {
        wp_enqueue_style('viral-mag-fonts', $fonts_url, array(), NULL);
    }

    wp_localize_script('viral-mag-custom', 'viral_mag_options', array(
        'template_path' => get_template_directory_uri(),
        'rtl' => $is_rtl,
    ));

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'viral_mag_scripts');

/**
 * BreadCrumb
 */
require get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/theme-functions.php';

/**
 * Hooks
 */
require get_template_directory() . '/inc/hooks.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets/widgets.php';

/**
 * Header Functions
 */
require get_template_directory() . '/inc/header/header-functions.php';

/**
 * Hooks
 */
require get_template_directory() . '/inc/theme-hooks.php';

/**
 * Welcome Page
 */
require get_template_directory() . '/welcome/welcome.php';

/**
 * TGMPA
 */
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

/**
 * Dynamic Styles additions
 */
require get_template_directory() . '/inc/style.php';
