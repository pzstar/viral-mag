<?php
if (!function_exists('viral_mag_404_content')) {

    function viral_mag_404_content() {
        $viral_mag_show_title = get_theme_mod('viral_mag_show_title', true);
        ?>
        <header class="ht-main-header">
            <div class="ht-container">
                <?php
                if ($viral_mag_show_title) {
                    ?>
                    <h1 class="ht-main-title"><?php esc_html_e('404 Error', 'viral-mag'); ?></h1>
                    <?php
                }

                do_action('viral_mag_breadcrumbs');
                ?>
            </div>
        </header><!-- .entry-header -->

        <div class="ht-container">
            <div class="oops-text"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'viral-mag'); ?></div>
            <div class="oops-image">
                <img alt="<?php esc_attr_e('404 Error', 'viral-mag'); ?>" src="<?php echo esc_url(get_template_directory_uri() . '/images/404.png'); ?>"/>
            </div>
        </div>

        <?php
    }

}

if (!function_exists('viral_mag_comments_content')) {

    function viral_mag_comments_content() {
        if (post_password_required()) {
            return;
        }
        ?>

        <div id="comments" class="comments-area">

            <?php // You can start editing here -- including this comment!    ?>

            <?php if (have_comments()) : ?>
                <h4 class="comments-title widget-title">
                    <?php
                    $viral_mag_comment_count = get_comments_number();
                    if ('1' === $viral_mag_comment_count) {
                        printf(
                                /* translators: 1: title. */
                                esc_html__('One thought on &ldquo;%1$s&rdquo;', 'viral-mag'), '<span>' . get_the_title() . '</span>'
                        );
                    } else {
                        printf(// WPCS: XSS OK.
                                /* translators: 1: comment count number, 2: title. */
                                esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $viral_mag_comment_count, 'comments title', 'viral-mag')), number_format_i18n($viral_mag_comment_count), '<span>' . get_the_title() . '</span>'
                        );
                    }
                    ?>
                </h4>

                <ul class="comment-list">
                    <?php
                    wp_list_comments(array(
                        'callback' => 'viral_mag_comment',
                        'avatar_size' => 60
                    ));
                    ?>
                </ul><!-- .comment-list -->

            <?php endif; // Check for have_comments().    ?>

            <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // Are there comments to navigate through?     ?>
                <nav class="navigation pagination">
                    <?php paginate_comments_links(); ?>
                </nav><!-- #comment-nav-above -->
            <?php endif; // Check for comment navigation.     ?>

            <?php
            // If comments are closed and there are comments, let's leave a little note, shall we?
            if (!comments_open() && '0' != get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
                ?>
                <p class="no-comments"><?php esc_html_e('Comments are closed.', 'viral-mag'); ?></p>
            <?php endif; ?>

            <?php
            $commenter = wp_get_current_commenter();
            $req = get_option('require_name_email');
            $aria_req = ( $req ? " aria-required='true'" : '' );
            $cookies_field = array();

            $fields = array(
                'author' =>
                '<div class="author-email-url ht-clearfix"><p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) .
                '" size="30"' . $aria_req . ' placeholder="' . esc_attr__('Name', 'viral-mag') . ( $req ? '*' : '' ) . '" /></p>',
                'email' =>
                '<p class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) .
                '" size="30"' . $aria_req . ' placeholder="' . esc_attr__('Email', 'viral-mag') . ( $req ? '*' : '' ) . '" /></p></div>',
                'url' =>
                '<p class="comment-form-url"><input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) .
                '" size="30" placeholder="' . esc_attr__('Website', 'viral-mag') . '" /></p>'
            );

            if (has_action('set_comment_cookies', 'wp_set_comment_cookies') && get_option('show_comments_cookies_opt_in')) {
                $consent = empty($commenter['comment_author_email']) ? '' : ' checked="checked"';
                $cookies_field = array('cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
                    '<label for="wp-comment-cookies-consent">' . esc_html__('Save my name, email, and website in this browser for the next time I comment.', 'viral-mag') . '</label></p>');

                $fields = array_merge($cookies_field, $fields);
            }

            $args = array(
                'fields' => apply_filters('viral_mag_comment_form_default_fields', $fields),
                'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="4" aria-required="true" placeholder="' . esc_attr__('Comment', 'viral-mag') . '">' .
                '</textarea></p>',
                'title_reply_before' => '<h4 id="reply-title" class="widget-title comment-reply-title">',
                'title_reply_after' => '</h4>',
            );
            ?>

            <?php comment_form($args); ?>

        </div><!-- #comments -->
        <?php
    }

}

function viral_mag_create_elementor_kit() {
    if (!did_action('elementor/loaded')) {
        return;
    }

    $kit = Elementor\Plugin::$instance->kits_manager->get_active_kit();

    if (!$kit->get_id()) {
        $created_default_kit = Elementor\Plugin::$instance->kits_manager->create_default();
        update_option('elementor_active_kit', $created_default_kit);
    }
}

function viral_mag_enable_wpform_export($args) {
    $args['can_export'] = true;
    return $args;
}

add_action('init', 'viral_mag_create_elementor_kit');
add_filter('wpforms_post_type_args', 'viral_mag_enable_wpform_export');

add_action('viral_mag_404_template', 'viral_mag_404_content');
add_action('viral_mag_comments_template', 'viral_mag_comments_content');

function viral_mag_migrate_theme_mods() {
    $mapping_array = array(
        'body_font_family' => 'viral_mag_body_family',
        'body_font_style' => 'viral_mag_body_style',
        'body_text_decoration' => 'viral_mag_body_text_decoration',
        'body_text_transform' => 'viral_mag_body_text_transform',
        'body_font_size' => 'viral_mag_body_size',
        'body_line_height' => 'viral_mag_body_line_height',
        'body_letter_spacing' => 'viral_mag_body_letter_spacing',
        'body_color' => 'viral_mag_body_color',
        'menu_font_family' => 'viral_mag_menu_family',
        'menu_font_style' => 'viral_mag_menu_style',
        'menu_text_decoration' => 'viral_mag_menu_text_decoration',
        'menu_text_transform' => 'viral_mag_menu_text_transform',
        'menu_font_size' => 'viral_mag_menu_size',
        'menu_line_height' => 'viral_mag_menu_line_height',
        'menu_letter_spacing' => 'viral_mag_menu_letter_spacing',
        'page_title_font_family' => 'viral_mag_page_title_family',
        'page_title_font_style' => 'viral_mag_page_title_style',
        'page_title_text_decoration' => 'viral_mag_page_title_text_decoration',
        'page_title_text_transform' => 'viral_mag_page_title_text_transform',
        'page_title_font_size' => 'viral_mag_page_title_size',
        'page_title_line_height' => 'viral_mag_page_title_line_height',
        'page_title_letter_spacing' => 'viral_mag_page_title_letter_spacing',
        'page_title_color' => 'viral_mag_page_title_color',
        'h_font_family' => 'viral_mag_h_family',
        'h_font_style' => 'viral_mag_h_style',
        'h_text_decoration' => 'viral_mag_h_text_decoration',
        'h_text_transform' => 'viral_mag_h_text_transform',
        'h_line_height' => 'viral_mag_h_line_height',
        'h_letter_spacing' => 'viral_mag_h_letter_spacing',
        'hh1_font_size' => 'viral_mag_hh1_size',
        'hh2_font_size' => 'viral_mag_hh2_size',
        'hh3_font_size' => 'viral_mag_hh3_size',
        'hh4_font_size' => 'viral_mag_hh4_size',
        'hh5_font_size' => 'viral_mag_hh5_size',
        'hh6_font_size' => 'viral_mag_hh6_size',
        'h1_font_family' => 'viral_mag_h1_family',
        'h1_font_style' => 'viral_mag_h1_style',
        'h1_text_decoration' => 'viral_mag_h1_text_decoration',
        'h1_text_transform' => 'viral_mag_h1_text_transform',
        'h1_font_size' => 'viral_mag_h1_size',
        'h1_line_height' => 'viral_mag_h1_line_height',
        'h1_letter_spacing' => 'viral_mag_h1_letter_spacing',
        'h2_font_family' => 'viral_mag_h2_family',
        'h2_font_style' => 'viral_mag_h2_style',
        'h2_text_decoration' => 'viral_mag_h2_text_decoration',
        'h2_text_transform' => 'viral_mag_h2_text_transform',
        'h2_font_size' => 'viral_mag_h2_size',
        'h2_line_height' => 'viral_mag_h2_line_height',
        'h2_letter_spacing' => 'viral_mag_h2_letter_spacing',
        'h3_font_family' => 'viral_mag_h3_family',
        'h3_font_style' => 'viral_mag_h3_style',
        'h3_text_decoration' => 'viral_mag_h3_text_decoration',
        'h3_text_transform' => 'viral_mag_h3_text_transform',
        'h3_font_size' => 'viral_mag_h3_size',
        'h3_line_height' => 'viral_mag_h3_line_height',
        'h3_letter_spacing' => 'viral_mag_h3_letter_spacing',
        'h4_font_family' => 'viral_mag_h4_family',
        'h4_font_style' => 'viral_mag_h4_style',
        'h4_text_decoration' => 'viral_mag_h4_text_decoration',
        'h4_text_transform' => 'viral_mag_h4_text_transform',
        'h4_font_size' => 'viral_mag_h4_size',
        'h4_line_height' => 'viral_mag_h4_line_height',
        'h4_letter_spacing' => 'viral_mag_h4_letter_spacing',
        'h5_font_family' => 'viral_mag_h5_family',
        'h5_font_style' => 'viral_mag_h5_style',
        'h5_text_decoration' => 'viral_mag_h5_text_decoration',
        'h5_text_transform' => 'viral_mag_h5_text_transform',
        'h5_font_size' => 'viral_mag_h5_size',
        'h5_line_height' => 'viral_mag_h5_line_height',
        'h5_letter_spacing' => 'viral_mag_h5_letter_spacing',
        'h6_font_family' => 'viral_mag_h6_family',
        'h6_font_style' => 'viral_mag_h6_style',
        'h6_text_decoration' => 'viral_mag_h6_text_decoration',
        'h6_text_transform' => 'viral_mag_h6_text_transform',
        'h6_font_size' => 'viral_mag_h6_size',
        'h6_line_height' => 'viral_mag_h6_line_height',
        'h6_letter_spacing' => 'viral_mag_h6_letter_spacing',
        'frontpage_block_title_font_family' => 'viral_mag_frontpage_block_title_family',
        'frontpage_block_title_font_style' => 'viral_mag_frontpage_block_title_style',
        'frontpage_block_title_text_decoration' => 'viral_mag_frontpage_block_title_text_decoration',
        'frontpage_block_title_text_transform' => 'viral_mag_frontpage_block_title_text_transform',
        'frontpage_block_title_font_size' => 'viral_mag_frontpage_block_title_size',
        'frontpage_block_title_line_height' => 'viral_mag_frontpage_block_title_line_height',
        'frontpage_block_title_letter_spacing' => 'viral_mag_frontpage_block_title_letter_spacing',
        'frontpage_title_font_family' => 'viral_mag_frontpage_title_family',
        'frontpage_title_font_style' => 'viral_mag_frontpage_title_style',
        'frontpage_title_text_decoration' => 'viral_mag_frontpage_title_text_decoration',
        'frontpage_title_text_transform' => 'viral_mag_frontpage_title_text_transform',
        'frontpage_title_font_size' => 'viral_mag_frontpage_title_size',
        'frontpage_title_line_height' => 'viral_mag_frontpage_title_line_height',
        'frontpage_title_letter_spacing' => 'viral_mag_frontpage_title_letter_spacing',
        'sidebar_title_font_family' => 'viral_mag_sidebar_title_family',
        'sidebar_title_font_style' => 'viral_mag_sidebar_title_style',
        'sidebar_title_text_decoration' => 'viral_mag_sidebar_title_text_decoration',
        'sidebar_title_text_transform' => 'viral_mag_sidebar_title_text_transform',
        'sidebar_title_font_size' => 'viral_mag_sidebar_title_size',
        'sidebar_title_line_height' => 'viral_mag_sidebar_title_line_height',
        'sidebar_title_letter_spacing' => 'viral_mag_sidebar_title_letter_spacing'
    );

    $is_updated = get_option('viral_mag_update_old_theme_mods');
    if (!$is_updated) {
        foreach ($mapping_array as $oldkey => $newkey) {
            $oldvalue = get_theme_mod($oldkey);
            if ($oldvalue) {
                set_theme_mod($newkey, $oldvalue);
            }
        }
        update_option('viral_mag_update_old_theme_mods', 'yes');
    }
}

add_action('init', 'viral_mag_migrate_theme_mods');
