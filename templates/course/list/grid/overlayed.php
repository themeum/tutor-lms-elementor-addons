<?php $animation_class  = 'elementor-animation-' . $settings['course_list_card_hover_animation'] . $settings['card_hover_animation'] ? ' etlms-has-hover-animation' : ''; ?>
<div class="tutor-course-card etlms-course-card-overlay <?php echo $animation_class; ?>">
    <?php
        include etlms_get_template( 'course/list/grid/parts/thumbnail' );
    ?>

    <div class="tutor-card tutor-loop-course-container">
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
</div>