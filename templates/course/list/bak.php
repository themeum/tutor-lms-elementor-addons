<?php $animation  = 'elementor-animation-' . $settings['course_list_card_hover_animation']; ?>
<div class="<?php echo 'stacked' !== $settings['course_list_skin'] ? 'tutor-course-listing-item ' : ''; ?> tutor-card tutor-course-card <?php
if ( $settings['course_list_column'] == 1 && $settings['course_list_skin'] != 'overlayed' ) {
    echo 'etlms-course-list-style'; }
echo esc_attr( 'overlayed' == $settings['course_list_skin'] ? ' ' . $animation : '' );
if ( 'yes' == $settings['card_hover_animation'] ) {
    echo esc_attr( ' hover-animation' );
}
?>
" style="<?php echo esc_attr( $dynamic_style ); ?>">
    <div class="tutor-course-header1 <?php echo 'overlayed' != $settings['course_list_skin'] ? ' ' . $animation : '';?>
    ">
        <?php
            include etlms_get_template( 'course/list/parts/thumbnail' );
            include etlms_get_template( 'course/list/parts/wishlist' );
            include etlms_get_template( 'course/list/parts/level' );
        ?>
    </div>

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