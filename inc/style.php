<?php

/**
 * @package Viral Mag
 */
function viral_mag_dymanic_styles() {
    $custom_css = $tablet_css = $mobile_css = "";
    $color = get_theme_mod('viral_mag_template_color', '#cf0701');
    $lighter_color_rgba = viral_mag_hex2rgba($color, 0.2);
    $darker_color = viral_mag_color_brightness($color, -0.9);
    $container_width = get_theme_mod('viral_mag_website_width', 1170);
    $container_width_200 = $container_width + 200;
    $sidebar_width = get_theme_mod('viral_mag_sidebar_width', 30);
    $primary_width = 100 - 4 - $sidebar_width;
    $boxed_container_width = $container_width + 80;
    $viral_mag_preloader_color = get_theme_mod('viral_mag_preloader_color', '#000000');
    $viral_mag_preloader_bg_color = get_theme_mod('viral_mag_preloader_bg_color', '#FFFFFF');
    $viral_mag_responsive_width = get_theme_mod('viral_mag_responsive_width', 780);

    /* =============== Full & Boxed width =============== */
    $custom_css .= "
	.ht-container{
            max-width:{$container_width}px; 
	}
	body.ht-boxed #ht-page{
            max-width:{$boxed_container_width}px;
	}
        #primary{ width:{$primary_width}%}
        #secondary{ width:{$sidebar_width}%}
	";

    /* =============== Site Title & Tagline Color =============== */
    $viral_mag_title_color = get_theme_mod('viral_mag_title_color', '#333333');
    $custom_css .= ".ht-site-title-tagline a, .ht-site-title a, .ht-site-title-tagline a:hover, .ht-site-title a:hover, .ht-site-description{color:$viral_mag_title_color}";

    /* =============== Typography CSS =============== */
    $fonts = viral_mag_get_customizer_fonts();
    $font_class = array(
        'body' => 'html, body, button, input, select, textarea',
        'menu' => '.ht-menu > ul > li > a, a.ht-header-bttn',
        'frontpage_title' => 'h3.vl-post-title, h3.he-post-title',
        'frontpage_block_title' => '.vl-block-title span.vl-title, .vp-block-title span.vl-title, .he-block-title span',
        'sidebar_title' => '.widget-title',
        'page_title' => '.ht-main-title, .single-post .entry-title',
        'h1' => 'h1, .ht-site-title',
        'h2' => 'h2',
        'h3' => 'h3',
        'h4' => 'h4',
        'h5' => 'h5',
        'h6' => 'h6',
        'h' => 'h1, h2, h3, h4, h5, h6, .ht-site-title'
    );

    foreach ($fonts as $key => $value) {
        $font_css = array();
        $font_family = get_theme_mod($key . '_font_family', $value['font_family']);
        $font_style = get_theme_mod($key . '_font_style', $value['font_style']);
        $text_transform = get_theme_mod($key . '_text_transform', $value['text_transform']);
        $text_decoration = get_theme_mod($key . '_text_decoration', $value['text_decoration']);
        if ($key != 'h') {
            $font_size = get_theme_mod($key . '_font_size', $value['font_size']);
        }
        $line_height = get_theme_mod($key . '_line_height', $value['line_height']);
        $letter_spacing = get_theme_mod($key . '_letter_spacing', $value['letter_spacing']);
        if ($key == 'body') {
            $font_color = get_theme_mod($key . '_color', $value['color']);
        }
        $font_italic = 'normal';

        if (strpos($font_style, 'italic')) {
            $font_italic = 'italic';
        }

        $font_weight = absint($font_style);

        $font_css[] = !empty($font_family) ? "font-family: '{$font_family}', serif" : '';
        $font_css[] = !empty($font_weight) ? "font-weight: {$font_weight}" : '';
        $font_css[] = !empty($font_italic) ? "font-style: {$font_italic}" : '';
        $font_css[] = !empty($text_transform) ? "text-transform: {$text_transform}" : '';
        $font_css[] = !empty($text_decoration) ? "text-decoration: {$text_decoration}" : '';
        if ($key != 'h') {
            $font_css[] = !empty($font_size) ? "font-size: {$font_size}px" : '';
        }
        $font_css[] = !empty($line_height) ? "line-height: {$line_height}" : '';
        $font_css[] = !empty($letter_spacing) ? "letter-spacing: {$letter_spacing}px" : '';
        if ($key == 'body' || $key == 'page_title') {
            $font_css[] = !empty($font_color) ? "color: {$font_color}" : '';
        }

        $font_style = implode(';', $font_css);

        $custom_css .= "
            $font_class[$key]{{$font_style}}";
    }

    $common_header_typography = get_theme_mod('common_header_typography', true);

    if ($common_header_typography) {
        $h1_font_size = get_theme_mod('hh1_font_size', 38);
        $h2_font_size = get_theme_mod('hh2_font_size', 34);
        $h3_font_size = get_theme_mod('hh3_font_size', 30);
        $h4_font_size = get_theme_mod('hh4_font_size', 26);
        $h5_font_size = get_theme_mod('hh5_font_size', 22);
        $h6_font_size = get_theme_mod('hh6_font_size', 18);

        $custom_css .= "h1, .ht-site-title{font-size:{$h1_font_size}px}";
        $custom_css .= "h2{font-size:{$h2_font_size}px}";
        $custom_css .= "h3{font-size:{$h3_font_size}px}";
        $custom_css .= "h4{font-size:{$h4_font_size}px}";
        $custom_css .= "h5{font-size:{$h5_font_size}px}";
        $custom_css .= "h6{font-size:{$h6_font_size}px}";
    }

    $i_font_size = get_theme_mod('menu_font_size', 14);
    $i_font_family = get_theme_mod('menu_font_family', 'Poppins');
    $custom_css .= "
	.ht-main-navigation,
        .menu-item-megamenu .widget-title,
        .menu-item-megamenu .vl-block-title span.vl-title{
        font-size: {$i_font_size}px;
        font-family: $i_font_family;
	}
        
        .single-ht-megamenu .ht-main-content{
        font-family: $i_font_family;
        }
	";

    $viral_mag_content_header_color = get_theme_mod('viral_mag_content_header_color', '#000000');
    $viral_mag_content_text_color = get_theme_mod('viral_mag_content_text_color', '#333333');
    $viral_mag_content_link_color = get_theme_mod('viral_mag_content_link_color', '#000000');
    $viral_mag_content_link_hov_color = get_theme_mod('viral_mag_content_link_hov_color', '#cf0701');
    $viral_mag_content_widget_title_color = get_theme_mod('viral_mag_content_widget_title_color', '#000000');
    $viral_mag_content_light_color = viral_mag_hex2rgba($viral_mag_content_text_color, 0.1);
    $viral_mag_content_lighter_color = viral_mag_hex2rgba($viral_mag_content_text_color, 0.05);

    $custom_css .= ".ht-main-content h1, .ht-main-content h2, .ht-main-content h3, .ht-main-content h4, .ht-main-content h5, .ht-main-content h6 {color:$viral_mag_content_header_color}";
    $custom_css .= ".ht-main-content{color:$viral_mag_content_text_color}";
    $custom_css .= "a{color:$viral_mag_content_link_color}";
    $custom_css .= "a:hover, .woocommerce .woocommerce-breadcrumb a:hover, .breadcrumb-trail a:hover{color:$viral_mag_content_link_hov_color}";
    $custom_css .= ".ht-sidebar-style1 .ht-site-wrapper .widget-area ul ul, .ht-sidebar-style1 .ht-site-wrapper .widget-area li{border-color:$viral_mag_content_lighter_color}";
    $custom_css .= ".ht-sidebar-style2 .ht-site-wrapper .widget, .ht-sidebar-style2 .ht-site-wrapper .widget-title, .ht-sidebar-style3 .ht-site-wrapper .widget, .ht-sidebar-style5 .ht-site-wrapper .widget, .ht-sidebar-style7 .ht-site-wrapper .widget, .ht-sidebar-style7 .ht-site-wrapper .widget-title, .comment-list .sp-comment-content, .post-navigation, .post-navigation .nav-next, .ht-social-share{border-color:$viral_mag_content_light_color}";
    $custom_css .= ".ht-sidebar-style5 .ht-site-wrapper .widget-title:before, .ht-sidebar-style5 .ht-site-wrapper .widget-title:after{background-color:$viral_mag_content_light_color}";
    $custom_css .= ".single-entry-tags a, .widget-area .tagcloud a{border-color:$viral_mag_content_text_color}";
    $custom_css .= ".ht-sidebar-style3 .ht-site-wrapper .widget{background:$viral_mag_content_lighter_color}";
    $custom_css .= ".ht-main-content .widget-title{color:$viral_mag_content_widget_title_color}";
    $custom_css .= ".ht-sidebar-style1 .ht-site-wrapper .widget-title:after, .ht-sidebar-style3 .ht-site-wrapper .widget-title:after, .ht-sidebar-style6 .ht-site-wrapper .widget-title:after, .ht-sidebar-style7 .ht-site-wrapper .widget:before {background-color:$viral_mag_content_widget_title_color}";

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
            .ht-site-header .ht-top-header{
                border-bottom: 1px solid $viral_mag_th_bottom_border_color;
            }";
    }

    $custom_css .= "
            .ht-site-header .ht-top-header{
            background: $viral_mag_th_bg_color;
            color: $viral_mag_th_text_color;
        }
        
        .th-menu ul ul{
            background: $viral_mag_th_bg_color;
        }
        
        .ht-site-header .ht-top-header .ht-container{
            height: {$viral_mag_th_height}px;
        }
        
        .th-menu > ul > li > a{
            line-height: {$viral_mag_th_height}px;
        }
        
        .ht-top-header-on .ht-header-six.ht-site-header{
            margin-bottom: -{$viral_mag_mh_half_height}px;
        }
        
        .ht-top-header-on.ht-single-layout1 .ht-header-six.ht-site-header,
        .ht-top-header-on.ht-single-layout2 .ht-header-six.ht-site-header,
        .ht-top-header-on.ht-single-layout7 .ht-header-six.ht-site-header{
            margin-bottom: {$viral_mag_header6_single_bottom_margin}px;
        }
        
        .ht-top-header-on.ht-single-layout3 .ht-header-six.ht-site-header,
        .ht-top-header-on.ht-single-layout4 .ht-header-six.ht-site-header,
        .ht-top-header-on.ht-single-layout5 .ht-header-six.ht-site-header,
        .ht-top-header-on.ht-single-layout6 .ht-header-six.ht-site-header{
            margin-bottom: -{$viral_mag_mh_height}px;
        }
        
        .ht-header-six.ht-site-header .ht-top-header{
            height: {$viral_mag_header6_height}px;
        }

        .ht-site-header .ht-top-header a,
        .ht-site-header .ht-top-header a:hover,
        .ht-site-header .ht-top-header a i,
        .ht-site-header .ht-top-header a:hover i{
            color: $viral_mag_th_anchor_color;
        }

        .ht-header-one .ht-header,
        .ht-header-two .ht-header,
        .ht-header-three .ht-header,
        .ht-header-four .ht-header .ht-container,
        .ht-header-five .ht-header,
        .ht-header-six .ht-header .ht-container,
        .ht-header-seven .ht-header,
        .ht-sticky-header .ht-header-four .ht-header.headroom.headroom--not-top,
        .ht-sticky-header .ht-header-six .ht-header.headroom.headroom--not-top{
            background: $viral_mag_mh_bg_color;
        }
        
        .ht-sticky-header .ht-header-four .ht-header.headroom.headroom--not-top .ht-container,
        .ht-sticky-header .ht-header-six .ht-header.headroom.headroom--not-top .ht-container{
            background: none;
        }

        .ht-header-one .ht-header .ht-container,
        .ht-header-two .ht-header .ht-container,
        .ht-header-three .ht-header .ht-container,
        .ht-header-four .ht-header .ht-container,
        .ht-header-five .ht-header .ht-container,
        .ht-header-six .ht-header .ht-container,
        .ht-header-seven .ht-header .ht-container{
            height: {$viral_mag_mh_height}px;
        }

        .hover-style5 .ht-menu > ul > li.menu-item > a,
        .hover-style6 .ht-menu > ul > li.menu-item > a,
        .hover-style5 .ht-header-bttn,
        .hover-style6 .ht-header-bttn{
            line-height: {$viral_mag_mh_height}px;
        }
        
        #ht-site-branding img{
            height:{$viral_mag_logo_actual_height}px;
        }
        
        .ht-header-one #ht-site-branding img,
        .ht-header-three #ht-site-branding img,
        .ht-header-six #ht-site-branding img{
            max-height: {$viral_mag_logo_height}px;
        }
            
        .ht-header-two #ht-site-branding, 
        .ht-header-four #ht-site-branding, 
        .ht-header-five #ht-site-branding, 
        .ht-header-seven #ht-site-branding{
            padding-top:{$viral_mag_logo_padding}px;
            padding-bottom:{$viral_mag_logo_padding}px
        }
        
        .ht-site-header.ht-header-one .ht-header,
        .ht-site-header.ht-header-two .ht-header,
        .ht-site-header.ht-header-three .ht-header,
        .ht-site-header.ht-header-four .ht-header .ht-container,
        .ht-site-header.ht-header-five .ht-header,
        .ht-site-header.ht-header-six .ht-header .ht-container,
        .ht-site-header.ht-header-seven .ht-header{
            border-color: {$viral_mag_mh_border_color};
        }
        
        .ht-menu > ul > li.menu-item > a,
        .ht-search-button a,
        .ht-header-social-icons a,
        .hover-style1 .ht-search-button a:hover,
        .hover-style3 .ht-search-button a:hover,
        .hover-style5 .ht-search-button a:hover,
        .hover-style1 .ht-header-social-icons a:hover,
        .hover-style3 .ht-header-social-icons a:hover,
        .hover-style5 .ht-header-social-icons a:hover{
            color: $viral_mag_mh_menu_color;
        }
        
        .ht-offcanvas-nav a>span,
        .hover-style1 .ht-offcanvas-nav a:hover>span,
        .hover-style3 .ht-offcanvas-nav a:hover>span,
        .hover-style5 .ht-offcanvas-nav a:hover>span{
            background-color: $viral_mag_mh_menu_color;
        }
        
        .ht-search-button a:hover,
        .ht-header-social-icons a:hover,
        .hover-style1 .ht-menu > ul> li.menu-item:hover > a,
        .hover-style1 .ht-menu > ul> li.menu-item.current_page_item > a, 
        .hover-style1 .ht-menu > ul > li.menu-item.current-menu-item > a,
        .ht-menu > ul > li.menu-item:hover > a,
        .ht-menu > ul > li.menu-item:hover > a > i,
        .ht-menu > ul > li.menu-item.current_page_item > a,
        .ht-menu > ul > li.menu-item.current-menu-item > a,
        .ht-menu > ul > li.menu-item.current_page_ancestor > a,
        .ht-menu > ul > li.menu-item.current > a{
            color: $viral_mag_mh_menu_hover_color;
        }
        
        .ht-offcanvas-nav a:hover>span{
            background-color: $viral_mag_mh_menu_hover_color;
        }

        .ht-menu ul ul,
        .menu-item-ht-cart .widget_shopping_cart,
        #ht-responsive-menu{
            background: $viral_mag_mh_submenu_bg_color;
        }
        
        .ht-menu .megamenu *,
        #ht-responsive-menu .megamenu *,
        .ht-menu .megamenu a,
        #ht-responsive-menu .megamenu a,
        .ht-menu ul ul li.menu-item > a,
        .menu-item-ht-cart .widget_shopping_cart a,
        .menu-item-ht-cart .widget_shopping_cart,
        #ht-responsive-menu li.menu-item > a,
        #ht-responsive-menu li.menu-item > a i,
        #ht-responsive-menu li .dropdown-nav,
        .megamenu-category .mega-post-title a{
            color: $viral_mag_mh_submenu_color;
        }
        
        .ht-menu .megamenu a:hover,
        #ht-responsive-menu .megamenu a:hover,
        .ht-menu .megamenu a:hover > i,
        #ht-responsive-menu .megamenu a:hover > i,
        .ht-menu > ul > li > ul:not(.megamenu) li.menu-item:hover > a,
        .ht-menu ul ul.megamenu li.menu-item > a:hover,
        .ht-menu ul ul li.menu-item > a:hover i,
        .menu-item-ht-cart .widget_shopping_cart a:hover,
        .ht-menu .megamenu-full-width.megamenu-category .cat-megamenu-tab > div.active-tab,
        .ht-menu .megamenu-full-width.megamenu-category .mega-post-title a:hover{
            color: $viral_mag_mh_submenu_hover_color;
        }
        
        .ht-menu ul ul li.menu-item>a:after{
            background: $viral_mag_mh_submenu_hover_color;
        }
        
        .ht-menu>ul>li.menu-item{
            padding-top: {$viral_mag_menu_dropdown_padding}px;
            padding-bottom: {$viral_mag_menu_dropdown_padding}px;
        }
        
        .ht-header-two .ht-middle-header-left a,
        .ht-header-two .ht-middle-header-right>div>a{
            color: {$viral_mag_mh_button_color} !important;
        }
        
        .ht-header-two .ht-offcanvas-nav a>span{
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
        .ht-header-two .ht-middle-header,
        .ht-header-seven .ht-middle-header{
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
        .vl-block-title span.vl-title{color:$viral_mag_block_title_color}
        .ht-block-title-style2 .vl-block-title:after, .ht-block-title-style5 .vl-block-title span.vl-title:before, .ht-block-title-style7 .vl-block-title span.vl-title, .ht-block-title-style8 .vl-block-title span.vl-title, .ht-block-title-style9 .vl-block-title span.vl-title, .ht-block-title-style9 .vl-block-title span.vl-title:before, .ht-block-title-style10 .vl-block-title, .ht-block-title-style11 .vl-block-title span.vl-title, .ht-block-title-style12 .vl-block-title{background-color:$viral_mag_block_title_background_color}
        .ht-block-title-style8 .vl-block-title, .ht-block-title-style9 .vl-block-title, .ht-block-title-style11 .vl-block-title{border-color:$viral_mag_block_title_background_color}
        .ht-block-title-style10 .vl-block-title:before{border-color: $viral_mag_block_title_background_color $viral_mag_block_title_background_color transparent transparent}
    ";
    $custom_css .= "
        .ht-block-title-style2 .vl-block-title, .ht-block-title-style3 .vl-block-title, .ht-block-title-style5 .vl-block-title{border-color:$viral_mag_block_title_border_color}
        .ht-block-title-style4 .vl-block-title:after, .ht-block-title-style6 .vl-block-title:before, .ht-block-title-style6 .vl-block-title:after, .ht-block-title-style7 .vl-block-title:after{background-color:$viral_mag_block_title_border_color}
    ";

    /* =============== Background Color =============== */
    $custom_css .= "
        button,
        input[type='button'],
        input[type='reset'],
        input[type='submit'],
        .ht-button,
        .comment-navigation .nav-previous a,
        .comment-navigation .nav-next a,
        .pagination .page-numbers,
        .ht-progress-bar-length,
        .ht-main-content .entry-readmore a,
        .blog-layout2 .entry-date,
        .blog-layout4 .ht-post-date,
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
        .ht-style2-accordion .ht-accordion-header,
        #back-to-top,
        .ht-pt-header .ht-pt-tab.ht-pt-active,
        .ht-post-listing .ht-pl-count,
        .vl-post-categories li a.vl-category,
        .vl-slider-block .owl-carousel .owl-nav .owl-prev:hover, 
        .vl-slider-block .owl-carousel .owl-nav .owl-next:hover,
        .vl-fwcarousel-block .owl-carousel .owl-nav .owl-prev, 
        .vl-fwcarousel-block .owl-carousel .owl-nav .owl-next,
        .vl-primary-cat-block .vl-primary-cat,
        .vl-carousel-block .owl-carousel .owl-nav .owl-prev, 
        .vl-carousel-block .owl-carousel .owl-nav .owl-next,
        .video-controls,
        .vl-ticker.style1 .vl-ticker-title,
        .vl-ticker.style1 .owl-carousel .owl-nav button.owl-prev, 
        .vl-ticker.style1 .owl-carousel .owl-nav button.owl-next,
        .vl-ticker.style2 .vl-ticker-title,
        .vl-ticker.style3 .vl-ticker-title,
        .vl-ticker.style4 .vl-ticker-title,
        .single-entry-gallery .owl-carousel .owl-nav .owl-prev, 
        .single-entry-gallery .owl-carousel .owl-nav .owl-next,
        .viral-mag-related-post.style3 .owl-carousel .owl-nav .owl-prev, 
        .viral-mag-related-post.style3 .owl-carousel .owl-nav .owl-next,
        .ht-instagram-widget-footer a,
        .blog-layout7 .ht-post-date,
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
        .blog-layout1 .ht-post-date .entry-date span
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
        .ht-style2-accordion .ht-accordion-content-wrap,
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
        #ht-colophon{
            background-image:url($viral_mag_footer_bg_url);
            background-repeat: $viral_mag_footer_bg_repeat;
            background-size: $viral_mag_footer_bg_size;
            background-position: $viral_mag_footer_bg_position;
            background-attachment: $viral_mag_footer_bg_attach;
        }
        
        .ht-site-footer:before{
                background-color: $viral_mag_footer_bg_color;
        }
        
        #ht-colophon .widget-title{
                color: $viral_mag_footer_title_color;
        }
        
        .ht-sidebar-style1 .ht-site-footer .widget-title:after,
        .ht-sidebar-style3 .ht-site-footer .widget-title:after,
        .ht-sidebar-style6 .ht-site-footer .widget-title:after{
            background: $viral_mag_footer_title_color;
        }
        
        .ht-sidebar-style2 .ht-site-footer .widget-title,
        .ht-sidebar-style7 .ht-site-footer .widget-title{
            border-color: $viral_mag_footer_title_light_color;
        }
        
        .ht-sidebar-style5 .ht-site-footer .widget-title:before,
        .ht-sidebar-style5 .ht-site-footer .widget-title:after{
            background-color: $viral_mag_footer_title_light_color;
        }

        .ht-site-footer *{
                color: $viral_mag_footer_text_color;
        }

        .ht-site-footer a,
        .ht-site-footer a *{
                color: $viral_mag_footer_anchor_color;
        }
        
        .ht-top-footer .ht-container,
        .ht-main-footer .ht-container,
        .ht-bottom-top-footer .ht-container{
            border-color: $viral_mag_footer_border_color;
        }";

    /* =============== Responsive CSS =============== */
    $custom_css .= "@media screen and (max-width: {$viral_mag_responsive_width}px){
            .ht-menu{
                display: none;
            }

            #ht-mobile-menu{
                display: block;
            }

            .ht-header-one .ht-header, 
            .ht-header-two .ht-header, 
            .ht-header-three .ht-header, 
            .ht-header-four .ht-header .ht-container, 
            .ht-header-five .ht-header, 
            .ht-header-six .ht-header .ht-container, 
            .ht-header-seven .ht-header, 
            .ht-sticky-header .ht-header-four .ht-header.headroom.headroom--not-top, 
            .ht-sticky-header .ht-header-six .ht-header.headroom.headroom--not-top{
                background: {$viral_mag_mh_bg_color_mobile};
            }
            
            .ht-header-two .ht-header .ht-container {
                justify-content: flex-end;
            }
            
            .ht-header-six.ht-site-header .ht-top-header {
                height: auto !important;
            }
            .ht-top-header-on .ht-header-six .ht-header {
                -webkit-transform: translateY(0) !important;
                transform: translateY(0) !important;
            }
            .ht-header-six.ht-site-header {
                margin-bottom: 0 !important;
            }
            .ht-top-header-on.ht-single-layout1 .ht-header-six.ht-site-header, 
            .ht-top-header-on.ht-single-layout2 .ht-header-six.ht-site-header, 
            .ht-top-header-on.ht-single-layout5 .ht-header-six.ht-site-header,
            .ht-top-header-on.ht-single-layout6 .ht-header-six.ht-site-header,
            .ht-top-header-on.ht-single-layout7 .ht-header-six.ht-site-header{
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
            
            #ht-responsive-menu li.menu-item.megamenu-category > a > .dropdown-nav{
                display:none;
            }

            .ht-sticky-header .headroom.headroom--not-top{
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
            
            .ht-header .ht-offcanvas-nav, 
            .ht-header .ht-search-button, 
            .ht-header .ht-header-social-icons{
                display: none;
            }
            
            #ht-content{
                padding-top: 0 !important;
            }
            
            .admin-bar.ht-sticky-header .headroom.headroom--not-top{
                top: auto;
            }
            
            .ht-sticky-header .ht-header-four .ht-header.headroom.headroom--not-top .ht-container{
                margin-bottom: 38px !important;
            }
            
            .ht-top-header-on.ht-sticky-header .ht-header-six .ht-header.headroom.headroom--not-top {
                -webkit-transform: translateY(-50%);
                transform: translateY(-50%);
            }
            
            .ht-header-one #ht-site-branding img,
            .ht-header-three #ht-site-branding img,
            .ht-header-six #ht-site-branding img{
                height: auto;
                max-height: {$viral_mag_logo_min_height}px;
            }
                    
            .ht-header-two #ht-site-branding img, 
            .ht-header-four #ht-site-branding img, 
            .ht-header-five #ht-site-branding img, 
            .ht-header-seven #ht-site-branding img{
                height: auto;
                max-height: {$viral_mag_logo_actual_height}px;
            }
            
        }

        @media screen and (max-width: {$container_width}px){        
            .elementor-section.elementor-section-boxed>.elementor-container,            
            .ht-container{
                padding-left: 5% !important;
                padding-right: 5% !important;
            }
        }
            
        @media screen and (max-width: {$container_width_200}px){        
            .ht-single-layout5 .entry-header,
            .ht-single-layout6 .entry-header{
                margin-left: 0;
                margin-right: 0;
            }
            .ht-single-layout6 .entry-header{
                height: auto;
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
