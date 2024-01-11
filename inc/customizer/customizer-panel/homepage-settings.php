<?php

/* ============PRO FEATURES============ */

$wp_customize->add_section(new Viral_Mag_Upgrade_Section($wp_customize, 'viral-mag-pro-section', array(
    'priority' => 0,
    //'title' => esc_html__('Christmas & New Year Deal. Use Coupon Code: HOLIDAY', 'viral-mag'),
    'upgrade_text' => esc_html__('Upgrade to Pro', 'viral-mag'),
    'upgrade_url' => 'https://hashthemes.com/wordpress-theme/viral-pro/?utm_source=wordpress&utm_medium=viral-mag-customizer-button&utm_campaign=viral-mag-upgrade'
)));

$wp_customize->add_section(new Viral_Mag_Upgrade_Section($wp_customize, 'viral-mag-doc-section', array(
    'title' => esc_html__('Documentation', 'viral-mag'),
    'priority' => 1000,
    'upgrade_text' => esc_html__('View', 'viral-mag'),
    'upgrade_url' => 'https://hashthemes.com/documentation/viral-mag-documentation/'
)));

$wp_customize->add_section(new Viral_Mag_Upgrade_Section($wp_customize, 'viral-mag-demo-import-section', array(
    'title' => esc_html__('Import Demo Content', 'viral-mag'),
    'priority' => 999,
    'upgrade_text' => esc_html__('Import', 'viral-mag'),
    'upgrade_url' => admin_url('admin.php?page=viral-mag-welcome')
)));

/* ============HOMEPAGE SETTINGS PANEL============ */
$wp_customize->get_section('static_front_page')->priority = 1;
