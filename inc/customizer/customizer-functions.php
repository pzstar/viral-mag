<?php
if (!function_exists('viral_mag_widget_list')) {

    function viral_mag_widget_list() {
        global $wp_registered_sidebars;
        $menu_choice = array();
        $widget_list['none'] = esc_html__('-- Choose Widget --', 'viral-mag');
        if ($wp_registered_sidebars) {
            foreach ($wp_registered_sidebars as $wp_registered_sidebar) {
                $widget_list[$wp_registered_sidebar['id']] = $wp_registered_sidebar['name'];
            }
        }
        return $widget_list;
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
