<?php

/** Switch Control */
class Viral_Mag_Switch_Control extends WP_Customize_Control {

    public $type = 'viral-mag-switch';
    public $on_off_label = array();
    public $class;

    public function __construct($manager, $id, $args = array()) {
        $this->on_off_label = $args['on_off_label'];
        $this->class = isset($args['class']) ? $args['class'] : '';
        parent::__construct($manager, $id, $args);
    }

    public function render_content() {
        $switch_class = ($this->value() == 'on') ? 'viral-mag-switch-on ' : '';
        $switch_class .= $this->class;
        $on_off_label = $this->on_off_label;
        ?>
        <div class="viral-mag-switch <?php echo esc_attr($switch_class); ?>">
            <div class="viral-mag-switch-inner">
                <div class="viral-mag-switch-active">
                    <div class="viral-mag-switch-button"><?php echo esc_html($on_off_label['on']) ?></div>
                </div>

                <div class="viral-mag-switch-inactive">
                    <div class="viral-mag-switch-button"><?php echo esc_html($on_off_label['off']) ?></div>
                </div>
            </div>
        </div>
        <input <?php $this->link(); ?> type="hidden" value="<?php echo esc_attr($this->value()); ?>"/>
        <span class="customize-control-title">
            <?php echo esc_html($this->label); ?>
        </span>

        <?php if ($this->description) { ?>
            <span class="description customize-control-description">
                <?php echo wp_kses_post($this->description); ?>
            </span>
        <?php } ?>
        <?php
    }

}
