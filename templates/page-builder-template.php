<?php
/**
 * Template Name: Blank Template(For Page Builders)
 *
 * @package Viral Mag
 */
get_header();
?>

<div class="vm-container">

    <?php while (have_posts()) : the_post(); ?>

        <?php the_content(); ?>

    <?php endwhile; // End of the loop.   ?>

</div>

<?php
get_footer();
