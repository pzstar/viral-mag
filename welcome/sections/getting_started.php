<?php
$viral_mag_steps = $this->setup_steps();
$viral_mag_done = count(wp_list_filter($viral_mag_steps, array('done' => true)));
$viral_mag_percent = round(100 * $viral_mag_done / count($viral_mag_steps));
?>
<div class="welcome-grid welcome-grid-start">
    <div class="welcome-card welcome-setup-checklist">
        <div class="welcome-setup-head">
            <div class="welcome-ring" style="--welcome-progress:<?php echo absint($viral_mag_percent); ?>" role="progressbar" aria-valuemin="0" aria-valuemax="<?php echo count($viral_mag_steps); ?>" aria-valuenow="<?php echo absint($viral_mag_done); ?>" aria-label="<?php esc_attr_e('Setup progress', 'viral-mag'); ?>">
                <span><?php echo absint($viral_mag_percent); ?>%</span>
            </div>
            <div>
                <h3><?php esc_html_e('Set Up Your Website', 'viral-mag'); ?></h3>
                <p class="welcome-setup-count"><?php /* translators: 1: steps done, 2: all steps */ printf(esc_html__('%1$d of %2$d done', 'viral-mag'), $viral_mag_done, count($viral_mag_steps)); ?></p>
            </div>
        </div>

        <ol class="welcome-setup-steps">
            <?php foreach ($viral_mag_steps as $viral_mag_step) { ?>
                <li class="<?php echo $viral_mag_step['done'] ? 'is-done' : 'is-todo'; ?>">
                    <span class="welcome-setup-mark dashicons <?php echo $viral_mag_step['done'] ? 'dashicons-yes' : ''; ?>" aria-hidden="true"></span>
                    <div class="welcome-setup-text">
                        <strong><?php echo esc_html($viral_mag_step['title']); ?></strong>
                        <span class="screen-reader-text"><?php echo $viral_mag_step['done'] ? esc_html__('(done)', 'viral-mag') : esc_html__('(to do)', 'viral-mag'); ?></span>
                        <p><?php echo esc_html($viral_mag_step['text']); ?></p>
                    </div>
                    <?php
                    if ($viral_mag_step['url']) {
                        echo '<a class="button' . ($viral_mag_step['done'] ? '' : ' button-primary') . '" href="' . esc_url($viral_mag_step['url']) . '">' . ($viral_mag_step['done'] ? esc_html__('Change', 'viral-mag') : esc_html__('Set up', 'viral-mag')) . '</a>';
                    } elseif (!$viral_mag_step['done']) {
                        echo $this->generate_hdi_install_button();
                    }
                    ?>
                </li>
            <?php } ?>
        </ol>
    </div>

    <div class="welcome-card welcome-demo-import">
        <div class="welcome-demo-thumb">
            <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/screenshot.jpg'); ?>" alt="<?php /* translators: %s: theme name */ printf(esc_attr__('%s Demo', 'viral-mag'), $this->theme_name); ?>">
            <a href="https://demo.hashthemes.com/viral-mag/" target="_blank" class="welcome-demo-view"><span class="dashicons dashicons-external" aria-hidden="true"></span><?php esc_html_e('View Demo', 'viral-mag'); ?></a>
        </div>
        <div class="welcome-card-body">
            <h3><?php esc_html_e('Start From a Demo', 'viral-mag'); ?></h3>
            <p><?php esc_html_e('Import a complete demo website, with its content and settings, in a single click, then replace the content with your own.', 'viral-mag'); ?></p>
            <?php echo $this->generate_hdi_install_button(); ?>
            <p class="welcome-small"><a href="https://hashthemes.com/documentation/viral-mag-documentation/#ImportDemoContent" target="_blank"><?php esc_html_e('How the demo importer works', 'viral-mag'); ?></a></p>
        </div>
    </div>
</div>

<div class="welcome-block">
    <div class="welcome-block-head">
        <h3><?php esc_html_e('Customize Your Site', 'viral-mag'); ?></h3>
        <a href="<?php echo esc_url(admin_url('customize.php')); ?>"><?php esc_html_e('Open the Customizer', 'viral-mag'); ?> <span aria-hidden="true">&rarr;</span></a>
    </div>
    <div class="welcome-quick-links">
        <?php foreach ($this->quick_links() as $viral_mag_link) { ?>
            <a class="welcome-quick-link" href="<?php echo esc_url($viral_mag_link['url']); ?>">
                <span class="dashicons <?php echo esc_attr($viral_mag_link['icon']); ?>" aria-hidden="true"></span>
                <?php echo esc_html($viral_mag_link['label']); ?>
            </a>
        <?php } ?>
    </div>
</div>

<div class="welcome-block">
    <div class="welcome-block-head">
        <h3><?php esc_html_e('Build Your Home Page', 'viral-mag'); ?></h3>
        <a href="https://hashthemes.com/documentation/viral-mag-documentation/#HomePageSetup" target="_blank"><?php esc_html_e('Step-by-step guide', 'viral-mag'); ?> <span aria-hidden="true">&rarr;</span></a>
    </div>
    <p class="welcome-block-intro"><?php esc_html_e('Viral Mag builds its home page with Elementor and the news widgets from Hash Elements.', 'viral-mag'); ?></p>

    <div class="welcome-grid welcome-grid-2">
        <div class="welcome-card welcome-method">
            <span class="welcome-method-icon dashicons dashicons-layout" aria-hidden="true"></span>
            <h4><?php esc_html_e('With Elementor', 'viral-mag'); ?></h4>
            <ol>
                <li><?php printf(esc_html__('Install and activate Elementor and Hash Elements from the %s.', 'viral-mag'), '<a href="' . esc_url(admin_url('admin.php?page=viral-mag-welcome&section=recommended_plugins')) . '">' . esc_html__('Recommended Plugins tab', 'viral-mag') . '</a>'); ?></li>
                <li><?php esc_html_e('Create a new page, choose the "Elementor Full Width" page template and save it.', 'viral-mag'); ?></li>
                <li><?php esc_html_e('Edit the page with Elementor and drag in the news widgets to design your home page.', 'viral-mag'); ?></li>
                <li><?php echo sprintf(esc_html__('In Appearance > Customize > %s, choose "A static page" and select your new page as the Homepage.', 'viral-mag'), '<a href="' . esc_url(admin_url('customize.php?autofocus[section]=static_front_page')) . '">' . esc_html__('Homepage Settings', 'viral-mag') . '</a>'); ?></li>
            </ol>
        </div>

        <div class="welcome-card welcome-method">
            <span class="welcome-method-icon dashicons dashicons-admin-customizer" aria-hidden="true"></span>
            <h4><?php esc_html_e('Then Customize the Rest', 'viral-mag'); ?></h4>
            <ol>
                <li><?php echo sprintf(esc_html__('Open %s to set up the header, footer, colors and typography.', 'viral-mag'), '<a href="' . esc_url(admin_url('customize.php')) . '">' . esc_html__('Appearance > Customize', 'viral-mag') . '</a>'); ?></li>
                <li><?php esc_html_e('Choose the blog and sidebar layouts under Blog and Sidebar.', 'viral-mag'); ?></li>
                <li><?php esc_html_e('Add your social profiles so they show in the header and footer.', 'viral-mag'); ?></li>
            </ol>
        </div>
    </div>
</div>
