<?php $user = STM_LMS_User::get_current_user();
if (empty($user['id'])) : ?>
	<?php
	stm_lms_register_style('login');
	stm_lms_register_style('register');
	enqueue_login_script();
	enqueue_register_script();
	?>

    <a href="#"
       class="btn btn-default"
       data-target=".stm-lms-modal-login"
       id="stm_lms_buy_button"
       data-lms-modal="login">
        <span><?php esc_html_e('Enroll course', 'masterstudy-lms-learning-management-system-pro'); ?></span>
    </a>
<?php else:
	$user_id = $user['id'];
	$course = STM_LMS_Helpers::simplify_db_array(stm_lms_get_user_course($user_id, $course_id, array('current_lesson_id')));
	$current_lesson = (!empty($course['current_lesson_id'])) ? $course['current_lesson_id'] : '';
	$lesson_url = STM_LMS_Course::item_url($course_id, $current_lesson); ?>
    <a href="<?php echo esc_url($lesson_url); ?>" class="btn btn-default btn_big">
        <span><?php esc_html_e('Start course', 'masterstudy-lms-learning-management-system-pro'); ?></span>
    </a>

<?php endif; ?>