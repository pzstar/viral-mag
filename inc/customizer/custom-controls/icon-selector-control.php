<?php

/** Icon Chooser */
class Viral_Mag_Icon_Selector_Control extends WP_Customize_Control {

    public $type = 'viral-mag-icon-selector';
    public $icon_array = array();

    public function __construct($manager, $id, $args = array()) {
        if (isset($args['icon_array'])) {
            $this->icon_array = $args['icon_array'];
        }
        parent::__construct($manager, $id, $args);
    }

    public function to_json() {
        parent::to_json();
        $this->json['filter_text'] = esc_attr__('Type to filter', 'viral-mag');
        $this->json['value'] = $this->value();
        if (isset($this->icon_array) && !empty($this->icon_array)) {
            $this->json['icon_array'] = $this->icon_array;
        } else {
            $this->json['icon_array'] = viral_mag_font_awesome_icon_array();
        }
    }

    public function content_template() {
        ?>
        <label>
            <# if ( data.label ) { #>
            <span class="customize-control-title">
                {{{ data.label }}}
            </span>
            <# } #>

            <# if ( data.description ) { #>
            <span class="description customize-control-description">
                {{{ data.description }}}
            </span>
            <# } #>

            <div class="viral-mag-icon-box-wrap">
                <div class="viral-mag-selected-icon">
                    <i class="{{ data.value }}"></i>
                    <span><i class="viral-mag-down-icon"></i></span>
                </div>

                <div class="viral-mag-icon-box">
                    <div class="viral-mag-icon-search">
                        <input type="text" class="viral-mag-icon-search-input" placeholder="{{ data.filter_text }}" />
                    </div>

                    <ul class="viral-mag-icon-list viral-mag-clearfix active">
                        <# _.each( data.icon_array, function( val ) { #>
                        <li class="<# if ( val === data.value ) { #> icon-active <# } #>"><i class="{{ val }}"></i></li>
                        <# } ) #>
                    </ul>
                </div>

                <input type="hidden" value="<?php esc_attr($this->value()); ?>" <?php $this->link(); ?> />
            </div>
        </label>
        <?php
    }

}
