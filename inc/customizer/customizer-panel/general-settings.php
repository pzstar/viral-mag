<?php

/**
 * Viral Mag Theme Customizer
 *
 * @package Viral Mag
 */
/* GENERAL SETTINGS PANEL */
$wp_customize->add_panel('viral_mag_general_settings_panel', array(
    'title' => esc_html__('General Settings', 'viral-mag'),
    'priority' => 2
));

//MOVE BACKGROUND AND COLOR SETTING INTO GENERAL SETTING PANEL
$wp_customize->get_section('background_image')->panel = 'viral_mag_general_settings_panel';
$wp_customize->get_control('background_color')->section = 'background_image';

//GENERAL SETTINGS
$wp_customize->add_section('viral_mag_general_options_section', array(
    'title' => esc_html__('General Options', 'viral-mag'),
    'panel' => 'viral_mag_general_settings_panel'
));

$wp_customize->add_setting('viral_mag_website_layout', array(
    'default' => 'wide',
    'sanitize_callback' => 'viral_mag_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('viral_mag_website_layout', array(
    'section' => 'viral_mag_general_options_section',
    'type' => 'radio',
    'label' => esc_html__('Website Layout', 'viral-mag'),
    'description' => sprintf(esc_html__('If boxed is selected, change background color/image %s', 'viral-mag'), '<a href="javascript:wp.customize.section( \'background_image\' ).focus()">' . esc_html__('here', 'viral-mag') . '</a>'),
    'choices' => array(
        'wide' => esc_html__('Wide', 'viral-mag'),
        'boxed' => esc_html__('Boxed', 'viral-mag')
    )
));

$wp_customize->add_setting('viral_mag_website_width', array(
    'sanitize_callback' => 'absint',
    'default' => 1170,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Range_Slider_Control($wp_customize, 'viral_mag_website_width', array(
    'section' => 'viral_mag_general_options_section',
    'label' => esc_html__('Website Container Width', 'viral-mag'),
    'input_attrs' => array(
        'min' => 900,
        'max' => 1400,
        'step' => 10
    )
)));

$wp_customize->add_setting('viral_mag_sidebar_width', array(
    'sanitize_callback' => 'absint',
    'default' => 30,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Range_Slider_Control($wp_customize, 'viral_mag_sidebar_width', array(
    'section' => 'viral_mag_general_options_section',
    'label' => esc_html__('Sidebar Width (%)', 'viral-mag'),
    'input_attrs' => array(
        'min' => 20,
        'max' => 50,
        'step' => 1
    )
)));

$wp_customize->add_setting('viral_mag_scroll_animation_seperator', array(
    'sanitize_callback' => 'viral_mag_sanitize_text'
));

$wp_customize->add_control(new Viral_Mag_Separator_Control($wp_customize, 'viral_mag_scroll_animation_seperator', array(
    'section' => 'viral_mag_general_options_section'
)));

$wp_customize->add_setting('viral_mag_show_title', array(
    'sanitize_callback' => 'viral_mag_sanitize_checkbox',
    'default' => true
));

$wp_customize->add_control(new Viral_Mag_Toggle_Control($wp_customize, 'viral_mag_show_title', array(
    'section' => 'viral_mag_general_options_section',
    'label' => esc_html__('Page Title', 'viral-mag'),
    'description' => esc_html__('It is the title of the page that appears below the menu', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_breadcrumb', array(
    'sanitize_callback' => 'viral_mag_sanitize_checkbox',
    'default' => true
));

$wp_customize->add_control(new Viral_Mag_Toggle_Control($wp_customize, 'viral_mag_breadcrumb', array(
    'section' => 'viral_mag_general_options_section',
    'label' => esc_html__('BreadCrumb', 'viral-mag'),
    'description' => esc_html__('Breadcrumbs are a great way of letting your visitors find out where they are on your site.', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_backtotop', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Mag_Toggle_Control($wp_customize, 'viral_mag_backtotop', array(
    'section' => 'viral_mag_general_options_section',
    'label' => esc_html__('Back to Top Button', 'viral-mag'),
    'description' => esc_html__('A button on click scrolls to the top of the page.', 'viral-mag')
)));