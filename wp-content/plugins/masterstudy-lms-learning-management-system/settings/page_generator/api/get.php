<?php

function stm_lms_generate_pages_list()
{
    return array(
        'user_url' => esc_html__('User Account', 'masterstudy-lms-learning-management-system'),
        'user_url_profile' => esc_html__('User Public Account', 'masterstudy-lms-learning-management-system'),
        'wishlist_url' => esc_html__('Wishlist', 'masterstudy-lms-learning-management-system'),
        'checkout_url' => esc_html__('Checkout', 'masterstudy-lms-learning-management-system'),
    );
}

add_filter('display_post_states', function ($states, $post) {

    $pages = array(
        'user_url' => esc_html__('MasterStudy Private Account', 'masterstudy-lms-learning-management-system'),
        'user_url_profile' => esc_html__('MasterStudy Public Account', 'masterstudy-lms-learning-management-system'),
        'wishlist_url' => esc_html__('MasterStudy Wishlist', 'masterstudy-lms-learning-management-system'),
        'checkout_url' => esc_html__('MasterStudy Checkout', 'masterstudy-lms-learning-management-system'),
        'courses_page' => esc_html__('MasterStudy Courses', 'masterstudy-lms-learning-management-system')
    );

    foreach ($pages as $page_option => $page_state) {
        $page_id = STM_LMS_Options::get_option($page_option);

        if (!empty($page_id) && $page_id === $post->ID) $states[] = $page_state;

    }

    return $states;
}, 10, 2);

function stm_lms_get_generated_pages($pages)
{

    $disabled_pages = array(
        'checkout_url' => 'wocommerce_checkout'
    );

    $generated_pages = array();
    foreach ($pages as $page_slug => $page_name) {
        $page_id = STM_LMS_Options::get_option($page_slug);

        if (!empty($page_id) && get_post_status($page_id) === 'publish') {
            $generated_pages[$page_slug] = array(
                'id' => $page_id,
                'name' => $page_name
            );
        }
    }

    foreach ($disabled_pages as $page_slug => $option) {
        $option_enabled = STM_LMS_Options::get_option($option);

        if ($option_enabled) $generated_pages[$page_slug] = 'unavailable';
    }


    return $generated_pages;
}

function stm_lms_has_generated_pages($pages)
{
    $generated_pages = stm_lms_get_generated_pages($pages);

    return count($generated_pages) >= count($pages);
}

add_action('wp_ajax_stm_generate_pages', function () {

    if (!current_user_can('manage_options')) die;

    $pages = json_decode(file_get_contents('php://input'), true);

	stm_lms_generate_pages($pages);

	wp_send_json('OK');


});

add_action('stm_masterstudy_importer_done', function () {
    stm_lms_generate_pages(stm_lms_generate_pages_list());
});

function stm_lms_generate_pages($pages)
{
    $page_opt = array();

    foreach ($pages as $page_option => $page_title) {

        $page_id = STM_LMS_Options::get_option($page_option);

        if (!empty($page_id) && get_post_status($page_id) === 'publish') continue;

        $page_id = wp_insert_post([
            'post_title' => $page_title,
            'post_status' => 'publish',
            'post_type' => 'page',
        ]);

        update_post_meta($page_id, 'title', 'hide');
        update_post_meta($page_id, 'breadcrumbs', 'hide');
        update_post_meta($page_id, 'lms_page', $page_option);

        /*Replace in options*/
        $page_opt[$page_option] = $page_id;

    }

    if (!empty($page_opt)) {

        $options = get_option('stm_lms_settings', array());

        foreach ($page_opt as $option => $page_id) {

            $options[$option] = $page_id;

        }

        update_option('stm_lms_settings', $options);

        do_action('stm_lms_pages_generated');
    }
}

function stm_lms_page_generator_link()
{

    if (!stm_lms_has_generated_pages(stm_lms_generate_pages_list())) : ?>

        <div class="notice notice-lms notice-lms-go-to-pages">

            <div class="notice-lms-go-to-pages-icon"></div>

            <div class="notice-lms-go-to-pages-content">

                <p>
                    <strong>
                        <?php esc_html_e('The LMS pages are not specified!', 'masterstudy-lms-learning-management-system'); ?>
                    </strong>
                </p>

                <p>
                    <?php esc_html_e('Please create pages and indicate them in the LMS settings or use the page generator.', 'masterstudy-lms-learning-management-system'); ?>
                </p>

            </div>

            <div class="notice-lms-go-to-pages-button">

                <a href="<?php echo esc_url(admin_url('admin.php?page=stm-lms-settings#section_routes')) ?>"
                   class="button-primary">
                    <?php esc_html_e('Open Settings', 'masterstudy-lms-learning-management-system'); ?>
                </a>

            </div>

        </div>

    <?php endif;


}

add_action('admin_notices', 'stm_lms_page_generator_link');