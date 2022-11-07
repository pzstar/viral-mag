function viralMagDynamicCss(control, style) {
    jQuery('style.' + control).remove();
    jQuery('head').append(
            '<style class="' + control + '">:root{' + style + '}</style>'
            );
}

function viral_mag_dynamic_css(control, style) {
    jQuery('style.' + control).remove();

    jQuery('head').append(
            '<style class="' + control + '">' + style + '</style>'
            );
}

function viralMagLightenDarkenColor(hex, lum) {
    // validate hex string
    hex = String(hex).replace(/[^0-9a-f]/gi, '');
    if (hex.length < 6) {
        hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
    }
    lum = lum || 0;

    // convert to decimal and change luminosity
    var rgb = "#", c, i;
    for (i = 0; i < 3; i++) {
        c = parseInt(hex.substr(i * 2, 2), 16);
        c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
        rgb += ("00" + c).substr(c.length);
    }

    return rgb;
}

function viralMagConvertHex(hexcolor, opacity) {
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

jQuery(document).ready(function ($) {
    'use strict';
    wp.customize('viral_mag_website_layout', function (value) {
        value.bind(function (to) {
            if (to) {
                $('body').removeClass('vm-wide vm-boxed vm-fluid');
                $('body').addClass('vm-' + to);
            }
        });
    });
    wp.customize('viral_mag_wide_container_width', function (value) {
        value.bind(function (to) {
            var css = '--vm-wide-container-width:' + to + 'px;';
            viralMagDynamicCss('viral_mag_wide_container_width', css);
            var mediacss = '@media screen and (max-width: ' + to + 'px){';
            mediacss += '.elementor-section.elementor-section-boxed>.elementor-container,.vm-wide .vm-container, .vm-boxed .vm-container{padding-left: 40px !important;padding-right: 40px !important;}';
            mediacss += '}';
            viral_mag_dynamic_css('viral_mag_wide_container_width_mediacss', mediacss);
        });
    });
    wp.customize('viral_mag_fluid_container_width', function (value) {
        value.bind(function (to) {
            var css = '--vm-fluid-container-width:' + to + '%;';
            viralMagDynamicCss('viral_mag_fluid_container_width', css);
        });
    });
    wp.customize('viral_mag_container_padding', function (value) {
        value.bind(function (to) {
            var css = '--vm-container-padding:' + to + 'px;';
            viralMagDynamicCss('viral_mag_container_padding', css);
        });
    });
    wp.customize('viral_mag_sidebar_width', function (value) {
        value.bind(function (to) {
            var primaryWidth = 100 - 4 - to;
            var css = '--vm-secondary-width:' + to + '%;';
            css += '--vm-primary-width:' + primaryWidth + '%;';
            viralMagDynamicCss('viral_mag_sidebar_width', css);
        });
    });
    var fonts = ['viral_mag_body', 'viral_mag_h', 'viral_mag_h1', 'viral_mag_h2', 'viral_mag_h3', 'viral_mag_h4', 'viral_mag_h5', 'viral_mag_h6', 'viral_mag_frontpage_block_title', 'viral_mag_frontpage_title', 'viral_mag_sidebar_title', 'viral_mag_menu', 'viral_mag_page_title'];
    var font_params = ['style', 'text_decoration', 'text_transform', 'size', 'line_height', 'letter_spacing', 'color'];
    $.each(fonts, function (i, key) {
        $.each(font_params, function (i, param) {
            var setting = key + '_' + param;
            var cssVar = setting.replaceAll('_', '-');
            wp.customize(setting, function (value) {
                value.bind(function (to) {
                    if (param == 'size' || param == 'letter_spacing') {
                        var css = '--' + cssVar + ':' + to + 'px;';
                    } else if (param == 'style') {
                        var weight = to.replace(/\D/g, '');
                        var style = to.replace(/\d+/g, '');
                        if ('' == style) {
                            style = 'normal';
                        }
                        var css = '--' + cssVar + ':' + style + ';';
                        css += '--' + cssVar.replace('style', 'weight') + ':' + weight + ';';
                    } else {
                        var css = '--' + cssVar + ':' + to + ';';
                    }
                    viralMagDynamicCss(setting, css);
                });
            });
        });
    });
    wp.customize('viral_mag_hh1_size', function (value) {
        value.bind(function (to) {
            var css = '--vm-h1-size:' + to + 'px;';
            viralMagDynamicCss('viral_mag_hh1_size', css);
        });
    });
    wp.customize('viral_mag_hh2_size', function (value) {
        value.bind(function (to) {
            var css = '--vm-h2-size:' + to + 'px;';
            viralMagDynamicCss('viral_mag_hh2_size', css);
        });
    });
    wp.customize('viral_mag_hh3_size', function (value) {
        value.bind(function (to) {
            var css = '--vm-h3-size:' + to + 'px;';
            viralMagDynamicCss('viral_mag_hh3_size', css);
        });
    });
    wp.customize('viral_mag_hh4_size', function (value) {
        value.bind(function (to) {
            var css = '--vm-h4-size:' + to + 'px;';
            viralMagDynamicCss('viral_mag_hh4_size', css);
        });
    });
    wp.customize('viral_mag_hh5_size', function (value) {
        value.bind(function (to) {
            var css = '--vm-h5-size:' + to + 'px;';
            viralMagDynamicCss('viral_mag_hh5_size', css);
        });
    });
    wp.customize('viral_mag_hh6_size', function (value) {
        value.bind(function (to) {
            var css = '--vm-h6-size:' + to + 'px;';
            viralMagDynamicCss('viral_mag_hh6_size', css);
        });
    });
    wp.customize('viral_mag_template_color', function (value) {
        value.bind(function (to) {
            var css = '--vm-template-color:' + to + ';';
            css += '--vm-template-dark-color:' + viralMagLightenDarkenColor(to, -0.1) + ';';
            viralMagDynamicCss('viral_mag_template_color', css);
        });
    });
    wp.customize('viral_mag_content_header_color', function (value) {
        value.bind(function (to) {
            var css = '--vm-content-header-color:' + to + ';';
            viralMagDynamicCss('viral_mag_content_header_color', css);
        });
    });
    wp.customize('viral_mag_content_text_color', function (value) {
        value.bind(function (to) {
            var css = '--vm-content-text-color:' + to + ';';
            css += '--vm-content-text-light-color:' + viralMagConvertHex(to, 10) + ';';
            css += '--vm-content-text-lighter-color:' + viralMagConvertHex(to, 5) + ';';
            viralMagDynamicCss('viral_mag_content_text_color', css);
        });
    });
    wp.customize('viral_mag_content_link_color', function (value) {
        value.bind(function (to) {
            var css = '--vm-content-link-color:' + to + ';';
            viralMagDynamicCss('viral_mag_content_link_color', css);
        });
    });
    wp.customize('viral_mag_content_link_hov_color', function (value) {
        value.bind(function (to) {
            var css = '--vm-content-link-hov-color:' + to + ';';
            viralMagDynamicCss('viral_mag_content_link_hov_color', css);
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
            var css = '--vm-title-color:' + to + ';';
            viralMagDynamicCss('viral_mag_title_color', css);
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
    wp.customize('viral_mag_th_height', function (value) {
        value.bind(function (to) {
            var css = '--vm-th-height:' + to + 'px;';
            viralMagDynamicCss('viral_mag_th_height', css);
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
    wp.customize('viral_mag_th_bg_color', function (value) {
        value.bind(function (to) {
            var css = '--vm-th-bg-color:' + to + ';';
            viralMagDynamicCss('viral_mag_th_bg_color', css);
        });
    });
    wp.customize('viral_mag_th_text_color', function (value) {
        value.bind(function (to) {
            var css = '--vm-th-text-color:' + to + ';';
            viralMagDynamicCss('viral_mag_th_text_color', css);
        });
    });
    wp.customize('viral_mag_th_anchor_color', function (value) {
        value.bind(function (to) {
            var css = '--vm-th-anchor-color:' + to + ';';
            viralMagDynamicCss('viral_mag_th_anchor_color', css);
        });
    });
    wp.customize('viral_mag_logo_height', function (value) {
        value.bind(function (to) {
            var css = '--vm-logo-height:' + to + 'px;';
            viralMagDynamicCss('viral_mag_logo_height', css);
        });
    });
    wp.customize('viral_mag_logo_padding', function (value) {
        value.bind(function (to) {
            var css = '--vm-logo-padding:' + to + 'px;';
            viralMagDynamicCss('viral_mag_logo_padding', css);
        });
    });
    wp.customize('viral_mag_mh_header_bg_url', function (value) {
        value.bind(function (to) {
            var css = '--vm-mh-header-bg-url:url(' + to + ');';
            viralMagDynamicCss('viral_mag_mh_header_bg_url', css);
        });
    });
    wp.customize('viral_mag_mh_header_bg_repeat', function (value) {
        value.bind(function (to) {
            var css = '--vm-mh-header-bg-repeat:' + to + ';';
            viralMagDynamicCss('viral_mag_mh_header_bg_repeat', css);
        });
    });
    wp.customize('viral_mag_mh_header_bg_size', function (value) {
        value.bind(function (to) {
            var css = '--vm-mh-header-bg-size:' + to + ';';
            viralMagDynamicCss('viral_mag_mh_header_bg_size', css);
        });
    });
    wp.customize('viral_mag_mh_header_bg_position', function (value) {
        value.bind(function (to) {
            var css = '--vm-mh-header-bg-position:' + to.replace('-', ' ') + ';';
            viralMagDynamicCss('viral_mag_mh_header_bg_position', css);
        });
    });
    wp.customize('viral_mag_mh_header_bg_attach', function (value) {
        value.bind(function (to) {
            var css = '--vm-mh-header-bg-attach:' + to + ';';
            viralMagDynamicCss('viral_mag_mh_header_bg_attach', css);
        });
    });
    wp.customize('viral_mag_mh_button_color', function (value) {
        value.bind(function (to) {
            var css = '--vm-mh-button-color:' + to + ';';
            viralMagDynamicCss('viral_mag_mh_button_color', css);
        });
    });
    wp.customize('viral_mag_mh_bg_color', function (value) {
        value.bind(function (to) {
            var css = '--vm-mh-bg-color:' + to + ';';
            viralMagDynamicCss('viral_mag_mh_bg_color', css);
        });
    });
    wp.customize('viral_mag_mh_bg_color_mobile', function (value) {
        value.bind(function (to) {
            var css = '--vm-mh-bg-color-mobile:' + to + ';';
            viralMagDynamicCss('viral_mag_mh_bg_color_mobile', css);
        });
    });
    wp.customize('viral_mag_toggle_button_color', function (value) {
        value.bind(function (to) {
            var css = '--vm-mh-toggle-button-color:' + to + ';';
            viralMagDynamicCss('viral_mag_toggle_button_color', css);
        });
    });
    wp.customize('viral_mag_mh_border', function (value) {
        value.bind(function (to) {
            $(' #vm-masthead').removeClass('vm-no-border vm-top-border vm-bottom-border vm-top-bottom-border').addClass(to);
        });
    });
    wp.customize('viral_mag_mh_border_color', function (value) {
        value.bind(function (to) {
            var css = '--vm-mh-bg-border-color:' + to + ';';
            viralMagDynamicCss('viral_mag_mh_border_color', css);
        });
    });
    wp.customize('viral_mag_mh_menu_color', function (value) {
        value.bind(function (to) {
            var css = '--vm-mh-menu-color:' + to + ';';
            viralMagDynamicCss('viral_mag_mh_menu_color', css);
        });
    });
    wp.customize('viral_mag_mh_menu_hover_color', function (value) {
        value.bind(function (to) {
            var css = '--vm-mh-menu-hover-color:' + to + ';';
            viralMagDynamicCss('viral_mag_mh_menu_hover_color', css);
        });
    });
    wp.customize('viral_mag_mh_submenu_bg_color', function (value) {
        value.bind(function (to) {
            var css = '--vm-mh-submenu-bg-color:' + to + ';';
            viralMagDynamicCss('viral_mag_mh_submenu_bg_color', css);
        });
    });
    wp.customize('viral_mag_mh_submenu_color', function (value) {
        value.bind(function (to) {
            var css = '--vm-mh-submenu-color:' + to + ';';
            viralMagDynamicCss('viral_mag_mh_submenu_color', css);
        });
    });
    wp.customize('viral_mag_mh_submenu_hover_color', function (value) {
        value.bind(function (to) {
            var css = '--vm-mh-submenu-hover-color:' + to + ';';
            viralMagDynamicCss('viral_mag_mh_submenu_hover_color', css);
        });
    });
    wp.customize('viral_mag_menu_dropdown_padding', function (value) {
        value.bind(function (to) {
            var css = '--vm-mh-menu-dropdown-padding:' + to + 'px;';
            viralMagDynamicCss('viral_mag_menu_dropdown_padding', css);
        });
    });
    wp.customize('viral_mag_footer_copyright', function (value) {
        value.bind(function (to) {
            $('.vm-site-info .vm-copyright-text').html(to);
        });
    });
    wp.customize('viral_mag_footer_bg_url', function (value) {
        value.bind(function (to) {
            var css = '--vm-footer-bg-url:url(' + to + ');';
            viralMagDynamicCss('viral_mag_footer_bg_url', css);
        });
    });
    wp.customize('viral_mag_footer_bg_repeat', function (value) {
        value.bind(function (to) {
            var css = '--vm-footer-bg-repeat:' + to + ';';
            viralMagDynamicCss('viral_mag_footer_bg_repeat', css);
        });
    });
    wp.customize('viral_mag_footer_bg_size', function (value) {
        value.bind(function (to) {
            var css = '--vm-footer-bg-size:' + to + ';';
            viralMagDynamicCss('viral_mag_footer_bg_size', css);
        });
    });
    wp.customize('viral_mag_footer_bg_position', function (value) {
        value.bind(function (to) {
            var css = '--vm-footer-bg-position:' + to.replace('-', ' ') + ';';
            viralMagDynamicCss('viral_mag_footer_bg_position', css);
        });
    });
    wp.customize('viral_mag_footer_bg_attach', function (value) {
        value.bind(function (to) {
            var css = '--vm-footer-bg-attach:' + to + ';';
            viralMagDynamicCss('viral_mag_footer_bg_attach', css);
        });
    });
    wp.customize('viral_mag_footer_bg_color', function (value) {
        value.bind(function (to) {
            var css = '--vm-footer-bg-color:' + to + ';';
            viralMagDynamicCss('viral_mag_footer_bg_color', css);
        });
    });
    wp.customize('viral_mag_footer_title_color', function (value) {
        value.bind(function (to) {
            var css = '--vm-footer-title-color:' + to + ';';
            css += '--vm-footer-title-light-color:' + viralMagConvertHex(to, 10) + ';';
            viralMagDynamicCss('viral_mag_footer_title_color', css);
        });
    });
    wp.customize('viral_mag_footer_text_color', function (value) {
        value.bind(function (to) {
            var css = '--vm-footer-text-color:' + to + ';';
            viralMagDynamicCss('viral_mag_footer_text_color', css);
        });
    });
    wp.customize('viral_mag_footer_anchor_color', function (value) {
        value.bind(function (to) {
            var css = '--vm-footer-anchor-color:' + to + ';';
            viralMagDynamicCss('viral_mag_footer_anchor_color', css);
        });
    });
    wp.customize('viral_mag_footer_border_color', function (value) {
        value.bind(function (to) {
            var css = '--vm-footer-border-color:' + to + ';';
            viralMagDynamicCss('viral_mag_footer_border_color', css);
        });
    });
    wp.customize('viral_mag_content_widget_title_color', function (value) {
        value.bind(function (to) {
            var css = '--vm-content-widget-title-color:' + to + ';';
            viralMagDynamicCss('viral_mag_content_widget_title_color', css);
        });
    });
    wp.customize('viral_mag_sidebar_style', function (value) {
        value.bind(function (to) {
            $('body').removeClass('vm-sidebar-style1 vm-sidebar-style2').addClass('vm-' + to);
        });
    });
});