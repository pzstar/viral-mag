<?php
$viral_mag_image_size = 'viral-mag-800x500';
$viral_mag_sidebar_layout = get_theme_mod('viral_mag_post_layout', 'right-sidebar');
$viral_mag_post_layout = get_theme_mod('viral_mag_single_layout', 'layout1');

if ($viral_mag_sidebar_layout == 'no-sidebar' || $viral_mag_sidebar_layout == 'no-sidebar-narrow') {
    $viral_mag_image_size = 'viral-mag-1300x540';
}

if (has_post_thumbnail()) {
    ?>
    <figure class="single-entry-link">
        <?php echo get_the_post_thumbnail(get_the_ID(), $viral_mag_image_size); ?>
    </figure>
    <?php
}