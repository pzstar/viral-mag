<?php
if (!function_exists('viral_mag_home_header')) {

    function viral_mag_home_header() {
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
    }
}

if (!function_exists('viral_mag_home_content')) {

    function viral_mag_home_content() {
        ?>
        <div class="ht-main-content ht-clearfix ht-container">
            <div class="ht-site-wrapper">
                <div id="primary" class="content-area">

                    <?php if (have_posts()) : ?>

                        <div class="site-main-loop">
                            <?php while (have_posts()) : the_post();
                                get_template_part('template-parts/content', 'summary');
                            endwhile; ?>
                        </div>
                        <?php
                        the_posts_pagination(
                            array(
                                'prev_text' => esc_html__('Prev', 'viral-mag'),
                                'next_text' => esc_html__('Next', 'viral-mag'),
                            )
                        );

                    else : 
                        get_template_part('template-parts/content', 'none');
                    endif; ?>

                </div><!-- #primary -->

                <?php get_sidebar(); ?>
            </div>
        </div>
        <?php
    }
}


if (!function_exists('viral_mag_search_header')) {

    function viral_mag_search_header() {
        ?>
        <header class="ht-main-header">
            <div class="ht-container">
                <h1 class="ht-main-title"><?php printf(esc_html__('Search Results for: %s', 'viral-mag'), '<span>' . get_search_query() . '</span>'); ?></h1>
                <?php do_action('viral_mag_breadcrumbs'); ?>
            </div>
        </header><!-- .entry-header -->
        <?php
    }
}

if (!function_exists('viral_mag_search_content')) {

    function viral_mag_search_content() {
        ?>
        <div class="ht-main-content ht-clearfix ht-container">
            <div class="ht-site-wrapper">
                <div id="primary" class="content-area">

                    <?php if (have_posts()) : 
                        /* Start the Loop */ 
                        while (have_posts()) : the_post();
                            /**
                             * Run the loop for the search to output the results.
                             * If you want to overload this in a child theme then include a file
                             * called content-search.php and that will be used instead.
                             */
                            get_template_part('template-parts/content', 'search');
                            
                        endwhile;
                        the_posts_pagination(
                            array(
                                'prev_text' => esc_html__('Prev', 'viral-mag'),
                                'next_text' => esc_html__('Next', 'viral-mag'),
                            )
                        );
                    else : 
                        get_template_part('template-parts/content', 'none');
                    endif; ?>

                </div><!-- #primary -->

                <?php get_sidebar(); ?>
            </div>
        </div>
        <?php
    }
}


if (!function_exists('viral_mag_archive_header')) {

    function viral_mag_archive_header() {
        $viral_mag_show_title = get_theme_mod('viral_mag_show_title', true);
        ?>
        <header class="ht-main-header">
            <div class="ht-container">
                <?php
                if ($viral_mag_show_title) {
                    the_archive_title('<h1 class="ht-main-title">', '</h1>');
                    the_archive_description('<div class="taxonomy-description">', '</div>');
                }

                do_action('viral_mag_breadcrumbs');
                ?>
            </div>
        </header><!-- .entry-header -->

        <?php
    }
}

if (!function_exists('viral_mag_archive_content')) {

    function viral_mag_archive_content() {
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
        <?php
    }
}


add_action('viral_mag_home_template', 'viral_mag_home_header', 10);
add_action('viral_mag_home_template', 'viral_mag_home_content', 20);

add_action('viral_mag_search_template', 'viral_mag_search_header', 10);
add_action('viral_mag_search_template', 'viral_mag_search_content', 20);

add_action('viral_mag_archive_template', 'viral_mag_archive_header', 10);
add_action('viral_mag_archive_template', 'viral_mag_archive_content', 20);