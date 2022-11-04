/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

function viral_mag_dynamic_css(control, style) {
    jQuery('style.' + control).remove();

    jQuery('head').append(
            '<style class="' + control + '">' + style + '</style>'
            );
}

function viral_mag_get_contrast(hexcolor) {
    var hex = String(hexcolor).replace(/[^0-9a-f]/gi, '');
    if (hex.length < 6) {
        hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
    }
    var r = parseInt(hex.substr(0, 2), 16);
    var g = parseInt(hex.substr(2, 2), 16);
    var b = parseInt(hex.substr(4, 2), 16);
    var contrast = ((r * 299) + (g * 587) + (b * 114)) / 1000;
    return contrast;
}

function viral_mag_convert_hex(hexcolor, opacity) {
    var hex = String(hexcolor).replace(/[^0-9a-f]/gi, '');
    if (hex.length < 6) {
        hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
    }
    r = parseInt(hex.substring(0, 2), 16);
    g = parseInt(hex.substring(2, 4), 16);
    b = parseInt(hex.substring(4, 6), 16);

    result = 'rgba(' + r + ',' + g + ',' + b + ',' + opacity / 100 + ')';
    return result;
}

(function ($) {
    wp.customize.bind('preview-ready', function () {
        wp.customize.preview.bind('viral-mag-gdpr-add-class', function (data) {
            // When the section is expanded, open the login designer page specified via localization.
            if (true === data.expanded) {
                var enable_gdpr = wp.customize('viral_mag_enable_gdpr').get();
                if ('off' == enable_gdpr) {
                    var css = '.customizer-gdpr-section .viral-mag-privacy-policy{display:none !important}';
                } else {
                    var css = '.customizer-gdpr-section .viral-mag-privacy-policy{display:block !important}';
                }
                viral_mag_dynamic_css('viral_mag_enable_gdpr', css);

                $('body').addClass('customizer-gdpr-section');
            }
        });

        wp.customize.preview.bind('viral-mag-gdpr-remove-class', function (data) {
            $('body').removeClass('customizer-gdpr-section');
        });
    });

    // Site title and description.
    wp.customize('blogname', function (value) {
        value.bind(function (to) {
            $('.vm-site-title a').text(to);
        });
    });

    wp.customize('blogdescription', function (value) {
        value.bind(function (to) {
            $('.vm-site-description').text(to);
        });
    });

    wp.customize('viral_mag_tagline_position', function (value) {
        value.bind(function (to) {
            $(' #vm-masthead').removeClass('vm-tagline-inline-logo vm-tagline-below-logo').addClass(to);
        });
    });

    wp.customize('viral_mag_title_color', function (value) {
        value.bind(function (to) {
            var css = '.vm-site-title a, .vm-site-description, .vm-site-description a{color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_title_color', css);
        });
    });

    wp.customize('viral_mag_th_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.vm-site-header .vm-top-header{background:' + to + '}';
            css += '.th-menu ul ul{background:' + to + '}';
            viral_mag_dynamic_css('viral_mag_th_bg_color', css);
        });
    });

    wp.customize('viral_mag_th_bottom_border_color', function (value) {
        value.bind(function (to) {
            if (to) {
                var css = '.vm-site-header .vm-top-header{border-bottom:1px solid ' + to + '}';
            } else {
                var css = '.vm-site-header .vm-top-header{border-bottom:none}';
            }
            viral_mag_dynamic_css('viral_mag_th_bottom_border_color', css);
        });
    });

    wp.customize('viral_mag_th_text_color', function (value) {
        value.bind(function (to) {
            var css = '.vm-site-header .vm-top-header{color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_th_text_color', css);
        });
    });

    wp.customize('viral_mag_th_anchor_color', function (value) {
        value.bind(function (to) {
            var css = '.vm-site-header .vm-top-header a,.vm-site-header .vm-top-header a:hover,.vm-site-header .vm-top-header a i,.vm-site-header .vm-top-header a:hover i{color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_th_anchor_color', css);
        });
    });

    wp.customize('viral_mag_th_height', function (value) {
        value.bind(function (to) {
            var mainHeaderHeight = wp.customize('viral_mag_mh_height').get();
            var mainHeaderHalfHeight = parseInt(mainHeaderHeight / 2);
            var header6_height = parseInt(to) + mainHeaderHalfHeight;

            var css = '.vm-site-header .vm-top-header .vm-container{height:' + to + 'px}';
            css += '.th-menu > ul > li > a{line-height: ' + to + 'px;}';
            css += '.vm-header-six.vm-site-header .vm-top-header{height: ' + header6_height + 'px;}';

            viral_mag_dynamic_css('viral_mag_th_height', css);
        });
    });

    wp.customize('viral_mag_th_disable_mobile', function (value) {
        value.bind(function (to) {
            if (to) {
                $(' #vm-masthead').addClass('vm-topheader-mobile-disable');
            } else {
                $(' #vm-masthead').removeClass('vm-topheader-mobile-disable');
            }
        });
    });

    wp.customize('viral_mag_mh_bg_color_mobile', function (value) {
        value.bind(function (to) {
            var responsiveWidth = wp.customize('viral_mag_responsive_width').get();
            var css = '@media screen and (max-width:' + responsiveWidth + 'px){';
            css += '.vm-header-one .vm-header, .vm-header-two .vm-header .vm-main-navigation, .vm-header-three .vm-header .vm-container, .vm-header-four .vm-header .vm-container, .vm-header-five .vm-main-navigation,.vm-header-six .vm-header .vm-container,.vm-header-seven .vm-header{background:' + to + '}';
            css += '}';
            viral_mag_dynamic_css('viral_mag_mh_bg_color_mobile', css);
        });
    });

    wp.customize('viral_mag_mh_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.vm-header-one .vm-header,.vm-header-two .vm-header,.vm-header-three .vm-header,.vm-header-four .vm-header .vm-container,.vm-header-five .vm-header,.vm-header-six .vm-header .vm-container,.vm-header-seven .vm-header,.vm-sticky-header .vm-header-four .vm-header.headroom.headroom--not-top,.vm-sticky-header .vm-header-six .vm-header.headroom.headroom--not-top{background:' + to + '}';
            viral_mag_dynamic_css('viral_mag_mh_bg_color', css);
        });
    });

    wp.customize('viral_mag_mh_height', function (value) {
        value.bind(function (to) {
            var viral_mag_mh_height = parseInt(to);
            var viral_mag_th_height = wp.customize('viral_mag_th_height').get();
            var viral_mag_mh_half_height = viral_mag_mh_height / 2;
            var viral_mag_header6_height = viral_mag_mh_half_height + parseInt(viral_mag_th_height);
            var viral_mag_header6_single_bottom_margin = 40 - viral_mag_mh_half_height;
            var viral_mag_logo_height = viral_mag_mh_height - 30;

            var responsive_width = wp.customize('viral_mag_responsive_width').get();
            var logo_actual_height = wp.customize('viral_mag_logo_height').get();
            var min_logo_height = Math.min(parseInt(viral_mag_logo_height), parseInt(logo_actual_height));

            var css = '.vm-header-one .vm-header .vm-container,.vm-header-two .vm-header .vm-container,.vm-header-three .vm-header .vm-container,.vm-header-four .vm-header .vm-container,.vm-header-five .vm-header .vm-container,.vm-header-six .vm-header .vm-container,.vm-header-seven .vm-header .vm-container{height:' + to + 'px}';
            css += '.hover-style5 .vm-menu > ul > li.menu-item > a,.hover-style6 .vm-menu > ul > li.menu-item > a,.hover-style5 .vm-header-bttn,.hover-style6 .vm-header-bttn{line-height:' + to + 'px}';
            css += '.vm-top-header-on.vm-single-layout3 .vm-header-six.vm-site-header,.vm-top-header-on.vm-single-layout4 .vm-header-six.vm-site-header,.vm-top-header-on.vm-single-layout5 .vm-header-six.vm-site-header,.vm-top-header-on.vm-single-layout6 .vm-header-six.vm-site-header{margin-bottom: -' + to + 'px;}';
            css += '.vm-top-header-on .vm-header-six.vm-site-header{margin-bottom: -' + viral_mag_mh_half_height + 'px;}';
            css += '.vm-header-six.vm-site-header .vm-top-header{height:' + viral_mag_header6_height + 'px}'
            css += '.vm-top-header-on.vm-single-layout1 .vm-header-six.vm-site-header,.vm-top-header-on.vm-single-layout2 .vm-header-six.vm-site-header,.vm-top-header-on.vm-single-layout7 .vm-header-six.vm-site-header{margin-bottom: ' + viral_mag_header6_single_bottom_margin + 'px;}';

            css += '.vm-header-one  #vm-site-branding img,.vm-header-three  #vm-site-branding img,.vm-header-six  #vm-site-branding img{max-height:' + viral_mag_logo_height + 'px;}';
            css += '@media screen and (max-width:' + responsive_width + 'px){.vm-header-one  #vm-site-branding img,.vm-header-three  #vm-site-branding img,.vm-header-six  #vm-site-branding img{height: auto;max-height: ' + min_logo_height + 'px}}';
            viral_mag_dynamic_css('viral_mag_mh_height', css);
        });
    });

    wp.customize('viral_mag_logo_height', function (value) {
        value.bind(function (to) {
            var responsive_width = wp.customize('viral_mag_responsive_width').get();
            var header_height = wp.customize('viral_mag_mh_height').get();
            var logo_height = parseInt(header_height) - 30;
            var min_logo_height = Math.min(parseInt(logo_height), parseInt(to));
            var css = ' #vm-site-branding img{height:' + to + 'px}';
            css += '@media screen and (max-width:' + responsive_width + 'px){.vm-header-one  #vm-site-branding img,.vm-header-three  #vm-site-branding img,.vm-header-six  #vm-site-branding img{height: auto;max-height: ' + min_logo_height + 'px}';
            css += '.vm-header-two  #vm-site-branding img, .vm-header-four  #vm-site-branding img, .vm-header-five  #vm-site-branding img, .vm-header-seven  #vm-site-branding img{height: auto;max-height: ' + to + 'px;}}';
            viral_mag_dynamic_css('viral_mag_logo_height', css);
        });
    });

    wp.customize('viral_mag_logo_padding', function (value) {
        value.bind(function (to) {
            var css = '.vm-header-two  #vm-site-branding, .vm-header-four  #vm-site-branding, .vm-header-five  #vm-site-branding, .vm-header-seven  #vm-site-branding{padding-top:' + to + 'px;padding-bottom:' + to + 'px}';
            viral_mag_dynamic_css('viral_mag_logo_padding', css);
        });
    });

    wp.customize('viral_mag_mh_border', function (value) {
        value.bind(function (to) {
            $(' #vm-masthead').removeClass('vm-no-border vm-top-border vm-bottom-border vm-top-bottom-border').addClass(to);
        });
    });

    wp.customize('viral_mag_mh_border_color', function (value) {
        value.bind(function (to) {
            var css = '.vm-site-header.vm-header-one .vm-header,.vm-site-header.vm-header-two .vm-header,.vm-site-header.vm-header-three .vm-header,.vm-site-header.vm-header-four .vm-header .vm-container,.vm-site-header.vm-header-five .vm-header,.vm-site-header.vm-header-six .vm-header .vm-container,.vm-site-header.vm-header-seven .vm-header{border-color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_mh_border_color', css);
        });
    });

    wp.customize('viral_mag_mh_button_color', function (value) {
        value.bind(function (to) {
            var css = '.vm-header-two .vm-middle-header-left a, .vm-header-two .vm-middle-header-right>div>a{color:' + to + ' !important}';
            css += '.vm-header-two .vm-offcanvas-nav a>span{background:' + to + ' !important}';
            viral_mag_dynamic_css('viral_mag_mh_button_color', css);
        });
    });

    wp.customize('viral_mag_mh_header_bg_url', function (value) {
        value.bind(function (to) {
            var css = '.vm-header-two .vm-middle-header, .vm-header-seven .vm-middle-header{background-image:url(' + to + ')}';
            viral_mag_dynamic_css('viral_mag_mh_header_bg_url', css);
        });
    });

    wp.customize('viral_mag_mh_header_bg_repeat', function (value) {
        value.bind(function (to) {
            var css = '.vm-header-two .vm-middle-header, .vm-header-seven .vm-middle-header{background-repeat:' + to + '}';
            viral_mag_dynamic_css('viral_mag_mh_header_bg_repeat', css);
        });
    });

    wp.customize('viral_mag_mh_header_bg_size', function (value) {
        value.bind(function (to) {
            var css = '.vm-header-two .vm-middle-header, .vm-header-seven .vm-middle-header{background-size:' + to + '}';
            viral_mag_dynamic_css('viral_mag_mh_header_bg_size', css);
        });
    });

    wp.customize('viral_mag_mh_header_bg_position', function (value) {
        value.bind(function (to) {
            to = to.replace('-', ' ');
            var css = '.vm-header-two .vm-middle-header, .vm-header-seven .vm-middle-header{background-position:' + to + '}';
            viral_mag_dynamic_css('viral_mag_mh_header_bg_position', css);
        });
    });

    wp.customize('viral_mag_mh_header_bg_attach', function (value) {
        value.bind(function (to) {
            var css = '.vm-header-two .vm-middle-header, .vm-header-seven .vm-middle-header{background-attachment:' + to + '}';
            viral_mag_dynamic_css('viral_mag_mh_header_bg_attach', css);
        });
    });

    wp.customize('viral_mag_mh_menu_color', function (value) {
        value.bind(function (to) {
            var css = '.vm-menu > ul > li.menu-item > a,.vm-search-button a,.vm-header-social-icons a,.hover-style1 .vm-search-button a:hover,.hover-style3 .vm-search-button a:hover,.hover-style5 .vm-search-button a:hover,.hover-style1 .vm-header-social-icons a:hover,.hover-style3 .vm-header-social-icons a:hover,.hover-style5 .vm-header-social-icons a:hover{color:' + to + '}';
            css += '.vm-offcanvas-nav a>span,.hover-style1 .vm-offcanvas-nav a:hover>span,.hover-style3 .vm-offcanvas-nav a:hover>span,.hover-style5 .vm-offcanvas-nav a:hover>span{background-color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_mh_menu_color', css);
        });
    });

    wp.customize('viral_mag_mh_menu_hover_color', function (value) {
        value.bind(function (to) {
            var css = '.vm-search-button a:hover,.vm-header-social-icons a:hover,.hover-style1 .vm-menu > ul> li.menu-item:hover > a,.hover-style1 .vm-menu > ul> li.menu-item.current_page_item > a, .hover-style1 .vm-menu > ul > li.menu-item.current-menu-item > a,.vm-menu > ul > li.menu-item:hover > a,.vm-menu > ul > li.menu-item:hover > a > i,.vm-menu > ul > li.menu-item.current_page_item > a,.vm-menu > ul > li.menu-item.current-menu-item > a,.vm-menu > ul > li.menu-item.current_page_ancestor > a,.vm-menu > ul > li.menu-item.current > a{color:' + to + '}';
            css += '.hover-style2 .vm-menu > ul > li.menu-item:hover > a,.hover-style2 .vm-menu > ul > li.menu-item.current_page_item > a,.hover-style2 .vm-menu > ul > li.menu-item.current-menu-item > a,.hover-style2 .vm-menu > ul > li.menu-item.current_page_ancestor > a,.hover-style2 .vm-menu > ul > li.menu-item.current > a,.hover-style4 .vm-menu > ul > li.menu-item:hover > a,.hover-style4 .vm-menu > ul > li.menu-item.current_page_item > a,.hover-style4 .vm-menu > ul > li.menu-item.current-menu-item > a,.hover-style4 .vm-menu > ul > li.menu-item.current_page_ancestor > a,.hover-style4 .vm-menu > ul > li.menu-item.current > a{color:' + to + ';border-color:' + to + '}'
            css += '.hover-style6 .vm-menu > ul > li.menu-item:hover > a:before,.hover-style6 .vm-menu > ul > li.menu-item.current_page_item > a:before,.hover-style6 .vm-menu > ul > li.menu-item.current-menu-item > a:before,.hover-style6 .vm-menu > ul > li.menu-item.current_page_ancestor > a:before,.hover-style6 .vm-menu > ul > li.menu-item.current > a:before,.hover-style8 .vm-menu>ul>li.menu-item>a:before, .hover-style9 .vm-menu>ul>li.menu-item>a:before{background:' + to + '}';
            css += '.hover-style7 .vm-menu>ul>li.menu-item>a:before{border-left-color:' + to + ';border-top-color:' + to + '}';
            css += '.hover-style7 .vm-menu>ul>li.menu-item>a:after{border-right-color:' + to + ';border-bottom-color:' + to + '}';
            css += '.vm-offcanvas-nav a:hover>span{background-color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_mh_menu_hover_color', css);
        });
    });

    wp.customize('viral_mag_mh_menu_hover_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.hover-style1 .vm-menu>ul>li.menu-item:hover>a,.hover-style1 .vm-menu>ul>li.menu-item.current_page_item>a,.hover-style1 .vm-menu>ul>li.menu-item.current-menu-item>a,.hover-style1 .vm-menu>ul>li.menu-item.current_page_ancestor>a,.hover-style1 .vm-menu>ul>li.menu-item.current>a,.hover-style5 .vm-menu>ul>li.menu-item:hover>a,.hover-style5 .vm-menu>ul>li.menu-item.current_page_item>a,.hover-style5 .vm-menu>ul>li.menu-item.current-menu-item>a,.hover-style5 .vm-menu>ul>li.menu-item.current_page_ancestor>a,.hover-style5 .vm-menu>ul>li.menu-item.current>a,.hover-style3 .vm-menu>ul>li.menu-item:hover>a,.hover-style3 .vm-menu>ul>li.menu-item.current_page_item>a,.hover-style3 .vm-menu>ul>li.menu-item.current-menu-item>a,.hover-style3 .vm-menu>ul>li.menu-item.current_page_ancestor>a,.hover-style3 .vm-menu>ul>li.menu-item.current>a{background:' + to + '}';
            viral_mag_dynamic_css('viral_mag_mh_menu_hover_bg_color', css);
        });
    });

    wp.customize('viral_mag_mh_submenu_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.vm-menu ul ul,.menu-item-vm-cart .widget_shopping_cart, #vm-responsive-menu{background:' + to + '}';
            viral_mag_dynamic_css('viral_mag_mh_submenu_bg_color', css);
        });
    });

    wp.customize('viral_mag_mh_submenu_color', function (value) {
        value.bind(function (to) {
            var css = '.vm-menu .megamenu *, #vm-responsive-menu .megamenu *,.vm-menu .megamenu a, #vm-responsive-menu .megamenu a,.vm-menu ul ul li.menu-item>a,.menu-item-vm-cart .widget_shopping_cart a,.menu-item-vm-cart .widget_shopping_cart, #vm-responsive-menu li.menu-item>a, #vm-responsive-menu li.menu-item>a i, #vm-responsive-menu li .dropdown-nav,.megamenu-category .mega-post-title a{color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_mh_submenu_color', css);
        });
    });

    wp.customize('viral_mag_mh_submenu_hover_color', function (value) {
        value.bind(function (to) {
            var css = '.vm-menu .megamenu a:hover, #vm-responsive-menu .megamenu a:hover,.vm-menu .megamenu a:hover>i, #vm-responsive-menu .megamenu a:hover>i,.vm-menu>ul>li>ul:not(.megamenu) li.menu-item:hover>a,.vm-menu ul ul.megamenu li.menu-item>a:hover,.vm-menu ul ul li.menu-item>a:hover i,.menu-item-vm-cart .widget_shopping_cart a:hover,.vm-menu .megamenu-full-width.megamenu-category .cat-megamenu-tab>div.active-tab,.vm-menu .megamenu-full-width.megamenu-category .mega-post-title a:hover{color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_mh_submenu_hover_color', css);
        });
    });

    wp.customize('viral_mag_mh_menu_hover_style', function (value) {
        value.bind(function (to) {
            $(' #vm-masthead').removeClass('hover-style1 hover-style2 hover-style3 hover-style4 hover-style5 hover-style6 hover-style7 hover-style8 hover-style9 hover-style10').addClass(to);
        });
    });

    wp.customize('viral_mag_menu_dropdown_padding', function (value) {
        value.bind(function (to) {
            var css = '.vm-menu>ul>li.menu-item{padding-top:' + to + 'px;padding-bottom:' + to + 'px}';
            viral_mag_dynamic_css('viral_mag_menu_dropdown_padding', css);
        });
    });

    wp.customize('viral_mag_hb_text', function (value) {
        value.bind(function (to) {
            $('.vm-header-bttn').text(to);
        });
    });

    wp.customize('viral_mag_hb_link', function (value) {
        value.bind(function (to) {
            $('.vm-header-bttn').attr('href', to);
        });
    });

    wp.customize('viral_mag_hb_text_color', function (value) {
        value.bind(function (to) {
            var css = 'a.vm-header-bttn{color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_hb_text_color', css);
        });
    });

    wp.customize('viral_mag_hb_text_hov_color', function (value) {
        value.bind(function (to) {
            var css = 'a.vm-header-bttn:hover{color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_hb_text_hov_color', css);
        });
    });

    wp.customize('viral_mag_hb_bg_color', function (value) {
        value.bind(function (to) {
            var css = 'a.vm-header-bttn{background:' + to + '}';
            viral_mag_dynamic_css('viral_mag_hb_bg_color', css);
        });
    });

    wp.customize('viral_mag_hb_bg_hov_color', function (value) {
        value.bind(function (to) {
            var css = 'a.vm-header-bttn:hover{background:' + to + '}';
            viral_mag_dynamic_css('viral_mag_hb_bg_hov_color', css);
        });
    });

    wp.customize('viral_mag_hb_borderradius', function (value) {
        value.bind(function (to) {
            var css = 'a.vm-header-bttn{border-radius:' + to + 'px}';
            viral_mag_dynamic_css('viral_mag_hb_borderradius', css);
        });
    });

    wp.customize('viral_mag_hb_disable_mobile', function (value) {
        value.bind(function (to) {
            if (to) {
                $('.vm-header-bttn').addClass('vm-mobile-hide');
            } else {
                $('.vm-header-bttn').removeClass('vm-mobile-hide');
            }
        });
    });

    wp.customize('viral_mag_footer_bg_url', function (value) {
        value.bind(function (to) {
            var css = ' #vm-colophon{background-image:url(' + to + ')}';
            viral_mag_dynamic_css('viral_mag_footer_bg_url', css);
        });
    });

    wp.customize('viral_mag_footer_bg_repeat', function (value) {
        value.bind(function (to) {
            var css = ' #vm-colophon{background-repeat:' + to + '}';
            viral_mag_dynamic_css('viral_mag_footer_bg_repeat', css);
        });
    });

    wp.customize('viral_mag_footer_bg_size', function (value) {
        value.bind(function (to) {
            var css = ' #vm-colophon{background-size:' + to + '}';
            viral_mag_dynamic_css('viral_mag_footer_bg_size', css);
        });
    });

    wp.customize('viral_mag_footer_bg_position', function (value) {
        value.bind(function (to) {
            to = to.replace('-', ' ');
            var css = ' #vm-colophon{background-position:' + to + '}';
            viral_mag_dynamic_css('viral_mag_footer_bg_position', css);
        });
    });

    wp.customize('viral_mag_footer_bg_attach', function (value) {
        value.bind(function (to) {
            var css = ' #vm-colophon{background-attachment:' + to + '}';
            viral_mag_dynamic_css('viral_mag_footer_bg_attach', css);
        });
    });

    wp.customize('viral_mag_footer_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.vm-site-footer:before{background-color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_footer_bg_color', css);
        });
    });

    wp.customize('viral_mag_footer_title_color', function (value) {
        value.bind(function (to) {
            var lightBorderColor = viral_mag_convert_hex(to, 20);
            var css = ' #vm-colophon .widget-title{color:' + to + '}';
            css += '.vm-sidebar-style1 .vm-site-footer .widget-title:after,.vm-sidebar-style3 .vm-site-footer .widget-title:after, .vm-sidebar-style6 .vm-site-footer .widget-title:after{background-color:' + to + '}';
            css += '.vm-sidebar-style2 .vm-site-footer .widget-title, .vm-sidebar-style7 .vm-site-footer .widget-title{border-color:' + lightBorderColor + '}';
            css += '.vm-sidebar-style5 .vm-site-footer .widget-title:before, .vm-sidebar-style5 .vm-site-footer .widget-title:after{background-color:' + lightBorderColor + '}';
            viral_mag_dynamic_css('viral_mag_footer_title_color', css);
        });
    });

    wp.customize('viral_mag_footer_text_color', function (value) {
        value.bind(function (to) {
            var css = '.vm-site-footer *{color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_footer_text_color', css);
        });
    });

    wp.customize('viral_mag_footer_anchor_color', function (value) {
        value.bind(function (to) {
            var css = '.vm-site-footer a,.vm-site-footer a *{color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_footer_anchor_color', css);
        });
    });

    wp.customize('viral_mag_footer_border_color', function (value) {
        value.bind(function (to) {
            var css = '.vm-top-footer .vm-container,.vm-main-footer .vm-container,.vm-bottom-top-footer .vm-container{border-color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_footer_border_color', css);
        });
    });

    wp.customize('viral_mag_footer_copyright', function (value) {
        value.bind(function (to) {
            $('.vm-site-info').html(to);
        });
    });

    wp.customize('viral_mag_gdpr_position', function (value) {
        value.bind(function (to) {
            $('.viral-mag-privacy-policy').removeClass('top-full-width bottom-full-width bottom-left-float bottom-right-float').addClass(to);
        });
    });

    wp.customize('viral_mag_gdpr_bg', function (value) {
        value.bind(function (to) {
            var css = '.viral-mag-privacy-policy{background:' + to + '}';
            viral_mag_dynamic_css('viral_mag_gdpr_bg', css);
        });
    });

    wp.customize('viral_mag_gdpr_notice', function (value) {
        value.bind(function (to) {
            $('.policy-text').html(to);
        });
    });

    wp.customize('viral_mag_gdpr_confirm_button_text', function (value) {
        value.bind(function (to) {
            $('#viral-mag-confirm').text(to);
        });
    });

    wp.customize('viral_mag_gdpr_text_color', function (value) {
        value.bind(function (to) {
            var css = '.viral-mag-privacy-policy, .policy-text a{color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_gdpr_text_color', css);
        });
    });

    wp.customize('viral_mag_button_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.policy-buttons a,.policy-buttons a:hover{background:' + to + '}';
            viral_mag_dynamic_css('viral_mag_button_bg_color', css);
        });
    });

    wp.customize('viral_mag_button_text_color', function (value) {
        value.bind(function (to) {
            var css = '.policy-buttons a,.policy-buttons a:hover{color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_button_text_color', css);
        });
    });

    wp.customize('viral_mag_gdpr_hide_mobile', function (value) {
        value.bind(function (to) {
            if (to) {
                $('.viral-mag-privacy-policy').addClass('policy-hide-mobile');
            } else {
                $('.viral-mag-privacy-policy').removeClass('policy-hide-mobile');
            }
        });
    });

    wp.customize('viral_mag_enable_gdpr', function (value) {
        value.bind(function (to) {
            if ('off' == to) {
                var css = '.customizer-gdpr-section .viral-mag-privacy-policy{display:none !important}';
            } else {
                var css = '.customizer-gdpr-section .viral-mag-privacy-policy{display:block !important}';
            }

            viral_mag_dynamic_css('viral_mag_enable_gdpr', css);
        });
    });

    var settingIds = ['ticker', 'slider1', 'slider2', 'featured', 'tile1', 'tile2', 'mininews', 'leftnews', 'rightnews', 'fwcarousel', 'carousel1', 'carousel2', 'video', 'fwnews1', 'fwnews2', 'threecol'];

    $.each(settingIds, function (i, settingId) {
        wp.customize('viral_mag_' + settingId + '_overwrite_block_title_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';
                if (to) {
                    $(sectionClass).addClass('vm-overwrite-color');
                } else {
                    $(sectionClass).removeClass('vm-overwrite-color');
                }
            });
        });

        wp.customize('viral_mag_' + settingId + '_enable_fullwindow', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';
                if ('on' == to) {
                    var css = sectionClass + ' .vm-section-wrap{min-height:100vh;display: -webkit-flex;display: -ms-flexbox;display: flex;overflow: hidden;flex-wrap: wrap}';
                } else {
                    var css = sectionClass + ' .vm-section-wrap{min-height:0;display:block;overflow:visible;}';
                }
                viral_mag_dynamic_css('viral_mag_' + settingId + '_enable_fullwindow', css);

                if (settingId == 'contact' && to == 'on') {
                    $('.vm-contact-section').addClass('vm-window-height');
                } else if (settingId == 'contact' && to == 'off') {
                    $('.vm-contact-section').removeClass('vm-window-height');
                }
            });
        });

        wp.customize('viral_mag_' + settingId + '_align_item', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';
                var styles;
                if (to == 'top') {
                    styles = "align-items: flex-start";
                } else if (to == 'middle') {
                    styles = "align-items: center";
                } else if (to == 'bottom') {
                    styles = "align-items: flex-end";
                } else {
                    styles = "align-items: normal";
                }

                var css = sectionClass + ' .vm-section-wrap{' + styles + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_align_item', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_bg_type', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';
                if ('color-bg' == to) {
                    var color = wp.customize('viral_mag_' + settingId + '_bg_color').get();
                    var css = sectionClass + '{background-color:' + color + '}';
                    viral_mag_dynamic_css('viral_mag_' + settingId + '_bg_color', css);

                    var css = sectionClass + ' .vm-section-wrap{background-color:transparent}';
                    viral_mag_dynamic_css('viral_mag_' + settingId + '_overlay_color', css);

                    var css = sectionClass + '{background-image:none}';
                    viral_mag_dynamic_css('viral_mag_' + settingId + '_bg_image_url', css);

                } else if ('image-bg' == to) {
                    var image = wp.customize('viral_mag_' + settingId + '_bg_image_url').get();
                    var css = sectionClass + '{background-image:url(' + image + ')}';
                    viral_mag_dynamic_css('viral_mag_' + settingId + '_bg_image_url', css);

                    var image_repeat = wp.customize('viral_mag_' + settingId + '_bg_image_repeat').get();
                    var css = sectionClass + '{background-repeat:' + image_repeat + '}';
                    viral_mag_dynamic_css('viral_mag_' + settingId + '_bg_image_repeat', css);

                    var image_size = wp.customize('viral_mag_' + settingId + '_bg_image_size').get();
                    var css = sectionClass + '{background-size:' + image_size + '}';
                    viral_mag_dynamic_css('viral_mag_' + settingId + '_bg_image_size', css);

                    var image_position = wp.customize('viral_mag_' + settingId + '_bg_position').get();
                    image_position = image_position.replace('-', ' ');
                    var css = sectionClass + '{background-position:' + image_position + '}';
                    viral_mag_dynamic_css('viral_mag_' + settingId + '_bg_position', css);

                    var image_attach = wp.customize('viral_mag_' + settingId + '_bg_image_attach').get();
                    var css = sectionClass + '{background-attachment:' + image_attach + '}';
                    viral_mag_dynamic_css('viral_mag_' + settingId + '_bg_image_attach', css);

                    var color = wp.customize('viral_mag_' + settingId + '_bg_color').get();
                    var css = sectionClass + '{background-color:' + color + '}';
                    viral_mag_dynamic_css('viral_mag_' + settingId + '_bg_color', css);

                    var color_overlay = wp.customize('viral_mag_' + settingId + '_overlay_color').get();
                    var css = sectionClass + ' .vm-section-wrap{background-color:' + color_overlay + '}';
                    viral_mag_dynamic_css('viral_mag_' + settingId + '_overlay_color', css);
                } else if ('gradient-bg' == to) {
                    var gradient = wp.customize('viral_mag_' + settingId + '_bg_gradient').get();
                    var css = sectionClass + '{' + gradient + '}';
                    viral_mag_dynamic_css('viral_mag_' + settingId + '_bg_gradient', css);

                    var css = sectionClass + ' .vm-section-wrap{background-color:transparent}';
                    viral_mag_dynamic_css('viral_mag_' + settingId + '_overlay_color', css);

                } else if ('video-bg' == to) {
                    wp.customize.preview.send('refresh');
                }
            });
        });

        wp.customize('viral_mag_' + settingId + '_bg_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';
                var css = sectionClass + '{background-color:' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_bg_color', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_bg_image_url', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';
                var css = sectionClass + '{background-image:url(' + to + ')}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_bg_image_url', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_bg_image_repeat', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';
                var css = sectionClass + '{background-repeat:' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_bg_image_repeat', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_bg_image_size', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';
                var css = sectionClass + '{background-size:' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_bg_image_size', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_bg_position', function (value) {
            value.bind(function (to) {
                to = to.replace('-', ' ');
                var sectionClass = '.vm-' + settingId + '-section';
                var css = sectionClass + '{background-position:' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_bg_position', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_bg_image_attach', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';
                var css = sectionClass + '{background-attachment:' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_bg_image_attach', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_bg_gradient', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';
                var css = sectionClass + '{' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_bg_gradient', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_overlay_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';
                var css = sectionClass + ' .vm-section-wrap{background-color:' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_overlay_color', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_title_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';
                var css = sectionClass + ' h1, ' + sectionClass + ' h2, ' + sectionClass + ' h3, ' + sectionClass + ' h4, ' + sectionClass + ' h5, ' + sectionClass + ' h6{color:' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_title_color', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_text_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';
                var css = sectionClass + ' .vm-section-wrap{color:' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_text_color', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_link_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';
                var css = sectionClass + ' a{color:' + to + '}';
                if (settingId == "carousel1" || settingId == "carousel2") {
                    css += sectionClass + '.vm-carousel-block.style1.vm-carousel-heading.vm-primary-cat,' + sectionClass + '.vm-carousel-block.style3.vm-carousel-heading.vm-primary-cat{color:' + to + '}';
                }
                viral_mag_dynamic_css('viral_mag_' + settingId + '_link_color', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_block_title_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';
                var css = sectionClass + '.vm-overwrite-color.vm-block-title span.vm-title{color:' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_block_title_color', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_block_title_background_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';
                var css = '.vm-block-title-style2 ' + sectionClass + '.vm-overwrite-color.vm-block-title:after, .vm-block-title-style5 ' + sectionClass + '.vm-overwrite-color.vm-block-title span.vm-title:before, .vm-block-title-style7 ' + sectionClass + '.vm-overwrite-color.vm-block-title span.vm-title, .vm-block-title-style8 ' + sectionClass + '.vm-overwrite-color.vm-block-title span.vm-title, .vm-block-title-style9 ' + sectionClass + '.vm-overwrite-color.vm-block-title span.vm-title, .vm-block-title-style9 ' + sectionClass + '.vm-overwrite-color.vm-block-title span.vm-title:before, .vm-block-title-style10 ' + sectionClass + '.vm-overwrite-color.vm-block-title, .vm-block-title-style11 ' + sectionClass + '.vm-overwrite-color.vm-block-title span.vm-title, .vm-block-title-style12 ' + sectionClass + '.vm-overwrite-color.vm-block-title{background-color:' + to + '}';
                css += '.vm-block-title-style8 ' + sectionClass + '.vm-overwrite-color.vm-block-title, .vm-block-title-style9 ' + sectionClass + '.vm-overwrite-color.vm-block-title, .vm-block-title-style11 ' + sectionClass + '.vm-overwrite-color.vm-block-title{border-color:' + to + '}';
                css += '.vm-block-title-style10 ' + sectionClass + '.vm-overwrite-color.vm-block-title:before{border-color:' + to + ' ' + to + ' transparent transparent}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_block_title_background_color', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_block_title_border_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';
                var css = '.vm-block-title-style2 ' + sectionClass + '.vm-overwrite-color.vm-block-title, .vm-block-title-style3 ' + sectionClass + '.vm-overwrite-color.vm-block-title, .vm-block-title-style5 ' + sectionClass + '.vm-overwrite-color.vm-block-title{border-color:' + to + '}';
                css += '.vm-block-title-style4 ' + sectionClass + '.vm-overwrite-color.vm-block-title:after, .vm-block-title-style6 ' + sectionClass + '.vm-overwrite-color.vm-block-title:before, .vm-block-title-style6 ' + sectionClass + '.vm-overwrite-color.vm-block-title:after, .vm-block-title-style7 ' + sectionClass + '.vm-overwrite-color.vm-block-title:after{background-color:' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_block_title_border_color', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_padding_top', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';

                if (to) {
                    var desktop = to;
                } else {
                    var desktop = 0;
                }

                var tablet = wp.customize('viral_mag_' + settingId + '_tablet_padding_top').get();
                var mobile = wp.customize('viral_mag_' + settingId + '_mobile_padding_top').get();

                var css = sectionClass + ' .vm-section-wrap{padding-top:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .vm-section-wrap{padding-top:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .vm-section-wrap{padding-top:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_padding_top', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_tablet_padding_top', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';

                var desktop = wp.customize('viral_mag_' + settingId + '_padding_top').get();
                if (to) {
                    var tablet = to;
                } else {
                    var tablet = 0;
                }
                var mobile = wp.customize('viral_mag_' + settingId + '_mobile_padding_top').get();

                var css = sectionClass + ' .vm-section-wrap{padding-top:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .vm-section-wrap{padding-top:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .vm-section-wrap{padding-top:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_padding_top', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_mobile_padding_top', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';

                var desktop = wp.customize('viral_mag_' + settingId + '_padding_top').get();
                var tablet = wp.customize('viral_mag_' + settingId + '_tablet_padding_top').get();
                if (to) {
                    var mobile = to;
                } else {
                    var mobile = 0;
                }

                var css = sectionClass + ' .vm-section-wrap{padding-top:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .vm-section-wrap{padding-top:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .vm-section-wrap{padding-top:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_padding_top', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_padding_bottom', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';

                if (to) {
                    var desktop = to;
                } else {
                    var desktop = 0;
                }
                var tablet = wp.customize('viral_mag_' + settingId + '_tablet_padding_bottom').get();
                var mobile = wp.customize('viral_mag_' + settingId + '_mobile_padding_bottom').get();

                var css = sectionClass + ' .vm-section-wrap{padding-bottom:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .vm-section-wrap{padding-bottom:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .vm-section-wrap{padding-bottom:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_padding_bottom', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_tablet_padding_bottom', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';

                var desktop = wp.customize('viral_mag_' + settingId + '_padding_bottom').get();
                if (to) {
                    var tablet = to;
                } else {
                    var tablet = 0;
                }
                var mobile = wp.customize('viral_mag_' + settingId + '_mobile_padding_bottom').get();

                var css = sectionClass + ' .vm-section-wrap{padding-bottom:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .vm-section-wrap{padding-bottom:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .vm-section-wrap{padding-bottom:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_padding_bottom', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_mobile_padding_bottom', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';

                var desktop = wp.customize('viral_mag_' + settingId + '_padding_bottom').get();
                var tablet = wp.customize('viral_mag_' + settingId + '_tablet_padding_bottom').get();
                if (to) {
                    var mobile = to;
                } else {
                    var mobile = 0;
                }

                var css = sectionClass + ' .vm-section-wrap{padding-bottom:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .vm-section-wrap{padding-bottom:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .vm-section-wrap{padding-bottom:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_padding_bottom', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_margin_top', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';

                if (to) {
                    var desktop = to;
                } else {
                    var desktop = 0;
                }
                var tablet = wp.customize('viral_mag_' + settingId + '_tablet_margin_top').get();
                var mobile = wp.customize('viral_mag_' + settingId + '_mobile_margin_top').get();

                var css = sectionClass + ' .vm-section-wrap{margin-top:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .vm-section-wrap{margin-top:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .vm-section-wrap{margin-top:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_margin_top', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_tablet_margin_top', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';

                var desktop = wp.customize('viral_mag_' + settingId + '_margin_top').get();
                if (to) {
                    var tablet = to;
                } else {
                    var tablet = 0;
                }
                var mobile = wp.customize('viral_mag_' + settingId + '_mobile_margin_top').get();

                var css = sectionClass + ' .vm-section-wrap{margin-top:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .vm-section-wrap{margin-top:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .vm-section-wrap{margin-top:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_margin_top', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_mobile_margin_top', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';

                var desktop = wp.customize('viral_mag_' + settingId + '_margin_top').get();
                var tablet = wp.customize('viral_mag_' + settingId + '_tablet_margin_top').get();
                if (to) {
                    var mobile = to;
                } else {
                    var mobile = 0;
                }

                var css = sectionClass + ' .vm-section-wrap{margin-top:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .vm-section-wrap{margin-top:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .vm-section-wrap{margin-top:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_margin_top', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_margin_bottom', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';

                if (to) {
                    var desktop = to;
                } else {
                    var desktop = 0;
                }
                var tablet = wp.customize('viral_mag_' + settingId + '_tablet_margin_bottom').get();
                var mobile = wp.customize('viral_mag_' + settingId + '_mobile_margin_bottom').get();

                var css = sectionClass + ' .vm-section-wrap{margin-bottom:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .vm-section-wrap{margin-bottom:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .vm-section-wrap{margin-bottom:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_margin_bottom', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_tablet_margin_bottom', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';

                var desktop = wp.customize('viral_mag_' + settingId + '_margin_bottom').get();
                if (to) {
                    var tablet = to;
                } else {
                    var tablet = 0;
                }
                var mobile = wp.customize('viral_mag_' + settingId + '_mobile_margin_bottom').get();

                var css = sectionClass + ' .vm-section-wrap{margin-bottom:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .vm-section-wrap{margin-bottom:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .vm-section-wrap{margin-bottom:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_margin_bottom', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_mobile_margin_bottom', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';

                var desktop = wp.customize('viral_mag_' + settingId + '_margin_bottom').get();
                var tablet = wp.customize('viral_mag_' + settingId + '_tablet_margin_bottom').get();
                if (to) {
                    var mobile = to;
                } else {
                    var mobile = 0;
                }

                var css = sectionClass + ' .vm-section-wrap{margin-bottom:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .vm-section-wrap{margin-bottom:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .vm-section-wrap{margin-bottom:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_margin_bottom', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_ts_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';
                var css = sectionClass + ' .top-section-seperator svg{ fill:' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_ts_color', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_bs_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';
                var css = sectionClass + ' .bottom-section-seperator svg{ fill:' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_bs_color', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_ts_height', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';
                var desktop = to;
                var tablet = wp.customize('viral_mag_' + settingId + '_ts_height_tablet').get();
                var mobile = wp.customize('viral_mag_' + settingId + '_ts_height_mobile').get();

                var css = sectionClass + ' .vm-section-seperator.top-section-seperator{height:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .vm-section-seperator.top-section-seperator{height:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .vm-section-seperator.top-section-seperator{height:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_ts_height', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_ts_height_tablet', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';
                var desktop = wp.customize('viral_mag_' + settingId + '_ts_height').get();
                var tablet = to;
                var mobile = wp.customize('viral_mag_' + settingId + '_ts_height_mobile').get();

                var css = sectionClass + ' .vm-section-seperator.top-section-seperator{height:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .vm-section-seperator.top-section-seperator{height:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .vm-section-seperator.top-section-seperator{height:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_ts_height', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_ts_height_mobile', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';
                var desktop = wp.customize('viral_mag_' + settingId + '_ts_height').get();
                var tablet = wp.customize('viral_mag_' + settingId + '_ts_height_tablet').get();
                var mobile = to;

                var css = sectionClass + ' .vm-section-seperator.top-section-seperator{height:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .vm-section-seperator.top-section-seperator{height:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .vm-section-seperator.top-section-seperator{height:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_ts_height', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_bs_height', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';
                var desktop = to;
                var tablet = wp.customize('viral_mag_' + settingId + '_bs_height_tablet').get();
                var mobile = wp.customize('viral_mag_' + settingId + '_bs_height_mobile').get();

                var css = sectionClass + ' .vm-section-seperator.bottom-section-seperator{height:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .vm-section-seperator.bottom-section-seperator{height:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .vm-section-seperator.bottom-section-seperator{height:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_bs_height', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_bs_height_tablet', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';
                var desktop = wp.customize('viral_mag_' + settingId + '_bs_height').get();
                var tablet = to;
                var mobile = wp.customize('viral_mag_' + settingId + '_bs_height_mobile').get();

                var css = sectionClass + ' .vm-section-seperator.bottom-section-seperator{height:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .vm-section-seperator.bottom-section-seperator{height:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .vm-section-seperator.bottom-section-seperator{height:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_bs_height', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_bs_height_mobile', function (value) {
            value.bind(function (to) {
                var sectionClass = '.vm-' + settingId + '-section';
                var desktop = wp.customize('viral_mag_' + settingId + '_bs_height').get();
                var tablet = wp.customize('viral_mag_' + settingId + '_bs_height_tablet').get();
                var mobile = to;

                var css = sectionClass + ' .vm-section-seperator.bottom-section-seperator{height:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .vm-section-seperator.bottom-section-seperator{height:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .vm-section-seperator.bottom-section-seperator{height:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_bs_height', css);
            });
        });

    });

    wp.customize('viral_mag_content_header_color', function (value) {
        value.bind(function (to) {
            var css = ".vm-main-content h1, .vm-main-content h2, .vm-main-content h3, .vm-main-content h4, .vm-main-content h5, .vm-main-content h6, .vm-main-content .widget-title{color:" + to + "}";
            viral_mag_dynamic_css('viral_mag_content_header_color', css);
        });
    });

    wp.customize('viral_mag_content_text_color', function (value) {
        value.bind(function (to) {
            var lightColor = viral_mag_convert_hex(to, 10);
            var lighterColor = viral_mag_convert_hex(to, 50);
            var css = ".vm-main-content{color:" + to + "}";
            css += ".single-entry-tags a, .widget-area .tagcloud a{border-color:" + to + "}";
            css += ".vm-sidebar-style2 .vm-site-wrapper .widget, .vm-sidebar-style2 .vm-site-wrapper .widget-title, .vm-sidebar-style3 .vm-site-wrapper .widget, .vm-sidebar-style5 .vm-site-wrapper .widget, .vm-sidebar-style7 .vm-site-wrapper .widget, .vm-sidebar-style7 .vm-site-wrapper .widget-title, .comment-list .sp-comment-content, .post-navigation, .post-navigation .nav-next, .vm-social-share{border-color:" + lightColor + "}";
            css += ".vm-sidebar-style5 .vm-site-wrapper .widget-title:before, .vm-sidebar-style5 .vm-site-wrapper .widget-title:after{background-color:" + lightColor + "}";
            css += ".vm-sidebar-style3 .vm-site-wrapper .widget{background-color" + lighterColor + "}";
            viral_mag_dynamic_css('viral_mag_content_text_color', css);
        });
    });

    wp.customize('viral_mag_content_link_color', function (value) {
        value.bind(function (to) {
            var css = "a{color:" + to + "}";
            viral_mag_dynamic_css('viral_mag_content_link_color', css);
        });
    });

    wp.customize('viral_mag_content_link_hov_color', function (value) {
        value.bind(function (to) {
            var css = "a:hover, .woocommerce .woocommerce-breadcrumb a:hover, .breadcrumb-trail a:hover{color:" + to + "}";
            viral_mag_dynamic_css('viral_mag_content_link_hov_color', css);
        });
    });

    wp.customize('viral_mag_content_widget_title_color', function (value) {
        value.bind(function (to) {
            var css = ".vm-main-content .widget-title{color:" + to + "}";
            css += ".vm-sidebar-style1 .vm-site-wrapper .widget-title:after, .vm-sidebar-style3 .vm-site-wrapper .widget-title:after, .vm-sidebar-style6 .vm-site-wrapper .widget-title:after, .vm-sidebar-style7 .vm-site-wrapper .widget:before {background-color:" + to + "}";
            viral_mag_dynamic_css('viral_mag_content_widget_title_color', css);
        });
    });

    wp.customize('viral_mag_sidebar_style', function (value) {
        value.bind(function (to) {
            $('body').removeClass('vm-sidebar-style1 vm-sidebar-style2 vm-sidebar-style3 vm-sidebar-style4 vm-sidebar-style5 vm-sidebar-style6 vm-sidebar-style7 vm-sidebar-style8').addClass('vm-' + to);
        });
    });

    wp.customize('viral_mag_image_hover_effect', function (value) {
        value.bind(function (to) {
            $('body').removeClass('vm-thumb-no-effect vm-thumb-zoom-in vm-thumb-zoom-out vm-thumb-slide-left vm-thumb-slide-right vm-thumb-slide-top vm-thumb-slide-bottom vm-thumb-rotate-zoom-in vm-thumb-opacity vm-thumb-shine vm-thumb-circle').addClass('vm-thumb-' + to);
        });
    });

    wp.customize('viral_mag_block_title_style', function (value) {
        value.bind(function (to) {
            $('body').removeClass('vm-block-title-style1 vm-block-title-style2 vm-block-title-style3 vm-block-title-style4 vm-block-title-style5 vm-block-title-style6 vm-block-title-style7 vm-block-title-style8 vm-block-title-style9 vm-block-title-style10 vm-block-title-style11 vm-block-title-style12 vm-block-title-style13').addClass('vm-block-title-' + to);
        });
    });

    wp.customize('viral_mag_block_title_color', function (value) {
        value.bind(function (to) {
            var css = ".vm-block-title span.vm-title{color:" + to + "}";
            viral_mag_dynamic_css('viral_mag_block_title_color', css);
        });
    });

    wp.customize('viral_mag_block_title_background_color', function (value) {
        value.bind(function (to) {
            var css = ".vm-block-title-style2.vm-block-title:after, .vm-block-title-style5.vm-block-title span.vm-title:before, .vm-block-title-style7.vm-block-title span.vm-title, .vm-block-title-style8.vm-block-title span.vm-title, .vm-block-title-style9.vm-block-title span.vm-title, .vm-block-title-style9.vm-block-title span.vm-title:before, .vm-block-title-style10.vm-block-title, .vm-block-title-style11.vm-block-title span.vm-title, .vm-block-title-style12.vm-block-title{background-color:" + to + "}";
            css += ".vm-block-title-style8.vm-block-title, .vm-block-title-style9.vm-block-title, .vm-block-title-style11.vm-block-title {border-color:" + to + "}";
            css += ".vm-block-title-style10.vm-block-title:before {border-color:" + to + " " + to + " transparent transparent}";
            viral_mag_dynamic_css('viral_mag_block_title_background_color', css);
        });
    });

    wp.customize('viral_mag_block_title_border_color', function (value) {
        value.bind(function (to) {
            var css = ".vm-block-title-style2.vm-block-title, .vm-block-title-style3.vm-block-title, .vm-block-title-style5.vm-block-title{border-color:" + to + "}";
            css += ".vm-block-title-style4.vm-block-title:after, .vm-block-title-style6.vm-block-title:before, .vm-block-title-style6.vm-block-title:after, .vm-block-title-style7.vm-block-title:after {background-color:" + to + "}";
            viral_mag_dynamic_css('viral_mag_block_title_border_color', css);
        });
    });

    wp.customize('viral_mag_frontpage_section_spacing', function (value) {
        value.bind(function (to) {
            var featured_block_to = parseInt(to) - 30;
            var css = "#vm-video-playlist,.vm-bottom-block,.vm-carousel-block,.vm-fwcarousel-block,.vm-slider-block,.vm-news-block,.vm-ticker, .vm-mininews-section .vm-non-fullwidth-container, .vm-mininews-section .vm-fullwidth-container,.vm-fwnews-block,.vm-tile-block-wrap, .vm-section .widget{margin-bottom:" + to + "px}";
            css += ".vm-featured-block-wrap{margin-bottom:" + featured_block_to + "}";
            viral_mag_dynamic_css('viral_mag_frontpage_section_spacing', css);
        });
    });

    wp.customize('viral_mag_toggle_button_color', function (value) {
        value.bind(function (to) {
            var css = ".collapse-button{border-color:" + to + "}";
            css += ".collapse-button .icon-bar{background:" + to + "}";
            viral_mag_dynamic_css('viral_mag_toggle_button_color', css);
        });
    });
})(jQuery);