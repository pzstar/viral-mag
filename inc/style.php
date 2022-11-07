<?php

/**
 * @package Viral Mag
 */
function viral_mag_dymanic_styles() {
    $custom_css = $tablet_css = $mobile_css = "";
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

    $viral_mag_logo_actual_height = get_theme_mod('viral_mag_logo_height', 60);
    $viral_mag_logo_padding = get_theme_mod('viral_mag_logo_padding', 15);

    $viral_mag_mh_header_bg_url = get_theme_mod('viral_mag_mh_header_bg_url');
    $viral_mag_mh_header_bg_repeat = get_theme_mod('viral_mag_mh_header_bg_repeat', 'no-repeat');
    $viral_mag_mh_header_bg_size = get_theme_mod('viral_mag_mh_header_bg_size', 'cover');
    $viral_mag_mh_header_bg_position = get_theme_mod('viral_mag_mh_header_bg_position', 'center-center');
    $viral_mag_mh_header_bg_position = str_replace('-', ' ', $viral_mag_mh_header_bg_position);
    $viral_mag_mh_header_bg_attach = get_theme_mod('viral_mag_mh_header_bg_attach', 'scroll');

    $viral_mag_mh_button_color = get_theme_mod('viral_mag_mh_button_color', '#000000');
    $viral_mag_mh_bg_color = get_theme_mod('viral_mag_mh_bg_color', '#cf0701');
    $viral_mag_mh_bg_color_mobile = get_theme_mod('viral_mag_mh_bg_color_mobile', '#cf0701');
    $viral_mag_mh_border_color = get_theme_mod('viral_mag_mh_border_color', '#EEEEEE');

    $viral_mag_mh_menu_color = get_theme_mod('viral_mag_mh_menu_color', '#FFFFFF');
    $viral_mag_mh_menu_hover_color = get_theme_mod('viral_mag_mh_menu_hover_color', '#FFFFFF');
    $viral_mag_mh_submenu_bg_color = get_theme_mod('viral_mag_mh_submenu_bg_color', '#F2F2F2');
    $viral_mag_mh_submenu_color = get_theme_mod('viral_mag_mh_submenu_color', '#333333');
    $viral_mag_mh_submenu_hover_color = get_theme_mod('viral_mag_mh_submenu_hover_color', '#333333');
    $viral_mag_menu_dropdown_padding = get_theme_mod('viral_mag_menu_dropdown_padding', 0);

    $viral_mag_responsive_width = get_theme_mod('viral_mag_responsive_width', 780);

    $container_width = 1170;
    $custom_css = ":root {";
    $custom_css .= "--vm-template-color: {$color};";
    $custom_css .= "--vm-template-dark-color: {$darker_color};";
    $custom_css .= "--vm-wide-container-width: {$wide_container_width}px;";
    $custom_css .= "--vm-fluid-container-width: {$fluid_container_width}%;";
    $custom_css .= "--vm-container-padding: {$container_padding}px;";
    $custom_css .= "--vm-primary-width: {$primary_width}%;";
    $custom_css .= "--vm-secondary-width: {$sidebar_width}%;";
    $custom_css .= "--vm-responsive-width: {$viral_mag_responsive_width}px;";
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
    $custom_css .= "--vm-logo-height: {$viral_mag_logo_actual_height}px;";
    $custom_css .= "--vm-logo-padding: {$viral_mag_logo_padding}px;";
    $custom_css .= "--vm-mh-header-bg-url: url({$viral_mag_mh_header_bg_url});";
    $custom_css .= "--vm-mh-header-bg-repeat: {$viral_mag_mh_header_bg_repeat};";
    $custom_css .= "--vm-mh-header-bg-size: {$viral_mag_mh_header_bg_size};";
    $custom_css .= "--vm-mh-header-bg-position: {$viral_mag_mh_header_bg_position};";
    $custom_css .= "--vm-mh-header-bg-attach: {$viral_mag_mh_header_bg_attach};";
    $custom_css .= "--vm-mh-button-color: {$viral_mag_mh_button_color};";
    $custom_css .= "--vm-mh-bg-color: {$viral_mag_mh_bg_color};";
    $custom_css .= "--vm-mh-bg-color-mobile: {$viral_mag_mh_bg_color_mobile};";
    $custom_css .= "--vm-mh-bg-border-color: {$viral_mag_mh_border_color};";
    $custom_css .= "--vm-mh-menu-color: {$viral_mag_mh_menu_color};";
    $custom_css .= "--vm-mh-menu-hover-color: {$viral_mag_mh_menu_hover_color};";
    $custom_css .= "--vm-mh-submenu-bg-color: {$viral_mag_mh_submenu_bg_color};";
    $custom_css .= "--vm-mh-submenu-color: {$viral_mag_mh_submenu_color};";
    $custom_css .= "--vm-mh-submenu-hover-color: {$viral_mag_mh_submenu_hover_color};";
    $custom_css .= "--vm-mh-menu-dropdown-padding: {$viral_mag_menu_dropdown_padding}px;";
    $custom_css .= "}";

    if ($th_bottom_border_color) {
        $custom_css .= "
            .vm-site-header .vm-top-header{
                border-bottom: 1px solid $th_bottom_border_color;
            }";
    }


    /* =============== Typography CSS =============== */

    $custom_css .= viral_mag_typography_css('viral_mag_menu', '.vm-menu > ul > li > a, a.vm-header-bttn', array(
        'family' => 'Poppins',
        'style' => '400',
        'text_transform' => 'uppercase',
        'text_decoration' => 'none',
        'size' => '14',
        'line_height' => '2.6',
        'letter_spacing' => '0'
    ));

    $i_font_size = get_theme_mod('menu_font_size', '14');
    $i_font_family = get_theme_mod('menu_font_family', 'Poppins');
    $custom_css .= ".vm-menu ul ul{
            font-size: {$i_font_size}px;
            font-family: {$i_font_family};
    }";


    $custom_css .= "
	.vm-main-navigation,
        .menu-item-megamenu .widget-title,
        .menu-item-megamenu.vm-block-title span.vm-title{
        font-size: {$i_font_size}px;
        font-family: $i_font_family;
	}
        
        .single-vm-megamenu .vm-main-content{
        font-family: $i_font_family;
        }
	";




    /* =============== Page Title =============== */
    $custom_css .= viral_mag_typography_css('viral_mag_page_title', '.vm-main-title, .single-post .entry-title', array(
        'family' => 'Poppins',
        'style' => '400',
        'text_transform' => 'none',
        'text_decoration' => 'none',
        'size' => '40',
        'line_height' => '1.3',
        'letter_spacing' => '0',
    ));


    $viral_mag_content_widget_title_color = get_theme_mod('viral_mag_content_widget_title_color', '#000000');

    $custom_css .= ".vm-main-content .widget-title{color:$viral_mag_content_widget_title_color}";
    $custom_css .= ".vm-sidebar-style1 .vm-site-wrapper .widget-title:after, .vm-sidebar-style3 .vm-site-wrapper .widget-title:after, .vm-sidebar-style6 .vm-site-wrapper .widget-title:after, .vm-sidebar-style7 .vm-site-wrapper .widget:before {background-color:$viral_mag_content_widget_title_color}";

    /* =============== Header CSS =============== */


    $viral_mag_mh_height = get_theme_mod('viral_mag_mh_height', 65);
    $viral_mag_mh_half_height = $viral_mag_mh_height / 2;



    $viral_mag_logo_height = $viral_mag_mh_height - 30;
    $viral_mag_header6_height = $th_height + $viral_mag_mh_half_height;
    $viral_mag_header6_single_bottom_margin = 40 - $viral_mag_mh_half_height;
    $viral_mag_logo_min_height = min($viral_mag_logo_height, $viral_mag_logo_actual_height);



    $custom_css .= "
        
        .vm-top-header-on .vm-header-six.vm-site-header{
            margin-bottom: -{$viral_mag_mh_half_height}px;
        }
        
        .vm-top-header-on.vm-single-layout1 .vm-header-six.vm-site-header,
        .vm-top-header-on.vm-single-layout2 .vm-header-six.vm-site-header,
        .vm-top-header-on.vm-single-layout7 .vm-header-six.vm-site-header{
            margin-bottom: {$viral_mag_header6_single_bottom_margin}px;
        }
        
        .vm-top-header-on.vm-single-layout3 .vm-header-six.vm-site-header,
        .vm-top-header-on.vm-single-layout4 .vm-header-six.vm-site-header,
        .vm-top-header-on.vm-single-layout5 .vm-header-six.vm-site-header,
        .vm-top-header-on.vm-single-layout6 .vm-header-six.vm-site-header{
            margin-bottom: -{$viral_mag_mh_height}px;
        }
        
        .vm-header-six.vm-site-header .vm-top-header{
            height: {$viral_mag_header6_height}px;
        }

        
        .vm-sticky-header .vm-header-four .vm-header.headroom.headroom--not-top .vm-container,
        .vm-sticky-header .vm-header-six .vm-header.headroom.headroom--not-top .vm-container{
            background: none;
        }

        .hover-style5 .vm-menu > ul > li.menu-item > a,
        .hover-style6 .vm-menu > ul > li.menu-item > a,
        .hover-style5 .vm-header-bttn,
        .hover-style6 .vm-header-bttn{
            line-height: {$viral_mag_mh_height}px;
        }
        
    ";

    /* =============== Block Title Style =============== */
    $viral_mag_block_title_color = get_theme_mod('viral_mag_block_title_color', '#333333');
    $viral_mag_block_title_background_color = get_theme_mod('viral_mag_block_title_background_color', '#cf0701');
    $viral_mag_block_title_border_color = get_theme_mod('viral_mag_block_title_border_color', '#333333');

    $custom_css .= "
       .vm-block-title span.vm-title{color:$viral_mag_block_title_color}
        .vm-block-title-style2.vm-block-title:after, .vm-block-title-style5.vm-block-title span.vm-title:before, .vm-block-title-style7.vm-block-title span.vm-title, .vm-block-title-style8.vm-block-title span.vm-title, .vm-block-title-style9.vm-block-title span.vm-title, .vm-block-title-style9.vm-block-title span.vm-title:before, .vm-block-title-style10.vm-block-title, .vm-block-title-style11.vm-block-title span.vm-title, .vm-block-title-style12.vm-block-title{background-color:$viral_mag_block_title_background_color}
        .vm-block-title-style8.vm-block-title, .vm-block-title-style9.vm-block-title, .vm-block-title-style11.vm-block-title{border-color:$viral_mag_block_title_background_color}
        .vm-block-title-style10.vm-block-title:before{border-color: $viral_mag_block_title_background_color $viral_mag_block_title_background_color transparent transparent}
    ";
    $custom_css .= "
        .vm-block-title-style2.vm-block-title, .vm-block-title-style3.vm-block-title, .vm-block-title-style5.vm-block-title{border-color:$viral_mag_block_title_border_color}
        .vm-block-title-style4.vm-block-title:after, .vm-block-title-style6.vm-block-title:before, .vm-block-title-style6.vm-block-title:after, .vm-block-title-style7.vm-block-title:after{background-color:$viral_mag_block_title_border_color}
    ";


    /* =============== Footer Settings =============== */
    $viral_mag_footer_bg_url = get_theme_mod('viral_mag_footer_bg_url');
    $viral_mag_footer_bg_repeat = get_theme_mod('viral_mag_footer_bg_repeat', 'no-repeat');
    $viral_mag_footer_bg_size = get_theme_mod('viral_mag_footer_bg_size', 'cover');
    $viral_mag_footer_bg_position = get_theme_mod('viral_mag_footer_bg_position', 'center-center');
    $viral_mag_footer_bg_position = str_replace('-', ' ', $viral_mag_footer_bg_position);
    $viral_mag_footer_bg_attach = get_theme_mod('viral_mag_footer_bg_attach', 'scroll');
    $viral_mag_footer_bg_color = get_theme_mod('viral_mag_footer_bg_color', '#333333');
    $viral_mag_footer_title_color = get_theme_mod('viral_mag_footer_title_color', '#EEEEEE');
    $viral_mag_footer_title_light_color = viral_mag_hex2rgba($viral_mag_footer_title_color, 0.1);
    $viral_mag_footer_text_color = get_theme_mod('viral_mag_footer_text_color', '#EEEEEE');
    $viral_mag_footer_anchor_color = get_theme_mod('viral_mag_footer_anchor_color', '#EEEEEE');
    $viral_mag_footer_border_color = get_theme_mod('viral_mag_footer_border_color', '#444444');


    $custom_css .= "
         #vm-colophon{
            background-image:url($viral_mag_footer_bg_url);
            background-repeat: $viral_mag_footer_bg_repeat;
            background-size: $viral_mag_footer_bg_size;
            background-position: $viral_mag_footer_bg_position;
            background-attachment: $viral_mag_footer_bg_attach;
        }
        
        .vm-site-footer:before{
                background-color: $viral_mag_footer_bg_color;
        }
        
         #vm-colophon .widget-title{
                color: $viral_mag_footer_title_color;
        }
        
        .vm-sidebar-style1 .vm-site-footer .widget-title:after,
        .vm-sidebar-style3 .vm-site-footer .widget-title:after,
        .vm-sidebar-style6 .vm-site-footer .widget-title:after{
            background: $viral_mag_footer_title_color;
        }
        
        .vm-sidebar-style2 .vm-site-footer .widget-title,
        .vm-sidebar-style7 .vm-site-footer .widget-title{
            border-color: $viral_mag_footer_title_light_color;
        }
        
        .vm-sidebar-style5 .vm-site-footer .widget-title:before,
        .vm-sidebar-style5 .vm-site-footer .widget-title:after{
            background-color: $viral_mag_footer_title_light_color;
        }

        .vm-site-footer *{
                color: $viral_mag_footer_text_color;
        }

        .vm-site-footer a,
        .vm-site-footer a *{
                color: $viral_mag_footer_anchor_color;
        }
        
        .vm-top-footer .vm-container,
        .vm-main-footer .vm-container,
        .vm-bottom-top-footer .vm-container{
            border-color: $viral_mag_footer_border_color;
        }";

    /* =============== Responsive CSS =============== */
    $custom_css .= "@media screen and (max-width: {$viral_mag_responsive_width}px){
            .vm-menu{
                display: none;
            }

             #vm-mobile-menu{
                display: block;
            }
            
            .vm-header-two .vm-header, 
            .vm-header-three .vm-header{
                background: var(--vm-mh-bg-color-mobile);
            }
            
            .vm-header-two .vm-header .vm-container {
                padding: 15px 0;
                justify-content: flex-end;
            }
            
            .vm-header-six.vm-site-header .vm-top-header {
                height: auto !important;
            }
            .vm-top-header-on .vm-header-six .vm-header {
                -webkit-transform: translateY(0) !important;
                transform: translateY(0) !important;
            }
            .vm-header-six.vm-site-header {
                margin-bottom: 0 !important;
            }
            .vm-top-header-on.vm-single-layout1 .vm-header-six.vm-site-header, 
            .vm-top-header-on.vm-single-layout2 .vm-header-six.vm-site-header, 
            .vm-top-header-on.vm-single-layout5 .vm-header-six.vm-site-header,
            .vm-top-header-on.vm-single-layout6 .vm-header-six.vm-site-header,
            .vm-top-header-on.vm-single-layout7 .vm-header-six.vm-site-header{
                margin-bottom: 40px !important;
            }
            
            .megamenu-full-width.megamenu-category .cat-megamenu-content-full,
            .megamenu-full-width.megamenu-category .cat-megamenu-tab,
            .megamenu-full-width.megamenu-category .cat-megamenu-content{
                display: none;
            }
            
            .megamenu-full-width.megamenu-category .cat-megamenu-tab > div{
                padding: 15px 40px;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            }
            
            .megamenu-full-width.megamenu-category .cat-megamenu-tab > div:after{
                display: none;
            }
            
            .megamenu-full-width.megamenu-category .cat-megamenu-content-full ul li{
                width: 100%;
                float: none;
                margin: 0;
            }
            
            .megamenu-full-width.megamenu-category .cat-megamenu-content-full ul li > a{
                display:none;
            }
            
             #vm-responsive-menu li.menu-item.megamenu-category > a > .dropdown-nav{
                display:none;
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
            
            .vm-sticky-header .vm-header-four .vm-header.headroom.headroom--not-top .vm-container{
                margin-bottom: 38px !important;
            }
            
            .vm-top-header-on.vm-sticky-header .vm-header-six .vm-header.headroom.headroom--not-top {
                -webkit-transform: translateY(-50%);
                transform: translateY(-50%);
            }
            
            .vm-header-one  #vm-site-branding img,
            .vm-header-three  #vm-site-branding img,
            .vm-header-six  #vm-site-branding img{
                height: auto;
                max-height: {$viral_mag_logo_min_height}px;
            }
                    
            .vm-header-two  #vm-site-branding img, 
            .vm-header-four  #vm-site-branding img, 
            .vm-header-five  #vm-site-branding img, 
            .vm-header-seven  #vm-site-branding img{
                height: auto;
                max-height: {$viral_mag_logo_actual_height}px;
            }
            
        }

        @media screen and (max-width: {$container_width}px){        
            .elementor-section.elementor-section-boxed>.elementor-container,            
            .vm-container{
                padding-left: 5% !important;
                padding-right: 5% !important;
            }
        }";

    /* =============== Category Color =============== */
    $viral_mag_cat = viral_mag_category_list();
    foreach ($viral_mag_cat as $cat_id => $cat_name) {
        $viral_mag_cat_color = get_theme_mod("viral_mag_category_{$cat_id}_color");
        if ($viral_mag_cat_color) {
            $custom_css .= ".post-categories li a.he-category-{$cat_id},.he-primary-cat-block .he-category-{$cat_id}{
            background: $viral_mag_cat_color;
            }";
        }
    }

    /* =============== Mobile Menu Button =============== */
    $viral_mag_toggle_button_color = get_theme_mod('viral_mag_toggle_button_color', '#FFFFFF');

    $custom_css .= ".collapse-button{border-color:{$viral_mag_toggle_button_color}}";
    $custom_css .= ".collapse-button .icon-bar{background:{$viral_mag_toggle_button_color}}";


    $custom_css .= "@media screen and (max-width:768px){{$tablet_css}}";
    $custom_css .= "@media screen and (max-width:480px){{$mobile_css}}";

    return wp_strip_all_tags(viral_mag_css_strip_whitespace($custom_css));
}
