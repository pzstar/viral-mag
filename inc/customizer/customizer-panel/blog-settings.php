<?php

/**
 * Viral Mag Theme Customizer
 *
 * @package Viral Mag
 */
$wp_customize->add_section('viral_mag_blog_options_section', array(
    'title' => esc_html__('Blog/Single Post Settings', 'viral-mag'),
    'priority' => 30
));

$wp_customize->add_setting('viral_mag_blog_sec_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control(new Viral_Mag_Control_Tab($wp_customize, 'viral_mag_blog_sec_nav', array(
    'type' => 'tab',
    'section' => 'viral_mag_blog_options_section',
    'priority' => 1,
    'buttons' => array(
        array(
            'name' => esc_html__('BLog Page', 'viral-mag'),
            'fields' => array(
                'viral_mag_display_frontpage_sections',
                'viral_mag_blog_layout',
                'viral_mag_blog_cat',
                'viral_mag_archive_content',
                'viral_mag_archive_excerpt_length',
                'viral_mag_archive_readmore',
                'viral_mag_blog_date',
                'viral_mag_blog_author',
                'viral_mag_blog_comment',
                'viral_mag_blog_category',
                'viral_mag_blog_tag',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Single Post', 'viral-mag'),
            'fields' => array(
                'viral_mag_single_layout',
                'viral_mag_single_categories',
                'viral_mag_single_seperator1',
                'viral_mag_single_author',
                'viral_mag_single_date',
                'viral_mag_single_comment_count',
                'viral_mag_single_views',
                'viral_mag_single_reading_time',
                'viral_mag_single_seperator2',
                'viral_mag_single_tags',
                'viral_mag_single_social_share',
                'viral_mag_single_author_box',
                'viral_mag_single_seperator3',
                'viral_mag_single_prev_next_post',
                'viral_mag_single_comments',
                'viral_mag_single_related_posts',
                'viral_mag_single_related_heading',
                'viral_mag_single_related_post_title',
                'viral_mag_single_related_post_style',
                'viral_mag_single_related_post_count'
            ),
        ),
    ),
)));

$wp_customize->add_setting('viral_mag_display_frontpage_sections', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => 'off'
));

$wp_customize->add_control(new Viral_Mag_Switch_Control($wp_customize, 'viral_mag_display_frontpage_sections', array(
    'section' => 'viral_mag_blog_options_section',
    'label' => esc_html__('Display Front Page Sections', 'viral-mag'),
    'on_off_label' => array(
        'on' => esc_html__('Yes', 'viral-mag'),
        'off' => esc_html__('No', 'viral-mag')
    ),
    'description' => sprintf(esc_html__('Display Front Page sections before the blog. Customize Front Page sections %s', 'viral-mag'), '<a href="javascript:wp.customize.panel( \'viral_mag_front_page_panel\' ).focus()">' . esc_html__('here', 'viral-mag') . '</a>'),
)));

$wp_customize->add_setting('viral_mag_blog_layout', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => 'layout1'
));

$wp_customize->add_control(new Viral_Mag_Image_Select($wp_customize, 'viral_mag_blog_layout', array(
    'section' => 'viral_mag_blog_options_section',
    'label' => esc_html__('Blog & Archive Layout', 'viral-mag'),
    'image_path' => $imagepath . '/inc/customizer/images/blog-layouts/',
    'choices' => array(
        'layout1' => esc_html__('Layout 1', 'viral-mag'),
        'layout2' => esc_html__('Layout 2', 'viral-mag')
    )
)));

$wp_customize->add_setting('viral_mag_blog_cat', array(
    'sanitize_callback' => 'viral_mag_sanitize_text'
));

$wp_customize->add_control(new Viral_Mag_Customize_Checkbox_Multiple($wp_customize, 'viral_mag_blog_cat', array(
    'label' => esc_html__('Exclude Category', 'viral-mag'),
    'section' => 'viral_mag_blog_options_section',
    'choices' => $viral_mag_cat,
    'description' => esc_html__('Post with selected category will not display in the blog page', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_archive_content', array(
    'default' => 'excerpt',
    'sanitize_callback' => 'viral_mag_sanitize_choices'
));

$wp_customize->add_control('viral_mag_archive_content', array(
    'section' => 'viral_mag_blog_options_section',
    'type' => 'radio',
    'label' => esc_html__('Archive Content', 'viral-mag'),
    'choices' => array(
        'full-content' => esc_html__('Full Content', 'viral-mag'),
        'excerpt' => esc_html__('Excerpt', 'viral-mag')
    )
));

$wp_customize->add_setting('viral_mag_archive_excerpt_length', array(
    'sanitize_callback' => 'absint',
    'default' => 100
));

$wp_customize->add_control(new Viral_Mag_Range_Control($wp_customize, 'viral_mag_archive_excerpt_length', array(
    'section' => 'viral_mag_blog_options_section',
    'label' => esc_html__('Excerpt Length (words)', 'viral-mag'),
    'input_attrs' => array(
        'min' => 50,
        'max' => 200,
        'step' => 1
    )
)));

$wp_customize->add_setting('viral_mag_archive_readmore', array(
    'default' => esc_html__('Read More', 'viral-mag'),
    'sanitize_callback' => 'viral_mag_sanitize_text'
));

$wp_customize->add_control('viral_mag_archive_readmore', array(
    'section' => 'viral_mag_blog_options_section',
    'type' => 'text',
    'label' => esc_html__('Read More Text', 'viral-mag')
));

$wp_customize->add_setting('viral_mag_blog_date', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Mag_Checkbox_Control($wp_customize, 'viral_mag_blog_date', array(
    'section' => 'viral_mag_blog_options_section',
    'label' => esc_html__('Display Posted Date', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_blog_author', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Mag_Checkbox_Control($wp_customize, 'viral_mag_blog_author', array(
    'section' => 'viral_mag_blog_options_section',
    'label' => esc_html__('Display Author', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_blog_comment', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Mag_Checkbox_Control($wp_customize, 'viral_mag_blog_comment', array(
    'section' => 'viral_mag_blog_options_section',
    'label' => esc_html__('Display Comment', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_blog_category', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Mag_Checkbox_Control($wp_customize, 'viral_mag_blog_category', array(
    'section' => 'viral_mag_blog_options_section',
    'label' => esc_html__('Display Category', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_blog_tag', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Mag_Checkbox_Control($wp_customize, 'viral_mag_blog_tag', array(
    'section' => 'viral_mag_blog_options_section',
    'label' => esc_html__('Display Tag', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_single_layout', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => 'layout1'
));

$wp_customize->add_control(new Viral_Mag_Image_Select($wp_customize, 'viral_mag_single_layout', array(
    'section' => 'viral_mag_blog_options_section',
    'label' => esc_html__('Single Post Layout', 'viral-mag'),
    'description' => esc_html__('This option can be overwritten in single page settings.', 'viral-mag'),
    'image_path' => $imagepath . '/inc/customizer/images/single-layouts/',
    'choices' => array(
        'layout1' => esc_html__('Layout 1', 'viral-mag'),
        'layout2' => esc_html__('Layout 2', 'viral-mag')
    )
)));

$wp_customize->add_setting('viral_mag_single_categories', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Mag_Checkbox_Control($wp_customize, 'viral_mag_single_categories', array(
    'section' => 'viral_mag_blog_options_section',
    'label' => esc_html__('Display Categories', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_single_seperator1', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Separator_Control($wp_customize, 'viral_mag_single_seperator1', array(
    'section' => 'viral_mag_blog_options_section',
)));

$wp_customize->add_setting('viral_mag_single_author', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Mag_Checkbox_Control($wp_customize, 'viral_mag_single_author', array(
    'section' => 'viral_mag_blog_options_section',
    'label' => esc_html__('Display Author', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_single_date', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Mag_Checkbox_Control($wp_customize, 'viral_mag_single_date', array(
    'section' => 'viral_mag_blog_options_section',
    'label' => esc_html__('Display Posted Date', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_single_comment_count', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Mag_Checkbox_Control($wp_customize, 'viral_mag_single_comment_count', array(
    'section' => 'viral_mag_blog_options_section',
    'label' => esc_html__('Display Comment Count', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_single_seperator2', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Separator_Control($wp_customize, 'viral_mag_single_seperator2', array(
    'section' => 'viral_mag_blog_options_section',
)));

$wp_customize->add_setting('viral_mag_single_tags', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Mag_Checkbox_Control($wp_customize, 'viral_mag_single_tags', array(
    'section' => 'viral_mag_blog_options_section',
    'label' => esc_html__('Display Tags', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_single_author_box', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => true
));

$wp_customize->add_setting('viral_mag_single_seperator3', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'transport' => 'postMessage'
));

$wp_customize->add_control(new Viral_Mag_Separator_Control($wp_customize, 'viral_mag_single_seperator3', array(
    'section' => 'viral_mag_blog_options_section',
)));

$wp_customize->add_control(new Viral_Mag_Checkbox_Control($wp_customize, 'viral_mag_single_author_box', array(
    'section' => 'viral_mag_blog_options_section',
    'label' => esc_html__('Display Author Box', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_single_prev_next_post', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Mag_Checkbox_Control($wp_customize, 'viral_mag_single_prev_next_post', array(
    'section' => 'viral_mag_blog_options_section',
    'label' => esc_html__('Display Prev/Next Post', 'viral-mag')
)));

$wp_customize->add_setting('viral_mag_single_comments', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Viral_Mag_Checkbox_Control($wp_customize, 'viral_mag_single_comments', array(
    'section' => 'viral_mag_blog_options_section',
    'label' => esc_html__('Display Comments', 'viral-mag')
)));