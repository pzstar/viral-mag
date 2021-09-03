<?php
if (!function_exists('viral_mag_footer_open')) {

    function viral_mag_footer_open() {
        $viral_mag_footer_col = get_theme_mod('viral_mag_footer_col', 'col-3-1-1-1');
        $footer_class = apply_filters('viral_mag_footer_class', array('ht-site-footer'));
        echo '</div><!-- #content -->';
        echo '<footer id="ht-colophon" class="' . implode(' ', $footer_class) ." ". esc_attr($viral_mag_footer_col) . '">';
    }

}

if (!function_exists('viral_mag_main_footer')) {

    function viral_mag_main_footer() {
        $viral_mag_footer_array = explode('-', $viral_mag_footer_col);
        $count = count($viral_mag_footer_array);
        $footer_col = $count - 2;
        if (viral_mag_check_active_footer()) { ?>
        <div class="ht-main-footer">
            <div class="ht-container">
                <div class="ht-main-footer-wrap ht-clearfix">
                    <?php
                    for ($i = 1; $i <= $footer_col; $i++) {
                        if (is_active_sidebar('viral-mag-footer' . $i)) {
                            ?>
                            <div class="ht-footer ht-footer<?php echo absint($i); ?>">
                                <?php dynamic_sidebar('viral-mag-footer' . $i); ?>  
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php }
    }
}

if (!function_exists('viral_mag_bottom_footer')) {

    function viral_mag_bottom_footer() {

        $viral_mag_footer_copyright = get_theme_mod('viral_mag_footer_copyright', esc_html__('&copy; 2021 Viral Mag. All Right Reserved.', 'viral-mag'));
        if (!empty($viral_mag_footer_copyright)) { ?>
            <div class="ht-bottom-footer">
                <div class="ht-container">
                    <div class="ht-site-info">
                        <?php echo do_shortcode($viral_mag_footer_copyright); ?>
                        <?php printf('%4$s <span class="sep"> | </span><a title="%3$s" href="%1$s" target="_blank">Viral Mag</a> %2$s', 'https://hashthemes.com/wordpress-theme/viral-mag/', esc_html__('by HashThemes', 'viral-mag'), esc_attr__('Download Viral News', 'viral-mag'), esc_html__('WordPress Theme', 'viral-mag')); ?>
                    </div><!-- #site-info -->
                </div>
            </div>
        <?php }
    }
}

if (!function_exists('viral_mag_scroll_top')) {

    function viral_mag_scroll_top() {
        $backtotop = get_theme_mod('viral_mag_backtotop', true);
        if ($backtotop) {
            ?>
            <a href="#" id="back-to-top" class="progress" data-tooltip="<?php esc_attr_e('Back To Top', 'viral-mag'); ?>">
                <i class="arrow_carrot-up"></i>
            </a>
            <?php
        }
    }
}

if (!function_exists('viral_mag_footer_close')) {

    function viral_mag_footer_close() {
        echo '</footer><!-- #colophon -->';
        echo '</div><!-- #page -->';
        wp_footer();
        echo '</body>';
        echo '</html>';
    }

}

add_action('viral_mag_footer_template', 'viral_mag_footer_open', 10);
add_action('viral_mag_footer_template', 'viral_mag_main_footer', 20);
add_action('viral_mag_footer_template', 'viral_mag_bottom_footer', 30);
add_action('viral_mag_footer_template', 'viral_mag_footer_close', 100);

add_action('wp_footer', 'viral_mag_scroll_top');

