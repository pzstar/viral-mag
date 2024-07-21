<?php
/**
 * The header for our theme.
 *
 * @package Viral Mag
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <?php wp_body_open(); ?>
        <?php
        do_action('viral_mag_before_page');
        ?>
        <div id="vm-page">
            <a class="skip-link screen-reader-text" href=" #vm-content"><?php esc_html_e('Skip to content', 'viral-mag'); ?></a>
            <?php
            do_action('viral_mag_header');
            ?>
            <div id="vm-content" class="vm-site-content vm-clearfix">