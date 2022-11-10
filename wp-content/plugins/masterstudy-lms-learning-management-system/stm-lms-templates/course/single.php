<?php if( !defined( 'ABSPATH' ) ) exit; //Exit if accessed directly ?>

<?php do_action('stm_lms_single_course_start', get_the_ID()); ?>

<?php stm_lms_register_style( 'course' ); ?>

    <div class="row">

        <div class="col-md-9">

            <?php STM_LMS_Templates::show_lms_template( 'global/completed_label', array( 'course_id' => get_the_ID() ) ); ?>

            <h1 class="stm_lms_course__title"><?php the_title(); ?></h1>

            <?php STM_LMS_Templates::show_lms_template( 'course/parts/panel_info' ); ?>

            <?php STM_LMS_Templates::show_lms_template( 'course/parts/tabs' ); ?>

            <?php
            if( STM_LMS_Options::get_option( 'enable_related_courses', false ) ) {
                STM_LMS_Templates::show_lms_template( 'course/parts/related' );
            }
            ?>

        </div>

        <div class="col-md-3">

            <?php STM_LMS_Templates::show_lms_template( 'course/sidebar' ); ?>

        </div>

    </div>

<?php STM_LMS_Templates::show_lms_template( 'course/sticky/panel' ); ?>