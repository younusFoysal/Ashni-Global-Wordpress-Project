<?php

new STM_LMS_Zoom_Conference;

class STM_LMS_Zoom_Conference
{

    function __construct()
    {
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );

        add_action( 'stm_lms_lesson_types', array( $this, 'add_lesson_type' ) );

        add_action( 'stm_lms_lesson_manage_settings', array( $this, 'lesson_manage_settings' ) );

        add_filter( 'stm_lms_course_item_content', array( $this, 'course_item_content' ), 10, 3 );

        add_action( 'stm_lms_save_lesson_after_validation', array( $this, 'update_meeting' ), 10, 2 );

        add_action( 'save_post', array( $this, 'update_admin_meeting' ), 10, 2 );

        add_filter( 'stm_wpcfto_fields', array( $this, 'add_lesson_type_admin' ), 100, 1 );

        add_filter( 'stm_lms_show_item_content', array( $this, 'show_item_content' ), 10, 3 );

        add_filter( 'wp_ajax_install_zoom_addon', array( $this, 'install_zoom_addon' ), 10, 2 );

        add_filter( 'stm_lms_duration_field_type', function() {
            return 'number';
        } );

        add_action( 'wpcfto_options_page_setup', array( $this, 'stm_lms_settings_page' ) );

        add_action( 'wpcfto_settings_screen_stm_lms_zoom_conference_settings_after', function() {
            require_once STM_LMS_PRO_PATH . '/addons/zoom_conference/admin_views/install_zoom_plugin.php';
        } );
    }

    public static function admin_scripts()
    {
        wp_enqueue_script( 'admin_zoom_conference', STM_LMS_PRO_URL . '/assets/js/admin-zoom-conference.js', array( 'jquery' ), '1.0', true );
    }

    public static function install_zoom_addon()
    {
        check_ajax_referer( 'install_zoom_addon', 'nonce' );
        $install_plugin = STM_LMS_PRO_Plugin_Installer::install_plugin( array(
            'slug' => 'eroom-zoom-meetings-webinar',
        ) );
        wp_send_json( $install_plugin );
    }

    public static function register_stream_post_type()
    {
        $labels = array(
            'name' => _x( 'Zoom Conferences', 'post type general name', 'masterstudy-lms-learning-management-system-pro' ),
            'singular_name' => _x( 'Zoom Conference', 'post type singular name', 'masterstudy-lms-learning-management-system-pro' ),
            'menu_name' => _x( 'Zoom Conferences', 'admin menu', 'masterstudy-lms-learning-management-system-pro' ),
            'name_admin_bar' => _x( 'Zoom Conference', 'add new on admin bar', 'masterstudy-lms-learning-management-system-pro' ),
            'add_new' => _x( 'Add New', 'zoom_conference', 'masterstudy-lms-learning-management-system-pro' ),
            'add_new_item' => __( 'Add New Zoom Conference', 'masterstudy-lms-learning-management-system-pro' ),
            'new_item' => __( 'New Zoom Conference', 'masterstudy-lms-learning-management-system-pro' ),
            'edit_item' => __( 'Edit Zoom Conference', 'masterstudy-lms-learning-management-system-pro' ),
            'view_item' => __( 'View Zoom Conference', 'masterstudy-lms-learning-management-system-pro' ),
            'all_items' => __( 'All Zoom Conferences', 'masterstudy-lms-learning-management-system-pro' ),
            'search_items' => __( 'Search Zoom Conferences', 'masterstudy-lms-learning-management-system-pro' ),
            'parent_item_colon' => __( 'Parent Zoom Conferences:', 'masterstudy-lms-learning-management-system-pro' ),
            'not_found' => __( 'No Zoom Conferences found.', 'masterstudy-lms-learning-management-system-pro' ),
            'not_found_in_trash' => __( 'No Zoom Conferences found in Trash.', 'masterstudy-lms-learning-management-system-pro' )
        );

        $args = array(
            'labels' => $labels,
            'description' => __( 'Description.', 'masterstudy-lms-learning-management-system-pro' ),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'zoom_conference' ),
            'capability_type' => 'post',
            'has_archive' => true,
            'menu_icon' => 'dashicons-video-alt3',
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
        );

        register_post_type( 'zoom_conference', $args );
    }

    public static function add_lesson_type()
    {
        if( !empty( get_the_author_meta( 'stm_lms_zoom_host', get_current_user_id() ) ) ): ?>

            <option value="zoom_conference"><?php esc_html_e( 'Zoom Conference', 'masterstudy-lms-learning-management-system-pro' ); ?></option>

        <?php
        endif;
    }

    public static function add_lesson_type_admin( $fields )
    {

        $fields[ 'stm_lesson_settings' ][ 'section_lesson_settings' ][ 'fields' ][ 'type' ][ 'options' ][ 'zoom_conference' ] = esc_html__( 'Zoom Conference', 'masterstudy-lms-learning-management-system-pro' );

        $fields[ 'stm_lesson_settings' ][ 'section_lesson_settings' ][ 'fields' ][ 'stream_start_date' ] = array(
            'type' => 'date',
            'label' => esc_html__( 'Conference Start Date', 'masterstudy-lms-learning-management-system-pro' ),
            'value' => '',
            'dependency' => array(
                'key' => 'type',
                'value' => 'stream || zoom_conference'
            ),
        );

        $fields[ 'stm_lesson_settings' ][ 'section_lesson_settings' ][ 'fields' ][ 'stream_start_time' ] = array(
            'type' => 'time',
            'label' => esc_html__( 'Conference Start Time', 'masterstudy-lms-learning-management-system-pro' ),
            'value' => '',
            'dependency' => array(
                'key' => 'type',
                'value' => 'stream || zoom_conference'
            ),
        );

        $fields[ 'stm_lesson_settings' ][ 'section_lesson_settings' ][ 'fields' ][ 'timezone' ] = array(
            'type' => 'select',
            'label' => esc_html__( 'Timezone', 'masterstudy-lms-learning-management-system-pro' ),
            'options' => stm_lms_get_timezone_options(),
            'dependency' => array(
                'key' => 'type',
                'value' => 'zoom_conference'
            ),
        );

        $fields[ 'stm_lesson_settings' ][ 'section_lesson_settings' ][ 'fields' ][ 'stm_password' ] = array(
            'type' => 'text',
            'label' => esc_html__( 'Meeting password', 'masterstudy-lms-learning-management-system-pro' ),
            'description' => esc_html__( 'Max 10 characters', 'masterstudy-lms-learning-management-system-pro' ),
            'dependency' => array(
                'key' => 'type',
                'value' => 'zoom_conference'
            ),
        );

        $fields[ 'stm_lesson_settings' ][ 'section_lesson_settings' ][ 'fields' ][ 'join_before_host' ] = array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Allow participants to join anytime', 'masterstudy-lms-learning-management-system-pro' ),
            'dependency' => array(
                'key' => 'type',
                'value' => 'zoom_conference'
            ),
        );

        $fields[ 'stm_lesson_settings' ][ 'section_lesson_settings' ][ 'fields' ][ 'option_host_video' ] = array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Host video', 'masterstudy-lms-learning-management-system-pro' ),
            'dependency' => array(
                'key' => 'type',
                'value' => 'zoom_conference'
            ),
        );

        $fields[ 'stm_lesson_settings' ][ 'section_lesson_settings' ][ 'fields' ][ 'option_participants_video' ] = array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Participants video', 'masterstudy-lms-learning-management-system-pro' ),
            'dependency' => array(
                'key' => 'type',
                'value' => 'zoom_conference'
            ),
        );

        $fields[ 'stm_lesson_settings' ][ 'section_lesson_settings' ][ 'fields' ][ 'option_mute_participants' ] = array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Mute Participants upon entry', 'masterstudy-lms-learning-management-system-pro' ),
            'dependency' => array(
                'key' => 'type',
                'value' => 'zoom_conference'
            ),
        );

        $fields[ 'stm_lesson_settings' ][ 'section_lesson_settings' ][ 'fields' ][ 'option_enforce_login' ] = array(
            'type' => 'checkbox',
            'label' => esc_html__( 'Require authentication to join: Sign in to Zoom', 'masterstudy-lms-learning-management-system-pro' ),
            'description' => esc_html__('Only authenticated users can join meetings. This setting works only for Zoom accounts with Pro license or higher', 'masterstudy-lms-learning-management-system-pro'),
            'dependency' => array(
                'key' => 'type',
                'value' => 'zoom_conference'
            ),
        );

        return $fields;
    }

    public static function lesson_manage_settings()
    { ?>

        <?php STM_LMS_Templates::show_lms_template( 'manage_course/forms/js/date' ); ?>

        <div v-if="fields['type'] === 'zoom_conference'">

            <div class="form-group">
                <label>
                    <h4><?php esc_html_e( 'Stream start date', 'masterstudy-lms-learning-management-system-pro' ); ?></h4>
                    <stm-date v-bind:current_date="fields['stream_start_date']"
                              placeholder=""
                              :key="Math.random()"
                              v-on:date-changed="dateChanged($event, 'stream_start_date');" required></stm-date>

                </label>
            </div>

            <div class="form-group">
                <label>
                    <h4><?php esc_html_e( 'Stream start time', 'masterstudy-lms-learning-management-system-pro' ); ?></h4>
                    <input class="form-control" type="time" v-model="fields['stream_start_time']"/>
                </label>
            </div>

            <div class="form-group">
                <label>
                    <h4><?php esc_html_e( 'Timezone', 'masterstudy-lms-learning-management-system-pro' ); ?></h4>
                    <select class="form-control" v-model="fields['timezone']" required>
                        <?php
                        $timezones = stm_lms_get_timezone_options();
                        foreach( $timezones as $key => $value ):
                            ?>
                            <option value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $value ); ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </div>

            <div class="form-group">
                <div class="stm-lms-admin-checkbox">
                    <label>
                        <h4><?php esc_html_e( 'Allow participants to join anytime', 'masterstudy-lms-learning-management-system-pro' ); ?></h4>
                    </label>
                    <div class="stm-lms-admin-checkbox-wrapper" v-bind:class="{'active' : fields['join_before_host']}">
                        <div class="wpcfto-checkbox-switcher"></div>
                        <input type="checkbox" name="join_before_host" v-model="fields['join_before_host']">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>
                    <h4><?php esc_html_e( 'Meeting password', 'masterstudy-lms-learning-management-system-pro' ); ?></h4>
                </label>
                <div class="stm-lms-admin-checkbox-wrapper">
                    <div class="wpcfto-checkbox-switcher"></div>
                    <input type="text" name="stm_password" maxlength="10" v-model="fields['stm_password']">
                </div>
            </div>

            <div class="form-group">
                <div class="stm-lms-admin-checkbox">
                    <label>
                        <h4><?php esc_html_e( 'Host video', 'masterstudy-lms-learning-management-system-pro' ); ?></h4>
                    </label>
                    <div class="stm-lms-admin-checkbox-wrapper" v-bind:class="{'active' : fields['option_host_video']}">
                        <div class="wpcfto-checkbox-switcher"></div>
                        <input type="checkbox" name="option_host_video" v-model="fields['option_host_video']">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="stm-lms-admin-checkbox">
                    <label>
                        <h4><?php esc_html_e( 'Participants video', 'masterstudy-lms-learning-management-system-pro' ); ?></h4>
                    </label>
                    <div class="stm-lms-admin-checkbox-wrapper"
                         v-bind:class="{'active' : fields['option_participants_video']}">
                        <div class="wpcfto-checkbox-switcher"></div>
                        <input type="checkbox" v-model="fields['option_participants_video']">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="stm-lms-admin-checkbox">
                    <label>
                        <h4><?php esc_html_e( 'Mute Participants upon entry', 'masterstudy-lms-learning-management-system-pro' ); ?></h4>
                    </label>
                    <div class="stm-lms-admin-checkbox-wrapper"
                         v-bind:class="{'active' : fields['option_mute_participants']}">
                        <div class="wpcfto-checkbox-switcher"></div>
                        <input type="checkbox" v-model="fields['option_mute_participants']">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="stm-lms-admin-checkbox">
                    <label>
                        <h4><?php esc_html_e( 'Require authentication to join: Sign in to Zoom', 'masterstudy-lms-learning-management-system-pro' ); ?></h4>
                    </label>
                    <div class="stm-lms-admin-checkbox-wrapper"
                         v-bind:class="{'active' : fields['option_enforce_login']}">
                        <div class="wpcfto-checkbox-switcher"></div>
                        <input type="checkbox" name="option_enforce_login" v-model="fields['option_enforce_login']">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>
                    <h4><?php esc_html_e( 'Meeting password', 'masterstudy-lms-learning-management-system-pro' ); ?></h4>
                </label>
                <div class="stm-lms-admin-checkbox-wrapper">
                    <div class="stm-lms-checkbox-switcher"></div>
                    <input type="text" name="stm_password" maxlength="10" v-model="fields['stm_password']">
                </div>
            </div>

        </div>

    <?php }

    public static function show_item_content( $show, $post_id, $item_id )
    {

        if( self::is_stream( $item_id ) ) return false;

        return $show;
    }

    public static function course_item_content( $content, $post_id, $item_id )

    {
        if( self::is_stream( $item_id ) ) {
            ob_start();
            STM_LMS_Templates::show_lms_template( 'zoom_conference/main', compact( 'post_id', 'item_id' ) );
            $content = ob_get_clean();
        }
        return $content;
    }

    public static function is_stream( $post_id )
    {

        $type = get_post_meta( $post_id, 'type', true );

        return $type === 'zoom_conference';

    }

    public static function get_video_url( $url )
    {

        if( empty( $url ) ) return '';

        if( !empty( $url ) ) {

            $url_parsed = parse_url( $url );

            if( empty( $url_parsed[ 'host' ] ) ) return $url;

            if( $url_parsed[ 'host' ] !== 'www.youtube.com' ) return $url;

            if( empty( $url_parsed[ 'path' ] ) ) return $url;

            if( !empty( $url_parsed[ 'query' ] ) ) {
                return str_replace( array( '/embed/', 'v=' ), array( '' ), $url_parsed[ 'query' ] ) . '&is_youtube';
            }

            return str_replace( array( '/embed/', 'v=' ), array( '' ), $url_parsed[ 'path' ] ) . '&is_youtube';

        }

        return $url;

    }

    public static function time_offset()
    {
        return get_option( 'gmt_offset' ) * 60 * 60;
    }

    public static function stream_start_time( $item_id )
    {
        $start_date = get_post_meta( $item_id, 'stream_start_date', true );
        $start_time = get_post_meta( $item_id, 'stream_start_time', true );
        $timezone = get_post_meta( $item_id, 'timezone', true );

        if( empty( $start_date ) ) return '';

        $stream_start = strtotime( 'today', ( $start_date / 1000 ) );

        if( !empty( $start_time ) ) {
            $time = explode( ':', $start_time );
            if( is_array( $time ) and count( $time ) === 2 ) {
                $stream_start = strtotime( "+{$time[0]} hours +{$time[1]} minutes", $stream_start );

                if( !empty( $timezone ) ) {
                    $date = new DateTime($stream_start, new DateTimeZone( $timezone ));
                    $stream_start = $date->format( 'U' );
                }
            }
        }

        return $stream_start;

    }

    public static function is_stream_started( $item_id )
    {

        $stream_start = self::stream_start_time( $item_id );

        /*NO TIME - STREAM STARTED*/
        if( empty( $stream_start ) ) return true;

        if( $stream_start > time() ) return false;

        return true;

    }

    public static function stream_end_time( $item_id )
    {
        $end_date = get_post_meta( $item_id, 'stream_end_date', true );
        $end_time = get_post_meta( $item_id, 'stream_end_time', true );
        $timezone = get_post_meta( $item_id, 'timezone', true );
        if( empty( $end_date ) ) return '';

        $stream_end = strtotime( 'today', $end_date / 1000 );

        if( !empty( $end_time ) ) {
            $time = explode( ':', $end_time );
            if( is_array( $time ) and count( $time ) === 2 ) {
                $stream_end = strtotime( "+{$time[0]} hours +{$time[1]} minutes", $stream_end );
                if( !empty( $timezone ) ) {
                    $date = new DateTime();
                    $date->setTimezone( $timezone );
                    $date = $date->setTimestamp( $stream_end );
                    $stream_end = $date->format( 'U' );
                }
            }
        }

        return $stream_end;

    }

    public static function is_stream_ended( $item_id )
    {
        $timezone = get_post_meta( $item_id, 'timezone', true );

        $time_now = time();

        $stream_end = self::stream_end_time( $item_id );

        if( empty( $stream_end ) ) return true;

        if( $stream_end > $time_now ) return false;

        return true;

    }


    public static function navigation_complete_atts( $atts, $item_id )
    {

        if( self::is_stream( $item_id ) and !self::is_stream_ended( $item_id ) ) {
            $end_time = self::stream_end_time( $item_id );

            $end_time = ( $end_time - time() );

            return $atts . " data-timer='" . $end_time . "' data-disabled='true'";
        }

        return $atts;
    }

    public static function update_meeting( $post_id, $post_data )
    {
        if( $post_data[ 'type' ] === 'zoom_conference' ) {
            $is_edit = get_post_meta( $post_id, 'meeting_created', true );
            $user_id = get_current_user_id();
            $user_host = get_the_author_meta( 'stm_lms_zoom_host', $user_id );
            if( empty( $user_host ) ) return '';
            $agenda = $post_data[ 'lesson_excerpt' ];
            $timezone = !empty( $post_data[ 'timezone' ] ) ? $post_data[ 'timezone' ] : 'UTC';
            $duration = !empty( $post_data[ 'duration' ] ) ? $post_data[ 'duration' ] : '';
            $password = !empty( $post_data[ 'stm_password' ] ) ? $post_data[ 'stm_password' ] : '';
            $stream_start_date = !empty( $post_data[ 'stream_start_date' ] ) ? $post_data[ 'stream_start_date' ] : '';
            $stream_start_time = !empty( $post_data[ 'stream_start_time' ] ) ? $post_data[ 'stream_start_time' ] : '';
            $join_before_host = isset( $post_data[ 'join_before_host' ] ) ? $post_data[ 'join_before_host' ] : '';
            $option_host_video = isset( $post_data[ 'option_host_video' ] ) ? $post_data[ 'option_host_video' ] : '';
            $option_participants_video = isset( $post_data[ 'option_participants_video' ] ) ? $post_data[ 'option_participants_video' ] : '';
            $option_mute_participants = isset( $post_data[ 'option_mute_participants' ] ) ? $post_data[ 'option_mute_participants' ] : '';
            $option_enforce_login = isset( $post_data[ 'option_enforce_login' ] ) ? $post_data[ 'option_enforce_login' ] : '';
            $_POST[ 'post_title' ] = get_the_title( $post_id );
            $_POST[ 'stm_host' ] = $user_host;
            $_POST[ 'stm_agenda' ] = $agenda;
            $_POST[ 'stm_date' ] = sanitize_text_field( $stream_start_date );
            $_POST[ 'stm_time' ] = sanitize_text_field( $stream_start_time );
            $_POST[ 'stm_timezone' ] = sanitize_text_field( $timezone );
            $_POST[ 'stm_duration' ] = sanitize_text_field( $duration );
            $_POST[ 'stm_join_before_host' ] = sanitize_text_field( $join_before_host );
            $_POST[ 'stm_host_join_start' ] = sanitize_text_field( $option_host_video );
            $_POST[ 'stm_start_after_participants' ] = sanitize_text_field( $option_participants_video );
            $_POST[ 'stm_mute_participants' ] = sanitize_text_field( $option_mute_participants );
            $_POST[ 'stm_enforce_login' ] = sanitize_text_field( $option_enforce_login );
            $_POST[ 'post_type' ] = 'stm-zoom';
            if( !$is_edit ) {
                $post_data_args = array(
                    'post_title' => get_the_title( $post_id ),
                    'post_status' => 'publish',
                    'post_author' => intval( $user_id ),
                    'post_type' => 'stm-zoom',
                );

                $new_meeting = wp_insert_post( $post_data_args );
                update_post_meta( $post_id, 'meeting_created', $new_meeting );
            }
            else {
                $post_data_args = array(
                    'post_title' => get_the_title( $post_id ),
                    'ID' => intval( $is_edit ),
                    'post_status' => 'publish',
                    'post_author' => intval( $user_id ),
                    'post_type' => 'stm-zoom',
                );

                $new_meeting = wp_insert_post( $post_data_args );
            }

            if(!empty($new_meeting)){
                update_post_meta($new_meeting, 'stm_host', $user_host);
                update_post_meta($new_meeting, 'stm_agenda', $agenda);
                update_post_meta($new_meeting, 'stm_date', $stream_start_date);
                update_post_meta($new_meeting, 'stm_time', $stream_start_time);
                update_post_meta($new_meeting, 'stm_timezone', $timezone);
                update_post_meta($new_meeting, 'stm_duration', $duration);
                update_post_meta($new_meeting, 'stm_password', $password);
                update_post_meta($new_meeting, 'stm_join_before_host', $join_before_host);
                update_post_meta($new_meeting, 'stm_host_join_start', $option_host_video);
                update_post_meta($new_meeting, 'stm_start_after_participants', $option_participants_video);
                update_post_meta($new_meeting, 'stm_mute_participants', $option_mute_participants);
                update_post_meta($new_meeting, 'stm_enforce_login', $option_enforce_login);
            }

        }
    }

    public function update_admin_meeting( $post_id, $post )
    {

        $post_type = !empty( $_POST[ 'post_type' ] ) ? sanitize_text_field( $_POST[ 'post_type' ] ) : '';

        if( empty( $post_type ) ) {
            $post_type = get_post_type( $post_id );
        }

        if( $post_type === 'stm-lessons' ) {
            $lesson_type = !empty( $_POST[ 'type' ] ) ? $_POST[ 'type' ] : '';
            if( $lesson_type === 'zoom_conference' ) {
                remove_action( 'save_post', array( $this, 'update_admin_meeting' ), 10 );
                $is_edit = get_post_meta( $post_id, 'meeting_created', true );
                $timezone = !empty( $_POST[ 'timezone' ] ) ? $_POST[ 'timezone' ] : 'UTC';
                $duration = !empty( $_POST[ 'duration' ] ) ? $_POST[ 'duration' ] : '';
                $stream_start_date = !empty( $_POST[ 'stream_start_date' ] ) ? $_POST[ 'stream_start_date' ] : '';
                $stream_start_time = !empty( $_POST[ 'stream_start_time' ] ) ? $_POST[ 'stream_start_time' ] : '';
                $join_before_host = isset( $_POST[ 'join_before_host' ] ) ? $_POST[ 'join_before_host' ] : '';
                $option_host_video = isset( $_POST[ 'option_host_video' ] ) ? $_POST[ 'option_host_video' ] : '';
                $option_participants_video = isset( $_POST[ 'option_participants_video' ] ) ? $_POST[ 'option_participants_video' ] : '';
                $option_mute_participants = isset( $_POST[ 'option_mute_participants' ] ) ? $_POST[ 'option_mute_participants' ] : '';
                $option_enforce_login = isset( $_POST[ 'option_enforce_login' ] ) ? $_POST[ 'option_enforce_login' ] : '';
                $agenda = !empty( $_POST[ 'lesson_excerpt' ] ) ? $_POST[ 'lesson_excerpt' ] : '';
                $user_id = get_current_user_id();
                $user_host = get_the_author_meta( 'stm_lms_zoom_host', $user_id );

                if( empty( $user_host ) ) return '';

                $_POST[ 'stm_host' ] = $user_host;
                $_POST[ 'stm_agenda' ] = $agenda;
                $_POST[ 'stm_date' ] = $stream_start_date;
                $_POST[ 'stm_time' ] = $stream_start_time;
                $_POST[ 'stm_timezone' ] = $timezone;
                $_POST[ 'stm_duration' ] = $duration;
                $_POST[ 'stm_join_before_host' ] = $join_before_host;
                $_POST[ 'stm_host_join_start' ] = $option_host_video;
                $_POST[ 'stm_start_after_participants' ] = $option_participants_video;
                $_POST[ 'stm_mute_participants' ] = $option_mute_participants;
                $_POST[ 'stm_enforce_login' ] = $option_enforce_login;

                if( empty( $is_edit ) ) {
                    $_POST[ 'post_type' ] = 'stm-zoom';
                    $post_data = array(
                        'post_title' => wp_strip_all_tags( $_POST[ 'post_title' ] ),
                        'post_status' => 'publish',
                        'post_author' => intval( $user_id ),
                        'post_type' => 'stm-zoom',
                    );

                    $new_meeting = wp_insert_post( $post_data );
                    update_post_meta( $post_id, 'meeting_created', $new_meeting );
                }
                else {
                    $_POST[ 'post_type' ] = 'stm-zoom';
                    $post_data = array(
                        'post_title' => wp_strip_all_tags( $_POST[ 'post_title' ] ),
                        'ID' => intval( $is_edit ),
                        'post_status' => 'publish',
                        'post_author' => intval( $user_id ),
                        'post_type' => 'stm-zoom',
                    );

                    $new_meeting = wp_insert_post( $post_data );
                }
            }
        }

        remove_action( 'save_post', array( $this, 'update_admin_meeting' ), 10 );

    }

    public static function create_zoom_shortcode( $item_id, $title = '' )
    {
        $meeting_id = '';
        $meeting = get_post_meta( $item_id, 'meeting_data', true );
        if( !empty( $meeting ) ) {
            $meeting_id = $meeting->id;
        }
        return '[zoom_api_link meeting_id="' . $meeting_id . '" class="zoom-meeting-window" id="zoom-meeting-window" title="' . $title . '"]';
    }

    public static function get_join_url( $item_id )
    {
        $meeting_id = '';
        $meeting = get_post_meta( $item_id, 'meeting_data', true );
        if( !empty( $meeting ) ) {
            $meeting_id = $meeting->id;
        }
        return 'https://zoom.us/j/' . $meeting_id;
    }

    function stm_lms_settings_page( $setups )
    {

        $setups[] = array(
            'page' => array(
                'parent_slug' => 'admin.php?page=stm-lms-settings',
                'page_title' => 'Zoom conference',
                'menu_title' => 'Import Classrooms',
                'menu_slug' => 'stm_lms_zoom_conference',
            ),
            'fields' => $this->stm_lms_settings(),
            'option_name' => 'stm_lms_zoom_conference_settings'
        );

        return $setups;

    }

    function stm_lms_settings()
    {
        return apply_filters( 'stm_lms_zoom_conference_settings', array() );
    }

}

function stm_lms_zoom_conference()
{
    if( class_exists( 'Zoom_Video_Conferencing_Api' ) ) {
        return Zoom_Video_Conferencing_Api::instance();
    }
}