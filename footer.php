<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Viral Mag
 */
?>

</div><!-- #content -->

<?php
$viral_mag_footer_col = get_theme_mod('viral_mag_footer_col', 'col-3-1-1-1');
$viral_mag_footer_copyright = get_theme_mod('viral_mag_footer_copyright', esc_html__('&copy; 2021 Viral Mag. All Right Reserved.', 'viral-mag'));
$viral_mag_footer_array = explode('-', $viral_mag_footer_col);
$count = count($viral_mag_footer_array);
$footer_col = $count - 2;
?>

<footer id="ht-colophon" class="ht-site-footer <?php echo esc_attr($viral_mag_footer_col) ?>">

    <?php if (viral_mag_check_active_footer()) { ?>
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
    <?php } ?>

    <?php if (!empty($viral_mag_footer_copyright)) { ?>
        <div class="ht-bottom-footer">
            <div class="ht-container">
                <div class="ht-site-info">
                    <?php echo do_shortcode($viral_mag_footer_copyright); ?>
                    <?php printf('%4$s <span class="sep"> | </span><a title="%3$s" href="%1$s" target="_blank">Viral Mag</a> %2$s', 'https://hashthemes.com/wordpress-theme/viral-mag/', esc_html__('by HashThemes', 'viral-mag'), esc_attr__('Download Viral News', 'viral-mag'), esc_html__('WordPress Theme', 'viral-mag')); ?>
                </div><!-- #site-info -->
            </div>
        </div>
    <?php } ?>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php
$backtotop = get_theme_mod('viral_mag_backtotop', true);
if ($backtotop) {
    ?>
    <a href="#" id="back-to-top" class="progress" data-tooltip="<?php esc_attr_e('Back To Top', 'viral-mag'); ?>">
        <i class="arrow_carrot-up"></i>
    </a>
    <?php
}
wp_footer();
?>
</body>
</html>
