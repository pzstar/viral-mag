<?php
/**
 * Template part for displaying posts.
 *
 * @package Viral Mag
 */
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

if($viral_mag_sidebar_layout == 'no-sidebar' || $viral_mag_sidebar_layout == 'no-sidebar-narrow'){
    $image_size = 'viral-mag-1300x540';
}else{
    $image_size = 'viral-mag-800x500';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(array('viral-mag-hentry', 'blog-layout1')); ?>>
    <div class="ht-post-wrapper">
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

        <div class="ht-post-content">

            <header class="entry-header">
                <?php if ('post' == get_post_type() && $viral_mag_blog_date) : ?>
                    <div class="ht-post-date">
                        <?php
                        $post_date = get_the_date('d');
                        $post_month = get_the_date('M');
                        ?>
                        <span class="entry-date">
                            <span class="ht-day">
                                <?php echo $post_date; ?>
                            </span>
                            <span class="ht-month-year">
                                <?php echo $post_month; ?> 
                            </span>
                        </span>
                    </div><!-- .entry-meta -->
                <?php endif; ?>

                <div class="ht-post-header">
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