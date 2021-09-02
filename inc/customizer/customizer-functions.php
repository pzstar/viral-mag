<?php

add_action('wp_ajax_viral_mag_order_sections', 'viral_mag_order_sections');

function viral_mag_order_sections() {
    if (isset($_POST['sections'])) {
        set_theme_mod('viral_mag_frontpage_sections', $_POST['sections']);
    }
    wp_die();
}

if (!function_exists('viral_mag_post_count_choice')) {

    function viral_mag_post_count_choice() {
        return array(3 => 3, 6 => 6, 9 => 9);
    }

}

if (!function_exists('viral_mag_percentage')) {

    function viral_mag_percentage() {
        for ($i = 1; $i <= 100; $i++) {
            $viral_mag_percentage[$i] = $i;
        }
        return $viral_mag_percentage;
    }

}

if (!function_exists('viral_mag_cat')) {

    function viral_mag_cat() {
        $cat = array();
        $categories = get_categories(array('hide_empty' => 0));
        if ($categories) {
            foreach ($categories as $category) {
                $cat[$category->term_id] = $category->cat_name;
            }
        }
        return $cat;
    }

}

if (!function_exists('viral_mag_page_choice')) {

    function viral_mag_page_choice() {
        $page_choice = array();
        $pages = get_pages(array('hide_empty' => 0));
        if ($pages) {
            foreach ($pages as $pages_single) {
                $page_choice[$pages_single->ID] = $pages_single->post_title;
            }
        }
        return $page_choice;
    }

}

if (!function_exists('viral_mag_menu_choice')) {

    function viral_mag_menu_choice() {
        $menu_choice = array('none' => esc_html('Select Menu', 'viral-mag'));
        $menus = get_terms('nav_menu', array('hide_empty' => false));
        if ($menus) {
            foreach ($menus as $menus_single) {
                $menu_choice[$menus_single->slug] = $menus_single->name;
            }
        }
        return $menu_choice;
    }

}
