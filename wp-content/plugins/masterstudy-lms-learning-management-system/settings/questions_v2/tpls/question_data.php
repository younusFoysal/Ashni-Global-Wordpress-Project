<template v-if="typeof item !== 'undefined'">
	<div class="section_data">
		<div class="section_data__title">
			<i class="fa fa-chevron-down" v-if="item.opened" @click="$set(item, 'opened', false)"></i>
			<i class="fa fa-chevron-up" @click="$set(item, 'opened', true)" v-else></i>

			<input type="text"
			       v-model="items[item_key]['title']"
			       v-bind:size="items[item_key]['title'].length + 2"
			       @blur="changeTitle(item.id, items[item_key]['title'], item_key)">
		</div>

		<div class="section_data__actions">
			<div class="question_types_input" v-if="typeof choices[item.type] !== 'undefined'">
				<div class="question_types_input_label">
					<span v-html="choices[item.type]"></span>
					<i class="fa fa-chevron-down"></i>

					<div class="question_types_wrapper">
						<div class="question_types">
							<div class="question_type"
							     v-for="(choice_label, choice_key) in choices"
							     v-html="choice_label"
							     v-bind:class="{'active' : item.type === choice_key}"
							     @click="$set(item, 'type', choice_key)">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="question_image" v-bind:class="{'opened' : typeof item.image_opened !== 'undefined' && item.image_opened, 'filled' : typeof item.image !== 'undefined' && item.image.id}">
				<div class="question_image__btn" @click="$set(item, 'image_opened', !item.image_opened)">
					<img :src="item.image.url" v-if="typeof item.image !== 'undefined' && item.image.url">
					+<i class="fa fa-image"></i>
				</div>

				<div class="question_image__popup_wrapper" v-if="item.image_opened">
					<?php stm_lms_questions_v2_load_template('image'); ?>
				</div>
			</div>

			<div class="question_delete"
			     @click="deleteQuestion(item_key, '<?php esc_attr_e('Do you really want to delete this question?', 'masterstudy-lms-learning-management-system') ?>')">
				<i class="fa fa-trash"></i>
			</div>

			<div class="question_move">
				<?php STM_LMS_Helpers::print_svg('settings/curriculum/images/dots.svg'); ?>
			</div>
		</div>
	</div>

	<div class="section_data_view_type"
		v-if="['single_choice', 'multi_choice', 'image_match'].includes(item.type)">
		<div class="section_data_view_type_title">
			<template v-if="item.type == 'image_match'">
				<?php esc_html_e('View Type', 'masterstudy-lms-learning-management-system'); ?>
			</template>
			<template v-else>
				<?php esc_html_e('Answers', 'masterstudy-lms-learning-management-system'); ?>
			</template>
		</div>

		<div>
			<div class="wpcfto_field_hint text">
				<i class="fa fa-info-circle"></i>
				<div class="hint"><?php esc_html_e('Uploading images with the same dimensions is highly recommended! ', 'masterstudy-lms-learning-management-system'); ?></div>
			</div>

			<template v-if="item.type == 'image_match'">
				<span :class="['grid_view', {'active': item.question_view_type == 'grid'}]"
				      @click="$set(item, 'question_view_type', 'grid')">
					<i class="fas fa-grip-horizontal"></i>
				</span>
					<span :class="['list_view', {'active': item.question_view_type != 'grid'}]"
					      @click="$set(item, 'question_view_type', 'list')">
					<i class="fas fa-grip-vertical"></i>
				</span>
			</template>
			<template v-if="['single_choice', 'multi_choice'].includes(item.type)">
				<span :class="['image_view', {'active': item.question_view_type == 'image'}]"
				      @click="$set(item, 'question_view_type', 'image')">
					<i class="fas fa-image"></i>
				</span>
					<span :class="['list_view', {'active': item.question_view_type != 'image'}]"
					      @click="$set(item, 'question_view_type', 'list')">
					<i class="fas fa-list"></i>
				</span>
			</template>
		</div>
	</div>
</template>