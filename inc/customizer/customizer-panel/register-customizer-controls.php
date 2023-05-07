<?php

if (!class_exists('Viral_Mag_Register_Customizer_Controls')) {

    class Viral_Mag_Register_Customizer_Controls {

        function __construct() {
            add_action('customize_register', array($this, 'register_customizer_settings'));
            add_action('customize_controls_enqueue_scripts', array($this, 'enqueue_customizer_script'));
            add_action('customize_preview_init', array($this, 'enqueue_customize_preview_js'));
        }

        public function register_customizer_settings($wp_customize) {
            /** Theme Options */
            require VIRAL_MAG_CUSTOMIZER_PATH . 'customizer-panel/homepage-settings.php';
            require VIRAL_MAG_CUSTOMIZER_PATH . 'customizer-panel/blog-settings.php';
            require VIRAL_MAG_CUSTOMIZER_PATH . 'customizer-panel/color-settings.php';
            require VIRAL_MAG_CUSTOMIZER_PATH . 'customizer-panel/general-settings.php';
            require VIRAL_MAG_CUSTOMIZER_PATH . 'customizer-panel/header-settings.php';
            require VIRAL_MAG_CUSTOMIZER_PATH . 'customizer-panel/sidebar-settings.php';
            require VIRAL_MAG_CUSTOMIZER_PATH . 'customizer-panel/footer-settings.php';
            require VIRAL_MAG_CUSTOMIZER_PATH . 'customizer-panel/social-settings.php';
            require VIRAL_MAG_CUSTOMIZER_PATH . 'customizer-panel/typography-settings.php';
            require VIRAL_MAG_CUSTOMIZER_PATH . 'customizer-panel/pro-features.php';

            /** For Additional Hooks */
            do_action('viral_mag_new_options', $wp_customize);
        }

        public function enqueue_customizer_script() {
            wp_enqueue_script('viral-mag-customizer', VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/customizer.js', array('jquery'), VIRAL_MAG_VERSION, true);
            if (is_rtl()) {
                wp_enqueue_style('viral-mag-customizer', VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/customizer.rtl.css', array(), VIRAL_MAG_VERSION);
            } else {
                wp_enqueue_style('viral-mag-customizer', VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/customizer.css', array(), VIRAL_MAG_VERSION);
            }
        }

        public function enqueue_customize_preview_js() {
            wp_enqueue_script('viral-mag-customizer-preview', VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/customizer-preview.js', array('customize-preview'), VIRAL_MAG_VERSION, true);
        }

    }

    new Viral_Mag_Register_Customizer_Controls();
}
