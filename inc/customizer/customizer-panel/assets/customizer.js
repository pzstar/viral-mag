jQuery(document).ready(function ($) {
    "use strict";
    wp.customize('viral_mag_website_layout', function (setting) {
        var setupWideLayout = function (control) {
            var visibility = function () {
                if ('wide' === setting.get() || 'boxed' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupBoxedLayout = function (control) {
            var visibility = function () {
                if ('boxed' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupFluidLayout = function (control) {
            var visibility = function () {
                if ('fluid' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('viral_mag_wide_container_width', setupWideLayout);
        wp.customize.control('viral_mag_container_padding', setupBoxedLayout);
        wp.customize.control('viral_mag_fluid_container_width', setupFluidLayout);
    });

    wp.customize('viral_mag_mh_layout', function (setting) {
        var setupHeaderStyle2 = function (control) {
            var visibility = function () {
                if ('header-style2' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('viral_mag_mh_header_bg', setupHeaderStyle2);
        wp.customize.control('viral_mag_mh_button_color', setupHeaderStyle2);
    });

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
