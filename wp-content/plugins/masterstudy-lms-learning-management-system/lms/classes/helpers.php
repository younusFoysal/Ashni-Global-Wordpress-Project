<?php
STM_LMS_Helpers::init();

class STM_LMS_Helpers {

    public static function init()
    {
        add_action('wp_ajax_stm_lms_load_modal', 'STM_LMS_Helpers::load_modal');
        add_action('wp_ajax_nopriv_stm_lms_load_modal', 'STM_LMS_Helpers::load_modal');

        add_action('wp_ajax_stm_lms_load_content', 'STM_LMS_Helpers::load_content');
        add_action('wp_ajax_nopriv_stm_lms_load_content', 'STM_LMS_Helpers::load_content');

    }

    public static function is_pro()
    {
        return defined('STM_LMS_PRO_PATH');
    }

    public static function load_modal()
    {

        check_ajax_referer('load_modal', 'nonce');

        if (empty($_GET['modal'])) die;
        $r = array();

        $modal = 'modals/' . sanitize_text_field($_GET['modal']);
        $params = (!empty($_GET['params'])) ? json_decode(stripslashes_deep($_GET['params']), true) : array();
        $r['params'] = $params;
        $r['modal'] = STM_LMS_Templates::load_lms_template($modal, $params);

        wp_send_json($r);

    }

    public static function sanitize_fields($value, $type = '')
    {
        switch ($type) {
            case 'email' :
                $r = (is_email($value)) ? sanitize_email($value) : false;
                break;
            default :
                $r = sanitize_text_field($value);
        }

        return $r;
    }

    public static function parse_meta_field($post_id)
    {

        $meta = get_post_meta($post_id);
        $meta_array = STM_LMS_Helpers::simplify_meta_array($meta);

        return $meta_array;
    }

    public static function simplify_meta_array($meta, $key = 0)
    {
        $meta_array = array();

        if (!empty($meta)) {
            foreach ($meta as $meta_name => $value) {
                if (!empty($value) and !empty($value[$key])) {
                    $meta_array[$meta_name] = is_serialized($value[$key]) ? unserialize($value[$key]) : $value[$key];
                }
            }
        }

        return $meta_array;
    }

    public static function simplify_db_array($db_array)
    {
        $arr = array();
        if (empty($db_array)) return $arr;
        foreach ($db_array as $item) {
            if (!empty($item) and is_array($item)) {
                foreach ($item as $key => $value) {
                    $arr[$key] = $value;
                }
            }
        }
        return $arr;
    }

    public static function in_array_r($needle, $haystack, $strict = false)
    {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && STM_LMS_Helpers::in_array_r($needle, $item, $strict))) {
                return true;
            }
        }

        return false;
    }

    public static function get_current_url()
    {
        return (is_ssl() ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }

    public static function set_value_as_key($old_array, $key)
    {
        $new_array = array();

        if (empty($old_array)) return $new_array;

        foreach ($old_array as $old_key => $value) {
            $new_key = (!empty($value[$key])) ? $value[$key] : $key;
            $new_array[$new_key] = $value;
        }

        return $new_array;
    }

    public static function only_array_numbers($old_array)
    {
        $new_array = array();
        if (empty($old_array)) return $new_array;

        foreach ($old_array as $value) {
            if (is_numeric($value)) $new_array[] = stm_lms_get_wpml_binded_id($value);
        }

        return $new_array;
    }

    public static function transform_to_wpml_curriculum(&$curriculum) {
        foreach($curriculum as &$curriculum_item) {
            $curriculum_item = stm_lms_get_wpml_binded_id($curriculum_item);
        }
    }

    public static function get_currency()
    {
        return STM_LMS_Options::get_option('currency_symbol', '$');
    }

    public static function display_price($price)
    {
        if (!isset($price)) return '';
        $symbol = STM_LMS_Options::get_option('currency_symbol', '$');
        $position = STM_LMS_Options::get_option('currency_position', 'left');
        $currency_thousands = STM_LMS_Options::get_option('currency_thousands', ',');
        $currency_decimals = STM_LMS_Options::get_option('currency_decimals', '.');
        $decimals_num = STM_LMS_Options::get_option('decimals_num', 2);

        $price = floatval($price);


        if (strpos($price, '.')) {
            $price = number_format($price, $decimals_num, $currency_decimals, $currency_thousands);
        } else {
            $price = number_format($price, 0, '', $currency_thousands);
        }

        if ($position == 'left') {
            return $symbol . $price;
        } else {
            return $price . $symbol;
        }
    }

    public static function sort_query($sort)
    {
        switch ($sort) {
            case 'date_low' :
                $sorting = array(
                    'orderby' => 'date',
                    'order' => 'ASC',
                );
                break;
            case 'price_high' :
                $sorting = array(
                    'meta_query' => array(
                        'price' => array(
                            'relation' => 'OR',
                            array(
                                'key' => 'price',
                                'value' => 0,
                                'compare' => '>'
                            ),
                        )
                    ),
                    'meta_key' => 'price',
                    'orderby' => 'meta_value_num',
                    'order' => 'DESC'
                );
                break;
            case 'price_low' :
                $sorting = array(
                    'meta_query' => array(
                        'price' => array(
                            'relation' => 'OR',
                            array(
                                'key' => 'price',
                                'value' => 0,
                                'compare' => '>'
                            ),
                        )
                    ),
                    'meta_key' => 'price',
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC'
                );
                break;
            case 'rating' :
                $sorting = array(
                    'meta_key' => 'course_mark_average',
                    'orderby' => 'meta_value_num',
                    'order' => 'DESC',
                );
                break;
            case 'popular' :
                $sorting = array(
                    'meta_key' => 'views',
                    'orderby' => 'meta_value_num',
                    'order' => 'DESC',
                );
                break;
            default :
                $sorting = array();
        }

        return apply_filters('stm_lms_sorting_args', $sorting, $sort);
    }

    public static function load_content()
    {

        check_ajax_referer('load_content', 'nonce');

        if (empty($_GET['template'])) die;

        $tpl = sanitize_text_field($_GET['template']);

        $args = (!empty($_GET['args'])) ? json_decode(stripslashes(sanitize_text_field($_GET['args'])), true) : array();

        if (!empty($_GET['is_lms_filter'])) {
            if (!empty($args['meta_query'])) unset($args['meta_query']);
            if (!empty($args['tax_query'])) unset($args['tax_query']);
        }

        $pp = (!empty($_GET['per_page'])) ? intval($_GET['per_page']) : get_option('posts_per_page');

        $args['featured'] = (!empty($_GET['featured']) && $_GET['featured'] == "true") ? true : false;

        $args['posts_per_page'] = (!empty($args['posts_per_page'])) ? $args['posts_per_page'] : $pp;

        $args['offset'] = (!empty($_GET['offset'])) ? intval($_GET['offset']) : 0;

        $page = $args['offset'];

        $args['offset'] = $args['offset'] * $args['posts_per_page'];

        $args['isAjax'] = true;

        $sort = '';
        if(!empty($_GET['sort'])) $sort = sanitize_text_field($_GET['sort']);
        if(!empty($args['sort'])) $sort = sanitize_text_field($args['sort']);

        if (!empty($sort)) {
            $args = array_merge($args, STM_LMS_Helpers::sort_query($sort));
        }

        $link = STM_LMS_Course::courses_page_url();

        if (!empty($args['term'])) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'stm_lms_course_taxonomy',
                    'field' => 'term_id',
                    'terms' => intval($args['term']),
                ),
            );

            $link = get_term_link(intval($args['term']), 'stm_lms_course_taxonomy');
        }

        $args['post_status'] = 'publish';

        $args = apply_filters('stm_lms_archive_filter_args', $args);

        $content = STM_LMS_Templates::load_lms_template($tpl, array('args' => $args));
        $content = apply_filters('stm_lms_archive_filter_content', $content, $args);
        $data = array('content' => $content, 'page' => $page + 1, 'link' => $link, 'args' => $args);
        $default_args = array(
            'post_type' => 'stm-courses',
            'posts_per_page' => STM_LMS_Options::get_option('courses_per_page', get_option('posts_per_page')),
        );
        $args = wp_parse_args($args, $default_args);

        $q = new WP_Query($args);
        $data['total'] = $q->found_posts;

        $data['pages'] = ceil($data['total'] / $args['posts_per_page']);

        wp_send_json($data);

    }

    static function set_html_content_type()
    {
        return 'text/html';
    }

    public static function send_email($to, $subject, $message, $filter = 'stm_lms_send_email_filter', $data = array())
    {

        $to = (empty($to) or $to == 'admin') ? get_option('admin_email') : $to;

        add_filter('wp_mail_content_type', 'STM_LMS_Helpers::set_html_content_type');

        $data = apply_filters('stm_lms_filter_email_data', array(
            'subject' => $subject,
            'message' => $message,
            'vars' => $data,
            'filter_name' => $filter,
            'enabled' => true
        ));

        if(!isset($data['enabled']) || (isset($data['enabled']) && $data['enabled'])) {
            wp_mail($to, $data['subject'], $data['message']);
        }

        remove_filter('wp_mail_content_type', 'STM_LMS_Helpers::set_html_content_type');
    }

    public static function g_recaptcha_enabled()
    {
        $recaptcha = STM_LMS_Helpers::g_recaptcha_keys();
        return (!empty($recaptcha['public']) and !empty($recaptcha['private']));
    }

    public static function g_recaptcha_keys()
    {
        $r = array();
        $r['public'] = STM_LMS_Options::get_option('recaptcha_site_key', '');
        $r['private'] = STM_LMS_Options::get_option('recaptcha_private_key', '');

        return $r;
    }

    public static function check_recaptcha($recaptcha_name = 'recaptcha')
    {

        $r = true;

        $recaptcha_enabled = STM_LMS_Helpers::g_recaptcha_enabled();

        if ($recaptcha_enabled) {

            $request_body = file_get_contents('php://input');
            $data = json_decode($request_body, true);
            $recaptcha = STM_LMS_Helpers::g_recaptcha_keys();


            $secret = $recaptcha['private'];
            $token = $data[$recaptcha_name];


            // Verifying the user's response (https://developers.google.com/recaptcha/docs/verify)
            $verifyURL = 'https://www.google.com/recaptcha/api/siteverify';

            // Collect and build POST data
            $post_data = http_build_query(
                array(
                    'secret' => $secret,
                    'response' => $token,
                    'remoteip' => (isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR'])
                )
            );

            // Send data on the best possible way
            if (function_exists('curl_init') && function_exists('curl_setopt') && function_exists('curl_exec')) {
                // Use cURL to get data 10x faster than using file_get_contents or other methods
                $ch = curl_init($verifyURL);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-type: application/x-www-form-urlencoded'));
                $response = curl_exec($ch);
                curl_close($ch);
            } else {
                // If server not have active cURL module, use file_get_contents
                $opts = array('http' =>
                    array(
                        'method' => 'POST',
                        'header' => 'Content-type: application/x-www-form-urlencoded',
                        'content' => $post_data
                    )
                );
                $context = stream_context_create($opts);
                $response = file_get_contents($verifyURL, false, $context);
            }

            // Verify all reponses and avoid PHP errors
            if ($response) {
                $result = json_decode($response);
                if (!$result->success) {
                    $r = false;
                }
            }


        }
        return $r;
    }

	public static function get_client_ip() {
		$ip = getenv( 'HTTP_CLIENT_IP' ) ?:
			getenv( 'HTTP_X_FORWARDED_FOR' ) ?:
				getenv( 'HTTP_X_FORWARDED' ) ?:
					getenv( 'HTTP_FORWARDED_FOR' ) ?:
						getenv( 'HTTP_FORWARDED' ) ?:
							getenv( 'REMOTE_ADDR' );

		$ip = ( $ip == '::1' ) ? '127.0.0.1' : $ip;

		return $ip;
	}

	public static function remove_non_numbers( $string ) {
		return preg_replace( '/[^0-9]/', '', $string );
	}

	public static function current_screen() {
		$current_screen = get_queried_object();

		return ( ! empty( $current_screen ) ) ? $current_screen->ID : '';
	}

	public static function get_posts( $post_type, $as_array = false ) {
		$args = array( 'post_type' => $post_type, 'posts_per_page' => - 1 );
		$data = array();
		if ( $posts = get_posts( $args ) ) {
			foreach ( $posts as $post ) {
				$data[ $post->ID ] = $post->post_title;
			};
		}

		if ( $as_array ) {
			$array_data = array();
			foreach ( $data as $post_id => $post_name ) {
				$array_data[] = array(
					'id' => $post_id,
					'name' => $post_name
				);
			}

			$data = $array_data;
		}

		return $data;
	}

	static function safe_output( $content ) {
		echo apply_filters( 'stm_lms_safe_output_content', $content );
	}

	static function print_svg( $path ) {
		ob_start();
		$svg_file = file_get_contents( STM_LMS_PATH . '/' . $path );
		self::safe_output( $svg_file );
		echo ob_get_clean();
	}

	public static function get_course_levels() {

		$levels      = STM_LMS_Options::get_option( 'course_levels_config' );
		$user_levels = array();
		if ( ! empty( $levels ) ) {
			foreach ( $levels as $level ) {
				if ( empty( $level['id'] ) || empty( $level['label'] ) ) {
					continue;
				}

				$user_levels[$level['id']] = $level['label'];


			}
		}

		$default_levels = array(
			'beginner' => esc_html__( 'Beginner', 'masterstudy-lms-learning-management-system' ),
			'intermediate' => esc_html__( 'Intermediate', 'masterstudy-lms-learning-management-system' ),
			'advanced' => esc_html__( 'Advanced', 'masterstudy-lms-learning-management-system' ),
		);

		if(empty($user_levels)) $user_levels = $default_levels;


		return $user_levels;
	}

	public static function is_stripe_enabled() {
		$payment = STM_LMS_Options::get_option('payment_methods');

		if (empty($payment['stripe'])
		    or empty($payment['stripe']['enabled'])
		    or empty($payment['stripe']['fields'])
		    or empty($payment['stripe']['fields']['secret_key'])
		) return false;

		return true;

	}

	static function get_error_translate($field) {
        $translates = array(
            'Title' => esc_html__('Title', 'masterstudy-lms-learning-management-system'),
            'Category' => esc_html__('Category', 'masterstudy-lms-learning-management-system'),
            'Image' => esc_html__('Image', 'masterstudy-lms-learning-management-system'),
            'Content' => esc_html__('Content', 'masterstudy-lms-learning-management-system'),
            'Curriculum' => esc_html__('Curriculum', 'masterstudy-lms-learning-management-system'),
        );
        return (!empty($translates[$field])) ? $translates[$field] : $field;
    }
}