<?php
$viral_mag_free_plugins = $this->free_plugins;

if (!empty($viral_mag_free_plugins)) {
    ?>
    <h3><?php echo esc_html__('Recommended Plugins', 'viral-mag'); ?></h3>
    <p><?php echo esc_html__('Please install these free plugins. These plugins are complementary that adds more features to the theme.', 'viral-mag'); ?></p>
    <div class="recomended-plugin-wrap">
        <?php
        foreach ($viral_mag_free_plugins as $viral_mag_plugin) {
            $viral_mag_slug = $viral_mag_plugin['slug'];
            $viral_mag_name = $viral_mag_plugin['name'];
            $viral_mag_filename = $viral_mag_plugin['filename'];
            $viral_mag_thumb = $viral_mag_plugin['thumb_path'];
            ?>
            <div class="recommended-plugins">
                <div class="plugin-image">
                    <img src="<?php echo esc_url($viral_mag_thumb) ?>" />
                </div>

                <div class="plugin-title-wrap">
                    <div class="plugin-title">
                        <?php echo esc_html($viral_mag_name); ?>
                    </div>

                    <div class="plugin-btn-wrapper">
                        <?php if ($this->check_plugin_installed_state($viral_mag_slug, $viral_mag_filename) && !$this->check_plugin_active_state($viral_mag_slug, $viral_mag_filename)): ?>
                            <a target="_blank" href="<?php echo esc_url($this->plugin_generate_url('active', $viral_mag_slug, $viral_mag_filename)) ?>" class="button button-primary"><?php esc_html_e('Activate', 'viral-mag'); ?></a>
                        <?php elseif ($this->check_plugin_installed_state($viral_mag_slug, $viral_mag_filename)):
                            ?>
                            <button type="button" class="button button-disabled" disabled="disabled"><?php esc_html_e('Installed', 'viral-mag'); ?></button>
                        <?php else:
                            ?>
                            <a target="_blank" class="install-now button-primary" href="<?php echo esc_url($this->plugin_generate_url('install', $viral_mag_slug, $viral_mag_filename)) ?>">
                                <?php esc_html_e('Install Now', 'viral-mag'); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php }
        ?>
    </div>
    <?php
}