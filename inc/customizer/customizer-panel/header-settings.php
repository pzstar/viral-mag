<?php

/**
 * Viral Mag Theme Customizer
 *
 * @package Viral Mag
 */
/* HEADER PANEL */
$wp_customize->add_panel('viral_mag_header_settings_panel', array(
    'title' => esc_html__('Header Settings', 'viral-mag'),
    'priority' => 15
));

$wp_customize->get_section('title_tagline')->panel = 'viral_mag_header_settings_panel';
$wp_customize->get_section('title_tagline')->title = esc_html__('Logo & Favicon', 'viral-mag');

$wp_customize->add_setting('viral_mag_hide_title', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => false,
    'transport' => 'postMessage'
));

$wp_customize->add_control('viral_mag_hide_title', array(
    'type' => 'checkbox',
    'section' => 'title_tagline',
    'label' => esc_html__('Hide Site Title', 'viral-mag')
));

$wp_customize->add_setting('viral_mag_hide_tagline', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => false,
    'transport' => 'postMessage'
));

$wp_customize->add_control('viral_mag_hide_tagline', array(
    'type' => 'checkbox',
    'section' => 'title_tagline',
    'label' => esc_html__('Hide Site Tagline', 'viral-mag')
));

$wp_customize->add_setting('viral_mag_tagline_position', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => 'ht-tagline-inline-logo',
    'transport' => 'postMessage'
));

$wp_customize->add_control('viral_mag_tagline_position', array(
    'section' => 'title_tagline',
    'type' => 'select',
    'label' => esc_html__('Title/Tagline Position', 'viral-mag'),
    'choices' => array(
        'ht-tagline-inline-logo' => esc_html__('Inline With Logo', 'viral-mag'),
        'ht-tagline-below-logo' => esc_html__('Below Logo', 'viral-mag')
    )
));

$wp_customize->add_setting('viral_mag_title_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'viral_mag_title_color', array(
    'section' => 'title_tagline',
    'label' => esc_html__('Title/Tagline Color', 'viral-mag')
)));

$wp_customize->selective_refresh->add_partial('viral_mag_hide_title', array(
    'selector' => '#ht-site-branding',
    'render_callback' => 'viral_mag_header_logo'
));

$wp_customize->selective_refresh->add_partial('viral_mag_hide_tagline', array(
    'selector' => '#ht-site-branding',
    'render_callback' => 'viral_mag_header_logo'
));


//HEADER SETTINGS
$wp_customize->add_section('viral_mag_header_options', array(
    'title' => esc_html__('Header Options', 'viral-mag'),
    'panel' => 'viral_mag_header_settings_panel'
));

$wp_customize->add_setting('viral_mag_header_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Viral_Mag_Tab_Control($wp_customize, 'viral_mag_header_nav', array(
    
    'section' => 'viral_mag_header_options',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('Layouts', 'viral-mag'),
            'icon' => 'dashicons dashicons-welcome-write-blog',
            'fields' => array(
                'viral_mag_mh_layout',
                'viral_mag_header_position',
                'viral_mag_responsive_width',
                'viral_mag_header_layouts',
                'viral_mag_logo_height',
                'viral_mag_logo_padding',
                'viral_mag_mh_header_bg'
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Top Bar', 'viral-mag'),
            'icon' => 'dashicons dashicons-art',
            'fields' => array(
                'viral_mag_top_header',
                'viral_mag_th_bg_color',
                'viral_mag_th_bottom_border_color',
                'viral_mag_th_text_color',
                'viral_mag_th_anchor_color',
                'viral_mag_th_height',
                'viral_mag_th_disable_mobile',
                'viral_mag_top_header_options_heading',
                'viral_mag_th_left_display',
                'viral_mag_th_right_display',
                'viral_mag_top_header_seperator',
                'viral_mag_social_link',
                'viral_mag_th_menu',
                'viral_mag_th_widget',
                'viral_mag_th_text',
                'viral_mag_th_ticker_title',
                'viral_mag_th_ticker_category'
            ),
        ),
        array(
            'name' => esc_html__('Main Menu', 'viral-mag'),
            'icon' => 'dashicons dashicons-edit',
            'fields' => array(
                'viral_mag_sticky_header',
                'viral_mag_mh_bg_color',
                'viral_mag_mh_bg_color_mobile',
                'viral_mag_mh_height',
                'viral_mag_add_menu',
                'viral_mag_mh_button_color',
                'viral_mag_mh_border_sep_start',
                'viral_mag_mh_border',
                'viral_mag_mh_border_color',
                'viral_mag_mh_border_sep_end',
                'viral_mag_mh_show_search',
                'viral_mag_mh_show_cart',
                'viral_mag_mh_show_social',
                'viral_mag_mh_show_offcanvas',
                'viral_mag_menu_seperator',
                'viral_mag_mh_menu_color',
                'viral_mag_mh_menu_hover_color',
                'viral_mag_mh_menu_hover_bg_color',
                'viral_mag_submenu_seperator',
                'viral_mag_mh_submenu_bg_color',
                'viral_mag_mh_submenu_color',
                'viral_mag_mh_submenu_hover_color',
                'viral_mag_menuhover_seperator',
                'viral_mag_mh_menu_hover_style',
                'viral_mag_toggle_button_color',
                'viral_mag_menu_dropdown_padding'
            ),
        ),
    ),
)));

//HEADER LAYOUTS
$wp_customize->add_setting('viral_mag_mh_layout', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => 'header-style2'
));

$wp_customize->add_control(new Viral_Mag_Selector_Control($wp_customize, 'viral_mag_mh_layout', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('Header Layout', 'viral-mag'),
    'class' => 'viral-mag-full-width',
    'options' => array(
        'header-style2' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/headers/header-2.png',
        'header-style3' => VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/images/headers/header-3.png'
    )
)));

$wp_customize->add_setting('viral_mag_logo_height', array(
    'sanitize_callback' => 'absint',
    'default' => 60,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Range_Slider_Control($wp_customize, 'viral_mag_logo_height', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('Logo Height(px)', 'viral-mag'),
    'description' => esc_html__('The logo height will not increase beyond the header height. Increase the header height first. Logo will appear blur if the image size is small.', 'viral-mag'),
    'input_attrs' => array(
        'min' => 40,
        'max' => 200,
        'step' => 1
    )
)));

$wp_customize->add_setting('viral_mag_logo_padding', array(
    'sanitize_callback' => 'absint',
    'default' => 15,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Range_Slider_Control($wp_customize, 'viral_mag_logo_padding', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('Logo Top & Bottom Spacing(px)', 'viral-mag'),
    'input_attrs' => array(
        'min' => 0,
        'max' => 100,
        'step' => 1
    )
)));

$wp_customize->add_setting('viral_mag_mh_header_bg_url', array(
    'sanitize_callback' => 'esc_url_raw',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_mh_header_bg_id', array(
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_mh_header_bg_repeat', array(
    'default' => 'no-repeat',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_mh_header_bg_size', array(
    'default' => 'cover',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_mh_header_bg_position', array(
    'default' => 'center-center',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

$wp_customize->add_setting('viral_mag_mh_header_bg_attach', array(
    'default' => 'scroll',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));

// Registers example_background control
$wp_customize->add_control(new Viral_Mag_Background_Image_Control($wp_customize, 'viral_mag_mh_header_bg', array(
    'label' => esc_html__('Header Background', 'viral-mag'),
    'section' => 'viral_mag_header_options',
    'settings' => array(
        'image_url' => 'viral_mag_mh_header_bg_url',
        'image_id' => 'viral_mag_mh_header_bg_id',
        'repeat' => 'viral_mag_mh_header_bg_repeat', // Use false to hide the field
        'size' => 'viral_mag_mh_header_bg_size',
        'position' => 'viral_mag_mh_header_bg_position',
        'attach' => 'viral_mag_mh_header_bg_attach'
    )
)));

$wp_customize->add_setting('viral_mag_responsive_width', array(
    'sanitize_callback' => 'absint',
    'default' => 780
));

$wp_customize->add_control(new Viral_Mag_Range_Slider_Control($wp_customize, 'viral_mag_responsive_width', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('Enable Responsive Menu After(px)', 'viral-mag'),
    'description' => esc_html__('Set the value of the screen immediately after the menu item breaks into multiple line.', 'viral-mag'),
    'input_attrs' => array(
        'min' => 480,
        'max' => 1200,
        'step' => 10
    )
)));

//TOP HEADER SETTINGS
$wp_customize->add_setting('viral_mag_top_header', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => 'on'
));

$wp_customize->add_control(new Viral_Mag_Switch_Control($wp_customize, 'viral_mag_top_header', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('Enable Top Header', 'viral-mag'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'viral-mag'),
        'off' => esc_html__('No', 'viral-mag')
    )
)));

$wp_customize->add_setting('viral_mag_th_height', array(
    'sanitize_callback' => 'absint',
    'default' => 45,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Range_Slider_Control($wp_customize, 'viral_mag_th_height', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('Top Header Height', 'viral-mag'),
    'input_attrs' => array(
        'min' => 5,
        'max' => 100,
        'step' => 1
    )
)));

$wp_customize->add_setting('viral_mag_th_bg_color', array(
    'default' => '#cf0701',
    'sanitize_callback' => 'viral_mag_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Alpha_Color_Control($wp_customize, 'viral_mag_th_bg_color', array(
    'label' => esc_html__('Top Header Background', 'viral-mag'),
    'section' => 'viral_mag_header_options',
    'palette' => array(
        '#FFFFFF',
        '#000000',
        '#f5245f',
        '#1267b3',
        '#feb600',
        '#00C569',
        'rgba( 255, 255, 255, 0.2 )',
        'rgba( 0, 0, 0, 0.2 )'
    )
)));

$wp_customize->add_setting('viral_mag_th_bottom_border_color', array(
    'default' => '',
    'sanitize_callback' => 'viral_mag_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Alpha_Color_Control($wp_customize, 'viral_mag_th_bottom_border_color', array(
    'label' => esc_html__('Top Header Bottom Border Color', 'viral-mag'),
    'description' => esc_html__('Leave Empty to Hide Border', 'viral-mag'),
    'section' => 'viral_mag_header_options'
)));

$wp_customize->add_setting('viral_mag_th_text_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'viral_mag_th_text_color', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('Text Color', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_th_anchor_color', array(
    'default' => '#EEEEEE',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'viral_mag_th_anchor_color', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('Anchor(Link) Color', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_th_disable_mobile', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => false,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Toggle_Control($wp_customize, 'viral_mag_th_disable_mobile', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('Disable in Mobile', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_top_header_options_heading', array(
    'sanitize_callback' => 'viral_mag_sanitize_text'
));

$wp_customize->add_control(new Viral_Mag_Heading_Control($wp_customize, 'viral_mag_top_header_options_heading', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('Top Header Content', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_th_left_display', array(
    'default' => 'date',
    'sanitize_callback' => 'viral_mag_sanitize_choices',
));

$wp_customize->add_control('viral_mag_th_left_display', array(
    'section' => 'viral_mag_header_options',
    'type' => 'select',
    'label' => esc_html__('Display in Left Header', 'viral-mag'),
    'choices' => array(
        'social' => esc_html__('Social Icons', 'viral-mag'),
        'menu' => esc_html__('Menu', 'viral-mag'),
        'widget' => esc_html__('Widget', 'viral-mag'),
        'text' => esc_html__('HTML Text', 'viral-mag'),
        'date' => esc_html__('Date & Time', 'viral-mag'),
        'none' => esc_html__('None', 'viral-mag')
    )
));

$wp_customize->add_setting('viral_mag_th_right_display', array(
    'default' => 'social',
    'sanitize_callback' => 'viral_mag_sanitize_choices',
));

$wp_customize->add_control('viral_mag_th_right_display', array(
    'section' => 'viral_mag_header_options',
    'type' => 'select',
    'label' => esc_html__('Display in Right Header', 'viral-mag'),
    'choices' => array(
        'social' => esc_html__('Social Icons', 'viral-mag'),
        'menu' => esc_html__('Menu', 'viral-mag'),
        'widget' => esc_html__('Widget', 'viral-mag'),
        'text' => esc_html__('HTML Text', 'viral-mag'),
        'date' => esc_html__('Date & Time', 'viral-mag'),
        'none' => esc_html__('None', 'viral-mag')
    )
));

$wp_customize->add_setting('viral_mag_top_header_seperator', array(
    'sanitize_callback' => 'viral_mag_sanitize_text'
));

$wp_customize->add_control(new Viral_Mag_Separator_Control($wp_customize, 'viral_mag_top_header_seperator', array(
    'section' => 'viral_mag_header_options'
)));

$wp_customize->add_setting('viral_mag_social_link', array(
    'sanitize_callback' => 'viral_mag_sanitize_text'
));

$wp_customize->add_control(new Viral_Mag_Text_Info_Control($wp_customize, 'viral_mag_social_link', array(
    'label' => esc_html__('Social Icons', 'viral-mag'),
    'section' => 'viral_mag_header_options',
    'description' => sprintf(esc_html__('Add your %s here', 'viral-mag'), '<a href="#" target="_blank">Social Icons</a>')
)));

$wp_customize->add_setting('viral_mag_th_menu', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
));

$wp_customize->add_control('viral_mag_th_menu', array(
    'section' => 'viral_mag_header_options',
    'type' => 'select',
    'label' => esc_html__('Select Menu', 'viral-mag'),
    'choices' => viral_mag_menu_choice()
));

$wp_customize->add_setting('viral_mag_th_widget', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
));

$wp_customize->add_control('viral_mag_th_widget', array(
    'section' => 'viral_mag_header_options',
    'type' => 'select',
    'label' => esc_html__('Select Widget', 'viral-mag'),
    'choices' => viral_mag_widget_list()
));

$wp_customize->add_setting('viral_mag_th_text', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => 'California, TX 70240 | (1800) 456 7890',
));

$wp_customize->add_control(new Viral_Mag_Editor_Control($wp_customize, 'viral_mag_th_text', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('Html Text', 'viral-mag'),
    'include_admin_print_footer' => true
)));

//MAIN HEADER SETTINGS
$wp_customize->add_setting('viral_mag_add_menu', array(
    'sanitize_callback' => 'viral_mag_sanitize_text'
));

$wp_customize->add_control(new Viral_Mag_Text_Info_Control($wp_customize, 'viral_mag_add_menu', array(
    'section' => 'viral_mag_header_options',
    'description' => sprintf(esc_html__('Add %1$s and configure the below Settings. Set Menu Typography from %2$s.', 'viral-mag'), '<a href="' . admin_url() . '/nav-menus.php" target="_blank">Menu</a>', '<a href="#" id="menu_typography_link">Here</a>')
)));

$wp_customize->add_setting('viral_mag_sticky_header', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => 'off'
));

$wp_customize->add_control(new Viral_Mag_Switch_Control($wp_customize, 'viral_mag_sticky_header', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('Enable Sticky Header', 'viral-mag'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'viral-mag'),
        'off' => esc_html__('No', 'viral-mag')
    )
)));

$wp_customize->add_setting('viral_mag_mh_height', array(
    'sanitize_callback' => 'absint',
    'default' => 65,
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Range_Slider_Control($wp_customize, 'viral_mag_mh_height', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('Header Height', 'viral-mag'),
    'input_attrs' => array(
        'min' => 50,
        'max' => 200,
        'step' => 1
    )
)));

$wp_customize->add_setting('viral_mag_mh_show_search', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Mag_Toggle_Control($wp_customize, 'viral_mag_mh_show_search', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('Show Search Button', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_mh_show_cart', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => false
));

$wp_customize->add_control(new Viral_Mag_Toggle_Control($wp_customize, 'viral_mag_mh_show_cart', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('Show Cart Button', 'viral-mag'),
    'active_callback' => 'viral_mag_is_woocommerce_activated'
)));

$wp_customize->add_setting('viral_mag_mh_show_social', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => false,
));

$wp_customize->add_control(new Viral_Mag_Toggle_Control($wp_customize, 'viral_mag_mh_show_social', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('Show Social Icons', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_mh_show_offcanvas', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Mag_Toggle_Control($wp_customize, 'viral_mag_mh_show_offcanvas', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('Show Offcanvas Menu', 'viral-mag')
)));


$wp_customize->add_setting('viral_mag_mh_button_color', array(
    'default' => '#000000',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'viral_mag_mh_button_color', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('Buttons Color(Search, Social Icons, Offcanvas Menu)', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_menu_seperator', array(
    'sanitize_callback' => 'viral_mag_sanitize_text'
));

$wp_customize->add_control(new Viral_Mag_Separator_Control($wp_customize, 'viral_mag_menu_seperator', array(
    'section' => 'viral_mag_header_options'
)));

$wp_customize->add_setting('viral_mag_mh_bg_color', array(
    'default' => '#cf0701',
    'sanitize_callback' => 'viral_mag_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Alpha_Color_Control($wp_customize, 'viral_mag_mh_bg_color', array(
    'label' => esc_html__('Header Background Color', 'viral-mag'),
    'section' => 'viral_mag_header_options',
    'palette' => array(
        '#FFFFFF',
        '#000000',
        '#f5245f',
        '#1267b3',
        '#feb600',
        '#00C569',
        'rgba( 255, 255, 255, 0.2 )',
        'rgba( 0, 0, 0, 0.2 )'
    )
)));

$wp_customize->add_setting('viral_mag_mh_bg_color_mobile', array(
    'default' => '#cf0701',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'viral_mag_mh_bg_color_mobile', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('Header Bar Background Color(Mobile)', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_toggle_button_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'viral_mag_toggle_button_color', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('Mobile Menu Button Color', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_mh_border_sep_start', array(
    'sanitize_callback' => 'viral_mag_sanitize_text'
));

$wp_customize->add_control(new Viral_Mag_Separator_Control($wp_customize, 'viral_mag_mh_border_sep_start', array(
    'section' => 'viral_mag_header_options'
)));

$wp_customize->add_setting('viral_mag_mh_border', array(
    'default' => 'ht-no-border',
    'sanitize_callback' => 'viral_mag_sanitize_choices',
    'transport' => 'postMessage'
));

$wp_customize->add_control('viral_mag_mh_border', array(
    'section' => 'viral_mag_header_options',
    'type' => 'select',
    'label' => esc_html__('Top and Bottom Border Settings', 'viral-mag'),
    'choices' => array(
        'ht-no-border' => esc_html__('Disable', 'viral-mag'),
        'ht-top-border' => esc_html__('Enable Top Border', 'viral-mag'),
        'ht-bottom-border' => esc_html__('Enable Bottom Border', 'viral-mag'),
        'ht-top-bottom-border' => esc_html__('Enable Top & Bottom Border', 'viral-mag')
    )
));

$wp_customize->add_setting('viral_mag_mh_border_color', array(
    'default' => '#EEEEEE',
    'sanitize_callback' => 'viral_mag_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Alpha_Color_Control($wp_customize, 'viral_mag_mh_border_color', array(
    'label' => esc_html__('Border Color', 'viral-mag'),
    'section' => 'viral_mag_header_options'
)));

$wp_customize->add_setting('viral_mag_mh_border_sep_end', array(
    'sanitize_callback' => 'viral_mag_sanitize_text'
));

$wp_customize->add_control(new Viral_Mag_Separator_Control($wp_customize, 'viral_mag_mh_border_sep_end', array(
    'section' => 'viral_mag_header_options'
)));

$wp_customize->add_setting('viral_mag_mh_menu_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'viral_mag_mh_menu_color', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('Menu Link Color', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_mh_menu_hover_color', array(
    'default' => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'viral_mag_mh_menu_hover_color', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('Menu Link Color - Hover', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_mh_menu_hover_bg_color', array(
    'default' => '#cf0701',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'viral_mag_mh_menu_hover_bg_color', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('Menu Link Background Color - Hover', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_submenu_seperator', array(
    'sanitize_callback' => 'viral_mag_sanitize_text'
));

$wp_customize->add_control(new Viral_Mag_Separator_Control($wp_customize, 'viral_mag_submenu_seperator', array(
    'section' => 'viral_mag_header_options'
)));

$wp_customize->add_setting('viral_mag_mh_submenu_bg_color', array(
    'default' => '#F2F2F2',
    'sanitize_callback' => 'viral_mag_sanitize_color_alpha',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Alpha_Color_Control($wp_customize, 'viral_mag_mh_submenu_bg_color', array(
    'label' => esc_html__('SubMenu Background Color', 'viral-mag'),
    'section' => 'viral_mag_header_options',
    'palette' => array(
        '#FFFFFF',
        '#000000',
        '#f5245f',
        '#1267b3',
        '#feb600',
        '#00C569',
        'rgba( 255, 255, 255, 0.2 )',
        'rgba( 0, 0, 0, 0.2 )'
    )
)));

$wp_customize->add_setting('viral_mag_mh_submenu_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'viral_mag_mh_submenu_color', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('SubMenu Text/Link Color', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_mh_submenu_hover_color', array(
    'default' => '#333333',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'viral_mag_mh_submenu_hover_color', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('SubMenu Link Color - Hover', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_menu_dropdown_padding', array(
    'default' => 0,
    'sanitize_callback' => 'absint',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Range_Slider_Control($wp_customize, 'viral_mag_menu_dropdown_padding', array(
    'section' => 'viral_mag_header_options',
    'label' => esc_html__('Menu item Top/Bottom Padding', 'viral-mag'),
    'description' => esc_html__('(in px) Select appropriate number so that the submenu on hover appears just below the header bar.', 'viral-mag'),
    'input_attrs' => array(
        'min' => 0,
        'max' => 100,
        'step' => 1
    )
)));
