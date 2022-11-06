function viralMagDynamicCss(control, style) {
    jQuery('style.' + control).remove();
    jQuery('head').append(
            '<style class="' + control + '">:root{' + style + '}</style>'
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
});