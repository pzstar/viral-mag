<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Viral Mag
 */
if (!function_exists('viral_mag_posted_on')) {

    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function viral_mag_posted_on() {

        $viral_mag_single_author = get_theme_mod('viral_mag_single_author', true);
        $viral_mag_single_date = get_theme_mod('viral_mag_single_date', true);
        $viral_mag_single_comment_count = get_theme_mod('viral_mag_single_comment_count', true);
        $viral_mag_single_views = get_theme_mod('viral_mag_single_views', true);
        $viral_mag_single_reading_time = get_theme_mod('viral_mag_single_reading_time', true);

        if ($viral_mag_single_author) {
            $avatar = get_avatar(get_the_author_meta('ID'), 32);
            $author = $avatar . '<span class="author vcard">' . esc_html(get_the_author()) . '</span>';

            echo '<span class="entry-author"> ' . $author . '</span>';
        }

        if ($viral_mag_single_date) {
            $ago_format = get_theme_mod('viral_mag_display_time_ago', false);

            $get_the_date = get_the_date();
            $get_the_modified_date = get_the_modified_date();

            if ($ago_format) {
                $get_the_date = sprintf(_x('%s ago', '%s = human-readable time difference', 'viral-mag'), human_time_diff(get_the_time('U'), current_time('timestamp')));
                $get_the_modified_date = sprintf(_x('%s ago', '%s = human-readable time difference', 'viral-mag'), human_time_diff(get_the_modified_date('U'), current_time('timestamp')));
            }

            $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

            if (get_the_time('U') !== get_the_modified_time('U')) {
                $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
            }

            $time_string = sprintf(
                    $time_string, esc_attr(get_the_date(DATE_W3C)), esc_html($get_the_date), esc_attr(get_the_modified_date(DATE_W3C)), esc_html($get_the_modified_date)
            );

            echo '<span class="entry-post-date"><i class="mdi mdi-clock-time-four-outline"></i>' . $time_string . '</span>';
        }

        if ($viral_mag_single_comment_count) {
            $comment_count = get_comments_number(); // get_comments_number returns only a numeric value

            if (comments_open()) {
                if ($comment_count == 0) {
                    $comments = esc_html__('0 Comments', 'viral-mag');
                } elseif ($comment_count > 1) {
                    $comments = $comment_count . esc_html__(' Comments', 'viral-mag');
                } else {
                    $comments = esc_html__('1 Comment', 'viral-mag');
                }
                $comment_link = $comments;
            } else {
                $comment_link = "";
            }

            echo '<span class="entry-comment"><i class="mdi mdi-comment-outline"></i>' . $comment_link . '</span>';
        }
    }

}

if (!function_exists('viral_mag_post_author')) {

    function viral_mag_post_author() {
        echo '<span class="vl-posted-by"><i class="mdi mdi-account"></i>' . esc_html(get_the_author()) . '</span>';
    }

}

if (!function_exists('viral_mag_post_date')) {

    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function viral_mag_post_date() {
        $time_string = get_the_date();
        echo '<span class="vl-posted-on"><i class="mdi mdi-clock-time-four-outline"></i>' . $time_string . '</span>'; // WPCS: XSS OK.
    }

}

if (!function_exists('viral_mag_get_all_image_sizes')) {

    function viral_mag_get_all_image_sizes() {
        global $_wp_additional_image_sizes;

        $sizes = array();

        foreach (get_intermediate_image_sizes() as $_size) {
            if (in_array($_size, array('thumbnail', 'medium', 'medium_large', 'large'))) {
                $sizes[$_size]['width'] = get_option("{$_size}_size_w");
                $sizes[$_size]['height'] = get_option("{$_size}_size_h");
                $sizes[$_size]['crop'] = (bool) get_option("{$_size}_crop");
            } elseif (isset($_wp_additional_image_sizes[$_size])) {
                $sizes[$_size] = array(
                    'width' => $_wp_additional_image_sizes[$_size]['width'],
                    'height' => $_wp_additional_image_sizes[$_size]['height'],
                    'crop' => $_wp_additional_image_sizes[$_size]['crop'],
                );
            }
        }

        return $sizes;
    }

}

if (!function_exists('viral_mag_post_featured_image')) {

    function viral_mag_post_featured_image($viral_mag_image_size = 'full', $default_lazy_load = true) {

        $placeholder_image = get_theme_mod('viral_mag_placeholder_image');
        $viral_mag_get_all_image_sizes = viral_mag_get_all_image_sizes();

        if ($viral_mag_image_size == 'full') {
            $image_url = get_template_directory_uri() . '/images/placeholder.jpg';
        } elseif ($viral_mag_image_size == 'large') {
            $image_url = get_template_directory_uri() . '/images/placeholder-1300x540.jpg';
        } elseif ($viral_mag_image_size == 'medium') {
            $image_url = get_template_directory_uri() . '/images/placeholder-500x500.jpg';
        } elseif ($viral_mag_image_size == 'thumbnail') {
            $image_url = get_template_directory_uri() . '/images/placeholder-150x150.jpg';
        } else {
            $image_width = $viral_mag_get_all_image_sizes[$viral_mag_image_size]['width'];
            $image_height = $viral_mag_get_all_image_sizes[$viral_mag_image_size]['height'];
            $image_url = get_template_directory_uri() . '/images/placeholder-' . $image_width . 'x' . $image_height . '.jpg';
        }

        if (has_post_thumbnail()) {
            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), $viral_mag_image_size);
            $image_url = $image[0];
        } else {
            if ($placeholder_image) {
                $placeholder_image_id = attachment_url_to_postid($placeholder_image);
                $image = wp_get_attachment_image_src($placeholder_image_id, $viral_mag_image_size);
                $image_url = $image[0];
            }
        }

        echo '<img alt="' . esc_attr(get_the_title()) . '" src="' . esc_url($image_url) . '"/>';
    }

}

/* Single Page Content Functions */

if (!function_exists('viral_mag_single_featured_image')) {

    function viral_mag_single_featured_image() {
        if (has_post_thumbnail()) {
            ?>
            <figure class="single-entry-figure">
                <?php
                $viral_mag_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'viral-mag-840x420');
                ?>
                <img src="<?php echo esc_url($viral_mag_image[0]); ?>" alt="<?php echo esc_attr(get_the_title()) ?>">
            </figure>
            <?php
        }
    }

}

if (!function_exists('viral_mag_single_post_meta')) {

    function viral_mag_single_post_meta() {
        $viral_mag_single_author = get_theme_mod('viral_mag_single_author', true);
        $viral_mag_single_date = get_theme_mod('viral_mag_single_date', true);
        $viral_mag_single_comment_count = get_theme_mod('viral_mag_single_comment_count', true);
        $viral_mag_single_views = get_theme_mod('viral_mag_single_views', true);
        $viral_mag_single_reading_time = get_theme_mod('viral_mag_single_reading_time', true);

        if ('post' === get_post_type() && ($viral_mag_single_author || $viral_mag_single_date || $viral_mag_single_comment_count || $viral_mag_single_views || $viral_mag_single_reading_time)) {
            ?>
            <div class="single-entry-meta">
                <?php viral_mag_posted_on(); ?>
            </div><!-- .entry-meta -->
            <?php
        }
    }

}


if (!function_exists('viral_mag_single_category')) {

    function viral_mag_single_category() {
        $viral_mag_single_categories = get_theme_mod('viral_mag_single_categories', true);

        if ($viral_mag_single_categories && 'post' === get_post_type()) {
            $categories_list = get_the_category_list(', ');
            if ($categories_list) {
                echo '<div class="single-entry-category">';
                echo $categories_list;
                echo '</div>';
            }
        }
    }

}

if (!function_exists('viral_mag_single_tag')) {

    function viral_mag_single_tag() {
        $viral_mag_single_tags = get_theme_mod('viral_mag_single_tags', true);

        if ($viral_mag_single_tags && 'post' === get_post_type()) {
            $tags_list = get_the_tag_list('', '');
            if ($tags_list) {
                echo '<div class="single-entry-tags">';
                echo $tags_list;
                echo '</div>';
            }
        }
    }

}

if (!function_exists('viral_mag_single_author_box')) {

    function viral_mag_single_author_box() {

        global $post;

        $viral_mag_single_author_box = get_theme_mod('viral_mag_single_author_box', true);

        if ($viral_mag_single_author_box && 'post' === get_post_type() && isset($post->post_author)) {
            // Get Author Data
            $author = get_the_author();
            $author_description = get_the_author_meta('description', $post->post_author);
            $author_url = get_author_posts_url($post->post_author);
            $author_avatar = get_avatar(get_the_author_meta('user_email', $post->post_author), apply_filters('viral_mag_author_bio_avatar_size', 100));

            // Only display if author has a description
            //if ($author_description) {
            ?>

            <div class="viral-mag-author-info">

                <?php if ($author_avatar) { ?>
                    <div class="viral-mag-author-avatar">
                        <a href="<?php echo esc_url($author_url); ?>" rel="author">
                            <?php echo $author_avatar; ?>
                        </a>
                    </div><!-- .author-avatar -->
                <?php } ?>

                <div class="viral-mag-author-description">
                    <h5><?php printf(esc_html__('By %s', 'viral-mag'), esc_html($author)); ?></h5>
                    <?php if ($author_description) { ?>
                        <p><?php echo wp_kses_post($author_description); ?></p>
                    <?php } ?>

                    <div class="viral-mag-author-icons">
                        <?php
                        $web_url = get_the_author_meta('url', $post->post_author);
                        if ($web_url && $web_url != '') {
                            echo '<a href="' . esc_url($web_url) . '"><i class="icon_house"></i></a>';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <?php
            //}
        }
    }

}


if (!function_exists('viral_mag_single_pagination')) {

    function viral_mag_single_pagination() {
        $viral_mag_single_prev_next_post = get_theme_mod('viral_mag_single_prev_next_post', true);

        if ($viral_mag_single_prev_next_post) {
            ?>
            <nav class="navigation post-navigation" role="navigation">
                <div class="nav-links">
                    <div class="nav-previous ht-clearfix">
                        <?php
                        if ($prev_post = get_previous_post()) {
                            $prev_post_thumb = get_the_post_thumbnail($prev_post->ID, 'viral-mag-150x150');
                            previous_post_link('%link', $prev_post_thumb . '<span>' . esc_html__('Previous Post', 'viral-mag') . '</span>%title');
                        }
                        ?>
                    </div>

                    <div class="nav-next ht-clearfix">
                        <?php
                        if ($next_post = get_next_post()) {
                            $next_post_thumb = get_the_post_thumbnail($next_post->ID, 'viral-mag-150x150');
                            next_post_link('%link', $next_post_thumb . '<span>' . esc_html__('Next Post', 'viral-mag') . '</span>%title');
                        }
                        ?>
                    </div>
                </div>
            </nav>
            <?php
        }
    }

}

if (!function_exists('viral_mag_single_comment')) {

    function viral_mag_single_comment() {
        $viral_mag_single_comments = get_theme_mod('viral_mag_single_comments', true);
        // If comments are open or we have at least one comment, load up the comment template.
        if ($viral_mag_single_comments && (comments_open() || get_comments_number())) :
            comments_template();
        endif;
    }

}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function viral_mag_categorized_blog() {
    if (false === ( $all_the_cool_cats = get_transient('viral_mag_categories') )) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories(array(
            'fields' => 'ids',
            'hide_empty' => 1,
            // We only need to know if there is more than one category.
            'number' => 2,
        ));

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count($all_the_cool_cats);

        set_transient('viral_mag_categories', $all_the_cool_cats);
    }

    if ($all_the_cool_cats > 1) {
        // This blog has more than 1 category so viral_mag_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so viral_mag_categorized_blog should return false.
        return false;
    }
}

/**
 * Flush out the transients used in viral_mag_categorized_blog.
 */
function viral_mag_category_transient_flusher() {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient('viral_mag_categories');
}

add_action('edit_category', 'viral_mag_category_transient_flusher');
add_action('save_post', 'viral_mag_category_transient_flusher');


if (!function_exists('viral_mag_entry_author')) {

    function viral_mag_entry_author() {
        $author = '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '"><i class="mdi mdi-account"></i>' . esc_html(get_the_author()) . '</a></span>';
        echo '<span class="entry-author">' . $author . '</span>';
    }

}

if (!function_exists('viral_mag_entry_date')) {

    function viral_mag_entry_date() {
        $post_date = '<a href="' . esc_url(get_permalink()) . '"><i class="mdi mdi-clock-time-four-outline"></i>' . get_the_date() . '</a>';
        echo '<span class="entry-date">' . $post_date . '</span>';
    }

}

if (!function_exists('viral_mag_entry_category')) {

    function viral_mag_entry_category() {
        $categories_list = get_the_category_list(', ');
        if ($categories_list && viral_mag_categorized_blog()) {
            echo '<span class="entry-categories">';
            echo '<i class="mdi mdi-folder"></i>' . $categories_list;
            echo '</span>';
        }
    }

}

if (!function_exists('viral_mag_entry_tag')) {

    function viral_mag_entry_tag() {
        $tags_list = get_the_tag_list('<i class="mdi mdi-bookmark"></i>', ', ');
        if ($tags_list && viral_mag_categorized_blog()) {
            echo '<span class="entry-tags">';
            echo $tags_list;
            echo '</span>';
        }
    }

}

if (!function_exists('viral_mag_comment_link')) {

    function viral_mag_comment_link() {
        $comment_count = get_comments_number(); // get_comments_number returns only a numeric value
        $comment_link = "";

        if (comments_open()) {
            if ($comment_count == 0) {
                $comments = esc_html__('0 Comments', 'viral-mag');
            } elseif ($comment_count > 1) {
                $comments = $comment_count . esc_html__(' Comments', 'viral-mag');
            } else {
                $comments = esc_html__('1 Comment', 'viral-mag');
            }
            $comment_link .= '<span class="entry-comment">';
            $comment_link .= '<a class="comment-link" href="' . get_comments_link() . '"><i class="mdi mdi-comment"></i>' . $comments . '</a>';
            $comment_link .= '</span>';
        }

        return $comment_link;
    }

}

            