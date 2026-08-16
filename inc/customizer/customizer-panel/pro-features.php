<?php

$viral_pro_features = '<p><strong>' . esc_html__("$69 once. No subscription, no renewal fees.", "viral-mag") . '</strong><br>' . esc_html__("Use Viral Pro on unlimited websites, keep every future update free, and get support replies in 10 hours or less.", "viral-mag") . '</p>
    <ul class="upsell-features">
	<li>' . esc_html__("17 ready-made demos that can be imported with one click", "viral-mag") . '</li>
        <li>' . esc_html__("Elementor widgets built into the theme - no companion plugin needed", "viral-mag") . '</li>
	<li>' . esc_html__("50+ magazine blocks for customizer", "viral-mag") . '</li>
	<li>' . esc_html__("Customizer home page section reorder", "viral-mag") . '</li>
	<li>' . esc_html__("45+ magazine widgets for Elementor", "viral-mag") . '</li>
        <li>' . esc_html__("Ajax Tabs and Ajax Paginations for all Elementor widgets", "viral-mag") . '</li>
	<li>' . esc_html__("12 title bar styles and 10 thumbnail hover effects for magazine blocks", "viral-mag") . '</li>
	<li>' . esc_html__("7 header layouts with advanced settings", "viral-mag") . '</li>
        <li>' . esc_html__("7 differently designed Blog/Archive layouts", "viral-mag") . '</li>
	<li>' . esc_html__("7 differently designed Article/Post layouts", "viral-mag") . '</li>
	<li>' . esc_html__("23 custom widgets", "viral-mag") . '</li>
	<li>' . esc_html__("Table of contents for single posts", "viral-mag") . '</li>
	<li>' . esc_html__("NewsArticle structured data in JSON-LD with speakable markup", "viral-mag") . '</li>
	<li>' . esc_html__("Google News sitemap", "viral-mag") . '</li>
	<li>' . esc_html__("Speculative loading - the next article opens instantly", "viral-mag") . '</li>
	<li>' . esc_html__("Icon library and Google font loading control", "viral-mag") . '</li>
	<li>' . esc_html__("Print stylesheet for articles", "viral-mag") . '</li>
	<li>' . esc_html__("GDPR compliance & cookies consent", "viral-mag") . '</li>
	<li>' . esc_html__("In-built megaMenu", "viral-mag") . '</li>
	<li>' . esc_html__("Advanced typography options", "viral-mag") . '</li>
	<li>' . esc_html__("Advanced color options", "viral-mag") . '</li>
	<li>' . esc_html__("Preloader option", "viral-mag") . '</li>
	<li>' . esc_html__("Advanced blog & article settings", "viral-mag") . '</li>
	<li>' . esc_html__("Advanced footer setting", "viral-mag") . '</li>
	<li>' . esc_html__("Advanced advertising & monetization options", "viral-mag") . '</li>
	<li>' . esc_html__("WooCommerce compatible", "viral-mag") . '</li>
	<li>' . esc_html__("Polylang compatible", "viral-mag") . '</li>
        <li>' . esc_html__("Maintenance mode option", "viral-mag") . '</li>
        <li>' . esc_html__("Remove footer credit text", "viral-mag") . '</li>
	<li>' . esc_html__("Unlimited custom widget areas", "viral-mag") . '</li>
	<li>' . esc_html__("Video, gradient and parallax backgrounds for front page sections", "viral-mag") . '</li>
	<li>' . esc_html__("16 SVG shape dividers between front page sections", "viral-mag") . '</li>
	<li>' . esc_html__("Front page sections with full screen height", "viral-mag") . '</li>
	</ul>
	<a class="ht-implink button button-primary" href="' . esc_url(viral_mag_upgrade_url('why-upgrade-cta', 'viral-mag-customizer')) . '" target="_blank">' . esc_html__("Get Viral Pro - $69", "viral-mag") . '</a>
	<p style="text-align:center;margin:10px 0 0"><a href="' . admin_url('admin.php?page=viral-mag-welcome&section=free_vs_pro') . '" target="_blank">' . esc_html__("Compare Free vs Pro", "viral-mag") . '</a></p>';

/* ============PRO FEATURES============ */
$wp_customize->add_section('viral_pro_feature_section', array(
	'title' => esc_html__('Why Upgrade to Viral Pro?', 'viral-mag'),
	'priority' => 0
));

$wp_customize->add_setting('viral_mag_hide_upgrade_notice', array(
	'sanitize_callback' => 'viral_mag_sanitize_checkbox',
	'default' => false,
));

$wp_customize->add_control(new Viral_Mag_Toggle_Control($wp_customize, 'viral_mag_hide_upgrade_notice', array(
	'section' => 'viral_pro_feature_section',
	'priority' => 20,
	'label' => esc_html__('Hide all Upgrade Notices from Customizer', 'viral-mag'),
	'description' => esc_html__('If you don\'t want to upgrade to premium version then you can turn off all the upgrade notices. However you can turn it on anytime if you make mind to upgrade to premium version.', 'viral-mag')
)));

$wp_customize->add_setting('viral_pro_features', array(
	'sanitize_callback' => 'viral_mag_sanitize_text',
));

$wp_customize->add_control(new Viral_Mag_Upgrade_Info_Control($wp_customize, 'viral_pro_features', array(
	'settings' => 'viral_pro_features',
	'section' => 'viral_pro_feature_section',
	'priority' => 10,
	'description' => $viral_pro_features,
	'active_callback' => 'viral_mag_is_upgrade_notice_active'
)));
