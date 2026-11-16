<div class="welcome-grid welcome-grid-3 welcome-support">
    <div class="welcome-card welcome-help">
        <span class="welcome-help-icon dashicons dashicons-media-document" aria-hidden="true"></span>
        <h3><?php echo esc_html__('Documentation', 'viral-mag'); ?></h3>
        <p><?php
        printf(
            /* translators: Theme Name */
            esc_html__('Step-by-step guides for every part of %s, from importing a demo and building the home page to each Customizer option.', 'viral-mag'), esc_html($this->theme_name));
        ?></p>
        <a class="welcome-btn welcome-btn-primary" target="_blank" href="https://hashthemes.com/documentation/viral-mag-documentation/"><?php echo esc_html__('Read Full Documentation', 'viral-mag'); ?></a>
    </div>

    <div class="welcome-card welcome-help">
        <span class="welcome-help-icon dashicons dashicons-format-chat" aria-hidden="true"></span>
        <h3><?php echo esc_html__('Get Support', 'viral-mag'); ?></h3>
        <p><?php echo esc_html__('Stuck on something the documentation does not answer? Open a support ticket and our team will help you sort it out.', 'viral-mag'); ?></p>
        <a class="welcome-btn welcome-btn-primary" target="_blank" href="https://hashthemes.com/support/forum/viral-mag/"><?php echo esc_html__('Open a Support Ticket', 'viral-mag'); ?></a>
    </div>

    <div class="welcome-card welcome-help">
        <span class="welcome-help-icon dashicons dashicons-star-filled" aria-hidden="true"></span>
        <h3><?php echo esc_html__('Rate the Theme', 'viral-mag'); ?></h3>
        <p>
            <?php
            /* translators: %s: theme name */
            printf(esc_html__('Enjoying %s? A short review on WordPress.org helps other people find the theme and keeps us improving it.', 'viral-mag'), esc_html($this->theme_name));
            ?>
        </p>
        <a class="welcome-btn welcome-btn-primary" target="_blank" href="https://wordpress.org/support/theme/viral-mag/reviews/?filter=5#new-post"><?php echo esc_html__('Leave a Review', 'viral-mag'); ?></a>
    </div>
</div>
