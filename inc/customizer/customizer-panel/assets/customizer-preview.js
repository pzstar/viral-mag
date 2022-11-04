function viralMagDynamicCss(control, style) {
    jQuery('style.' + control).remove();
    jQuery('head').append(
            '<style class="' + control + '">:root{' + style + '}</style>'
            );
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
});