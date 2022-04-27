<?php $animation_class  = 'elementor-animation-' . $settings['course_list_card_hover_animation'] . $settings['card_hover_animation'] ? ' etlms-has-hover-animation' : ''; ?>
<div class="tutor-card tutor-course-card tutor-loop-course-container <?php echo $animation_class; ?>">
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
        ?>
    </div>

    <?php include etlms_get_template( 'course/list/parts/footer' ); ?>
</div>