<?php
if( empty( $taxonomy ) ) $taxonomy = 'get_default';

if( !empty( $taxonomy ) ):
    if( function_exists( 'stm_option' ) ) {
        $base_color = stm_option( 'secondary_color', '#48a7d4' );
    }
    else {
        $base_color = STM_LMS_Options::get_option('secondary_color', '#48a7d4');
    }


    stm_lms_module_styles( 'course_category', $style, array(),
        ".stm_lms_courses_category a:hover h4 {color: {$base_color}}"
    );

    if( $taxonomy === 'get_default' ) {
        $terms = array();
        $terms_all = stm_lms_get_lms_terms_with_meta( 'course_image' );
        if( !empty( $terms_all ) ) {
            foreach( $terms_all as $term ) {
                $meta_value = get_term_meta( $term->term_id, 'course_image', true );
                if( !empty( $meta_value ) ) $terms[] = $term->term_id;
            }
        }
    }
    else {
        $terms = explode( ', ', $taxonomy );
    }

    if( !empty( $terms ) and is_array( $terms ) ): ?>
        <div class="stm_lms_courses_categories <?php echo esc_attr( $style ); ?>">

            <?php foreach( $terms as $key => $term ):
                $term = get_term_by( 'id', $term, 'stm_lms_course_taxonomy' );
                if( empty( $term ) or is_wp_error( $term ) ) continue;
                $class = ( !$key ) ? 'wide' : 'default'; ?>

                <?php if( $key !== 2 ): ?>
                <div class="stm_lms_courses_category stm_lms_courses_category__<?php echo esc_attr( $key ); ?> stm_lms_courses_category_<?php echo esc_attr( $class ); ?>">
            <?php endif; ?>

                <a href="<?php echo esc_url( get_term_link( $term, 'stm_lms_course_taxonomy' ) ); ?>"
                   title="<?php echo esc_attr( $term->name ); ?>"
                   class="no_deco <?php echo esc_attr( $class ); ?>">

                    <?php
                    $term_image = wpcfto_get_term_meta_text( $term->term_id, 'course_image' );
                    $big_image = ( $style == 'style_2' ) ? '770x340' : '770x375';
                    $image_dimensions = ( $key == 0 ) ? $big_image : '370x155';
                    if( !empty( $term_image ) ) {
                        $image = stm_lms_get_VC_attachment_img_safe( $term_image, $image_dimensions );
                    }
                    else {
                        $image_dimensions = explode( 'x', $image_dimensions );
                        $image = '<div class="stm_lms_courses_categories__holder" style="width: ' . $image_dimensions[ 0 ] . 'px;"></div>';
                    }
                    ?>

                    <div class="stm_lms_courses_category__image">
                        <?php echo stm_lms_lazyload_image( $image ); ?>
                    </div>

                    <div class="stm_lms_courses_category__info">
                        <h4><?php echo esc_attr( $term->name ); ?></h4>
                        <span><?php printf( esc_html__( '%s Courses', 'masterstudy-lms-learning-management-system' ), $term->count ); ?></span>
                    </div>
                </a>

                <?php if( $key !== 1 ): ?>
                </div>
            <?php endif; ?>

            <?php endforeach; ?>
        </div>
    <?php endif; ?>
<?php endif;