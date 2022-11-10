<div>

    <div class="stm_lms_item_modal__inner" v-bind:class="{'loading' : loading}">
        <h3 class="text-center">{{title}}</h3>


        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" v-bind:class="fields['type'] !== 'zoom_conference' ? 'active' : ''" v-if="fields['type'] !== 'zoom_conference'">
                <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
					<?php esc_html_e('Content', 'masterstudy-lms-learning-management-system-pro'); ?>
                </a>
            </li>
            <li role="presentation" v-bind:class="fields['type'] === 'zoom_conference' ? 'active' : ''">
                <a href="#lesson_settings" aria-controls="profile" role="tab" data-toggle="tab">
					<?php esc_html_e('Lesson Settings', 'masterstudy-lms-learning-management-system-pro'); ?>
                </a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" v-if="fields['type'] !== 'zoom_conference'" v-bind:class="fields['type'] !== 'zoom_conference' ? 'tab-pane active' : 'tab-pane'" id="home">
				<?php STM_LMS_Templates::show_lms_template('manage_course/forms/editor', array('field_key' => 'content', 'listener' => true)); ?>
            </div>
            <div role="tabpanel" v-bind:class="fields['type'] === 'zoom_conference' ? 'tab-pane active' : 'tab-pane'" id="lesson_settings">

                <div class="form-group">
                    <label>
                        <h4><?php esc_html_e('Lesson type', 'masterstudy-lms-learning-management-system-pro'); ?></h4>
                        <select name="type" v-model="fields['type']" class="form-control">
                            <option value="text"><?php esc_html_e('Text', 'masterstudy-lms-learning-management-system-pro'); ?></option>
                            <option value="video"><?php esc_html_e('Video', 'masterstudy-lms-learning-management-system-pro'); ?></option>
                            <option value="slide"><?php esc_html_e('Slide', 'masterstudy-lms-learning-management-system-pro'); ?></option>
                            <?php do_action('stm_lms_lesson_types'); ?>
                        </select>
                    </label>
                </div>

                <?php do_action('stm_lms_lesson_manage_settings'); ?>

                <!--Video Lesson Settings-->
                <div class="form-group">
                    <label>
                        <h4><?php esc_html_e('Lesson video Poster', 'masterstudy-lms-learning-management-system-pro'); ?></h4>
                        <input type="file" class="form-control" v-model="fields['lesson_video_poster']" ref="video_poster" />
                    </label>
                </div>

                <div v-if="fields['lesson_video_poster_url']" class="vide_poster_url">
                    <img v-bind:src="fields['lesson_video_poster_url']" />
                </div>
                <div class="form-group">
                    <label>
                        <h4><?php esc_html_e('Lesson video URL', 'masterstudy-lms-learning-management-system-pro'); ?></h4>
                        <input type="url" class="form-control" v-model="fields['lesson_video_url']" />
                    </label>
                </div>

                <?php
                $allow_upload_video = STM_LMS_Options::get_option('allow_upload_video', false);
                if($allow_upload_video):
                ?>
                <div class="form-group" v-if="fields['type'] === 'video'">
                    <label>
                        <h4><?php esc_html_e('Lesson video', 'masterstudy-lms-learning-management-system-pro'); ?></h4>
                        <input type="file" class="form-control" v-model="fields['lesson_video']" ref="lesson_video" />
                        <div v-html="fields['uploaded_lesson_video']"></div>
                    </label>
                </div>
                <?php endif; ?>
                <div class="form-group">
                    <label>
                        <h4><?php esc_html_e('Lesson duration', 'masterstudy-lms-learning-management-system-pro'); ?></h4>
                        <input v-bind:type="fields['type'] === 'zoom_conference' ? 'number' : 'text'" class="form-control" v-model="fields['duration']"/>
                    </label>
                </div>

                <div class="form-group">
                    <div class="stm-lms-admin-checkbox">
                        <label>
                            <h4><?php esc_html_e('Lesson preview (Lesson will be available to everyone)', 'masterstudy-lms-learning-management-system-pro'); ?></h4>
                        </label>
                        <div class="stm-lms-admin-checkbox-wrapper" v-bind:class="{'active' : fields['preview']}">
                            <div class="wpcfto-checkbox-switcher"></div>
                            <input type="checkbox" name="preview" v-model="fields['preview']">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>
                        <h4><?php esc_html_e('Lesson Front-End description', 'masterstudy-lms-learning-management-system-pro'); ?></h4>
                        <textarea v-model="fields['lesson_excerpt']"></textarea>
                    </label>
                </div>

                <div class="stm_metaboxes_grid" v-if="!loading">
                    <div class="stm_metaboxes_grid__inner">
                        <wpcfto_repeater v-bind:fields="lesson_files_pack_data"
                                         v-bind:parent_repeater="'parent'"
                                         v-bind:field_label="lesson_files_pack_data['label']"
                                         v-bind:field_name="'lesson_files_pack'"
                                         v-bind:field_id="'section_settings-lesson_files_pack'"
                                         v-bind:field_value="fields['lesson_files_pack']"
                                         v-bind:field_data='lesson_files_pack_data'
                                         @wpcfto-get-value="$set(fields, 'lesson_files_pack', JSON.stringify($event));">
                        </wpcfto_repeater>
                    </div>
                </div>



            </div>
        </div>
    </div>

    <div class="stm_lms_item_modal__bottom">
        <a href="#" @click.prevent="saveChanges()" class="btn btn-default"><?php esc_html_e('Save Changes', 'masterstudy-lms-learning-management-system-pro'); ?></a>
        <a href="#" @click.prevent="discardChanges()" class="btn btn-default btn-cancel"><?php esc_html_e('Cancel', 'masterstudy-lms-learning-management-system-pro'); ?></a>
    </div>

</div>