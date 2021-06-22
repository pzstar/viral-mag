<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Viral Mag
 */
if (!function_exists('wp_body_open')) {

    /**
     * Shim for sites older than 5.2.
     *
     */
    function wp_body_open() {
        do_action('wp_body_open');
    }

}

if (!function_exists('viral_mag_pingback_header')) {

    function viral_mag_pingback_header() {
        if (is_singular() && pings_open()) {
            printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
        }
    }

}

if (!function_exists('viral_mag_excerpt')) {

    function viral_mag_excerpt($content, $letter_count) {
        $new_content = strip_shortcodes($content);
        $new_content = strip_tags($new_content);
        $content = mb_substr($new_content, 0, $letter_count);

        if (($letter_count !== 0) && (strlen($new_content) > $letter_count)) {
            $content .= "...";
        }
        return $content;
    }

}

function viral_mag_comment($comment, $args, $depth) {
    extract($args, EXTR_SKIP);
    $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
    $show_avatars = get_option('show_avatars');
    ?>
    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? 'parent' : '', $comment); ?>>
    <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
        <?php if (0 != $args['avatar_size'] && $show_avatars) { ?>
            <div class="sp-comment-avatar">
                <?php echo get_avatar($comment, $args['avatar_size']); ?>
            </div>
        <?php } ?>

        <div class="sp-comment-content">
            <div class="comment-header">
                <div class="comment-author vcard">
                    <?php
                    echo sprintf('<b class="fn">%s</b>', get_comment_author_link($comment));
                    echo " - ";
                    ?>
                    <a href="<?php echo esc_url(get_comment_link($comment, $args)); ?>">
                        <time datetime="<?php comment_time('c'); ?>">
                            <?php
                            echo get_comment_date('', $comment);
                            ?>
                        </time>
                    </a>
                </div>

                <?php
                comment_reply_link(array_merge($args, array(
                    'add_below' => 'div-comment',
                    'depth' => $depth,
                    'max_depth' => $args['max_depth'],
                    'before' => '<div class="reply">',
                    'after' => '</div>'
                )));
                ?>

                <!-- .comment-author -->

                <?php if ('0' == $comment->comment_approved) : ?>
                    <p class="comment-awaiting-moderation">
                        <?php _e('Your comment is awaiting moderation.', 'viral-mag'); ?>
                    </p>
                <?php endif; ?>

            </div>
            <!-- .comment-meta -->

            <div class="comment-content">
                <?php comment_text(); ?>
            </div>
            <!-- .comment-content -->
            <?php edit_comment_link(__('Edit', 'viral-mag'), '<div class="edit-link">', '</div>'); ?>
        </div>
        <!-- .comment-metadata -->
    </article>
    <!-- .comment-body -->
    <?php
}

/* Convert hexdec color string to rgb(a) string */

function viral_mag_hex2rgba($color, $opacity = false) {

    $default = 'rgb(0,0,0)';

    //Return default if no color provided
    if (empty($color))
        return $default;

    //Sanitize $color if "#" is provided
    if ($color[0] == '#') {
        $color = substr($color, 1);
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
        $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb = array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if ($opacity) {
        if (abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode(",", $rgb) . ')';
    }

    //Return rgb(a) color string
    return $output;
}

function viral_mag_color_brightness($hex, $percent) {
    // Work out if hash given
    $hash = '';
    if (stristr($hex, '#')) {
        $hex = str_replace('#', '', $hex);
        $hash = '#';
    }
    /// HEX TO RGB
    $rgb = array(hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2)));
    //// CALCULATE
    for ($i = 0; $i < 3; $i++) {
        // See if brighter or darker
        if ($percent > 0) {
            // Lighter
            $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1 - $percent));
        } else {
            // Darker
            $positivePercent = $percent - ($percent * 2);
            $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1 - $positivePercent));
        }
        // In case rounding up causes us to go to 256
        if ($rgb[$i] > 255) {
            $rgb[$i] = 255;
        }
    }
    //// RBG to Hex
    $hex = '';
    for ($i = 0; $i < 3; $i++) {
        // Convert the decimal digit to hex
        $hexDigit = dechex($rgb[$i]);
        // Add a leading zero if necessary
        if (strlen($hexDigit) == 1) {
            $hexDigit = "0" . $hexDigit;
        }
        // Append to the hex string
        $hex .= $hexDigit;
    }
    return $hash . $hex;
}

function viral_mag_css_strip_whitespace($css) {
    $replace = array(
        "#/\*.*?\*/#s" => "", // Strip C style comments.
        "#\s\s+#" => " ", // Strip excess whitespace.
    );
    $search = array_keys($replace);
    $css = preg_replace($search, $replace, $css);

    $replace = array(
        ": " => ":",
        "; " => ";",
        " {" => "{",
        " }" => "}",
        ", " => ",",
        "{ " => "{",
        ";}" => "}", // Strip optional semicolons.
        ",\n" => ",", // Don't wrap multiple selectors.
        "\n}" => "}", // Don't wrap closing braces.
        "} " => "}", // Put each rule on it's own line.
    );
    $search = array_keys($replace);
    $css = str_replace($search, $replace, $css);

    return trim($css);
}

function viral_mag_get_customizer_fonts() {
    $fonts = array(
        'body' => array(
            'font_family' => 'Poppins',
            'font_style' => '400',
            'text_transform' => 'none',
            'text_decoration' => 'none',
            'font_size' => '15',
            'line_height' => '1.6',
            'color' => '#333333',
            'letter_spacing' => '0'
        ),
        'menu' => array(
            'font_family' => 'Poppins',
            'font_style' => '400',
            'text_transform' => 'uppercase',
            'text_decoration' => 'none',
            'font_size' => '14',
            'line_height' => '3',
            'letter_spacing' => '0'
        ),
        'page_title' => array(
            'font_family' => 'Poppins',
            'font_style' => '400',
            'text_transform' => 'none',
            'text_decoration' => 'none',
            'font_size' => '40',
            'line_height' => '1.3',
            'color' => '#333333',
            'letter_spacing' => '0'
        ),
        'frontpage_title' => array(
            'font_family' => 'Poppins',
            'font_style' => '500',
            'text_transform' => 'capitalize',
            'text_decoration' => 'none',
            'font_size' => '16',
            'line_height' => '1.3',
            'letter_spacing' => '0'
        ),
        'frontpage_block_title' => array(
            'font_family' => 'Poppins',
            'font_style' => '500',
            'text_transform' => 'uppercase',
            'text_decoration' => 'none',
            'font_size' => '20',
            'line_height' => '1.1',
            'letter_spacing' => '0'
        ),
        'sidebar_title' => array(
            'font_family' => 'Poppins',
            'font_style' => '500',
            'text_transform' => 'uppercase',
            'text_decoration' => 'none',
            'font_size' => '18',
            'line_height' => '1.3',
            'color' => '#333333',
            'letter_spacing' => '0'
        )
    );

    $common_header_typography = get_theme_mod('common_header_typography', true);

    if (!$common_header_typography) {
        $fonts['h1'] = array(
            'font_family' => 'Poppins',
            'font_style' => '400',
            'text_transform' => 'none',
            'text_decoration' => 'none',
            'font_size' => '38',
            'line_height' => '1.3',
            'letter_spacing' => '0'
        );
        $fonts['h2'] = array(
            'font_family' => 'Poppins',
            'font_style' => '400',
            'text_transform' => 'none',
            'text_decoration' => 'none',
            'font_size' => '34',
            'line_height' => '1.3',
            'letter_spacing' => '0'
        );
        $fonts['h3'] = array(
            'font_family' => 'Poppins',
            'font_style' => '400',
            'text_transform' => 'none',
            'text_decoration' => 'none',
            'font_size' => '30',
            'line_height' => '1.3',
            'letter_spacing' => '0'
        );
        $fonts['h4'] = array(
            'font_family' => 'Poppins',
            'font_style' => '400',
            'text_transform' => 'none',
            'text_decoration' => 'none',
            'font_size' => '26',
            'line_height' => '1.3',
            'letter_spacing' => '0'
        );
        $fonts['h5'] = array(
            'font_family' => 'Poppins',
            'font_style' => '400',
            'text_transform' => 'none',
            'text_decoration' => 'none',
            'font_size' => '22',
            'line_height' => '1.3',
            'letter_spacing' => '0'
        );
        $fonts['h6'] = array(
            'font_family' => 'Poppins',
            'font_style' => '400',
            'text_transform' => 'none',
            'text_decoration' => 'none',
            'font_size' => '18',
            'line_height' => '1.3',
            'letter_spacing' => '0'
        );
    } else {
        $fonts['h'] = array(
            'font_family' => 'Poppins',
            'font_style' => '400',
            'text_transform' => 'none',
            'text_decoration' => 'none',
            'line_height' => '1.3',
            'letter_spacing' => '0'
        );
    }
    return $fonts;
}

if (!function_exists('viral_mag_is_woocommerce_activated')) {

    function viral_mag_is_woocommerce_activated() {
        if (class_exists('woocommerce')) {
            return true;
        } else {
            return false;
        }
    }

}

function viral_mag_get_image_sizes() {

    foreach (get_intermediate_image_sizes() as $_size) {
        if (in_array($_size, array('thumbnail', 'medium', 'large'))) {
            $default_sizes[$_size] = 'Image Size - ' . get_option("{$_size}_size_w") . 'x' . get_option("{$_size}_size_h") . ' (' . ucfirst($_size) . ')';
        }
    }

    $sizes = array(
        'full' => esc_html__('Full Size', 'viral-mag'),
        'viral-mag-1300x540' => esc_html__('Image Size - 1300x540', 'viral-mag'),
        'viral-mag-800x500' => esc_html__('Image Size - 800x500', 'viral-mag'),
        'viral-mag-700x700' => esc_html__('Image Size - 700x700', 'viral-mag'),
        'viral-mag-650x500' => esc_html__('Image Size - 650x500', 'viral-mag'),
        'viral-mag-500x500' => esc_html__('Image Size - 500x500', 'viral-mag'),
        'viral-mag-500x600' => esc_html__('Image Size - 500x600', 'viral-mag'),
        'viral-mag-360x240' => esc_html__('Image Size - 360x240', 'viral-mag'),
        'viral-mag-150x150' => esc_html__('Image Size - 150x150', 'viral-mag')
    );

    $all_sizes = array_merge($sizes, $default_sizes);

    return $all_sizes;
}

function viral_mag_check_active_footer() {
    $viral_mag_footer_col = get_theme_mod('viral_mag_footer_col', 'col-3-1-1-1');
    $viral_mag_footer_array = explode('-', $viral_mag_footer_col);
    $count = count($viral_mag_footer_array);
    $footer_col = $count - 2;
    $status = false;

    for ($i = 1; $i <= $footer_col; $i++) {
        if (is_active_sidebar('viral-mag-footer' . $i)) {
            $status = true;
        }
    }

    return $status;
}

function viral_mag_get_default_widgets() {
    return array('viral-mag-right-sidebar', 'viral-mag-left-sidebar', 'viral-mag-shop-right-sidebar', 'viral-mag-shop-left-sidebar', 'viral-mag-offcanvas-sidebar', 'viral-mag-footer1', 'viral-mag-footer2', 'viral-mag-footer3', 'viral-mag-footer4', 'viral-mag-footer5');
}
