<?php
/**
 * @var $current_user
 */
$user_id = !empty($current_user['id']) ? $current_user['id'] : '';
$status = get_user_meta($user_id, 'submission_status', true);
$class = ($status === 'pending') ? 'disabled' : '';
?>
<div class="stm_lms_become_instructor">

    <div class="stm_lms_become_instructor__top">
        <img src="<?php echo esc_url(STM_LMS_URL . '/assets/img/account/become_instructor.svg'); ?>"/>
        <h3><?php esc_html_e('Become an Instructor?', 'masterstudy-lms-learning-management-system'); ?></h3>
    </div>

    <p><?php esc_html_e('Take the chance to run your own courses and show your expertise.', 'masterstudy-lms-learning-management-system'); ?></p>

    <a href="#" class="btn-default btn <?php echo esc_attr($class); ?>" data-target=".stm-lms-modal-become-instructor"
       data-lms-modal="become_instructor">
        <?php
        if ($status === 'pending') {
            esc_html_e('Pending...', 'masterstudy-lms-learning-management-system');
        } else {
            esc_html_e('Submit Request', 'masterstudy-lms-learning-management-system');
        }
        ?>
    </a>

</div>
