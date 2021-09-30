<?php

if (!class_exists('Viral_Mag_Register_Customizer_Controls')) {

    class Viral_Mag_Register_Customizer_Controls {

        protected $version;

        function __construct() {
            if (defined('VIRAL_MAG_VER')) {
                $this->version = VIRAL_MAG_VER;
            } else {
                $this->version = '1.0.0';
            }

            add_action('customize_register', array($this, 'register_customizer_settings'));
            add_action('customize_controls_enqueue_scripts', array($this, 'enqueue_customizer_script'));
            add_action('customize_preview_init', array($this, 'enqueue_customize_preview_js'));
        }

        public function register_customizer_settings($wp_customize) {
            /** Theme Options */
            require VIRAL_MAG_CUSTOMIZER_PATH . 'customizer-panel/homepage-settings.php';
            require VIRAL_MAG_CUSTOMIZER_PATH . 'customizer-panel/blog-settings.php';
            require VIRAL_MAG_CUSTOMIZER_PATH . 'customizer-panel/color-settings.php';
            require VIRAL_MAG_CUSTOMIZER_PATH . 'customizer-panel/footer-settings.php';
            require VIRAL_MAG_CUSTOMIZER_PATH . 'customizer-panel/general-settings.php';
            require VIRAL_MAG_CUSTOMIZER_PATH . 'customizer-panel/header-settings.php';
            require VIRAL_MAG_CUSTOMIZER_PATH . 'customizer-panel/sidebar-settings.php';
            require VIRAL_MAG_CUSTOMIZER_PATH . 'customizer-panel/social-settings.php';
            require VIRAL_MAG_CUSTOMIZER_PATH . 'customizer-panel/typography.php';

            /** For Additional Hooks */
            do_action('viral_mag_new_options', $wp_customize);
        }

        public function enqueue_customizer_script() {
            wp_enqueue_script('viral-mag-customizer', VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/customizer.js', array('jquery'), $this->get_version(), true);
            wp_enqueue_style('viral-mag-customizer', VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/customizer.css', array(), $this->get_version());
        }

        public function enqueue_customize_preview_js() {
            wp_enqueue_script('webfont', VIRAL_MAG_CUSTOMIZER_URL . 'custom-controls/typography/js/webfont.js', array('jquery'), $this->get_version(), false);
            wp_enqueue_script('viral-mag-customizer-preview', VIRAL_MAG_CUSTOMIZER_URL . 'customizer-panel/assets/customizer-preview.js', array('customize-preview'), $this->get_version(), true);
        }

        public function get_version() {
            return $this->version;
        }

    }

    new Viral_Mag_Register_Customizer_Controls();
}
