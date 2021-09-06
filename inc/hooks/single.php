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

if (!function_exists('viral_mag_single_post')) {

    function viral_mag_single_post() {
        $post_layout = get_theme_mod('viral_mag_single_layout', 'layout1');

        if (function_exists('viral_mag_single_' . $post_layout)) {
            call_user_func('viral_mag_single_' . $post_layout);
        } else {
            viral_mag_single_layout1();
        }
    }

}

/** Single Post Layout 1 */
if (!function_exists('viral_mag_single_layout1')) {

    function viral_mag_single_layout1() {
        ?>
        <div class="ht-main-content ht-container">
		    <?php do_action('viral_mag_breadcrumbs'); ?>

		    <div class="ht-site-wrapper">
		        <div id="primary" class="content-area">

		            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		                <?php while (have_posts()) : the_post(); ?>

		                    <div class="entry-header"> 
		                        <?php
		                        viral_mag_single_category();

		                        the_title('<h1 class="entry-title">', '</h1>');

		                        viral_mag_single_post_meta();
		                        ?>
		                    </div>

		                    <div class="entry-wrapper">
		                    	<?php do_action('viral_mag_single_template_top_options'); 

		                    	get_template_part('template-parts/post-format/content', get_post_format()); ?>

		                        <div class="entry-content">
		                            <?php
		                            the_content();

		                            wp_link_pages(array(
		                                'before' => '<div class="page-links">' . esc_html__('Pages:', 'viral-mag'),
		                                'after' => '</div>',
		                            ));
		                            ?>
		                        </div><!-- .entry-content -->
		                        <?php
		                    	viral_mag_single_tag();
		                        ?>
		                    </div>

		                <?php endwhile; // End of the loop.   ?>

		            </article><!-- #post-## -->

		            <?php
		            viral_mag_single_author_box();
					viral_mag_single_pagination();
					viral_mag_single_comment();
		            ?>
		        </div><!-- #primary -->

		        <?php get_sidebar(); ?>
		    </div>

		</div>
        <?php
    }

}

/** Single Post Layout 2 */
if (!function_exists('viral_mag_single_layout2')) {

    function viral_mag_single_layout2() {
        ?>

        <div class="ht-main-content ht-container ht-clearfix">
		    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		        <?php while (have_posts()) : the_post(); ?>

		            <div class="entry-header">
		                <?php
		                do_action('viral_mag_breadcrumbs');

		                viral_mag_single_category();

		                the_title('<h1 class="entry-title">', '</h1>');

		                viral_mag_single_post_meta();
		                ?>
		            </div>

		            <div class="ht-site-wrapper">

		                <div id="primary" class="content-area">

		                    <div class="entry-wrapper">  
		                    	<?php do_action('viral_mag_single_template_top_options'); 

		                    	get_template_part('template-parts/post-format/content', get_post_format()); ?>

		                        <div class="entry-content">
		                            <?php
		                            the_content();

		                            wp_link_pages(array(
		                                'before' => '<div class="page-links">' . esc_html__('Pages:', 'viral-mag'),
		                                'after' => '</div>',
		                            ));
		                            ?>
		                        </div><!-- .entry-content -->

		                        <?php	
		                        viral_mag_single_tag();
						        ?>
						    </div>
						    <?php 	                    
		                    viral_mag_single_author_box();
							viral_mag_single_pagination();
							viral_mag_single_comment();
		                    ?>
		                </div><!-- #primary -->

		                <?php get_sidebar(); ?>
		            </div>

		        <?php endwhile; // End of the loop.   ?>

		    </article><!-- #post-## -->
		</div>
        <?php
    }
}

add_action('viral_mag_single_template', 'viral_mag_single_post');

add_action('viral_mag_page_template', 'viral_mag_page_header');
add_action('viral_mag_page_template', 'viral_mag_page_content');
