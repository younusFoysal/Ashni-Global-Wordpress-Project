<?php

STM_LMS_Pro_Addons::init();

class STM_LMS_Pro_Addons
{
    public static function init()
    {
        add_action('init', 'STM_LMS_Pro_Addons::manage_addons', -1);
        add_action('wp_ajax_stm_lms_pro_save_addons', 'STM_LMS_Pro_Addons::save_addons');
        add_action('wp_ajax_stm_lms_enable_addon', 'STM_LMS_Pro_Addons::enable_addon');

        self::filter_names();
    }

    public static function available_addons()
    {
        return array(
            'udemy' => array(
                'name' => esc_html__('Udemy Importer', 'masterstudy-lms-learning-management-system-pro'),
                'url' => esc_url(STM_LMS_URL . '/assets/addons/udemy.png'),
                'settings' => admin_url('admin.php?page=stm-lms-udemy-settings')
            ),
            'prerequisite' => array(
                'name' => esc_html__('Prerequisites', 'masterstudy-lms-learning-management-system-pro'),
                'url' => esc_url(STM_LMS_URL . '/assets/addons/msp.png'),
            ),
            'online_testing' => array(
                'name' => esc_html__('Online Testing', 'masterstudy-lms-learning-management-system-pro'),
                'url' => esc_url(STM_LMS_URL . '/assets/addons/mst.png'),
                'settings' => admin_url('admin.php?page=stm-lms-online-testing')
            ),
            'statistics' => array(
                'name' => esc_html__('Statistics and Payout', 'masterstudy-lms-learning-management-system-pro'),
                'url' => esc_url(STM_LMS_URL . '/assets/addons/statistics.png'),
                'settings' => admin_url('admin.php?page=stm_lms_statistics')
            ),
            'shareware' => array(
                'name' => esc_html__('Trial Courses', 'masterstudy-lms-learning-management-system-pro'),
                'url' => esc_url(STM_LMS_URL . '/assets/addons/trial_courses.png'),
            ),
            'sequential_drip_content' => array(
                'name' => esc_html__('Drip Content', 'masterstudy-lms-learning-management-system-pro'),
                'url' => esc_url(STM_LMS_URL . '/assets/addons/sequential.png'),
                'settings' => admin_url('admin.php?page=sequential_drip_content')
            ),
            'gradebook' => array(
                'name' => esc_html__('The Gradebook', 'masterstudy-lms-learning-management-system-pro'),
                'url' => esc_url(STM_LMS_URL . '/assets/addons/gradebook.png'),
            ),
            'live_streams' => array(
                'name' => esc_html__('Live Streaming', 'masterstudy-lms-learning-management-system-pro'),
                'url' => esc_url(STM_LMS_URL . '/assets/addons/live-stream.png'),
            ),
            'enterprise_courses' => array(
                'name' => esc_html__('Group Courses', 'masterstudy-lms-learning-management-system-pro'),
                'url' => esc_url(STM_LMS_URL . '/assets/addons/enterprise-groups.png'),
                'settings' => admin_url('admin.php?page=enterprise_courses')
            ),
            'assignments' => array(
                'name' => esc_html__('Assignments', 'masterstudy-lms-learning-management-system-pro'),
                'url' => esc_url(STM_LMS_URL . '/assets/addons/assignment.png'),
                'settings' => admin_url('admin.php?page=assignments_settings')
            ),
            'point_system' => array(
                'name' => esc_html__('Point system', 'masterstudy-lms-learning-management-system-pro'),
                'url' => esc_url(STM_LMS_URL . '/assets/addons/points.png'),
                'settings' => admin_url('admin.php?page=point_system_settings')
            ),
            'course_bundle' => array(
                'name' => esc_html__('Course Bundle', 'masterstudy-lms-learning-management-system-pro'),
                'url' => esc_url(STM_LMS_URL . '/assets/addons/bundle.jpg'),
                'settings' => admin_url('admin.php?page=course_bundle_settings')
            ),
            'multi_instructors' => array(
                'name' => esc_html__('Multi-instructors', 'masterstudy-lms-learning-management-system-pro'),
                'url' => esc_url(STM_LMS_URL . '/assets/addons/multi_instructors.png'),
            ),
            'google_classrooms' => array(
                'name' => esc_html__('Google Classrooms', 'masterstudy-lms-learning-management-system-pro'),
                'url' => esc_url(STM_LMS_URL . '/assets/addons/google_classroom.png'),
                'settings' => admin_url('admin.php?page=google_classrooms')
            ),
            'zoom_conference' => array(
                'name' => esc_html__('Zoom Conference', 'masterstudy-lms-learning-management-system-pro'),
                'url' => esc_url(STM_LMS_URL . '/assets/addons/zoom_conference.jpg'),
                'settings' => admin_url('admin.php?page=stm_lms_zoom_conference')
            ),
            'scorm' => array(
                'name' => esc_html__('Scorm', 'masterstudy-lms-learning-management-system-pro'),
                'url' => esc_url(STM_LMS_URL . '/assets/addons/scorm.jpg'),
                'settings' => admin_url('admin.php?page=scorm_settings')
            ),
            'email_manager' => array(
                'name' => esc_html__('Email Manager', 'masterstudy-lms-learning-management-system-pro'),
                'url' => esc_url(STM_LMS_URL . '/assets/addons/email_manager.png'),
                'settings' => admin_url('admin.php?page=email_manager_settings')
            ),
            'certificate_builder' => array(
                'name' => esc_html__('Certificate Builder', 'masterstudy-lms-learning-management-system-pro'),
                'url' => esc_url(STM_LMS_URL . '/assets/addons/certtificate_builder.png'),
                'settings' => admin_url('admin.php?page=certificate_builder')
            ),
            'form_builder' => array(
                'name' => esc_html__('Form Builder', 'masterstudy-lms-learning-management-system-pro'),
                'url' => esc_url(STM_LMS_URL . '/assets/addons/certtificate_builder.png'),
                'settings' => admin_url('admin.php?page=form_builder')
            )
        );
    }

    public static function manage_addons()
    {
        $addons_enabled = get_option('stm_lms_addons', array());
        $available_addons = STM_LMS_Pro_Addons::available_addons();

        foreach ($available_addons as $addon => $settings) {
            if (!empty($addons_enabled[$addon]) and $addons_enabled[$addon] == 'on') {
                require_once STM_LMS_PRO_PATH . "/addons/{$addon}/main.php";
            }
        }
    }

    public static function _save_addons($addons)
    {

        if (function_exists('stm_lms_point_system_table')) stm_lms_point_system_table();

        if (function_exists('stm_lms_scorm_table')) stm_lms_scorm_table();

        $addons = json_decode($addons, true);

        update_option('stm_lms_addons', $addons);
    }

    public static function save_addons()
    {

        check_ajax_referer('stm_lms_pro_save_addons', 'nonce');

        self::_save_addons(stripcslashes($_POST['addons']));

        wp_send_json('done');
    }

    public static function enable_addon()
    {

        if (!current_user_can('manage_options')) die;

        $addons = get_option('stm_lms_addons');


        $addon = sanitize_text_field($_GET['addon']);
        if (empty($addons)) {
            $addons = array_fill_keys(array_keys(self::available_addons()), '');
        } else {
            $addons[$addon] = 'on';
        }

        if (isset($addons[$addon])) {
            $addons[$addon] = 'on';
        }

        self::_save_addons(json_encode($addons));

        wp_send_json('done');

    }

    public static function filter_names()
    {

        /*DRIP CONTENT*/
        add_filter('wpcfto_addon_option_drip_content', function () {
            return 'sequential_drip_content';
        });

        /*Enterprise courses*/
        add_filter('wpcfto_addon_option_enterprise_price', function () {
            return 'enterprise_courses';
        });

        /*Prerequisites*/
        add_filter('wpcfto_addon_option_prerequisites', function () {
            return 'prerequisite';
        });

        add_filter('wpcfto_addon_option_prerequisite_passing_level', function () {
            return 'prerequisite';
        });

        /* Certificate Builder */
        add_filter('wpcfto_addon_option_course_certificate', function () {
            return 'certificate_builder';
        });


    }

    static function get_addon_name($addon)
    {
        $available_addons = self::available_addons();
        return $available_addons[$addon]['name'];
    }

}

