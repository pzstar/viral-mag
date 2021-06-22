<?php
/**
 * @package Viral Mag
 */
$viral_mag_mh_menu_hover_style = get_theme_mod('viral_mag_mh_menu_hover_style', 'hover-style6');
$viral_mag_th_disable_mobile = get_theme_mod('viral_mag_th_disable_mobile', false);
$viral_mag_tagline_position = get_theme_mod('viral_mag_tagline_position', 'ht-tagline-inline-logo');
$viral_mag_mh_border = get_theme_mod('viral_mag_mh_border', 'ht-no-border');

$viral_mag_header_class = array('ht-site-header', 'ht-header-three', $viral_mag_mh_menu_hover_style, $viral_mag_tagline_position, $viral_mag_mh_border);

if ($viral_mag_th_disable_mobile) {
    $viral_mag_header_class[] = 'ht-topheader-mobile-disable';
}
?>

<header id="ht-masthead" class="<?php echo esc_attr(implode(' ', $viral_mag_header_class)); ?>">
    <?php
    $viral_mag_top_header = get_theme_mod('viral_mag_top_header', 'on');
    if ($viral_mag_top_header == 'on') {
        ?>
        <div class="ht-top-header">
            <div class="ht-container">
                <?php do_action('viral_mag_top_header'); ?>
            </div>
        </div><!-- .ht-top-header -->
    <?php } ?>

    <div class="ht-header">
        <div class="ht-container">
            <div id="ht-site-branding">
                <?php viral_mag_header_logo(); ?>
            </div><!-- .site-branding -->

            <nav id="ht-site-navigation" class="ht-main-navigation">
                <?php viral_mag_main_navigation(); ?>
            </nav><!-- #ht-site-navigation -->
            
            <div class="ht-site-buttons">
                <?php do_action('viral_mag_mobile_header'); ?>
            </div>
        </div>
    </div>
</header><!-- #ht-masthead -->