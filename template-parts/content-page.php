<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Viral Mag
 */

if (has_post_thumbnail()) {
    ?>
    <figure class="entry-figure">
        <?php
        $viral_mag_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-mag-840x420');
        ?>
        <img src="<?php echo esc_url($viral_mag_image[0]); ?>" alt="<?php echo esc_attr(get_the_title()) ?>">
    </figure>
<?php }
?>

<div class="entry-content">
    <?php the_content(); ?>
    <?php
    wp_link_pages(array(
        'before' => '<div class="page-links">' . esc_html__('Pages:', 'viral-mag'),
        'after' => '</div>',
    ));
    ?>
</div><!-- .entry-content -->

