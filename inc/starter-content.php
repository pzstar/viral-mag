<?php
/**
 * Starter content, shown on new sites in the Customizer and in the WordPress.org theme preview.
 *
 * @package Viral Mag
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('viral_mag_starter_content')) {

    function viral_mag_starter_content() {
        // Paragraphs as block markup, so the posts open cleanly in the block editor.
        $paragraphs = function ($texts) {
            $html = '';
            foreach ($texts as $text) {
                $html .= '<!-- wp:paragraph --><p>' . $text . '</p><!-- /wp:paragraph -->';
            }
            return $html;
        };

        // The theme's Post Listing and Post Carousel widgets, showing the latest posts.
        $post_list = function ($title, $layout, $count, $thumbnail_size) {
            return array('viral_mag_category_post_list', array(
                'title' => $title,
                'category' => '',
                'post_count' => $count,
                'thumbnail_size' => $thumbnail_size,
                'display_date' => 1,
                'display_excerpt' => 0,
                'layout' => $layout,
                'title_html_tag' => 'default',
            ));
        };

        $post_carousel = function ($title, $thumbnail_size, $display_date) {
            return array('viral_mag_category_post_carousel', array(
                'title' => $title,
                'category' => '',
                'post_count' => 5,
                'thumbnail_size' => $thumbnail_size,
                'display_date' => $display_date,
                'display_excerpt' => 0,
                'title_html_tag' => 'default',
            ));
        };

        $starter_content = array(
            'posts' => array(
                'viral-mag-post-1' => array(
                    'post_type' => 'post',
                    'post_title' => _x('Heatwave Brings Record Temperatures Across the Region', 'Theme starter content', 'viral-mag'),
                    'post_content' => $paragraphs(array(
                        _x('Temperatures climbed past 40°C in several towns this week, breaking records that had stood for more than thirty years. Forecasters expect the hot spell to last until the weekend before cooler air arrives from the coast.', 'Theme starter content', 'viral-mag'),
                        _x('Local councils have opened cooling centers in libraries and community halls, and health officials are asking people to drink plenty of water, stay out of the midday sun and check on elderly neighbors.', 'Theme starter content', 'viral-mag'),
                        _x('Farmers say the heat has arrived at a difficult time, just weeks before harvest, and are watering crops at night to save what they can.', 'Theme starter content', 'viral-mag'),
                    )),
                    'thumbnail' => '{{viral-mag-image-1}}',
                ),
                'viral-mag-post-2' => array(
                    'post_type' => 'post',
                    'post_title' => _x('Colorful Old Town Streets Draw Record Number of Visitors', 'Theme starter content', 'viral-mag'),
                    'post_content' => $paragraphs(array(
                        _x('The painted houses and tiled streets of the old town welcomed more visitors this summer than in any year before, according to the local tourism office.', 'Theme starter content', 'viral-mag'),
                        _x('Cafe owners have added outdoor seating to keep up with demand, and a new walking tour now guides visitors through the quieter lanes behind the main square.', 'Theme starter content', 'viral-mag'),
                        _x('Residents welcome the boost to local business but have asked the council to plan for busier seasons ahead, with more buses and better signs for visitors.', 'Theme starter content', 'viral-mag'),
                    )),
                    'thumbnail' => '{{viral-mag-image-2}}',
                ),
                'viral-mag-post-3' => array(
                    'post_type' => 'post',
                    'post_title' => _x('Old Factory Chimney to Become Centerpiece of New Waterfront Park', 'Theme starter content', 'viral-mag'),
                    'post_content' => $paragraphs(array(
                        _x('The tall brick chimney that has stood by the lake for over a century will be kept and restored as part of a new waterfront park, the city announced on Monday.', 'Theme starter content', 'viral-mag'),
                        _x('Plans include walking and cycling paths, a small museum about the town\'s industrial past and a viewing platform with views across the water at sunset.', 'Theme starter content', 'viral-mag'),
                        _x('Work is expected to begin next spring, and the first section of the park could open to the public within two years.', 'Theme starter content', 'viral-mag'),
                    )),
                    'thumbnail' => '{{viral-mag-image-3}}',
                ),
                'viral-mag-post-4' => array(
                    'post_type' => 'post',
                    'post_title' => _x('Young Boxers Shine at National Youth Championship', 'Theme starter content', 'viral-mag'),
                    'post_content' => $paragraphs(array(
                        _x('Two teenagers from the local boxing club came home with medals from the national youth championship, the club\'s best result since it opened.', 'Theme starter content', 'viral-mag'),
                        _x('Their coach credits hard work and early morning training sessions, and says interest in the sport among young people in the area has never been higher.', 'Theme starter content', 'viral-mag'),
                        _x('The club is now raising money for new equipment so it can welcome more members next season.', 'Theme starter content', 'viral-mag'),
                    )),
                    'thumbnail' => '{{viral-mag-image-4}}',
                ),
                'viral-mag-post-5' => array(
                    'post_type' => 'post',
                    'post_title' => _x('Tea Growers Turn to Organic Farming as Demand Rises', 'Theme starter content', 'viral-mag'),
                    'post_content' => $paragraphs(array(
                        _x('A growing number of tea estates in the highlands are switching to organic methods as buyers at home and abroad ask for chemical-free leaves.', 'Theme starter content', 'viral-mag'),
                        _x('Growers say the change takes several years and lowers yields at first, but the higher price for organic tea makes the effort worthwhile.', 'Theme starter content', 'viral-mag'),
                        _x('Workers have been trained in new ways to protect the plants from pests, and some estates now invite visitors to see how their tea is grown and picked.', 'Theme starter content', 'viral-mag'),
                    )),
                    'thumbnail' => '{{viral-mag-image-5}}',
                ),
                'viral-mag-post-6' => array(
                    'post_type' => 'post',
                    'post_title' => _x('Historic Fortress Reopens After Five-Year Restoration', 'Theme starter content', 'viral-mag'),
                    'post_content' => $paragraphs(array(
                        _x('After five years behind scaffolding, the old stone fortress on the hill has reopened its gates to visitors, with repaired towers, new walkways and a refreshed exhibition.', 'Theme starter content', 'viral-mag'),
                        _x('Craftspeople used traditional tools and local stone to rebuild the damaged walls, keeping as much of the original structure as possible.', 'Theme starter content', 'viral-mag'),
                        _x('Entry is free for local residents during the first month, and guided tours run every afternoon.', 'Theme starter content', 'viral-mag'),
                    )),
                    'thumbnail' => '{{viral-mag-image-6}}',
                ),
                'viral-mag-post-7' => array(
                    'post_type' => 'post',
                    'post_title' => _x('New Rapid Bus Lanes Promise Shorter Commutes Downtown', 'Theme starter content', 'viral-mag'),
                    'post_content' => $paragraphs(array(
                        _x('Dedicated bus lanes opened on the city\'s main boulevard this week, and early figures suggest journeys across downtown are already up to ten minutes faster.', 'Theme starter content', 'viral-mag'),
                        _x('The project also added new crossings, wider sidewalks and shade trees along the route, making the street safer for people on foot.', 'Theme starter content', 'viral-mag'),
                        _x('Transport officials will review the results after six months before deciding whether to extend the lanes to other busy roads.', 'Theme starter content', 'viral-mag'),
                    )),
                    'thumbnail' => '{{viral-mag-image-7}}',
                ),
                'viral-mag-post-8' => array(
                    'post_type' => 'post',
                    'post_title' => _x('How Communities Are Rebuilding After the Earthquake', 'Theme starter content', 'viral-mag'),
                    'post_content' => $paragraphs(array(
                        _x('Months after the earthquake, families in the worst-hit villages are moving into new homes built to withstand future tremors.', 'Theme starter content', 'viral-mag'),
                        _x('Volunteers, engineers and local builders have worked side by side, and many of the new houses use designs that are cheaper and stronger than before.', 'Theme starter content', 'viral-mag'),
                        _x('Schools and health posts are next on the list, and aid groups say the community\'s own efforts have made all the difference.', 'Theme starter content', 'viral-mag'),
                    )),
                    'thumbnail' => '{{viral-mag-image-8}}',
                ),
                'about',
                'contact',
            ),

            // Photos from the WordPress.org Photo Directory (CC0).
            'attachments' => array(
                'viral-mag-image-1' => array(
                    'post_title' => _x('Thermometer showing 40 degrees', 'Theme starter content', 'viral-mag'),
                    'file' => 'images/starter/news-1.jpg',
                ),
                'viral-mag-image-2' => array(
                    'post_title' => _x('Colorful street with outdoor seating', 'Theme starter content', 'viral-mag'),
                    'file' => 'images/starter/news-2.jpg',
                ),
                'viral-mag-image-3' => array(
                    'post_title' => _x('Chimney by a lake at sunset', 'Theme starter content', 'viral-mag'),
                    'file' => 'images/starter/news-3.jpg',
                ),
                'viral-mag-image-4' => array(
                    'post_title' => _x('Young boxers training in a ring', 'Theme starter content', 'viral-mag'),
                    'file' => 'images/starter/news-4.jpg',
                ),
                'viral-mag-image-5' => array(
                    'post_title' => _x('Worker on a tea plantation', 'Theme starter content', 'viral-mag'),
                    'file' => 'images/starter/news-5.jpg',
                ),
                'viral-mag-image-6' => array(
                    'post_title' => _x('Stone fortress under a cloudy sky', 'Theme starter content', 'viral-mag'),
                    'file' => 'images/starter/news-6.jpg',
                ),
                'viral-mag-image-7' => array(
                    'post_title' => _x('City road lined with palm trees', 'Theme starter content', 'viral-mag'),
                    'file' => 'images/starter/news-7.jpg',
                ),
                'viral-mag-image-8' => array(
                    'post_title' => _x('House damaged by an earthquake', 'Theme starter content', 'viral-mag'),
                    'file' => 'images/starter/news-8.jpg',
                ),
                'viral-mag-logo' => array(
                    'post_title' => _x('Viral Mag Logo', 'Theme starter content', 'viral-mag'),
                    'file' => 'images/starter/logo.png',
                ),
            ),

            // Settings from the News demo (demo.hashthemes.com/viral-mag/news). The home page stays the latest posts.
            'theme_mods' => array(
                'custom_logo' => '{{viral-mag-logo}}',
                'viral_mag_hide_title' => true,
                'viral_mag_hide_tagline' => true,
                'viral_mag_logo_height' => 41,
                'viral_mag_wide_container_width' => 1300,
                'viral_mag_responsive_width' => 1200,

                // Fonts.
                'viral_mag_body_size' => 16,
                'viral_mag_h_family' => 'Jost',
                'viral_mag_h_style' => '600',
                'viral_mag_menu_family' => 'Nunito Sans',
                'viral_mag_menu_style' => '600',
                'viral_mag_page_title_family' => 'Jost',
                'viral_mag_page_title_style' => '600',
                'viral_mag_page_title_size' => 46,
                'viral_mag_sidebar_title_family' => 'Jost',
                'viral_mag_sidebar_title_style' => '600',
                'viral_mag_sidebar_title_size' => 22,
                'viral_mag_sidebar_title_text_transform' => 'uppercase',
                'viral_mag_frontpage_block_title_family' => 'Jost',
                'viral_mag_frontpage_block_title_style' => '600',
                'viral_mag_frontpage_block_title_size' => 28,
                'viral_mag_frontpage_block_title_text_transform' => 'uppercase',
                'viral_mag_frontpage_title_family' => 'Jost',
                'viral_mag_frontpage_title_style' => '600',
                'viral_mag_frontpage_title_size' => 17,

                // Header: white with a black menu, red submenus and hover.
                'viral_mag_mh_layout' => 'header-style3',
                'viral_mag_mh_height' => 91,
                'viral_mag_mh_bg_color' => 'rgba(255,255,255,1)',
                'viral_mag_mh_bg_color_mobile' => '#ffffff',
                'viral_mag_mh_border_color' => 'rgba(238,238,238,1)',
                'viral_mag_mh_menu_color' => '#000000',
                'viral_mag_mh_menu_hover_color' => '#cf0701',
                'viral_mag_mh_submenu_bg_color' => 'rgba(207,7,1,1)',
                'viral_mag_mh_submenu_color' => '#ffffff',
                'viral_mag_mh_submenu_hover_color' => '#ffffff',
                'viral_mag_menu_dropdown_padding' => 15,
                'viral_mag_menu_line_height' => 5,
                'viral_mag_toggle_button_color' => '#cf0701',

                // Footer: red, four columns.
                'viral_mag_footer_col' => 'col-4-1-1-1-1',
                'viral_mag_footer_bg_color' => 'rgba(188,0,0,1)',
                'viral_mag_footer_border_color' => 'rgba(173,0,0,1)',
                'viral_mag_footer_title_color' => '#ffffff',
                'viral_mag_footer_text_color' => '#ffffff',
                'viral_mag_footer_anchor_color' => '#ffffff',
            ),

            'widgets' => array(
                'viral-mag-right-sidebar' => array(
                    'search',
                    'trending' => $post_list(_x('Trending', 'Theme starter content', 'viral-mag'), 'style2', 5, 'viral-mag-150x150'),
                    'editors_choice' => $post_list(_x('Editors Choice', 'Theme starter content', 'viral-mag'), 'style4', 5, 'viral-mag-360x240'),
                ),
                'viral-mag-left-sidebar' => array(
                    'left_trending' => $post_list(_x('Trending', 'Theme starter content', 'viral-mag'), 'style2', 5, 'viral-mag-150x150'),
                    'left_editors_choice' => $post_list(_x('Editors Choice', 'Theme starter content', 'viral-mag'), 'style5', 5, 'viral-mag-360x240'),
                ),
                'viral-mag-offcanvas-sidebar' => array(
                    'hot_topics' => $post_list(_x('Hot Topics', 'Theme starter content', 'viral-mag'), 'style3', 6, 'viral-mag-360x240'),
                    'latest' => $post_list(_x('Latest Posts', 'Theme starter content', 'viral-mag'), 'style2', 4, 'viral-mag-150x150'),
                ),
                'viral-mag-footer1' => array(
                    'footer_trending' => $post_carousel(_x('Trending', 'Theme starter content', 'viral-mag'), 'viral-mag-360x240', 1),
                ),
                'viral-mag-footer2' => array(
                    'footer_recent' => $post_list(_x('Recent Posts', 'Theme starter content', 'viral-mag'), 'style2', 3, 'viral-mag-150x150'),
                ),
                'viral-mag-footer3' => array(
                    'archives',
                ),
                'viral-mag-footer4' => array(
                    'contact_text' => array('text', array(
                        'title' => _x('Contact Info', 'Theme starter content', 'viral-mag'),
                        'text' => _x('Please contact us at the details below if you have any news tips, suggestions or feedback.', 'Theme starter content', 'viral-mag'),
                        'filter' => true,
                        'visual' => true,
                    )),
                    'contact' => array('viral_mag_contact_info', array(
                        'title' => '',
                        'phone' => '(555) 123-4567',
                        'email' => 'news@example.com',
                        'website' => 'www.example.com',
                        'address' => _x('1428 Elmwood Avenue, IL 62704', 'Theme starter content', 'viral-mag'),
                        'time' => _x('Sun - Fri, 9:00 AM - 6:00 PM', 'Theme starter content', 'viral-mag'),
                    )),
                ),
            ),

            'nav_menus' => array(
                'viral-mag-primary-menu' => array(
                    'name' => __('Primary Menu', 'viral-mag'),
                    'items' => array(
                        'link_home',
                        'page_about',
                        'page_contact',
                    ),
                ),
            ),
        );

        add_theme_support('starter-content', apply_filters('viral_mag_starter_content', $starter_content));
    }

}

add_action('after_setup_theme', 'viral_mag_starter_content');

if (!function_exists('viral_mag_preview_starter_posts')) {

    // In the Customizer, starter posts stay auto-drafts until the user publishes, so post lists can't see them; include them while previewing.
    function viral_mag_preview_starter_posts($query) {
        global $wp_customize;

        if (is_admin() || !is_customize_preview() || !get_option('fresh_site') || !$wp_customize instanceof WP_Customize_Manager || !in_array($query->get('post_type'), array('', 'post'), true)) {
            return;
        }

        $setting = $wp_customize->get_setting('nav_menus_created_posts');
        $ids = $setting ? array_filter(array_map('absint', (array) $setting->value())) : array();

        if ($ids) {
            $query->set('post_status', array('publish', 'auto-draft'));
            $query->set('viral_mag_starter_ids', $ids);
        }
    }

}

add_action('pre_get_posts', 'viral_mag_preview_starter_posts');

if (!function_exists('viral_mag_preview_starter_posts_where')) {

    // Limits the auto-drafts let in above to the starter content ones.
    function viral_mag_preview_starter_posts_where($where, $query) {
        global $wpdb;
        $ids = $query->get('viral_mag_starter_ids');

        if ($ids) {
            $where .= " AND ({$wpdb->posts}.post_status <> 'auto-draft' OR {$wpdb->posts}.ID IN (" . implode(',', array_map('absint', $ids)) . '))';
        }

        return $where;
    }

}

add_filter('posts_where', 'viral_mag_preview_starter_posts_where', 10, 2);

if (!function_exists('viral_mag_theme_preview_posts')) {

    // The WordPress.org theme preview keeps starter posts only in the object cache, with made-up IDs from 10000 and their keys as slugs, so post lists never see them.
    // Finds them there and gives them the dates and author the preview leaves out; returns nothing on real sites.
    function viral_mag_theme_preview_posts() {
        static $posts = null;

        if (null !== $posts) {
            return $posts;
        }

        $posts = array();

        if (is_admin() || !get_option('fresh_site') || wp_using_ext_object_cache()) {
            return $posts;
        }

        $starter_content = get_theme_starter_content();
        $keys = array();
        foreach ((array) ($starter_content['posts'] ?? array()) as $key => $starter_post) {
            if ('post' === ($starter_post['post_type'] ?? '')) {
                $keys[$key] = true;
            }
        }

        $last_id = 10000 + count((array) ($starter_content['posts'] ?? array())) + count((array) ($starter_content['attachments'] ?? array())) + 20;
        $found = array();
        for ($id = 10000; $id < $last_id && count($found) < count($keys); $id++) {
            $cached = wp_cache_get($id, 'posts');
            if (is_object($cached) && isset($cached->post_name, $keys[$cached->post_name])) {
                $found[$cached->post_name] = $cached;
            }
        }

        if (!$found) {
            return $posts;
        }

        $latest = get_posts(array('numberposts' => 1, 'post_type' => 'post', 'suppress_filters' => true));
        $author = $latest ? $latest[0]->post_author : 1;
        $time = current_time('timestamp');
        $i = 0;

        // Starter content order, newest first, a few hours apart.
        foreach (array_keys($keys) as $key) {
            if (!isset($found[$key])) {
                continue;
            }

            $data = (object) array_merge((array) $found[$key], array(
                'post_status' => 'publish',
                'post_author' => $author,
                'post_date' => gmdate('Y-m-d H:i:s', $time - $i * 5 * HOUR_IN_SECONDS),
                'post_date_gmt' => get_gmt_from_date(gmdate('Y-m-d H:i:s', $time - $i * 5 * HOUR_IN_SECONDS)),
                'post_modified' => gmdate('Y-m-d H:i:s', $time - $i * 5 * HOUR_IN_SECONDS),
                'comment_status' => 'closed',
                'filter' => 'raw',
            ));
            wp_cache_set($data->ID, $data, 'posts');
            $posts[] = new WP_Post($data);
            $i++;
        }

        return $posts;
    }

}

if (!function_exists('viral_mag_theme_preview_post_lists')) {

    // In the WordPress.org theme preview, the latest posts home page and post widgets list the starter posts instead of the Theme Unit Test posts.
    function viral_mag_theme_preview_post_lists($posts, $query) {
        if (null !== $posts || ($query->is_main_query() && !$query->is_home()) || !in_array($query->get('post_type'), array('', 'post'), true) || $query->get('p') || $query->get('page_id') || $query->get('post__in') || $query->get('s') || $query->get('cat') || $query->get('category_name') || $query->get('tag') || $query->get('tax_query') || $query->get('author')) {
            return $posts;
        }

        $preview_posts = viral_mag_theme_preview_posts();

        if (!$preview_posts) {
            return $posts;
        }

        $per_page = (int) $query->get('posts_per_page');
        $per_page = $per_page > 0 ? $per_page : count($preview_posts);
        $offset = (int) $query->get('offset') + (max(1, (int) $query->get('paged')) - 1) * $per_page;
        $posts = array_slice($preview_posts, $offset, $per_page);

        $query->found_posts = count($preview_posts);
        $query->max_num_pages = (int) ceil(count($preview_posts) / $per_page);

        return 'ids' === $query->get('fields') ? wp_list_pluck($posts, 'ID') : $posts;
    }

}

add_filter('posts_pre_query', 'viral_mag_theme_preview_post_lists', 10, 2);
