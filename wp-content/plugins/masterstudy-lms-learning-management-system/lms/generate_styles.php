<?php

if ( ! defined( 'ABSPATH' ) ) exit; //Exit if accessed directly


add_action('init', 'stm_lms_generate_styles');

function stm_lms_generate_styles() {

    if(current_user_can('manage_options')) {

        global $wp_filesystem;

        if (empty($wp_filesystem)) {
            require_once ABSPATH . '/wp-admin/includes/file.php';
            WP_Filesystem();
        }

        $upload = wp_upload_dir();
        $upload_dir = $upload['basedir'];
        $upload_dir = $upload_dir . '/stm_lms_styles';
        $upload_dir_parts = $upload_dir . '/parts';

        if (!$wp_filesystem->is_dir($upload_dir)) {
            wp_mkdir_p($upload_dir);
        }

        if (!$wp_filesystem->is_dir($upload_dir_parts)) {
            wp_mkdir_p($upload_dir_parts);
        }

        $inner_folders = array(
            'account',
            'add_students',
            'admin',
            'app',
            'bundles',
            'certificate_builder',
            'co_courses',
            'course',
            'courses',
            'dashboard',
            'expiration',
            'float_menu',
            'google_classroom',
            'lesson',
            'noconflict',
            'panel',
            'scorm',
            'wizard',
            'nuxy',
        );


        foreach($inner_folders as $inner_folder) {

            $inner_folder  = $upload_dir_parts . '/' . $inner_folder . '/';

            if (!$wp_filesystem->is_dir($inner_folder)) {
                $wp_filesystem->mkdir($inner_folder);
            }
        }

        /*Create img folder*/
        $image_dir = $upload_dir . '/img';
        if (!$wp_filesystem->is_dir($image_dir)) {
            wp_mkdir_p($image_dir);
        }

        $image_inner = array('starfull.svg', 'staremptyl.svg');

        foreach($image_inner as $image) {
            @copy(STM_LMS_PATH . "/assets/img/{$image}", $image_dir . "/{$image}");
        }

        if (stm_lms_has_custom_colors()) {

            $styles = [];
            $css_styles_path = STM_LMS_PATH . '/assets/css/';
            $css_styles = array_diff(scandir($css_styles_path), array('..', '.', 'parts'));

            $css_styles_parts_path = STM_LMS_PATH . '/assets/css/parts/';
            $css_styles_parts = array_diff(scandir($css_styles_parts_path), array('..', '.'));

            /*Courses Styles*/
            foreach ($css_styles as $style) {
                $styles[$style] = $css_styles_path . $style;
            }

            foreach ($css_styles_parts as $style) {
                $styles["parts/{$style}"] = $css_styles_parts_path . $style;
            }


            foreach($inner_folders as $inner_folder) {

                $css_courses_styles_parts = array_diff(scandir($css_styles_parts_path . '/' . $inner_folder), array('..', '.'));

                foreach ($css_courses_styles_parts as $style) {
                    $styles["parts/{$inner_folder}/{$style}"] = $css_styles_parts_path . $inner_folder . '/' . $style;
                }
            }

            foreach ($styles as $style_name => $style) {
                if (is_dir($style) || !file_exists($style)) continue;
                $css = stm_lms_change_css_styles(file_get_contents($style));
                $wp_filesystem->put_contents($upload_dir . '/' . $style_name, $css, FS_CHMOD_FILE);
            }

            stm_lms_update_styles_version();
        }

    }

}

function stm_lms_change_css_styles($css_content) {
	$main_color = STM_LMS_Options::get_option('main_color', '#385bce');
	$secondary_color = STM_LMS_Options::get_option('secondary_color', '#17d292');



	/*IMG Path*/
	$img_path = STM_LMS_URL . '/assets/';

	$original_colors = array(
		'#385bce',
		'#17d292',
		'#5cbc87',
		'../../'
	);

	$replace_colors = array(
		$main_color,
		$secondary_color,
		$secondary_color,
		$img_path
	);

	return str_replace($original_colors, $replace_colors, $css_content);
}

function stm_lms_update_styles_version() {
	$version = intval(get_option('stm_lms_styles_v', 1));
	update_option('stm_lms_styles_v', $version += 1);
}
