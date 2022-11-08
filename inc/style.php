<?php

/**
 * @package Viral Mag
 */
function viral_mag_dymanic_styles() {
    $color = get_theme_mod('viral_mag_template_color', '#cf0701');
    $darker_color = viral_mag_color_brightness($color, -0.9);
    $sidebar_width = get_theme_mod('viral_mag_sidebar_width', 30);
    $primary_width = 100 - 4 - $sidebar_width;
    $wide_container_width = get_theme_mod('viral_mag_wide_container_width', 1170);
    $fluid_container_width = get_theme_mod('viral_mag_fluid_container_width', 80);
    $container_padding = get_theme_mod('viral_mag_container_padding', 80);
    $common_header_typography = get_theme_mod('viral_mag_common_header_typography', true);

    $hh1_size = get_theme_mod('viral_mag_hh1_size', 38);
    $hh2_size = get_theme_mod('viral_mag_hh2_size', 34);
    $hh3_size = get_theme_mod('viral_mag_hh3_size', 30);
    $hh4_size = get_theme_mod('viral_mag_hh4_size', 26);
    $hh5_size = get_theme_mod('viral_mag_hh5_size', 22);
    $hh6_size = get_theme_mod('viral_mag_hh6_size', 18);

    $content_header_color = get_theme_mod('viral_mag_content_header_color', '#000000');
    $content_text_color = get_theme_mod('viral_mag_content_text_color', '#333333');
    $content_link_color = get_theme_mod('viral_mag_content_link_color', '#000000');
    $content_link_hov_color = get_theme_mod('viral_mag_content_link_hov_color', '#cf0701');
    $content_light_color = viral_mag_hex2rgba($content_text_color, 0.1);
    $content_lighter_color = viral_mag_hex2rgba($content_text_color, 0.05);

    $title_color = get_theme_mod('viral_mag_title_color', '#333333');

    $th_bg_color = get_theme_mod('viral_mag_th_bg_color', '#cf0701');
    $th_bottom_border_color = get_theme_mod('viral_mag_th_bottom_border_color');
    $th_text_color = get_theme_mod('viral_mag_th_text_color', '#FFFFFF');
    $th_anchor_color = get_theme_mod('viral_mag_th_anchor_color', '#EEEEEE');
    $th_height = get_theme_mod('viral_mag_th_height', 45);

    $logo_actual_height = get_theme_mod('viral_mag_logo_height', 60);
    $logo_padding = get_theme_mod('viral_mag_logo_padding', 15);

    $mh_header_bg_url = get_theme_mod('viral_mag_mh_header_bg_url');
    $mh_header_bg_repeat = get_theme_mod('viral_mag_mh_header_bg_repeat', 'no-repeat');
    $mh_header_bg_size = get_theme_mod('viral_mag_mh_header_bg_size', 'cover');
    $mh_header_bg_position = get_theme_mod('viral_mag_mh_header_bg_position', 'center-center');
    $mh_header_bg_position = str_replace('-', ' ', $mh_header_bg_position);
    $mh_header_bg_attach = get_theme_mod('viral_mag_mh_header_bg_attach', 'scroll');

    $mh_button_color = get_theme_mod('viral_mag_mh_button_color', '#000000');
    $mh_bg_color = get_theme_mod('viral_mag_mh_bg_color', '#cf0701');
    $mh_bg_color_mobile = get_theme_mod('viral_mag_mh_bg_color_mobile', '#cf0701');
    $mh_border_color = get_theme_mod('viral_mag_mh_border_color', '#EEEEEE');

    $mh_menu_color = get_theme_mod('viral_mag_mh_menu_color', '#FFFFFF');
    $mh_menu_hover_color = get_theme_mod('viral_mag_mh_menu_hover_color', '#FFFFFF');
    $mh_submenu_bg_color = get_theme_mod('viral_mag_mh_submenu_bg_color', '#F2F2F2');
    $mh_submenu_color = get_theme_mod('viral_mag_mh_submenu_color', '#333333');
    $mh_submenu_hover_color = get_theme_mod('viral_mag_mh_submenu_hover_color', '#333333');
    $menu_dropdown_padding = get_theme_mod('viral_mag_menu_dropdown_padding', 0);

    $toggle_button_color = get_theme_mod('viral_mag_toggle_button_color', '#FFFFFF');

    $footer_bg_url = get_theme_mod('viral_mag_footer_bg_url');
    $footer_bg_repeat = get_theme_mod('viral_mag_footer_bg_repeat', 'no-repeat');
    $footer_bg_size = get_theme_mod('viral_mag_footer_bg_size', 'cover');
    $footer_bg_position = get_theme_mod('viral_mag_footer_bg_position', 'center-center');
    $footer_bg_position = str_replace('-', ' ', $footer_bg_position);
    $footer_bg_attach = get_theme_mod('viral_mag_footer_bg_attach', 'scroll');
    $footer_bg_color = get_theme_mod('viral_mag_footer_bg_color', '#333333');
    $footer_title_color = get_theme_mod('viral_mag_footer_title_color', '#EEEEEE');
    $footer_title_light_color = viral_mag_hex2rgba($footer_title_color, 0.1);
    $footer_text_color = get_theme_mod('viral_mag_footer_text_color', '#EEEEEE');
    $footer_anchor_color = get_theme_mod('viral_mag_footer_anchor_color', '#EEEEEE');
    $footer_border_color = get_theme_mod('viral_mag_footer_border_color', '#444444');
    $content_widget_title_color = get_theme_mod('viral_mag_content_widget_title_color', '#000000');

    $responsive_width = get_theme_mod('viral_mag_responsive_width', 780);

    $custom_css = ":root {";
    $custom_css .= "--vm-template-color: {$color};";
    $custom_css .= "--vm-template-dark-color: {$darker_color};";
    $custom_css .= "--vm-wide-container-width: {$wide_container_width}px;";
    $custom_css .= "--vm-fluid-container-width: {$fluid_container_width}%;";
    $custom_css .= "--vm-container-padding: {$container_padding}px;";
    $custom_css .= "--vm-primary-width: {$primary_width}%;";
    $custom_css .= "--vm-secondary-width: {$sidebar_width}%;";
    $custom_css .= "--vm-responsive-width: {$responsive_width}px;";
    if ($common_header_typography) {
        $custom_css .= "--vm-h1-size: {$hh1_size}px;";
        $custom_css .= "--vm-h2-size: {$hh2_size}px;";
        $custom_css .= "--vm-h3-size: {$hh3_size}px;";
        $custom_css .= "--vm-h4-size: {$hh4_size}px;";
        $custom_css .= "--vm-h5-size: {$hh5_size}px;";
        $custom_css .= "--vm-h6-size: {$hh6_size}px;";
        $custom_css .= viral_mag_typography_vars(array('viral_mag_h'));
    } else {
        $custom_css .= viral_mag_typography_vars(array('viral_mag_h1', 'viral_mag_h2', 'viral_mag_h3', 'viral_mag_h4', 'viral_mag_h5', 'viral_mag_h6'));
    }
    $custom_css .= viral_mag_typography_vars(array('viral_mag_body', 'viral_mag_frontpage_block_title', 'viral_mag_frontpage_title', 'viral_mag_sidebar_title', 'viral_mag_menu', 'viral_mag_page_title'));
    $custom_css .= "--vm-content-header-color: {$content_header_color};";
    $custom_css .= "--vm-content-text-color: {$content_text_color};";
    $custom_css .= "--vm-content-text-light-color: {$content_light_color};";
    $custom_css .= "--vm-content-text-lighter-color: {$content_lighter_color};";
    $custom_css .= "--vm-content-link-color: {$content_link_color};";
    $custom_css .= "--vm-content-link-hov-color: {$content_link_hov_color};";
    $custom_css .= "--vm-title-color: {$title_color};";
    $custom_css .= "--vm-th-height: {$th_height}px;";
    $custom_css .= "--vm-th-bg-color: {$th_bg_color};";
    $custom_css .= "--vm-th-text-color: {$th_text_color};";
    $custom_css .= "--vm-th-anchor-color: {$th_anchor_color};";
    $custom_css .= "--vm-logo-height: {$logo_actual_height}px;";
    $custom_css .= "--vm-logo-padding: {$logo_padding}px;";
    $custom_css .= "--vm-mh-header-bg-url: url({$mh_header_bg_url});";
    $custom_css .= "--vm-mh-header-bg-repeat: {$mh_header_bg_repeat};";
    $custom_css .= "--vm-mh-header-bg-size: {$mh_header_bg_size};";
    $custom_css .= "--vm-mh-header-bg-position: {$mh_header_bg_position};";
    $custom_css .= "--vm-mh-header-bg-attach: {$mh_header_bg_attach};";
    $custom_css .= "--vm-mh-button-color: {$mh_button_color};";
    $custom_css .= "--vm-mh-bg-color: {$mh_bg_color};";
    $custom_css .= "--vm-mh-bg-color-mobile: {$mh_bg_color_mobile};";
    $custom_css .= "--vm-mh-bg-border-color: {$mh_border_color};";
    $custom_css .= "--vm-mh-menu-color: {$mh_menu_color};";
    $custom_css .= "--vm-mh-menu-hover-color: {$mh_menu_hover_color};";
    $custom_css .= "--vm-mh-submenu-bg-color: {$mh_submenu_bg_color};";
    $custom_css .= "--vm-mh-submenu-color: {$mh_submenu_color};";
    $custom_css .= "--vm-mh-submenu-hover-color: {$mh_submenu_hover_color};";
    $custom_css .= "--vm-mh-menu-dropdown-padding: {$menu_dropdown_padding}px;";
    $custom_css .= "--vm-mh-toggle-button-color: {$toggle_button_color};";
    $custom_css .= "--vm-footer-bg-url: url({$footer_bg_url});";
    $custom_css .= "--vm-footer-bg-repeat: {$footer_bg_repeat};";
    $custom_css .= "--vm-footer-bg-size: {$footer_bg_size};";
    $custom_css .= "--vm-footer-bg-position: {$footer_bg_position};";
    $custom_css .= "--vm-footer-bg-attach: {$footer_bg_attach};";
    $custom_css .= "--vm-footer-bg-color: {$footer_bg_color};";
    $custom_css .= "--vm-footer-title-color: {$footer_title_color};";
    $custom_css .= "--vm-footer-title-light-color: {$footer_title_light_color};";
    $custom_css .= "--vm-footer-text-color: {$footer_text_color};";
    $custom_css .= "--vm-footer-anchor-color: {$footer_anchor_color};";
    $custom_css .= "--vm-footer-border-color: {$footer_border_color};";
    $custom_css .= "--vm-content-widget-title-color: {$content_widget_title_color};";
    $custom_css .= "}";

    if ($th_bottom_border_color) {
        $custom_css .= "
            .vm-site-header .vm-top-header{
                border-bottom: 1px solid $th_bottom_border_color;
            }";
    }

    /* =============== Responsive CSS =============== */
    $custom_css .= "@media screen and (max-width: {$responsive_width}px){
            .vm-menu{
                display: none;
            }
            #vm-mobile-menu{
                display: block;
            }
            .vm-header-two .vm-header, 
            .vm-header-three .vm-header{
                background: var(--vm-mh-bg-color-mobile);
                padding-top: 15px;
                padding-bottom: 15px;
            }
            .vm-header-two .vm-header .vm-container {
                justify-content: flex-end;
            }
            .vm-sticky-header .headroom.headroom--not-top{
                position: relative;
                top: auto !important;
                left: auto;
                right: auto;
                z-index: 9999;
                width: auto;
                box-shadow: none;
                -webkit-animation: none;
                animation: none;
            }
            
            .vm-header .vm-offcanvas-nav, 
            .vm-header .vm-search-button, 
            .vm-header .vm-header-social-icons{
                display: none;
            }
            #vm-content{
                padding-top: 0 !important;
            }
            .admin-bar.vm-sticky-header .headroom.headroom--not-top{
                top: auto;
            }
        }

        @media screen and (max-width: {$wide_container_width}px){        
            .elementor-section.elementor-section-boxed>.elementor-container,            
            .vm-wide .vm-container,
            .vm-boxed .vm-container{
                padding-left: 40px !important;
                padding-right: 40px !important;
            }
        }";

    /* =============== Category Color =============== */
    $cat = viral_mag_category_list();
    foreach ($cat as $cat_id => $cat_name) {
        $cat_color = get_theme_mod("viral_mag_category_{$cat_id}_color");
        if ($cat_color) {
            $custom_css .= ".he-post-categories li a.he-category-{$cat_id},.he-primary-cat-block .he-category-{$cat_id}{
            background: {$cat_color} !important;
            }";
        }
    }

    return wp_strip_all_tags(viral_mag_css_strip_whitespace($custom_css));
}
