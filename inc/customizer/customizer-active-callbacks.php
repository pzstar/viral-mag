<?php

/**
 * Viral Mag Custom JS
 *
 * @package Viral Mag
 */
function viral_mag_check_slider_type_rev($control) {
    $viral_mag_slider_type = $control->manager->get_setting('viral_mag_slider_type')->value();
    if ($viral_mag_slider_type == 'revolution') {
        return true;
    } else {
        return false;
    }
}
