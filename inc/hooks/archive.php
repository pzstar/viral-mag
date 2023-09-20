<?php
if (!function_exists('viral_mag_home_header')) {

    function viral_mag_home_header() {
        if (is_home()) {
            $viral_mag_show_title = get_theme_mod('viral_mag_show_title', true);
            ?>
            <header class="vm-main-header">
                <div class="vm-container">
                    <?php
                    if ($viral_mag_show_title && 'page' == get_option('show_on_front')) {
                        $blog_page_id = get_option('page_for_posts');
                        $viral_mag_title = get_the_title($blog_page_id);
                        ?>
                        <h1 class="vm-main-title"><?php echo esc_html($viral_mag_title); ?></h1>
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
        <div class="vm-main-content vm-clearfix vm-container" <?php echo viral_mag_get_schema_attribute('blog'); ?>>
            <div class="vm-site-wrapper">
                <div id="primary" class="content-area">

                    <?php if (have_posts()) : ?>

                        <div class="site-main-loop">
                            <?php
                            while (have_posts()) : the_post();
                                viral_mag_content_summary();
                            endwhile;
                            ?>
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
                    endif;
                    ?>

                </div><!-- #primary -->

                <?php get_sidebar(); ?>
            </div>
        </div>
        <?php
    }

}

if (!function_exists('viral_mag_content_summary')) {

    function viral_mag_content_summary() {
        $blog_layout = viral_mag_get_blog_layout();

        if (function_exists('viral_mag_blog_' . $blog_layout)) {
            call_user_func('viral_mag_blog_' . $blog_layout);
        } else {
            viral_mag_blog_layout1();
        }
    }

}

if (!function_exists('viral_mag_get_blog_layout')) {

    function viral_mag_get_blog_layout() {

        $blog_layout = get_theme_mod('viral_mag_blog_layout', 'layout1');
        return apply_filters('viral_mag_blog_layout', $blog_layout);
    }

}

/** Blog Post Layout 1 */
if (!function_exists('viral_mag_blog_layout1')) {

    function viral_mag_blog_layout1() {
        $viral_mag_is_updated_date = get_theme_mod('viral_mag_blog_display_date_option', 'posted') == 'updated' ? true : false;
        $viral_mag_archive_content = get_theme_mod('viral_mag_archive_content', 'excerpt');
        $viral_mag_blog_date = get_theme_mod('viral_mag_blog_date', true);
        $viral_mag_blog_author = get_theme_mod('viral_mag_blog_author', true);
        $viral_mag_blog_comment = get_theme_mod('viral_mag_blog_comment', true);
        $viral_mag_blog_category = get_theme_mod('viral_mag_blog_category', true);
        $viral_mag_blog_tag = get_theme_mod('viral_mag_blog_tag', true);
        $viral_mag_archive_excerpt_length = get_theme_mod('viral_mag_archive_excerpt_length', '100');
        $viral_mag_archive_readmore = get_theme_mod('viral_mag_archive_readmore', esc_html__('Read More', 'viral-mag'));
        $viral_mag_sidebar_layout = 'right-sidebar';
        if (is_archive() && !is_home() && !is_search()) {
            $viral_mag_sidebar_layout = get_theme_mod('viral_mag_archive_layout', 'right-sidebar');
        } elseif (is_home()) {
            $viral_mag_sidebar_layout = get_theme_mod('viral_mag_home_blog_layout', 'right-sidebar');
        } elseif (is_search()) {
            $viral_mag_sidebar_layout = get_theme_mod('viral_mag_search_layout', 'right-sidebar');
        }

        if ($viral_mag_sidebar_layout == 'no-sidebar' || $viral_mag_sidebar_layout == 'no-sidebar-narrow') {
            $image_size = 'viral-mag-1300x540';
        } else {
            $image_size = 'viral-mag-800x500';
        }
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(array('viral-mag-hentry', 'blog-layout1')); ?> <?php echo viral_mag_get_schema_attribute('article'); ?>>
            <div class="vm-post-wrapper">
                <?php if (has_post_thumbnail()): ?>
                    <figure class="entry-figure">
                        <?php
                        $viral_mag_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $image_size);
                        ?>
                        <a href="<?php the_permalink(); ?>">
                            <div class="entry-thumb-container">
                                <img src="<?php echo esc_url($viral_mag_image[0]); ?>" alt="<?php echo esc_attr(get_the_title()) ?>">
                            </div>
                        </a>
                    </figure>
                <?php endif; ?>

                <div class="vm-post-content">

                    <header class="entry-header">
                        <?php if ('post' == get_post_type() && $viral_mag_blog_date) : ?>
                            <div class="vm-post-date">
                                <?php
                                $post_date = $viral_mag_is_updated_date ? get_the_modified_date('d') : get_the_date('d');
                                $post_month = $viral_mag_is_updated_date ? get_the_modified_date('M') : get_the_date('M');
                                ?>
                                <span class="entry-date">
                                    <span class="vm-day">
                                        <?php echo $post_date; ?>
                                    </span>
                                    <span class="vm-month-year">
                                        <?php echo $post_month; ?> 
                                    </span>
                                </span>
                            </div><!-- .entry-meta -->
                        <?php endif; ?>

                        <div class="vm-post-header">
                            <?php the_title(sprintf('<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>'); ?>
                            <?php if ('post' == get_post_type() && ($viral_mag_blog_author || $viral_mag_blog_comment || $viral_mag_blog_category || $viral_mag_blog_tag)) { ?>
                                <div class="entry-meta">
                                    <?php
                                    if ($viral_mag_blog_author) {
                                        echo viral_mag_entry_author();
                                    }

                                    if ($viral_mag_blog_comment) {
                                        echo viral_mag_comment_link();
                                    }

                                    if ($viral_mag_blog_category) {
                                        echo viral_mag_entry_category();
                                    }

                                    if ($viral_mag_blog_tag) {
                                        echo viral_mag_entry_tag();
                                    }
                                    ?>
                                </div>
                            <?php } ?>
                        </div>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <?php
                        if ($viral_mag_archive_content == 'excerpt') {
                            echo wp_trim_words(strip_shortcodes(get_the_content()), $viral_mag_archive_excerpt_length);
                        } else {
                            the_content();
                        }
                        ?>
                    </div><!-- .entry-content -->

                    <?php if ($viral_mag_archive_content == 'excerpt') { ?>
                        <div class="entry-readmore">
                            <a href="<?php the_permalink(); ?>"><?php echo $viral_mag_archive_readmore; ?></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </article><!-- #post-## -->
        <?php
    }

}

/** Blog Post Layout 2 */
if (!function_exists('viral_mag_blog_layout2')) {

    function viral_mag_blog_layout2() {
        $viral_mag_is_updated_date = get_theme_mod('viral_mag_blog_display_date_option', 'posted') == 'updated' ? true : false;
        $viral_mag_archive_content = get_theme_mod('viral_mag_archive_content', 'excerpt');
        $viral_mag_blog_date = get_theme_mod('viral_mag_blog_date', true);
        $viral_mag_blog_author = get_theme_mod('viral_mag_blog_author', true);
        $viral_mag_blog_comment = get_theme_mod('viral_mag_blog_comment', true);
        $viral_mag_blog_category = get_theme_mod('viral_mag_blog_category', true);
        $viral_mag_blog_tag = get_theme_mod('viral_mag_blog_tag', true);
        $viral_mag_archive_excerpt_length = get_theme_mod('viral_mag_archive_excerpt_length', '100');
        $viral_mag_archive_readmore = get_theme_mod('viral_mag_archive_readmore', esc_html__('Read More', 'viral-mag'));
        $viral_mag_sidebar_layout = 'right-sidebar';
        if (is_archive() && !is_home() && !is_search()) {
            $viral_mag_sidebar_layout = get_theme_mod('viral_mag_archive_layout', 'right-sidebar');
        } elseif (is_home()) {
            $viral_mag_sidebar_layout = get_theme_mod('viral_mag_home_blog_layout', 'right-sidebar');
        } elseif (is_search()) {
            $viral_mag_sidebar_layout = get_theme_mod('viral_mag_search_layout', 'right-sidebar');
        }

        if ($viral_mag_sidebar_layout == 'no-sidebar' || $viral_mag_sidebar_layout == 'no-sidebar-narrow') {
            $image_size = 'viral-mag-1300x540';
        } else {
            $image_size = 'viral-mag-800x500';
        }
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(array('viral-mag-hentry', 'blog-layout2')); ?>>

            <div class="vm-post-wrapper">
                <?php if (has_post_thumbnail()): ?>
                    <figure class="entry-figure">
                        <?php
                        $viral_mag_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $image_size);
                        ?>
                        <a href="<?php the_permalink(); ?>">
                            <div class="entry-thumb-container">
                                <img src="<?php echo esc_url($viral_mag_image[0]); ?>" alt="<?php echo esc_attr(get_the_title()) ?>">
                            </div>
                        </a>
                    </figure>
                <?php endif; ?>

                <div class="entry-body vm-clearfix">
                    <?php if ('post' == get_post_type() && ($viral_mag_blog_date || $viral_mag_blog_author || $viral_mag_blog_comment)) : ?>
                        <div class="vm-post-info">
                            <?php
                            $avatar = get_avatar(get_the_author_meta('ID'), 48);
                            $post_date = $viral_mag_is_updated_date ? get_the_modified_date('d') : get_the_date('d');
                            $post_month = $viral_mag_is_updated_date ? get_the_modified_date('M') : get_the_date('M');

                            $author = sprintf(
                                    esc_html_x('By %s', 'post author', 'viral-mag'), '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
                            );
                            if ($viral_mag_blog_date) {
                                ?>
                                <div class="vm-post-date">
                                    <div class="entry-date published updated">
                                        <div class="vm-day"><?php echo $post_date; ?></div>
                                        <div class="vm-month"><?php echo $post_month; ?></div>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php
                            if ($viral_mag_blog_author) {
                                echo $avatar;
                                echo '<div class="entry-author">' . $author . '</div>';
                            }

                            if ($viral_mag_blog_comment) {
                                echo viral_mag_comment_link();
                            }
                            ?>
                        </div><!-- .entry-meta -->
                    <?php endif; ?>


                    <div class="vm-post-content">
                        <?php if ('post' == get_post_type() && ($viral_mag_blog_category || $viral_mag_blog_tag)) { ?>
                            <div class="entry-meta">
                                <?php
                                if ($viral_mag_blog_category) {
                                    echo viral_mag_entry_category();
                                }

                                if ($viral_mag_blog_tag) {
                                    echo viral_mag_entry_tag();
                                }
                                ?>
                            </div>
                        <?php } ?>

                        <header class="entry-header">
                            <?php the_title(sprintf('<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>'); ?>
                        </header><!-- .entry-header -->

                        <div class="entry-content">
                            <?php
                            if ($viral_mag_archive_content == 'excerpt') {
                                echo wp_trim_words(strip_shortcodes(get_the_content()), $viral_mag_archive_excerpt_length);
                            } else {
                                the_content();
                            }
                            ?>
                        </div><!-- .entry-content -->

                        <?php if ($viral_mag_archive_content == 'excerpt') { ?>
                            <div class="entry-readmore">
                                <a href="<?php the_permalink(); ?>"><?php echo $viral_mag_archive_readmore; ?></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </article><!-- #post-## -->

        <?php
    }

}

if (!function_exists('viral_mag_search_header')) {

    function viral_mag_search_header() {
        ?>
        <header class="vm-main-header">
            <div class="vm-container">
                <h1 class="vm-main-title"><?php printf(esc_html__('Search Results for: %s', 'viral-mag'), '<span>' . get_search_query() . '</span>'); ?></h1>
                <?php do_action('viral_mag_breadcrumbs'); ?>
            </div>
        </header><!-- .entry-header -->
        <?php
    }

}

if (!function_exists('viral_mag_search_content')) {

    function viral_mag_search_content() {
        ?>
        <div class="vm-main-content vm-clearfix vm-container">
            <div class="vm-site-wrapper">
                <div id="primary" class="content-area">

                    <?php
                    if (have_posts()) :
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
                    endif;
                    ?>

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
        <header class="vm-main-header">
            <div class="vm-container">
                <?php
                if ($viral_mag_show_title) {
                    the_archive_title('<h1 class="vm-main-title">', '</h1>');
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
        <div class="vm-main-content vm-clearfix vm-container">
            <div class="vm-site-wrapper">
                <div id="primary" class="content-area">

                    <?php if (have_posts()) : ?>

                        <div class="site-main-loop">
                            <?php while (have_posts()) : the_post(); ?>

                                <?php
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
        <?php
    }

}


add_action('viral_mag_home_template', 'viral_mag_home_header', 10);
add_action('viral_mag_home_template', 'viral_mag_home_content', 20);

add_action('viral_mag_search_template', 'viral_mag_search_header', 10);
add_action('viral_mag_search_template', 'viral_mag_search_content', 20);

add_action('viral_mag_archive_template', 'viral_mag_archive_header', 10);
add_action('viral_mag_archive_template', 'viral_mag_archive_content', 20);
