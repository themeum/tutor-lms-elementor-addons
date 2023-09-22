<?php $animation_class  = 'elementor-animation-' . $settings['course_list_card_hover_animation'] . $settings['card_hover_animation'] ? ' etlms-has-hover-animation' : ''; ?>
<div class="tutor-card tutor-course-card tutor-loop-course-container etlms-course-card-classic <?php echo $animation_class; ?>">
    <?php
        include etlms_get_template( 'course/list/parts/thumbnail' );
        include etlms_get_template( 'course/list/parts/wishlist' );
        include etlms_get_template( 'course/list/parts/level' );
    ?>

    <div class="tutor-card-body">
        <?php
            include etlms_get_template( 'course/list/parts/ratings' );
            include etlms_get_template( 'course/list/parts/title' );
            include etlms_get_template( 'course/list/parts/meta' );
            include etlms_get_template( 'course/list/parts/info' );
            if ( 'yes' === $settings['course_list_current_user_progress'] ) {
                include etlms_get_template( 'course/status' );
            }
        ?>
    </div>

    <?php include etlms_get_template( 'course/list/parts/footer' ); ?>
</div>