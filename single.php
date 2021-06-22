<?php
/**
 * The template for displaying all single posts.
 *
 * @package Viral Mag
 */
get_header();

$viral_mag_single_layout = get_theme_mod('viral_mag_single_layout', 'layout1');

get_template_part('template-parts/single/single', $viral_mag_single_layout);

get_footer();
