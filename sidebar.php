<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Viral Mag
 */
$viral_mag_sidebar_layout = "right-sidebar";

if (is_singular('page')) {
    $viral_mag_sidebar_layout = get_theme_mod('viral_mag_page_layout', 'right-sidebar');
} elseif (is_singular('post')) {
    $viral_mag_sidebar_layout = get_theme_mod('viral_mag_post_layout', 'right-sidebar');
} elseif (is_singular('product')) {
    $viral_mag_sidebar_layout = get_theme_mod('viral_mag_shop_layout', 'right-sidebar');
} elseif (is_archive() && !is_home() && !is_search()) {
    $viral_mag_sidebar_layout = get_theme_mod('viral_mag_archive_layout', 'right-sidebar');
} elseif (is_home()) {
    $viral_mag_sidebar_layout = get_theme_mod('viral_mag_home_blog_layout', 'right-sidebar');
} elseif (is_search()) {
    $viral_mag_sidebar_layout = get_theme_mod('viral_mag_search_layout', 'right-sidebar');
}

if ($viral_mag_sidebar_layout == "no-sidebar" || $viral_mag_sidebar_layout == "no-sidebar-narrow") {
    return;
}

if (is_active_sidebar('viral-mag-right-sidebar') && $viral_mag_sidebar_layout == "right-sidebar") {
    ?>
    <div id="secondary" class="widget-area">
        <div class="theiaStickySidebar">
            <?php dynamic_sidebar('viral-mag-right-sidebar'); ?>
        </div>
    </div><!-- #secondary -->
    <?php
}

if (is_active_sidebar('viral-mag-left-sidebar') && $viral_mag_sidebar_layout == "left-sidebar") {
    ?>
    <div id="secondary" class="widget-area">
        <div class="theiaStickySidebar">
            <?php dynamic_sidebar('viral-mag-left-sidebar'); ?>
        </div>
    </div><!-- #secondary -->
    <?php
}