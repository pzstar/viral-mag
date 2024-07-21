<?php

/**
 * Viral Mag Theme Customizer
 *
 * @package Viral Mag
 */
//SOCIAL SETTINGS
$wp_customize->add_section('viral_mag_social_section', array(
    'title' => esc_html__('Social Links', 'viral-mag')
));

$wp_customize->add_setting('viral_mag_social_icons', array(
    'sanitize_callback' => 'viral_mag_sanitize_repeater',
    'default' => json_encode(array(
        array(
            'icon' => 'icofont-facebook',
            'link' => '#',
            'enable' => 'yes'
        ),
        array(
            'icon' => 'icofont-twitter',
            'link' => '#',
            'enable' => 'yes'
        ),
        array(
            'icon' => 'icofont-instagram',
            'link' => '#',
            'enable' => 'yes'
        ),
        array(
            'icon' => 'icofont-youtube',
            'link' => '#',
            'enable' => 'yes'
        )
    ))
));

$wp_customize->add_control(new Viral_Mag_Repeater_Control($wp_customize, 'viral_mag_social_icons', array(
    'label' => esc_html__('Add Social Link', 'viral-mag'),
    'section' => 'viral_mag_social_section',
    'box_label' => esc_html__('Social Links', 'viral-mag'),
    'add_label' => esc_html__('Add New', 'viral-mag'),
), array(
    'icon' => array(
        'type' => 'icon',
        'label' => esc_html__('Select Icon', 'viral-mag'),
        'default' => 'icofont-facebook'
    ),
    'link' => array(
        'type' => 'text',
        'label' => esc_html__('Add Link', 'viral-mag'),
        'default' => ''
    ),
    'enable' => array(
        'type' => 'toggle',
        'label' => esc_html__('Enable', 'viral-mag'),
        'default' => 'yes'
    )
)));
