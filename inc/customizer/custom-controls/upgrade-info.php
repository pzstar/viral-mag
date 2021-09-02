<?php

// Upgrade Text
class Viral_Mag_Upgrade_Info_Control extends WP_Customize_Control {

    public $type = 'viral-mag-upgrade-info';

    public function render_content() {
        ?>
        <label>
            <span class="dashicons dashicons-info"></span>

            <?php if ($this->label) { ?>
                <span>
                    <?php echo wp_kses_post($this->label); ?>
                </span>
            <?php } ?>

            <a href="<?php echo esc_url('https://hashthemes.com/wordpress-theme/viral-mag-plus/?utm_source=wordpress&utm_medium=viral-mag-link&utm_campaign=viral-mag-upgrade'); ?>" target="_blank"> <strong><?php echo esc_html__('Upgrade to PRO', 'viral-mag'); ?></strong></a>
        </label>

        <?php if ($this->description) { ?>
            <span class="description customize-control-description">
                <?php echo wp_kses_post($this->description); ?>
            </span>
            <?php
        }

        $choices = $this->choices;
        if ($choices) {
            echo '<ul>';
            foreach ($choices as $choice) {
                echo '<li>' . esc_html($choice) . '</li>';
            }
            echo '</ul>';
        }
    }

}
