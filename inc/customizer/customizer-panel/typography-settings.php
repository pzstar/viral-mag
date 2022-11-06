<?php

// Add the typography panel.
$wp_customize->add_panel('viral_mag_typography_settings_panel', array(
    'priority' => 5,
    'title' => esc_html__('Typography Settings', 'viral-mag')
));

// Add the body typography section.
$wp_customize->add_section('viral_mag_body_typography', array(
    'panel' => 'viral_mag_typography_settings_panel',
    'title' => esc_html__('Body', 'viral-mag')
));

$wp_customize->add_setting('viral_mag_body_family', array(
    'default' => 'Poppins',
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_setting('viral_mag_body_style', array(
    'default' => '400',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_body_text_decoration', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_body_text_transform', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_body_size', array(
    'default' => '15',
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_body_line_height', array(
    'default' => '1.6',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_body_letter_spacing', array(
    'default' => '0',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_body_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Typography_Control($wp_customize, 'viral_mag_body_typography', array(
    'label' => esc_html__('Body Typography', 'viral-mag'),
    'description' => __('Select how you want your body to appear.', 'viral-mag'),
    'section' => 'viral_mag_body_typography',
    'settings' => array(
        'family' => 'viral_mag_body_family',
        'style' => 'viral_mag_body_style',
        'text_decoration' => 'viral_mag_body_text_decoration',
        'text_transform' => 'viral_mag_body_text_transform',
        'size' => 'viral_mag_body_size',
        'line_height' => 'viral_mag_body_line_height',
        'letter_spacing' => 'viral_mag_body_letter_spacing',
        'typocolor' => 'viral_mag_body_color'
    ),
    'input_attrs' => array(
        'min' => 10,
        'max' => 40,
        'step' => 1
    )
)));

// Add H1 typography section.
$wp_customize->add_section('viral_mag_header_typography', array(
    'panel' => 'viral_mag_typography_settings_panel',
    'title' => esc_html__('Headers(H1, H2, H3, H4, H5, H6)', 'viral-mag')
));

$wp_customize->add_setting('viral_mag_common_header_typography', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Mag_Toggle_Control($wp_customize, 'viral_mag_common_header_typography', array(
    'section' => 'viral_mag_header_typography',
    'label' => esc_html__('Use Common Typography for all Headers', 'viral-mag')
)));

// Add H typography section.
$wp_customize->add_setting('viral_mag_h_family', array(
    'default' => 'Poppins',
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_setting('viral_mag_h_style', array(
    'default' => '400',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h_text_decoration', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h_text_transform', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h_line_height', array(
    'default' => '1.3',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h_letter_spacing', array(
    'default' => '0',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Typography_Control($wp_customize, 'viral_mag_h_typography', array(
    'label' => esc_html__('Header Typography', 'viral-mag'),
    'description' => __('Select how you want your Header to appear.', 'viral-mag'),
    'section' => 'viral_mag_header_typography',
    'settings' => array(
        'family' => 'viral_mag_h_family',
        'style' => 'viral_mag_h_style',
        'text_decoration' => 'viral_mag_h_text_decoration',
        'text_transform' => 'viral_mag_h_text_transform',
        'line_height' => 'viral_mag_h_line_height',
        'letter_spacing' => 'viral_mag_h_letter_spacing'
    ),
    'input_attrs' => array(
        'min' => 10,
        'max' => 100,
        'step' => 1
    )
)));

$wp_customize->add_setting('viral_mag_h_typography_seperator', array(
    'sanitize_callback' => 'viral_mag_sanitize_text'
));

$wp_customize->add_control(new Viral_Mag_Separator_Control($wp_customize, 'viral_mag_h_typography_seperator', array(
    'section' => 'viral_mag_header_typography'
)));

$wp_customize->add_setting('viral_mag_hh1_size', array(
    'sanitize_callback' => 'absint',
    'default' => 38,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Range_Slider_Control($wp_customize, 'viral_mag_hh1_size', array(
    'section' => 'viral_mag_header_typography',
    'label' => esc_html__('H1 Font Size', 'viral-mag'),
    'input_attrs' => array(
        'min' => 10,
        'max' => 100,
        'step' => 1
    )
)));

$wp_customize->add_setting('viral_mag_hh2_size', array(
    'sanitize_callback' => 'absint',
    'default' => 34,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Range_Slider_Control($wp_customize, 'viral_mag_hh2_size', array(
    'section' => 'viral_mag_header_typography',
    'label' => esc_html__('H2 Font Size', 'viral-mag'),
    'input_attrs' => array(
        'min' => 10,
        'max' => 100,
        'step' => 1
    )
)));

$wp_customize->add_setting('viral_mag_hh3_size', array(
    'sanitize_callback' => 'absint',
    'default' => 30,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Range_Slider_Control($wp_customize, 'viral_mag_hh3_size', array(
    'section' => 'viral_mag_header_typography',
    'label' => esc_html__('H3 Font Size', 'viral-mag'),
    'input_attrs' => array(
        'min' => 10,
        'max' => 100,
        'step' => 1
    )
)));

$wp_customize->add_setting('viral_mag_hh4_size', array(
    'sanitize_callback' => 'absint',
    'default' => 26,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Range_Slider_Control($wp_customize, 'viral_mag_hh4_size', array(
    'section' => 'viral_mag_header_typography',
    'label' => esc_html__('H4 Font Size', 'viral-mag'),
    'input_attrs' => array(
        'min' => 10,
        'max' => 100,
        'step' => 1
    )
)));

$wp_customize->add_setting('viral_mag_hh5_size', array(
    'sanitize_callback' => 'absint',
    'default' => 22,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Range_Slider_Control($wp_customize, 'viral_mag_hh5_size', array(
    'section' => 'viral_mag_header_typography',
    'label' => esc_html__('H5 Font Size', 'viral-mag'),
    'input_attrs' => array(
        'min' => 10,
        'max' => 100,
        'step' => 1
    )
)));

$wp_customize->add_setting('viral_mag_hh6_size', array(
    'sanitize_callback' => 'absint',
    'default' => 18,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Range_Slider_Control($wp_customize, 'viral_mag_hh6_size', array(
    'section' => 'viral_mag_header_typography',
    'label' => esc_html__('H6 Font Size', 'viral-mag'),
    'input_attrs' => array(
        'min' => 10,
        'max' => 100,
        'step' => 1
    )
)));

$wp_customize->add_setting('viral_mag_header_typography_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Viral_Mag_Tab_Control($wp_customize, 'viral_mag_header_typography_nav', array(
    'section' => 'viral_mag_header_typography',
    'buttons' => array(
        array(
            'name' => esc_html__('H1', 'viral-mag'),
            'fields' => array(
                'viral_mag_h1_typography_heading',
                'viral_mag_h1_typography',
            ),
            'active' => true
        ),
        array(
            'name' => esc_html__('H2', 'viral-mag'),
            'fields' => array(
                'viral_mag_h2_typography_heading',
                'viral_mag_h2_typography',
            )
        ),
        array(
            'name' => esc_html__('H3', 'viral-mag'),
            'fields' => array(
                'viral_mag_h3_typography_heading',
                'viral_mag_h3_typography',
            )
        ),
        array(
            'name' => esc_html__('H4', 'viral-mag'),
            'fields' => array(
                'viral_mag_h4_typography_heading',
                'viral_mag_h4_typography',
            )
        ),
        array(
            'name' => esc_html__('H5', 'viral-mag'),
            'fields' => array(
                'viral_mag_h5_typography_heading',
                'viral_mag_h5_typography',
            )
        ),
        array(
            'name' => esc_html__('H6', 'viral-mag'),
            'fields' => array(
                'viral_mag_h6_typography_heading',
                'viral_mag_h6_typography',
            )
        )
    ),
)));

// Add H1 typography section.
$wp_customize->add_setting('viral_mag_h1_family', array(
    'default' => 'Poppins',
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_setting('viral_mag_h1_style', array(
    'default' => '400',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h1_text_decoration', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h1_text_transform', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h1_size', array(
    'default' => '38',
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h1_line_height', array(
    'default' => '1.3',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h1_letter_spacing', array(
    'default' => '0',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Typography_Control($wp_customize, 'viral_mag_h1_typography', array(
    'label' => esc_html__('Header H1 Typography', 'viral-mag'),
    'description' => __('Select how you want your H1 to appear.', 'viral-mag'),
    'section' => 'viral_mag_header_typography',
    'settings' => array(
        'family' => 'viral_mag_h1_family',
        'style' => 'viral_mag_h1_style',
        'text_decoration' => 'viral_mag_h1_text_decoration',
        'text_transform' => 'viral_mag_h1_text_transform',
        'size' => 'viral_mag_h1_size',
        'line_height' => 'viral_mag_h1_line_height',
        'letter_spacing' => 'viral_mag_h1_letter_spacing'
    ),
    'input_attrs' => array(
        'min' => 10,
        'max' => 100,
        'step' => 1
    )
)));

// Add H2 typography section.
$wp_customize->add_setting('viral_mag_h2_family', array(
    'default' => 'Poppins',
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_setting('viral_mag_h2_style', array(
    'default' => '400',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h2_text_decoration', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h2_text_transform', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h2_size', array(
    'default' => '34',
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h2_line_height', array(
    'default' => '1.3',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h2_letter_spacing', array(
    'default' => '0',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Typography_Control($wp_customize, 'viral_mag_h2_typography', array(
    'label' => esc_html__('Header H2 Typography', 'viral-mag'),
    'description' => __('Select how you want your H2 to appear.', 'viral-mag'),
    'section' => 'viral_mag_header_typography',
    'settings' => array(
        'family' => 'viral_mag_h2_family',
        'style' => 'viral_mag_h2_style',
        'text_decoration' => 'viral_mag_h2_text_decoration',
        'text_transform' => 'viral_mag_h2_text_transform',
        'size' => 'viral_mag_h2_size',
        'line_height' => 'viral_mag_h2_line_height',
        'letter_spacing' => 'viral_mag_h2_letter_spacing'
    ),
    'input_attrs' => array(
        'min' => 10,
        'max' => 100,
        'step' => 1
    )
)));

// Add H3 typography section.
$wp_customize->add_setting('viral_mag_h3_family', array(
    'default' => 'Poppins',
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_setting('viral_mag_h3_style', array(
    'default' => '400',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h3_text_decoration', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h3_text_transform', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h3_size', array(
    'default' => '30',
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h3_line_height', array(
    'default' => '1.3',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h3_letter_spacing', array(
    'default' => '0',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Typography_Control($wp_customize, 'viral_mag_h3_typography', array(
    'label' => esc_html__('Header H3 Typography', 'viral-mag'),
    'description' => __('Select how you want your H3 to appear.', 'viral-mag'),
    'section' => 'viral_mag_header_typography',
    'settings' => array(
        'family' => 'viral_mag_h3_family',
        'style' => 'viral_mag_h3_style',
        'text_decoration' => 'viral_mag_h3_text_decoration',
        'text_transform' => 'viral_mag_h3_text_transform',
        'size' => 'viral_mag_h3_size',
        'line_height' => 'viral_mag_h3_line_height',
        'letter_spacing' => 'viral_mag_h3_letter_spacing'
    ),
    'input_attrs' => array(
        'min' => 10,
        'max' => 100,
        'step' => 1
    )
)));

// Add H4 typography section.
$wp_customize->add_setting('viral_mag_h4_family', array(
    'default' => 'Poppins',
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_setting('viral_mag_h4_style', array(
    'default' => '400',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h4_text_decoration', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h4_text_transform', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h4_size', array(
    'default' => '26',
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h4_line_height', array(
    'default' => '1.3',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h4_letter_spacing', array(
    'default' => '0',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Typography_Control($wp_customize, 'viral_mag_h4_typography', array(
    'label' => esc_html__('Header H4 Typography', 'viral-mag'),
    'description' => __('Select how you want your H4 to appear.', 'viral-mag'),
    'section' => 'viral_mag_header_typography',
    'settings' => array(
        'family' => 'viral_mag_h4_family',
        'style' => 'viral_mag_h4_style',
        'text_decoration' => 'viral_mag_h4_text_decoration',
        'text_transform' => 'viral_mag_h4_text_transform',
        'size' => 'viral_mag_h4_size',
        'line_height' => 'viral_mag_h4_line_height',
        'letter_spacing' => 'viral_mag_h4_letter_spacing'
    ),
    'input_attrs' => array(
        'min' => 10,
        'max' => 100,
        'step' => 1
    )
)));

// Add H5 typography section.
$wp_customize->add_setting('viral_mag_h5_family', array(
    'default' => 'Poppins',
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_setting('viral_mag_h5_style', array(
    'default' => '400',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h5_text_decoration', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h5_text_transform', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h5_size', array(
    'default' => '22',
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h5_line_height', array(
    'default' => '1.3',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h5_letter_spacing', array(
    'default' => '0',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Typography_Control($wp_customize, 'viral_mag_h5_typography', array(
    'label' => esc_html__('Header H5 Typography', 'viral-mag'),
    'description' => __('Select how you want your H6 to appear.', 'viral-mag'),
    'section' => 'viral_mag_header_typography',
    'settings' => array(
        'family' => 'viral_mag_h5_family',
        'style' => 'viral_mag_h5_style',
        'text_decoration' => 'viral_mag_h5_text_decoration',
        'text_transform' => 'viral_mag_h5_text_transform',
        'size' => 'viral_mag_h5_size',
        'line_height' => 'viral_mag_h5_line_height',
        'letter_spacing' => 'viral_mag_h5_letter_spacing'
    ),
    'input_attrs' => array(
        'min' => 10,
        'max' => 100,
        'step' => 1
    )
)));

// Add H6 typography section.
$wp_customize->add_setting('viral_mag_h6_family', array(
    'default' => 'Poppins',
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_setting('viral_mag_h6_style', array(
    'default' => '400',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h6_text_decoration', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h6_text_transform', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h6_size', array(
    'default' => '18',
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h6_line_height', array(
    'default' => '1.3',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_h6_letter_spacing', array(
    'default' => '0',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Typography_Control($wp_customize, 'viral_mag_h6_typography', array(
    'label' => esc_html__('Header H6 Typography', 'viral-mag'),
    'description' => __('Select how you want your H6 to appear.', 'viral-mag'),
    'section' => 'viral_mag_header_typography',
    'settings' => array(
        'family' => 'viral_mag_h6_family',
        'style' => 'viral_mag_h6_style',
        'text_decoration' => 'viral_mag_h6_text_decoration',
        'text_transform' => 'viral_mag_h6_text_transform',
        'size' => 'viral_mag_h6_size',
        'line_height' => 'viral_mag_h6_line_height',
        'letter_spacing' => 'viral_mag_h6_letter_spacing'
    ),
    'input_attrs' => array(
        'min' => 10,
        'max' => 100,
        'step' => 1
    )
)));

// Add the Frontpage Block Title typography section.
$wp_customize->add_section('viral_mag_frontpage_block_title_typography', array(
    'panel' => 'viral_mag_typography_settings_panel',
    'title' => esc_html__('Front Page Block Title', 'viral-mag')
));

$wp_customize->add_setting('viral_mag_frontpage_block_title_family', array(
    'default' => 'Poppins',
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_setting('viral_mag_frontpage_block_title_style', array(
    'default' => '500',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_frontpage_block_title_text_decoration', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_frontpage_block_title_text_transform', array(
    'default' => 'uppercase',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_frontpage_block_title_size', array(
    'default' => '20',
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_frontpage_block_title_line_height', array(
    'default' => '1.1',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_frontpage_block_title_letter_spacing', array(
    'default' => '0',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Typography_Control($wp_customize, 'viral_mag_frontpage_block_title_typography', array(
    'label' => esc_html__('Front Page Block Title Typography', 'viral-mag'),
    'description' => __('Select how you want your frontpage block title to appear.', 'viral-mag'),
    'section' => 'viral_mag_frontpage_block_title_typography',
    'settings' => array(
        'family' => 'viral_mag_frontpage_block_title_family',
        'style' => 'viral_mag_frontpage_block_title_style',
        'text_decoration' => 'viral_mag_frontpage_block_title_text_decoration',
        'text_transform' => 'viral_mag_frontpage_block_title_text_transform',
        'size' => 'viral_mag_frontpage_block_title_size',
        'line_height' => 'viral_mag_frontpage_block_title_line_height',
        'letter_spacing' => 'viral_mag_frontpage_block_title_letter_spacing'
    ),
    'input_attrs' => array(
        'min' => 12,
        'max' => 100,
        'step' => 1
    )
)));


// Add the Frontpage Title typography section.
$wp_customize->add_section('viral_mag_frontpage_title_typography', array(
    'panel' => 'viral_mag_typography_settings_panel',
    'title' => esc_html__('Front Page Post Title', 'viral-mag')
));

$wp_customize->add_setting('viral_mag_frontpage_title_family', array(
    'default' => 'Poppins',
    'sanitize_callback' => 'sanitize_text_field'
));

$wp_customize->add_setting('viral_mag_frontpage_title_style', array(
    'default' => '500',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_frontpage_title_text_decoration', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_frontpage_title_text_transform', array(
    'default' => 'capitalize',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_frontpage_title_size', array(
    'default' => '16',
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_frontpage_title_line_height', array(
    'default' => '1.3',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_frontpage_title_letter_spacing', array(
    'default' => '0',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Typography_Control($wp_customize, 'viral_mag_frontpage_title_typography', array(
    'label' => esc_html__('Front Page Post Title Typography', 'viral-mag'),
    'description' => __('Select how you want your frontpage post title to appear.', 'viral-mag'),
    'section' => 'viral_mag_frontpage_title_typography',
    'settings' => array(
        'family' => 'viral_mag_frontpage_title_family',
        'style' => 'viral_mag_frontpage_title_style',
        'text_decoration' => 'viral_mag_frontpage_title_text_decoration',
        'text_transform' => 'viral_mag_frontpage_title_text_transform',
        'size' => 'viral_mag_frontpage_title_size',
        'line_height' => 'viral_mag_frontpage_title_line_height',
        'letter_spacing' => 'viral_mag_frontpage_title_letter_spacing'
    ),
    'input_attrs' => array(
        'min' => 12,
        'max' => 40,
        'step' => 1
    )
)));