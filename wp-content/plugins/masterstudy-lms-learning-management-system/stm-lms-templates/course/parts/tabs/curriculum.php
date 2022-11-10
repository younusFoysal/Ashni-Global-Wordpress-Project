<?php if ( ! defined( 'ABSPATH' ) ) exit; //Exit if accessed directly ?>

<?php
stm_lms_register_style('curriculum');
stm_lms_register_script('curriculum');
$post_id = (!empty($post_id)) ? $post_id : get_the_ID();
$curriculum = get_post_meta($post_id, 'curriculum', true);
if (!empty($curriculum)):
	$curriculum = explode(',', $curriculum);
	$has_access = STM_LMS_User::has_course_access($post_id, '', false);
	$lesson_number = 1;
	?>

    <div class="stm-curriculum">

		<?php foreach ($curriculum as $curriculum_item): ?>

			<?php if (!is_numeric($curriculum_item)): $lesson_number = 1; ?>
                <div class="stm-curriculum-section">
                    <h3><?php echo wp_kses_post($curriculum_item); ?></h3>
                </div>
				<?php continue;
			endif; ?>

			<?php $content_type = get_post_type($curriculum_item);
			$meta = '';
			$icon = 'stmlms-text';
			$hint = esc_html__('Text Lesson','masterstudy-lms-learning-management-system');
			$lesson_excerpt = get_post_meta($curriculum_item, 'lesson_excerpt', true);
			$preview = '';
			if($content_type === 'stm-quizzes') {
				$q = get_post_meta($curriculum_item, 'questions', true);
				$icon = 'stmlms-quiz';
				$hint = esc_html__('Quiz','masterstudy-lms-learning-management-system');
				if (!empty($q)):
					$meta = sprintf(_n(
						'%s question',
						'%s questions',
						count(explode(',', $q)),
						'masterstudy-lms-learning-management-system'
					), count(explode(',', $q)));
				endif;
            } else {
			    $preview = get_post_meta($curriculum_item, 'preview', true);
			    $meta = get_post_meta($curriculum_item, 'duration', true);
			    $type = get_post_meta($curriculum_item, 'type', true);

			    if($type == 'slide') {
			        $icon = 'stmlms-slides-css';
					$hint = esc_html__('Slides','masterstudy-lms-learning-management-system');
				}

				if($type == 'video') {
					$icon = 'stmlms-slides';
					$hint = esc_html__('Video','masterstudy-lms-learning-management-system');
                }

                if($type == 'stream') {
                    $icon = 'fab fa-youtube';
                    $hint = esc_html__('Live Stream','masterstudy-lms-learning-management-system');
                }
                if($type == 'zoom_conference') {
                    $icon = 'fas fa-video';
                    $hint = esc_html__('Zoom meeting','masterstudy-lms-learning-management-system');
                }
			    if(!empty($meta)) $meta = '<i class="far fa-clock"></i>' . $meta;
            }

			$curriculum_atts = apply_filters('stm_lms_curriculum_item_atts', array(), $post_id, $curriculum_item ); ?>

            <div class="stm-curriculum-item <?php if(!empty($lesson_excerpt)) echo esc_attr('has-excerpt'); ?>"
                 <?php echo implode(' ', $curriculum_atts); ?>>

                <div class="stm-curriculum-item__num">
					<?php echo intval($lesson_number); ?>
                </div>

                <div class="stm-curriculum-item__icon" data-toggle="tooltip" data-placement="bottom" title="<?php echo wp_kses_post($hint); ?>">
					<i class="<?php echo esc_attr($icon) ?>"></i>
                </div>

                <div class="stm-curriculum-item__title">
                    <div class="heading_font">
                        <?php echo esc_attr(get_the_title($curriculum_item)); ?>
                        <?php if(!empty($lesson_excerpt)): ?>
                            <span class="stm-curriculum-item__toggle"></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="stm-curriculum-item__preview">
					<?php if(!empty($preview)): ?>
                        <a href="<?php echo esc_url(STM_LMS_Lesson::get_lesson_url(get_the_ID(), $curriculum_item)); ?>">
							<?php esc_html_e('Preview', 'masterstudy-lms-learning-management-system'); ?>
                        </a>
					<?php endif; ?>
                </div>

                <div class="stm-curriculum-item__meta">
					<?php if(!empty($meta)): ?>
                        <?php echo wp_kses_post($meta); ?>
                    <?php endif; ?>
                </div>

                <?php if(!empty($lesson_excerpt)): ?>
                    <div class="stm-curriculum-item__excerpt">
                        <?php echo wp_kses_post($lesson_excerpt); ?>
                    </div>
                <?php endif; ?>

            </div>

			<?php $lesson_number++; ?>
		<?php endforeach; ?>

    </div>

<?php endif; ?>