<?php

/**
 * The header for our theme.
 *
 * @package Viral Mag
 */
function viral_mag_body_classes($classes) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }

    $viral_mag_sidebar_layout = '';

    if (is_singular('page')) {
        $viral_mag_sidebar_layout = get_theme_mod('viral_mag_page_layout', 'right-sidebar');
    } elseif (is_singular('post')) {
        $viral_mag_sidebar_layout = get_theme_mod('viral_mag_post_layout', 'right-sidebar');
    } elseif (viral_mag_is_woocommerce_activated() && is_woocommerce()) {
        $viral_mag_sidebar_layout = get_theme_mod('viral_mag_shop_layout', 'right-sidebar');
    } elseif (is_archive() && !is_home() && !is_search()) {
        $viral_mag_sidebar_layout = get_theme_mod('viral_mag_archive_layout', 'right-sidebar');
    } elseif (is_home()) {
        $viral_mag_sidebar_layout = get_theme_mod('viral_mag_home_blog_layout', 'right-sidebar');
    } elseif (is_search()) {
        $viral_mag_sidebar_layout = get_theme_mod('viral_mag_search_layout', 'right-sidebar');
    } else {
        $viral_mag_sidebar_layout = 'right-sidebar';
    }

    $classes[] = 'vm-' . $viral_mag_sidebar_layout;

    $sticky_header = get_theme_mod('viral_mag_sticky_header', 'off');
    $viral_mag_top_header = get_theme_mod('viral_mag_top_header', 'on');
    $website_layout = get_theme_mod('viral_mag_website_layout', 'wide');
    $header_style = get_theme_mod('viral_mag_mh_layout', 'header-style1');
    $sidebar_style = get_theme_mod('viral_mag_sidebar_style', 'sidebar-style2');
    $sticky_sidebar = get_theme_mod('viral_mag_sticky_sidebar', true);
    $block_title_style = get_theme_mod('viral_mag_block_title_style', 'style2');
    $common_header_typography = get_theme_mod('viral_mag_common_header_typography', true);

    if (is_singular('post')) {
        $viral_mag_post_layout = get_theme_mod('viral_mag_single_layout', 'layout1');
        $classes[] = 'vm-single-' . $viral_mag_post_layout;
    }

    $classes[] = 'vm-top-header-' . $viral_mag_top_header;

    if ($sticky_header == 'on') {
        $classes[] = 'vm-sticky-header';
    }

    if ($sticky_sidebar) {
        $classes[] = 'vm-sticky-sidebar';
    }

    if ($common_header_typography) {
        $classes[] = 'vm-common-h-type';
    } else {
        $classes[] = 'vm-diff-h-type';
    }

    $classes[] = 'vm-' . $website_layout;

    $classes[] = 'vm-' . $header_style;

    $classes[] = 'vm-' . $sidebar_style;

    $classes[] = 'vm-block-title-' . $block_title_style;

    return $classes;
}

add_filter('body_class', 'viral_mag_body_classes');

if (!function_exists('viral_mag_change_wp_page_menu_args')) {

    function viral_mag_change_wp_page_menu_args($args) {
        $args['menu_class'] = 'vm-menu vm-clearfix';
        return $args;
    }

}

add_filter('wp_page_menu_args', 'viral_mag_change_wp_page_menu_args');

function viral_mag_breadcrumbs() {
    $viral_mag_breadcrumb = get_theme_mod('viral_mag_breadcrumb', true);
    if (!$viral_mag_breadcrumb) {
        return;
    }

    $args = array(
        'show_browse' => false,
        'show_on_front' => false,
    );
    viral_mag_breadcrumb_trail($args);
}

add_action('viral_mag_breadcrumbs', 'viral_mag_breadcrumbs');

function viral_mag_convert_to_negative($arg) {
    return ('-' . $arg);
}

function viral_mag_remove_category($query) {
    $category = get_theme_mod('viral_mag_blog_cat');
    $category_array = explode(',', $category);
    $category_array = array_map('viral_mag_convert_to_negative', $category_array);
    $category = implode(',', $category_array);
    if ($query->is_home() && $query->is_main_query()) {
        $query->set('cat', $category);
    }
}

add_action('pre_get_posts', 'viral_mag_remove_category');

function viral_mag_edit_archive_title($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    }

    return $title;
}

add_filter('get_the_archive_title', 'viral_mag_edit_archive_title');

function viral_mag_remove_more_link_scroll($link) {
    $link = preg_replace('|#more-[0-9]+|', '', $link);
    return $link;
}

add_filter('the_content_more_link', 'viral_mag_remove_more_link_scroll');

function viral_mag_move_comment_field_to_bottom($fields) {
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;
    return $fields;
}

add_filter('comment_form_fields', 'viral_mag_move_comment_field_to_bottom');

add_action('tgmpa_register', 'viral_mag_register_required_plugins');

function viral_mag_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        array(
            'name' => 'Elementor',
            'slug' => 'elementor',
            'required' => false,
        ),
        array(
            'name' => 'Hash Elements',
            'slug' => 'hash-elements',
            'required' => false,
        ),
        array(
            'name' => 'Hash Form - Drag & Drop Form Builder',
            'slug' => 'hash-form',
            'required' => false,
        )
    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id' => 'viral-mag', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message' => '', // Message to output right before the plugins table.
    );

    tgmpa($plugins, $config);
}

if (!function_exists('viral_mag_add_custom_fonts')) {

    function viral_mag_add_custom_fonts($fonts) {
        if (class_exists('Hash_Custom_Font_Uploader_Public')) {
            if (!empty(Hash_Custom_Font_Uploader_Public::get_all_fonts_list())) {
                $new_fonts = array(
                    'label' => esc_html__('Custom Fonts', 'viral-mag'),
                    'fonts' => Hash_Custom_Font_Uploader_Public::get_all_fonts_list()
                );
                array_unshift($fonts, $new_fonts);
            }
        }
        return $fonts;
    }

}

add_filter('viral_mag_regsiter_fonts', 'viral_mag_add_custom_fonts');

function viral_mag_premium_demo_config($demos) {
    $premium_demos = array(
        'newspaper' => array(
            'name' => 'Viral Pro - NewsPaper',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/newspaper.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/newspaper/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'magazine' => array(
            'name' => 'Viral Pro - Magazine',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/magazine.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/magazine/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'news' => array(
            'name' => 'Viral Pro - News',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/news.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/news/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'viral-news-one' => array(
            'name' => 'Viral Pro - News One',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/viral-news-one.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/viral-news-one/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'viral-news-two' => array(
            'name' => 'Viral Pro - News Two',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/viral-news-two.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/viral-news-two/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'viral-news-three' => array(
            'name' => 'Viral Pro - News Three',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/viral-news-three.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/viral-news-three/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'viral-news-four' => array(
            'name' => 'Viral Pro - News Four',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/viral-news-four.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/viral-news-four/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'sports' => array(
            'name' => 'Viral Pro - Sports',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/sports.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/sports/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'technology' => array(
            'name' => 'Viral Pro - Technology',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/technology.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/technology/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'illustration' => array(
            'name' => 'Viral Pro - Illustration',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/illustration.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/illustration/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'fashion' => array(
            'name' => 'Viral Pro - Fashion',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/fashion.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/fashion/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'travel' => array(
            'name' => 'Viral Pro - Travel',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/travel.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/travel/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'food' => array(
            'name' => 'Viral Pro - Food',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/food.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/food/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'photography' => array(
            'name' => 'Viral Pro - Photography',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/photography.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/photography/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        ),
        'rtl' => array(
            'name' => 'Viral Pro - RTL',
            'type' => 'pro',
            'buy_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/',
            'image' => 'https://hashthemes.com/import-files/viral-pro/screen/rtl.jpg',
            'preview_url' => 'https://demo.hashthemes.com/viral-pro/rtl/',
            'tags' => array(
                'premium' => 'Premium'
            ),
            'pagebuilder' => array(
                'customizer' => 'Customizer',
                'elementor' => 'Elementor'
            )
        )
    );

    $demos = array_merge($demos, $premium_demos);
    return $demos;
}

add_action('hdi_import_files', 'viral_mag_premium_demo_config');
