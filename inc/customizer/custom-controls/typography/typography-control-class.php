<?php

/**
 * Typography control class.
 *
 * @since  1.0.0
 * @access public
 */
class Viral_Mag_Typography_Control extends WP_Customize_Control {

    /**
     * The type of customize control being rendered.
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $type = 'viral-mag-typography';

    /**
     * Array 
     *
     * @since  1.0.0
     * @access public
     * @var    string
     */
    public $l10n = array();

    /**
     * Set up our control.
     *
     * @since  1.0.0
     * @access public
     * @param  object  $manager
     * @param  string  $id
     * @param  array   $args
     * @return void
     */
    public function __construct($manager, $id, $args = array()) {
        // Let the parent class do its thing.
        parent::__construct($manager, $id, $args);
        // Make sure we have labels.
        $this->l10n = wp_parse_args(
                $this->l10n, array(
            'family' => esc_html__('Font Family', 'viral-mag'),
            'style' => esc_html__('Font Weight/Style', 'viral-mag'),
            'text_transform' => esc_html__('Text Transform', 'viral-mag'),
            'text_decoration' => esc_html__('Text Decoration', 'viral-mag'),
            'size' => esc_html__('Font Size', 'viral-mag'),
            'line_height' => esc_html__('Line Height', 'viral-mag'),
            'letter_spacing' => esc_html__('Letter Spacing', 'viral-mag'),
            'color' => esc_html__('Font Color', 'viral-mag')
                )
        );
    }

    /**
     * Enqueue scripts/styles.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function enqueue() {
        wp_enqueue_script('viral-mag-customize-typograhpy-controls', VIRAL_MAG_CUSTOMIZER_URL . 'custom-controls/typography/js/customize-controls.js', array('jquery'), VIRAL_MAG_VER, true);
        wp_enqueue_style('viral-mag-customize-typograhpy-controls', VIRAL_MAG_CUSTOMIZER_URL . 'custom-controls/typography/css/customize-controls.css', array(), VIRAL_MAG_VER);
    }

    /**
     * Add custom parameters to pass to the JS via JSON.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function to_json() {
        parent::to_json();
        // Loop through each of the settings and set up the data for it.
        $this->json['inputAttrs'] = '';
        foreach ($this->input_attrs as $attr => $value) {
            $this->json['inputAttrs'] .= esc_attr($attr) . '="' . esc_attr($value) . '" ';
        }

        foreach ($this->settings as $setting_key => $setting_id) {
            $this->json[$setting_key] = array(
                'link' => $this->get_link($setting_key),
                'value' => $this->value($setting_key),
                'label' => isset($this->l10n[$setting_key]) ? $this->l10n[$setting_key] : ''
            );

            if ('family' === $setting_key) {
                $this->json[$setting_key]['default_choices'] = $this->get_default_font_families();
                $this->json[$setting_key]['google_choices'] = $this->get_google_font_families();
                $this->json[$setting_key]['standard_choices'] = $this->get_standard_font_families();
            } elseif ('style' === $setting_key) {
                $this->json[$setting_key]['choices'] = $this->get_font_weight_choices();
            } elseif ('text_transform' === $setting_key) {
                $this->json[$setting_key]['choices'] = $this->get_text_transform_choices();
            } elseif ('text_decoration' === $setting_key) {
                $this->json[$setting_key]['choices'] = $this->get_text_decoration_choices();
            }
        }
    }

    /**
     * Underscore JS template to handle the control's output.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function content_template() {
        ?>
        <# if ( data.label ) { #>
        <span class="customize-control-title">{{ data.label }}</span>
        <# } #>

        <# if ( data.description ) { #>
        <span class="description customize-control-description">{{{ data.description }}}</span>
        <# } #>

        <ul>
            <# if ( data.family && (data.family.standard_choices || data.family.google_choices) ) { #>
            <li class="viral-mag-typography-font-family">
                <# if ( data.family.label ) { #>
                <span class="viral-mag-typography-customize-control-title">{{ data.family.label }}</span>
                <# } #>

                <select {{{ data.family.link }}} data-default="{{data.family.default}}">

                    <# if ( data.family.default_choices ) { #>
                    <# _.each( data.family.default_choices, function( label, choice ) { #>
                    <option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                    <# } ) #>
                    <# } #> 

                    <# if ( data.family.standard_choices ) { #>
                    <optgroup label="Standard Fonts">
                        <# _.each( data.family.standard_choices, function( label, choice ) { #>
                        <option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                        <# } ) #>
                    </optgroup>
                    <# } #>

                    <# if ( data.family.google_choices ) { #>
                    <optgroup label="Google Fonts">
                        <# _.each( data.family.google_choices, function( label, choice ) { #>
                        <option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                        <# } ) #>
                    </optgroup>
                    <# } #>

                </select>
            </li>
            <# } #>

            <# if ( data.style && data.style.choices ) { #>
            <li class="viral-mag-typography-font-style">
                <# if ( data.style.label ) { #>
                <span class=            "viral-mag-typography-customize-control-title">{{ data.style.label }}</span>
                <# } #>
                <select {{{ data.style.link }}}>
                    <# _.each( data.style.choices, function( label, choice ) { #>
                    <option value="{{ choice }}" <# if ( choice === data.style.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                    <# } ) #>
                </select>
            </li>
            <# } #>

            <# if ( data.text_transform && data.text_transform.choices ) { #>
            <li class="viral-mag-typography-text-transform">
                <# if ( data.text_transform.label ) { #>
                <span class="viral-mag-typography-customize-control-title">{{ data.text_transform.label }}</span>
                <# } #>

                <select {{{ data.text_transform.link }}}>

                    <# _.each( data.text_transform.choices, function( label, choice ) { #>

                    <option value="{{ choice }}" <# if ( choice === data.text_transform.value ) { #> selected="selected" <# } #>>{{ label }}</option>

                    <# } ) #>
                </select>
            </li>
            <# } #>

            <# if ( data.text_decoration && data.text_decoration.choices ) { #>
            <li class="viral-mag-typography-text-decoration">
                <# if ( data.text_decoration.label ) { #>
                <span class="viral-mag-typography-customize-control-title">{{ data.text_decoration.label }}</span>
                <# } #>

                <select {{{ data.text_decoration.link }}}>

                    <# _.each( data.text_decoration.choices, function( label, choice ) { #>

                    <option value="{{ choice }}" <# if ( choice === data.text_decoration.value ) { #> selected="selected" <# } #>>{{ label }}</option>

                    <# } ) #>
                </select>
            </li>
            <# } #>

            <# if ( data.size ) { #>

            <li class="viral-mag-typography-font-size">
                <# if ( data.size.label ) { #>
                <span class="viral-mag-typography-customize-control-title">{{ data.size.label }} </span>
                <# } #>
                <div class="viral-mag-typography-slider">
                    <div class="viral-mag-typography-slider-range viral-mag-slider-range-font-size" {{{ data.inputAttrs }}} ></div>
                    <div class="viral-mag-slider-value-font-size"><span {{{ data.size.link }}} value="{{ data.size.value }}"></span> px</div>
                </div>
            </li>
            <# } #>

            <# if ( data.letter_spacing ) { #>

            <li class="viral-mag-typography-letter-spacing">
                <# if ( data.letter_spacing.label ) { #>
                <span class="viral-mag-typography-customize-control-title">{{ data.letter_spacing.label }}</span>
                <# } #>

                <div class="viral-mag-typography-slider">
                    <div class="viral-mag-typography-slider-range viral-mag-slider-range-letter-spacing"></div>  
                    <div class="viral-mag-slider-value-letter-spacing"><span {{{ data.letter_spacing.link }}} value="{{ data.letter_spacing.value }}"></span> px</div>
                </div>
            </li>
            <# } #>

            <# if ( data.line_height ) { #>

            <li class="viral-mag-typography-line-height">
                <# if ( data.line_height.label ) { #>
                <span class="viral-mag-typography-customize-control-title">{{ data.line_height.label }}</span>
                <# } #>

                <div class="viral-mag-typography-slider">
                    <div class="viral-mag-typography-slider-range viral-mag-slider-range-line-height" ></div> 
                    <div class="viral-mag-slider-value-line-height"><span {{{ data.line_height.link }}} value="{{ data.line_height.value }}"></span></div>
                </div>
            </li>
            <# } #>

            <# if ( data.color ) { #>
            <li class="viral-mag-typography-color">
                <# if ( data.color.label ) { #>
                <span class="viral-mag-typography-customize-control-title">{{{ data.color.label }}}</span>
                <# } #>

                <div class="customize-control-content">
                    <input class="viral-mag-color-picker-hex" type="text" maxlength="7" placeholder="<?php esc_attr_e('Hex Value', 'viral-mag'); ?>" {{{ data.color.link }}} value="{{ data.color.value }}"  />
                </div>
            </li>
            <# } #>

        </ul>
        <?php
    }

    /**
     * Returns the available Default font families.
     *
     * @todo Pull families from `get_default_font_families()`.
     *
     * @since  1.0.0
     * @access public
     * @return array
     */
    function get_default_font_families() {

        $default_font = viral_mag_default_font_array();

        foreach ($default_font as $key => $value) {
            $font_family[$value['family']] = $value['family'];
        }
        return $font_family;
    }

    /**
     * Returns the available Google font families.
     *
     * @todo Pull families from `get_google_font_families()`.
     *
     * @since  1.0.0
     * @access public
     * @return array
     */
    function get_google_font_families() {

        $google_font = viral_mag_google_font_array();

        foreach ($google_font as $key => $value) {
            $font_family[$value['family']] = $value['family'];
        }
        return $font_family;
    }

    /**
     * Returns the available standard font families.
     *
     * @todo Pull families from `get_standard_font_families()`.
     *
     * @since  1.0.0
     * @access public
     * @return array
     */
    function get_standard_font_families() {

        $standard_font = viral_mag_standard_font_array();

        foreach ($standard_font as $key => $value) {
            $font_family[$value['family']] = $value['family'];
        }
        return $font_family;
    }

    /**
     * Returns the available font weights.
     *
     * @since  1.0.0
     * @access public
     * @return array
     */
    public function get_font_weight_choices() {
        if ($this->settings['family']->id) {
            $default_font = viral_mag_default_font_array();
            $standard_font = viral_mag_standard_font_array();
            $google_font = viral_mag_google_font_array();

            $font = array_merge($default_font, $standard_font, $google_font);

            $font_family_id = $this->settings['family']->id;
            $default_font_family = $this->settings['family']->default;
            $get_font_family = get_theme_mod($font_family_id, $default_font_family);

            $font_array = viral_mag_search_key($font, 'family', $get_font_family);

            $variants_array = $font_array['0']['variants'];
            return $variants_array;
        } else {
            return array(
                '400' => esc_html__('Normal', 'viral-mag'),
                '400italic' => esc_html__('Normal Italic', 'viral-mag'),
                '700' => esc_html__('Bold', 'viral-mag'),
                '700italic' => esc_html__('Bold Italic', 'viral-mag')
            );
        }
    }

    /**
     * Returns the available font text decoration.
     *
     * @since  1.0.0
     * @access public
     * @return array
     */
    public function get_text_decoration_choices() {
        return array(
            'none' => esc_html__('None', 'viral-mag'),
            'underline' => esc_html__('Underline', 'viral-mag'),
            'line-through' => esc_html__('Line-through', 'viral-mag'),
            'overline' => esc_html__('Overline', 'viral-mag')
        );
    }

    /**
     * Returns the available font text transform.
     *
     * @since  1.0.0
     * @access public
     * @return array
     */
    public function get_text_transform_choices() {
        return array(
            'none' => esc_html__('None', 'viral-mag'),
            'uppercase' => esc_html__('Uppercase', 'viral-mag'),
            'lowercase' => esc_html__('Lowercase', 'viral-mag'),
            'capitalize' => esc_html__('Capitalize', 'viral-mag')
        );
    }

}
