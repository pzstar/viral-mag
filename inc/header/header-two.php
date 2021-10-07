<?php
/**
 * @package Viral Mag
 */
$viral_mag_mh_menu_hover_style = get_theme_mod('viral_mag_mh_menu_hover_style', 'hover-style6');
$viral_mag_th_disable_mobile = get_theme_mod('viral_mag_th_disable_mobile', false);
$viral_mag_tagline_position = get_theme_mod('viral_mag_tagline_position', 'vm-tagline-inline-logo');
$viral_mag_mh_border = get_theme_mod('viral_mag_mh_border', 'vm-no-border');

$viral_mag_header_class = array('vm-site-header', 'vm-header-two', $viral_mag_mh_menu_hover_style, $viral_mag_tagline_position, $viral_mag_mh_border);

if ($viral_mag_th_disable_mobile) {
    $viral_mag_header_class[] = 'vm-topheader-mobile-disable';
}
?>

<header id="vm-masthead" class="<?php echo esc_attr(implode(' ', $viral_mag_header_class)); ?>">
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

    <div class="vm-middle-header">
        <div class="vm-container">
            <div class="vm-middle-header-left">
                <?php
                $viral_mag_enable_social = get_theme_mod('viral_mag_mh_show_social', false);
                if ($viral_mag_enable_social) {
                    echo viral_mag_social_icons();
                }
                ?>
            </div>

            <div id="vm-site-branding">
                <?php viral_mag_header_logo(); ?>
            </div><!-- .site-branding -->

            <div class="vm-middle-header-right">
                <?php
                $viral_mag_enable_offcanvas = get_theme_mod('viral_mag_mh_show_offcanvas', true);
                $viral_mag_enable_search = get_theme_mod('viral_mag_mh_show_search', true);

                if ($viral_mag_enable_search) {
                    ?>
                    <div class="vm-search-button"><a href="javascript:void(0)"><i class="icofont-search-1"></i></a></div>
                    <?php
                }

                if ($viral_mag_enable_offcanvas) {
                    ?>
                    <div class="vm-offcanvas-nav"><a href="javascript:void(0)"><span></span><span></span><span></span></a></div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div class="vm-header">
        <div class="vm-container">
            <nav id="vm-site-navigation" class="vm-main-navigation">
                <?php viral_mag_main_navigation(); ?>
                <?php do_action('viral_mag_mobile_header'); ?>
            </nav><!--  #vm-site-navigation -->
        </div>
    </div>
</header><!--  #vm-masthead -->