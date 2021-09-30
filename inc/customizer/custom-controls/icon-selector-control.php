<?php

/** Icon Chooser */
class Viral_Mag_Icon_Selector_Control extends WP_Customize_Control {

    public $type = 'viral-mag-icon-selector';
    //See customizer-fonts-iucon.php file
    public $icon_array;

    public function __construct($manager, $id, $args = array()) {
        $this->icon_array = apply_filters('viral_mag_register_icon', array());
        parent::__construct($manager, $id, $args);
    }

    public function to_json() {
        parent::to_json();
        $this->json['filter_text'] = esc_attr__('Type to filter', 'viral-mag');
        $this->json['value'] = $this->value();
        $this->json['link'] = $this->get_link();
        $this->json['icon_array'] = wp_parse_args($this->icon_array, array(
            'name' => '',
            'label' => '',
            'prefix' => '',
            'displayPrefix' => '',
            'url' => '',
            'icons' => array()
        ));
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

                        <select>
                            <# if ( data.icon_array ) { #>
                            <# _.each( data.icon_array, function( val ) { #>
                            <#  if (val[name] && val[label]) { #>
                            <option value="{{val[name]}}">{{val[label]}}</option>
                            <# } #>
                            <# } ) #>
                            <# } #>
                        </select>

                        <input type="text" class="viral-mag-icon-search-input" placeholder="{{ data.filter_text }}" />
                    </div>

                    <# if ( data.icon_array ) { #>
                    <# _.each( data.icon_array, function( val ) { #>
                    <ul class="viral-mag-icon-list {{val[name]}}">
                        <# if (_.isArray(val[icons])) { #>
                        <# _.each( val[icons], function( icon ) { #>
                        <li class='<# if ( icon === data.value ) { #> icon-active <# } #>'><i class="{{val[displayPrefix]}} {{val[prefix]}} {{icon}}"></i></li>
                        <# } #>
                        <# } #>
                    </ul>
                    <# } ) #>
                    <# } #>

                </div>
                <input type="hidden" value="{{ data.value }}" {{{ data.link }}} />
            </div>
        </div>
        </label>
        <?php
    }

}
