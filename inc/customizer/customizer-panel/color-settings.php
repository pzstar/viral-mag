<?php

/**
 * Viral Mag Theme Customizer
 *
 * @package Viral Mag
 */
$wp_customize->get_section('colors')->title = esc_html__('Color Settings', 'viral-mag');
$wp_customize->get_section('colors')->priority = 10;

//COLOR SETTINGS
$wp_customize->add_setting('viral_mag_template_color', array(
    'default' => '#cf0701',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'viral_mag_template_color', array(
    'section' => 'colors',
    'label' => esc_html__('Theme Primary Color', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_color_section_seperator1', array(
    'sanitize_callback' => 'viral_mag_sanitize_text'
));

$wp_customize->add_control(new Viral_Mag_Separator_Control($wp_customize, 'viral_mag_color_section_seperator1', array(
    'section' => 'colors'
)));

$wp_customize->add_setting('viral_mag_color_content_info', array(
    'sanitize_callback' => 'viral_mag_sanitize_text'
));

$wp_customize->add_control(new Viral_Mag_Info_Text($wp_customize, 'viral_mag_color_content_info', array(
    'section' => 'colors',
    'label' => esc_html__('Content Colors', 'viral-mag'),
    'description' => esc_html__('This settings apply only in the single posts (ie page and post detail pages only)', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_content_header_color', array(
    'default' => '#000000',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'viral_mag_content_header_color', array(
    'section' => 'colors',
    'label' => esc_html__('Content Header Color(H1, H2, H3, H4, H5, H6)', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_content_text_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'viral_mag_content_text_color', array(
    'section' => 'colors',
    'label' => esc_html__('Content Text Color', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_content_link_color', array(
    'default' => '#000000',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'viral_mag_content_link_color', array(
    'section' => 'colors',
    'label' => esc_html__('Content Link Color', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_content_link_hov_color', array(
    'default' => '#cf0701',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'viral_mag_content_link_hov_color', array(
    'section' => 'colors',
    'label' => esc_html__('Content Link Hover Color', 'viral-mag'),
)));

$wp_customize->add_setting('viral_mag_color_section_seperator2', array(
    'sanitize_callback' => 'viral_mag_sanitize_text'
));

$wp_customize->add_control(new Viral_Mag_Separator_Control($wp_customize, 'viral_mag_color_section_seperator2', array(
    'section' => 'colors'
)));

//CATEGORY COLOR
$wp_customize->add_setting('viral_mag_category_color_heading', array(
    'sanitize_callback' => 'viral_mag_sanitize_text'
));

$wp_customize->add_control(new Viral_Mag_Customize_Heading($wp_customize, 'viral_mag_category_color_heading', array(
    'section' => 'colors',
    'label' => esc_html__('Category Color', 'viral-mag'),
    'description' => esc_html__('Choose the background color for the Category.', 'viral-mag')
)));

foreach ($viral_mag_cat as $viral_mag_cat_id => $viral_mag_cat_name) {
    $wp_customize->add_setting("viral_mag_category_{$viral_mag_cat_id}_color", array(
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, "viral_mag_category_{$viral_mag_cat_id}_color", array(
        'section' => 'colors',
        'label' => $viral_mag_cat_name
    )));
}