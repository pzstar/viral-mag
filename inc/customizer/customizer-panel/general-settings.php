<?php

/**
 * Viral Mag Theme Customizer
 *
 * @package Viral Mag
 */
/* GENERAL SETTINGS PANEL */
$wp_customize->add_panel('viral_mag_general_settings_panel', array(
    'title' => esc_html__('General Settings', 'viral-mag'),
    'priority' => 4
));

//GENERAL SETTINGS
$wp_customize->add_section('viral_mag_general_options_section', array(
    'title' => esc_html__('General Options', 'viral-mag'),
    'panel' => 'viral_mag_general_settings_panel'
));

//MOVE BACKGROUND AND COLOR SETTING INTO GENERAL SETTING PANEL
$wp_customize->get_control('background_color')->section = 'viral_mag_general_options_section';
$wp_customize->get_control('background_image')->section = 'viral_mag_general_options_section';
$wp_customize->get_control('background_preset')->section = 'viral_mag_general_options_section';
$wp_customize->get_control('background_position')->section = 'viral_mag_general_options_section';
$wp_customize->get_control('background_size')->section = 'viral_mag_general_options_section';
$wp_customize->get_control('background_repeat')->section = 'viral_mag_general_options_section';
$wp_customize->get_control('background_attachment')->section = 'viral_mag_general_options_section';

$wp_customize->get_control('background_color')->priority = 20;
$wp_customize->get_control('background_image')->priority = 20;
$wp_customize->get_control('background_preset')->priority = 20;
$wp_customize->get_control('background_position')->priority = 20;
$wp_customize->get_control('background_size')->priority = 20;
$wp_customize->get_control('background_repeat')->priority = 20;
$wp_customize->get_control('background_attachment')->priority = 20;

$wp_customize->add_setting('viral_mag_website_layout', array(
    'default' => 'wide',
    'sanitize_callback' => 'viral_mag_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('viral_mag_website_layout', array(
    'section' => 'viral_mag_general_options_section',
    'type' => 'radio',
    'label' => esc_html__('Website Layout', 'viral-mag'),
    'choices' => array(
        'wide' => esc_html__('Wide', 'viral-mag'),
        'boxed' => esc_html__('Boxed', 'viral-mag'),
        'fluid' => esc_html__('Fluid', 'viral-mag')
    )
));

$wp_customize->add_setting('viral_mag_fluid_container_width', array(
    'sanitize_callback' => 'absint',
    'default' => 80,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Range_Slider_Control($wp_customize, 'viral_mag_fluid_container_width', array(
    'section' => 'viral_mag_general_options_section',
    'label' => esc_html__('Website Container Width (%)', 'viral-mag'),
    'input_attrs' => array(
        'min' => 20,
        'max' => 100,
        'step' => 1
    )
)));

$wp_customize->add_setting('viral_mag_wide_container_width', array(
    'sanitize_callback' => 'absint',
    'default' => 1170,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Range_Slider_Control($wp_customize, 'viral_mag_wide_container_width', array(
    'section' => 'viral_mag_general_options_section',
    'label' => esc_html__('Website Container Width (px)', 'viral-mag'),
    'input_attrs' => array(
        'min' => 900,
        'max' => 1800,
        'step' => 10
    )
)));

$wp_customize->add_setting('viral_mag_container_padding', array(
    'sanitize_callback' => 'absint',
    'default' => 80,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Range_Slider_Control($wp_customize, 'viral_mag_container_padding', array(
    'section' => 'viral_mag_general_options_section',
    'label' => esc_html__('Website Container Padding (px)', 'viral-mag'),
    'input_attrs' => array(
        'min' => 10,
        'max' => 200,
        'step' => 5
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

$wp_customize->add_setting('viral_mag_background_heading', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
));

$wp_customize->add_control(new Viral_Mag_Heading_Control($wp_customize, 'viral_mag_background_heading', array(
    'section' => 'viral_mag_general_options_section',
    'label' => esc_html__('Background', 'viral-mag'),
)));

$wp_customize->add_setting('viral_mag_general_options_upgrade_text', array(
    'sanitize_callback' => 'viral_mag_sanitize_text'
));

$wp_customize->add_control(new Viral_Mag_Upgrade_Info_Control($wp_customize, 'viral_mag_general_options_upgrade_text', array(
    'section' => 'viral_mag_general_options_section',
    'label' => esc_html__('For more options,', 'viral-mag'),
    'choices' => array(
        esc_html__('16+ animated preloaders', 'viral-mag'),
        esc_html__('Admin page custom logo', 'viral-mag')
    ),
    'priority' => 100,
    'active_callback' => 'viral_mag_is_upgrade_notice_active'
)));

/* BACK TO TOP SECTION */
$wp_customize->add_section('viral_mag_backtotop_section', array(
    'title' => esc_html__('Scroll Top', 'viral-mag'),
    'panel' => 'viral_mag_general_settings_panel',
));

$wp_customize->add_setting('viral_mag_backtotop', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Mag_Toggle_Control($wp_customize, 'viral_mag_backtotop', array(
    'section' => 'viral_mag_backtotop_section',
    'label' => esc_html__('Back to Top Button', 'viral-mag'),
    'description' => esc_html__('A button on click scrolls to the top of the page.', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_backtotop_upgrade_text', array(
    'sanitize_callback' => 'viral_mag_sanitize_text'
));

$wp_customize->add_control(new Viral_Mag_Upgrade_Info_Control($wp_customize, 'viral_mag_backtotop_upgrade_text', array(
    'section' => 'viral_mag_backtotop_section',
    'label' => esc_html__('For advanced settings,', 'viral-mag'),
    'priority' => 100,
    'active_callback' => 'viral_mag_is_upgrade_notice_active'
)));

/* GOOGLE FONT SECTION */
$wp_customize->add_section('viral_mag_google_font_section', array(
    'title' => esc_html__('Google Fonts', 'viral-mag'),
    'panel' => 'viral_mag_general_settings_panel',
    'priority' => 1000
));

$wp_customize->add_setting('viral_mag_load_google_font_locally', array(
    'sanitize_callback' => 'viral_mag_sanitize_checkbox',
    'default' => false
));

$wp_customize->add_control(new Viral_Mag_Toggle_Control($wp_customize, 'viral_mag_load_google_font_locally', array(
    'section' => 'viral_mag_google_font_section',
    'label' => esc_html__('Load Google Fonts Locally', 'viral-mag'),
    'description' => esc_html__('It is required to load the Google Fonts locally in order to comply with GDPR. However, if your website is not required to comply with Google Fonts then you can check this field off. Loading the Fonts locally with lots of different Google fonts can decrease the speed of the website slightly.', 'viral-mag'),
)));
