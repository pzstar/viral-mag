<?php

if (!function_exists('viral_mag_page_header')) {

    function viral_mag_page_header() {
		$viral_mag_show_title = get_theme_mod('viral_mag_show_title', true);
		?>
		<header class="ht-main-header">
		    <div class="ht-container">
		        <?php
		        if ($viral_mag_show_title) {
		            the_title('<h1 class="ht-main-title">', '</h1>');
		        }

		        do_action('viral_mag_breadcrumbs');
		        ?>
		    </div>
		</header><!-- .entry-header -->

		<?php
	}
}

if (!function_exists('viral_mag_page_content')) {

    function viral_mag_page_content() {

		$container_class = array('ht-main-content', 'ht-clearfix', 'ht-container');
		?>
		<div class="<?php echo implode(' ', $container_class); ?>">
		    <div class="ht-site-wrapper">
		        <div id="primary" class="content-area">

		            <?php while (have_posts()) : the_post(); ?>

		                <?php get_template_part('template-parts/content', 'page'); ?>

		                <?php
		                // If comments are open or we have at least one comment, load up the comment template.
		                if (comments_open() || get_comments_number()) :
		                    comments_template();
		                endif;
		                ?>

		            <?php endwhile; // End of the loop.   ?>

		        </div><!-- #primary -->

		        <?php get_sidebar(); ?>
		    </div>
		</div>

		<?php
	}
}

if (!function_exists('viral_mag_single_content')) {

    function viral_mag_single_content() {
        $viral_mag_single_layout = get_theme_mod('viral_mag_single_layout', 'layout1');
		get_template_part('template-parts/single/single', $viral_mag_single_layout);
    }

}

add_action('viral_mag_page_template', 'viral_mag_page_header');
add_action('viral_mag_page_template', 'viral_mag_page_content');


add_action('viral_mag_single_template', 'viral_mag_single_content');
