<?php
/*
Plugin Name: MasterStudy LMS – WordPress Course Plugin
Plugin URI: http://masterstudy.stylemixthemes.com/lms-plugin/
Description: Create brilliant lessons with videos, graphs, images, slides and any other attachments thanks to flexible and user-friendly lesson management tool powered by WYSIWYG editor.
As the ultimate LMS WordPress Plugin, MasterStudy makes it simple and hassle-free to build, customize and manage your Online Education WordPress website.
Author: StylemixThemes
Author URI: https://stylemixthemes.com/
Text Domain: masterstudy-lms-learning-management-system
Version: 2.6.9
*/

if( !defined( 'ABSPATH' ) ) exit; //Exit if accessed directly

define( 'STM_LMS_FILE', __FILE__ );
define( 'STM_LMS_PATH', dirname( STM_LMS_FILE ) );
define( 'STM_LMS_URL', plugin_dir_url( STM_LMS_FILE ) );
define( 'STM_LMS_VERSION', '2.6.7' );
define( 'STM_LMS_DB_VERSION', '2.6.7' );
define( 'STM_LMS_BASE_API_URL', '/wp-json/lms' );

if( !is_textdomain_loaded( 'masterstudy-lms-learning-management-system' ) ) {
    load_plugin_textdomain(
        'masterstudy-lms-learning-management-system',
        false,
        'masterstudy-lms-learning-management-system/languages'
    );
}

require_once( STM_LMS_PATH . '/post_type/posts.php' );
require_once( STM_LMS_PATH . '/db/tables.php' );
require_once( STM_LMS_PATH . '/lms/main.php' );
require_once( STM_LMS_PATH . '/lms/widgets/main.php' );


require_once( STM_LMS_PATH . '/lms/classes/vendor/autoload.php' );
require_once( STM_LMS_PATH . '/lms/classes/abstract/autoload.php' );
require_once( STM_LMS_PATH . '/lms/classes/models/autoload.php' );
require_once( STM_LMS_PATH . '/libraries/autoload.php' );
require_once( STM_LMS_PATH . '/lms/init.php' );
require_once( STM_LMS_PATH . '/lms/route.php' );

require_once( STM_LMS_PATH . '/nuxy/NUXY.php' );
require_once( STM_LMS_PATH . '/visual_composer/main.php' );

if( !class_exists( 'Vc_Manager' ) ) {
    require_once( STM_LMS_PATH . '/shortcodes/shortcodes.php' );
}
require_once(STM_LMS_PATH . '/user_manager/main.php');

require_once(STM_LMS_PATH . '/settings/curriculum/main.php');
require_once(STM_LMS_PATH . '/settings/questions_v1/main.php');
require_once(STM_LMS_PATH . '/settings/questions_v2/main.php');
require_once(STM_LMS_PATH . '/settings/answers/main.php');
require_once(STM_LMS_PATH . '/settings/order/main.php');
require_once(STM_LMS_PATH . '/settings/faq/main.php');
require_once(STM_LMS_PATH . '/settings/drip_content/main.php');
require_once(STM_LMS_PATH . '/settings/lms_wpcfto_helpers.php');
require_once(STM_LMS_PATH . '/settings/lms_wpcfto_ajax.php');
require_once(STM_LMS_PATH . '/settings/page_generator/main.php');

require_once( STM_LMS_PATH . '/settings/main_settings.php' );

if( is_admin() ) {
	require_once(STM_LMS_PATH . '/compatibility/main.php');
    require_once( STM_LMS_PATH . '/lms/generate_styles.php' );
    require_once( STM_LMS_PATH . '/lms/admin_helpers.php' );
    require_once( STM_LMS_PATH . '/db/fix_rating.php' );
    require_once( STM_LMS_PATH . '/announcement/main.php' );
    require_once( STM_LMS_PATH . '/announcement/item-announcements.php' );
    require_once( STM_LMS_PATH . '/wizard/main.php' );

    /*Settings Config*/
    require_once( STM_LMS_PATH . '/settings/lms_metaboxes.php' );
    require_once( STM_LMS_PATH . '/settings/course_taxonomy.php' );
    require_once( STM_LMS_PATH . '/settings/stm_lms_shortcodes/main.php' );
    require_once( STM_LMS_PATH . '/settings/stm_lms_certificate_banner/main.php' );
    require_once( STM_LMS_PATH . '/settings/demo_import/main.php' );
	require_once(STM_LMS_PATH . '/settings/order/main.php');
	require_once(STM_LMS_PATH . '/settings/payments/main.php');
	require_once(STM_LMS_PATH . '/settings/payout/main.php');
}
