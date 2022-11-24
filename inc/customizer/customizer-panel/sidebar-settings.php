<?php

/**
 * Viral Mag Theme Customizer
 *
 * @package Viral Mag
 */
//LAYOUT OPTIONS
$wp_customize->add_section('viral_mag_sidebar_settings_section', array(
    'title' => esc_html__('Sidebar Settings', 'viral-mag'),
    'priority' => 20
));

$wp_customize->add_setting('viral_mag_sidebar_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Viral_Mag_Tab_Control($wp_customize, 'viral_mag_sidebar_nav', array(
    
    'section' => 'viral_mag_sidebar_settings_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Layouts', 'viral-mag'),
            'icon' => 'dashicons dashicons-welcome-write-blog',
            'fields' => array(
                'viral_mag_page_layout',
                'viral_mag_post_layout',
                'viral_mag_archive_layout',
                'viral_mag_home_blog_layout',
                'viral_mag_search_layout',
                'viral_mag_shop_layout'
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Styles', 'viral-mag'),
            'icon' => 'dashicons dashicons-art',
            'fields' => array(
                'viral_mag_sidebar_style',
                'viral_mag_sidebar_title_typography',
                'viral_mag_content_widget_title_color'
            ),
        )
    ),
)));

$wp_customize->add_setting('viral_mag_sticky_sidebar', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Mag_Toggle_Control($wp_customize, 'viral_mag_sticky_sidebar', array(
    'section' => 'viral_mag_sidebar_settings_section',
    'label' => esc_html__('Sticky Sidebar', 'viral-mag'),
    'description' => esc_html__('The sidebar will stick at the top on scrolling', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_page_layout', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => 'right-sidebar'
));

$wp_customize->add_control(new Viral_Mag_Selector_Control($wp_customize, 'viral_mag_page_layout', array(
    'section' => 'viral_mag_sidebar_settings_section',
    'label' => esc_html__('Page Layout', 'viral-mag'),
    'class' => 'ht--one-forth-width',
    'description' => esc_html__('Applies to all the General Pages and Portfolio Pages.', 'viral-mag'),
    'options' => array(
        'right-sidebar' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-layouts/right-sidebar.png',
        'left-sidebar' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-layouts/left-sidebar.png',
        'no-sidebar' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-layouts/no-sidebar.png',
        'no-sidebar-narrow' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-layouts/no-sidebar-narrow.png'
    )
)));

$wp_customize->add_setting('viral_mag_post_layout', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => 'right-sidebar'
));

$wp_customize->add_control(new Viral_Mag_Selector_Control($wp_customize, 'viral_mag_post_layout', array(
    'section' => 'viral_mag_sidebar_settings_section',
    'label' => esc_html__('Post Layout', 'viral-mag'),
    'class' => 'ht--one-forth-width',
    'description' => esc_html__('Applies to all the Posts.', 'viral-mag'),
    'options' => array(
        'right-sidebar' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-layouts/right-sidebar.png',
        'left-sidebar' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-layouts/left-sidebar.png',
        'no-sidebar' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-layouts/no-sidebar.png',
        'no-sidebar-narrow' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-layouts/no-sidebar-narrow.png'
    )
)));

$wp_customize->add_setting('viral_mag_archive_layout', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => 'right-sidebar'
));

$wp_customize->add_control(new Viral_Mag_Selector_Control($wp_customize, 'viral_mag_archive_layout', array(
    'section' => 'viral_mag_sidebar_settings_section',
    'label' => esc_html__('Archive Page Layout', 'viral-mag'),
    'class' => 'ht--one-forth-width',
    'description' => esc_html__('Applies to all Archive Pages.', 'viral-mag'),
    'options' => array(
        'right-sidebar' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-layouts/right-sidebar.png',
        'left-sidebar' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-layouts/left-sidebar.png',
        'no-sidebar' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-layouts/no-sidebar.png',
        'no-sidebar-narrow' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-layouts/no-sidebar-narrow.png'
    )
)));

$wp_customize->add_setting('viral_mag_home_blog_layout', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => 'right-sidebar'
));

$wp_customize->add_control(new Viral_Mag_Selector_Control($wp_customize, 'viral_mag_home_blog_layout', array(
    'section' => 'viral_mag_sidebar_settings_section',
    'label' => esc_html__('Blog Page Layout', 'viral-mag'),
    'class' => 'ht--one-forth-width',
    'description' => esc_html__('Applies to Blog Page.', 'viral-mag'),
    'options' => array(
        'right-sidebar' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-layouts/right-sidebar.png',
        'left-sidebar' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-layouts/left-sidebar.png',
        'no-sidebar' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-layouts/no-sidebar.png',
        'no-sidebar-narrow' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-layouts/no-sidebar-narrow.png'
    )
)));

$wp_customize->add_setting('viral_mag_search_layout', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => 'right-sidebar'
));

$wp_customize->add_control(new Viral_Mag_Selector_Control($wp_customize, 'viral_mag_search_layout', array(
    'section' => 'viral_mag_sidebar_settings_section',
    'label' => esc_html__('Search Page Layout', 'viral-mag'),
    'class' => 'ht--one-forth-width',
    'description' => esc_html__('Applies to Search Page.', 'viral-mag'),
    'options' => array(
        'right-sidebar' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-layouts/right-sidebar.png',
        'left-sidebar' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-layouts/left-sidebar.png',
        'no-sidebar' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-layouts/no-sidebar.png',
        'no-sidebar-narrow' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-layouts/no-sidebar-narrow.png'
    )
)));

$wp_customize->add_setting('viral_mag_shop_layout', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => 'right-sidebar'
));

$wp_customize->add_control(new Viral_Mag_Selector_Control($wp_customize, 'viral_mag_shop_layout', array(
    'section' => 'viral_mag_sidebar_settings_section',
    'label' => esc_html__('Shop Page Layout(WooCommerce)', 'viral-mag'),
    'class' => 'ht--one-forth-width',
    'description' => esc_html__('Applies to Shop Page, Product Category, Product Tag and all Single Products Pages.', 'viral-mag'),
    'options' => array(
        'right-sidebar' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-layouts/right-sidebar.png',
        'left-sidebar' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-layouts/left-sidebar.png',
        'no-sidebar' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-layouts/no-sidebar.png',
        'no-sidebar-narrow' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-layouts/no-sidebar-narrow.png'
    ),
)));

// Add the Widget typography section.
$wp_customize->add_section('viral_mag_sidebar_title_typography', array(
    'panel' => 'viral_mag_typography_settings_panel',
    'title' => esc_html__('Widget Title', 'viral-mag')
));

$wp_customize->add_setting('viral_mag_sidebar_title_family', array(
    'default' => 'Poppins',
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_setting('viral_mag_sidebar_title_style', array(
    'default' => '500',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_sidebar_title_text_decoration', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_sidebar_title_text_transform', array(
    'default' => 'uppercase',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_sidebar_title_size', array(
    'default' => '18',
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_sidebar_title_line_height', array(
    'default' => '1.3',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_sidebar_title_letter_spacing', array(
    'default' => '0',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Typography_Control($wp_customize, 'viral_mag_sidebar_title_typography', array(
    'label' => esc_html__('Widget Title Typography', 'viral-mag'),
    'description' => __('Select how you want your widget title to appear. This settings applies for sidebar and footer widget titles', 'viral-mag'),
    'section' => 'viral_mag_sidebar_settings_section',
    'settings' => array(
        'family' => 'viral_mag_sidebar_title_family',
        'style' => 'viral_mag_sidebar_title_style',
        'text_decoration' => 'viral_mag_sidebar_title_text_decoration',
        'text_transform' => 'viral_mag_sidebar_title_text_transform',
        'size' => 'viral_mag_sidebar_title_size',
        'line_height' => 'viral_mag_sidebar_title_line_height',
        'letter_spacing' => 'viral_mag_sidebar_title_letter_spacing'
    ),
    'input_attrs' => array(
        'min' => 12,
        'max' => 40,
        'step' => 1
    )
)));

$wp_customize->add_setting('viral_mag_sidebar_style', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => 'sidebar-style2',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Selector_Control($wp_customize, 'viral_mag_sidebar_style', array(
    'section' => 'viral_mag_sidebar_settings_section',
    'label' => esc_html__('Sidebar Style', 'viral-mag'),
    'class' => 'vm-half-width',
    'options' => array(
        'sidebar-style1' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-styles/sidebar-style1.png',
        'sidebar-style2' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/sidebar-styles/sidebar-style2.png'
    )
)));

$wp_customize->add_setting('viral_mag_content_widget_title_color', array(
    'default' => '#000000',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'viral_mag_content_widget_title_color', array(
    'section' => 'viral_mag_sidebar_settings_section',
    'label' => esc_html__('Sidebar Widget Title Color', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_sidebar_upgrade_text', array(
    'sanitize_callback' => 'viral_mag_sanitize_text'
));

$wp_customize->add_control(new Viral_Mag_Upgrade_Info_Control($wp_customize, 'viral_mag_sidebar_upgrade_text', array(
    'section' => 'viral_mag_sidebar_settings_section',
    'label' => esc_html__('For more options,', 'viral-mag'),
    'choices' => array(
        esc_html__('8 sidebar styles', 'viral-mag'),
        esc_html__('20+ widgets/blocks for sidebar', 'viral-mag'),
    ),
    'priority' => 100,
    'active_callback' => 'viral_mag_is_upgrade_notice_active'
)));