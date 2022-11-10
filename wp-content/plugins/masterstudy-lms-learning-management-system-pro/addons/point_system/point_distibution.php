<?php

new STM_LMS_Point_Distribution;

class STM_LMS_Point_Distribution
{

    function __construct()
    {

    }

    static function points_distribution_url() {
        $settings = get_option('stm_lms_settings', array());

        if (empty($settings['user_url']) or !did_action('init')) return home_url('/');

        return get_the_permalink($settings['user_url']) . 'points-distribution';
    }

}