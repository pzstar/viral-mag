jQuery(document).ready(function ($) {
    $(document).on('change', '.typography_face', function () {
        var font_family = $(this).val();
        var $this = $(this);
        $.ajax({
            url: ajaxurl,
            data: {
                action: 'get_google_font_variants',
                font_family: font_family,
            },
            beforeSend: function () {
                $this.parent('.typography-font-family').next('.typography-font-style').addClass('typography-loading');
            },
            success: function (response) {
                $this.parent('.typography-font-family').next('.typography-font-style').removeClass('typography-loading');
                $this.parent('.typography-font-family').next('.typography-font-style').children('select').html(response).trigger("chosen:updated").trigger('change');
            }
        });
    });

    $('.typography-color .color-picker-hex').wpColorPicker({
        change: function (event, ui) {
            var setting = $(this).attr('data-customize-setting-link');
            var hexcolor = $(this).wpColorPicker('color');
            // Set the new value.
            wp.customize(setting, function (obj) {
                obj.set(hexcolor);
            });
        }
    });

    $(".slider-range-size").each(function () {
        $(this).slider({
            range: "min",
            value: 18,
            min: parseInt($(this).attr('min')),
            max: parseInt($(this).attr('max')),
            step: parseInt($(this).attr('step')),
            slide: function (event, ui) {
                $(this).prev(".slider-value-size").text(ui.value);

                var setting = $(this).prev(".slider-value-size").attr('data-customize-setting-link');

                // Set the new value.
                wp.customize(setting, function (obj) {
                    obj.set(ui.value);
                });
            }
        });
    });

    $(".slider-range-size").each(function () {
        $(this).slider('value', $(this).prev(".slider-value-size").attr('value'));
    });


    $(".slider-range-line-height").slider({
        range: "min",
        value: 1.5,
        min: 0.8,
        max: 5,
        step: 0.1,
        slide: function (event, ui) {
            $(this).prev(".slider-value-line-height").text(ui.value);
            var setting = $(this).prev(".slider-value-line-height").attr('data-customize-setting-link');
            // Set the new value.
            wp.customize(setting, function (obj) {
                obj.set(ui.value);
            });
        }
    });

    $(".slider-range-line-height").each(function () {
        $(this).slider('value', $(this).prev(".slider-value-line-height").attr('value'));
    });

    $(".slider-range-letter-spacing").slider({
        range: "min",
        value: 0,
        min: -5,
        max: 5,
        step: 0.1,
        slide: function (event, ui) {
            $(this).prev(".slider-value-letter-spacing").text(ui.value);
            var setting = $(this).prev(".slider-value-letter-spacing").attr('data-customize-setting-link');
            // Set the new value.
            wp.customize(setting, function (obj) {
                obj.set(ui.value);
            });
        }
    });

    $(".slider-range-letter-spacing").each(function () {
        $(this).slider('value', $(this).prev(".slider-value-letter-spacing").attr('value'));
    });
    
    wp.customize('common_header_typography', function (setting) {
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

        wp.customize.control('h_typography', setupControlCommonTypography);
        wp.customize.control('hh1_font_size', setupControlCommonTypography);
        wp.customize.control('hh2_font_size', setupControlCommonTypography);
        wp.customize.control('hh3_font_size', setupControlCommonTypography);
        wp.customize.control('hh4_font_size', setupControlCommonTypography);
        wp.customize.control('hh5_font_size', setupControlCommonTypography);
        wp.customize.control('hh6_font_size', setupControlCommonTypography);
        wp.customize.control('h_typography_seperator', setupControlCommonTypography);
        wp.customize.control('header_typography_nav', setupControlSeperateTypography);
        wp.customize.control('h1_typography_heading', setupControlSeperateTypography);
        wp.customize.control('h1_typography', setupControlSeperateTypography);
        wp.customize.control('h2_typography_heading', setupControlSeperateTypography);
        wp.customize.control('h2_typography', setupControlSeperateTypography);
        wp.customize.control('h3_typography_heading', setupControlSeperateTypography);
        wp.customize.control('h3_typography', setupControlSeperateTypography);
        wp.customize.control('h4_typography_heading', setupControlSeperateTypography);
        wp.customize.control('h4_typography', setupControlSeperateTypography);
        wp.customize.control('h5_typography_heading', setupControlSeperateTypography);
        wp.customize.control('h5_typography', setupControlSeperateTypography);
        wp.customize.control('h6_typography_heading', setupControlSeperateTypography);
        wp.customize.control('h6_typography', setupControlSeperateTypography);
    });

});


(function (api) {

    api.controlConstructor['typography'] = api.Control.extend({
        ready: function () {
            var control = this;

            control.container.on('change', '.typography-font-family select',
                    function () {
                        control.settings['family'].set(jQuery(this).val());
                    }
            );

            control.container.on('change', '.typography-font-style select',
                    function () {
                        control.settings['style'].set(jQuery(this).val());
                    }
            );

            control.container.on('change', '.typography-text-transform select',
                    function () {
                        control.settings['text_transform'].set(jQuery(this).val());
                    }
            );

            control.container.on('change', '.typography-text-decoration select',
                    function () {
                        control.settings['text_decoration'].set(jQuery(this).val());
                    }
            );

        }
    });

})(wp.customize);
