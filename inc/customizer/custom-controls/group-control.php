<?php

/** Control Tab */
class Viral_Mag_Group_Control extends WP_Customize_Control {

    public $type = 'viral-mag-group';
    public $params = '';

    public function __construct($manager, $id, $args = array()) {
        parent::__construct($manager, $id, $args);
        if (isset($args['params'])) {
            $this->params = $args['params'];
        }
    }

    public function to_json() {
        parent::to_json();
        $params = $this->params;

        $this->json['heading'] = $params['heading'];
        $this->json['icon'] = $params['icon'];
        $this->json['fields'] = $params['fields'];
        $this->json['open'] = $params['open'];
    }

    public function content_template() {
        ?>
        <div class="viral-mag-group-wrap">
            <div class="viral-mag-group-heading">
                <# if ( data.heading ) { #>
                <label>{{{ data.heading }}}</label>
                <# } #>
            </div>

            <div class="viral-mag-group-content"></div>
        </div>
        <?php
    }

}
