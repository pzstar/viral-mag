<div class="ht-main-content ht-container">
    <?php do_action('viral_mag_breadcrumbs'); ?>

    <div class="ht-site-wrapper">
        <div id="primary" class="content-area">

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <?php while (have_posts()) : the_post(); ?>

                    <div class="entry-header"> 
                        <?php
                        viral_mag_single_category();

                        the_title('<h1 class="entry-title">', '</h1>');

                        viral_mag_single_post_meta();
                        ?>
                    </div>

                    <div class="entry-wrapper">  

                        <?php get_template_part('template-parts/post-format/content', get_post_format()); ?>

                        <div class="entry-content">
                            <?php
                            the_content();

                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . esc_html__('Pages:', 'viral-mag'),
                                'after' => '</div>',
                            ));
                            ?>
                        </div><!-- .entry-content -->

                        <?php
                        viral_mag_single_tag();
                        ?>

                    </div>

                <?php endwhile; // End of the loop.   ?>

            </article><!-- #post-## -->

            <?php
            viral_mag_single_author_box();
            viral_mag_single_pagination();
            viral_mag_single_comment();
            ?>
        </div><!-- #primary -->

        <?php get_sidebar(); ?>
    </div>

</div>