<?php

$viral_pro_features = '<ul class="upsell-features">
	<li>' . esc_html__("14 more demos that can be imported with one click", "viral-mag") . '</li>
        <li>' . esc_html__("Elementor compatible - Built your Home Page with Customizer or Elementor whichever you like", "viral-mag") . '</li>
	<li>' . esc_html__("50+ magazine blocks for customizer", "viral-mag") . '</li>
	<li>' . esc_html__("Customizer home page section reorder", "viral-mag") . '</li>
	<li>' . esc_html__("45+ magazine widgets for Elementor", "viral-mag") . '</li>
        <li>' . esc_html__("Ajax Tabs and Ajax Paginations for all Elementor widgets", "viral-mag") . '</li>
	<li>' . esc_html__("7 header layouts with advanced settings", "viral-mag") . '</li>
        <li>' . esc_html__("7 differently designed Blog/Archive layouts", "viral-mag") . '</li>
	<li>' . esc_html__("7 differently designed Article/Post layouts", "viral-mag") . '</li>
	<li>' . esc_html__("22 custom widgets", "viral-mag") . '</li>
	<li>' . esc_html__("GDPR compliance & cookies consent", "viral-mag") . '</li>
	<li>' . esc_html__("In-built megaMenu", "viral-mag") . '</li>
	<li>' . esc_html__("Advanced typography options", "viral-mag") . '</li>
	<li>' . esc_html__("Advanced color options", "viral-mag") . '</li>
	<li>' . esc_html__("Preloader option", "viral-mag") . '</li>
	<li>' . esc_html__("Advanced blog & article settings", "viral-mag") . '</li>
	<li>' . esc_html__("Advanced footer setting", "viral-mag") . '</li>
	<li>' . esc_html__("Advanced advertising & monetization options", "viral-mag") . '</li>
	<li>' . esc_html__("WooCommerce compatible", "viral-mag") . '</li>
	<li>' . esc_html__("Fully multilingual and translation ready", "viral-mag") . '</li>
	<li>' . esc_html__("Fully RTL(right to left) languages compatible", "viral-mag") . '</li>
        <li>' . esc_html__("Maintenance mode option", "viral-mag") . '</li>
        <li>' . esc_html__("Remove footer credit text", "viral-mag") . '</li>
	</ul>
	<a class="ht-implink" href="https://hashthemes.com/wordpress-theme/viral-pro/#theme-comparision-tab" target="_blank">' . esc_html__("Comparision - Free Vs Pro", "viral-mag") . '</a>';

/* ============PRO FEATURES============ */
$wp_customize->add_section('viral_pro_feature_section', array(
    'title' => esc_html__('Pro Theme Features', 'viral-mag'),
    'priority' => 0
));

$wp_customize->add_setting('viral_mag_hide_upgrade_notice', array(
    'sanitize_callback' => 'viral_mag_sanitize_checkbox',
    'default' => false,
));

$wp_customize->add_control(new Viral_Mag_Toggle_Control($wp_customize, 'viral_mag_hide_upgrade_notice', array(
    'section' => 'viral_pro_feature_section',
    'label' => esc_html__('Hide all Upgrade Notices from Customizer', 'viral-mag'),
    'description' => esc_html__('If you don\'t want to upgrade to premium version then you can turn off all the upgrade notices. However you can turn it on anytime if you make mind to upgrade to premium version.', 'viral-mag')
)));

$wp_customize->add_setting('viral_pro_features', array(
    'sanitize_callback' => 'viral_mag_sanitize_text',
));

$wp_customize->add_control(new Viral_Mag_Upgrade_Info_Control($wp_customize, 'viral_pro_features', array(
    'settings' => 'viral_pro_features',
    'section' => 'viral_pro_feature_section',
    'description' => $viral_pro_features,
    'active_callback' => 'viral_mag_is_upgrade_notice_active'
)));
