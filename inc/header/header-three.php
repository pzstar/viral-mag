<?php
/**
 * @package Viral Mag
 */
$viral_mag_mh_menu_hover_style = get_theme_mod('viral_mag_mh_menu_hover_style', 'hover-style6');
$viral_mag_th_disable_mobile = get_theme_mod('viral_mag_th_disable_mobile', false);
$viral_mag_tagline_position = get_theme_mod('viral_mag_tagline_position', 'vm-tagline-inline-logo');
$viral_mag_mh_border = get_theme_mod('viral_mag_mh_border', 'vm-no-border');

$viral_mag_header_class = array('vm-site-header', 'vm-header-three', $viral_mag_mh_menu_hover_style, $viral_mag_tagline_position, $viral_mag_mh_border);

if ($viral_mag_th_disable_mobile) {
    $viral_mag_header_class[] = 'vm-topheader-mobile-disable';
}
?>

<header id="vm-masthead" class="<?php echo esc_attr(implode(' ', $viral_mag_header_class)); ?>" <?php echo viral_mag_get_schema_attribute('header'); ?>>
    <?php
    $viral_mag_top_header = get_theme_mod('viral_mag_top_header', 'on');
    if ($viral_mag_top_header == 'on') {
        ?>
        <div class="vm-top-header">
            <div class="vm-container">
                <?php do_action('viral_mag_top_header'); ?>
            </div>
        </div><!-- .vm-top-header -->
    <?php } ?>

    <div class="vm-header">
        <div class="vm-container">
            <div id="vm-site-branding">
                <?php viral_mag_header_logo(); ?>
            </div><!-- .site-branding -->

            <nav id="vm-site-navigation" class="vm-main-navigation">
                <?php viral_mag_main_navigation(); ?>
            </nav><!--  #vm-site-navigation -->

            <div class="vm-site-buttons">
                <?php do_action('viral_mag_mobile_header'); ?>
            </div>
        </div>
    </div>
</header><!--  #vm-masthead -->