<?php
if (!class_exists('Viral_Mag_Welcome')) :

    class Viral_Mag_Welcome {

        public $tab_sections = array();
        public $theme_name = ''; // For storing Theme Name
        public $theme_version = ''; // For Storing Theme Current Version Information
        public $free_plugins = array(); // For Storing the list of the Recommended Free Plugins

        /**
         * Constructor for the Welcome Screen
         */

        public function __construct() {

            /** Useful Variables */
            $theme = wp_get_theme();
            $this->theme_name = $theme->Name;
            $this->theme_version = $theme->Version;

            /** Define Tabs Sections */
            $this->tab_sections = array(
                'getting_started' => esc_html__('Getting Started', 'viral-mag'),
                'recommended_plugins' => esc_html__('Recommended Plugins', 'viral-mag'),
                'support' => esc_html__('Support', 'viral-mag'),
                'free_vs_pro' => esc_html__('Free Vs Pro', 'viral-mag')
            );

            /** List of Recommended Free Plugins */
            $this->free_plugins = array(
                'hashthemes-demo-importer' => array(
                    'name' => 'HashThemes Demo Importer',
                    'slug' => 'hashthemes-demo-importer',
                    'filename' => 'hashthemes-demo-importer',
                    'thumb_path' => 'https://ps.w.org/hashthemes-demo-importer/assets/icon-256x256.png'
                ),
                'elementor' => array(
                    'name' => 'Elementor',
                    'slug' => 'elementor',
                    'filename' => 'elementor',
                    'thumb_path' => 'https://ps.w.org/elementor/assets/icon-256x256.png'
                ),
                'hash-elements' => array(
                    'name' => 'Hash Elements',
                    'slug' => 'hash-elements',
                    'filename' => 'hash-elements',
                    'thumb_path' => 'https://ps.w.org/hash-elements/assets/icon-256x256.png'
                ),
                'simple-floating-menu' => array(
                    'name' => 'Simple Floating Menu',
                    'slug' => 'simple-floating-menu',
                    'filename' => 'simple-floating-menu',
                    'thumb_path' => 'https://ps.w.org/simple-floating-menu/assets/icon-256x256.png'
                ),
                'smart-blocks' => array(
                    'name' => 'Smart Blocks - Wordpress Gutenberg Blocks',
                    'slug' => 'smart-blocks',
                    'filename' => 'smart-blocks',
                    'thumb_path' => 'https://ps.w.org/smart-blocks/assets/icon-256x256.png'
                )
            );

            /* Create a Welcome Page */
            add_action('admin_menu', array($this, 'welcome_register_menu'));

            /* Enqueue Styles & Scripts for Welcome Page */
            add_action('admin_enqueue_scripts', array($this, 'welcome_styles_and_scripts'));

            /* Adds Footer Rating Text */
            add_filter('admin_footer_text', array($this, 'admin_footer_text'));

            /* Create a Welcome Page */
            add_action('wp_loaded', array($this, 'admin_notice'), 20);

            add_action('after_switch_theme', array($this, 'erase_hide_notice'));

            add_action('wp_ajax_viral_mag_activate_plugin', array($this, 'activate_plugin'));

            add_action('admin_init', array($this, 'welcome_init'));
        }

        /** Trigger Welcome Message Notification */
        public function admin_notice() {
            add_action('admin_notices', array($this, 'admin_notice_content'));
        }

        /** Welcome Message Notification */
        public function admin_notice_content() {
            if (!$this->is_dismissed('welcome')) {
                $this->welcome_notice();
            }

            if (!$this->is_dismissed('review') && !empty(get_option('viral_mag_first_activation')) && time() > get_option('viral_mag_first_activation') + 15 * DAY_IN_SECONDS) {
                $this->review_notice();
            }
        }

        public function welcome_notice() {
            $screen = get_current_screen();

            if ('appearance_page_viral-mag-welcome' === $screen->id || (isset($screen->parent_file) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id) || 'theme-install' === $screen->id) {
                return;
            }

            $slug = $filename = 'hashthemes-demo-importer';
            ?>
            <div class="updated notice viral-mag-welcome-notice viral-mag-notice">
                <?php $this->dismiss_button('welcome'); ?>
                <div class="viral-mag-welcome-notice-wrap">
                    <h2><?php esc_html_e('Congratulations!', 'viral-mag'); ?></h2>
                    <p><?php printf(esc_html__('%1$s is now installed and ready to use. You can start either by importing the ready made demo or get started by customizing it your self.', 'viral-mag'), $this->theme_name); ?></p>

                    <div class="viral-mag-welcome-info">
                        <div class="viral-mag-welcome-thumb">
                            <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/screenshot.png'); ?>" alt="<?php echo esc_attr_e('Viral Demo', 'viral-mag'); ?>">
                        </div>

                        <?php
                        if ('appearance_page_hdi-demo-importer' !== $screen->id) {
                            ?>
                            <div class="viral-mag-welcome-import">
                                <h3><?php esc_html_e('Import Demo', 'viral-mag'); ?></h3>
                                <p><?php esc_html_e('Click below to install and active HashThemes Demo Importer Plugin.', 'viral-mag'); ?></p>
                                <p><?php echo $this->generate_hdi_install_button(); ?></p>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="viral-mag-welcome-getting-started">
                            <h3><?php esc_html_e('Get Started', 'viral-mag'); ?></h3>
                            <p><?php printf(esc_html__('Here you will find all the necessary links and information on how to use %s.', 'viral-mag'), $this->theme_name); ?></p>
                            <p><a href="<?php echo esc_url(admin_url('admin.php?page=viral-mag-welcome')); ?>" class="button button-primary"><?php esc_html_e('Go to Setting Page', 'viral-mag'); ?></a></p>
                        </div>
                    </div>
                </div>

            </div>
            <?php
        }

        /** Register Menu for Welcome Page */
        public function welcome_register_menu() {
            add_menu_page(esc_html__('Welcome', 'viral-mag'), sprintf(esc_html__('%s Settings', 'viral-mag'), esc_html($this->theme_name)), 'manage_options', 'viral-mag-welcome', array($this, 'welcome_screen'), 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA0NS45NCA0NS45NCIgZmlsbD0iI0ZGRkZGRiI+PGc+PGc+PHBhdGggZD0iTTIyLjkyIDI1LjM3IDM1LjQ0IDMuN2EyMi44OSAyMi44OSAwIDAgMC0yNSAuMDZaTTIuNDkgMTIuNmEyMi45NCAyMi45NCAwIDAgMCAyMC4yMyAzMy4zM1pNMjIuOSA0NS45NGguMWEyMi45NCAyMi45NCAwIDAgMCAyMC4zOC0zMy40N1oiLz48L2c+PC9nPjwvc3ZnPg==', 60);
        }

        /** Welcome Page */
        public function welcome_screen() {
            $tabs = $this->tab_sections;
            ?>
            <div class="welcome-wrap">
                <div class="welcome-main-content">
                    <?php require_once get_template_directory() . '/welcome/sections/header.php'; ?>

                    <div class="welcome-section-wrapper">
                        <?php $section = isset($_GET['section']) && array_key_exists($_GET['section'], $tabs) ? $_GET['section'] : 'getting_started'; ?>

                        <div class="welcome-section <?php echo esc_attr($section); ?> clearfix">
                            <?php require_once get_template_directory() . '/welcome/sections/' . $section . '.php'; ?>
                        </div>
                    </div>
                </div>

                <div class="welcome-footer-content">
                    <?php require_once get_template_directory() . '/welcome/sections/footer.php'; ?>
                </div>
            </div>
            <?php
        }

        /** Enqueue Necessary Styles and Scripts for the Welcome Page */
        public function welcome_styles_and_scripts($hook) {
            if ('theme-install.php' !== $hook) {
                $importer_params = array(
                    'installing_text' => esc_html__('Installing Demo Importer Plugin', 'viral-mag'),
                    'activating_text' => esc_html__('Activating Demo Importer Plugin', 'viral-mag'),
                    'importer_page' => esc_html__('Go to Demo Importer Page', 'viral-mag'),
                    'importer_url' => admin_url('themes.php?page=hdi-demo-importer'),
                    'error' => esc_html__('Error! Reload the page and try again.', 'viral-mag'),
                    'ajax_nonce' => wp_create_nonce('viral_mag_activate_hdi_plugin')
                );
                wp_enqueue_style('viral-mag-welcome', get_template_directory_uri() . '/welcome/css/welcome.css', array(), VIRAL_MAG_VERSION);
                wp_enqueue_script('viral-mag-welcome', get_template_directory_uri() . '/welcome/js/welcome.js', array('plugin-install', 'updates'), VIRAL_MAG_VERSION, true);
                wp_localize_script('viral-mag-welcome', 'importer_params', $importer_params);
            }
        }

        /* Check if plugin is installed */

        public function check_plugin_installed_state($slug, $filename) {
            return file_exists(ABSPATH . 'wp-content/plugins/' . $slug . '/' . $filename . '.php') ? true : false;
        }

        /* Check if plugin is activated */

        public function check_plugin_active_state($slug, $filename) {
            return is_plugin_active($slug . '/' . $filename . '.php') ? true : false;
        }

        /** Generate Url for the Plugin Button */
        public function plugin_generate_url($status, $slug, $file_name) {
            switch ($status) {
                case 'install':
                    return wp_nonce_url(add_query_arg(array(
                        'action' => 'install-plugin',
                        'plugin' => esc_attr($slug)
                                    ), network_admin_url('update.php')), 'install-plugin_' . esc_attr($slug));
                    break;

                case 'inactive':
                    return add_query_arg(array(
                        'action' => 'deactivate',
                        'plugin' => rawurlencode(esc_attr($slug) . '/' . esc_attr($file_name) . '.php'),
                        'plugin_status' => 'all',
                        'paged' => '1',
                        '_wpnonce' => wp_create_nonce('deactivate-plugin_' . esc_attr($slug) . '/' . esc_attr($file_name) . '.php'),
                            ), network_admin_url('plugins.php'));
                    break;

                case 'active':
                    return add_query_arg(array(
                        'action' => 'activate',
                        'plugin' => rawurlencode(esc_attr($slug) . '/' . esc_attr($file_name) . '.php'),
                        'plugin_status' => 'all',
                        'paged' => '1',
                        '_wpnonce' => wp_create_nonce('activate-plugin_' . esc_attr($slug) . '/' . esc_attr($file_name) . '.php'),
                            ), network_admin_url('plugins.php'));
                    break;
            }
        }

        /** Ajax Plugin Activation */
        public function activate_plugin() {
            if (!current_user_can('manage_options')) {
                return;
            }

            check_ajax_referer('viral_mag_activate_hdi_plugin', 'security');

            $slug = isset($_POST['slug']) ? $_POST['slug'] : '';
            $file = isset($_POST['file']) ? $_POST['file'] : '';
            $success = false;

            if (!empty($slug) && !empty($file)) {
                $result = activate_plugin($slug . '/' . $file . '.php');
                update_option('viral_mag_hide_notice', true);
                if (!is_wp_error($result)) {
                    $success = true;
                }
            }
            echo wp_json_encode(array('success' => $success));
            die();
        }

        /** Adds Footer Notes */
        public function admin_footer_text($text) {
            $screen = get_current_screen();

            if ('toplevel_page_viral-mag-welcome' == $screen->id) {
                $text = sprintf(esc_html__('Please leave us a %s rating if you like our theme . A huge thank you from HashThemes in advance!', 'viral-mag'), '<a href="https://wordpress.org/support/theme/viral-mag/reviews/?filter=5#new-post" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a>');
            }

            return $text;
        }

        /** Generate HashThemes Demo Importer Install Button Link */
        public function generate_hdi_install_button() {
            $slug = $filename = 'hashthemes-demo-importer';
            $import_url = '#';

            if ($this->check_plugin_installed_state($slug, $filename) && !$this->check_plugin_active_state($slug, $filename)) {
                $import_class = 'button button-primary viral-mag-activate-plugin';
                $import_button_text = esc_html__('Activate Demo Importer Plugin', 'viral-mag');
            } elseif ($this->check_plugin_installed_state($slug, $filename)) {
                $import_class = 'button button-primary';
                $import_button_text = esc_html__('Go to Demo Importer Page', 'viral-mag');
                $import_url = admin_url('themes.php?page=hdi-demo-importer');
            } else {
                $import_class = 'button button-primary viral-mag-install-plugin';
                $import_button_text = esc_html__('Install Demo Importer Plugin', 'viral-mag');
            }
            return '<a data-slug="' . esc_attr($slug) . '" data-filename="' . esc_attr($filename) . '" class="' . esc_attr($import_class) . '" href="' . $import_url . '">' . esc_html($import_button_text) . '</a>';
        }

        /** Check for Available Image */
        public function image_exist($url = NULL) {
            if (!$url)
                return FALSE;

            $headers = get_headers($url);
            return stripos($headers[0], "200 OK") ? TRUE : FALSE;
        }

        public function erase_hide_notice() {
            delete_option('viral_mag_dismissed_notices');
        }

        /**
         * Handle a click on the dismiss button
         *
         * @return void
         */
        public function welcome_init() {
            if (!get_option('viral_mag_first_activation')) {
                update_option('viral_mag_first_activation', time());
            };

            if (get_option('viral_mag_hide_notice') && !$this->is_dismissed('welcome')) {
                delete_option('viral_mag_hide_notice');
                self::dismiss('welcome');
            }

            if (isset($_GET['viral-mag-hide-notice'], $_GET['viral_mag_notice_nonce'])) {
                $notice = sanitize_key($_GET['viral-mag-hide-notice']);
                check_admin_referer($notice, 'viral_mag_notice_nonce');
                self::dismiss($notice);
                wp_safe_redirect(remove_query_arg(array('viral-mag-hide-notice', 'viral_mag_notice_nonce'), wp_get_referer()));
                exit;
            }
        }

        /**
         * Displays a notice asking for a review
         *
         * @return void
         */
        private function review_notice() {
            ?>
            <div class="viral-mag-notice notice notice-info">
                <?php $this->dismiss_button('review'); ?>
                <div class="viral-mag-notice-logo">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 45.94 45.94"><g><g><path d="M22.92 25.37 35.44 3.7a22.89 22.89 0 0 0-25 .06ZM2.49 12.6a22.94 22.94 0 0 0 20.23 33.33ZM22.9 45.94h.1a22.94 22.94 0 0 0 20.38-33.47Z"/></g></g></svg>
                </div>

                <div class="viral-mag-notice-content">
                    <p>
                        <?php
                        printf(
                                /* translators: %1$s is link start tag, %2$s is link end tag. */
                                esc_html__('Great to see that you have been using Viral Mag for some time. We hope you love it, and we would really appreciate it if you would %1$sgive us a 5 stars rating%2$s and spread your words to the world.', 'viral-mag'), '<a href="https://wordpress.org/support/theme/viral-mag/reviews/?filter=5#new-post">', '</a>'
                        );
                        ?>
                    </p>
                    <a target="_blank" class="button button-primary button-large" href="https://wordpress.org/support/theme/viral-mag/reviews/?filter=5#new-post"><?php echo esc_html__('Yes, of course', 'viral-mag') ?></a> &nbsp;
                    <a class="button button-large" href="<?php echo esc_url(wp_nonce_url(add_query_arg('viral-mag-hide-notice', 'review'), 'review', 'viral_mag_notice_nonce')); ?>"><?php echo esc_html__('I have already rated', 'viral-mag') ?></a>
                </div>
            </div>
            <?php
        }

        /**
         * Has a notice been dismissed?
         *
         * @param string $notice Notice name
         * @return bool
         */
        public static function is_dismissed($notice) {
            $dismissed = get_option('viral_mag_dismissed_notices', array());

            // Handle legacy user meta
            $dismissed_meta = get_user_meta(get_current_user_id(), 'viral_mag_dismissed_notices', true);
            if (is_array($dismissed_meta)) {
                if (array_diff($dismissed_meta, $dismissed)) {
                    $dismissed = array_merge($dismissed, $dismissed_meta);
                    update_option('viral_mag_dismissed_notices', $dismissed);
                }
                if (!is_multisite()) {
                    // Don't delete on multisite to avoid the notices to appear in other sites.
                    delete_user_meta(get_current_user_id(), 'viral_mag_dismissed_notices');
                }
            }

            return in_array($notice, $dismissed);
        }

        /**
         * Displays a dismiss button
         *
         * @param string $name Notice name
         * @return void
         */
        public function dismiss_button($name) {
            printf('<a class="notice-dismiss" href="%s"><span class="screen-reader-text">%s</span></a>', esc_url(wp_nonce_url(add_query_arg('viral-mag-hide-notice', $name), $name, 'viral_mag_notice_nonce')), esc_html__('Dismiss this notice.', 'viral-mag')
            );
        }

        /**
         * Stores a dismissed notice in database
         *
         * @param string $notice
         * @return void
         */
        public static function dismiss($notice) {
            $dismissed = get_option('viral_mag_dismissed_notices', array());

            if (!in_array($notice, $dismissed)) {
                $dismissed[] = $notice;
                update_option('viral_mag_dismissed_notices', array_unique($dismissed));
            }
        }

    }

    new Viral_Mag_Welcome();

endif;
