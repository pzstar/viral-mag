<?php
/**
 * The main template file.
 *
 * @package Viral Mag
 */
get_header();

if (is_home()) {
    $viral_mag_show_title = get_theme_mod('viral_mag_show_title', true);
    ?>
    <header class="ht-main-header">
        <div class="ht-container">
            <?php
            if ($viral_mag_show_title && 'page' == get_option('show_on_front')) {
                $blog_page_id = get_option('page_for_posts');
                $viral_mag_title = get_the_title($blog_page_id);
                ?>
                <h1 class="ht-main-title"><?php echo esc_html($viral_mag_title); ?></h1>
                <?php
            }

            if (is_home() && 'page' == get_option('show_on_front')) {
                do_action('viral_mag_breadcrumbs');
            }
            ?>
        </div>
    </header><!-- .entry-header -->
    <?php
}
?>
<div class="ht-main-content ht-clearfix ht-container">
    <div class="ht-site-wrapper">
        <div id="primary" class="content-area">

            <?php if (have_posts()) : ?>

                <div class="site-main-loop">
                    <?php while (have_posts()) : the_post(); ?>

                        <?php
                        get_template_part('template-parts/content', 'summary');
                        ?>

                    <?php endwhile; ?>
                </div>
                <?php
                the_posts_pagination(
                        array(
                            'prev_text' => esc_html__('Prev', 'viral-mag'),
                            'next_text' => esc_html__('Next', 'viral-mag'),
                        )
                );
                ?>

            <?php else : ?>

                <?php get_template_part('template-parts/content', 'none'); ?>

            <?php endif; ?>

        </div><!-- #primary -->

        <?php get_sidebar(); ?>
    </div>
</div>

<?php
get_footer();
