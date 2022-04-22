<div class="tutor-course-card etlms-course-card-overlay<?php echo $settings['card_hover_animation'] ? ' etlms-has-hover-animation' : ''; ?>">
    <?php
        include etlms_get_template( 'course/list/parts/thumbnail' );
        include etlms_get_template( 'course/list/parts/wishlist' );
        include etlms_get_template( 'course/list/parts/level' );
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