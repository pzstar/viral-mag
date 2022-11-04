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

    $hh1_size = get_theme_mod('viral_mag_hh1_size', 38);
    $hh2_size = get_theme_mod('viral_mag_hh2_size', 34);
    $hh3_size = get_theme_mod('viral_mag_hh3_size', 30);
    $hh4_size = get_theme_mod('viral_mag_hh4_size', 26);
    $hh5_size = get_theme_mod('viral_mag_hh5_size', 22);
    $hh6_size = get_theme_mod('viral_mag_hh6_size', 18);


    $viral_mag_responsive_width = get_theme_mod('viral_mag_responsive_width', 780);

    $container_width = 1170;
    $custom_css = ":root {";
    $custom_css .= "--vm-template-color: {$color};";
    $custom_css .= "--vm-wide-container-width: {$wide_container_width}px;";
    $custom_css .= "--vm-fluid-container-width: {$fluid_container_width}%;";
    $custom_css .= "--vm-container-padding: {$container_padding}px;";
    $custom_css .= "--vm-primary-width: {$primary_width}%;";
    $custom_css .= "--vm-secondary-width: {$sidebar_width}%;";
    $custom_css .= "--vm-h1-size: {$hh1_size}px;";
    $custom_css .= "--vm-h2-size: {$hh2_size}px;";
    $custom_css .= "--vm-h3-size: {$hh3_size}px;";
    $custom_css .= "--vm-h4-size: {$hh4_size}px;";
    $custom_css .= "--vm-h5-size: {$hh5_size}px;";
    $custom_css .= "--vm-h6-size: {$hh6_size}px;";
    $custom_css .= viral_mag_typography_vars(array('viral_mag_body', 'viral_mag_h', 'viral_mag_h1', 'viral_mag_h2', 'viral_mag_h3', 'viral_mag_h4', 'viral_mag_h5', 'viral_mag_h6', 'viral_mag_frontpage_block_title', 'viral_mag_frontpage_title', 'viral_mag_sidebar_title', 'viral_mag_menu', 'viral_mag_page_title'));
    $custom_css .= "}";


    /* =============== Site Title & Tagline Color =============== */
    $viral_mag_title_color = get_theme_mod('viral_mag_title_color', '#333333');
    $custom_css .= ".vm-site-title-tagline a, .vm-site-title a, .vm-site-title-tagline a:hover, .vm-site-title a:hover, .vm-site-description{color:$viral_mag_title_color}";


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

    /* === Front Page Post Title === */
    $custom_css .= viral_mag_typography_css('viral_mag_frontpage_title', 'h3.vm-post-title, h3.he-post-title', array(
        'family' => 'Poppins',
        'style' => '500',
        'text_transform' => 'capitalize',
        'text_decoration' => 'none',
        'size' => '16',
        'line_height' => '1.3',
        'letter_spacing' => '0'
    ));

    /* === Front Page Block Title === */
    $custom_css .= viral_mag_typography_css('viral_mag_frontpage_block_title', '.vm-block-title span.vm-title, .he-block-title', array(
        'family' => 'Poppins',
        'style' => '500',
        'text_transform' => 'uppercase',
        'text_decoration' => 'none',
        'size' => '20',
        'line_height' => '1.1',
        'letter_spacing' => '0'
    ));

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

    /* =============== Sidebar Title =============== */
    $custom_css .= viral_mag_typography_css('viral_mag_sidebar_title', '.widget-title', array(
        'family' => 'Poppins',
        'style' => '500',
        'text_transform' => 'uppercase',
        'text_decoration' => 'none',
        'size' => '18',
        'line_height' => '1.3',
        'letter_spacing' => '0'
    ));

    $viral_mag_content_header_color = get_theme_mod('viral_mag_content_header_color', '#000000');
    $viral_mag_content_text_color = get_theme_mod('viral_mag_content_text_color', '#333333');
    $viral_mag_content_link_color = get_theme_mod('viral_mag_content_link_color', '#000000');
    $viral_mag_content_link_hov_color = get_theme_mod('viral_mag_content_link_hov_color', '#cf0701');
    $viral_mag_content_widget_title_color = get_theme_mod('viral_mag_content_widget_title_color', '#000000');
    $viral_mag_content_light_color = viral_mag_hex2rgba($viral_mag_content_text_color, 0.1);
    $viral_mag_content_lighter_color = viral_mag_hex2rgba($viral_mag_content_text_color, 0.05);

    $custom_css .= ".vm-main-content h1, .vm-main-content h2, .vm-main-content h3, .vm-main-content h4, .vm-main-content h5, .vm-main-content h6 {color:$viral_mag_content_header_color}";
    $custom_css .= ".vm-main-content{color:$viral_mag_content_text_color}";
    $custom_css .= "a{color:$viral_mag_content_link_color}";
    $custom_css .= "a:hover, .woocommerce .woocommerce-breadcrumb a:hover, .breadcrumb-trail a:hover{color:$viral_mag_content_link_hov_color}";
    $custom_css .= ".vm-sidebar-style1 .vm-site-wrapper .widget-area ul ul, .vm-sidebar-style1 .vm-site-wrapper .widget-area li{border-color:$viral_mag_content_lighter_color}";
    $custom_css .= ".vm-sidebar-style2 .vm-site-wrapper .widget, .vm-sidebar-style2 .vm-site-wrapper .widget-title, .vm-sidebar-style3 .vm-site-wrapper .widget, .vm-sidebar-style5 .vm-site-wrapper .widget, .vm-sidebar-style7 .vm-site-wrapper .widget, .vm-sidebar-style7 .vm-site-wrapper .widget-title, .comment-list .sp-comment-content, .post-navigation, .post-navigation .nav-next, .vm-social-share{border-color:$viral_mag_content_light_color}";
    $custom_css .= ".vm-sidebar-style5 .vm-site-wrapper .widget-title:before, .vm-sidebar-style5 .vm-site-wrapper .widget-title:after{background-color:$viral_mag_content_light_color}";
    $custom_css .= ".single-entry-tags a, .widget-area .tagcloud a{border-color:$viral_mag_content_text_color}";
    $custom_css .= ".vm-sidebar-style3 .vm-site-wrapper .widget{background:$viral_mag_content_lighter_color}";
    $custom_css .= ".vm-main-content .widget-title{color:$viral_mag_content_widget_title_color}";
    $custom_css .= ".vm-sidebar-style1 .vm-site-wrapper .widget-title:after, .vm-sidebar-style3 .vm-site-wrapper .widget-title:after, .vm-sidebar-style6 .vm-site-wrapper .widget-title:after, .vm-sidebar-style7 .vm-site-wrapper .widget:before {background-color:$viral_mag_content_widget_title_color}";

    /* =============== Header CSS =============== */
    $viral_mag_mh_button_color = get_theme_mod('viral_mag_mh_button_color', '#000000');
    $viral_mag_th_bg_color = get_theme_mod('viral_mag_th_bg_color', '#cf0701');
    $viral_mag_th_bottom_border_color = get_theme_mod('viral_mag_th_bottom_border_color');
    $viral_mag_th_text_color = get_theme_mod('viral_mag_th_text_color', '#FFFFFF');
    $viral_mag_th_anchor_color = get_theme_mod('viral_mag_th_anchor_color', '#EEEEEE');
    $viral_mag_th_height = get_theme_mod('viral_mag_th_height', 45);
    $viral_mag_mh_height = get_theme_mod('viral_mag_mh_height', 65);
    $viral_mag_mh_half_height = $viral_mag_mh_height / 2;
    $viral_mag_mh_bg_color = get_theme_mod('viral_mag_mh_bg_color', '#cf0701');
    $viral_mag_mh_bg_color_mobile = get_theme_mod('viral_mag_mh_bg_color_mobile', '#cf0701');
    $viral_mag_mh_border_color = get_theme_mod('viral_mag_mh_border_color', '#EEEEEE');
    $viral_mag_mh_menu_color = get_theme_mod('viral_mag_mh_menu_color', '#FFFFFF');
    $viral_mag_mh_menu_hover_color = get_theme_mod('viral_mag_mh_menu_hover_color', '#FFFFFF');
    $viral_mag_mh_menu_hover_bg_color = get_theme_mod('viral_mag_mh_menu_hover_bg_color', '#cf0701');
    $viral_mag_mh_submenu_bg_color = get_theme_mod('viral_mag_mh_submenu_bg_color', '#F2F2F2');
    $viral_mag_mh_submenu_color = get_theme_mod('viral_mag_mh_submenu_color', '#333333');
    $viral_mag_mh_submenu_hover_color = get_theme_mod('viral_mag_mh_submenu_hover_color', '#333333');
    $viral_mag_menu_dropdown_padding = get_theme_mod('viral_mag_menu_dropdown_padding', 0);
    $viral_mag_logo_height = $viral_mag_mh_height - 30;
    $viral_mag_header6_height = $viral_mag_th_height + $viral_mag_mh_half_height;
    $viral_mag_header6_single_bottom_margin = 40 - $viral_mag_mh_half_height;
    $viral_mag_logo_actual_height = get_theme_mod('viral_mag_logo_height', 60);
    $viral_mag_logo_min_height = min($viral_mag_logo_height, $viral_mag_logo_actual_height);
    $viral_mag_logo_padding = get_theme_mod('viral_mag_logo_padding', 15);

    if ($viral_mag_th_bottom_border_color) {
        $custom_css .= "
            .vm-site-header .vm-top-header{
                border-bottom: 1px solid $viral_mag_th_bottom_border_color;
            }";
    }

    $custom_css .= "
            .vm-site-header .vm-top-header{
            background: $viral_mag_th_bg_color;
            color: $viral_mag_th_text_color;
        }
        
        .th-menu ul ul{
            background: $viral_mag_th_bg_color;
        }
        
        .vm-site-header .vm-top-header .vm-container{
            height: {$viral_mag_th_height}px;
        }
        
        .th-menu > ul > li > a{
            line-height: {$viral_mag_th_height}px;
        }
        
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

        .vm-site-header .vm-top-header a,
        .vm-site-header .vm-top-header a:hover,
        .vm-site-header .vm-top-header a i,
        .vm-site-header .vm-top-header a:hover i{
            color: $viral_mag_th_anchor_color;
        }

        .vm-header-one .vm-header,
        .vm-header-two .vm-header,
        .vm-header-three .vm-header,
        .vm-header-four .vm-header .vm-container,
        .vm-header-five .vm-header,
        .vm-header-six .vm-header .vm-container,
        .vm-header-seven .vm-header,
        .vm-sticky-header .vm-header-four .vm-header.headroom.headroom--not-top,
        .vm-sticky-header .vm-header-six .vm-header.headroom.headroom--not-top{
            background: $viral_mag_mh_bg_color;
        }
        
        .vm-sticky-header .vm-header-four .vm-header.headroom.headroom--not-top .vm-container,
        .vm-sticky-header .vm-header-six .vm-header.headroom.headroom--not-top .vm-container{
            background: none;
        }

        .vm-header-one .vm-header .vm-container,
        .vm-header-two .vm-header .vm-container,
        .vm-header-three .vm-header .vm-container,
        .vm-header-four .vm-header .vm-container,
        .vm-header-five .vm-header .vm-container,
        .vm-header-six .vm-header .vm-container,
        .vm-header-seven .vm-header .vm-container{
            height: {$viral_mag_mh_height}px;
        }

        .hover-style5 .vm-menu > ul > li.menu-item > a,
        .hover-style6 .vm-menu > ul > li.menu-item > a,
        .hover-style5 .vm-header-bttn,
        .hover-style6 .vm-header-bttn{
            line-height: {$viral_mag_mh_height}px;
        }
        
         #vm-site-branding img{
            height:{$viral_mag_logo_actual_height}px;
        }
        
        .vm-header-one  #vm-site-branding img,
        .vm-header-three  #vm-site-branding img,
        .vm-header-six  #vm-site-branding img{
            max-height: {$viral_mag_logo_height}px;
        }
            
        .vm-header-two  #vm-site-branding, 
        .vm-header-four  #vm-site-branding, 
        .vm-header-five  #vm-site-branding, 
        .vm-header-seven  #vm-site-branding{
            padding-top:{$viral_mag_logo_padding}px;
            padding-bottom:{$viral_mag_logo_padding}px
        }
        
        .vm-site-header.vm-header-one .vm-header,
        .vm-site-header.vm-header-two .vm-header,
        .vm-site-header.vm-header-three .vm-header,
        .vm-site-header.vm-header-four .vm-header .vm-container,
        .vm-site-header.vm-header-five .vm-header,
        .vm-site-header.vm-header-six .vm-header .vm-container,
        .vm-site-header.vm-header-seven .vm-header{
            border-color: {$viral_mag_mh_border_color};
        }
        
        .vm-menu > ul > li.menu-item > a,
        .vm-search-button a,
        .vm-header-social-icons a,
        .hover-style1 .vm-search-button a:hover,
        .hover-style3 .vm-search-button a:hover,
        .hover-style5 .vm-search-button a:hover,
        .hover-style1 .vm-header-social-icons a:hover,
        .hover-style3 .vm-header-social-icons a:hover,
        .hover-style5 .vm-header-social-icons a:hover{
            color: $viral_mag_mh_menu_color;
        }

        .hover-style6 .vm-menu > ul > li.menu-item:hover > a:before,
        .hover-style6 .vm-menu > ul > li.menu-item > a:before,
        .hover-style6 .vm-menu > ul > li.menu-item.current_page_item > a:before,
        .hover-style6 .vm-menu > ul > li.menu-item.current-menu-item > a:before,
        .hover-style6 .vm-menu > ul > li.menu-item.current_page_ancestor > a:before,
        .hover-style6 .vm-menu > ul > li.menu-item.current > a:before,
        .hover-style8 .vm-menu>ul>li.menu-item>a:before,
        .hover-style9 .vm-menu>ul>li.menu-item>a:before{
            background: $viral_mag_mh_menu_hover_color;
        }
        
        .vm-offcanvas-nav a>span,
        .hover-style1 .vm-offcanvas-nav a:hover>span,
        .hover-style3 .vm-offcanvas-nav a:hover>span,
        .hover-style5 .vm-offcanvas-nav a:hover>span{
            background-color: $viral_mag_mh_menu_color;
        }
        
        .vm-search-button a:hover,
        .vm-header-social-icons a:hover,
        .hover-style1 .vm-menu > ul> li.menu-item:hover > a,
        .hover-style1 .vm-menu > ul> li.menu-item.current_page_item > a, 
        .hover-style1 .vm-menu > ul > li.menu-item.current-menu-item > a,
        .vm-menu > ul > li.menu-item:hover > a,
        .vm-menu > ul > li.menu-item:hover > a > i,
        .vm-menu > ul > li.menu-item.current_page_item > a,
        .vm-menu > ul > li.menu-item.current-menu-item > a,
        .vm-menu > ul > li.menu-item.current_page_ancestor > a,
        .vm-menu > ul > li.menu-item.current > a{
            color: $viral_mag_mh_menu_hover_color;
        }
        
        .vm-offcanvas-nav a:hover>span{
            background-color: $viral_mag_mh_menu_hover_color;
        }

        .vm-menu ul ul,
        .menu-item-vm-cart .widget_shopping_cart,
         #vm-responsive-menu{
            background: $viral_mag_mh_submenu_bg_color;
        }
        
        .vm-menu .megamenu *,
         #vm-responsive-menu .megamenu *,
        .vm-menu .megamenu a,
         #vm-responsive-menu .megamenu a,
        .vm-menu ul ul li.menu-item > a,
        .menu-item-vm-cart .widget_shopping_cart a,
        .menu-item-vm-cart .widget_shopping_cart,
         #vm-responsive-menu li.menu-item > a,
         #vm-responsive-menu li.menu-item > a i,
         #vm-responsive-menu li .dropdown-nav,
        .megamenu-category .mega-post-title a{
            color: $viral_mag_mh_submenu_color;
        }
        
        .vm-menu .megamenu a:hover,
         #vm-responsive-menu .megamenu a:hover,
        .vm-menu .megamenu a:hover > i,
         #vm-responsive-menu .megamenu a:hover > i,
        .vm-menu > ul > li > ul:not(.megamenu) li.menu-item:hover > a,
        .vm-menu ul ul.megamenu li.menu-item > a:hover,
        .vm-menu ul ul li.menu-item > a:hover i,
        .menu-item-vm-cart .widget_shopping_cart a:hover,
        .vm-menu .megamenu-full-width.megamenu-category .cat-megamenu-tab > div.active-tab,
        .vm-menu .megamenu-full-width.megamenu-category .mega-post-title a:hover{
            color: $viral_mag_mh_submenu_hover_color;
        }
        
        .vm-menu ul ul li.menu-item>a:after{
            background: $viral_mag_mh_submenu_hover_color;
        }
        
        .vm-menu>ul>li.menu-item{
            padding-top: {$viral_mag_menu_dropdown_padding}px;
            padding-bottom: {$viral_mag_menu_dropdown_padding}px;
        }
        
        .vm-header-two .vm-middle-header-left a,
        .vm-header-two .vm-middle-header-right>div>a{
            color: {$viral_mag_mh_button_color} !important;
        }
        
        .vm-header-two .vm-offcanvas-nav a>span{
            background: {$viral_mag_mh_button_color} !important;
        }
    ";

    $viral_mag_mh_header_bg_url = get_theme_mod('viral_mag_mh_header_bg_url');
    $viral_mag_mh_header_bg_repeat = get_theme_mod('viral_mag_mh_header_bg_repeat', 'no-repeat');
    $viral_mag_mh_header_bg_size = get_theme_mod('viral_mag_mh_header_bg_size', 'cover');
    $viral_mag_mh_header_bg_position = get_theme_mod('viral_mag_mh_header_bg_position', 'center-center');
    $viral_mag_mh_header_bg_position = str_replace('-', ' ', $viral_mag_mh_header_bg_position);
    $viral_mag_mh_header_bg_attach = get_theme_mod('viral_mag_mh_header_bg_attach', 'scroll');

    if ($viral_mag_mh_header_bg_url) {
        $custom_css .= "
        .vm-header-two .vm-middle-header,
        .vm-header-seven .vm-middle-header{
        background-image: url($viral_mag_mh_header_bg_url);
        background-repeat: $viral_mag_mh_header_bg_repeat;
        background-size: $viral_mag_mh_header_bg_size;
        background-position: $viral_mag_mh_header_bg_position;
        background-attachment: $viral_mag_mh_header_bg_attach;
        }";
    }

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

    /* =============== Background Color =============== */
    $custom_css .= "
        button,
        input[type='button'],
        input[type='reset'],
        input[type='submit'],
        .vm-button,
        .comment-navigation .nav-previous a,
        .comment-navigation .nav-next a,
        .pagination .page-numbers,
        .vm-progress-bar-length,
        .vm-main-content .entry-readmore a,
        .blog-layout2 .entry-date,
        .blog-layout4 .vm-post-date,
        .woocommerce #respond input#submit,
        .woocommerce a.button,
        .woocommerce button.button,
        .woocommerce input.button,
        .woocommerce ul.products li.product:hover .viral-mag-product-title-wrap .button,
        .woocommerce #respond input#submit.alt,
        .woocommerce a.button.alt,
        .woocommerce button.button.alt,
        .woocommerce input.button.alt,
        .woocommerce nav.woocommerce-pagination ul li a,
        .woocommerce nav.woocommerce-pagination ul li span,
        .woocommerce span.onsale,
        .woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
        .woocommerce #respond input#submit.disabled,
        .woocommerce #respond input#submit:disabled,
        .woocommerce #respond input#submit:disabled[disabled],
        .woocommerce a.button.disabled, .woocommerce a.button:disabled,
        .woocommerce a.button:disabled[disabled],
        .woocommerce button.button.disabled,
        .woocommerce button.button:disabled,
        .woocommerce button.button:disabled[disabled],
        .woocommerce input.button.disabled,
        .woocommerce input.button:disabled,
        .woocommerce input.button:disabled[disabled],
        .woocommerce #respond input#submit.alt.disabled,
        .woocommerce #respond input#submit.alt.disabled:hover,
        .woocommerce #respond input#submit.alt:disabled,
        .woocommerce #respond input#submit.alt:disabled:hover,
        .woocommerce #respond input#submit.alt:disabled[disabled],
        .woocommerce #respond input#submit.alt:disabled[disabled]:hover,
        .woocommerce a.button.alt.disabled,
        .woocommerce a.button.alt.disabled:hover,
        .woocommerce a.button.alt:disabled,
        .woocommerce a.button.alt:disabled:hover,
        .woocommerce a.button.alt:disabled[disabled],
        .woocommerce a.button.alt:disabled[disabled]:hover,
        .woocommerce button.button.alt.disabled,
        .woocommerce button.button.alt.disabled:hover,
        .woocommerce button.button.alt:disabled,
        .woocommerce button.button.alt:disabled:hover,
        .woocommerce button.button.alt:disabled[disabled],
        .woocommerce button.button.alt:disabled[disabled]:hover,
        .woocommerce input.button.alt.disabled,
        .woocommerce input.button.alt.disabled:hover,
        .woocommerce input.button.alt:disabled,
        .woocommerce input.button.alt:disabled:hover,
        .woocommerce input.button.alt:disabled[disabled],
        .woocommerce input.button.alt:disabled[disabled]:hover,
        .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
        .woocommerce-MyAccount-navigation-link a,
        .vm-style2-accordion .vm-accordion-header,
        #back-to-top,
        .vm-pt-header .vm-pt-tab.vm-pt-active,
        .vm-post-listing .vm-pl-count,
       .vm-post-categories li a.vm-category,
       .vm-slider-block .owl-carousel .owl-nav .owl-prev:hover, 
       .vm-slider-block .owl-carousel .owl-nav .owl-next:hover,
       .vm-fwcarousel-block .owl-carousel .owl-nav .owl-prev, 
       .vm-fwcarousel-block .owl-carousel .owl-nav .owl-next,
       .vm-primary-cat-block.vm-primary-cat,
       .vm-carousel-block .owl-carousel .owl-nav .owl-prev, 
       .vm-carousel-block .owl-carousel .owl-nav .owl-next,
        .video-controls,
       .vm-ticker.style1.vm-ticker-title,
       .vm-ticker.style1 .owl-carousel .owl-nav button.owl-prev, 
       .vm-ticker.style1 .owl-carousel .owl-nav button.owl-next,
       .vm-ticker.style2.vm-ticker-title,
       .vm-ticker.style3.vm-ticker-title,
       .vm-ticker.style4.vm-ticker-title,
        .single-entry-gallery .owl-carousel .owl-nav .owl-prev, 
        .single-entry-gallery .owl-carousel .owl-nav .owl-next,
        .viral-mag-related-post.style3 .owl-carousel .owl-nav .owl-prev, 
        .viral-mag-related-post.style3 .owl-carousel .owl-nav .owl-next,
        .vm-instagram-widget-footer a,
        .blog-layout7 .vm-post-date,
        .he-post-thumb .post-categories li a:hover
        {
            background:{$color};
        }";

    /* =============== Color =============== */
    $custom_css .= "
        .no-comments,
        .woocommerce div.product p.price,
        .woocommerce div.product span.price,
        .woocommerce .product_meta a:hover,
        .woocommerce-error:before,
        .woocommerce-info:before,
        .woocommerce-message:before,
        #back-to-top,
        .blog-layout1 .vm-post-date .entry-date span
        {
            color:{$color};
        }";

    /* =============== Border Color =============== */
    $custom_css .= "
        .woocommerce ul.products li.product:hover,
        .woocommerce-page ul.products li.product:hover,
        .woocommerce #respond input#submit,
        .woocommerce a.button,
        .woocommerce button.button,
        .woocommerce input.button,
        .woocommerce ul.products li.product:hover .viral-mag-product-title-wrap .button,
        .woocommerce #respond input#submit.alt,
        .woocommerce a.button.alt,
        .woocommerce button.button.alt,
        .woocommerce input.button.alt,
        .woocommerce div.product .woocommerce-tabs ul.tabs,
        .woocommerce #respond input#submit.alt.disabled,
        .woocommerce #respond input#submit.alt.disabled:hover,
        .woocommerce #respond input#submit.alt:disabled,
        .woocommerce #respond input#submit.alt:disabled:hover,
        .woocommerce #respond input#submit.alt:disabled[disabled],
        .woocommerce #respond input#submit.alt:disabled[disabled]:hover,
        .woocommerce a.button.alt.disabled,
        .woocommerce a.button.alt.disabled:hover,
        .woocommerce a.button.alt:disabled,
        .woocommerce a.button.alt:disabled:hover,
        .woocommerce a.button.alt:disabled[disabled],
        .woocommerce a.button.alt:disabled[disabled]:hover,
        .woocommerce button.button.alt.disabled,
        .woocommerce button.button.alt.disabled:hover,
        .woocommerce button.button.alt:disabled,
        .woocommerce button.button.alt:disabled:hover,
        .woocommerce button.button.alt:disabled[disabled],
        .woocommerce button.button.alt:disabled[disabled]:hover,
        .woocommerce input.button.alt.disabled,
        .woocommerce input.button.alt.disabled:hover,
        .woocommerce input.button.alt:disabled,
        .woocommerce input.button.alt:disabled:hover,
        .woocommerce input.button.alt:disabled[disabled],
        .woocommerce input.button.alt:disabled[disabled]:hover,
        .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
        .vm-style2-accordion .vm-accordion-content-wrap,
        .content-area .entry-content blockquote
        {
            border-color: {$color};
        }

        .woocommerce-error,
        .woocommerce-info,
        .woocommerce-message{
            border-top-color: {$color};
        }

        .woocommerce ul.products li.product .onsale:after{
            border-color: transparent transparent {$darker_color} {$darker_color};
        }

        .woocommerce span.onsale:after{
            border-color: transparent {$darker_color} {$darker_color} transparent;
        }

        .woocommerce div.product .woocommerce-tabs ul.tabs li.active a:before{
            border-color: {$color} transparent transparent;
        }
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

            .vm-header-one .vm-header, 
            .vm-header-two .vm-header, 
            .vm-header-three .vm-header, 
            .vm-header-four .vm-header .vm-container, 
            .vm-header-five .vm-header, 
            .vm-header-six .vm-header .vm-container, 
            .vm-header-seven .vm-header, 
            .vm-sticky-header .vm-header-four .vm-header.headroom.headroom--not-top, 
            .vm-sticky-header .vm-header-six .vm-header.headroom.headroom--not-top{
                background: {$viral_mag_mh_bg_color_mobile};
            }
            
            .vm-header-two .vm-header .vm-container {
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
