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
            $('.ht-site-title a').text(to);
        });
    });

    wp.customize('blogdescription', function (value) {
        value.bind(function (to) {
            $('.ht-site-description').text(to);
        });
    });

    wp.customize('viral_mag_tagline_position', function (value) {
        value.bind(function (to) {
            $('#ht-masthead').removeClass('ht-tagline-inline-logo ht-tagline-below-logo').addClass(to);
        });
    });

    wp.customize('viral_mag_title_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-site-title a, .ht-site-description, .ht-site-description a{color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_title_color', css);
        });
    });

    wp.customize('viral_mag_website_layout', function (value) {
        value.bind(function (to) {
            if (to === 'boxed') {
                $('body').addClass('ht-boxed');
            } else {
                $('body').removeClass('ht-boxed');
            }
        });
    });

    wp.customize('viral_mag_th_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-site-header .ht-top-header{background:' + to + '}';
            css += '.th-menu ul ul{background:' + to + '}';
            viral_mag_dynamic_css('viral_mag_th_bg_color', css);
        });
    });

    wp.customize('viral_mag_th_bottom_border_color', function (value) {
        value.bind(function (to) {
            if (to) {
                var css = '.ht-site-header .ht-top-header{border-bottom:1px solid ' + to + '}';
            } else {
                var css = '.ht-site-header .ht-top-header{border-bottom:none}';
            }
            viral_mag_dynamic_css('viral_mag_th_bottom_border_color', css);
        });
    });

    wp.customize('viral_mag_th_text_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-site-header .ht-top-header{color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_th_text_color', css);
        });
    });

    wp.customize('viral_mag_th_anchor_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-site-header .ht-top-header a,.ht-site-header .ht-top-header a:hover,.ht-site-header .ht-top-header a i,.ht-site-header .ht-top-header a:hover i{color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_th_anchor_color', css);
        });
    });

    wp.customize('viral_mag_th_height', function (value) {
        value.bind(function (to) {
            var mainHeaderHeight = wp.customize('viral_mag_mh_height').get();
            var mainHeaderHalfHeight = parseInt(mainHeaderHeight / 2);
            var header6_height = parseInt(to) + mainHeaderHalfHeight;

            var css = '.ht-site-header .ht-top-header .ht-container{height:' + to + 'px}';
            css += '.th-menu > ul > li > a{line-height: ' + to + 'px;}';
            css += '.ht-header-six.ht-site-header .ht-top-header{height: ' + header6_height + 'px;}';

            viral_mag_dynamic_css('viral_mag_th_height', css);
        });
    });

    wp.customize('viral_mag_th_disable_mobile', function (value) {
        value.bind(function (to) {
            if (to) {
                $('#ht-masthead').addClass('ht-topheader-mobile-disable');
            } else {
                $('#ht-masthead').removeClass('ht-topheader-mobile-disable');
            }
        });
    });

    wp.customize('viral_mag_mh_bg_color_mobile', function (value) {
        value.bind(function (to) {
            var responsiveWidth = wp.customize('viral_mag_responsive_width').get();
            var css = '@media screen and (max-width:' + responsiveWidth + 'px){';
            css += '.ht-header-one .ht-header, .ht-header-two .ht-header .ht-main-navigation, .ht-header-three .ht-header .ht-container, .ht-header-four .ht-header .ht-container, .ht-header-five .ht-main-navigation,.ht-header-six .ht-header .ht-container,.ht-header-seven .ht-header{background:' + to + '}';
            css += '}';
            viral_mag_dynamic_css('viral_mag_mh_bg_color_mobile', css);
        });
    });

    wp.customize('viral_mag_mh_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-header-one .ht-header,.ht-header-two .ht-header,.ht-header-three .ht-header,.ht-header-four .ht-header .ht-container,.ht-header-five .ht-header,.ht-header-six .ht-header .ht-container,.ht-header-seven .ht-header,.ht-sticky-header .ht-header-four .ht-header.headroom.headroom--not-top,.ht-sticky-header .ht-header-six .ht-header.headroom.headroom--not-top{background:' + to + '}';
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

            var css = '.ht-header-one .ht-header .ht-container,.ht-header-two .ht-header .ht-container,.ht-header-three .ht-header .ht-container,.ht-header-four .ht-header .ht-container,.ht-header-five .ht-header .ht-container,.ht-header-six .ht-header .ht-container,.ht-header-seven .ht-header .ht-container{height:' + to + 'px}';
            css += '.hover-style5 .ht-menu > ul > li.menu-item > a,.hover-style6 .ht-menu > ul > li.menu-item > a,.hover-style5 .ht-header-bttn,.hover-style6 .ht-header-bttn{line-height:' + to + 'px}';
            css += '.ht-top-header-on.ht-single-layout3 .ht-header-six.ht-site-header,.ht-top-header-on.ht-single-layout4 .ht-header-six.ht-site-header,.ht-top-header-on.ht-single-layout5 .ht-header-six.ht-site-header,.ht-top-header-on.ht-single-layout6 .ht-header-six.ht-site-header{margin-bottom: -' + to + 'px;}';
            css += '.ht-top-header-on .ht-header-six.ht-site-header{margin-bottom: -' + viral_mag_mh_half_height + 'px;}';
            css += '.ht-header-six.ht-site-header .ht-top-header{height:' + viral_mag_header6_height + 'px}'
            css += '.ht-top-header-on.ht-single-layout1 .ht-header-six.ht-site-header,.ht-top-header-on.ht-single-layout2 .ht-header-six.ht-site-header,.ht-top-header-on.ht-single-layout7 .ht-header-six.ht-site-header{margin-bottom: ' + viral_mag_header6_single_bottom_margin + 'px;}';

            css += '.ht-header-one #ht-site-branding img,.ht-header-three #ht-site-branding img,.ht-header-six #ht-site-branding img{max-height:' + viral_mag_logo_height + 'px;}';
            css += '@media screen and (max-width:' + responsive_width + 'px){.ht-header-one #ht-site-branding img,.ht-header-three #ht-site-branding img,.ht-header-six #ht-site-branding img{height: auto;max-height: ' + min_logo_height + 'px}}';
            viral_mag_dynamic_css('viral_mag_mh_height', css);
        });
    });

    wp.customize('viral_mag_logo_height', function (value) {
        value.bind(function (to) {
            var responsive_width = wp.customize('viral_mag_responsive_width').get();
            var header_height = wp.customize('viral_mag_mh_height').get();
            var logo_height = parseInt(header_height) - 30;
            var min_logo_height = Math.min(parseInt(logo_height), parseInt(to));
            var css = '#ht-site-branding img{height:' + to + 'px}';
            css += '@media screen and (max-width:' + responsive_width + 'px){.ht-header-one #ht-site-branding img,.ht-header-three #ht-site-branding img,.ht-header-six #ht-site-branding img{height: auto;max-height: ' + min_logo_height + 'px}';
            css += '.ht-header-two #ht-site-branding img, .ht-header-four #ht-site-branding img, .ht-header-five #ht-site-branding img, .ht-header-seven #ht-site-branding img{height: auto;max-height: ' + to + 'px;}}';
            viral_mag_dynamic_css('viral_mag_logo_height', css);
        });
    });

    wp.customize('viral_mag_logo_padding', function (value) {
        value.bind(function (to) {
            var css = '.ht-header-two #ht-site-branding, .ht-header-four #ht-site-branding, .ht-header-five #ht-site-branding, .ht-header-seven #ht-site-branding{padding-top:' + to + 'px;padding-bottom:' + to + 'px}';
            viral_mag_dynamic_css('viral_mag_logo_padding', css);
        });
    });

    wp.customize('viral_mag_mh_border', function (value) {
        value.bind(function (to) {
            $('#ht-masthead').removeClass('ht-no-border ht-top-border ht-bottom-border ht-top-bottom-border').addClass(to);
        });
    });

    wp.customize('viral_mag_mh_border_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-site-header.ht-header-one .ht-header,.ht-site-header.ht-header-two .ht-header,.ht-site-header.ht-header-three .ht-header,.ht-site-header.ht-header-four .ht-header .ht-container,.ht-site-header.ht-header-five .ht-header,.ht-site-header.ht-header-six .ht-header .ht-container,.ht-site-header.ht-header-seven .ht-header{border-color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_mh_border_color', css);
        });
    });

    wp.customize('viral_mag_mh_button_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-header-two .ht-middle-header-left a, .ht-header-two .ht-middle-header-right>div>a{color:' + to + ' !important}';
            css += '.ht-header-two .ht-offcanvas-nav a>span{background:' + to + ' !important}';
            viral_mag_dynamic_css('viral_mag_mh_button_color', css);
        });
    });

    wp.customize('viral_mag_mh_header_bg_url', function (value) {
        value.bind(function (to) {
            var css = '.ht-header-two .ht-middle-header, .ht-header-seven .ht-middle-header{background-image:url(' + to + ')}';
            viral_mag_dynamic_css('viral_mag_mh_header_bg_url', css);
        });
    });

    wp.customize('viral_mag_mh_header_bg_repeat', function (value) {
        value.bind(function (to) {
            var css = '.ht-header-two .ht-middle-header, .ht-header-seven .ht-middle-header{background-repeat:' + to + '}';
            viral_mag_dynamic_css('viral_mag_mh_header_bg_repeat', css);
        });
    });

    wp.customize('viral_mag_mh_header_bg_size', function (value) {
        value.bind(function (to) {
            var css = '.ht-header-two .ht-middle-header, .ht-header-seven .ht-middle-header{background-size:' + to + '}';
            viral_mag_dynamic_css('viral_mag_mh_header_bg_size', css);
        });
    });

    wp.customize('viral_mag_mh_header_bg_position', function (value) {
        value.bind(function (to) {
            to = to.replace('-', ' ');
            var css = '.ht-header-two .ht-middle-header, .ht-header-seven .ht-middle-header{background-position:' + to + '}';
            viral_mag_dynamic_css('viral_mag_mh_header_bg_position', css);
        });
    });

    wp.customize('viral_mag_mh_header_bg_attach', function (value) {
        value.bind(function (to) {
            var css = '.ht-header-two .ht-middle-header, .ht-header-seven .ht-middle-header{background-attachment:' + to + '}';
            viral_mag_dynamic_css('viral_mag_mh_header_bg_attach', css);
        });
    });

    wp.customize('viral_mag_website_width', function (value) {
        value.bind(function (container_width) {
            var boxed_container_width = parseInt(container_width) + 80;
            var css = '.ht-container,.ht-slide-caption{max-width:' + container_width + 'px}';
            css += 'body.ht-boxed #ht-page{max-width:' + boxed_container_width + 'px;}';
            viral_mag_dynamic_css('viral_mag_website_width', css);
        });
    });

    wp.customize('viral_mag_sidebar_width', function (value) {
        value.bind(function (to) {
            var primary = 100 - 4 - parseInt(to);
            var css = '#primary{width:' + primary + '%}';
            css += '#secondary{width:' + to + '%;}';
            viral_mag_dynamic_css('viral_mag_sidebar_width', css);
        });
    });

    wp.customize('viral_mag_mh_menu_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-menu > ul > li.menu-item > a,.ht-search-button a,.ht-header-social-icons a,.hover-style1 .ht-search-button a:hover,.hover-style3 .ht-search-button a:hover,.hover-style5 .ht-search-button a:hover,.hover-style1 .ht-header-social-icons a:hover,.hover-style3 .ht-header-social-icons a:hover,.hover-style5 .ht-header-social-icons a:hover{color:' + to + '}';
            css += '.ht-offcanvas-nav a>span,.hover-style1 .ht-offcanvas-nav a:hover>span,.hover-style3 .ht-offcanvas-nav a:hover>span,.hover-style5 .ht-offcanvas-nav a:hover>span{background-color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_mh_menu_color', css);
        });
    });

    wp.customize('viral_mag_mh_menu_hover_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-search-button a:hover,.ht-header-social-icons a:hover,.hover-style1 .ht-menu > ul> li.menu-item:hover > a,.hover-style1 .ht-menu > ul> li.menu-item.current_page_item > a, .hover-style1 .ht-menu > ul > li.menu-item.current-menu-item > a,.ht-menu > ul > li.menu-item:hover > a,.ht-menu > ul > li.menu-item:hover > a > i,.ht-menu > ul > li.menu-item.current_page_item > a,.ht-menu > ul > li.menu-item.current-menu-item > a,.ht-menu > ul > li.menu-item.current_page_ancestor > a,.ht-menu > ul > li.menu-item.current > a{color:' + to + '}';
            css += '.hover-style2 .ht-menu > ul > li.menu-item:hover > a,.hover-style2 .ht-menu > ul > li.menu-item.current_page_item > a,.hover-style2 .ht-menu > ul > li.menu-item.current-menu-item > a,.hover-style2 .ht-menu > ul > li.menu-item.current_page_ancestor > a,.hover-style2 .ht-menu > ul > li.menu-item.current > a,.hover-style4 .ht-menu > ul > li.menu-item:hover > a,.hover-style4 .ht-menu > ul > li.menu-item.current_page_item > a,.hover-style4 .ht-menu > ul > li.menu-item.current-menu-item > a,.hover-style4 .ht-menu > ul > li.menu-item.current_page_ancestor > a,.hover-style4 .ht-menu > ul > li.menu-item.current > a{color:' + to + ';border-color:' + to + '}'
            css += '.hover-style6 .ht-menu > ul > li.menu-item:hover > a:before,.hover-style6 .ht-menu > ul > li.menu-item.current_page_item > a:before,.hover-style6 .ht-menu > ul > li.menu-item.current-menu-item > a:before,.hover-style6 .ht-menu > ul > li.menu-item.current_page_ancestor > a:before,.hover-style6 .ht-menu > ul > li.menu-item.current > a:before,.hover-style8 .ht-menu>ul>li.menu-item>a:before, .hover-style9 .ht-menu>ul>li.menu-item>a:before{background:' + to + '}';
            css += '.hover-style7 .ht-menu>ul>li.menu-item>a:before{border-left-color:' + to + ';border-top-color:' + to + '}';
            css += '.hover-style7 .ht-menu>ul>li.menu-item>a:after{border-right-color:' + to + ';border-bottom-color:' + to + '}';
            css += '.ht-offcanvas-nav a:hover>span{background-color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_mh_menu_hover_color', css);
        });
    });

    wp.customize('viral_mag_mh_menu_hover_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.hover-style1 .ht-menu>ul>li.menu-item:hover>a,.hover-style1 .ht-menu>ul>li.menu-item.current_page_item>a,.hover-style1 .ht-menu>ul>li.menu-item.current-menu-item>a,.hover-style1 .ht-menu>ul>li.menu-item.current_page_ancestor>a,.hover-style1 .ht-menu>ul>li.menu-item.current>a,.hover-style5 .ht-menu>ul>li.menu-item:hover>a,.hover-style5 .ht-menu>ul>li.menu-item.current_page_item>a,.hover-style5 .ht-menu>ul>li.menu-item.current-menu-item>a,.hover-style5 .ht-menu>ul>li.menu-item.current_page_ancestor>a,.hover-style5 .ht-menu>ul>li.menu-item.current>a,.hover-style3 .ht-menu>ul>li.menu-item:hover>a,.hover-style3 .ht-menu>ul>li.menu-item.current_page_item>a,.hover-style3 .ht-menu>ul>li.menu-item.current-menu-item>a,.hover-style3 .ht-menu>ul>li.menu-item.current_page_ancestor>a,.hover-style3 .ht-menu>ul>li.menu-item.current>a{background:' + to + '}';
            viral_mag_dynamic_css('viral_mag_mh_menu_hover_bg_color', css);
        });
    });

    wp.customize('viral_mag_mh_submenu_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-menu ul ul,.menu-item-ht-cart .widget_shopping_cart,#ht-responsive-menu{background:' + to + '}';
            viral_mag_dynamic_css('viral_mag_mh_submenu_bg_color', css);
        });
    });

    wp.customize('viral_mag_mh_submenu_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-menu .megamenu *,#ht-responsive-menu .megamenu *,.ht-menu .megamenu a,#ht-responsive-menu .megamenu a,.ht-menu ul ul li.menu-item>a,.menu-item-ht-cart .widget_shopping_cart a,.menu-item-ht-cart .widget_shopping_cart,#ht-responsive-menu li.menu-item>a,#ht-responsive-menu li.menu-item>a i,#ht-responsive-menu li .dropdown-nav,.megamenu-category .mega-post-title a{color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_mh_submenu_color', css);
        });
    });

    wp.customize('viral_mag_mh_submenu_hover_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-menu .megamenu a:hover,#ht-responsive-menu .megamenu a:hover,.ht-menu .megamenu a:hover>i,#ht-responsive-menu .megamenu a:hover>i,.ht-menu>ul>li>ul:not(.megamenu) li.menu-item:hover>a,.ht-menu ul ul.megamenu li.menu-item>a:hover,.ht-menu ul ul li.menu-item>a:hover i,.menu-item-ht-cart .widget_shopping_cart a:hover,.ht-menu .megamenu-full-width.megamenu-category .cat-megamenu-tab>div.active-tab,.ht-menu .megamenu-full-width.megamenu-category .mega-post-title a:hover{color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_mh_submenu_hover_color', css);
        });
    });

    wp.customize('viral_mag_mh_menu_hover_style', function (value) {
        value.bind(function (to) {
            $('#ht-masthead').removeClass('hover-style1 hover-style2 hover-style3 hover-style4 hover-style5 hover-style6 hover-style7 hover-style8 hover-style9 hover-style10').addClass(to);
        });
    });

    wp.customize('viral_mag_menu_dropdown_padding', function (value) {
        value.bind(function (to) {
            var css = '.ht-menu>ul>li.menu-item{padding-top:' + to + 'px;padding-bottom:' + to + 'px}';
            viral_mag_dynamic_css('viral_mag_menu_dropdown_padding', css);
        });
    });

    wp.customize('viral_mag_hb_text', function (value) {
        value.bind(function (to) {
            $('.ht-header-bttn').text(to);
        });
    });

    wp.customize('viral_mag_hb_link', function (value) {
        value.bind(function (to) {
            $('.ht-header-bttn').attr('href', to);
        });
    });

    wp.customize('viral_mag_hb_text_color', function (value) {
        value.bind(function (to) {
            var css = 'a.ht-header-bttn{color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_hb_text_color', css);
        });
    });

    wp.customize('viral_mag_hb_text_hov_color', function (value) {
        value.bind(function (to) {
            var css = 'a.ht-header-bttn:hover{color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_hb_text_hov_color', css);
        });
    });

    wp.customize('viral_mag_hb_bg_color', function (value) {
        value.bind(function (to) {
            var css = 'a.ht-header-bttn{background:' + to + '}';
            viral_mag_dynamic_css('viral_mag_hb_bg_color', css);
        });
    });

    wp.customize('viral_mag_hb_bg_hov_color', function (value) {
        value.bind(function (to) {
            var css = 'a.ht-header-bttn:hover{background:' + to + '}';
            viral_mag_dynamic_css('viral_mag_hb_bg_hov_color', css);
        });
    });

    wp.customize('viral_mag_hb_borderradius', function (value) {
        value.bind(function (to) {
            var css = 'a.ht-header-bttn{border-radius:' + to + 'px}';
            viral_mag_dynamic_css('viral_mag_hb_borderradius', css);
        });
    });

    wp.customize('viral_mag_hb_disable_mobile', function (value) {
        value.bind(function (to) {
            if (to) {
                $('.ht-header-bttn').addClass('ht-mobile-hide');
            } else {
                $('.ht-header-bttn').removeClass('ht-mobile-hide');
            }
        });
    });

    wp.customize('viral_mag_footer_bg_url', function (value) {
        value.bind(function (to) {
            var css = '#ht-colophon{background-image:url(' + to + ')}';
            viral_mag_dynamic_css('viral_mag_footer_bg_url', css);
        });
    });

    wp.customize('viral_mag_footer_bg_repeat', function (value) {
        value.bind(function (to) {
            var css = '#ht-colophon{background-repeat:' + to + '}';
            viral_mag_dynamic_css('viral_mag_footer_bg_repeat', css);
        });
    });

    wp.customize('viral_mag_footer_bg_size', function (value) {
        value.bind(function (to) {
            var css = '#ht-colophon{background-size:' + to + '}';
            viral_mag_dynamic_css('viral_mag_footer_bg_size', css);
        });
    });

    wp.customize('viral_mag_footer_bg_position', function (value) {
        value.bind(function (to) {
            to = to.replace('-', ' ');
            var css = '#ht-colophon{background-position:' + to + '}';
            viral_mag_dynamic_css('viral_mag_footer_bg_position', css);
        });
    });

    wp.customize('viral_mag_footer_bg_attach', function (value) {
        value.bind(function (to) {
            var css = '#ht-colophon{background-attachment:' + to + '}';
            viral_mag_dynamic_css('viral_mag_footer_bg_attach', css);
        });
    });

    wp.customize('viral_mag_footer_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-site-footer:before{background-color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_footer_bg_color', css);
        });
    });

    wp.customize('viral_mag_footer_title_color', function (value) {
        value.bind(function (to) {
            var lightBorderColor = viral_mag_convert_hex(to, 20);
            var css = '#ht-colophon .widget-title{color:' + to + '}';
            css += '.ht-sidebar-style1 .ht-site-footer .widget-title:after,.ht-sidebar-style3 .ht-site-footer .widget-title:after, .ht-sidebar-style6 .ht-site-footer .widget-title:after{background-color:' + to + '}';
            css += '.ht-sidebar-style2 .ht-site-footer .widget-title, .ht-sidebar-style7 .ht-site-footer .widget-title{border-color:' + lightBorderColor + '}';
            css += '.ht-sidebar-style5 .ht-site-footer .widget-title:before, .ht-sidebar-style5 .ht-site-footer .widget-title:after{background-color:' + lightBorderColor + '}';
            viral_mag_dynamic_css('viral_mag_footer_title_color', css);
        });
    });

    wp.customize('viral_mag_footer_text_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-site-footer *{color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_footer_text_color', css);
        });
    });

    wp.customize('viral_mag_footer_anchor_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-site-footer a,.ht-site-footer a *{color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_footer_anchor_color', css);
        });
    });

    wp.customize('viral_mag_footer_border_color', function (value) {
        value.bind(function (to) {
            var css = '.ht-top-footer .ht-container,.ht-main-footer .ht-container,.ht-bottom-top-footer .ht-container{border-color:' + to + '}';
            viral_mag_dynamic_css('viral_mag_footer_border_color', css);
        });
    });

    wp.customize('viral_mag_footer_copyright', function (value) {
        value.bind(function (to) {
            $('.ht-site-info').html(to);
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
                var sectionClass = '.ht-' + settingId + '-section';
                if (to) {
                    $(sectionClass).addClass('ht-overwrite-color');
                } else {
                    $(sectionClass).removeClass('ht-overwrite-color');
                }
            });
        });

        wp.customize('viral_mag_' + settingId + '_enable_fullwindow', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                if ('on' == to) {
                    var css = sectionClass + ' .ht-section-wrap{min-height:100vh;display: -webkit-flex;display: -ms-flexbox;display: flex;overflow: hidden;flex-wrap: wrap}';
                } else {
                    var css = sectionClass + ' .ht-section-wrap{min-height:0;display:block;overflow:visible;}';
                }
                viral_mag_dynamic_css('viral_mag_' + settingId + '_enable_fullwindow', css);

                if (settingId == 'contact' && to == 'on') {
                    $('.ht-contact-section').addClass('ht-window-height');
                } else if (settingId == 'contact' && to == 'off') {
                    $('.ht-contact-section').removeClass('ht-window-height');
                }
            });
        });

        wp.customize('viral_mag_' + settingId + '_align_item', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
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

                var css = sectionClass + ' .ht-section-wrap{' + styles + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_align_item', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_bg_type', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                if ('color-bg' == to) {
                    var color = wp.customize('viral_mag_' + settingId + '_bg_color').get();
                    var css = sectionClass + '{background-color:' + color + '}';
                    viral_mag_dynamic_css('viral_mag_' + settingId + '_bg_color', css);

                    var css = sectionClass + ' .ht-section-wrap{background-color:transparent}';
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
                    var css = sectionClass + ' .ht-section-wrap{background-color:' + color_overlay + '}';
                    viral_mag_dynamic_css('viral_mag_' + settingId + '_overlay_color', css);
                } else if ('gradient-bg' == to) {
                    var gradient = wp.customize('viral_mag_' + settingId + '_bg_gradient').get();
                    var css = sectionClass + '{' + gradient + '}';
                    viral_mag_dynamic_css('viral_mag_' + settingId + '_bg_gradient', css);

                    var css = sectionClass + ' .ht-section-wrap{background-color:transparent}';
                    viral_mag_dynamic_css('viral_mag_' + settingId + '_overlay_color', css);

                } else if ('video-bg' == to) {
                    wp.customize.preview.send('refresh');
                }
            });
        });

        wp.customize('viral_mag_' + settingId + '_bg_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + '{background-color:' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_bg_color', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_bg_image_url', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + '{background-image:url(' + to + ')}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_bg_image_url', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_bg_image_repeat', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + '{background-repeat:' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_bg_image_repeat', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_bg_image_size', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + '{background-size:' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_bg_image_size', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_bg_position', function (value) {
            value.bind(function (to) {
                to = to.replace('-', ' ');
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + '{background-position:' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_bg_position', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_bg_image_attach', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + '{background-attachment:' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_bg_image_attach', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_bg_gradient', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + '{' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_bg_gradient', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_overlay_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + ' .ht-section-wrap{background-color:' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_overlay_color', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_title_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + ' h1, ' + sectionClass + ' h2, ' + sectionClass + ' h3, ' + sectionClass + ' h4, ' + sectionClass + ' h5, ' + sectionClass + ' h6{color:' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_title_color', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_text_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + ' .ht-section-wrap{color:' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_text_color', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_link_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + ' a{color:' + to + '}';
                if (settingId == "carousel1" || settingId == "carousel2") {
                    css += sectionClass + ' .vl-carousel-block.style1 .vl-carousel-heading .vl-primary-cat,' + sectionClass + ' .vl-carousel-block.style3 .vl-carousel-heading .vl-primary-cat{color:' + to + '}';
                }
                viral_mag_dynamic_css('viral_mag_' + settingId + '_link_color', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_block_title_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + '.ht-overwrite-color .vl-block-title span.vl-title{color:' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_block_title_color', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_block_title_background_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = '.ht-block-title-style2 ' + sectionClass + '.ht-overwrite-color .vl-block-title:after, .ht-block-title-style5 ' + sectionClass + '.ht-overwrite-color .vl-block-title span.vl-title:before, .ht-block-title-style7 ' + sectionClass + '.ht-overwrite-color .vl-block-title span.vl-title, .ht-block-title-style8 ' + sectionClass + '.ht-overwrite-color .vl-block-title span.vl-title, .ht-block-title-style9 ' + sectionClass + '.ht-overwrite-color .vl-block-title span.vl-title, .ht-block-title-style9 ' + sectionClass + '.ht-overwrite-color .vl-block-title span.vl-title:before, .ht-block-title-style10 ' + sectionClass + '.ht-overwrite-color .vl-block-title, .ht-block-title-style11 ' + sectionClass + '.ht-overwrite-color .vl-block-title span.vl-title, .ht-block-title-style12 ' + sectionClass + '.ht-overwrite-color .vl-block-title{background-color:' + to + '}';
                css += '.ht-block-title-style8 ' + sectionClass + '.ht-overwrite-color .vl-block-title, .ht-block-title-style9 ' + sectionClass + '.ht-overwrite-color .vl-block-title, .ht-block-title-style11 ' + sectionClass + '.ht-overwrite-color .vl-block-title{border-color:' + to + '}';
                css += '.ht-block-title-style10 ' + sectionClass + '.ht-overwrite-color .vl-block-title:before{border-color:' + to + ' ' + to + ' transparent transparent}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_block_title_background_color', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_block_title_border_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = '.ht-block-title-style2 ' + sectionClass + '.ht-overwrite-color .vl-block-title, .ht-block-title-style3 ' + sectionClass + '.ht-overwrite-color .vl-block-title, .ht-block-title-style5 ' + sectionClass + '.ht-overwrite-color .vl-block-title{border-color:' + to + '}';
                css += '.ht-block-title-style4 ' + sectionClass + '.ht-overwrite-color .vl-block-title:after, .ht-block-title-style6 ' + sectionClass + '.ht-overwrite-color .vl-block-title:before, .ht-block-title-style6 ' + sectionClass + '.ht-overwrite-color .vl-block-title:after, .ht-block-title-style7 ' + sectionClass + '.ht-overwrite-color .vl-block-title:after{background-color:' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_block_title_border_color', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_padding_top', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                if (to) {
                    var desktop = to;
                } else {
                    var desktop = 0;
                }

                var tablet = wp.customize('viral_mag_' + settingId + '_tablet_padding_top').get();
                var mobile = wp.customize('viral_mag_' + settingId + '_mobile_padding_top').get();

                var css = sectionClass + ' .ht-section-wrap{padding-top:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{padding-top:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{padding-top:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_padding_top', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_tablet_padding_top', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                var desktop = wp.customize('viral_mag_' + settingId + '_padding_top').get();
                if (to) {
                    var tablet = to;
                } else {
                    var tablet = 0;
                }
                var mobile = wp.customize('viral_mag_' + settingId + '_mobile_padding_top').get();

                var css = sectionClass + ' .ht-section-wrap{padding-top:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{padding-top:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{padding-top:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_padding_top', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_mobile_padding_top', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                var desktop = wp.customize('viral_mag_' + settingId + '_padding_top').get();
                var tablet = wp.customize('viral_mag_' + settingId + '_tablet_padding_top').get();
                if (to) {
                    var mobile = to;
                } else {
                    var mobile = 0;
                }

                var css = sectionClass + ' .ht-section-wrap{padding-top:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{padding-top:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{padding-top:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_padding_top', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_padding_bottom', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                if (to) {
                    var desktop = to;
                } else {
                    var desktop = 0;
                }
                var tablet = wp.customize('viral_mag_' + settingId + '_tablet_padding_bottom').get();
                var mobile = wp.customize('viral_mag_' + settingId + '_mobile_padding_bottom').get();

                var css = sectionClass + ' .ht-section-wrap{padding-bottom:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{padding-bottom:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{padding-bottom:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_padding_bottom', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_tablet_padding_bottom', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                var desktop = wp.customize('viral_mag_' + settingId + '_padding_bottom').get();
                if (to) {
                    var tablet = to;
                } else {
                    var tablet = 0;
                }
                var mobile = wp.customize('viral_mag_' + settingId + '_mobile_padding_bottom').get();

                var css = sectionClass + ' .ht-section-wrap{padding-bottom:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{padding-bottom:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{padding-bottom:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_padding_bottom', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_mobile_padding_bottom', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                var desktop = wp.customize('viral_mag_' + settingId + '_padding_bottom').get();
                var tablet = wp.customize('viral_mag_' + settingId + '_tablet_padding_bottom').get();
                if (to) {
                    var mobile = to;
                } else {
                    var mobile = 0;
                }

                var css = sectionClass + ' .ht-section-wrap{padding-bottom:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{padding-bottom:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{padding-bottom:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_padding_bottom', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_margin_top', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                if (to) {
                    var desktop = to;
                } else {
                    var desktop = 0;
                }
                var tablet = wp.customize('viral_mag_' + settingId + '_tablet_margin_top').get();
                var mobile = wp.customize('viral_mag_' + settingId + '_mobile_margin_top').get();

                var css = sectionClass + ' .ht-section-wrap{margin-top:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{margin-top:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{margin-top:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_margin_top', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_tablet_margin_top', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                var desktop = wp.customize('viral_mag_' + settingId + '_margin_top').get();
                if (to) {
                    var tablet = to;
                } else {
                    var tablet = 0;
                }
                var mobile = wp.customize('viral_mag_' + settingId + '_mobile_margin_top').get();

                var css = sectionClass + ' .ht-section-wrap{margin-top:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{margin-top:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{margin-top:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_margin_top', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_mobile_margin_top', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                var desktop = wp.customize('viral_mag_' + settingId + '_margin_top').get();
                var tablet = wp.customize('viral_mag_' + settingId + '_tablet_margin_top').get();
                if (to) {
                    var mobile = to;
                } else {
                    var mobile = 0;
                }

                var css = sectionClass + ' .ht-section-wrap{margin-top:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{margin-top:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{margin-top:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_margin_top', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_margin_bottom', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                if (to) {
                    var desktop = to;
                } else {
                    var desktop = 0;
                }
                var tablet = wp.customize('viral_mag_' + settingId + '_tablet_margin_bottom').get();
                var mobile = wp.customize('viral_mag_' + settingId + '_mobile_margin_bottom').get();

                var css = sectionClass + ' .ht-section-wrap{margin-bottom:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{margin-bottom:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{margin-bottom:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_margin_bottom', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_tablet_margin_bottom', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                var desktop = wp.customize('viral_mag_' + settingId + '_margin_bottom').get();
                if (to) {
                    var tablet = to;
                } else {
                    var tablet = 0;
                }
                var mobile = wp.customize('viral_mag_' + settingId + '_mobile_margin_bottom').get();

                var css = sectionClass + ' .ht-section-wrap{margin-bottom:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{margin-bottom:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{margin-bottom:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_margin_bottom', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_mobile_margin_bottom', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';

                var desktop = wp.customize('viral_mag_' + settingId + '_margin_bottom').get();
                var tablet = wp.customize('viral_mag_' + settingId + '_tablet_margin_bottom').get();
                if (to) {
                    var mobile = to;
                } else {
                    var mobile = 0;
                }

                var css = sectionClass + ' .ht-section-wrap{margin-bottom:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-wrap{margin-bottom:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-wrap{margin-bottom:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_margin_bottom', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_ts_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + ' .top-section-seperator svg{ fill:' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_ts_color', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_bs_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var css = sectionClass + ' .bottom-section-seperator svg{ fill:' + to + '}';
                viral_mag_dynamic_css('viral_mag_' + settingId + '_bs_color', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_ts_height', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var desktop = to;
                var tablet = wp.customize('viral_mag_' + settingId + '_ts_height_tablet').get();
                var mobile = wp.customize('viral_mag_' + settingId + '_ts_height_mobile').get();

                var css = sectionClass + ' .ht-section-seperator.top-section-seperator{height:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-seperator.top-section-seperator{height:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-seperator.top-section-seperator{height:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_ts_height', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_ts_height_tablet', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var desktop = wp.customize('viral_mag_' + settingId + '_ts_height').get();
                var tablet = to;
                var mobile = wp.customize('viral_mag_' + settingId + '_ts_height_mobile').get();

                var css = sectionClass + ' .ht-section-seperator.top-section-seperator{height:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-seperator.top-section-seperator{height:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-seperator.top-section-seperator{height:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_ts_height', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_ts_height_mobile', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var desktop = wp.customize('viral_mag_' + settingId + '_ts_height').get();
                var tablet = wp.customize('viral_mag_' + settingId + '_ts_height_tablet').get();
                var mobile = to;

                var css = sectionClass + ' .ht-section-seperator.top-section-seperator{height:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-seperator.top-section-seperator{height:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-seperator.top-section-seperator{height:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_ts_height', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_bs_height', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var desktop = to;
                var tablet = wp.customize('viral_mag_' + settingId + '_bs_height_tablet').get();
                var mobile = wp.customize('viral_mag_' + settingId + '_bs_height_mobile').get();

                var css = sectionClass + ' .ht-section-seperator.bottom-section-seperator{height:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-seperator.bottom-section-seperator{height:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-seperator.bottom-section-seperator{height:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_bs_height', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_bs_height_tablet', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var desktop = wp.customize('viral_mag_' + settingId + '_bs_height').get();
                var tablet = to;
                var mobile = wp.customize('viral_mag_' + settingId + '_bs_height_mobile').get();

                var css = sectionClass + ' .ht-section-seperator.bottom-section-seperator{height:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-seperator.bottom-section-seperator{height:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-seperator.bottom-section-seperator{height:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_bs_height', css);
            });
        });

        wp.customize('viral_mag_' + settingId + '_bs_height_mobile', function (value) {
            value.bind(function (to) {
                var sectionClass = '.ht-' + settingId + '-section';
                var desktop = wp.customize('viral_mag_' + settingId + '_bs_height').get();
                var tablet = wp.customize('viral_mag_' + settingId + '_bs_height_tablet').get();
                var mobile = to;

                var css = sectionClass + ' .ht-section-seperator.bottom-section-seperator{height:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + ' .ht-section-seperator.bottom-section-seperator{height:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + ' .ht-section-seperator.bottom-section-seperator{height:' + mobile + 'px}';
                    css += '}';
                }

                viral_mag_dynamic_css('viral_mag_' + settingId + '_bs_height', css);
            });
        });

    });

    wp.customize('viral_mag_content_header_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-main-content h1, .ht-main-content h2, .ht-main-content h3, .ht-main-content h4, .ht-main-content h5, .ht-main-content h6, .ht-main-content .widget-title{color:" + to + "}";
            viral_mag_dynamic_css('viral_mag_content_header_color', css);
        });
    });

    wp.customize('viral_mag_content_text_color', function (value) {
        value.bind(function (to) {
            var lightColor = viral_mag_convert_hex(to, 10);
            var lighterColor = viral_mag_convert_hex(to, 50);
            var css = ".ht-main-content{color:" + to + "}";
            css += ".single-entry-tags a, .widget-area .tagcloud a{border-color:" + to + "}";
            css += ".ht-sidebar-style2 .ht-site-wrapper .widget, .ht-sidebar-style2 .ht-site-wrapper .widget-title, .ht-sidebar-style3 .ht-site-wrapper .widget, .ht-sidebar-style5 .ht-site-wrapper .widget, .ht-sidebar-style7 .ht-site-wrapper .widget, .ht-sidebar-style7 .ht-site-wrapper .widget-title, .comment-list .sp-comment-content, .post-navigation, .post-navigation .nav-next, .ht-social-share{border-color:" + lightColor + "}";
            css += ".ht-sidebar-style5 .ht-site-wrapper .widget-title:before, .ht-sidebar-style5 .ht-site-wrapper .widget-title:after{background-color:" + lightColor + "}";
            css += ".ht-sidebar-style3 .ht-site-wrapper .widget{background-color" + lighterColor + "}";
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
            var css = ".ht-main-content .widget-title{color:" + to + "}";
            css += ".ht-sidebar-style1 .ht-site-wrapper .widget-title:after, .ht-sidebar-style3 .ht-site-wrapper .widget-title:after, .ht-sidebar-style6 .ht-site-wrapper .widget-title:after, .ht-sidebar-style7 .ht-site-wrapper .widget:before {background-color:" + to + "}";
            viral_mag_dynamic_css('viral_mag_content_widget_title_color', css);
        });
    });

    wp.customize('viral_mag_sidebar_style', function (value) {
        value.bind(function (to) {
            $('body').removeClass('ht-sidebar-style1 ht-sidebar-style2 ht-sidebar-style3 ht-sidebar-style4 ht-sidebar-style5 ht-sidebar-style6 ht-sidebar-style7 ht-sidebar-style8').addClass('ht-' + to);
        });
    });

    wp.customize('viral_mag_image_hover_effect', function (value) {
        value.bind(function (to) {
            $('body').removeClass('ht-thumb-no-effect ht-thumb-zoom-in ht-thumb-zoom-out ht-thumb-slide-left ht-thumb-slide-right ht-thumb-slide-top ht-thumb-slide-bottom ht-thumb-rotate-zoom-in ht-thumb-opacity ht-thumb-shine ht-thumb-circle').addClass('ht-thumb-' + to);
        });
    });

    wp.customize('viral_mag_block_title_style', function (value) {
        value.bind(function (to) {
            $('body').removeClass('ht-block-title-style1 ht-block-title-style2 ht-block-title-style3 ht-block-title-style4 ht-block-title-style5 ht-block-title-style6 ht-block-title-style7 ht-block-title-style8 ht-block-title-style9 ht-block-title-style10 ht-block-title-style11 ht-block-title-style12 ht-block-title-style13').addClass('ht-block-title-' + to);
        });
    });

    wp.customize('viral_mag_block_title_color', function (value) {
        value.bind(function (to) {
            var css = ".vl-block-title span.vl-title{color:" + to + "}";
            viral_mag_dynamic_css('viral_mag_block_title_color', css);
        });
    });

    wp.customize('viral_mag_block_title_background_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-block-title-style2 .vl-block-title:after, .ht-block-title-style5 .vl-block-title span.vl-title:before, .ht-block-title-style7 .vl-block-title span.vl-title, .ht-block-title-style8 .vl-block-title span.vl-title, .ht-block-title-style9 .vl-block-title span.vl-title, .ht-block-title-style9 .vl-block-title span.vl-title:before, .ht-block-title-style10 .vl-block-title, .ht-block-title-style11 .vl-block-title span.vl-title, .ht-block-title-style12 .vl-block-title{background-color:" + to + "}";
            css += ".ht-block-title-style8 .vl-block-title, .ht-block-title-style9 .vl-block-title, .ht-block-title-style11 .vl-block-title {border-color:" + to + "}";
            css += ".ht-block-title-style10 .vl-block-title:before {border-color:" + to + " " + to + " transparent transparent}";
            viral_mag_dynamic_css('viral_mag_block_title_background_color', css);
        });
    });

    wp.customize('viral_mag_block_title_border_color', function (value) {
        value.bind(function (to) {
            var css = ".ht-block-title-style2 .vl-block-title, .ht-block-title-style3 .vl-block-title, .ht-block-title-style5 .vl-block-title{border-color:" + to + "}";
            css += ".ht-block-title-style4 .vl-block-title:after, .ht-block-title-style6 .vl-block-title:before, .ht-block-title-style6 .vl-block-title:after, .ht-block-title-style7 .vl-block-title:after {background-color:" + to + "}";
            viral_mag_dynamic_css('viral_mag_block_title_border_color', css);
        });
    });

    wp.customize('viral_mag_frontpage_section_spacing', function (value) {
        value.bind(function (to) {
            var featured_block_to = parseInt(to) - 30;
            var css = "#vl-video-playlist, .vl-bottom-block, .vl-carousel-block, .vl-fwcarousel-block, .vl-slider-block, .vl-news-block, .vl-ticker, .ht-mininews-section .ht-non-fullwidth-container, .ht-mininews-section .ht-fullwidth-container, .vl-fwnews-block, .vl-tile-block-wrap, .ht-section .widget{margin-bottom:" + to + "px}";
            css += ".ht-featured-block-wrap{margin-bottom:" + featured_block_to + "}";
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