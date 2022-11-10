<?php

add_action( 'admin_enqueue_scripts', function () {
	stm_lms_register_script( 'admin/lms_sub_menu' );
} );

function stm_lms_add_theme_caps() {

	$admin_users   = $instructors = array();
	$admin_users[] = get_role( 'administrator' );
	$instructors[] = get_role( 'stm_lms_instructor' );

	if ( ! empty( $admin_users ) ) {
		foreach ( $admin_users as $user ) {
			if ( empty( $user ) ) {
				continue;
			}
			foreach ( array( 'publish', 'delete', 'delete_others', 'delete_private', 'delete_published', 'edit', 'edit_others', 'edit_private', 'edit_published', 'read_private' ) as $cap ) {
				$user->add_cap( "{$cap}_stm_lms_posts" );
			}
		}
	}

	if ( ! empty( $instructors ) ) {
		foreach ( $instructors as $user ) {
			if ( empty( $user ) ) {
				continue;
			}
			foreach ( array( 'publish', 'delete', 'edit' ) as $cap ) {
				$user->add_cap( "edit_posts" );
				$user->add_cap( "{$cap}_stm_lms_posts" );
			}
		}
	}

}

add_action( 'init', 'stm_lms_add_theme_caps' );


add_action( 'admin_enqueue_scripts', function () {
	$v = (WP_DEBUG) ? time() : STM_LMS_DB_VERSION;
	wp_enqueue_style('stm_lms_icons', STM_LMS_URL . 'assets/icons/style.css', NULL, $v);
	stm_lms_register_script( 'admin/admin', array( 'jquery' ), true );

	stm_lms_register_script('payout/user-search', array('vue.js', 'vue-select.js'));
	wp_localize_script( 'stm-lms-payout/user-search', 'stm_payout_url_data', array(
		'url' => get_site_url() . STM_LMS_BASE_API_URL,
	) );

	stm_lms_register_style('nuxy/main');

} );

add_action('wp_ajax_stm_lms_hide_announcement', function(){
    check_ajax_referer('stm_lms_hide_announcement', 'nonce');
    set_transient('stm_lms_app_notice', '1', MONTH_IN_SECONDS);
});

add_action('admin_init', 'stm_lms_deny_instructor_admin');

function stm_lms_deny_instructor_admin() {
    if(!wp_doing_ajax() && !empty(STM_LMS_Options::get_option('deny_instructor_admin', ''))){
        $user = wp_get_current_user();
        if ( in_array( 'stm_lms_instructor', (array) $user->roles ) ) {
            wp_safe_redirect(STM_LMS_User::user_page_url());
            die();
        }
    }
}

add_action( 'save_post_stm-courses', function ( $post_id, $post, $update ) {
	if ( ! $update ) {
		return;
	}
	$created = get_option( 'stm_lms_course_created', false );
	if ( ! $created ) {
		$data = [ 'show_time' => time(), 'step' => 0, 'prev_action' => '' ];
		set_transient( 'stm_masterstudy-lms-learning-management-system_single_notice_setting', $data );
		update_option( 'stm_lms_course_created', true );
	}

}, 20, 3 );

add_action( 'stm_admin_notice_rate_masterstudy-lms-learning-management-system_single', function ( $data ) {
	if ( is_array( $data ) ) {
		$data['title']   = 'Yoo-hoo!';
		$data['content'] = 'You have created your first course! Enjoyed? Help us to rate <strong>MasterStudy 5 Stars!</strong>';
	}

	return $data;
}, 100 );