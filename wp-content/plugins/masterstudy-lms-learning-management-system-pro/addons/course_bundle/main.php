<?php

require_once STM_LMS_PRO_PATH . '/addons/course_bundle/settings.php';
require_once STM_LMS_PRO_PATH . '/addons/course_bundle/my-bundles.php';
require_once STM_LMS_PRO_PATH . '/addons/course_bundle/my-bundle.php';
require_once STM_LMS_PRO_PATH . '/addons/course_bundle/cart.php';
require_once STM_LMS_PRO_PATH . '/addons/course_bundle/woocommerce.php';
require_once STM_LMS_PRO_PATH . '/addons/course_bundle/vc_module.php';

new STM_LMS_Course_Bundle;

class STM_LMS_Course_Bundle
{

    function __construct()
    {
        add_filter('stm_lms_float_menu_items', function ($menus, $current_user, $lms_template_current, $object_id) {
            if (STM_LMS_Instructor::is_instructor()) {
                $menus[] = array(
                    'order' => 50,
                    'current_user' => $current_user,
                    'lms_template_current' => $lms_template_current,
                    'lms_template' => 'stm-lms-user-bundles',
                    'menu_title' => esc_html__('Bundles', 'masterstudy-lms-learning-management-system-pro'),
                    'menu_icon' => 'fa-layer-group',
                    'menu_url' => $this::url(),
                );
            }

            return $menus;
        }, 10, 4);
        add_filter('stm_lms_post_types_array', array($this, 'assignment_post_type'), 10, 1);
        add_filter('stm_lms_post_types', array($this, 'bundles_stm_lms_post_types'), 5, 1);

        add_action('stm_lms_after_wishlist_list', array($this, 'wishlist_list'), 10, 1);

        add_shortcode('stm_lms_course_bundles', array($this, 'add_shortcode'));
    }

    /*FILTERS*/
    function assignment_post_type($posts)
    {

        $posts['stm-course-bundles'] = array(
            'single' => esc_html__('Course Bundles', 'masterstudy-lms-learning-management-system-pro'),
            'plural' => esc_html__('Course Bundles', 'masterstudy-lms-learning-management-system-pro'),
            'args' => array(
                'public' => true,
                'exclude_from_search' => false,
                'publicly_queryable' => true,
                'show_in_menu' => false,
                'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'author'),
            )
        );

        return $posts;
    }

    function add_shortcode($atts) {
        $atts = shortcode_atts( array(
            'title' => '',
            'columns' => '',
            'posts_per_page' => ''
        ), $atts );

        return STM_LMS_Templates::load_lms_template('vc_templates/templates/stm_lms_course_bundles', $atts);
    }

    function bundles_stm_lms_post_types($post_types)
    {
        $post_types[] = 'stm-course-bundles';

        return $post_types;
    }


    /*ACTIONS*/
    function wishlist_list($wishlist) {
        $columns = 3;
        $title = esc_html__('Bundles', 'masterstudy-lms-learning-management-system-pro');
        STM_LMS_Templates::show_lms_template(
            'bundles/card/php/list',
            compact('wishlist', 'columns', 'title')
        );
    }

    /*FUNCTIONS*/
    static function url()
    {
        $settings = get_option('stm_lms_settings', array());

        if (empty($settings['user_url']) or !did_action('init')) return home_url('/');

        return get_the_permalink($settings['user_url']) . 'bundles';
    }

    static function get_bundle_courses_price($bundle_id) {
        $price = 0;
        $courses = get_post_meta($bundle_id, STM_LMS_My_Bundle::bundle_courses_key(), true);

        if (empty($courses)) return $price;

        foreach ($courses as $course_id) {
            $price += STM_LMS_Course::get_course_price($course_id);
        }

        return $price;
    }

    static function get_bundle_price($bundle_id) {
        return get_post_meta($bundle_id, STM_LMS_My_Bundle::bundle_price_key(), true);
    }

    static function get_bundle_rating($bundle_id)
    {
        $r = array(
            'count' => 0,
            'average' => 0,
            'percent' => 0
        );

        $courses = get_post_meta($bundle_id, STM_LMS_My_Bundle::bundle_courses_key(), true);

        if (empty($courses)) return $r;

        foreach ($courses as $course_id) {
            $reviews = get_post_meta($course_id, 'course_marks', true);
            if (!empty($reviews)) {
                $rates = STM_LMS_Course::course_average_rate($reviews);
                $r['count'] ++;
                $r['average'] += $rates['average'];
                $r['percent'] += $rates['percent'];
            }
        }

        return $r;
    }

}