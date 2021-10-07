<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Viral Mag
 */
get_header();

$viral_mag_show_title = get_theme_mod('viral_mag_show_title', true);
?>
<header class="vm-main-header">
    <div class="vm-container">
        <?php
        if ($viral_mag_show_title) {
            $author = get_queried_object();
            $author_id = $author->ID;

            $author_avatar = get_avatar(get_the_author_meta('user_email', $author_id), apply_filters('viral_mag_author_bio_avatar_size', 100));

            if ($author_avatar) {
                ?>
                <div class="author-post-avatar">
                    <?php echo $author_avatar; ?>
                </div>
                <?php
            }

            the_archive_title('<h1 class="vm-main-title">', '</h1>');
            the_archive_description('<div class="taxonomy-description">', '</div>');
            ?>

            <div class="author-post-count">
                <?php
                printf(esc_html__('%d Posts', 'viral-mag'), count_user_posts($author_id));
                ?>
            </div>

            <?php
        }
        do_action('viral_mag_breadcrumbs');
        ?>
    </div>
</header><!-- .entry-header -->

<div class="vm-main-content vm-clearfix vm-container">
    <div class="vm-site-wrapper">
        <div id="primary" class="content-area">

            <?php if (have_posts()) : ?>

                <div class="site-main-loop">
                    <?php while (have_posts()) : the_post(); ?>

                        <?php
                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        viral_mag_content_summary();
                        ?>

                    <?php endwhile; ?>
                </div>
                <?php
                the_posts_pagination(array(
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

<?php get_footer(); ?>
