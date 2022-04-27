<?php $animation_class  = $settings['card_hover_animation'] ? ' etlms-has-hover-animation' : ''; ?>
<div class="tutor-course-card etlms-course-card-overlay<?php echo $animation_class; ?>">
    <?php
        include etlms_get_template( 'course/carousel/parts/thumbnail' );
    ?>

    <div class="tutor-card tutor-loop-course-container">
        <div class="tutor-card-body">
            <?php
                include etlms_get_template( 'course/carousel/parts/ratings' );
                include etlms_get_template( 'course/carousel/parts/title' );
                include etlms_get_template( 'course/carousel/parts/meta' );
                include etlms_get_template( 'course/carousel/parts/info' );
            ?>
        </div>

        <?php include etlms_get_template( 'course/carousel/parts/footer' ); ?>
    </div>
</div>