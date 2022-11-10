<?php
/**
 * @var string $type
 * @var array $answers
 * @var string $question
 * @var string $question_explanation
 * @var string $question_hint
 */
$question_id = get_the_ID();

$answers['0']['text'] = esc_html__('True', 'masterstudy-lms-learning-management-system');
$answers['1']['text'] = esc_html__('False', 'masterstudy-lms-learning-management-system');
$answers['0']['value'] = 'True';
$answers['1']['value'] = 'False';

foreach($answers as $answer): ?>
	<div class="stm-lms-single-answer">
		<label>
			<input type="radio"
                   name="<?php echo esc_attr($question_id); ?>"
                   value="<?php echo sanitize_text_field($answer['value']); ?>" />
            <i class="fa fa-check"></i>
			<?php echo sanitize_text_field($answer['text']); ?>
		</label>
	</div>
<?php endforeach; ?>