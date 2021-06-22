<?php

/**
 * Viral Mag Theme Customizer
 *
 * @package Viral Mag
 */
//LAYOUT OPTIONS
$wp_customize->add_section('viral_mag_layout_options_section', array(
    'title' => esc_html__('Sidebar Settings', 'viral-mag'),
    'priority' => 16
));

$wp_customize->add_setting('viral_mag_sidebar_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Viral_Mag_Control_Tab($wp_customize, 'viral_mag_sidebar_nav', array(
    'type' => 'tab',
    'section' => 'viral_mag_layout_options_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Layouts', 'viral-mag'),
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
            'fields' => array(
                'viral_mag_sidebar_style',
                'viral_mag_content_widget_title_color'
            ),
        )
    ),
)));

$wp_customize->add_setting('viral_mag_sticky_sidebar', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Mag_Checkbox_Control($wp_customize, 'viral_mag_sticky_sidebar', array(
    'section' => 'viral_mag_layout_options_section',
    'label' => esc_html__('Sticky Sidebar', 'viral-mag'),
    'description' => esc_html__('The sidebar will stick at the top on scrolling', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_page_layout', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => 'right-sidebar'
));

$wp_customize->add_control(new Viral_Mag_Selector($wp_customize, 'viral_mag_page_layout', array(
    'section' => 'viral_mag_layout_options_section',
    'label' => esc_html__('Page Layout', 'viral-mag'),
    'class' => 'ht-one-forth-width',
    'description' => esc_html__('Applies to all the General Pages and Portfolio Pages.', 'viral-mag'),
    'options' => array(
        'right-sidebar' => $imagepath . '/inc/customizer/images/sidebar-layouts/right-sidebar.png',
        'left-sidebar' => $imagepath . '/inc/customizer/images/sidebar-layouts/left-sidebar.png',
        'no-sidebar' => $imagepath . '/inc/customizer/images/sidebar-layouts/no-sidebar.png',
        'no-sidebar-narrow' => $imagepath . '/inc/customizer/images/sidebar-layouts/no-sidebar-narrow.png'
    )
)));

$wp_customize->add_setting('viral_mag_post_layout', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => 'right-sidebar'
));

$wp_customize->add_control(new Viral_Mag_Selector($wp_customize, 'viral_mag_post_layout', array(
    'section' => 'viral_mag_layout_options_section',
    'label' => esc_html__('Post Layout', 'viral-mag'),
    'class' => 'ht-one-forth-width',
    'description' => esc_html__('Applies to all the Posts.', 'viral-mag'),
    'options' => array(
        'right-sidebar' => $imagepath . '/inc/customizer/images/sidebar-layouts/right-sidebar.png',
        'left-sidebar' => $imagepath . '/inc/customizer/images/sidebar-layouts/left-sidebar.png',
        'no-sidebar' => $imagepath . '/inc/customizer/images/sidebar-layouts/no-sidebar.png',
        'no-sidebar-narrow' => $imagepath . '/inc/customizer/images/sidebar-layouts/no-sidebar-narrow.png'
    )
)));

$wp_customize->add_setting('viral_mag_archive_layout', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => 'right-sidebar'
));

$wp_customize->add_control(new Viral_Mag_Selector($wp_customize, 'viral_mag_archive_layout', array(
    'section' => 'viral_mag_layout_options_section',
    'label' => esc_html__('Archive Page Layout', 'viral-mag'),
    'class' => 'ht-one-forth-width',
    'description' => esc_html__('Applies to all Archive Pages.', 'viral-mag'),
    'options' => array(
        'right-sidebar' => $imagepath . '/inc/customizer/images/sidebar-layouts/right-sidebar.png',
        'left-sidebar' => $imagepath . '/inc/customizer/images/sidebar-layouts/left-sidebar.png',
        'no-sidebar' => $imagepath . '/inc/customizer/images/sidebar-layouts/no-sidebar.png',
        'no-sidebar-narrow' => $imagepath . '/inc/customizer/images/sidebar-layouts/no-sidebar-narrow.png'
    )
)));

$wp_customize->add_setting('viral_mag_home_blog_layout', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => 'right-sidebar'
));

$wp_customize->add_control(new Viral_Mag_Selector($wp_customize, 'viral_mag_home_blog_layout', array(
    'section' => 'viral_mag_layout_options_section',
    'label' => esc_html__('Blog Page Layout', 'viral-mag'),
    'class' => 'ht-one-forth-width',
    'description' => esc_html__('Applies to Blog Page.', 'viral-mag'),
    'options' => array(
        'right-sidebar' => $imagepath . '/inc/customizer/images/sidebar-layouts/right-sidebar.png',
        'left-sidebar' => $imagepath . '/inc/customizer/images/sidebar-layouts/left-sidebar.png',
        'no-sidebar' => $imagepath . '/inc/customizer/images/sidebar-layouts/no-sidebar.png',
        'no-sidebar-narrow' => $imagepath . '/inc/customizer/images/sidebar-layouts/no-sidebar-narrow.png'
    )
)));

$wp_customize->add_setting('viral_mag_search_layout', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => 'right-sidebar'
));

$wp_customize->add_control(new Viral_Mag_Selector($wp_customize, 'viral_mag_search_layout', array(
    'section' => 'viral_mag_layout_options_section',
    'label' => esc_html__('Search Page Layout', 'viral-mag'),
    'class' => 'ht-one-forth-width',
    'description' => esc_html__('Applies to Search Page.', 'viral-mag'),
    'options' => array(
        'right-sidebar' => $imagepath . '/inc/customizer/images/sidebar-layouts/right-sidebar.png',
        'left-sidebar' => $imagepath . '/inc/customizer/images/sidebar-layouts/left-sidebar.png',
        'no-sidebar' => $imagepath . '/inc/customizer/images/sidebar-layouts/no-sidebar.png',
        'no-sidebar-narrow' => $imagepath . '/inc/customizer/images/sidebar-layouts/no-sidebar-narrow.png'
    )
)));

$wp_customize->add_setting('viral_mag_shop_layout', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => 'right-sidebar'
));

$wp_customize->add_control(new Viral_Mag_Selector($wp_customize, 'viral_mag_shop_layout', array(
    'section' => 'viral_mag_layout_options_section',
    'label' => esc_html__('Shop Page Layout(WooCommerce)', 'viral-mag'),
    'class' => 'ht-one-forth-width',
    'description' => esc_html__('Applies to Shop Page, Product Category, Product Tag and all Single Products Pages.', 'viral-mag'),
    'options' => array(
        'right-sidebar' => $imagepath . '/inc/customizer/images/sidebar-layouts/right-sidebar.png',
        'left-sidebar' => $imagepath . '/inc/customizer/images/sidebar-layouts/left-sidebar.png',
        'no-sidebar' => $imagepath . '/inc/customizer/images/sidebar-layouts/no-sidebar.png',
        'no-sidebar-narrow' => $imagepath . '/inc/customizer/images/sidebar-layouts/no-sidebar-narrow.png'
    ),
        //'active_callback' => 'viral_mag_is_woocommerce_activated'
)));

$wp_customize->add_setting('viral_mag_sidebar_style', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => 'sidebar-style2',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Selector($wp_customize, 'viral_mag_sidebar_style', array(
    'section' => 'viral_mag_layout_options_section',
    'label' => esc_html__('Sidebar Style', 'viral-mag'),
    'class' => 'ht-half-width',
    'options' => array(
        'sidebar-style1' => $imagepath . '/inc/customizer/images/sidebar-styles/sidebar-style1.png',
        'sidebar-style2' => $imagepath . '/inc/customizer/images/sidebar-styles/sidebar-style2.png'
    )
)));

$wp_customize->add_setting('viral_mag_content_widget_title_color', array(
    'default' => '#000000',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'viral_mag_content_widget_title_color', array(
    'section' => 'viral_mag_layout_options_section',
    'label' => esc_html__('Sidebar Widget Title Color', 'viral-mag')
)));