<?php
new STM_LMS_Courses;

class STM_LMS_Courses
{

    public function __construct()
    {
        add_filter('stm_lms_archive_filter_args', array($this, 'filter'));

        add_action('wp_trash_post', array($this, 'trash_course'));

    }

    function trash_course($post_id)
    {

        if (current_user_can('manage_options')) {
            $post_type = get_post_type($post_id);
            if ($post_type == 'stm-courses') {
                stm_lms_get_delete_courses($post_id);
            }
        }
    }

    static function filter_enabled()
    {
        return STM_LMS_Options::get_option('enable_courses_filter', '');
    }

    function filter($args)
    {

        $this->filter_categories($args);
        $this->filter_statuses($args);
        $this->filter_level($args);
        $this->filter_rating($args);
        $this->filter_instructor($args);
        $this->filter_price($args);
        return $args;
    }

    function filter_categories(&$args)
    {

        if (!empty($_GET['category'])) {

            $categories = array();

            foreach ($_GET['category'] as $category) {
                $categories[] = intval($category);
            }

            if (empty($args['tax_query'])) {
                $args['tax_query'] = array();
            }

            $args['tax_query']['category'] = array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'stm_lms_course_taxonomy',
                    'field' => 'term_id',
                    'terms' => $categories,
                ),
            );

            if (!empty($_GET['subcategory'])) {

                $subcategories = array();

                foreach ($_GET['subcategory'] as $subcategory) {
                    $subcategories[] = intval($subcategory);
                }

                if (empty($args['tax_query'])) {
                    $args['tax_query'] = array();
                }
                if (empty($args['tax_query']['category'])) {
                    $args['tax_query']['category'] = array();
                }

                $args['tax_query']['category'][] = array(
                    'taxonomy' => 'stm_lms_course_taxonomy',
                    'field' => 'term_id',
                    'terms' => $subcategories,
                );

            }

        }

    }

    function filter_statuses(&$args)
    {
        $status = !empty($_GET['status']) ? $_GET['status'] : array();

        if (!empty($args['featured']) && $args['featured'] && !STM_LMS_Options::get_option('disable_featured_courses', false)) {

            $per_row = STM_LMS_Options::get_option('courses_per_row', 3);
            $number_of_featured = STM_LMS_Options::get_option('number_featured_in_archive', $per_row);
            $args['posts_per_page'] = $number_of_featured;
            $args['orderby'] = 'rand';
            if (empty($status)) {
                $status = array('featured');
            } elseif (!empty($status) && is_array($status) && !in_array('featured', $status)) {
                $status[] = 'featured';
            }

        }
        if (!empty($status) && is_array($status)) {

            if (empty($args['meta_query'])) {
                $args['meta_query'] = array(
                    'relation' => 'AND',
                    'status' => array(
                        'relation' => 'OR'
                    )
                );
            }

            if (in_array('featured', $status)) {
                $args['meta_query']['status'][] = array(
                    'key' => 'featured',
                    'value' => 'on',
                    'compare' => '=',
                );
            }

            if (in_array('hot', $status)) {
                $args['meta_query']['status'][] = array(
                    'key' => 'status',
                    'value' => 'hot',
                    'compare' => '=',
                );
            }

            if (in_array('new', $status)) {
                $args['meta_query']['status'][] = array(
                    'key' => 'status',
                    'value' => 'new',
                    'compare' => '=',
                );
            }

            if (in_array('special', $status)) {
                $args['meta_query']['status'][] = array(
                    'key' => 'status',
                    'value' => 'special',
                    'compare' => '=',
                );
            }

        }

    }

    function filter_level(&$args)
    {

        if (!empty($_GET['levels']) && is_array($_GET['levels'])) {

            if (empty($args['meta_query'])) {
                $args['meta_query'] = array(
                    'relation' => 'AND',
                    'level' => array(
                        'relation' => 'OR'
                    )
                );
            }

            if (!empty($_GET['levels'])) {
                foreach ($_GET['levels'] as $level) {
                    $args['meta_query']['level'][] = array(
                        'key' => 'level',
                        'value' => sanitize_text_field($level),
                        'compare' => '=',
                    );
                }
            }

        }

    }

    function filter_rating(&$args)
    {
        if (!empty($_GET['rating'])) {

            if (empty($args['meta_query'])) {
                $args['meta_query'] = array(
                    'relation' => 'AND'
                );
            }

            $args['meta_query'][] = array(
                'key' => 'course_mark_average',
                'value' => floatval($_GET['rating']),
                'compare' => '>=',
            );

        }
    }

    function filter_instructor(&$args)
    {
        if (!empty($_GET['instructor'])) {

            $authors = array();

            foreach ($_GET['instructor'] as $instructor) {
                $authors[] = intval($instructor);
            }

            $args['author__in'] = $authors;

        }
    }

    function filter_price(&$args)
    {
        if (!empty($_GET['price'])) {

            if (empty($args['meta_query'])) {
                $args['meta_query'] = array(
                    'relation' => 'OR'
                );
            }

            if (in_array('free_courses', $_GET['price']) && in_array('paid_courses', $_GET['price'])) {
                $args['meta_query']['prices'][] = array(
                    array(
                        'relation' => 'AND',
                        array(
                            'key' => 'price',
                            'compare' => 'EXISTS',
                        ),
                        array(
                            'relation' => 'OR',
                            array(
                                'key' => 'not_single_sale',
                                'value' => 'on',
                                'compare' => '!='
                            ),
                            array(
                                'key' => 'not_single_sale',
                                'compare' => 'NOT EXISTS',
                            ),
                        )
                    )
                );
            } else {
                if (in_array('free_courses', $_GET['price'])) {
                    $args['meta_query']['free_price'][] = array(
                        array(
                            'relation' => 'AND',
                            array(
                                'relation' => 'OR',
                                array(
                                    'key' => 'price',
                                    'value' => '',
                                    'compare' => '=',
                                ),
                                array(
                                    'key' => 'price',
                                    'compare' => 'NOT EXISTS',
                                ),
                            ),
                            array(
                                'relation' => 'OR',
                                array(
                                    'key' => 'not_single_sale',
                                    'value' => 'on',
                                    'compare' => '!='
                                ),
                                array(
                                    'key' => 'not_single_sale',
                                    'compare' => 'NOT EXISTS',
                                ),
                            )
                        ),
                    );
                }

                if (in_array('paid_courses', $_GET['price'])) {
                    $args['meta_query']['paid_price'][] = array(
                        array(
                            'relation' => 'AND',
                            array(
                                'key' => 'price',
                                'value' => 0,
                                'compare' => '>',
                            ),
                            array(
                                'relation' => 'OR',
                                array(
                                    'key' => 'not_single_sale',
                                    'value' => 'on',
                                    'compare' => '!='
                                ),
                                array(
                                    'key' => 'not_single_sale',
                                    'compare' => 'NOT EXISTS',
                                ),
                            )
                        ),
                    );
                }
            }

            if (in_array('subscription', $_GET['price'])) {
                $args['meta_query']['subscription'][] = array(
                    array(
                        'key' => 'not_single_sale',
                        'value' => 'on',
                        'compare' => '=',
                    ),
                );
            }

        }
    }
}