<?php $animation_class  = 'elementor-animation-' . $settings['course_list_card_hover_animation'] . $settings['card_hover_animation'] ? ' etlms-has-hover-animation' : ''; ?>
<div class="tutor-course-card etlms-course-grid-stacked<?php echo $animation_class; ?>">
    <div class="tutor-row tutor-gx-0">
        <div class="tutor-col-lg-4">
            <?php
                include etlms_get_template( 'course/list/grid/parts/thumbnail' );
                include etlms_get_template( 'course/list/parts/wishlist' );
                include etlms_get_template( 'course/list/parts/level' );
            ?>
        </div>

        <div class="tutor-col-lg-8 tutor-d-flex tutor-flex-column">
            <div class="tutor-card etlms-course-card-inner">
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
    </div>
</div>