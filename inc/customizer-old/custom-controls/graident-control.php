<?php

/** Gradient Control */
class Viral_Mag_Gradient_Control extends WP_Customize_Control {

    public $type = 'viral-mag-gradient';
    public $params = array();

    public function __construct($manager, $id, $args = array()) {
        if (isset($args['params'])) {
            $this->params = $args['params'];
        }
        parent::__construct($manager, $id, $args);
    }

    public function enqueue() {
        wp_enqueue_script('color-picker', VIRAL_MAG_CUSTOMIZER_URL . 'custom-controls/assets/js/colorpicker.js', array('jquery'), VIRAL_MAG_VER, true);
        wp_enqueue_script('jquery-classygradient', VIRAL_MAG_CUSTOMIZER_URL . 'custom-controls/assets/js/jquery.classygradient.js', array('jquery'), VIRAL_MAG_VER, true);
        wp_enqueue_script('custom-gradient', VIRAL_MAG_CUSTOMIZER_URL . 'custom-controls/assets/js/custom-gradient.js', array('jquery', 'jquery-ui-slider'), VIRAL_MAG_VER, true);

        wp_enqueue_style('color-picker', VIRAL_MAG_CUSTOMIZER_URL . 'custom-controls/assets/css/colorpicker.css');
        wp_enqueue_style('jquery-classygradient', VIRAL_MAG_CUSTOMIZER_URL . 'custom-controls/assets/css/jquery.classygradient.css');
    }

    public function render_content() {

        if (!empty($this->label)) :
            ?>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php
        endif;

        if (!empty($this->description)) :
            ?>
            <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
            <?php
        endif;

        $type = $this->type;
        $params = $this->params;
        $class = isset($params['class']) ? $params['class'] : '';
        $default_color = isset($params['default_color']) ? $params['default_color'] : '0% #0051FF, 100% #00C5FF';
        $picker_label = isset($params['picker_label']) ? $params['picker_label'] : esc_html__("Define Gradient Colors", 'viral-mag');
        $picker_description = isset($params['picker_description']) ? $params['picker_description'] : esc_html__("For a gradient, at least one starting and one end color should be defined.", 'viral-mag');
        $angle_label = isset($params['angle_label']) ? $params['angle_label'] : esc_html__("Define Gradient Direction", 'viral-mag');
        $preview_label = isset($params['preview_label']) ? $params['preview_label'] : esc_html__("Gradient Preview", 'viral-mag');
        ?>
        <div class="viral-mag-gradient-box" data-default-color="<?php echo esc_attr($default_color); ?>">

            <div class="viral-mag-gradient-row">
                <div class="viral-mag-gradient-label"><?php echo esc_html($picker_label); ?></div>
                <div class="viral-mag-gradient-picker"></div>
                <div class="viral-mag-gradient-description"><?php echo esc_html($picker_description); ?></div>
            </div>

            <div class="viral-mag-gradient-row">
                <div class="viral-mag-gradient-label"><?php echo esc_html($angle_label); ?></div>
                <select class="viral-mag-gradient-direction">
                    <option value="vertical"><?php echo esc_html__('Vertical Spread (Top to Bottom)', 'viral-mag'); ?></option>
                    <option value="horizontal"><?php echo esc_html__('Horizontal Spread (Left To Right)', 'viral-mag'); ?></option>
                    <option value="custom"><?php echo esc_html__('Custom Angle Spread', 'viral-mag'); ?></option>
                </select>
            </div>

            <div class="viral-mag-gradient-row">
                <div class="viral-mag-gradient-custom" style="display: none;">
                    <div class="viral-mag-gradient-label"><?php echo esc_html__('Define Custom Angle', 'viral-mag'); ?></div>
                    <div class="viral-mag-gradient-angle-slider">
                        <div class="viral-mag-gradient-range"></div>
                    </div>
                </div>
            </div>
            <!--
              <div class="viral-mag-gradient-row">
              <div class="viral-mag-gradient-label"><?php echo esc_html($preview_label); ?></div>
              <div class="viral-mag-gradient-preview"></div>
              </div>
            -->
            <input type="hidden" class="<?php echo esc_attr($type); ?> <?php echo esc_attr($class) ?> viral-mag-gradient-val"  value="<?php echo esc_attr($this->value()) ?>" <?php $this->link(); ?> />
        </div>
        <?php
    }

}
