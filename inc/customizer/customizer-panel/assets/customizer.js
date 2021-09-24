jQuery(document).ready(function ($) {
    "use strict";

    wp.customize('viral_mag_common_header_typography', function (setting) {
        var setupControlCommonTypography = function (control) {
            var visibility = function () {
                if (setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlSeperateTypography = function (control) {
            var visibility = function () {
                if (setting.get()) {
                    control.container.addClass('customizer-hidden');
                } else {
                    control.container.removeClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('viral_mag_h_typography', setupControlCommonTypography);
        wp.customize.control('viral_mag_hh1_size', setupControlCommonTypography);
        wp.customize.control('viral_mag_hh2_size', setupControlCommonTypography);
        wp.customize.control('viral_mag_hh3_size', setupControlCommonTypography);
        wp.customize.control('viral_mag_hh4_size', setupControlCommonTypography);
        wp.customize.control('viral_mag_hh5_size', setupControlCommonTypography);
        wp.customize.control('viral_mag_hh6_size', setupControlCommonTypography);
        wp.customize.control('viral_mag_h_typography_seperator', setupControlCommonTypography);
        wp.customize.control('header_typography_note', setupControlCommonTypography);
        wp.customize.control('viral_mag_header_typography_nav', setupControlSeperateTypography);
        wp.customize.control('viral_mag_h1_typography', setupControlSeperateTypography);
        wp.customize.control('viral_mag_h2_typography', setupControlSeperateTypography);
        wp.customize.control('viral_mag_h3_typography', setupControlSeperateTypography);
        wp.customize.control('viral_mag_h4_typography', setupControlSeperateTypography);
        wp.customize.control('viral_mag_h5_typography', setupControlSeperateTypography);
        wp.customize.control('viral_mag_h6_typography', setupControlSeperateTypography);
    });
});