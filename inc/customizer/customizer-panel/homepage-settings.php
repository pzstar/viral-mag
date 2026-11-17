<?php

/* ============PRO FEATURES============ */

// Seasonal campaigns swap the banner copy automatically - see viral_mag_get_active_campaign().
$viral_mag_campaign = viral_mag_get_active_campaign();

$wp_customize->add_section(new Viral_Mag_Pro_Banner_Section($wp_customize, 'viral-mag-pro-section', array(
    'priority' => 0,
    'badge' => $viral_mag_campaign ? $viral_mag_campaign['badge'] : esc_html__('Viral Pro', 'viral-mag'),
    'title' => $viral_mag_campaign ? $viral_mag_campaign['title'] : esc_html__('Run a better news site', 'viral-mag'),
    'points' => array(
        esc_html__('50+ magazine blocks', 'viral-mag'),
        esc_html__('7 header, blog and post layouts', 'viral-mag'),
        esc_html__('19 one-click demos', 'viral-mag')
    ),
    'price' => $viral_mag_campaign ? '' : '$69',
    'price_prefix' => esc_html__('From', 'viral-mag'),
    'price_note' => esc_html__('one-time · no renewals', 'viral-mag'),
    'upgrade_text' => $viral_mag_campaign ? $viral_mag_campaign['button'] : esc_html__('Upgrade to Viral Pro', 'viral-mag'),
    'upgrade_url' => viral_mag_upgrade_url($viral_mag_campaign ? 'banner-' . $viral_mag_campaign['id'] : 'banner', 'viral-mag-customizer-button'),
    'note' => esc_html__('7-day money-back guarantee', 'viral-mag'),
    'is_sale' => (bool) $viral_mag_campaign,
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
