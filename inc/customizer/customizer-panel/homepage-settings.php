<?php

/* ============PRO FEATURES============ */

// Seasonal campaigns swap the banner copy automatically - see viral_mag_get_active_campaign().
$viral_mag_campaign = viral_mag_get_active_campaign();
$viral_mag_banner_title = $viral_mag_campaign ? $viral_mag_campaign['title'] : esc_html__('One-time payment. Unlimited sites. Lifetime updates.', 'viral-mag');
$viral_mag_banner_button = $viral_mag_campaign ? $viral_mag_campaign['button'] : esc_html__('Get Viral Pro - $69', 'viral-mag');

$wp_customize->add_section(new Viral_Mag_Upgrade_Section($wp_customize, 'viral-mag-pro-section', array(
    'priority' => 0,
    'title' => $viral_mag_banner_title,
    'upgrade_text' => $viral_mag_banner_button,
    'upgrade_url' => viral_mag_upgrade_url($viral_mag_campaign ? 'banner-' . $viral_mag_campaign['id'] : 'banner', 'viral-mag-customizer-button'),
    'active_callback' => 'viral_mag_is_upgrade_notice_active'
)));

$wp_customize->add_section(new Viral_Mag_Upgrade_Section($wp_customize, 'viral-mag-doc-section', array(
    'title' => esc_html__('Documentation', 'viral-mag'),
    'priority' => 1000,
    'class' => 'ht--single-row',
    'upgrade_text' => esc_html__('View', 'viral-mag'),
    'upgrade_url' => 'https://hashthemes.com/documentation/viral-mag-documentation/'
)));

$wp_customize->add_section(new Viral_Mag_Upgrade_Section($wp_customize, 'viral-mag-demo-import-section', array(
    'title' => esc_html__('Import Demo Content', 'viral-mag'),
    'priority' => 999,
    'class' => 'ht--single-row',
    'upgrade_text' => esc_html__('Import', 'viral-mag'),
    'upgrade_url' => admin_url('admin.php?page=viral-mag-welcome')
)));

/* ============HOMEPAGE SETTINGS PANEL============ */
$wp_customize->get_section('static_front_page')->priority = 1;
